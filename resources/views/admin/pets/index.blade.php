@extends('admin.layouts.app')

@section('title', 'Pet Management - PawPal Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-serif font-bold text-foreground">Pet Management</h1>
            <p class="text-lg text-muted-foreground mt-2">
                Manage all pets in the system - add, edit, and track their status.
            </p>
        </div>
        <a href="{{ route('admin.pets.create') }}" class="inline-flex items-center space-x-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg font-medium transition-colors duration-200">
            <i data-lucide="plus" class="h-5 w-5"></i>
            <span>Add New Pet</span>
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow-sm border border-border p-6">
        <form method="GET" action="{{ route('admin.pets.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-muted-foreground"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search pets..." 
                       class="pl-10 w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            
            <select name="type" class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">All Types</option>
                <option value="dog" {{ request('type') === 'dog' ? 'selected' : '' }}>Dogs</option>
                <option value="cat" {{ request('type') === 'cat' ? 'selected' : '' }}>Cats</option>
                <option value="other" {{ request('type') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            
            <select name="availability" class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">All Status</option>
                <option value="available" {{ request('availability') === 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ request('availability') === 'unavailable' ? 'selected' : '' }}>Adopted</option>
            </select>
            
            <div class="flex items-center space-x-2">
                <button type="submit" class="flex-1 bg-primary hover:bg-primary/90 text-primary-foreground px-4 py-2 rounded-lg transition-colors duration-200">
                    Filter
                </button>
                <a href="{{ route('admin.pets.index') }}" class="px-4 py-2 bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200">
                    Clear
                </a>
            </div>
        </form>
        
        <div class="mt-4 flex items-center space-x-2 text-sm text-muted-foreground">
            <i data-lucide="filter" class="h-4 w-4"></i>
            <span>{{ $pets->total() }} pets found</span>
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
    @if($pets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($pets as $pet)
                <div class="bg-white rounded-lg shadow-sm border border-border hover:shadow-lg transition-shadow duration-200">
                    <div class="relative">
                        @if($pet->image)
                            <img src="{{ Storage::url($pet->image) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-t-lg">
                        @else
                            <div class="w-full h-48 bg-muted rounded-t-lg flex items-center justify-center">
                                <i data-lucide="heart" class="h-12 w-12 text-muted-foreground"></i>
                            </div>
                        @endif
                        
                        <span class="absolute top-2 right-2 px-3 py-1 text-sm rounded-full font-semibold {{ $pet->is_available ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                            {{ $pet->is_available ? '✓ Available' : '🏠 Adopted' }}
                        </span>
                        
                        @if($pet->is_urgent && $pet->is_available)
                        <span class="absolute top-2 left-2 px-2 py-1 text-xs rounded-full font-bold bg-orange-100 text-orange-800 border border-orange-200">
                            🚨 URGENT
                        </span>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <div class="space-y-3">
                            <div>
                                <h3 class="text-lg font-serif font-bold text-foreground">{{ $pet->name }}</h3>
                                <p class="text-sm text-muted-foreground">
                                    {{ ucfirst($pet->type) }} • {{ $pet->age ?? 'Unknown age' }} • {{ ucfirst($pet->size ?? 'Unknown size') }}
                                </p>
                            </div>
                            <p class="text-sm text-muted-foreground line-clamp-2">{{ $pet->description }}</p>
                            <div class="text-xs text-muted-foreground space-y-1">
                                <div>Added: {{ $pet->created_at->format('M d, Y') }}</div>
                                @if($pet->date_added)
                                <div>In shelter: {{ $pet->days_in_shelter }} days</div>
                                @endif
                                @if($pet->is_urgent)
                                <div class="text-orange-600 font-medium">⚠️ {{ $pet->urgent_reason }}</div>
                                @endif
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.pets.show', $pet) }}" class="flex-1 text-center py-2 px-3 text-xs bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200 flex items-center justify-center">
                                    <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                                    View
                                </a>
                                <a href="{{ route('admin.pets.edit', $pet) }}" class="flex-1 text-center py-2 px-3 text-xs bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200 flex items-center justify-center">
                                    <i data-lucide="edit" class="h-4 w-4 mr-1"></i>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.pets.toggle-availability', $pet) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="py-2 px-3 text-xs {{ $pet->is_available ? 'text-red-600 hover:text-red-700 hover:bg-red-50 border-red-200' : 'text-green-600 hover:text-green-700 hover:bg-green-50 border-green-200' }} border rounded-lg transition-colors duration-200" title="{{ $pet->is_available ? 'Mark as Adopted' : 'Mark as Available' }}">
                                        <i data-lucide="{{ $pet->is_available ? 'x-circle' : 'check-circle' }}" class="h-4 w-4"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.pets.destroy', $pet) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this pet?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="py-2 px-3 text-xs text-red-600 hover:text-red-700 hover:bg-red-50 border border-red-200 rounded-lg transition-colors duration-200">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-border p-12 text-center">
            <div class="space-y-4">
                <div class="mx-auto w-24 h-24 bg-muted rounded-full flex items-center justify-center">
                    <i data-lucide="search" class="h-12 w-12 text-muted-foreground"></i>
                </div>
                <h3 class="text-xl font-serif font-bold text-foreground">No pets found</h3>
                <p class="text-muted-foreground">
                    Try adjusting your search criteria or add a new pet to get started.
                </p>
                <a href="{{ route('admin.pets.create') }}" class="inline-flex items-center space-x-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                    <i data-lucide="plus" class="h-4 w-4"></i>
                    <span>Add New Pet</span>
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    lucide.createIcons();
</script>
@endsection