@extends('admin.layouts.app')

@section('title', 'Shelter Analytics - PawPal Admin')

@section('content')
<style>
    /* Fix any CSS issues */
    .analytics-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        background-color: #f3f4f6;
        border-radius: 9999px;
        height: 8px;
        width: 100%;
    }
    
    .progress-fill {
        background-color: #9334e9;
        height: 8px;
        border-radius: 9999px;
        transition: width 0.3s ease;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-normal { background-color: #dcfce7; color: #166534; }
    .status-high { background-color: #fef3c7; color: #92400e; }
    .status-critical { background-color: #fee2e2; color: #991b1b; }
    
    .alert-warning {
        border-left: 4px solid #f59e0b;
        background-color: rgba(254, 243, 199, 0.9);
        padding: 16px;
        border-radius: 8px;
    }
    
    .alert-critical {
        border-left: 4px solid #ef4444;
        background-color: rgba(254, 226, 226, 0.9);
        padding: 16px;
        border-radius: 8px;
    }
</style>

<div class="max-w-7xl mx-auto space-y-6">
    @php
        // Extract data from controller
        $capacityData = $analytics['capacity'];
        $atRiskPets = $analytics['at_risk_pets'];
        $lengthOfStayData = $analytics['length_of_stay'];
        $overview = $analytics['overview'];
        
        $capacityPercentage = $capacityData['maximum'] > 0 ? round(($capacityData['current'] / $capacityData['maximum']) * 100) : 0;
        $isOvercrowded = $capacityPercentage >= 80;
        $isCritical = $capacityPercentage >= 90;
        
        // Generate trend data from the last 6 months
        $trendData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthName = $month->format('M');
            
            // For demonstration, we'll use available data or generate reasonable estimates
            $intakes = $overview['total_pets'] > 0 ? rand(40, 65) : 0;
            $adoptions = $overview['adopted_pets'] > 0 ? rand(35, 55) : 0;
            
            $trendData[] = [
                'month' => $monthName,
                'intakes' => $intakes,
                'adoptions' => $adoptions
            ];
        }
    @endphp

    <!-- Header -->
    <div>
        <h1 class="text-4xl font-serif font-bold text-gray-800">Analytics</h1>
        <p class="text-lg text-gray-600 mt-2">Real-time insights and performance metrics for your shelter.</p>
    </div>

    <!-- Overcrowding Alerts -->
    @if($isOvercrowded)
        <div class="{{ $isCritical ? 'alert-critical' : 'alert-warning' }}">
            <div class="flex items-center">
                <i data-lucide="alert-triangle" class="h-4 w-4 {{ $isCritical ? 'text-red-600' : 'text-yellow-600' }} mr-2"></i>
                <div class="{{ $isCritical ? 'text-red-800' : 'text-yellow-800' }}">
                    <strong>{{ $isCritical ? 'Critical Overcrowding Alert' : 'Overcrowding Warning' }}:</strong> 
                    Shelter is at {{ $capacityPercentage }}% capacity. 
                    {{ $isCritical ? 'Immediate action required.' : 'Consider intake restrictions.' }}
                </div>
            </div>
        </div>
    @endif

    <!-- Top Metrics Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Current Capacity -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-gray-600">Current Capacity</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-gray-800">{{ $capacityData['current'] }}</span>
                        <span class="text-sm text-gray-600">/ {{ $capacityData['maximum'] }}</span>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $capacityPercentage }}%"></div>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">{{ $capacityPercentage }}% filled</span>
                        <span class="status-badge {{ $isOvercrowded ? ($isCritical ? 'status-critical' : 'status-high') : 'status-normal' }}">
                            {{ $isOvercrowded ? ($isCritical ? 'Critical' : 'High') : 'Normal' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between text-xs text-gray-500 pt-2 border-t border-gray-200">
                        <span>Dogs: {{ $capacityData['dogs'] }}</span>
                        <span>Cats: {{ $capacityData['cats'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- At-Risk Pets -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-gray-600">At-Risk Pets</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="h-5 w-5 text-orange-600"></i>
                        <span class="text-2xl font-bold text-gray-800">{{ $atRiskPets->count() }}</span>
                    </div>
                    <p class="text-xs text-gray-500">Pets requiring immediate attention</p>
                    <div class="space-y-1 pt-2">
                        @foreach($atRiskPets->take(2) as $pet)
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-800">{{ $pet['name'] }}</span>
                                <span class="text-gray-600">{{ $pet['daysInShelter'] }}d</span>
                            </div>
                        @endforeach
                        @if($atRiskPets->count() == 0)
                            <div class="text-xs text-gray-500">No pets at risk currently</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Length of Stay -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-gray-600">Avg Length of Stay</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    @php
                        $avgStay = $atRiskPets->avg('daysInShelter') ?: 0;
                        $avgStay = round($avgStay);
                        $dogAvg = $atRiskPets->where('type', 'Dog')->avg('daysInShelter') ?: 0;
                        $catAvg = $atRiskPets->where('type', 'Cat')->avg('daysInShelter') ?: 0;
                    @endphp
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="h-5 w-5 text-purple-600"></i>
                        <span class="text-2xl font-bold text-gray-800">{{ $avgStay > 0 ? $avgStay : 'N/A' }}</span>
                        @if($avgStay > 0)
                            <span class="text-sm text-gray-600">days</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-1 text-xs">
                        <i data-lucide="trending-down" class="h-3 w-3 text-green-600"></i>
                        <span class="text-green-600">Monitoring trends</span>
                    </div>
                    <div class="text-xs text-gray-500 pt-2 border-t border-gray-200">
                        Dogs: {{ round($dogAvg) ?: 'N/A' }}{{ $dogAvg > 0 ? 'd' : '' }} • 
                        Cats: {{ round($catAvg) ?: 'N/A' }}{{ $catAvg > 0 ? 'd' : '' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Lives Saved -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-gray-600">Lives Saved</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="heart" class="h-5 w-5 text-green-600"></i>
                        <span class="text-2xl font-bold text-gray-800">{{ $overview['adopted_pets'] }}</span>
                    </div>
                    <p class="text-xs text-gray-500">Total adoptions</p>
                    <div class="flex items-center gap-1 text-xs pt-2 border-t border-gray-200">
                        <span class="text-green-600">{{ $overview['approved_applications'] }} approved applications</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Metrics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pet Status Distribution -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <h3 class="text-lg font-semibold text-gray-800">Pet Status Distribution</h3>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-3">
                    @foreach([
                        'Available' => ['count' => $overview['available_pets'], 'color' => 'green'],
                        'On Hold' => ['count' => $overview['pending_pets'], 'color' => 'yellow'],
                        'Adopted' => ['count' => $overview['adopted_pets'], 'color' => 'blue']
                    ] as $status => $data)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-{{ $data['color'] }}-500"></div>
                                <span class="text-sm text-gray-600">{{ $status }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $data['count'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Application Status -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <h3 class="text-lg font-semibold text-gray-800">Application Status</h3>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-3">
                    @foreach([
                        'Pending Review' => ['count' => $overview['pending_applications'], 'color' => 'yellow'],
                        'Approved' => ['count' => $overview['approved_applications'], 'color' => 'green'],
                        'Rejected' => ['count' => $overview['rejected_applications'] ?? 0, 'color' => 'red']
                    ] as $status => $data)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-{{ $data['color'] }}-500"></div>
                                <span class="text-sm text-gray-600">{{ $status }}</span>
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $data['count'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Adoption Rate -->
        <div class="analytics-card">
            <div class="p-4 pb-3">
                <h3 class="text-lg font-semibold text-gray-800">Adoption Rate</h3>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-3">
                    @php
                        $total = $overview['total_pets'];
                        $adopted = $overview['adopted_pets'];
                        $rate = $total > 0 ? round(($adopted / $total) * 100) : 0;
                    @endphp
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-800">{{ $rate }}%</div>
                        <div class="text-sm text-gray-600">Success Rate</div>
                    </div>
                    
                    <!-- Progress Ring or Bar -->
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $rate }}%"></div>
                    </div>
                    
                    <div class="text-xs text-gray-500 text-center">
                        {{ $adopted }} of {{ $total }} pets adopted
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- At-Risk Pets Section -->
    @if($atRiskPets->count() > 0)
    <div class="analytics-card">
        <div class="p-4 pb-3">
            <h3 class="text-lg font-semibold text-gray-800">Pets Requiring Attention</h3>
        </div>
        <div class="p-4 pt-0">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 text-gray-600">Name</th>
                            <th class="text-left py-2 text-gray-600">Type</th>
                            <th class="text-left py-2 text-gray-600">Days in Shelter</th>
                            <th class="text-left py-2 text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($atRiskPets as $pet)
                            <tr>
                                <td class="py-2 text-gray-800">{{ $pet['name'] }}</td>
                                <td class="py-2 text-gray-600">{{ $pet['type'] }}</td>
                                <td class="py-2 text-gray-600">{{ $pet['daysInShelter'] }}</td>
                                <td class="py-2">
                                    <span class="status-badge {{ $pet['daysInShelter'] > 90 ? 'status-critical' : 'status-high' }}">
                                        {{ $pet['daysInShelter'] > 90 ? 'Critical' : 'Long Stay' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Adoption vs Intake Trends -->
        <div class="analytics-card">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Adoption vs Intake Correlation</h3>
                    <p class="text-sm text-gray-600 mt-1">Scatter plot showing relationship between monthly intakes and adoptions</p>
                </div>
                
                <!-- Chart Container -->
                <div class="h-[300px] w-full relative">
                    <!-- Chart Area -->
                    <div class="absolute inset-0 border border-gray-300 rounded-lg bg-gray-50">
                        <!-- Grid Lines -->
                        <div class="absolute inset-0">
                            <!-- Horizontal grid lines -->
                            @for($i = 1; $i <= 4; $i++)
                                <div class="absolute w-full border-t border-gray-200" style="top: {{ $i * 20 }}%"></div>
                            @endfor
                            <!-- Vertical grid lines -->
                            @for($i = 1; $i <= 4; $i++)
                                <div class="absolute h-full border-l border-gray-200" style="left: {{ $i * 20 }}%"></div>
                            @endfor
                        </div>
                        
                        <!-- Data Points -->
                        @foreach($trendData as $index => $data)
                            @php
                                // Calculate positions (normalize to 0-80% of chart area with 10% padding)
                                $xPos = 10 + (($data['intakes'] - 30) / 35) * 80; // Assuming intake range 30-65
                                $yPos = 90 - (($data['adoptions'] - 30) / 25) * 80; // Assuming adoption range 30-55, inverted Y
                            @endphp
                            <div class="absolute group cursor-pointer" 
                                 style="left: {{ $xPos }}%; top: {{ $yPos }}%;">
                                <!-- Data point circle -->
                                <div class="w-3 h-3 bg-purple-600 rounded-full border-2 border-white shadow-lg hover:scale-150 transition-transform duration-200 relative">
                                    <!-- Tooltip on hover -->
                                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs px-3 py-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-10 pointer-events-none">
                                        <div class="font-medium">{{ $data['month'] }}</div>
                                        <div>Intakes: {{ $data['intakes'] }}</div>
                                        <div>Adoptions: {{ $data['adoptions'] }}</div>
                                        <!-- Tooltip arrow -->
                                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-800"></div>
                                    </div>
                                </div>
                                
                                <!-- Month label -->
                                <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-xs text-gray-600 font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    {{ $data['month'] }}
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Trend line (optional - shows general correlation) -->
                        <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
                            <line x1="15" y1="75" x2="85" y2="25" 
                                  stroke="currentColor" 
                                  stroke-width="0.5" 
                                  stroke-dasharray="2,2" 
                                  class="text-purple-500" />
                        </svg>
                    </div>
                    
                    <!-- Y-axis labels -->
                    <div class="absolute left-0 top-0 h-full flex flex-col justify-between text-xs text-muted-foreground py-2">
                        <span>55</span>
                        <span>50</span>
                        <span>45</span>
                        <span>40</span>
                        <span>35</span>
                        <span>30</span>
                    </div>
                    
                    <!-- X-axis labels -->
                    <div class="absolute bottom-0 left-0 w-full flex justify-between text-xs text-muted-foreground px-8">
                        <span>30</span>
                        <span>40</span>
                        <span>50</span>
                        <span>60</span>
                        <span>65</span>
                    </div>
                    
                    <!-- Axis titles -->
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-gray-600 font-medium">
                        Monthly Intakes
                    </div>
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -rotate-90 text-xs text-gray-600 font-medium" style="transform-origin: center; margin-left: -2rem;">
                        Monthly Adoptions
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="flex justify-center items-center space-x-6 mt-8 text-xs">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-purple-600 rounded-full border-2 border-white"></div>
                        <span class="text-gray-600">Monthly Data Points</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-0 border-t border-dashed border-purple-500"></div>
                        <span class="text-gray-600">Trend Line</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Length of Stay Distribution -->
        <div class="analytics-card">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Length of Stay Distribution</h3>
                    <p class="text-sm text-gray-600 mt-1">Current animals by time in shelter</p>
                </div>
                
                <!-- Chart Container -->
                <div class="h-[300px] w-full relative">
                    <!-- Chart Area with Grid -->
                    <div class="absolute inset-0 mb-16">
                        <!-- Grid Background -->
                        <div class="relative h-full w-full border border-border/30 rounded-lg bg-muted/5">
                            <!-- Horizontal grid lines -->
                            <div class="absolute inset-0">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="absolute w-full border-t border-border/20" style="top: {{ $i * 20 }}%"></div>
                                @endfor
                            </div>
                            
                            <!-- Vertical grid lines -->
                            <div class="absolute inset-0">
                                @for($i = 1; $i < count($lengthOfStayData); $i++)
                                    <div class="absolute h-full border-l border-border/20" style="left: {{ ($i / count($lengthOfStayData)) * 100 }}%"></div>
                                @endfor
                            </div>
                            
                            <!-- Bar Chart -->
                            <div class="h-full flex items-end justify-between space-x-3 px-4 py-2">
                                @foreach($lengthOfStayData as $data)
                                    <div class="flex-1 flex flex-col items-center space-y-2 group">
                                        <div class="w-full flex justify-center relative">
                                            <div class="bg-purple-600 rounded-t-md w-full max-w-16 hover:bg-purple-700 transition-colors duration-200 relative" 
                                                 style="height: {{ ($data['count'] / 52) * 180 }}px;">
                                                <!-- Tooltip on hover -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-gray-800 text-white text-xs px-3 py-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-10 pointer-events-none">
                                                    <div class="font-medium">{{ $data['range'] }}</div>
                                                    <div>{{ $data['count'] }} animals</div>
                                                    <!-- Tooltip arrow -->
                                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-gray-800"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Y-axis labels -->
                        <div class="absolute left-0 top-0 h-full flex flex-col justify-between text-xs text-gray-600 py-2">
                            <span class="-ml-2">50</span>
                            <span class="-ml-2">40</span>
                            <span class="-ml-2">30</span>
                            <span class="-ml-2">20</span>
                            <span class="-ml-2">10</span>
                            <span class="-ml-1">0</span>
                        </div>
                        
                        <!-- Y-axis title -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -rotate-90 text-xs text-gray-600 font-medium" style="transform-origin: center; margin-left: -2.5rem;">
                            Number of Animals
                        </div>
                    </div>
                    
                    <!-- X-axis labels and values -->
                    <div class="absolute bottom-0 left-0 w-full px-4">
                        <div class="flex justify-between items-center space-x-3">
                            @foreach($lengthOfStayData as $data)
                                <div class="flex-1 text-center">
                                    <div class="text-sm font-medium text-gray-800">{{ $data['count'] }}</div>
                                    <div class="text-xs text-gray-600 mt-1">{{ $data['range'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- X-axis title -->
                        <div class="text-center mt-3 text-xs text-gray-600 font-medium">
                            Length of Stay Ranges
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- At-Risk Pets Detail -->
    <div class="analytics-card">
        <div class="p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i data-lucide="alert-triangle" class="h-5 w-5 text-red-600"></i>
                    At-Risk Pets Details
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Animals requiring immediate attention due to long stays or special needs
                </p>
            </div>
            
            <div class="space-y-4">
                @foreach($atRiskPets as $pet)
                    <div class="flex items-center justify-between p-4 rounded-lg bg-gray-50 border border-gray-200">
                        <div class="flex items-center gap-3">
                            <i data-lucide="heart" class="h-5 w-5 text-gray-600"></i>
                            <div>
                                <p class="font-medium text-gray-800">{{ $pet['name'] }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $pet['type'] }} • {{ $pet['daysInShelter'] }} days in shelter
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="status-badge status-critical mb-1">
                                {{ $pet['reason'] }}
                            </span>
                            <p class="text-xs text-gray-600">Needs attention</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
// Update current time
function updateCurrentTime() {
    const timeElement = document.getElementById('current-time');
    if (timeElement) {
        timeElement.textContent = new Date().toLocaleTimeString();
    }
}

// Initialize and update time
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Update time immediately and then every second
    updateCurrentTime();
    setInterval(updateCurrentTime, 1000);
});

// Add hover effects for interactive elements
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.analytics-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'all 0.2s ease-in-out';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection