<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:system_admin,shelter_admin',
        ]);

        $credentials = $request->only('email', 'password');
        $requestedRole = $request->input('role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Log successful authentication attempt
            \Log::info('Admin login attempt', [
                'email' => $user->email,
                'user_role' => $user->role,
                'is_admin' => $user->is_admin,
                'requested_role' => $requestedRole,
                'ip' => $request->ip(),
            ]);
            
            // Check if user is admin
            if (!$user->is_admin) {
                Auth::logout();
                \Log::warning('Admin login denied - not admin', ['email' => $user->email]);
                return back()->withErrors([
                    'email' => 'Access denied. Admin privileges required.',
                ]);
            }

            // Check if user's role matches the requested role
            if ($user->role !== $requestedRole) {
                Auth::logout();
                \Log::warning('Admin login denied - role mismatch', [
                    'email' => $user->email,
                    'user_role' => $user->role,
                    'requested_role' => $requestedRole
                ]);
                return back()->withErrors([
                    'email' => 'Access denied. You do not have ' . 
                              ($requestedRole === 'system_admin' ? 'System Admin' : 'Shelter Admin') . 
                              ' privileges.',
                ]);
            }

            // Store role in session
            $request->session()->regenerate();
            $request->session()->put('user_role', $user->role);

            // Redirect based on role to specific dashboards
            if ($user->role === 'system_admin') {
                return redirect()->intended(route('admin.system.dashboard'));
            } else {
                // Shelter admins go directly to Pet Management
                return redirect()->intended(route('admin.shelter.pets.index'));
            }
        }

        // Log failed authentication attempt
        \Log::warning('Admin login failed - invalid credentials', [
            'email' => $request->email,
            'requested_role' => $requestedRole,
            'ip' => $request->ip(),
        ]);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Store user role before logout to redirect to correct login page
        $userRole = auth()->user()->role ?? 'shelter_admin';
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the appropriate login page based on user role
        return redirect()->route('admin.login', ['role' => $userRole]);
    }
}