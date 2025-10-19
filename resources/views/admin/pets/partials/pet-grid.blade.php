@if($pets->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($pets as $pet)
            <div class="bg-white rounded-lg shadow-sm border border-border hover:shadow-lg transition-shadow duration-200" data-pet-id="{{ $pet->id }}">
                <div class="relative">
                    <img src="{{ $pet->image_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-t-lg pet-image">
                    
                    <span class="absolute top-2 right-2 px-3 py-1 text-sm rounded-full font-semibold {{ $pet->is_available ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }} pet-status">
                        {{ $pet->is_available ? '✓ Available' : '🏠 Adopted' }}
                    </span>
                    
                    @if($pet->is_urgent && $pet->is_available)
                    <span class="absolute top-2 left-2 px-2 py-1 text-xs font-medium bg-red-500 text-white urgent-badge" style="border-radius: 30px;">
                        🚨 URGENT
                    </span>
                    @endif
                </div>
                
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-serif font-bold text-foreground pet-name">{{ $pet->name }}</h3>
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded pet-type">{{ ucfirst($pet->type) }}</span>
                        </div>
                        <div>
                            <p class="text-sm text-muted-foreground pet-details">
                                {{-- NEW FORMAT: Breed • Age Range • Size (using age categories: Puppy/Kitten, Adult, Senior) --}}
                                @php
                                    $details = array_filter([
                                        $pet->breed,
                                        $pet->age_category,
                                        $pet->size ? ucfirst($pet->size) : null
                                    ]);
                                @endphp
                                {{ implode(' • ', $details) }}
                            </p>
                        </div>
                        @if($pet->description)
                        <p class="text-sm text-muted-foreground line-clamp-2 pet-description">{{ $pet->description }}</p>
                        @endif
                        @if($pet->location)
                        <div class="text-xs text-muted-foreground pet-location">📍 {{ $pet->location }}</div>
                        @endif
                        <div class="text-xs text-muted-foreground space-y-1">
                            @if($pet->date_added)
                            <div>Added: {{ $pet->date_added->format('M d, Y') }}</div>
                            @else
                            <div>Added: {{ $pet->created_at->format('M d, Y') }}</div>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <button 
                                onclick="openEditModal({{ $pet->id }})"
                                class="flex-1 py-2 px-3 text-xs bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200 flex items-center justify-center">
                                <i data-lucide="edit" class="h-4 w-4 mr-1"></i>
                                Edit
                            </button>
                            <form method="POST" action="{{ route('admin.shelter.pets.toggle-availability', $pet) }}" class="inline-block">
                                @csrf
                                <button type="submit" class="py-2 px-3 text-xs {{ $pet->is_available ? 'text-red-600 hover:text-red-700 hover:bg-red-50 border-red-200' : 'text-green-600 hover:text-green-700 hover:bg-green-50 border-green-200' }} border rounded-lg transition-colors duration-200" title="{{ $pet->is_available ? 'Mark as Adopted' : 'Mark as Available' }}">
                                    <i data-lucide="{{ $pet->is_available ? 'x-circle' : 'check-circle' }}" class="h-4 w-4"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.shelter.pets.destroy', $pet) }}" class="inline-block" onsubmit="return confirmPetDeletion(event, '{{ $pet->name }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-2 px-3 text-xs text-red-600 hover:text-red-700 hover:bg-red-50 border border-red-200 rounded-lg transition-colors duration-200">
                                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Include Edit Modal --}}
                @php
                    $actualDateToPass = $pet->date_added ? $pet->date_added->format('Y-m-d') : ($pet->created_at ? $pet->created_at->format('Y-m-d') : '');
                @endphp
                @include('admin.pets.partials.edit-modal', [
                    'pet' => $pet,
                    'petData' => [
                        'id' => $pet->id,
                        'name' => $pet->name,
                        'type' => $pet->type,
                        'breed' => $pet->breed,
                        'age' => $pet->age,
                        'gender' => $pet->gender,
                        'size' => $pet->size,
                        'description' => $pet->description,
                        'location' => $pet->location,
                        'characteristics' => $pet->characteristics,
                        'is_available' => $pet->is_available,
                        'is_vaccinated' => $pet->is_vaccinated,
                        'is_neutered' => $pet->is_neutered,
                        'is_dewormed' => $pet->is_dewormed,
                        'is_tick_flea_treated' => $pet->is_tick_flea_treated,
                        'on_preventive_medication' => $pet->on_preventive_medication,
                        'has_special_medical_needs' => $pet->has_special_medical_needs,
                        'is_mobility_impaired' => $pet->is_mobility_impaired,
                        'is_undergoing_treatment' => $pet->is_undergoing_treatment,
                        'date_added' => $actualDateToPass,
                        'image_url' => $pet->image_url,
                        'is_urgent' => $pet->is_urgent,
                        'days_in_shelter' => $pet->days_in_shelter,
                        '_debug_card_date' => $pet->date_added ? $pet->date_added->format('M d, Y') : $pet->created_at->format('M d, Y')
                    ]
                ])
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