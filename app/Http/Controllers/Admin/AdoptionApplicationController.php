<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdoptionApplication::with(['pet']);

        // Filter by status if provided
        if ($request->has('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }

        // Filter by search term
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('pet', function($petQuery) use ($search) {
                      $petQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by pet if provided
        if ($request->has('pet_id') && $request->get('pet_id') !== '') {
            $query->where('pet_id', $request->get('pet_id'));
        }
        
        // Filter by date range
        if ($request->has('date_range') && $request->get('date_range') !== '') {
            $range = $request->get('date_range');
            if ($range === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($range === 'week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($range === 'month') {
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
            }
        }

        // Get applications with pagination
        $applications = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Debug pet relationships
        \Illuminate\Support\Facades\Log::info('Applications loaded for admin', [
            'count' => $applications->count(),
            'with_pets' => $applications->filter(function($app) { 
                return $app->pet_id !== null; 
            })->count(),
            'pet_ids' => $applications->pluck('pet_id')->toArray(),
            'first_few_applications' => $applications->take(3)->map(function($app) {
                return [
                    'id' => $app->id,
                    'name' => $app->first_name . ' ' . $app->last_name,
                    'pet_id' => $app->pet_id,
                    'has_pet_relation' => $app->pet !== null,
                    'pet_name' => $app->pet ? $app->pet->name : 'No pet found'
                ];
            })
        ]);
        
        // Calculate statistics
        $stats = [
            'total' => AdoptionApplication::count(),
            'pending' => AdoptionApplication::where('status', 'pending')->count(),
            'approved' => AdoptionApplication::where('status', 'approved')->count(),
            'rejected' => AdoptionApplication::where('status', 'rejected')->count(),
            'this_month' => AdoptionApplication::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];
        
        // Get all pets for the filter dropdown
        $pets = \App\Models\Pet::orderBy('name')->get(['id', 'name', 'breed']);

        return view('admin.applications.index', compact('applications', 'stats', 'pets'));
    }

    public function show(AdoptionApplication $application)
    {
        $application->load(['pet', 'reviewer']);
        return view('admin.applications.show', compact('application'));
    }
    
    /**
     * Get application details via AJAX
     */
    public function getApplicationDetails(AdoptionApplication $application)
    {
        $application->load('pet');
        
        // Format data for the application modal
        $details = [
            'id' => $application->id,
            'applicant' => [
                'name' => $application->first_name . ' ' . $application->last_name,
                'email' => $application->email,
                'phone' => $application->phone,
                'address' => $application->address,
                'occupation' => $application->occupation,
                'birth_date' => $application->birth_date ? $application->birth_date->format('M d, Y') : null
            ],
            'pet' => $application->pet ? [
                'id' => $application->pet->id,
                'name' => $application->pet->name,
                'breed' => $application->pet->breed,
                'image' => $application->pet->image_url
            ] : null,
            'application' => [
                'status' => $application->status,
                'created_at' => $application->created_at->format('M d, Y'),
                'time_ago' => $application->created_at->diffForHumans(),
                'admin_notes' => $application->admin_notes,
                'reviewed_at' => $application->reviewed_at ? $application->reviewed_at->format('M d, Y') : null,
            ],
            'form_data' => $application->getAttributes(),
            'answers' => $application->answers // JSON data from form submission
        ];
        
        return response()->json($details);
    }

    public function updateStatus(Request $request, AdoptionApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => auth()->id(),
        ]);

        // If approved, mark pet as unavailable
        if ($request->status === 'approved') {
            $application->pet->update(['is_available' => false]);
        }

        return redirect()->back()->with('success', 'Application status updated successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,under_review',
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:adoption_applications,id',
        ]);

        $applications = AdoptionApplication::whereIn('id', $request->application_ids)->get();

        foreach ($applications as $application) {
            $application->update([
                'status' => $request->action === 'under_review' ? 'under_review' : $request->action . 'd',
                'reviewed_at' => now(),
                'reviewed_by' => auth()->id(),
            ]);

            // If approved, mark pet as unavailable
            if ($request->action === 'approve') {
                $application->pet->update(['is_available' => false]);
            }
        }

        $count = count($request->application_ids);
        return redirect()->back()->with('success', "{$count} application(s) updated successfully!");
    }
}