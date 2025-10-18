@extends('admin.layouts.app')

@section('title', 'Shelter Analytics - PawPal Admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-serif font-bold text-gray-900">Shelter Analytics</h1>
            <p class="text-gray-600 mt-1">Real-time insights for {{ auth()->user()->shelter_location ?? 'your shelter' }}</p>
        </div>
        <button onclick="exportData()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
            <i data-lucide="download" class="h-4 w-4"></i>
            <span>Export Data</span>
        </button>
    </div>

    <!-- Top Row: Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Current Capacity -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Current Capacity</p>
                    <div class="mt-2">
                        <span class="text-3xl font-bold text-gray-900">{{ $analytics['capacity']['current'] }}</span>
                        <span class="text-gray-600">/ {{ $analytics['capacity']['maximum'] }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                @php
                    $percentage = $analytics['capacity']['maximum'] > 0 
                        ? ($analytics['capacity']['current'] / $analytics['capacity']['maximum']) * 100 
                        : 0;
                    $barColor = $percentage < 60 ? 'bg-green-500' : ($percentage < 85 ? 'bg-yellow-500' : 'bg-red-500');
                @endphp
                <div class="{{ $barColor }} h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
            </div>
            
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">{{ number_format($percentage, 0) }}% filled</span>
                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $percentage < 60 ? 'bg-green-100 text-green-800' : ($percentage < 85 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ $percentage < 60 ? 'Normal' : ($percentage < 85 ? 'High' : 'Critical') }}
                </span>
            </div>
            
            <div class="mt-3 pt-3 border-t border-gray-200 text-sm text-gray-600">
                Dogs: {{ $analytics['capacity']['dogs'] }} • Cats: {{ $analytics['capacity']['cats'] }}
            </div>
        </div>

        <!-- At-Risk Pets -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">At-Risk Pets</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-orange-600">{{ $analytics['at_risk_pets']->count() }}</span>
                        <i data-lucide="alert-triangle" class="h-5 w-5 text-orange-600"></i>
                    </div>
                </div>
            </div>
            
            <p class="text-sm text-gray-600 mb-3">Pets marked as urgent (7+ days in shelter) and requiring priority attention</p>
            
            @if($analytics['at_risk_pets']->isNotEmpty())
                <div class="text-sm">
                    <p class="font-medium text-gray-900 mb-1">{{ $analytics['at_risk_pets']->first()['name'] }}</p>
                    <p class="text-gray-500">{{ $analytics['at_risk_pets']->first()['daysInShelter'] }}d</p>
                </div>
            @endif
        </div>

        <!-- Lives Saved -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-sm font-medium text-gray-600">Lives Saved</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <i data-lucide="heart" class="h-6 w-6 text-green-600"></i>
                        <span class="text-3xl font-bold text-gray-900">{{ $analytics['overview']['adopted_pets'] }}</span>
                    </div>
                </div>
            </div>
            
            <p class="text-sm text-gray-600 mb-3">Total adoptions</p>
            
            <div class="text-sm">
                <span class="text-green-600 font-medium">{{ $analytics['overview']['approved_applications'] }} approved applications</span>
            </div>
        </div>
    </div>

    <!-- Second Row: Status Distribution, Application Status, Adoption Rate -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pet Status Distribution -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pet Status Distribution</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-sm text-gray-700">Available</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['available_pets'] }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-sm text-gray-700">On Hold</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['pending_applications'] }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-sm text-gray-700">Adopted</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['adopted_pets'] }}</span>
                </div>
            </div>
        </div>

        <!-- Application Status -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Status</h3>
            
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span class="text-sm text-gray-700">Pending Review</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['pending_applications'] }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-sm text-gray-700">Approved</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['approved_applications'] }}</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-sm text-gray-700">Rejected</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $analytics['overview']['rejected_applications'] }}</span>
                </div>
            </div>
        </div>

        <!-- Adoption Rate -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Adoption Rate</h3>
            
            <div class="flex items-center justify-center py-4">
                <div class="relative">
                    <svg class="transform -rotate-90" width="120" height="120">
                        <circle cx="60" cy="60" r="50" stroke="#e5e7eb" stroke-width="10" fill="none"></circle>
                        <circle cx="60" cy="60" r="50" 
                                stroke="#9333ea" 
                                stroke-width="10" 
                                fill="none"
                                stroke-dasharray="{{ 2 * 3.14159 * 50 }}"
                                stroke-dashoffset="{{ 2 * 3.14159 * 50 * (1 - $analytics['overview']['adoption_rate'] / 100) }}"
                                stroke-linecap="round"></circle>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-900">{{ number_format($analytics['overview']['adoption_rate'], 0) }}%</span>
                    </div>
                </div>
            </div>
            
            <p class="text-sm text-center text-gray-600 mt-2">Success Rate</p>
            <p class="text-sm text-center text-purple-600 font-medium">{{ $analytics['overview']['adopted_pets'] }} of {{ $analytics['overview']['total_pets'] }} pets adopted</p>
        </div>
    </div>

    <!-- Third Row: Charts -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Adoption vs Intake Correlation -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Adoption vs Intake Trends</h3>
            <p class="text-sm text-gray-600 mb-4">Monthly adoption and intake counts over time</p>
            
            <div class="relative" style="height: 300px;">
                <canvas id="correlationChart"></canvas>
            </div>
            
            <div class="mt-4 flex items-center justify-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-green-600 rounded"></div>
                    <span class="text-gray-700">Adoptions</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-blue-600 rounded"></div>
                    <span class="text-gray-700">Intakes</span>
                </div>
            </div>
        </div>

        <!-- Length of Stay Distribution -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Length of Stay Distribution</h3>
            <p class="text-sm text-gray-600 mb-4">Current animals by time in shelter</p>
            
            <div class="relative" style="height: 300px;">
                <canvas id="lengthOfStayChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Prepare monthly data for trends chart
    const monthlyAdoptions = @json($analytics['monthly_adoptions']);
    const monthlyIntakes = @json($analytics['monthly_intakes']);
    
    // Create month names array
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                       'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    // Prepare data for the last 12 months
    const now = new Date();
    const labels = [];
    const adoptionCounts = [];
    const intakeCounts = [];
    
    for (let i = 11; i >= 0; i--) {
        const date = new Date(now.getFullYear(), now.getMonth() - i, 1);
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const monthLabel = monthNames[date.getMonth()] + ' ' + year;
        
        const adoptions = monthlyAdoptions.find(a => a.year == year && a.month == month);
        const intakes = monthlyIntakes.find(i => i.year == year && i.month == month);
        
        labels.push(monthLabel);
        adoptionCounts.push(adoptions ? adoptions.count : 0);
        intakeCounts.push(intakes ? intakes.count : 0);
    }

    // Trends Chart (Line Chart)
    const correlationCtx = document.getElementById('correlationChart').getContext('2d');
    new Chart(correlationCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Adoptions',
                data: adoptionCounts,
                borderColor: '#16a34a',
                backgroundColor: 'rgba(22, 163, 74, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                pointBackgroundColor: '#16a34a',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Intakes',
                data: intakeCounts,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 3,
                fill: false,
                tension: 0.4,
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: true,
                        color: '#f3f4f6'
                    },
                    ticks: {
                        maxRotation: 45,
                        minRotation: 0
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Count',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: true,
                        color: '#f3f4f6'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Length of Stay Chart
    const lengthOfStayData = @json($analytics['length_of_stay']);
    const lengthOfStayCtx = document.getElementById('lengthOfStayChart').getContext('2d');
    new Chart(lengthOfStayCtx, {
        type: 'bar',
        data: {
            labels: lengthOfStayData.map(item => item.range),
            datasets: [{
                label: 'Number of Animals',
                data: lengthOfStayData.map(item => item.count),
                backgroundColor: '#9333ea',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Length of Stay Ranges'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Animals'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10
                    },
                    grid: {
                        color: '#f3f4f6'
                    }
                }
            }
        }
    });

    function exportData() {
        window.open('{{ route('admin.shelter.analytics.export') }}?type=pets', '_blank');
    }

    // Initialize Lucide icons
    if (window.lucide) {
        lucide.createIcons();
    }
</script>
@endsection
