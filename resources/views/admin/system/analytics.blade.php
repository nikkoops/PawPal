@extends('admin.layouts.app')

@section('title', 'Analytics')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Analytics</h1>
        <p class="text-gray-600 mt-1">Real-time insights and performance metrics for your shelter.</p>
    </div>

    <!-- 1. Shelter Capacities Table -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Shelter Capacities</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Shelter</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Current</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Maximum</th>
                        <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">% Full</th>
                        <th class="text-right py-3 px-4 text-sm font-semibold text-gray-600"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shelterCapacities as $shelter)
                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $shelter['shelter'] }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $shelter['current'] }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $shelter['maximum'] }}</td>
                        <td class="py-3 px-4 text-sm text-gray-800">{{ $shelter['percent_full'] }}%</td>
                        <td class="py-3 px-4 text-right">
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                                @if($shelter['status'] === 'Normal') bg-green-100 text-green-800
                                @elseif($shelter['status'] === 'High') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $shelter['status'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-gray-500 text-sm">No shelter data available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 2-5. Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- 2. Current Capacity Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-sm font-medium text-gray-600 mb-2">Current Capacity</h3>
            <div class="flex items-baseline mb-2">
                <span class="text-4xl font-bold text-gray-900">{{ $totalPets }}</span>
                <span class="text-gray-500 ml-2">/ {{ $totalCapacity }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1 mb-2">
                <div class="bg-purple-600 h-1 rounded-full" style="width: {{ $percentFilled }}%"></div>
            </div>
            <div class="flex justify-between items-center text-sm mb-2">
                <span class="text-gray-600">{{ $percentFilled }}% filled</span>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                    @if($percentFilled < 50) bg-green-100 text-green-800
                    @elseif($percentFilled < 80) bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ $percentFilled < 50 ? 'Normal' : ($percentFilled < 80 ? 'High' : 'Critical') }}
                </span>
            </div>
            <div class="text-xs text-gray-500">
                Dogs: {{ $dogCount }} • Cats: {{ $catCount }}
            </div>
        </div>

        <!-- 3. At-Risk Pets Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-sm font-medium text-gray-600 mb-2">At-Risk Pets</h3>
            <div class="flex items-center mb-2">
                <svg class="w-6 h-6 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-4xl font-bold text-gray-900">{{ $atRiskPets->count() }}</span>
            </div>
            <p class="text-xs text-gray-600 mb-2">Pets marked as urgent (7+ days in shelter) and requiring priority attention</p>
            @if($atRiskPets->isNotEmpty())
                <div class="text-sm">
                    <p class="font-medium text-gray-800">{{ $atRiskPets->first()['name'] }}</p>
                    <p class="text-xs text-gray-500">~{{ $atRiskPets->first()['days_in_shelter'] }}d</p>
                </div>
            @endif
        </div>

        <!-- 4. Avg Length of Stay Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-sm font-medium text-gray-600 mb-2">Avg Length of Stay</h3>
            <div class="flex items-center mb-2">
                <svg class="w-6 h-6 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-4xl font-bold text-gray-900">N/A</span>
            </div>
            <p class="text-xs text-green-600 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                Monitoring trends
            </p>
            <p class="text-xs text-gray-500 mt-2">Dogs: N/A • Cats: N/A</p>
        </div>

        <!-- 5. Lives Saved Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-sm font-medium text-gray-600 mb-2">Lives Saved</h3>
            <div class="flex items-center mb-2">
                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span class="text-4xl font-bold text-gray-900">{{ $totalAdoptions }}</span>
            </div>
            <p class="text-xs text-gray-600 mb-1">Total adoptions</p>
            <p class="text-sm font-medium text-green-600">{{ $approvedApplications }} approved applications</p>
        </div>
    </div>

    <!-- 6-8. Charts Grid Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- 6. Pet Status Distribution -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pet Status Distribution</h3>
            <div class="space-y-3">
                @foreach($petStatusDistribution as $status)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $status['color'] }}"></div>
                        <span class="text-sm text-gray-700">{{ $status['status'] }}</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $status['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 7. Application Status -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Status</h3>
            <div class="space-y-3">
                @foreach($applicationStatus as $status)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $status['color'] }}"></div>
                        <span class="text-sm text-gray-700">{{ $status['status'] }}</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ $status['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- 8. Adoption Rate -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Adoption Rate</h3>
            <div class="text-center">
                <div class="text-6xl font-bold text-gray-900 mb-2">{{ $adoptionRate }}%</div>
                <p class="text-sm text-gray-600 mb-4">Success Rate</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $adoptionRate }}%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ $adoptedCount }} of {{ $totalApps }} pets adopted</p>
            </div>
        </div>
    </div>

    <!-- 9-10. Charts Grid Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- 9. Adoption vs Intake Correlation -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Adoption vs Intake Correlation</h3>
            <p class="text-xs text-gray-600 mb-4">Scatter plot showing relationship between monthly intakes and adoptions</p>
            <div class="relative" style="height: 300px;">
                <canvas id="correlationChart"></canvas>
            </div>
            <div class="flex items-center justify-center mt-4 text-xs text-gray-600">
                <div class="flex items-center mr-4">
                    <div class="w-3 h-3 bg-purple-600 rounded-full mr-2"></div>
                    <span>Monthly Data Points</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-0.5 border-t-2 border-dashed border-purple-400 mr-2"></div>
                    <span>Trend Line</span>
                </div>
            </div>
        </div>

        <!-- 10. Length of Stay Distribution -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Length of Stay Distribution</h3>
            <p class="text-xs text-gray-600 mb-4">Current animals by time in shelter</p>
            <div class="relative" style="height: 300px;">
                <canvas id="lengthOfStayChart"></canvas>
            </div>
            <div class="text-center mt-4">
                <p class="text-xs text-gray-600">Length of Stay Ranges</p>
            </div>
        </div>
    </div>

    <!-- 11. At-Risk Pets Details -->
    @if($atRiskPets->isNotEmpty())
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center mb-4">
            <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <h3 class="text-lg font-semibold text-gray-800">At-Risk Pets Details</h3>
        </div>
        <p class="text-sm text-gray-600 mb-4">Pets marked as urgent (7+ days in shelter) and requiring priority attention</p>
        
        <div class="space-y-3">
            @foreach($atRiskPets as $pet)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $pet['name'] }}</p>
                        <p class="text-xs text-gray-600">{{ $pet['type'] }} • ~{{ $pet['days_in_shelter'] }} days in shelter</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                        {{ $pet['status'] }}
                    </span>
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                        Needs attention
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Correlation Chart
    const correlationCtx = document.getElementById('correlationChart');
    if (correlationCtx) {
        const correlationData = @json($correlationData);
        
        new Chart(correlationCtx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Monthly Data Points',
                    data: correlationData.map(d => ({x: d.intakes, y: d.adoptions})),
                    backgroundColor: '#9333ea',
                    borderColor: '#9333ea',
                    pointRadius: 6,
                    pointHoverRadius: 8
                }, {
                    label: 'Trend Line',
                    data: [{x: 30, y: 35}, {x: 85, y: 53}],
                    type: 'line',
                    borderColor: '#c084fc',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
                    pointRadius: 0
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
                            text: 'Monthly Intakes'
                        },
                        min: 25,
                        max: 90
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Monthly Adoptions'
                        },
                        min: 30,
                        max: 60
                    }
                }
            }
        });
    }

    // Length of Stay Chart
    const lengthOfStayCtx = document.getElementById('lengthOfStayChart');
    if (lengthOfStayCtx) {
        const lengthOfStayData = @json($lengthOfStayDistribution);
        
        new Chart(lengthOfStayCtx, {
            type: 'bar',
            data: {
                labels: lengthOfStayData.map(d => d.range),
                datasets: [{
                    label: 'Number of Animals',
                    data: lengthOfStayData.map(d => d.count),
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
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        },
                        title: {
                            display: true,
                            text: 'Number of Animals'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Length of Stay Ranges'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
