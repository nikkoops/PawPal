@extends('admin.layouts.app')

@section('title', 'Analytics - PawPal Admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-serif font-bold text-foreground">Analytics Dashboard</h1>
            <p class="text-muted-foreground mt-1">Track your adoption center's performance and insights</p>
        </div>
        <div class="flex space-x-2">
            <select class="input">
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
                <option value="90">Last 3 months</option>
                <option value="365">Last year</option>
            </select>
            <button onclick="exportReport()" class="btn-primary">
                <i data-lucide="download" class="h-4 w-4"></i>
                Export Report
            </button>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Adoptions</p>
                    <p class="text-3xl font-bold text-foreground">{{ $metrics['total_adoptions'] ?? 247 }}</p>
                    <p class="text-sm text-green-600 mt-1">↗ +12% from last month</p>
                </div>
                <div class="h-12 w-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <i data-lucide="heart" class="h-6 w-6 text-primary"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Active Applications</p>
                    <p class="text-3xl font-bold text-foreground">{{ $metrics['active_applications'] ?? 34 }}</p>
                    <p class="text-sm text-blue-600 mt-1">↗ +5 new today</p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="file-text" class="h-6 w-6 text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Available Pets</p>
                    <p class="text-3xl font-bold text-foreground">{{ $metrics['available_pets'] ?? 89 }}</p>
                    <p class="text-sm text-orange-600 mt-1">↘ -3 from yesterday</p>
                </div>
                <div class="h-12 w-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="users" class="h-6 w-6 text-orange-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Success Rate</p>
                    <p class="text-3xl font-bold text-foreground">{{ $metrics['success_rate'] ?? '87' }}%</p>
                    <p class="text-sm text-green-600 mt-1">↗ +2% improvement</p>
                </div>
                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="trending-up" class="h-6 w-6 text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Adoptions Over Time -->
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-serif font-semibold text-foreground">Adoptions Over Time</h3>
                <div class="flex space-x-2">
                    <button class="text-sm px-3 py-1 rounded-md bg-primary text-primary-foreground">Daily</button>
                    <button class="text-sm px-3 py-1 rounded-md text-muted-foreground hover:bg-muted">Weekly</button>
                    <button class="text-sm px-3 py-1 rounded-md text-muted-foreground hover:bg-muted">Monthly</button>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between space-x-2">
                @for($i = 0; $i < 7; $i++)
                @php
                    $height = rand(20, 80);
                    $value = rand(5, 25);
                @endphp
                <div class="flex flex-col items-center space-y-2 flex-1">
                    <div class="bg-primary rounded-t-md w-full" style="height: {{ $height }}%"></div>
                    <span class="text-xs text-muted-foreground">{{ $value }}</span>
                    <span class="text-xs text-muted-foreground">{{ date('M j', strtotime('-' . (6-$i) . ' days')) }}</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Pet Types Distribution -->
        <div class="bg-card rounded-lg border border-border p-6">
            <h3 class="text-lg font-serif font-semibold text-foreground mb-6">Pet Types Distribution</h3>
            <div class="space-y-4">
                @foreach(['Dogs' => 65, 'Cats' => 28, 'Birds' => 4, 'Other' => 3] as $type => $percentage)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium text-foreground">{{ $type }}</span>
                        <span class="text-sm text-muted-foreground">{{ $percentage }}%</span>
                    </div>
                    <div class="w-full bg-muted rounded-full h-2">
                        <div class="bg-primary h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Application Status & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Application Status Breakdown -->
        <div class="bg-card rounded-lg border border-border p-6">
            <h3 class="text-lg font-serif font-semibold text-foreground mb-6">Application Status</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">23</div>
                    <div class="text-sm text-yellow-600">Pending</div>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">15</div>
                    <div class="text-sm text-blue-600">In Review</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">89</div>
                    <div class="text-sm text-green-600">Approved</div>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">12</div>
                    <div class="text-sm text-red-600">Rejected</div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-card rounded-lg border border-border p-6">
            <h3 class="text-lg font-serif font-semibold text-foreground mb-6">Recent Activity</h3>
            <div class="space-y-4">
                @foreach([
                    ['type' => 'adoption', 'text' => 'Max was adopted by John Smith', 'time' => '2 hours ago', 'icon' => 'heart'],
                    ['type' => 'application', 'text' => 'New application for Bella', 'time' => '4 hours ago', 'icon' => 'file-text'],
                    ['type' => 'pet', 'text' => 'Charlie was added to available pets', 'time' => '6 hours ago', 'icon' => 'plus'],
                    ['type' => 'application', 'text' => 'Application approved for Luna', 'time' => '1 day ago', 'icon' => 'check'],
                    ['type' => 'adoption', 'text' => 'Milo found his forever home', 'time' => '2 days ago', 'icon' => 'heart']
                ] as $activity)
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-muted/50 transition-colors">
                    <div class="h-8 w-8 bg-primary/10 rounded-full flex items-center justify-center">
                        <i data-lucide="{{ $activity['icon'] }}" class="h-4 w-4 text-primary"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-foreground">{{ $activity['text'] }}</p>
                        <p class="text-xs text-muted-foreground">{{ $activity['time'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Performers & Geographic Data -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Performing Pets -->
        <div class="bg-card rounded-lg border border-border p-6">
            <h3 class="text-lg font-serif font-semibold text-foreground mb-6">Most Popular Pets</h3>
            <div class="space-y-4">
                @foreach([
                    ['name' => 'Golden Retrievers', 'applications' => 45, 'adoptions' => 38],
                    ['name' => 'Labrador Mix', 'applications' => 32, 'adoptions' => 28],
                    ['name' => 'Persian Cats', 'applications' => 28, 'adoptions' => 22],
                    ['name' => 'German Shepherds', 'applications' => 24, 'adoptions' => 19],
                    ['name' => 'Siamese Cats', 'applications' => 18, 'adoptions' => 15]
                ] as $pet)
                <div class="flex items-center justify-between p-3 rounded-lg bg-muted/30">
                    <div>
                        <p class="font-medium text-foreground">{{ $pet['name'] }}</p>
                        <p class="text-sm text-muted-foreground">{{ $pet['applications'] }} applications</p>
                    </div>
                    <div class="text-right">
                        <p class="font-medium text-primary">{{ $pet['adoptions'] }}</p>
                        <p class="text-xs text-muted-foreground">adopted</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Adoption Sources -->
        <div class="bg-card rounded-lg border border-border p-6">
            <h3 class="text-lg font-serif font-semibold text-foreground mb-6">Traffic Sources</h3>
            <div class="space-y-4">
                @foreach([
                    ['source' => 'Direct Website', 'percentage' => 45, 'visitors' => 1234],
                    ['source' => 'Social Media', 'percentage' => 28, 'visitors' => 768],
                    ['source' => 'Google Search', 'percentage' => 18, 'visitors' => 492],
                    ['source' => 'Referrals', 'percentage' => 9, 'visitors' => 246]
                ] as $source)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium text-foreground">{{ $source['source'] }}</span>
                        <span class="text-sm text-muted-foreground">{{ $source['visitors'] }} visitors</span>
                    </div>
                    <div class="w-full bg-muted rounded-full h-2">
                        <div class="bg-gradient-to-r from-primary to-secondary h-2 rounded-full" style="width: {{ $source['percentage'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function exportReport() {
    // In a real implementation, this would generate and download a report
    alert('Report export functionality would be implemented here');
}

// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection