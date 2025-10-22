@extends('admin.layouts.app')

@section('title', 'Edit ' . $pet->name . ' - PawPal Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.pets.index') }}" class="p-2 hover:bg-muted rounded-lg transition-colors duration-200">
                <i data-lucide="arrow-left" class="h-5 w-5"></i>
            </a>
            <div>
                <h1 class="text-4xl font-serif font-bold text-foreground">Edit {{ $pet->name }}</h1>
                <p class="text-lg text-muted-foreground mt-2">Update pet information and availability.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.pets.toggle-availability', $pet) }}" class="inline-block">
            @csrf
            <button type="submit" class="inline-flex items-center space-x-2 {{ $pet->is_available ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i data-lucide="{{ $pet->is_available ? 'x-circle' : 'check-circle' }}" class="h-4 w-4"></i>
                <span>Mark as {{ $pet->is_available ? 'Unavailable' : 'Available' }}</span>
            </button>
        </form>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex">
                <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
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

    <form method="POST" action="{{ route('admin.pets.update', $pet) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Left Side - Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-border p-6 space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-serif font-bold text-foreground">Basic Information</h2>
                    <div id="urgency-badge" class="px-3 py-1 text-sm rounded-full font-bold bg-orange-100 text-orange-800 border border-orange-200 {{ $pet->is_urgent ? '' : 'hidden' }}">
                        🚨 URGENT{{ $pet->is_urgent ? ' (' . $pet->days_in_shelter . ' days)' : '' }}
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-2">Pet Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $pet->name) }}" required
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter pet name">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-foreground mb-2">Pet Type *</label>
                        <select id="type" name="type" required class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select type</option>
                            <option value="dog" {{ old('type', $pet->type) === 'dog' ? 'selected' : '' }}>Dog</option>
                            <option value="cat" {{ old('type', $pet->type) === 'cat' ? 'selected' : '' }}>Cat</option>
                            <option value="other" {{ old('type', $pet->type) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="breed" class="block text-sm font-medium text-foreground mb-2">Breed</label>
                        <input type="text" id="breed" name="breed" value="{{ old('breed', $pet->breed) }}"
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter breed">
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-foreground mb-2">Age (years)</label>
                        <input type="number" id="age" name="age" value="{{ old('age', $pet->age) }}" min="0"
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter age">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-foreground mb-2">Gender *</label>
                        <select id="gender" name="gender" required class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender', $pet->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $pet->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-foreground mb-2">Size</label>
                        <select id="size" name="size" class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select size</option>
                            <option value="small" {{ old('size', $pet->size) === 'small' ? 'selected' : '' }}>Small</option>
                            <option value="medium" {{ old('size', $pet->size) === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="large" {{ old('size', $pet->size) === 'large' ? 'selected' : '' }}>Large</option>
                        </select>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-foreground mb-2">Location</label>
                        <select id="location" name="location" class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select location</option>
                            <option value="Caloocan" {{ old('location', $pet->location) === 'Caloocan' ? 'selected' : '' }}>Caloocan</option>
                            <option value="Las Piñas" {{ old('location', $pet->location) === 'Las Piñas' ? 'selected' : '' }}>Las Piñas</option>
                            <option value="Makati" {{ old('location', $pet->location) === 'Makati' ? 'selected' : '' }}>Makati</option>
                            <option value="Malabon" {{ old('location', $pet->location) === 'Malabon' ? 'selected' : '' }}>Malabon</option>
                            <option value="Mandaluyong" {{ old('location', $pet->location) === 'Mandaluyong' ? 'selected' : '' }}>Mandaluyong</option>
                            <option value="Manila" {{ old('location', $pet->location) === 'Manila' ? 'selected' : '' }}>Manila</option>
                            <option value="Marikina" {{ old('location', $pet->location) === 'Marikina' ? 'selected' : '' }}>Marikina</option>
                            <option value="Muntinlupa" {{ old('location', $pet->location) === 'Muntinlupa' ? 'selected' : '' }}>Muntinlupa</option>
                            <option value="Navotas" {{ old('location', $pet->location) === 'Navotas' ? 'selected' : '' }}>Navotas</option>
                            <option value="Parañaque" {{ old('location', $pet->location) === 'Parañaque' ? 'selected' : '' }}>Parañaque</option>
                            <option value="Pasay" {{ old('location', $pet->location) === 'Pasay' ? 'selected' : '' }}>Pasay</option>
                            <option value="Pasig" {{ old('location', $pet->location) === 'Pasig' ? 'selected' : '' }}>Pasig</option>
                            <option value="Quezon City" {{ old('location', $pet->location) === 'Quezon City' ? 'selected' : '' }}>Quezon City</option>
                            <option value="San Juan" {{ old('location', $pet->location) === 'San Juan' ? 'selected' : '' }}>San Juan</option>
                            <option value="Taguig" {{ old('location', $pet->location) === 'Taguig' ? 'selected' : '' }}>Taguig</option>
                            <option value="Valenzuela" {{ old('location', $pet->location) === 'Valenzuela' ? 'selected' : '' }}>Valenzuela</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="date_added" class="block text-sm font-medium text-foreground mb-2">Date Added to Shelter *</label>
                    <input type="date" id="date_added" name="date_added" value="{{ old('date_added', $pet->date_added ? $pet->date_added->format('Y-m-d') : '') }}" required
                           class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                    <p class="text-xs text-muted-foreground mt-1">Pets will be marked as urgent if in shelter for 7+ days</p>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-foreground mb-2">Short Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Brief description for pet listing">{{ old('description', $pet->description) }}</textarea>
                </div>
            </div>

            <!-- Right Side - Additional Details -->
            <div class="space-y-8">
                <!-- Current Images & Upload -->
                <div class="bg-white rounded-lg shadow-sm border border-border p-6">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Pet Photos</h3>
                    <div class="space-y-6">
                        <!-- Existing Images -->
                        @if($pet->images->count() > 0)
                            <div>
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm font-medium text-foreground">Current Photos: {{ $pet->images->count() }}/5</p>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach($pet->images as $image)
                                        <div class="relative group" id="existing-image-{{ $image->id }}">
                                            <img src="{{ $image->image_url }}" alt="{{ $pet->name }}" 
                                                 class="w-full h-40 object-cover rounded-lg border-2 {{ $image->is_primary ? 'border-purple-500' : 'border-gray-200' }} shadow-sm">
                                            @if($image->is_primary)
                                                <div class="absolute top-2 left-2 bg-purple-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
                                                    ⭐ Primary
                                                </div>
                                            @endif
                                            <button type="button" onclick="deleteExistingImage({{ $image->id }})"
                                                    class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- Upload New Images -->
                        @if($pet->images->count() < 5)
                            <div>
                                <label class="block text-base font-medium text-foreground mb-3">
                                    Add More Photos ({{ 5 - $pet->images->count() }} remaining)
                                </label>
                                
                                <!-- Hidden file input -->
                                <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/gif" multiple class="hidden">
                                
                                <!-- Drag and Drop Area -->
                                <div id="dropZone" class="border-2 border-dashed border-purple-300 rounded-xl p-8 text-center hover:border-purple-500 transition-all duration-200 cursor-pointer bg-purple-50/50">
                                    <div class="space-y-3">
                                        <svg class="mx-auto h-16 w-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <div>
                                            <p class="text-lg font-semibold text-purple-700">Click to select images</p>
                                            <p class="text-sm text-gray-600">or drag and drop here</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-xs text-muted-foreground mt-2 text-center">
                                    Accepted formats: JPG, PNG, GIF. Max size: 2MB per image. Maximum {{ 5 - $pet->images->count() }} more images.
                                </p>
                                <p class="text-xs text-purple-600 mt-1 text-center font-medium">
                                    💡 The first image will be the primary display image.
                                </p>
                            </div>
                            
                            <!-- New Image Previews -->
                            <div id="image-previews" class="hidden">
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm font-medium text-foreground">New Photos: <span id="image-count">0</span></p>
                                    <button type="button" onclick="clearAllImages()" class="text-sm text-red-600 hover:text-red-700 font-medium">Clear All</button>
                                </div>
                                <div id="preview-container" class="grid grid-cols-3 gap-4"></div>
                                <button type="button" id="addMoreBtn" onclick="document.getElementById('images').click()" 
                                        class="mt-4 w-full py-3 border-2 border-dashed border-purple-300 rounded-lg text-purple-700 hover:border-purple-500 hover:bg-purple-50 transition-all duration-200 font-medium">
                                    + Add More Images
                                </button>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    <svg class="h-5 w-5 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <p class="text-sm text-yellow-800">
                                        Maximum of 5 images reached. Delete an existing image to add more.
                                    </p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Hidden input to track deleted images -->
                        <input type="hidden" id="delete_images" name="delete_images[]" value="">
                    </div>
                </div>

                <!-- Health & Characteristics -->
                <div class="bg-white rounded-lg shadow-sm border border-border p-6">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Health</h3>
                    
                    <div class="space-y-4">
                        <!-- Health -->
                        <div>
                            <label class="block text-sm font-medium text-foreground mb-3">Health:</label>
                            <div class="space-y-3">
                                <!-- Vaccinated -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_vaccinated" value="0">
                                    <input type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1" 
                                           {{ old('is_vaccinated', $pet->is_vaccinated) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Vaccinated</span>
                                </label>

                                <!-- Spayed/Neutered -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_neutered" value="0">
                                    <input type="checkbox" id="is_neutered" name="is_neutered" value="1" 
                                           {{ old('is_neutered', $pet->is_neutered) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Spayed/Neutered</span>
                                </label>

                                <!-- Dewormed -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_dewormed" value="0">
                                    <input type="checkbox" id="is_dewormed" name="is_dewormed" value="1" 
                                           {{ old('is_dewormed', $pet->is_dewormed) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Dewormed</span>
                                </label>

                                <!-- On Preventive Medication -->
                                <label class="flex items-center">
                                    <input type="hidden" name="on_preventive_medication" value="0">
                                    <input type="checkbox" id="on_preventive_medication" name="on_preventive_medication" value="1" 
                                           {{ old('on_preventive_medication', $pet->on_preventive_medication) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">On Preventive Medication</span>
                                </label>

                                <!-- Has Special Medical Needs -->
                                <label class="flex items-center">
                                    <input type="hidden" name="has_special_medical_needs" value="0">
                                    <input type="checkbox" id="has_special_medical_needs" name="has_special_medical_needs" value="1" 
                                           {{ old('has_special_medical_needs', $pet->has_special_medical_needs) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Has Special Medical Needs</span>
                                </label>

                                <!-- Disabled / Mobility Impaired -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_mobility_impaired" value="0">
                                    <input type="checkbox" id="is_mobility_impaired" name="is_mobility_impaired" value="1" 
                                           {{ old('is_mobility_impaired', $pet->is_mobility_impaired) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Disabled / Mobility Impaired</span>
                                </label>

                                <!-- Undergoing Treatment -->
                                <label class="flex items-center">
                                    <input type="hidden" name="is_undergoing_treatment" value="0">
                                    <input type="checkbox" id="is_undergoing_treatment" name="is_undergoing_treatment" value="1" 
                                           {{ old('is_undergoing_treatment', $pet->is_undergoing_treatment) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                                    <span class="ml-3 text-sm text-foreground">Undergoing Treatment</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Availability -->
                <div class="bg-white rounded-lg shadow-sm border border-border p-6">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Availability</h3>
                    <div class="flex items-center justify-between">
                        <label for="is_available" class="text-sm font-medium text-foreground">Available for Adoption</label>
                        <input type="hidden" name="is_available" value="0">
                        <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', $pet->is_available) ? 'checked' : '' }}
                               class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-border">
            <a href="{{ route('admin.pets.show', $pet) }}" class="px-6 py-3 bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200">
                View Pet
            </a>
            <a href="{{ route('admin.pets.index') }}" class="px-6 py-3 bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200">
                Back to List
            </a>
            <button type="submit" class="inline-flex items-center space-x-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();

    let imagesToDelete = [];
    let existingImageCount = {{ $pet->images->count() }};
    const maxImages = 5;
    
    // Track images to delete
    function deleteExistingImage(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            imagesToDelete.push(imageId);
            document.getElementById('existing-image-' + imageId).style.display = 'none';
            existingImageCount--;
            updateDeleteInput();
            
            // Show upload section if we now have space
            const uploadSection = document.querySelector('input[name="images[]"]');
            if (uploadSection && existingImageCount < maxImages) {
                uploadSection.closest('div').querySelector('label').textContent = 
                    `Add More Photos (${maxImages - existingImageCount} remaining)`;
            }
        }
    }
    
    function updateDeleteInput() {
        const input = document.getElementById('delete_images');
        if (imagesToDelete.length > 0) {
            input.value = imagesToDelete.join(',');
            input.name = 'delete_images[]';
            // Create separate hidden inputs for each ID
            const form = input.closest('form');
            imagesToDelete.forEach(id => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'delete_images[]';
                hiddenInput.value = id;
                form.appendChild(hiddenInput);
            });
        }
    }
    
    // Multiple image preview functionality
    const imagesInput = document.getElementById('images');
    const dropZone = document.getElementById('dropZone');
    let selectedFiles = [];
    
    // Click to upload
    if (dropZone) {
        dropZone.addEventListener('click', function() {
            imagesInput.click();
        });
        
        // Drag and drop handlers
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.add('border-purple-500', 'bg-purple-100');
        });
        
        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-purple-500', 'bg-purple-100');
        });
        
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.classList.remove('border-purple-500', 'bg-purple-100');
            
            const files = Array.from(e.dataTransfer.files);
            handleFiles(files);
        });
    }
    
    if (imagesInput) {
        imagesInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            handleFiles(files);
        });
    }
    
    function handleFiles(files) {
        const remainingSlots = maxImages - existingImageCount - selectedFiles.length;
        
        // Validate file count
        if (files.length > remainingSlots) {
            alert(`You can only upload ${remainingSlots} more image(s). Maximum is ${maxImages} total.`);
            return;
        }
        
        // Validate each file
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        let hasErrors = false;
        
        for (let file of files) {
            if (file.size > 2097152) {
                alert(`File "${file.name}" is too large. Max size is 2MB.`);
                hasErrors = true;
                break;
            }
            
            if (!allowedTypes.includes(file.type)) {
                alert(`File "${file.name}" is not a valid image type. Only JPG, PNG, and GIF are allowed.`);
                hasErrors = true;
                break;
            }
        }
        
        if (hasErrors) {
            return;
        }
        
        // Add files to selected files array
        selectedFiles = selectedFiles.concat(Array.from(files));
        
        // Update the file input
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imagesInput.files = dataTransfer.files;
        
        // Display previews
        displayImagePreviews(selectedFiles);
        
        // Update "Add More" button visibility
        updateAddMoreButton();
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
                             class="w-full h-40 object-cover rounded-lg border-2 ${index === 0 ? 'border-purple-500' : 'border-gray-200'} shadow-sm">
                        ${index === 0 ? '<div class="absolute top-2 left-2 bg-purple-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">⭐ Primary</div>' : ''}
                        <button type="button" onclick="removeImage(${index})" 
                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg">
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
        
        // Update the file input
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        imagesInput.files = dataTransfer.files;
        
        displayImagePreviews(selectedFiles);
        updateAddMoreButton();
    }
    
    function clearAllImages() {
        selectedFiles = [];
        imagesInput.value = '';
        document.getElementById('image-previews').classList.add('hidden');
        document.getElementById('preview-container').innerHTML = '';
        updateAddMoreButton();
    }
    
    function updateAddMoreButton() {
        const addMoreBtn = document.getElementById('addMoreBtn');
        if (addMoreBtn) {
            const remainingSlots = maxImages - existingImageCount - selectedFiles.length;
            if (remainingSlots <= 0) {
                addMoreBtn.style.display = 'none';
            } else {
                addMoreBtn.style.display = 'block';
            }
        }
    }

    // Urgency check functionality
    function checkUrgency() {
        const dateAddedInput = document.getElementById('date_added');
        const urgencyBadge = document.getElementById('urgency-badge');
        
        if (dateAddedInput && urgencyBadge && dateAddedInput.value) {
            const dateAdded = new Date(dateAddedInput.value);
            const today = new Date();
            const diffTime = Math.abs(today - dateAdded);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays >= 7) {
                urgencyBadge.classList.remove('hidden');
                urgencyBadge.innerHTML = `🚨 URGENT (${diffDays} days)`;
            } else {
                urgencyBadge.classList.add('hidden');
            }
        } else if (urgencyBadge) {
            urgencyBadge.classList.add('hidden');
        }
    }

    // Check urgency on page load and when date changes
    document.addEventListener('DOMContentLoaded', checkUrgency);
    const dateInput = document.getElementById('date_added');
    if (dateInput) {
        dateInput.addEventListener('change', checkUrgency);
    }
</script>
@endsection