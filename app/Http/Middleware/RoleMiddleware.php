<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  The required role (system_admin or shelter_admin)
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();

        // Check if user is admin
        if (!$user->is_admin) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Access denied. Admin privileges required.');
        }

        // Check if user has the required role
        if ($user->role !== $role) {
            // Redirect to their appropriate dashboard
            $redirectRoute = $user->role === 'system_admin' 
                ? 'admin.system.dashboard' 
                : 'admin.shelter.dashboard';
            
            return redirect()->route($redirectRoute)
                ->with('error', 'Access denied. You do not have permission to access this section.');
        }

        return $next($request);
    }
}
