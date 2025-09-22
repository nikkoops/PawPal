<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pets' => Pet::count(),
            'available_pets' => Pet::where('is_available', true)->count(),
            'adopted_pets' => Pet::where('is_available', false)->count(),
            'pending_applications' => AdoptionApplication::where('status', 'pending')->count(),
            'approved_applications' => AdoptionApplication::where('status', 'approved')->count(),
            'total_users' => User::where('is_admin', false)->count(),
            'recent_applications' => AdoptionApplication::with(['user', 'pet'])
                ->latest()
                ->take(5)
                ->get(),
            'recent_pets' => Pet::latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}