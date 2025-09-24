@extends('admin.layouts.app')

@section('title', 'Shelter Analytics - PawPal Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    @php
        // Mock data for demonstration - in a real app, this would come from the controller
        $capacityData = [
            'current' => 142,
            'maximum' => 180,
            'dogs' => 89,
            'cats' => 53,
        ];
        
        $capacityPercentage = round(($capacityData['current'] / $capacityData['maximum']) * 100);
        $isOvercrowded = $capacityPercentage >= 80;
        $isCritical = $capacityPercentage >= 90;
        
        $atRiskPets = [
            ['name' => 'Bella', 'type' => 'Dog', 'daysInShelter' => 127, 'reason' => 'Long stay'],
            ['name' => 'Shadow', 'type' => 'Cat', 'daysInShelter' => 89, 'reason' => 'Medical needs'],
            ['name' => 'Max', 'type' => 'Dog', 'daysInShelter' => 156, 'reason' => 'Behavioral'],
            ['name' => 'Luna', 'type' => 'Cat', 'daysInShelter' => 98, 'reason' => 'Long stay'],
        ];
        
        $trendData = [
            ['month' => 'Jan', 'intakes' => 45, 'adoptions' => 38],
            ['month' => 'Feb', 'intakes' => 52, 'adoptions' => 41],
            ['month' => 'Mar', 'intakes' => 48, 'adoptions' => 45],
            ['month' => 'Apr', 'intakes' => 61, 'adoptions' => 39],
            ['month' => 'May', 'intakes' => 58, 'adoptions' => 52],
            ['month' => 'Jun', 'intakes' => 43, 'adoptions' => 48],
        ];
        
        $lengthOfStayData = [
            ['range' => '0-7 days', 'count' => 23],
            ['range' => '1-4 weeks', 'count' => 45],
            ['range' => '1-3 months', 'count' => 52],
            ['range' => '3-6 months', 'count' => 18],
            ['range' => '6+ months', 'count' => 4],
        ];
    @endphp

    <!-- Header -->
    <div>
        <h1 class="text-4xl font-serif font-bold text-foreground">Analytics</h1>
        <p class="text-lg text-muted-foreground mt-2">Real-time insights and performance metrics for your shelter.</p>
    </div>

    <!-- Overcrowding Alerts -->
    @if($isOvercrowded)
        <div class="border-l-4 p-4 rounded-lg {{ $isCritical ? 'border-l-red-500 bg-red-50/90' : 'border-l-yellow-500 bg-yellow-50/90' }} backdrop-blur-sm">
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
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-muted-foreground">Current Capacity</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-foreground">{{ $capacityData['current'] }}</span>
                        <span class="text-sm text-muted-foreground">/ {{ $capacityData['maximum'] }}</span>
                    </div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-muted rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full transition-all duration-300" style="width: {{ $capacityPercentage }}%"></div>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span class="text-muted-foreground">{{ $capacityPercentage }}% filled</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOvercrowded ? ($isCritical ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') : 'bg-green-100 text-green-800' }}">
                            {{ $isOvercrowded ? ($isCritical ? 'Critical' : 'High') : 'Normal' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between text-xs text-muted-foreground pt-2 border-t border-border">
                        <span>Dogs: {{ $capacityData['dogs'] }}</span>
                        <span>Cats: {{ $capacityData['cats'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- At-Risk Pets -->
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-muted-foreground">At-Risk Pets</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="h-5 w-5 text-red-600"></i>
                        <span class="text-2xl font-bold text-foreground">{{ count($atRiskPets) }}</span>
                    </div>
                    <p class="text-xs text-muted-foreground">Pets requiring immediate attention</p>
                    <div class="space-y-1 pt-2">
                        @foreach(array_slice($atRiskPets, 0, 2) as $pet)
                            <div class="flex justify-between text-xs">
                                <span class="text-foreground">{{ $pet['name'] }}</span>
                                <span class="text-muted-foreground">{{ $pet['daysInShelter'] }}d</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Length of Stay -->
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-muted-foreground">Avg Length of Stay</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="h-5 w-5 text-primary"></i>
                        <span class="text-2xl font-bold text-foreground">28</span>
                        <span class="text-sm text-muted-foreground">days</span>
                    </div>
                    <div class="flex items-center gap-1 text-xs">
                        <i data-lucide="trending-down" class="h-3 w-3 text-green-600"></i>
                        <span class="text-green-600">-3 days from last month</span>
                    </div>
                    <div class="text-xs text-muted-foreground pt-2 border-t border-border">Dogs: 32d • Cats: 24d</div>
                </div>
            </div>
        </div>

        <!-- Lives Saved -->
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-4 pb-3">
                <div class="text-sm font-medium text-muted-foreground">Lives Saved</div>
            </div>
            <div class="p-4 pt-0">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <i data-lucide="heart" class="h-5 w-5 text-green-600"></i>
                        <span class="text-2xl font-bold text-foreground">1,247</span>
                    </div>
                    <p class="text-xs text-muted-foreground">Adoptions this year</p>
                    <div class="flex items-center gap-1 text-xs pt-2 border-t border-border">
                        <span class="text-green-600">+156 this month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Adoption vs Intake Trends -->
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-foreground">Adoption vs Intake Correlation</h3>
                    <p class="text-sm text-muted-foreground mt-1">Scatter plot showing relationship between monthly intakes and adoptions</p>
                </div>
                
                <!-- Chart Container -->
                <div class="h-[300px] w-full relative">
                    <!-- Chart Area -->
                    <div class="absolute inset-0 border border-border/30 rounded-lg bg-muted/10">
                        <!-- Grid Lines -->
                        <div class="absolute inset-0">
                            <!-- Horizontal grid lines -->
                            @for($i = 1; $i <= 4; $i++)
                                <div class="absolute w-full border-t border-border/20" style="top: {{ $i * 20 }}%"></div>
                            @endfor
                            <!-- Vertical grid lines -->
                            @for($i = 1; $i <= 4; $i++)
                                <div class="absolute h-full border-l border-border/20" style="left: {{ $i * 20 }}%"></div>
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
                                <div class="w-3 h-3 bg-primary rounded-full border-2 border-white shadow-lg hover:scale-150 transition-transform duration-200 relative">
                                    <!-- Tooltip on hover -->
                                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-foreground text-background text-xs px-3 py-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-10 pointer-events-none">
                                        <div class="font-medium">{{ $data['month'] }}</div>
                                        <div>Intakes: {{ $data['intakes'] }}</div>
                                        <div>Adoptions: {{ $data['adoptions'] }}</div>
                                        <!-- Tooltip arrow -->
                                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-foreground"></div>
                                    </div>
                                </div>
                                
                                <!-- Month label -->
                                <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-xs text-muted-foreground font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-200">
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
                                  class="text-primary/50" />
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
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-xs text-muted-foreground font-medium">
                        Monthly Intakes
                    </div>
                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -rotate-90 text-xs text-muted-foreground font-medium" style="transform-origin: center; margin-left: -2rem;">
                        Monthly Adoptions
                    </div>
                </div>
                
                <!-- Legend -->
                <div class="flex justify-center items-center space-x-6 mt-8 text-xs">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-primary rounded-full border-2 border-white"></div>
                        <span class="text-muted-foreground">Monthly Data Points</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-0 border-t border-dashed border-primary/50"></div>
                        <span class="text-muted-foreground">Trend Line</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Length of Stay Distribution -->
        <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-foreground">Length of Stay Distribution</h3>
                    <p class="text-sm text-muted-foreground mt-1">Current animals by time in shelter</p>
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
                                            <div class="bg-primary rounded-t-md w-full max-w-16 hover:bg-primary/80 transition-colors duration-200 relative" 
                                                 style="height: {{ ($data['count'] / 52) * 180 }}px;">
                                                <!-- Tooltip on hover -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 bg-foreground text-background text-xs px-3 py-2 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-10 pointer-events-none">
                                                    <div class="font-medium">{{ $data['range'] }}</div>
                                                    <div>{{ $data['count'] }} animals</div>
                                                    <!-- Tooltip arrow -->
                                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-l-4 border-r-4 border-t-4 border-transparent border-t-foreground"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Y-axis labels -->
                        <div class="absolute left-0 top-0 h-full flex flex-col justify-between text-xs text-muted-foreground py-2">
                            <span class="-ml-2">50</span>
                            <span class="-ml-2">40</span>
                            <span class="-ml-2">30</span>
                            <span class="-ml-2">20</span>
                            <span class="-ml-2">10</span>
                            <span class="-ml-1">0</span>
                        </div>
                        
                        <!-- Y-axis title -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -rotate-90 text-xs text-muted-foreground font-medium" style="transform-origin: center; margin-left: -2.5rem;">
                            Number of Animals
                        </div>
                    </div>
                    
                    <!-- X-axis labels and values -->
                    <div class="absolute bottom-0 left-0 w-full px-4">
                        <div class="flex justify-between items-center space-x-3">
                            @foreach($lengthOfStayData as $data)
                                <div class="flex-1 text-center">
                                    <div class="text-sm font-medium text-foreground">{{ $data['count'] }}</div>
                                    <div class="text-xs text-muted-foreground mt-1">{{ $data['range'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- X-axis title -->
                        <div class="text-center mt-3 text-xs text-muted-foreground font-medium">
                            Length of Stay Ranges
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- At-Risk Pets Detail -->
    <div class="bg-card/80 backdrop-blur-sm border border-border shadow-sm rounded-lg">
        <div class="p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-foreground flex items-center gap-2">
                    <i data-lucide="alert-triangle" class="h-5 w-5 text-red-600"></i>
                    At-Risk Pets Details
                </h3>
                <p class="text-sm text-muted-foreground mt-1">
                    Animals requiring immediate attention due to long stays or special needs
                </p>
            </div>
            
            <div class="space-y-4">
                @foreach($atRiskPets as $pet)
                    <div class="flex items-center justify-between p-4 rounded-lg bg-card/60 backdrop-blur-sm border border-border">
                        <div class="flex items-center gap-3">
                            <i data-lucide="heart" class="h-5 w-5 text-muted-foreground"></i>
                            <div>
                                <p class="font-medium text-foreground">{{ $pet['name'] }}</p>
                                <p class="text-sm text-muted-foreground">
                                    {{ $pet['type'] }} • {{ $pet['daysInShelter'] }} days in shelter
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mb-1">
                                {{ $pet['reason'] }}
                            </span>
                            <p class="text-xs text-muted-foreground">Needs attention</p>
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
    const cards = document.querySelectorAll('.bg-card\\/80');
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