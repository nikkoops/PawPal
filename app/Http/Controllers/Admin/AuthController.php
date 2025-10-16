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
            
            // Check if user is admin
            if (!$user->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Access denied. Admin privileges required.',
                ]);
            }

            // Check if user's role matches the requested role
            if ($user->role !== $requestedRole) {
                Auth::logout();
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
                return redirect()->intended(route('admin.shelter.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}