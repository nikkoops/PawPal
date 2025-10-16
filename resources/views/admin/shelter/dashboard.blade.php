@extends('admin.layouts.app')

@section('title', 'Shelter Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Shelter Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pets -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Pets</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalPets }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Available Pets -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Available Pets</p>
                    <p class="text-3xl font-bold mt-2">{{ $availablePets }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Applications</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalApplications }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Pending Reviews</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingApplications }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Pet Management Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-4">
                <div class="bg-purple-100 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Pet Management</h2>
                    <p class="text-gray-600 text-sm">Manage pets</p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.shelter.pets.index') }}" class="block w-full bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                    View All Pets
                </a>
                <a href="{{ route('admin.shelter.pets.create') }}" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                    Add New Pet
                </a>
            </div>
        </div>

        <!-- Application Management Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Applications</h2>
                    <p class="text-gray-600 text-sm">Review & manage</p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.shelter.applications.index') }}" class="block w-full bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                    View All Applications
                </a>
                <a href="{{ route('admin.shelter.applications.index', ['status' => 'pending']) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                    Review Pending
                </a>
            </div>
        </div>

        <!-- Analytics Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-4">
                <div class="bg-green-100 rounded-full p-3 mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Analytics</h2>
                    <p class="text-gray-600 text-sm">View insights</p>
                </div>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.shelter.analytics') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 text-center text-sm">
                    View Analytics
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Pets -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recently Added Pets</h2>
            @if($recentPets->count() > 0)
                <div class="space-y-3">
                    @foreach($recentPets as $pet)
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                            <div class="flex items-center">
                                @if($pet->image)
                                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="w-12 h-12 rounded-full object-cover mr-3">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $pet->name }}</p>
                                    <p class="text-sm text-gray-600">{{ ucfirst($pet->type) }} • {{ $pet->breed }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full {{ $pet->is_available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $pet->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.shelter.pets.index') }}" class="block mt-4 text-center text-purple-600 hover:text-purple-700 font-medium text-sm">
                    View All Pets →
                </a>
            @else
                <p class="text-gray-500 text-center py-4">No pets added yet</p>
            @endif
        </div>

        <!-- Recent Applications -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Applications</h2>
            @if($recentApplications->count() > 0)
                <div class="space-y-3">
                    @foreach($recentApplications as $application)
                        <div class="flex items-center justify-between border-b border-gray-200 pb-3 last:border-0 last:pb-0">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $application->full_name }}</p>
                                <p class="text-sm text-gray-600">{{ $application->pet->name }} ({{ ucfirst($application->pet->type) }})</p>
                                <p class="text-xs text-gray-500">{{ $application->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full 
                                {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.shelter.applications.index') }}" class="block mt-4 text-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                    View All Applications →
                </a>
            @else
                <p class="text-gray-500 text-center py-4">No applications yet</p>
            @endif
        </div>
    </div>
</div>
@endsection
