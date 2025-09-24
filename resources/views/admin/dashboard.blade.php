@extends('admin.layouts.app')

@section('title', 'Dashboard - PawPal Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-4xl font-serif font-bold text-foreground">Dashboard</h1>
        <p class="text-lg text-muted-foreground mt-2">Welcome back! Here's what's happening at PawPal today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border hover:shadow-xl transition-all duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Total Pets</p>
                        <p class="text-3xl font-bold text-foreground mt-2">127</p>
                        <p class="text-sm text-green-600 mt-1">+12 this month</p>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10">
                        <i data-lucide="heart" class="h-6 w-6 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border hover:shadow-xl transition-all duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Pending Applications</p>
                        <p class="text-3xl font-bold text-foreground mt-2">23</p>
                        <p class="text-sm text-green-600 mt-1">+5 today</p>
                    </div>
                    <div class="p-3 rounded-full bg-orange-100">
                        <i data-lucide="file-text" class="h-6 w-6 text-orange-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border hover:shadow-xl transition-all duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Successful Adoptions</p>
                        <p class="text-3xl font-bold text-foreground mt-2">89</p>
                        <p class="text-sm text-green-600 mt-1">+8 this month</p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100">
                        <i data-lucide="users" class="h-6 w-6 text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border hover:shadow-xl transition-all duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-muted-foreground">Adoption Rate</p>
                        <p class="text-3xl font-bold text-foreground mt-2">73%</p>
                        <p class="text-sm text-green-600 mt-1">+5% vs last month</p>
                    </div>
                    <div class="p-3 rounded-full bg-primary/10">
                        <i data-lucide="trending-up" class="h-6 w-6 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Recent Activity -->
        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border">
            <div class="p-6 border-b border-border">
                <h3 class="text-lg font-serif font-semibold text-foreground flex items-center space-x-2">
                    <i data-lucide="clock" class="h-5 w-5"></i>
                    <span>Recent Activity</span>
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center space-x-4 p-3 rounded-lg bg-muted/50">
                    <div class="p-2 rounded-full bg-green-100">
                        <i data-lucide="check-circle" class="h-4 w-4 text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Max was adopted by Sarah Johnson</p>
                        <p class="text-xs text-muted-foreground">2 hours ago</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-lg bg-muted/50">
                    <div class="p-2 rounded-full bg-orange-100">
                        <i data-lucide="file-text" class="h-4 w-4 text-orange-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">New application for Bella from Mike Chen</p>
                        <p class="text-xs text-muted-foreground">4 hours ago</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-lg bg-muted/50">
                    <div class="p-2 rounded-full bg-red-100">
                        <i data-lucide="alert-triangle" class="h-4 w-4 text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Rocky needs urgent medical attention</p>
                        <p class="text-xs text-muted-foreground">6 hours ago</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 p-3 rounded-lg bg-muted/50">
                    <div class="p-2 rounded-full bg-green-100">
                        <i data-lucide="check-circle" class="h-4 w-4 text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Whiskers was adopted by Emma Davis</p>
                        <p class="text-xs text-muted-foreground">1 day ago</p>
                    </div>
                </div>

                <button class="btn-secondary w-full mt-4">
                    View All Activity
                </button>
            </div>
        </div>

        <!-- Urgent Tasks -->
        <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border">
            <div class="p-6 border-b border-border">
                <h3 class="text-lg font-serif font-semibold text-foreground flex items-center space-x-2">
                    <i data-lucide="alert-triangle" class="h-5 w-5 text-orange-600"></i>
                    <span>Urgent Tasks</span>
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 rounded-lg border border-border">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Review application for Duke</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                High
                            </span>
                            <span class="text-xs text-muted-foreground flex items-center">
                                <i data-lucide="calendar" class="h-3 w-3 mr-1"></i>
                                Today
                            </span>
                        </div>
                    </div>
                    <button class="btn-secondary btn-sm">
                        Complete
                    </button>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg border border-border">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Update Bella's medical records</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Medium
                            </span>
                            <span class="text-xs text-muted-foreground flex items-center">
                                <i data-lucide="calendar" class="h-3 w-3 mr-1"></i>
                                Tomorrow
                            </span>
                        </div>
                    </div>
                    <button class="btn-secondary btn-sm">
                        Complete
                    </button>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg border border-border">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-foreground">Schedule vet visit for Oliver</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                High
                            </span>
                            <span class="text-xs text-muted-foreground flex items-center">
                                <i data-lucide="calendar" class="h-3 w-3 mr-1"></i>
                                This week
                            </span>
                        </div>
                    </div>
                    <button class="btn-secondary btn-sm">
                        Complete
                    </button>
                </div>

                <button class="btn-secondary w-full mt-4">
                    View All Tasks
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-card/95 backdrop-blur-sm rounded-lg border border-border">
        <div class="p-6 border-b border-border">
            <h3 class="text-lg font-serif font-semibold text-foreground">Quick Actions</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <button class="h-20 flex-col space-y-2 btn-primary">
                    <i data-lucide="heart" class="h-6 w-6"></i>
                    <span>Add New Pet</span>
                </button>
                <button class="h-20 flex-col space-y-2 btn-secondary">
                    <i data-lucide="file-text" class="h-6 w-6"></i>
                    <span>Review Applications</span>
                </button>
                <button class="h-20 flex-col space-y-2 btn-secondary">
                    <i data-lucide="users" class="h-6 w-6"></i>
                    <span>Contact Adopters</span>
                </button>
                <button class="h-20 flex-col space-y-2 btn-secondary">
                    <i data-lucide="trending-up" class="h-6 w-6"></i>
                    <span>View Reports</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection