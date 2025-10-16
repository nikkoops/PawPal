<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SystemAdminController extends Controller
{
    /**
     * Display the system admin dashboard
     */
    public function index()
    {
        // Get statistics for system admin dashboard
        $totalAdmins = User::where('is_admin', true)->count();
        $systemAdmins = User::where('role', 'system_admin')->count();
        $shelterAdmins = User::where('role', 'shelter_admin')->count();
        $totalPets = Pet::count();
        $availablePets = Pet::where('is_available', true)->count();
        $totalApplications = AdoptionApplication::count();
        $pendingApplications = AdoptionApplication::where('status', 'pending')->count();

        return view('admin.system.dashboard', compact(
            'totalAdmins',
            'systemAdmins',
            'shelterAdmins',
            'totalPets',
            'availablePets',
            'totalApplications',
            'pendingApplications'
        ));
    }

    /**
     * Display user management page
     */
    public function users()
    {
        $users = User::where('is_admin', true)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.system.users.index', compact('users'));
    }

    /**
     * Show create user form
     */
    public function createUser()
    {
        return view('admin.system.users.create');
    }

    /**
     * Store a new user
     */
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['system_admin', 'shelter_admin'])],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.system.users')
            ->with('success', 'User created successfully!');
    }

    /**
     * Show edit user form
     */
    public function editUser(User $user)
    {
        // Prevent editing non-admin users
        if (!$user->is_admin) {
            return redirect()->route('admin.system.users')
                ->with('error', 'You can only edit admin users.');
        }

        return view('admin.system.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function updateUser(Request $request, User $user)
    {
        // Prevent editing non-admin users
        if (!$user->is_admin) {
            return redirect()->route('admin.system.users')
                ->with('error', 'You can only edit admin users.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['system_admin', 'shelter_admin'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Only update password if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.system.users')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deleting non-admin users
        if (!$user->is_admin) {
            return redirect()->route('admin.system.users')
                ->with('error', 'You can only delete admin users.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.system.users')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.system.users')
            ->with('success', 'User deleted successfully!');
    }

    /**
     * Display system analytics
     */
    public function analytics()
    {
        // Get comprehensive analytics
        $analytics = [
            'users' => [
                'total' => User::count(),
                'admins' => User::where('is_admin', true)->count(),
                'system_admins' => User::where('role', 'system_admin')->count(),
                'shelter_admins' => User::where('role', 'shelter_admin')->count(),
            ],
            'pets' => [
                'total' => Pet::count(),
                'available' => Pet::where('is_available', true)->count(),
                'adopted' => Pet::where('is_available', false)->count(),
                'by_type' => Pet::selectRaw('type, COUNT(*) as count')
                    ->groupBy('type')
                    ->get()
                    ->pluck('count', 'type'),
            ],
            'applications' => [
                'total' => AdoptionApplication::count(),
                'pending' => AdoptionApplication::where('status', 'pending')->count(),
                'approved' => AdoptionApplication::where('status', 'approved')->count(),
                'rejected' => AdoptionApplication::where('status', 'rejected')->count(),
            ],
        ];

        return view('admin.system.analytics', compact('analytics'));
    }
}
