@extends('admin.layouts.app')

@section('title', 'Add New Pet - PawPal Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.shelter.pets.index') }}" class="p-2 hover:bg-muted rounded-lg transition-colors duration-200">
            <i data-lucide="arrow-left" class="h-5 w-5"></i>
        </a>
        <div class="section-header">
            <h1 class="text-3xl font-serif font-bold text-foreground">Add New Pet</h1>
            <p class="text-muted-foreground mt-1">Create a new pet profile for adoption.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <i data-lucide="alert-circle" class="h-5 w-5 text-red-400 flex-shrink-0"></i>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were some errors with your submission:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.shelter.pets.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Column - Basic Information -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-foreground">Basic Information</h2>
                        <!-- Urgency Badge -->
                        <div id="urgency-badge" class="hidden px-4 py-1.5 text-sm font-semibold bg-red-500 text-white rounded-full">
                            🚨 URGENT (0 days)
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Pet Name -->
                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Pet Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   placeholder="Add pet name">
                        </div>

                        <!-- Pet Type -->
                        <div class="form-group">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Pet Type <span class="text-red-500">*</span>
                            </label>
                            <select id="type" name="type" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select type</option>
                                <option value="dog" {{ old('type') === 'dog' ? 'selected' : '' }}>Dog</option>
                                <option value="cat" {{ old('type') === 'cat' ? 'selected' : '' }}>Cat</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Breed -->
                        <div class="form-group">
                            <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                            <select id="breed" name="breed" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select breed</option>
                                <!-- Dog Breeds -->
                                <option value="Aspin" data-type="dog" {{ old('breed') === 'Aspin' ? 'selected' : '' }}>Aspin (Asong Pinoy)</option>
                                <option value="Labrador Retriever" data-type="dog" {{ old('breed') === 'Labrador Retriever' ? 'selected' : '' }}>Labrador Retriever</option>
                                <option value="Golden Retriever" data-type="dog" {{ old('breed') === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                                <option value="German Shepherd" data-type="dog" {{ old('breed') === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                                <option value="Beagle" data-type="dog" {{ old('breed') === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                                <option value="Bulldog" data-type="dog" {{ old('breed') === 'Bulldog' ? 'selected' : '' }}>Bulldog</option>
                                <option value="Poodle" data-type="dog" {{ old('breed') === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                                <option value="Shih Tzu" data-type="dog" {{ old('breed') === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                                <option value="Chihuahua" data-type="dog" {{ old('breed') === 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                                <option value="Dachshund" data-type="dog" {{ old('breed') === 'Dachshund' ? 'selected' : '' }}>Dachshund</option>
                                <option value="Siberian Husky" data-type="dog" {{ old('breed') === 'Siberian Husky' ? 'selected' : '' }}>Siberian Husky</option>
                                <option value="Pomeranian" data-type="dog" {{ old('breed') === 'Pomeranian' ? 'selected' : '' }}>Pomeranian</option>
                                <option value="Mixed Breed (Dog)" data-type="dog" {{ old('breed') === 'Mixed Breed (Dog)' ? 'selected' : '' }}>Mixed Breed</option>
                                <!-- Cat Breeds -->
                                <option value="Puspin" data-type="cat" {{ old('breed') === 'Puspin' ? 'selected' : '' }}>Puspin (Pusang Pinoy)</option>
                                <option value="Persian" data-type="cat" {{ old('breed') === 'Persian' ? 'selected' : '' }}>Persian</option>
                                <option value="Siamese" data-type="cat" {{ old('breed') === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                                <option value="Maine Coon" data-type="cat" {{ old('breed') === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                                <option value="British Shorthair" data-type="cat" {{ old('breed') === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                                <option value="Ragdoll" data-type="cat" {{ old('breed') === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                                <option value="Bengal" data-type="cat" {{ old('breed') === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                                <option value="Scottish Fold" data-type="cat" {{ old('breed') === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                                <option value="Sphynx" data-type="cat" {{ old('breed') === 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                                <option value="Mixed Breed (Cat)" data-type="cat" {{ old('breed') === 'Mixed Breed (Cat)' ? 'selected' : '' }}>Mixed Breed</option>
                            </select>
                        </div>

                        <!-- Age -->
                        <div class="form-group">
                            <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Age (years)</label>
                            <select id="age" name="age" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select age</option>
                                <!-- Months -->
                                <option value="0.08" {{ old('age') == '0.08' ? 'selected' : '' }}>1 month</option>
                                <option value="0.17" {{ old('age') == '0.17' ? 'selected' : '' }}>2 months</option>
                                <option value="0.25" {{ old('age') == '0.25' ? 'selected' : '' }}>3 months</option>
                                <option value="0.33" {{ old('age') == '0.33' ? 'selected' : '' }}>4 months</option>
                                <option value="0.42" {{ old('age') == '0.42' ? 'selected' : '' }}>5 months</option>
                                <option value="0.5" {{ old('age') == '0.5' ? 'selected' : '' }}>6 months</option>
                                <option value="0.58" {{ old('age') == '0.58' ? 'selected' : '' }}>7 months</option>
                                <option value="0.67" {{ old('age') == '0.67' ? 'selected' : '' }}>8 months</option>
                                <option value="0.75" {{ old('age') == '0.75' ? 'selected' : '' }}>9 months</option>
                                <option value="0.83" {{ old('age') == '0.83' ? 'selected' : '' }}>10 months</option>
                                <option value="0.92" {{ old('age') == '0.92' ? 'selected' : '' }}>11 months</option>
                                <!-- Years -->
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('age') == $i ? 'selected' : '' }}>{{ $i }} {{ $i == 1 ? 'year' : 'years' }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Gender -->
                        <div class="form-group">
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                Gender <span class="text-red-500">*</span>
                            </label>
                            <select id="gender" name="gender" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select gender</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <!-- Size -->
                        <div class="form-group">
                            <label for="size" class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                            <select id="size" name="size" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select size</option>
                                <option value="small" {{ old('size') === 'small' ? 'selected' : '' }}>Small</option>
                                <option value="medium" {{ old('size') === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="large" {{ old('size') === 'large' ? 'selected' : '' }}>Large</option>
                            </select>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="form-group">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <select id="location" name="location" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                @if(auth()->user()->hasShelterLocation()) readonly disabled @endif>
                            <option value="">Select location</option>
                            @php
                                $locations = [
                                    'Caloocan', 'Las Piñas', 'Makati', 'Malabon', 'Mandaluyong',
                                    'Manila', 'Marikina', 'Muntinlupa', 'Navotas', 'Parañaque',
                                    'Pasay', 'Pasig', 'Quezon City', 'San Juan', 'Taguig',
                                    'Valenzuela', 'Pateros'
                                ];
                                $userLocation = auth()->user()->shelter_location ?? old('location');
                            @endphp
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}" {{ $userLocation === $loc ? 'selected' : '' }}>
                                    {{ $loc }}
                                </option>
                            @endforeach
                        </select>
                        @if(auth()->user()->hasShelterLocation())
                            <input type="hidden" name="location" value="{{ auth()->user()->shelter_location }}">
                            <p class="text-xs text-gray-500 mt-1">Auto-assigned to your shelter location</p>
                        @endif
                    </div>

                    <!-- Date Added to Shelter -->
                    <div class="form-group">
                        <label for="date_added" class="block text-sm font-medium text-gray-700 mb-2">
                            Date Added to Shelter <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="date_added" name="date_added" value="{{ old('date_added', date('Y-m-d')) }}" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Pets will be marked as urgent if in shelter for 7+ days</p>
                    </div>

                    <!-- Short Description -->
                    <div class="form-group">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                  placeholder="Brief description for pet listing">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column - Photo & Characteristics -->
            <div class="space-y-6">
                <!-- Pet Photos -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-foreground mb-4">Pet Photos</h3>
                    
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Photos (1-5 images required) <span class="text-red-500">*</span>
                        </label>
                        
                        <!-- Hidden file input -->
                        <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/gif" multiple class="hidden">
                        
                        <!-- Custom upload button -->
                        <button type="button" onclick="document.getElementById('images').click()" 
                                class="w-full px-4 py-8 border-2 border-dashed border-purple-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-all duration-200 flex flex-col items-center justify-center space-y-2 text-center">
                            <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-purple-600">Click to select images</p>
                                <p class="text-xs text-gray-500 mt-1">or drag and drop here</p>
                            </div>
                        </button>
                        
                        <p class="text-xs text-gray-500 mt-2">
                            Accepted formats: JPG, PNG, GIF. Max size: 2MB per image. 
                            <span class="font-semibold">Minimum 1, Maximum 5 images.</span>
                        </p>
                        <p class="text-xs text-purple-600 mt-1">
                            💡 The first image will be the primary display image.
                        </p>
                    </div>

                    <!-- Image Previews -->
                    <div id="image-previews" class="hidden mt-4 space-y-2">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm font-medium text-gray-700">Selected Images: <span id="image-count">0</span>/5</p>
                            <div class="space-x-2">
                                <button type="button" onclick="document.getElementById('images').click()" 
                                        class="text-xs text-purple-600 hover:text-purple-800 font-medium">
                                    + Add More
                                </button>
                                <button type="button" onclick="clearAllImages()" class="text-xs text-red-600 hover:text-red-800">Clear All</button>
                            </div>
                        </div>
                        <div id="preview-container" class="grid grid-cols-2 gap-3"></div>
                    </div>
                </div>

                <!-- Health & Characteristics -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-foreground mb-4">Health</h3>
                    
                    <div class="space-y-4">
                        <!-- Health -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Health:</label>
                            <div class="space-y-3">
                                <!-- Vaccinated -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_vaccinated" value="0">
                                    <input type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1" 
                                           {{ old('is_vaccinated') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Vaccinated</span>
                                </label>

                                <!-- Spayed/Neutered -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_neutered" value="0">
                                    <input type="checkbox" id="is_neutered" name="is_neutered" value="1" 
                                           {{ old('is_neutered') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Spayed/Neutered</span>
                                </label>

                                <!-- Dewormed -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_dewormed" value="0">
                                    <input type="checkbox" id="is_dewormed" name="is_dewormed" value="1" 
                                           {{ old('is_dewormed') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Dewormed</span>
                                </label>

                                <!-- On Preventive Medication -->
                                <label class="flex items-center">
                                    <input type="hidden" name="on_preventive_medication" value="0">
                                    <input type="checkbox" id="on_preventive_medication" name="on_preventive_medication" value="1" 
                                           {{ old('on_preventive_medication') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">On Preventive Medication</span>
                                </label>

                                <!-- Has Special Medical Needs -->
                                <label class="flex items-center">
                                    <input type="hidden" name="has_special_medical_needs" value="0">
                                    <input type="checkbox" id="has_special_medical_needs" name="has_special_medical_needs" value="1" 
                                           {{ old('has_special_medical_needs') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Has Special Medical Needs</span>
                                </label>

                                <!-- Disabled / Mobility Impaired -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_mobility_impaired" value="0">
                                    <input type="checkbox" id="is_mobility_impaired" name="is_mobility_impaired" value="1" 
                                           {{ old('is_mobility_impaired') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Disabled / Mobility Impaired</span>
                                </label>

                                <!-- Undergoing Treatment -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_undergoing_treatment" value="0">
                                    <input type="checkbox" id="is_undergoing_treatment" name="is_undergoing_treatment" value="1" 
                                           {{ old('is_undergoing_treatment') ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Undergoing Treatment</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-foreground mb-4">Availability</h3>
                    <div class="flex items-center justify-between">
                        <label for="is_available" class="text-sm font-medium text-gray-700">Available for Adoption</label>
                        <input type="hidden" name="is_available" value="0">
                        <input type="checkbox" id="is_available" name="is_available" value="1" 
                               {{ old('is_available', '1') ? 'checked' : '' }}
                               class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.shelter.pets.index') }}" 
               class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2.5 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors duration-200 flex items-center space-x-2">
                <i data-lucide="plus" class="h-4 w-4"></i>
                <span>Add Pet</span>
            </button>
        </div>
    </form>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Breed filter based on pet type
    const typeSelect = document.getElementById('type');
    const breedSelect = document.getElementById('breed');

    function updateBreedOptions() {
        const selectedType = typeSelect.value;
        
        // Get all breed options
        const breedOptions = breedSelect.querySelectorAll('option');
        
        // Reset breed selection if it doesn't match the new type
        const currentBreed = breedSelect.value;
        const currentBreedOption = breedSelect.querySelector(`option[value="${currentBreed}"]`);
        if (currentBreedOption && currentBreedOption.dataset.type !== selectedType) {
            breedSelect.value = '';
        }
        
        // Show/hide breed options based on selected type
        breedOptions.forEach(option => {
            if (option.value === '') {
                // Always show the "Select breed" option
                option.style.display = 'block';
            } else if (option.dataset.type === selectedType) {
                // Show breeds matching the selected type
                option.style.display = 'block';
            } else {
                // Hide breeds that don't match
                option.style.display = 'none';
            }
        });
    }

    // Update breeds when type changes
    typeSelect.addEventListener('change', updateBreedOptions);
    
    // Urgency calculation based on date added
    const dateAddedInput = document.getElementById('date_added');
    const urgencyBadge = document.getElementById('urgency-badge');

    function checkUrgency() {
        if (!dateAddedInput.value) {
            urgencyBadge.classList.add('hidden');
            return;
        }

        // Parse the input date (format: YYYY-MM-DD)
        const dateAdded = new Date(dateAddedInput.value + 'T00:00:00');
        const today = new Date();
        today.setHours(0, 0, 0, 0); // Set to midnight for accurate day comparison
        
        // Calculate the difference in milliseconds
        const diffTime = today.getTime() - dateAdded.getTime();
        
        // Convert to days (only count positive differences)
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays >= 7) {
            urgencyBadge.classList.remove('hidden');
            urgencyBadge.innerHTML = `🚨 URGENT (${diffDays} days)`;
        } else {
            urgencyBadge.classList.add('hidden');
        }
    }

    // Check urgency when date changes
    dateAddedInput.addEventListener('change', checkUrgency);
    dateAddedInput.addEventListener('input', checkUrgency);
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateBreedOptions();
        checkUrgency(); // Check urgency on load
        lucide.createIcons();
    });

    // Multiple image preview functionality
    let selectedFiles = [];
    const imageInput = document.getElementById('images');
    const uploadButton = imageInput.previousElementSibling;
    
    // File input change event
    imageInput.addEventListener('change', function(e) {
        handleFiles(Array.from(e.target.files));
    });
    
    // Drag and drop functionality
    uploadButton.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('border-purple-500', 'bg-purple-50');
    });
    
    uploadButton.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-purple-500', 'bg-purple-50');
    });
    
    uploadButton.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-purple-500', 'bg-purple-50');
        
        const files = Array.from(e.dataTransfer.files);
        handleFiles(files);
    });
    
    function handleFiles(files) {
        // If no files selected, just return
        if (files.length === 0) {
            return;
        }
        
        // Append to existing files or replace
        const totalFiles = selectedFiles.length + files.length;
        
        if (totalFiles > 5) {
            const remaining = 5 - selectedFiles.length;
            if (remaining <= 0) {
                alert('Maximum 5 images already selected. Please clear some images first.');
                return;
            }
            alert(`Maximum 5 images allowed. Adding only ${remaining} more image(s).`);
            files = files.slice(0, remaining);
        }
        
        // Validate each file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        let hasErrors = false;
        let validFiles = [];
        
        for (let file of files) {
            // Check file size (2MB)
            if (file.size > 2097152) {
                alert(`File "${file.name}" is too large. Max size is 2MB.`);
                hasErrors = true;
                continue;
            }
            
            // Check file type
            if (!allowedTypes.includes(file.type)) {
                alert(`File "${file.name}" is not a valid image type. Only JPG, PNG, and GIF allowed.`);
                hasErrors = true;
                continue;
            }
            
            validFiles.push(file);
        }
        
        if (validFiles.length > 0) {
            selectedFiles = [...selectedFiles, ...validFiles];
            updateFileInput();
            displayImagePreviews(selectedFiles);
        }
    }
    
    function updateFileInput() {
        // Create a new DataTransfer object to update the file input
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imageInput.files = dataTransfer.files;
    }
    
    function displayImagePreviews(files) {
        const container = document.getElementById('preview-container');
        const countSpan = document.getElementById('image-count');
        const previewsDiv = document.getElementById('image-previews');
        
        container.innerHTML = '';
        countSpan.textContent = files.length;
        
        if (files.length > 0) {
            previewsDiv.classList.remove('hidden');
            
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" 
                             class="w-full h-32 object-cover rounded-lg border-2 ${index === 0 ? 'border-purple-500' : 'border-gray-200'}">
                        ${index === 0 ? '<div class="absolute top-1 left-1 bg-purple-600 text-white text-xs px-2 py-1 rounded">Primary</div>' : ''}
                        <div class="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">${index + 1}</div>
                        <button type="button" onclick="removeImage(${index})" 
                                class="absolute bottom-1 right-1 bg-red-600 hover:bg-red-700 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } else {
            previewsDiv.classList.add('hidden');
        }
    }
    
    function removeImage(index) {
        selectedFiles.splice(index, 1);
        updateFileInput();
        displayImagePreviews(selectedFiles);
        
        if (selectedFiles.length === 0) {
            document.getElementById('image-previews').classList.add('hidden');
        }
    }
    
    function clearAllImages() {
        imageInput.value = '';
        selectedFiles = [];
        document.getElementById('image-previews').classList.add('hidden');
        document.getElementById('preview-container').innerHTML = '';
        document.getElementById('image-count').textContent = '0';
    }
</script>
@endsection
