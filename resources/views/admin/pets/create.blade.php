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
                <!-- Pet Photo -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-foreground mb-4">Pet Photo</h3>
                    
                    <div class="form-group">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Photo</label>
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        <p class="text-xs text-gray-500 mt-2">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
                    </div>

                    <!-- Image Preview -->
                    <div id="image-preview" class="hidden mt-4">
                        <img id="preview-img" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                </div>

                <!-- Health & Characteristics -->
                <div class="card">
                    <h3 class="text-xl font-semibold text-foreground mb-4">Health & Characteristics</h3>
                    
                    <div class="space-y-4">
                        <!-- Vaccinated -->
                        <div class="flex items-center justify-between py-2">
                            <label for="is_vaccinated" class="text-sm font-medium text-gray-700">Vaccinated</label>
                            <input type="hidden" name="is_vaccinated" value="0">
                            <input type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1" 
                                   {{ old('is_vaccinated') ? 'checked' : '' }}
                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        </div>

                        <!-- Spayed/Neutered -->
                        <div class="flex items-center justify-between py-2">
                            <label for="is_neutered" class="text-sm font-medium text-gray-700">Spayed/Neutered</label>
                            <input type="hidden" name="is_neutered" value="0">
                            <input type="checkbox" id="is_neutered" name="is_neutered" value="1" 
                                   {{ old('is_neutered') ? 'checked' : '' }}
                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        </div>

                        <!-- Characteristics -->
                        <div class="pt-2">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Characteristics</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="energetic"
                                           {{ in_array('energetic', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Energetic</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="good_with_kids"
                                           {{ in_array('good_with_kids', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Good with Kids</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="good_with_pets"
                                           {{ in_array('good_with_pets', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <span class="ml-3 text-sm text-gray-700">Good with Other Pets</span>
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

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (2MB = 2097152 bytes)
            if (file.size > 2097152) {
                customAlert('File size must be less than 2MB', 'warning');
                this.value = '';
                document.getElementById('image-preview').classList.add('hidden');
                return;
            }
            
            // Check file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                customAlert('Only JPG, PNG, and GIF files are allowed', 'warning');
                this.value = '';
                document.getElementById('image-preview').classList.add('hidden');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').classList.add('hidden');
        }
    });
</script>
@endsection
