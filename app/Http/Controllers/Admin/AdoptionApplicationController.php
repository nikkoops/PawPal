<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdoptionApplication::with(['user', 'pet']);

        if ($request->has('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('pet', function($petQuery) use ($search) {
                    $petQuery->where('name', 'like', "%{$search}%");
                });
            });
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.applications.index', compact('applications'));
    }

    public function show(AdoptionApplication $application)
    {
        $application->load(['user', 'pet', 'reviewer']);
        return view('admin.applications.show', compact('application'));
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