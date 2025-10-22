<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdoptionApplication::with(['pet.images']); // Eager load pet and its images
        
        // Filter by shelter location if user has one assigned
        $user = auth()->user();
        if ($user->hasShelterLocation()) {
            $query->whereHas('pet', function($petQuery) use ($user) {
                $petQuery->where('location', $user->shelter_location);
            });
        }

        // Filter by status if provided
        if ($request->has('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }
        
        // Filter by pet type if provided
        if ($request->has('pet_type') && $request->get('pet_type') !== '') {
            $petType = $request->get('pet_type');
            $query->whereHas('pet', function($petQuery) use ($petType) {
                $petQuery->where('type', $petType);
            });
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
        $statsQuery = AdoptionApplication::query();
        if ($user->hasShelterLocation()) {
            $statsQuery->whereHas('pet', function($petQuery) use ($user) {
                $petQuery->where('location', $user->shelter_location);
            });
        }
        
        $stats = [
            'total' => (clone $statsQuery)->count(),
            'pending' => (clone $statsQuery)->where('status', 'pending')->count(),
            'approved' => (clone $statsQuery)->where('status', 'approved')->count(),
            'rejected' => (clone $statsQuery)->where('status', 'rejected')->count(),
            'this_month' => (clone $statsQuery)->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];

        // Return JSON for AJAX stats requests
        if ($request->get('ajax') === 'stats') {
            return response()->json(['stats' => $stats]);
        }

        return view('admin.applications.index', compact('applications', 'stats'));
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
        
        // Extract data from the JSON answers field
        $answers = $application->answers ?? [];
        
        // Format data for the application modal
        $details = [
            'id' => $application->id,
            'applicant' => [
                'name' => ($answers['firstName'] ?? '') . ' ' . ($answers['lastName'] ?? ''),
                'email' => $answers['email'] ?? '',
                'phone' => $answers['phone'] ?? '',
                'address' => $answers['address'] ?? '',
                'occupation' => $answers['occupation'] ?? '',
                'company' => $answers['company'] ?? '',
                'birth_date' => isset($answers['birthDate']) ? \Carbon\Carbon::parse($answers['birthDate'])->format('M d, Y') : null,
                'pronouns' => $answers['pronouns'] ?? '',
                'social_media' => $answers['socialMedia'] ?? ''
            ],
            'pet' => $application->pet ? [
                'id' => $application->pet->id,
                'name' => $application->pet->name,
                'breed' => $application->pet->breed,
                'type' => $application->pet->type,
                'image' => $application->pet->image_url ?? null
            ] : null,
            'application' => [
                'status' => $application->status,
                'created_at' => $application->created_at->format('M d, Y g:i A'),
                'time_ago' => $application->created_at->diffForHumans(),
                'admin_notes' => $application->admin_notes,
                'reviewed_at' => $application->reviewed_at ? $application->reviewed_at->format('M d, Y g:i A') : null,
            ],
            'living_situation' => [
                'building_type' => $answers['buildingType'] ?? '',
                'status' => $answers['status'] ?? '',
                'live_with' => $answers['liveWith'] ?? '',
                'allergies' => $answers['allergies'] ?? '',
                'moving_plans' => $answers['movingPlans'] ?? '',
            ],
            'pet_care' => [
                'care_responsible' => $answers['careResponsible'] ?? '',
                'financial_responsible' => $answers['financialResponsible'] ?? '',
                'vacation_care' => $answers['vacationCare'] ?? '',
                'hours_alone' => $answers['hoursAlone'] ?? '',
                'time_commitment' => $answers['timeCommitment'] ?? '',
                'introduction_steps' => $answers['introductionSteps'] ?? '',
            ],
            'experience' => [
                'family_support' => $answers['familySupport'] ?? '',
                'other_pets' => $answers['otherPets'] ?? '',
                'past_pets' => $answers['pastPets'] ?? '',
            ],
            'answers' => $answers // Complete form data for the JavaScript renderFormAnswers function
        ];
        
        return response()->json($details);
    }

    public function updateStatus(Request $request, AdoptionApplication $application)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,approved,rejected',
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

            return response()->json([
                'success' => true,
                'message' => 'Application status updated successfully!',
                'status' => $request->status,
                'application_id' => $application->id,
                'previous_status' => $application->getOriginal('status')
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Status update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update application status'], 500);
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            \Log::info('Bulk action request:', $request->all());
            
            $request->validate([
                'action' => 'required|in:approve,reject,pending',
                'application_ids' => 'required|array|min:1',
                'application_ids.*' => 'integer|exists:adoption_applications,id',
            ]);

            $applications = AdoptionApplication::whereIn('id', $request->application_ids)->get();
            
            \Log::info('Found applications:', ['count' => $applications->count(), 'ids' => $applications->pluck('id')]);
            
            if ($applications->isEmpty()) {
                return response()->json(['error' => 'No applications found'], 404);
            }

            $updated = 0;
            foreach ($applications as $application) {
                $status = $request->action === 'approve' ? 'approved' : ($request->action === 'reject' ? 'rejected' : 'pending');
                
                $application->update([
                    'status' => $status,
                    'reviewed_at' => now(),
                    'reviewed_by' => auth()->id(),
                ]);

                // If approved, mark pet as unavailable
                if ($request->action === 'approve' && $application->pet) {
                    $application->pet->update(['is_available' => false]);
                }
                $updated++;
            }

            \Log::info('Bulk action completed:', ['updated' => $updated]);

            return response()->json([
                'success' => true,
                'message' => "{$updated} application(s) updated successfully!",
                'updated_count' => $updated
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', $e->errors());
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Bulk action failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Failed to update applications: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Filter applications via AJAX
     */
    public function filter(Request $request)
    {
        $query = AdoptionApplication::with(['pet.images']); // Eager load pet and its images

        // Filter by status if provided
        if ($request->has('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }
        
        // Filter by pet type if provided
        if ($request->has('pet_type') && $request->get('pet_type') !== '') {
            $petType = $request->get('pet_type');
            $query->whereHas('pet', function($petQuery) use ($petType) {
                $petQuery->where('type', $petType);
            });
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
        
        // Calculate updated statistics
        $stats = [
            'total' => AdoptionApplication::count(),
            'pending' => AdoptionApplication::where('status', 'pending')->count(),
            'approved' => AdoptionApplication::where('status', 'approved')->count(),
            'rejected' => AdoptionApplication::where('status', 'rejected')->count(),
            'this_month' => AdoptionApplication::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count()
        ];

        return response()->json([
            'success' => true,
            'applications' => $applications->items(),
            'pagination' => [
                'current_page' => $applications->currentPage(),
                'last_page' => $applications->lastPage(),
                'per_page' => $applications->perPage(),
                'total' => $applications->total(),
                'from' => $applications->firstItem(),
                'to' => $applications->lastItem(),
            ],
            'stats' => $stats,
            'html' => view('admin.applications.partials.table-rows', compact('applications'))->render()
        ]);
    }

    public function export(Request $request)
    {
        $query = AdoptionApplication::with(['pet.images']); // Eager load pet and its images
        
        // Filter by shelter location if user has one assigned
        $user = auth()->user();
        if ($user->hasShelterLocation()) {
            $query->whereHas('pet', function($petQuery) use ($user) {
                $petQuery->where('location', $user->shelter_location);
            });
        }

        // Apply the same filters as the main index
        if ($request->has('status') && $request->get('status') !== '') {
            $query->where('status', $request->get('status'));
        }
        
        if ($request->has('pet_type') && $request->get('pet_type') !== '') {
            $petType = $request->get('pet_type');
            $query->whereHas('pet', function($petQuery) use ($petType) {
                $petQuery->where('type', $petType);
            });
        }
        
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

        // Get all applications (no pagination for export)
        $applications = $query->orderBy('created_at', 'desc')->get();

        // Create CSV content
        $csvData = [];
        
        // Add headers
        $csvData[] = [
            'Application ID',
            'Applicant Name',
            'Email',
            'Phone',
            'Pet Name',
            'Pet Type',
            'Status',
            'Date Applied',
            'Address',
            'Birth Date',
            'Occupation'
        ];

        // Add data rows
        foreach ($applications as $application) {
            $csvData[] = [
                $application->id,
                $application->first_name . ' ' . $application->last_name,
                $application->email,
                $application->phone,
                $application->pet ? $application->pet->name : 'N/A',
                $application->pet ? ucfirst($application->pet->type) : 'N/A',
                ucfirst($application->status),
                $application->created_at->format('M d, Y'),
                $application->address,
                $application->birth_date,
                $application->occupation
            ];
        }

        // Generate CSV
        $filename = 'adoption_applications_' . date('Y-m-d_His') . '.csv';
        
        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
