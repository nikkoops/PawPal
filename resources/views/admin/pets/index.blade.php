@extends('admin.layouts.app')

@section('title', 'Pet Management - PawPal Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="section-header">
            <h1 class="text-3xl font-serif font-bold text-foreground">Pet Management</h1>
            <p class="text-muted-foreground mt-1">
                Manage all pets in the system - add, edit, and track their status.
            </p>
        </div>
        <a href="{{ route('admin.shelter.pets.create') }}" class="btn-primary">
            <i data-lucide="plus" class="h-5 w-5"></i>
            <span>Add New Pet</span>
        </a>
    </div>

    <!-- Filters -->
    <div class="card">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Pet Type</label>
                <select id="typeFilter" class="input" onchange="filterPets()">
                    <option value="">All Types</option>
                    <option value="dog" {{ request('type') === 'dog' ? 'selected' : '' }}>Dogs</option>
                    <option value="cat" {{ request('type') === 'cat' ? 'selected' : '' }}>Cats</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Availability Status</label>
                <select id="availabilityFilter" class="input" onchange="filterPets()">
                    <option value="">All Status</option>
                    <option value="available" {{ request('availability') === 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ request('availability') === 'unavailable' ? 'selected' : '' }}>Adopted</option>
                </select>
            </div>

            <!-- Location Filter - New addition matching adoption site functionality -->
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Location</label>
                <select id="locationFilter" class="input" onchange="filterPets()">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location }}" {{ request('location') === $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mt-4 flex items-center space-x-2 text-sm text-muted-foreground">
            <i data-lucide="filter" class="h-4 w-4"></i>
            <span id="petCount">{{ $pets->total() }} pets found</span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                <div class="ml-3">
                    <p class="text-sm text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Pet Grid -->
    <div id="petGridContainer">
        @include('admin.pets.partials.pet-grid', compact('pets'))
    </div>
</div>

<script>
/**
 * Admin Pet Management Filtering System
 * 
 * This script handles real-time filtering of pets in the admin dashboard.
 * It includes the following filter categories:
 * - Pet Type (Dogs/Cats) 
 * - Availability Status (Available/Adopted)
 * - Location (Dynamic dropdown populated from actual pet locations)
 * 
 * The location filter mirrors the functionality found on the adoption site
 * to provide a consistent user experience between public and admin interfaces.
 * 
 * State management: All filter selections are preserved in URL parameters
 * and restored on page load for better user experience.
 */

// Filter pets via AJAX - Updated to include location filtering
function filterPets() {
    const type = document.getElementById('typeFilter').value;
    const availability = document.getElementById('availabilityFilter').value;
    const location = document.getElementById('locationFilter').value; // New location filter
    
    // Build query parameters - includes location for comprehensive filtering
    const params = new URLSearchParams();
    if (type) params.append('type', type);
    if (availability) params.append('availability', availability);
    if (location) params.append('location', location); // Add location to query parameters
    
    // Show loading state
    const container = document.getElementById('petGridContainer');
    container.innerHTML = `
        <div class="bg-white rounded-lg shadow-sm border border-border p-12 text-center">
            <div class="animate-spin h-8 w-8 border-4 border-primary border-t-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-muted-foreground">Loading pets...</p>
        </div>
    `;
    
    // Fetch filtered pets - using correct route name within admin group
    fetch(`{{ route('admin.shelter.pets.filter') }}?${params.toString()}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Update pet grid content
            container.innerHTML = data.html;
            
            // Update pet count
            document.getElementById('petCount').textContent = `${data.total} pets found`;
            
            // Reinitialize Lucide icons for new content
            if (window.lucide) {
                lucide.createIcons();
            }
        })
        .catch(error => {
            console.error('Error filtering pets:', error);
            container.innerHTML = `
                <div class="bg-white rounded-lg shadow-sm border border-border p-12 text-center text-red-500">
                    <i data-lucide="alert-triangle" class="h-12 w-12 mx-auto mb-4"></i>
                    <p class="text-lg font-medium">Error Loading Pets</p>
                    <p class="text-sm">Please refresh the page and try again.</p>
                </div>
            `;
            // Reinitialize icons for error state
            if (window.lucide) {
                lucide.createIcons();
            }
        });
}

// Custom pet deletion confirmation
function confirmPetDeletion(event, petName) {
    event.preventDefault();
    
    customConfirm(
        `Are you sure you want to delete "${petName}"? This action cannot be undone and will remove all associated data including photos, medical records, and application history.`,
        'Delete Pet',
        {
            confirmText: 'Delete Pet',
            cancelText: 'Cancel',
            type: 'danger'
        }
    ).then(confirmed => {
        if (confirmed) {
            event.target.submit();
        }
    });
    
    return false;
}

// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection