@extends('admin.layouts.app')

@section('title', 'Add New Pet - PawPal Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.pets.index') }}" class="p-2 hover:bg-muted rounded-lg transition-colors duration-200">
            <i data-lucide="arrow-left" class="h-5 w-5"></i>
        </a>
        <div>
            <h1 class="text-4xl font-serif font-bold text-foreground">Add New Pet</h1>
            <p class="text-lg text-muted-foreground mt-2">Create a new pet profile for adoption.</p>
        </div>
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

    <form method="POST" action="{{ route('admin.pets.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        
        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Left Side - Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-border p-6 space-y-6">
                <h2 class="text-2xl font-serif font-bold text-foreground">Basic Information</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-2">Pet Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter pet name">
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-foreground mb-2">Pet Type *</label>
                        <select id="type" name="type" required class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select type</option>
                            <option value="dog" {{ old('type') === 'dog' ? 'selected' : '' }}>Dog</option>
                            <option value="cat" {{ old('type') === 'cat' ? 'selected' : '' }}>Cat</option>
                            <option value="other" {{ old('type') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="breed" class="block text-sm font-medium text-foreground mb-2">Breed</label>
                        <input type="text" id="breed" name="breed" value="{{ old('breed') }}"
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter breed">
                    </div>
                    <div>
                        <label for="age" class="block text-sm font-medium text-foreground mb-2">Age (years)</label>
                        <input type="number" id="age" name="age" value="{{ old('age') }}" min="0"
                               class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Enter age">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-foreground mb-2">Gender *</label>
                        <select id="gender" name="gender" required class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="size" class="block text-sm font-medium text-foreground mb-2">Size</label>
                        <select id="size" name="size" class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Select size</option>
                            <option value="small" {{ old('size') === 'small' ? 'selected' : '' }}>Small</option>
                            <option value="medium" {{ old('size') === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="large" {{ old('size') === 'large' ? 'selected' : '' }}>Large</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="adoption_fee" class="block text-sm font-medium text-foreground mb-2">Adoption Fee ($)</label>
                    <input type="number" id="adoption_fee" name="adoption_fee" value="{{ old('adoption_fee') }}" min="0" step="0.01"
                           class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                           placeholder="0.00">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-foreground mb-2">Short Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Brief description for pet listing">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="medical_history" class="block text-sm font-medium text-foreground mb-2">Medical History</label>
                    <textarea id="medical_history" name="medical_history" rows="4"
                              class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Medical history, medications, special needs, etc.">{{ old('medical_history') }}</textarea>
                </div>
            </div>

            <!-- Right Side - Additional Details -->
            <div class="space-y-8">
                <!-- Image Upload -->
                <div class="bg-white rounded-lg shadow-sm border border-border p-6">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Pet Photo</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="image" class="block text-sm font-medium text-foreground mb-2">Upload Photo</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="w-full px-3 py-2 border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <p class="text-xs text-muted-foreground mt-1">Accepted formats: JPG, PNG, GIF. Max size: 2MB</p>
                        </div>
                        <div id="image-preview" class="hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                        </div>
                    </div>
                </div>

                <!-- Health & Characteristics -->
                <div class="bg-white rounded-lg shadow-sm border border-border p-6">
                    <h3 class="text-xl font-serif font-bold text-foreground mb-4">Health & Characteristics</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label for="is_vaccinated" class="text-sm font-medium text-foreground">Vaccinated</label>
                            <input type="hidden" name="is_vaccinated" value="0">
                            <input type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1" {{ old('is_vaccinated') ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="is_neutered" class="text-sm font-medium text-foreground">Spayed/Neutered</label>
                            <input type="hidden" name="is_neutered" value="0">
                            <input type="checkbox" id="is_neutered" name="is_neutered" value="1" {{ old('is_neutered') ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-foreground mb-2">Characteristics</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="friendly" 
                                           {{ in_array('friendly', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Friendly</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="playful"
                                           {{ in_array('playful', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Playful</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="calm"
                                           {{ in_array('calm', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Calm</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="energetic"
                                           {{ in_array('energetic', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Energetic</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="good_with_kids"
                                           {{ in_array('good_with_kids', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Good with Kids</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="characteristics[]" value="good_with_pets"
                                           {{ in_array('good_with_pets', old('characteristics', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary focus:ring-primary border-border rounded mr-2">
                                    <span class="text-sm">Good with Other Pets</span>
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
                        <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', 1) ? 'checked' : '' }}
                               class="h-4 w-4 text-primary focus:ring-primary border-border rounded">
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-border">
            <a href="{{ route('admin.pets.index') }}" class="px-6 py-3 bg-transparent border border-border rounded-lg hover:bg-muted transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center space-x-2 bg-primary hover:bg-primary/90 text-primary-foreground px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>Add Pet</span>
            </button>
        </div>
    </form>
</div>

<script>
    lucide.createIcons();

    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection