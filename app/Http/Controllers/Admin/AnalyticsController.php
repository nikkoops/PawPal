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
    // Store the current user's shelter location for filtering
    protected $userLocation = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = auth()->user();
            if ($user && $user->hasShelterLocation()) {
                $this->userLocation = $user->shelter_location;
            }
            return $next($request);
        });
    }

    public function index()
    {
        try {
            $analytics = [
                'overview' => $this->getOverviewStats(),
                'capacity' => $this->getCapacityData(),
                // Per-location capacity information
                'location_capacity' => $this->getLocationCapacityData(),
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
            $petQuery = $this->applyLocationFilter(Pet::query());
            $applicationQuery = $this->applyLocationFilterToApplications(AdoptionApplication::query());

            return [
                'total_pets' => (clone $petQuery)->count() ?: 0,
                'available_pets' => (clone $petQuery)->where('is_available', true)->count() ?: 0,
                'adopted_pets' => (clone $petQuery)->where('is_available', false)->count() ?: 0,
                'pending_pets' => (clone $petQuery)->where('is_available', true)->count() ?: 0, // Available pets that could be adopted
                'total_applications' => (clone $applicationQuery)->count() ?: 0,
                'pending_applications' => (clone $applicationQuery)->where('status', 'pending')->count() ?: 0,
                'approved_applications' => (clone $applicationQuery)->where('status', 'approved')->count() ?: 0,
                'rejected_applications' => (clone $applicationQuery)->where('status', 'rejected')->count() ?: 0,
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

    /**
     * Apply location filter to Pet queries
     */
    private function applyLocationFilter($query)
    {
        if ($this->userLocation) {
            return $query->where('location', $this->userLocation);
        }
        return $query;
    }

    /**
     * Apply location filter to AdoptionApplication queries
     */
    private function applyLocationFilterToApplications($query)
    {
        if ($this->userLocation) {
            return $query->whereHas('pet', function($q) {
                $q->where('location', $this->userLocation);
            });
        }
        return $query;
    }

    private function calculateAdoptionRate()
    {
        $petQuery = $this->applyLocationFilter(Pet::query());
        $totalPets = $petQuery->count();
        $adoptedPets = (clone $petQuery)->where('is_available', false)->count();
        
        return $totalPets > 0 ? round(($adoptedPets / $totalPets) * 100, 2) : 0;
    }

    private function getAdoptionTrends()
    {
        try {
            $query = $this->applyLocationFilterToApplications(AdoptionApplication::query());
            return $query->select(
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
            $query = $this->applyLocationFilter(Pet::query());
            return $query->select('type', DB::raw('COUNT(*) as count'))
                ->groupBy('type')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getApplicationStatusStats()
    {
        try {
            $query = $this->applyLocationFilterToApplications(AdoptionApplication::query());
            return $query->select('status', DB::raw('COUNT(*) as count'))
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
        $query = $this->applyLocationFilter(Pet::query());
        return $query->select('breed', DB::raw('COUNT(*) as count'))
            ->whereNotNull('breed')
            ->groupBy('breed')
            ->orderBy('count', 'desc')
            ->take(10)
            ->get();
    }

    private function getCapacityData()
    {
        try {
            $petQuery = $this->applyLocationFilter(Pet::query());
            $totalPets = (clone $petQuery)->where('is_available', true)->count();
            $dogs = (clone $petQuery)->where('is_available', true)->where('type', 'Dog')->count();
            $cats = (clone $petQuery)->where('is_available', true)->where('type', 'Cat')->count();
            
            // Derive maximum capacity from location capacities when possible
            $locationCaps = $this->getLocationCapacityData();
            $maxCapacity = $locationCaps->sum('maximum') ?: 180;
            
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

    /**
     * Get capacity breakdown per shelter/location.
     * Returns a collection of ['location' => string, 'current' => int, 'maximum' => int]
     */
    private function getLocationCapacityData()
    {
        try {
            // Current counts grouped by location for available pets
            $counts = Pet::where('is_available', true)
                ->select('location', DB::raw('COUNT(*) as current'))
                ->groupBy('location')
                ->orderBy('location')
                ->get()
                ->keyBy('location');

            // Canonical shelter list (exact names used in pet form) and capacity map
            $canonicalShelters = [
                'Manila Shelter',
                'Quezon City Shelter',
                'Caloocan Shelter',
                'Las Piñas Shelter',
                'Makati Shelter',
                'Malabon Shelter',
                'Mandaluyong Shelter',
                'Marikina Shelter',
                'Muntinlupa Shelter',
                'Navotas Shelter',
                'Parañaque Shelter',
                'Pasay Shelter',
                'Pasig Shelter',
                'San Juan Shelter',
                'Taguig Shelter',
                'Valenzuela Shelter',
            ];

            // Capacities per shelter (each between 15 and 40)
            $capacityMap = [
                'Manila Shelter' => 30,
                'Quezon City Shelter' => 40,
                'Caloocan Shelter' => 25,
                'Las Piñas Shelter' => 20,
                'Makati Shelter' => 25,
                'Malabon Shelter' => 18,
                'Mandaluyong Shelter' => 22,
                'Marikina Shelter' => 20,
                'Muntinlupa Shelter' => 18,
                'Navotas Shelter' => 16,
                'Parañaque Shelter' => 24,
                'Pasay Shelter' => 20,
                'Pasig Shelter' => 28,
                'San Juan Shelter' => 26,
                'Taguig Shelter' => 30,
                'Valenzuela Shelter' => 20,
            ];


            $locations = collect();

            // Normalize possible variants of location names to canonical forms.
            // This mapping helps convert values from the pet creation form / legacy data.
            $normalizeMap = [
                // Map common variants to canonical names
                'Quezon City' => 'Quezon City Shelter',
                'Quezon City Shelter' => 'Quezon City Shelter',
                'Quincy City Shelter' => 'Quezon City Shelter',
                'Taguig' => 'Taguig Shelter',
                'Taguig City Shelter' => 'Taguig Shelter',
                // Map 'Plaza City Shelter' to 'Pasig Shelter' or another canonical value if appropriate
                'Plaza City Shelter' => 'Pasig Shelter',
                'Manila Bay Shelter' => 'Manila Shelter',
                'San Juan City Shelter' => 'San Juan Shelter',
                'San Juan' => 'San Juan Shelter',
                'Mamallapuram Shelter' => 'Marikina Shelter',
                'Caboolture Animal Shelter' => 'Caloocan Shelter',
                // Add more variants as needed
            ];

            // Build a map of normalized current counts
            $normalizedCounts = [];
            foreach ($counts as $row) {
                $raw = trim($row->location ?: '');
                $normalized = $normalizeMap[$raw] ?? null;

                // If not in normalize map, try to match by substring or fallback
                if (!$normalized) {
                    // Try to find a canonical shelter that contains the raw city name
                    foreach ($canonicalShelters as $can) {
                        $cityPart = str_replace(' Shelter', '', $can);
                        if (strcasecmp($cityPart, $raw) === 0 || stripos($raw, $cityPart) !== false) {
                            $normalized = $can;
                            break;
                        }
                    }
                }

                // If still not found, default to raw plus ' Shelter' if it matches a known city
                if (!$normalized && $raw !== '') {
                    $maybe = $raw . ' Shelter';
                    if (in_array($maybe, $canonicalShelters)) {
                        $normalized = $maybe;
                    }
                }

                // Final fallback: ignore or put into 'Other' bucket (we'll keep as raw + ' Shelter')
                if (!$normalized) {
                    $normalized = $raw !== '' ? ($raw . ' Shelter') : 'Unknown Shelter';
                }

                if (!isset($normalizedCounts[$normalized])) {
                    $normalizedCounts[$normalized] = 0;
                }
                $normalizedCounts[$normalized] += (int) $row->current;
            }


            // Ensure all canonical shelters are present in output, compute percent, then sort by percent desc
            foreach ($canonicalShelters as $loc) {
                $current = $normalizedCounts[$loc] ?? 0;
                $maximum = isset($capacityMap[$loc]) ? (int) $capacityMap[$loc] : $defaultCapacity;
                $percent = $maximum > 0 ? round(($current / $maximum) * 100) : 0;

                $locations->push([
                    'location' => $loc,
                    'current' => $current,
                    'maximum' => $maximum,
                    'percent' => $percent,
                ]);
            }

            // Sort by percent descending
            $locations = $locations->sortByDesc('percent')->values();

            return $locations;
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getAtRiskPets()
    {
        try {
            $query = $this->applyLocationFilter(Pet::query());
            return $query->select('id', 'name', 'type', 'date_added', 'created_at')
                ->where('is_available', true)
                ->where(function ($query) {
                    // Include pets urgent based on date_added (7+ days)
                    $query->where('date_added', '<=', now()->subDays(7))
                          // Also include pets with old logic as fallback
                          ->orWhere(function ($subQuery) {
                              $subQuery->whereNull('date_added')
                                       ->where('created_at', '<=', now()->subDays(30));
                          });
                })
                ->orderByRaw('CASE WHEN date_added IS NOT NULL THEN date_added ELSE created_at END ASC')
                ->take(15) // Increased from 10 to show more urgent pets
                ->get()
                ->map(function ($pet) {
                    // Use date_added if available, otherwise fall back to created_at
                    $referenceDate = $pet->date_added ?: $pet->created_at;
                    $daysInShelter = floor(now()->diffInDays($referenceDate));
                    
                    // Determine reason based on urgency criteria
                    if ($pet->date_added && $daysInShelter >= 7) {
                        if ($daysInShelter >= 30) {
                            $reason = 'URGENT - Very long stay';
                        } elseif ($daysInShelter >= 14) {
                            $reason = 'URGENT - Extended stay';
                        } else {
                            $reason = 'URGENT - Needs priority';
                        }
                    } else {
                        $reason = 'Long stay (legacy)';
                    }
                    
                    return [
                        'id' => $pet->id,
                        'name' => $pet->name,
                        'type' => $pet->type,
                        'daysInShelter' => $daysInShelter,
                        'reason' => $reason,
                        'is_urgent' => $pet->date_added && $daysInShelter >= 7,
                    ];
                });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getLengthOfStayData()
    {
        try {
            $query = $this->applyLocationFilter(Pet::query());
            $pets = $query->where('is_available', true)->get();
            
            $ranges = [
                '0-7 days' => 0,
                '1-4 weeks' => 0,
                '1-3 months' => 0,
                '3-6 months' => 0,
                '6+ months' => 0,
            ];
            
            foreach ($pets as $pet) {
                $days = floor(now()->diffInDays($pet->created_at));
                
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
        $query = $this->applyLocationFilterToApplications(AdoptionApplication::query());
        $applications = $query->with(['user', 'pet'])->get();
        
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
        $query = $this->applyLocationFilter(Pet::query());
        $pets = $query->get();
        
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