<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class ShelterAdminController extends Controller
{
    /**
     * Display the shelter admin dashboard
     */
    public function index()
    {
        // Get shelter-specific statistics
        $totalPets = Pet::count();
        $availablePets = Pet::where('is_available', true)->count();
        $totalApplications = AdoptionApplication::count();
        $pendingApplications = AdoptionApplication::where('status', 'pending')->count();

        // Get recent pets
        $recentPets = Pet::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent applications
        $recentApplications = AdoptionApplication::with('pet')
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
}
