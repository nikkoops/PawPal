{{-- Edit Pet Modal --}}
<div id="editPetModal-{{ $pet->id }}" 
     x-data="editPetModal({{ $pet->id }}, @js($petData))" 
     x-show="open" 
     x-cloak
     @keydown.escape.window="open = false" 
     class="fixed inset-0 z-50 overflow-y-auto hidden" 
     style="display: none;"
     data-pet-id="{{ $pet->id }}">
    
    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="open = false"></div>
    
    {{-- Modal Content --}}
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-7xl mx-auto max-h-[95vh] overflow-y-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between p-6 border-b border-gray-200 sticky top-0 bg-white z-10">
                <div>
                    <h1 class="text-3xl font-serif font-bold text-foreground">Edit Pet</h1>
                    <p class="text-muted-foreground mt-1">Update pet profile information.</p>
                </div>
                <button @click="open = false" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            {{-- Error Messages --}}
            <div x-show="Object.keys(errors).length > 0" class="mx-6 mt-4 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-400 flex-shrink-0"></i>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were some errors with your submission:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            <template x-for="(errorArray, field) in errors" :key="field">
                                <template x-for="error in errorArray" :key="error">
                                    <li x-text="error"></li>
                                </template>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form @submit.prevent="updatePet" class="p-6">
                <div class="grid lg:grid-cols-3 gap-6">
                    {{-- Left Column - Basic Information --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="card">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-semibold text-foreground">Basic Information</h2>
                                {{-- Urgency Badge --}}
                                <div x-show="pet.is_urgent && pet.is_available" class="px-3 py-1 text-sm rounded-full font-bold bg-orange-100 text-orange-800 border border-orange-200">
                                    🚨 URGENT (<span x-text="pet.days_in_shelter || 0"></span> days)
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Pet Name --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pet Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           x-model="pet.name" 
                                           name="name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                           placeholder="Add pet name"
                                           required>
                                </div>

                                {{-- Pet Type --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Pet Type <span class="text-red-500">*</span>
                                    </label>
                                    <select x-model="pet.type" 
                                            name="type"
                                            @change="updateBreedOptions()"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                            required>
                                        <option value="">Select type</option>
                                        <option value="dog">Dog</option>
                                        <option value="cat">Cat</option>
                                    </select>
                                </div>
                            </div>
                    
                            <div class="grid grid-cols-2 gap-4">
                                {{-- Breed --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                                    <select x-model="pet.breed" 
                                            name="breed" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Select breed</option>
                                        {{-- Dog Breeds --}}
                                        <option value="Aspin" data-type="dog">Aspin (Asong Pinoy)</option>
                                        <option value="Labrador Retriever" data-type="dog">Labrador Retriever</option>
                                        <option value="Golden Retriever" data-type="dog">Golden Retriever</option>
                                        <option value="German Shepherd" data-type="dog">German Shepherd</option>
                                        <option value="Beagle" data-type="dog">Beagle</option>
                                        <option value="Bulldog" data-type="dog">Bulldog</option>
                                        <option value="Poodle" data-type="dog">Poodle</option>
                                        <option value="Shih Tzu" data-type="dog">Shih Tzu</option>
                                        <option value="Chihuahua" data-type="dog">Chihuahua</option>
                                        <option value="Dachshund" data-type="dog">Dachshund</option>
                                        <option value="Siberian Husky" data-type="dog">Siberian Husky</option>
                                        <option value="Pomeranian" data-type="dog">Pomeranian</option>
                                        <option value="Mixed Breed (Dog)" data-type="dog">Mixed Breed</option>
                                        {{-- Cat Breeds --}}
                                        <option value="Puspin" data-type="cat">Puspin (Pusang Pinoy)</option>
                                        <option value="Persian" data-type="cat">Persian</option>
                                        <option value="Siamese" data-type="cat">Siamese</option>
                                        <option value="Maine Coon" data-type="cat">Maine Coon</option>
                                        <option value="British Shorthair" data-type="cat">British Shorthair</option>
                                        <option value="Ragdoll" data-type="cat">Ragdoll</option>
                                        <option value="Bengal" data-type="cat">Bengal</option>
                                        <option value="Scottish Fold" data-type="cat">Scottish Fold</option>
                                        <option value="Sphynx" data-type="cat">Sphynx</option>
                                        <option value="Mixed Breed (Cat)" data-type="cat">Mixed Breed</option>
                                    </select>
                                </div>

                                {{-- Age --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Age (years)</label>
                                    <select x-model="pet.age" 
                                            name="age" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Select age</option>
                                        {{-- Months --}}
                                        <option value="0.08">1 month</option>
                                        <option value="0.17">2 months</option>
                                        <option value="0.25">3 months</option>
                                        <option value="0.33">4 months</option>
                                        <option value="0.42">5 months</option>
                                        <option value="0.5">6 months</option>
                                        <option value="0.58">7 months</option>
                                        <option value="0.67">8 months</option>
                                        <option value="0.75">9 months</option>
                                        <option value="0.83">10 months</option>
                                        <option value="0.92">11 months</option>
                                        {{-- Years --}}
                                        <template x-for="i in 20" :key="i">
                                            <option :value="i" x-text="i + (i === 1 ? ' year' : ' years')"></option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                {{-- Gender --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Gender <span class="text-red-500">*</span>
                                    </label>
                                    <select x-model="pet.gender" 
                                            name="gender"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                            required>
                                        <option value="">Select gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                {{-- Size --}}
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Size</label>
                                    <select x-model="pet.size" 
                                            name="size"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Select size</option>
                                        <option value="small">Small</option>
                                        <option value="medium">Medium</option>
                                        <option value="large">Large</option>
                                    </select>
                                </div>
                            </div>
                    
                            {{-- Location --}}
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <select x-model="pet.location" 
                                        name="location" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-gray-50"
                                        @if(auth()->user()->hasShelterLocation()) disabled readonly @endif>
                                    <option value="">Select location</option>
                                    @php
                                        $locations = [
                                            'Caloocan', 'Las Piñas', 'Makati', 'Malabon', 'Mandaluyong',
                                            'Manila', 'Marikina', 'Muntinlupa', 'Navotas', 'Parañaque',
                                            'Pasay', 'Pasig', 'Quezon City', 'San Juan', 'Taguig',
                                            'Valenzuela', 'Pateros'
                                        ];
                                    @endphp
                                    @foreach($locations as $loc)
                                        <option value="{{ $loc }}">{{ $loc }}</option>
                                    @endforeach
                                </select>
                                @if(auth()->user()->hasShelterLocation())
                                    <input type="hidden" name="location" :value="pet.location">
                                    <p class="text-xs text-gray-500 mt-1">Auto-assigned to your shelter location</p>
                                @endif
                            </div>

                            {{-- Date Added to Shelter --}}
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Date Added to Shelter <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       x-model="pet.date_added" 
                                       name="date_added"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                       required>
                                <p class="text-xs text-gray-500 mt-1">Pets will be marked as urgent if in shelter for 7+ days</p>
                            </div>

                            {{-- Short Description --}}
                            <div class="form-group">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                                <textarea x-model="pet.description" 
                                          name="description"
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                          placeholder="Brief description for pet listing"></textarea>
                            </div>
                        </div>
                    </div>
                
                    {{-- Right Column - Photo & Characteristics --}}
                    <div class="space-y-6">
                        {{-- Pet Photos --}}
                        <div class="card">
                            <h3 class="text-xl font-semibold text-foreground mb-4">Pet Photos</h3>
                            
                            {{-- Existing Images --}}
                            <div x-show="pet.images && pet.images.length > 0" class="mb-6">
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm font-medium text-gray-700">
                                        Current Photos: <span x-text="pet.images ? pet.images.length : 0"></span>/5
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <template x-for="(image, index) in pet.images" :key="image.id">
                                        <div class="relative group">
                                            <img :src="image.image_url" 
                                                 :alt="pet.name" 
                                                 class="w-full h-32 object-cover rounded-lg border-2 shadow-sm"
                                                 :class="image.is_primary ? 'border-purple-500' : 'border-gray-200'">
                                            <div x-show="image.is_primary" 
                                                 class="absolute top-1.5 left-1.5 bg-purple-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                                                ⭐ Primary
                                            </div>
                                            <button type="button" 
                                                    @click="deleteImage(image.id, index)"
                                                    class="absolute top-1.5 right-1.5 bg-red-600 hover:bg-red-700 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            
                            {{-- Upload New Images --}}
                            <div x-show="!pet.images || pet.images.length < 5">
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    <span x-text="pet.images && pet.images.length > 0 ? 'Add More Photos (' + (5 - pet.images.length) + ' remaining)' : 'Upload Photos (1-5 images required)'"></span>
                                    <span class="text-red-500">*</span>
                                </label>
                                
                                {{-- Hidden file input --}}
                                <input type="file" 
                                       id="modal-images-{{ $pet->id }}"
                                       name="images[]" 
                                       accept="image/jpeg,image/png,image/gif" 
                                       multiple
                                       class="hidden">
                                
                                {{-- Drag and Drop Area --}}
                                <div id="modal-dropZone-{{ $pet->id }}" 
                                     class="border-2 border-dashed border-purple-300 rounded-xl p-6 text-center hover:border-purple-500 transition-all duration-200 cursor-pointer bg-purple-50/50">
                                    <div class="space-y-2">
                                        <svg class="mx-auto h-12 w-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <div>
                                            <p class="text-base font-semibold text-purple-700">Click to select images</p>
                                            <p class="text-xs text-gray-600">or drag and drop here</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-2 text-center">
                                    Accepted formats: JPG, PNG, GIF. Max size: 2MB per image.
                                </p>
                                <p class="text-xs text-purple-600 mt-1 text-center font-medium">
                                    💡 The first image will be the primary display image.
                                </p>
                            </div>
                            
                            {{-- New Image Previews --}}
                            <div x-show="newImagePreviews.length > 0" class="mt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-sm font-medium text-gray-700">
                                        New Photos: <span x-text="newImagePreviews.length"></span>
                                    </p>
                                    <button type="button" @click="clearNewImages()" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                        Clear All
                                    </button>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <template x-for="(preview, index) in newImagePreviews" :key="index">
                                        <div class="relative group">
                                            <img :src="preview" 
                                                 :alt="'New image ' + (index + 1)" 
                                                 class="w-full h-32 object-cover rounded-lg border-2 shadow-sm"
                                                 :class="index === 0 && (!pet.images || pet.images.length === 0) ? 'border-purple-500' : 'border-gray-200'">
                                            <div x-show="index === 0 && (!pet.images || pet.images.length === 0)" 
                                                 class="absolute top-1.5 left-1.5 bg-purple-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                                                ⭐ Primary
                                            </div>
                                            <button type="button" 
                                                    @click="removeNewImage(index)"
                                                    class="absolute top-1.5 right-1.5 bg-red-600 hover:bg-red-700 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-200 shadow-lg">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <button type="button" 
                                        x-show="(pet.images ? pet.images.length : 0) + newImagePreviews.length < 5"
                                        @click="document.getElementById('modal-images-{{ $pet->id }}').click()" 
                                        class="mt-3 w-full py-2 border-2 border-dashed border-purple-300 rounded-lg text-purple-700 hover:border-purple-500 hover:bg-purple-50 transition-all duration-200 font-medium text-sm">
                                    + Add More Images
                                </button>
                            </div>
                            
                            {{-- Max images warning --}}
                            <div x-show="pet.images && pet.images.length >= 5" 
                                 class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-4">
                                <div class="flex items-start space-x-2">
                                    <svg class="h-5 w-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <p class="text-sm text-yellow-800">
                                        Maximum of 5 images reached. Delete an existing image to add more.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Health --}}
                        <div class="card">
                            <h3 class="text-xl font-semibold text-foreground mb-4">Health</h3>
                            
                            <div class="space-y-4">
                                {{-- Health --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Health:</label>
                                    <div class="space-y-3">
                                        {{-- Vaccinated --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="is_vaccinated" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.is_vaccinated" 
                                                   name="is_vaccinated" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Vaccinated</span>
                                        </label>

                                        {{-- Spayed/Neutered --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="is_neutered" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.is_neutered" 
                                                   name="is_neutered" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Spayed/Neutered</span>
                                        </label>

                                        {{-- Dewormed --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="is_dewormed" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.is_dewormed" 
                                                   name="is_dewormed" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Dewormed</span>
                                        </label>

                                        {{-- On Preventive Medication --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="on_preventive_medication" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.on_preventive_medication" 
                                                   name="on_preventive_medication" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">On Preventive Medication</span>
                                        </label>

                                        {{-- Has Special Medical Needs --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="has_special_medical_needs" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.has_special_medical_needs" 
                                                   name="has_special_medical_needs" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Has Special Medical Needs</span>
                                        </label>

                                        {{-- Disabled / Mobility Impaired --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="is_mobility_impaired" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.is_mobility_impaired" 
                                                   name="is_mobility_impaired" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Disabled / Mobility Impaired</span>
                                        </label>

                                        {{-- Undergoing Treatment --}}
                                        <label class="flex items-center">
                                            <input type="hidden" name="is_undergoing_treatment" value="0">
                                            <input type="checkbox" 
                                                   x-model="pet.is_undergoing_treatment" 
                                                   name="is_undergoing_treatment" 
                                                   value="1"
                                                   class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <span class="ml-3 text-sm text-gray-700">Undergoing Treatment</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Availability --}}
                        <div class="card">
                            <h3 class="text-xl font-semibold text-foreground mb-4">Availability</h3>
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Available for Adoption</label>
                                <input type="hidden" name="is_available" value="0">
                                <input type="checkbox" 
                                       x-model="pet.is_available" 
                                       name="is_available" 
                                       value="1"
                                       class="h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Form Actions --}}
                <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" 
                            @click="open = false" 
                            class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            :disabled="loading"
                            class="px-6 py-2.5 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors duration-200 flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <i data-lucide="check" class="h-4 w-4"></i>
                        <span x-show="!loading">Update Pet</span>
                        <span x-show="loading">Updating...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPetModal(petId, petData) {
    return {
        open: false,
        loading: false,
        newImagePreviews: [],
        newImageFiles: [],
        deletedImageIds: [],
        pet: {
            id: null,
            name: '',
            type: '',
            breed: '',
            age: '',
            gender: '',
            size: '',
            description: '',
            location: '',
            characteristics: [],
            is_available: true,
            is_vaccinated: false,
            is_neutered: false,
            is_dewormed: false,
            is_tick_flea_treated: false,
            on_preventive_medication: false,
            has_special_medical_needs: false,
            is_mobility_impaired: false,
            is_undergoing_treatment: false,
            date_added: '',
            image_url: '',
            images: [],
            is_urgent: false,
            days_in_shelter: 0
        },
        errors: {},
        
        async init() {
            // Populate pet data immediately from the passed data
            console.log('Raw pet data received:', petData);
            this.populatePetData(petData);
            
            // Listen for custom open event
            this.$el.addEventListener('open-modal', () => {
                this.open = true;
            });
            
            this.$watch('open', async (value) => {
                if (value) {
                    console.log('Modal opened for pet ID:', petId);
                    this.updateBreedOptions();
                    this.updateUrgencyStatus();
                    
                    // Force update form fields after modal opens
                    this.$nextTick(() => {
                        this.forceUpdateFormFields();
                        if (window.lucide) {
                            lucide.createIcons();
                        }
                    });
                } else {
                    // Hide modal when closed
                    this.$el.classList.add('hidden');
                    this.$el.style.display = 'none';
                }
            });
            
            // Watch for date changes to update urgency
            this.$watch('pet.date_added', () => {
                this.updateUrgencyStatus();
            });
            
            // Setup image upload handlers
            this.$nextTick(() => {
                this.setupImageHandlers();
            });
        },
        
        setupImageHandlers() {
            const fileInput = document.getElementById(`modal-images-${petId}`);
            const dropZone = document.getElementById(`modal-dropZone-${petId}`);
            
            if (!fileInput || !dropZone) return;
            
            // Click to upload
            dropZone.addEventListener('click', () => {
                fileInput.click();
            });
            
            // Drag and drop
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('border-purple-500', 'bg-purple-100');
            });
            
            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('border-purple-500', 'bg-purple-100');
            });
            
            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('border-purple-500', 'bg-purple-100');
                
                const files = Array.from(e.dataTransfer.files);
                this.handleNewImages(files);
            });
            
            // File input change
            fileInput.addEventListener('change', (e) => {
                const files = Array.from(e.target.files);
                this.handleNewImages(files);
            });
        },
        
        handleNewImages(files) {
            const existingCount = this.pet.images ? this.pet.images.length : 0;
            const remainingSlots = 5 - existingCount - this.newImageFiles.length;
            
            if (files.length > remainingSlots) {
                alert(`You can only upload ${remainingSlots} more image(s). Maximum is 5 total.`);
                return;
            }
            
            // Validate files
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            for (let file of files) {
                if (file.size > 2097152) {
                    alert(`File "${file.name}" is too large. Max size is 2MB.`);
                    return;
                }
                if (!allowedTypes.includes(file.type)) {
                    alert(`File "${file.name}" is not a valid image type.`);
                    return;
                }
            }
            
            // Add files and create previews
            this.newImageFiles = this.newImageFiles.concat(files);
            
            // Create previews
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.newImagePreviews.push(e.target.result);
                };
                reader.readAsDataURL(file);
            });
            
            // Update file input
            const fileInput = document.getElementById(`modal-images-${petId}`);
            if (fileInput) {
                const dataTransfer = new DataTransfer();
                this.newImageFiles.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            }
        },
        
        removeNewImage(index) {
            this.newImageFiles.splice(index, 1);
            this.newImagePreviews.splice(index, 1);
            
            // Update file input
            const fileInput = document.getElementById(`modal-images-${petId}`);
            if (fileInput) {
                const dataTransfer = new DataTransfer();
                this.newImageFiles.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
            }
        },
        
        clearNewImages() {
            this.newImageFiles = [];
            this.newImagePreviews = [];
            const fileInput = document.getElementById(`modal-images-${petId}`);
            if (fileInput) {
                fileInput.value = '';
            }
        },
        
        deleteImage(imageId, index) {
            if (confirm('Are you sure you want to delete this image?')) {
                this.deletedImageIds.push(imageId);
                this.pet.images.splice(index, 1);
            }
        },
        
        forceUpdateFormFields() {
            console.log('Force updating form fields...');
            const modal = this.$el;
            
            // Update date field
            const dateField = modal.querySelector('input[name="date_added"]');
            if (dateField && this.pet.date_added) {
                dateField.value = this.pet.date_added;
                console.log('Set date field to:', this.pet.date_added);
            }
            
            // Update description field
            const descField = modal.querySelector('textarea[name="description"]');
            if (descField) {
                descField.value = this.pet.description || '';
                console.log('Set description field to:', this.pet.description);
            }
            
            // Update other fields
            const nameField = modal.querySelector('input[name="name"]');
            if (nameField) nameField.value = this.pet.name || '';
            
            const typeField = modal.querySelector('select[name="type"]');
            if (typeField) typeField.value = this.pet.type || '';
            
            const genderField = modal.querySelector('select[name="gender"]');
            if (genderField) genderField.value = this.pet.gender || '';
        },
        
        updateUrgencyStatus() {
            if (this.pet.date_added && this.pet.is_available) {
                const dateAdded = new Date(this.pet.date_added);
                const today = new Date();
                const diffTime = Math.abs(today - dateAdded);
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
                
                this.pet.days_in_shelter = diffDays;
                this.pet.is_urgent = diffDays >= 7;
            } else {
                this.pet.is_urgent = false;
                this.pet.days_in_shelter = 0;
            }
        },
        
        populatePetData(data) {
            console.log('populatePetData called with:', data);
            console.log('Card shows date as:', data._debug_card_date);
            console.log('Date being passed to modal:', data.date_added);
            
            if (data) {
                // Get user's shelter location from the DOM
                const userShelterLocation = '{{ auth()->user()->shelter_location }}';
                
                // Use the date exactly as passed from the grid
                let dateValue = data.date_added || '';
                console.log('Date value to use:', dateValue);
                
                this.pet = {
                    id: data.id,
                    name: data.name || '',
                    type: data.type || '',
                    breed: data.breed || '',
                    age: data.age ? String(data.age) : '',
                    gender: data.gender || '',
                    size: data.size || '',
                    description: data.description || '',
                    location: userShelterLocation || data.location || '',
                    characteristics: Array.isArray(data.characteristics) ? data.characteristics : [],
                    is_available: !!data.is_available,
                    is_vaccinated: !!data.is_vaccinated,
                    is_neutered: !!data.is_neutered,
                    is_dewormed: !!data.is_dewormed,
                    is_tick_flea_treated: !!data.is_tick_flea_treated,
                    on_preventive_medication: !!data.on_preventive_medication,
                    has_special_medical_needs: !!data.has_special_medical_needs,
                    is_mobility_impaired: !!data.is_mobility_impaired,
                    is_undergoing_treatment: !!data.is_undergoing_treatment,
                    date_added: dateValue,
                    image_url: data.image_url || '/images/default-pet.jpg',
                    images: data.images || [],
                    is_urgent: !!data.is_urgent,
                    days_in_shelter: data.days_in_shelter || 0
                };
                
                console.log('Final pet object:', this.pet);
                console.log('Date field value:', this.pet.date_added);
                console.log('Description field value:', this.pet.description);
            }
        },
        
        updateBreedOptions() {
            const breedSelect = document.querySelector(`#editPetModal-${petId} select[name="breed"]`);
            if (!breedSelect) {
                console.log('Breed select not found');
                return;
            }
            
            const selectedType = this.pet.type;
            const breedOptions = breedSelect.querySelectorAll('option');
            
            console.log('Updating breed options for type:', selectedType);
            
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
            
            // Reset breed if it doesn't match the new type
            const currentBreedOption = breedSelect.querySelector(`option[value="${this.pet.breed}"]`);
            if (currentBreedOption && currentBreedOption.dataset.type !== selectedType) {
                console.log('Resetting breed because type changed');
                this.pet.breed = '';
            }
        },
        
        toggleCharacteristic(characteristic) {
            if (!Array.isArray(this.pet.characteristics)) {
                this.pet.characteristics = [];
            }
            
            const index = this.pet.characteristics.indexOf(characteristic);
            if (index > -1) {
                this.pet.characteristics.splice(index, 1);
            } else {
                this.pet.characteristics.push(characteristic);
            }
        },
        
        async updatePet() {
            this.loading = true;
            this.errors = {};
            
            try {
                const form = document.querySelector(`#editPetModal-${petId} form`);
                const formData = new FormData(form);
                
                // Remove old characteristics from FormData
                formData.delete('characteristics[]');
                
                // Add characteristics as array
                if (Array.isArray(this.pet.characteristics)) {
                    this.pet.characteristics.forEach(char => {
                        formData.append('characteristics[]', char);
                    });
                }
                
                // Add deleted image IDs
                if (this.deletedImageIds.length > 0) {
                    this.deletedImageIds.forEach(id => {
                        formData.append('delete_images[]', id);
                    });
                }
                
                // Ensure boolean fields are included (FormData only includes checked checkboxes)
                // We need to ensure the hidden input values are used when checkbox is unchecked
                if (!formData.has('is_vaccinated')) {
                    formData.set('is_vaccinated', '0');
                }
                if (!formData.has('is_neutered')) {
                    formData.set('is_neutered', '0');
                }
                if (!formData.has('is_dewormed')) {
                    formData.set('is_dewormed', '0');
                }
                if (!formData.has('is_tick_flea_treated')) {
                    formData.set('is_tick_flea_treated', '0');
                }
                if (!formData.has('on_preventive_medication')) {
                    formData.set('on_preventive_medication', '0');
                }
                if (!formData.has('has_special_medical_needs')) {
                    formData.set('has_special_medical_needs', '0');
                }
                if (!formData.has('is_mobility_impaired')) {
                    formData.set('is_mobility_impaired', '0');
                }
                if (!formData.has('is_undergoing_treatment')) {
                    formData.set('is_undergoing_treatment', '0');
                }
                if (!formData.has('is_available')) {
                    formData.set('is_available', '0');
                }
                
                // Add method override for PUT request
                formData.append('_method', 'PUT');
                
                console.log('Pet data before form submission:', this.pet);
                
                console.log('Submitting form data:', {
                    name: formData.get('name'),
                    type: formData.get('type'),
                    gender: formData.get('gender'),
                    size: formData.get('size'),
                    age: formData.get('age'),
                    description: formData.get('description'),
                    date_added: formData.get('date_added'),
                    location: formData.get('location'),
                    is_vaccinated: formData.get('is_vaccinated'),
                    is_neutered: formData.get('is_neutered'),
                    is_dewormed: formData.get('is_dewormed'),
                    is_tick_flea_treated: formData.get('is_tick_flea_treated'),
                    on_preventive_medication: formData.get('on_preventive_medication'),
                    has_special_medical_needs: formData.get('has_special_medical_needs'),
                    is_mobility_impaired: formData.get('is_mobility_impaired'),
                    is_undergoing_treatment: formData.get('is_undergoing_treatment'),
                    is_available: formData.get('is_available')
                });
                
                const response = await fetch(`/admin/shelter/pets/${petId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                console.log('Server response:', result);
                
                if (!response.ok) {
                    console.error('Server validation errors:', result.errors);
                    this.errors = result.errors || { general: ['Failed to update pet'] };
                    // Scroll to top to show errors
                    this.$el.querySelector('.overflow-y-auto').scrollTop = 0;
                    return;
                }
                
                console.log('Update successful:', result);
                
                // Success - refresh the page to show updated data
                window.location.reload();
                
            } catch (error) {
                console.error('Error updating pet:', error);
                this.errors = { general: ['An unexpected error occurred. Please try again.'] };
            } finally {
                this.loading = false;
            }
        },
        
        updatePetCardInUI(updatedPet) {
            // Find the pet card in the grid
            const petCards = document.querySelectorAll('[data-pet-id]');
            const targetCard = Array.from(petCards).find(card => 
                card.getAttribute('data-pet-id') == petId
            );
            
            if (targetCard) {
                // Update the pet card with new information
                const nameElement = targetCard.querySelector('.pet-name');
                const typeElement = targetCard.querySelector('.pet-type');
                const detailsElement = targetCard.querySelector('.pet-details');
                const descriptionElement = targetCard.querySelector('.pet-description');
                const imageElement = targetCard.querySelector('.pet-image');
                const statusElement = targetCard.querySelector('.pet-status');
                const urgentBadge = targetCard.querySelector('.urgent-badge');
                const locationElement = targetCard.querySelector('.pet-location');
                
                // Update name
                if (nameElement) nameElement.textContent = updatedPet.name;
                
                // Update type
                if (typeElement) typeElement.textContent = updatedPet.type.charAt(0).toUpperCase() + updatedPet.type.slice(1);
                
                // Update image
                if (imageElement) {
                    imageElement.src = updatedPet.image_url;
                    imageElement.alt = updatedPet.name;
                }
                
                // Update details (Breed • Age • Size)
                if (detailsElement) {
                    const details = [];
                    if (updatedPet.breed) details.push(updatedPet.breed);
                    
                    // Add age category
                    if (updatedPet.age) {
                        const age = parseFloat(updatedPet.age);
                        if (age < 1) {
                            details.push(updatedPet.type === 'dog' ? 'Puppy' : 'Kitten');
                        } else if (age >= 7) {
                            details.push('Senior');
                        } else {
                            details.push('Adult');
                        }
                    }
                    
                    if (updatedPet.size) details.push(updatedPet.size.charAt(0).toUpperCase() + updatedPet.size.slice(1));
                    
                    detailsElement.textContent = details.join(' • ');
                }
                
                // Update description
                if (descriptionElement && updatedPet.description) {
                    descriptionElement.textContent = updatedPet.description;
                    descriptionElement.style.display = 'block';
                } else if (descriptionElement) {
                    descriptionElement.style.display = 'none';
                }
                
                // Update status
                if (statusElement) {
                    statusElement.className = updatedPet.is_available ? 
                        'absolute top-2 right-2 px-3 py-1 text-sm rounded-full font-semibold bg-green-100 text-green-800 border border-green-200 pet-status' :
                        'absolute top-2 right-2 px-3 py-1 text-sm rounded-full font-semibold bg-red-100 text-red-800 border border-red-200 pet-status';
                    statusElement.textContent = updatedPet.is_available ? '✓ Available' : '🏠 Adopted';
                }
                
                // Update location
                if (locationElement && updatedPet.location) {
                    locationElement.textContent = `📍 ${updatedPet.location}`;
                    locationElement.style.display = 'block';
                } else if (locationElement) {
                    locationElement.style.display = 'none';
                }
                
                // Update urgent badge
                if (urgentBadge) {
                    if (updatedPet.is_urgent && updatedPet.is_available) {
                        urgentBadge.style.display = 'block';
                    } else {
                        urgentBadge.style.display = 'none';
                    }
                }
            }
        }
    }
}
</script>