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

        return view('admin.system.dashboard', compact(
            'totalAdmins',
            'systemAdmins',
            'shelterAdmins',
            'totalPets'
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['system_admin', 'shelter_admin'])],
        ];

        // Add shelter_location validation only for shelter admins
        if ($request->role === 'shelter_admin') {
            $rules['shelter_location'] = ['required', 'string', Rule::in(User::getShelterLocations())];
        }

        $validated = $request->validate($rules);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_admin' => true,
            'email_verified_at' => now(),
        ];

        // Add shelter_location for shelter admins
        if ($validated['role'] === 'shelter_admin' && isset($validated['shelter_location'])) {
            $userData['shelter_location'] = $validated['shelter_location'];
        }

        $user = User::create($userData);

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
        // Shelter Capacities (group pets by location)
        $shelterCapacities = Pet::selectRaw('location, COUNT(*) as current, location as shelter_name')
            ->whereNotNull('location')
            ->groupBy('location')
            ->get()
            ->map(function($shelter) {
                // Define max capacities for each shelter (you can adjust these or store in DB)
                $maxCapacities = [
                    'Malabon' => 18, 'Muntinlupa' => 18, 'Taguig' => 30, 'Manila' => 30,
                    'Quezon City' => 40, 'Caloocan' => 25, 'Las Piñas' => 20, 'Makati' => 25,
                    'Mandaluyong' => 22, 'Marikina' => 20, 'Navotas' => 16, 'Parañaque' => 24,
                    'Pasay' => 20, 'Pasig' => 28, 'San Juan' => 26, 'Valenzuela' => 20
                ];
                
                $maximum = $maxCapacities[$shelter->location] ?? 20;
                $percentFull = $shelter->current > 0 ? round(($shelter->current / $maximum) * 100) : 0;
                
                return [
                    'shelter' => $shelter->location . ' Shelter',
                    'current' => $shelter->current,
                    'maximum' => $maximum,
                    'percent_full' => $percentFull,
                    'status' => $percentFull >= 80 ? 'Critical' : ($percentFull >= 50 ? 'High' : 'Normal')
                ];
            });

        // Current Capacity
        $totalPets = Pet::where('is_available', true)->count();
        $totalCapacity = 382; // Total across all shelters
        $percentFilled = $totalPets > 0 ? round(($totalPets / $totalCapacity) * 100, 1) : 0;
        $dogCount = Pet::where('is_available', true)->where('type', 'dog')->count();
        $catCount = Pet::where('is_available', true)->where('type', 'cat')->count();

        // At-Risk Pets (7+ days in shelter)
        $atRiskPets = Pet::where('is_available', true)
            ->whereRaw('DATEDIFF(NOW(), date_added) >= 7')
            ->with(['adoptionApplications' => function($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->map(function($pet) {
                $daysInShelter = $pet->days_in_shelter;
                return [
                    'name' => $pet->name,
                    'type' => ucfirst($pet->type),
                    'days_in_shelter' => $daysInShelter,
                    'status' => $daysInShelter >= 30 ? 'Long stay (legacy)' : 'Needs attention'
                ];
            });

        // Lives Saved (Adoptions)
        $totalAdoptions = AdoptionApplication::where('status', 'approved')->count();
        $approvedApplications = AdoptionApplication::where('status', 'approved')->count();

        // Pet Status Distribution
        $petStatusDistribution = [
            ['status' => 'Available', 'count' => Pet::where('is_available', true)->count(), 'color' => '#10b981'],
            ['status' => 'On Hold', 'count' => AdoptionApplication::where('status', 'pending')->distinct('pet_id')->count(), 'color' => '#f59e0b'],
            ['status' => 'Adopted', 'count' => Pet::where('is_available', false)->count(), 'color' => '#3b82f6']
        ];

        // Application Status
        $applicationStatus = [
            ['status' => 'Pending Review', 'count' => AdoptionApplication::where('status', 'pending')->count(), 'color' => '#f59e0b'],
            ['status' => 'Approved', 'count' => AdoptionApplication::where('status', 'approved')->count(), 'color' => '#10b981'],
            ['status' => 'Rejected', 'count' => AdoptionApplication::where('status', 'rejected')->count(), 'color' => '#ef4444']
        ];

        // Adoption Rate
        $totalApps = AdoptionApplication::count();
        $adoptedCount = Pet::where('is_available', false)->count();
        $adoptionRate = $totalApps > 0 ? round(($adoptedCount / $totalApps) * 100) : 0;

        // Length of Stay Distribution
        $lengthOfStayDistribution = [
            ['range' => '0-7 days', 'count' => Pet::where('is_available', true)
                ->where(function($query) {
                    $query->whereRaw('DATEDIFF(NOW(), date_added) BETWEEN 0 AND 7');
                })
                ->count()],
            ['range' => '1-4 weeks', 'count' => Pet::where('is_available', true)
                ->where(function($query) {
                    $query->whereRaw('DATEDIFF(NOW(), date_added) BETWEEN 8 AND 28');
                })
                ->count()],
            ['range' => '1-3 months', 'count' => Pet::where('is_available', true)
                ->where(function($query) {
                    $query->whereRaw('DATEDIFF(NOW(), date_added) BETWEEN 29 AND 90');
                })
                ->count()],
            ['range' => '3-6 months', 'count' => Pet::where('is_available', true)
                ->where(function($query) {
                    $query->whereRaw('DATEDIFF(NOW(), date_added) BETWEEN 91 AND 180');
                })
                ->count()],
            ['range' => '6+ months', 'count' => Pet::where('is_available', true)
                ->where(function($query) {
                    $query->whereRaw('DATEDIFF(NOW(), date_added) > 180');
                })
                ->count()]
        ];

        // Adoption vs Intake Trends (real monthly data from database)
        $adoptionIntakeTrends = [];
        
        // Get data for the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            // Count intakes (pets created in this month)
            $intakes = Pet::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            
            // Count adoptions (approved applications in this month)
            $adoptions = AdoptionApplication::where('status', 'approved')
                ->whereBetween('updated_at', [$monthStart, $monthEnd])
                ->count();
            
            $adoptionIntakeTrends[] = [
                'month' => $month->format('M Y'),
                'adoptions' => $adoptions,
                'intakes' => $intakes
            ];
        }

        return view('admin.system.analytics', compact(
            'shelterCapacities',
            'totalPets',
            'totalCapacity',
            'percentFilled',
            'dogCount',
            'catCount',
            'atRiskPets',
            'totalAdoptions',
            'approvedApplications',
            'petStatusDistribution',
            'applicationStatus',
            'adoptionRate',
            'adoptedCount',
            'totalApps',
            'lengthOfStayDistribution',
            'adoptionIntakeTrends'
        ));
    }

    /**
     * Export system analytics data as CSV
     */
    public function exportAnalytics()
    {
        // Gather all analytics data
        $shelterCapacities = [];
        $shelters = User::where('role', 'shelter_admin')
            ->whereNotNull('shelter_location')
            ->distinct()
            ->pluck('shelter_location');

        foreach ($shelters as $shelter) {
            $current = Pet::where('location', $shelter)
                ->where('is_available', true)
                ->count();
            
            $maximum = 100;
            $percentFull = $maximum > 0 ? round(($current / $maximum) * 100) : 0;
            
            $shelterCapacities[] = [
                'shelter' => $shelter,
                'current' => $current,
                'maximum' => $maximum,
                'percent_full' => $percentFull
            ];
        }

        // Get at-risk pets
        $atRiskPets = Pet::where('is_available', true)
            ->whereRaw('DATEDIFF(NOW(), COALESCE(date_entered_shelter, created_at)) >= 7')
            ->get()
            ->map(function($pet) {
                $enteredDate = $pet->date_entered_shelter ?? $pet->created_at;
                $daysInShelter = $enteredDate 
                    ? \Carbon\Carbon::parse($enteredDate)->diffInDays(now())
                    : 0;
                return [
                    'name' => $pet->name,
                    'type' => ucfirst($pet->type),
                    'location' => $pet->location,
                    'days_in_shelter' => $daysInShelter,
                    'status' => $daysInShelter >= 30 ? 'Long stay' : 'Needs attention'
                ];
            });

        // Get monthly trends for the last 12 months
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthStart = $month->copy()->startOfMonth();
            $monthEnd = $month->copy()->endOfMonth();
            
            $intakes = Pet::whereBetween('created_at', [$monthStart, $monthEnd])->count();
            $adoptions = AdoptionApplication::where('status', 'approved')
                ->whereBetween('updated_at', [$monthStart, $monthEnd])
                ->count();
            
            $monthlyData[] = [
                'month' => $month->format('M Y'),
                'intakes' => $intakes,
                'adoptions' => $adoptions
            ];
        }

        // Create CSV content
        $csvData = [];
        
        // Section 1: Shelter Capacities
        $csvData[] = ['SHELTER CAPACITIES'];
        $csvData[] = ['Shelter', 'Current', 'Maximum', 'Percent Full'];
        foreach ($shelterCapacities as $shelter) {
            $csvData[] = [
                $shelter['shelter'],
                $shelter['current'],
                $shelter['maximum'],
                $shelter['percent_full'] . '%'
            ];
        }
        $csvData[] = []; // Empty row

        // Section 2: Overall Statistics
        $csvData[] = ['OVERALL STATISTICS'];
        $csvData[] = ['Metric', 'Value'];
        $csvData[] = ['Total Pets', Pet::count()];
        $csvData[] = ['Available Pets', Pet::where('is_available', true)->count()];
        $csvData[] = ['Dogs', Pet::where('type', 'dog')->count()];
        $csvData[] = ['Cats', Pet::where('type', 'cat')->count()];
        $csvData[] = ['Total Adoptions', AdoptionApplication::where('status', 'approved')->count()];
        $csvData[] = ['Pending Applications', AdoptionApplication::where('status', 'pending')->count()];
        $csvData[] = ['Rejected Applications', AdoptionApplication::where('status', 'rejected')->count()];
        $csvData[] = []; // Empty row

        // Section 3: At-Risk Pets
        $csvData[] = ['AT-RISK PETS (7+ days in shelter)'];
        $csvData[] = ['Pet Name', 'Type', 'Location', 'Days in Shelter', 'Status'];
        foreach ($atRiskPets as $pet) {
            $csvData[] = [
                $pet['name'],
                $pet['type'],
                $pet['location'],
                $pet['days_in_shelter'],
                $pet['status']
            ];
        }
        $csvData[] = []; // Empty row

        // Section 4: Monthly Adoption vs Intake Trends
        $csvData[] = ['MONTHLY ADOPTION VS INTAKE TRENDS'];
        $csvData[] = ['Month', 'Intakes', 'Adoptions'];
        foreach ($monthlyData as $data) {
            $csvData[] = [
                $data['month'],
                $data['intakes'],
                $data['adoptions']
            ];
        }

        // Generate CSV
        $filename = 'system_analytics_' . date('Y-m-d_His') . '.csv';
        
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
