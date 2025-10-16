@if($pets->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($pets as $pet)
            <div class="bg-white rounded-lg shadow-sm border border-border hover:shadow-lg transition-shadow duration-200">
                <div class="relative">
                    <img src="{{ $pet->image_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-t-lg">
                    
                    <span class="absolute top-2 right-2 px-3 py-1 text-sm rounded-full font-semibold {{ $pet->is_available ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                        {{ $pet->is_available ? '✓ Available' : '🏠 Adopted' }}
                    </span>
                    
                    @if($pet->is_urgent && $pet->is_available)
                    <span class="absolute top-2 left-2 px-2 py-1 text-xs font-medium bg-red-500 text-white" style="border-radius: 30px;">
                        🚨 URGENT
                    </span>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <h3 class="text-lg font-serif font-bold text-foreground">{{ $pet->name }}</h3>
                            <p class="text-sm text-muted-foreground">
                                {{ ucfirst($pet->type) }} • {{ $pet->age_display }} • {{ $pet->size ? ucfirst($pet->size) : 'Unknown size' }}
                            </p>
                        </div>
                        @if($pet->description)
                        <p class="text-sm text-muted-foreground line-clamp-2">{{ $pet->description }}</p>
                        @endif
                        <div class="text-xs text-muted-foreground space-y-1">
                            @if($pet->date_added)
                            <div>Added: {{ $pet->date_added->format('M d, Y') }}</div>
                            <div>In shelter: {{ $pet->days_in_shelter }} days</div>
                            @else
                            <div>Added: {{ $pet->created_at->format('M d, Y') }}</div>
                            @endif
                            @if($pet->is_urgent && $pet->is_available)
                            <div class="text-orange-600 font-medium">⚠️ In shelter for {{ $pet->days_in_shelter }} days</div>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.shelter.pets.show', $pet) }}" class="flex-1 text-center py-2 px-3 text-xs bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200 flex items-center justify-center">
                                <i data-lucide="eye" class="h-4 w-4 mr-1"></i>
                                View
                            </a>
                            <a href="{{ route('admin.shelter.pets.edit', $pet) }}" class="flex-1 text-center py-2 px-3 text-xs bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200 flex items-center justify-center">
                                <i data-lucide="edit" class="h-4 w-4 mr-1"></i>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.shelter.pets.toggle-availability', $pet) }}" class="inline-block">
                                @csrf
                                <button type="submit" class="py-2 px-3 text-xs {{ $pet->is_available ? 'text-red-600 hover:text-red-700 hover:bg-red-50 border-red-200' : 'text-green-600 hover:text-green-700 hover:bg-green-50 border-green-200' }} border rounded-lg transition-colors duration-200" title="{{ $pet->is_available ? 'Mark as Adopted' : 'Mark as Available' }}">
                                    <i data-lucide="{{ $pet->is_available ? 'x-circle' : 'check-circle' }}" class="h-4 w-4"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.shelter.pets.destroy', $pet) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this pet?')">
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
    <div class="mt-8" id="paginationContainer">
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
                Try adjusting your filter criteria or add a new pet to get started.
            </p>
            <a href="{{ route('admin.shelter.pets.create') }}" class="inline-flex items-center space-x-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                <i data-lucide="plus" class="h-4 w-4"></i>
                <span>Add New Pet</span>
            </a>
        </div>
    </div>
@endif