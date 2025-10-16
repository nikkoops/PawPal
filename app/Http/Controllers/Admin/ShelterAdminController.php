<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShelterAdminController extends Controller
{
    /**
     * Display the shelter admin dashboard
     */
    public function index()
    {
        $user = auth()->user();
        
        // Base query for filtering by shelter location
        $petQuery = Pet::query();
        $applicationQuery = AdoptionApplication::query();

        // Filter by shelter location if user has one assigned
        if ($user->hasShelterLocation()) {
            $petQuery->where('location', $user->shelter_location);
            $applicationQuery->whereHas('pet', function($query) use ($user) {
                $query->where('location', $user->shelter_location);
            });
        }

        // Get shelter-specific statistics
        $totalPets = $petQuery->count();
        $availablePets = (clone $petQuery)->where('is_available', true)->count();
        $totalApplications = $applicationQuery->count();
        $pendingApplications = (clone $applicationQuery)->where('status', 'pending')->count();

        // Get recent pets
        $recentPets = (clone $petQuery)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent applications
        $recentApplications = (clone $applicationQuery)
            ->with('pet')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.shelter.dashboard', compact(
            'totalPets',
            'availablePets',
            'totalApplications',
            'pendingApplications',
            'recentPets',
            'recentApplications'
        ));
    }

    /**
     * Display the settings page
     */
    public function settings()
    {
        return view('admin.shelter.settings');
    }

    /**
     * Update the admin's password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.'
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }
}
