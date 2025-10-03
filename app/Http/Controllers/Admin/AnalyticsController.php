<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\AdoptionApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        try {
            $analytics = [
                'overview' => $this->getOverviewStats(),
                'capacity' => $this->getCapacityData(),
                'at_risk_pets' => $this->getAtRiskPets(),
                'adoption_trends' => $this->getAdoptionTrends(),
                'length_of_stay' => $this->getLengthOfStayData(),
                'pet_types' => $this->getPetTypeStats(),
                'application_status' => $this->getApplicationStatusStats(),
                'monthly_registrations' => $this->getMonthlyRegistrations(),
                'popular_breeds' => $this->getPopularBreeds(),
            ];
        } catch (\Exception $e) {
            // Fallback data if there are any database issues
            $analytics = [
                'overview' => [
                    'total_pets' => 0,
                    'available_pets' => 0,
                    'adopted_pets' => 0,
                    'pending_pets' => 0,
                    'total_applications' => 0,
                    'pending_applications' => 0,
                    'approved_applications' => 0,
                    'rejected_applications' => 0,
                    'total_users' => 0,
                    'adoption_rate' => 0,
                ],
                'capacity' => [
                    'current' => 0,
                    'maximum' => 100,
                    'dogs' => 0,
                    'cats' => 0,
                ],
                'at_risk_pets' => collect([]),
                'adoption_trends' => collect([]),
                'length_of_stay' => collect([]),
                'pet_types' => collect([]),
                'application_status' => collect([]),
                'monthly_registrations' => collect([]),
                'popular_breeds' => collect([]),
            ];
        }

        return view('admin.analytics.index', compact('analytics'));
    }

    private function getOverviewStats()
    {
        try {
            return [
                'total_pets' => Pet::count() ?: 0,
                'available_pets' => Pet::where('is_available', true)->count() ?: 0,
                'adopted_pets' => Pet::where('is_available', false)->count() ?: 0,
                'pending_pets' => Pet::where('is_available', true)->count() ?: 0, // Available pets that could be adopted
                'total_applications' => AdoptionApplication::count() ?: 0,
                'pending_applications' => AdoptionApplication::where('status', 'pending')->count() ?: 0,
                'approved_applications' => AdoptionApplication::where('status', 'approved')->count() ?: 0,
                'rejected_applications' => AdoptionApplication::where('status', 'rejected')->count() ?: 0,
                'total_users' => User::where('is_admin', false)->count() ?: 0,
                'adoption_rate' => $this->calculateAdoptionRate(),
            ];
        } catch (\Exception $e) {
            return [
                'total_pets' => 0,
                'available_pets' => 0,
                'adopted_pets' => 0,
                'pending_pets' => 0,
                'total_applications' => 0,
                'pending_applications' => 0,
                'approved_applications' => 0,
                'rejected_applications' => 0,
                'total_users' => 0,
                'adoption_rate' => 0,
            ];
        }
    }

    private function calculateAdoptionRate()
    {
        $totalPets = Pet::count();
        $adoptedPets = Pet::where('is_available', false)->count();
        
        return $totalPets > 0 ? round(($adoptedPets / $totalPets) * 100, 2) : 0;
    }

    private function getAdoptionTrends()
    {
        try {
            return AdoptionApplication::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getPetTypeStats()
    {
        try {
            return Pet::select('type', DB::raw('COUNT(*) as count'))
                ->groupBy('type')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getApplicationStatusStats()
    {
        try {
            return AdoptionApplication::select('status', DB::raw('COUNT(*) as count'))
                ->groupBy('status')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getMonthlyRegistrations()
    {
        return User::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('is_admin', false)
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
    }

    private function getPopularBreeds()
    {
        return Pet::select('breed', DB::raw('COUNT(*) as count'))
            ->whereNotNull('breed')
            ->groupBy('breed')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
    }

    private function getCapacityData()
    {
        try {
            $totalPets = Pet::where('is_available', true)->count();
            $dogs = Pet::where('is_available', true)->where('type', 'Dog')->count();
            $cats = Pet::where('is_available', true)->where('type', 'Cat')->count();
            
            // Default maximum capacity - this could be configurable
            $maxCapacity = 180;
            
            return [
                'current' => $totalPets,
                'maximum' => $maxCapacity,
                'dogs' => $dogs,
                'cats' => $cats,
            ];
        } catch (\Exception $e) {
            return [
                'current' => 0,
                'maximum' => 100,
                'dogs' => 0,
                'cats' => 0,
            ];
        }
    }

    private function getAtRiskPets()
    {
        try {
            return Pet::select('name', 'type', 'created_at')
                ->where('is_available', true)
                ->where('created_at', '<=', now()->subDays(60)) // Pets in shelter for 60+ days
                ->orderBy('created_at', 'asc')
                ->take(10)
                ->get()
                ->map(function ($pet) {
                    $daysInShelter = now()->diffInDays($pet->created_at);
                    $reason = 'Long stay';
                    
                    if ($daysInShelter >= 120) {
                        $reason = 'Very long stay';
                    } elseif ($daysInShelter >= 90) {
                        $reason = 'Long stay';
                    } else {
                        $reason = 'Moderate stay';
                    }
                    
                    return [
                        'name' => $pet->name,
                        'type' => $pet->type,
                        'daysInShelter' => $daysInShelter,
                        'reason' => $reason,
                    ];
                });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getLengthOfStayData()
    {
        try {
            $pets = Pet::where('is_available', true)->get();
            
            $ranges = [
                '0-7 days' => 0,
                '1-4 weeks' => 0,
                '1-3 months' => 0,
                '3-6 months' => 0,
                '6+ months' => 0,
            ];
            
            foreach ($pets as $pet) {
                $days = now()->diffInDays($pet->created_at);
                
                if ($days <= 7) {
                    $ranges['0-7 days']++;
                } elseif ($days <= 30) {
                    $ranges['1-4 weeks']++;
                } elseif ($days <= 90) {
                    $ranges['1-3 months']++;
                } elseif ($days <= 180) {
                    $ranges['3-6 months']++;
                } else {
                    $ranges['6+ months']++;
                }
            }
            
            return collect($ranges)->map(function ($count, $range) {
                return ['range' => $range, 'count' => $count];
            })->values();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'applications');
        
        switch ($type) {
            case 'applications':
                return $this->exportApplications();
            case 'pets':
                return $this->exportPets();
            case 'users':
                return $this->exportUsers();
            default:
                return redirect()->back()->with('error', 'Invalid export type');
        }
    }

    private function exportApplications()
    {
        $applications = AdoptionApplication::with(['user', 'pet'])->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="adoption_applications.csv"',
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'User Name', 'User Email', 'Pet Name', 'Pet Type', 'Status', 'Applied Date', 'Reviewed Date']);

            foreach ($applications as $application) {
                fputcsv($file, [
                    $application->id,
                    $application->user->name,
                    $application->user->email,
                    $application->pet->name,
                    $application->pet->type,
                    $application->status,
                    $application->created_at->format('Y-m-d H:i:s'),
                    $application->reviewed_at ? $application->reviewed_at->format('Y-m-d H:i:s') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPets()
    {
        $pets = Pet::all();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pets.csv"',
        ];

        $callback = function() use ($pets) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Type', 'Breed', 'Age', 'Gender', 'Size', 'Available', 'Adoption Fee', 'Created Date']);

            foreach ($pets as $pet) {
                fputcsv($file, [
                    $pet->id,
                    $pet->name,
                    $pet->type,
                    $pet->breed,
                    $pet->age,
                    $pet->gender,
                    $pet->size,
                    $pet->is_available ? 'Yes' : 'No',
                    $pet->adoption_fee,
                    $pet->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportUsers()
    {
        $users = User::where('is_admin', false)->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Email Verified', 'Registered Date']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->email_verified_at ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}