@extends('admin.layouts.app')

@section('title', 'Create New Admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('admin.system.users') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Create New Admin</h1>
                <p class="text-gray-600 mt-2">Add a new system or shelter administrator</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.system.users.store') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Enter full name"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed @error('email') border-red-500 @enderror"
                        placeholder="Will auto-generate when name and shelter location are selected"
                        required
                    >
                    <span id="email-auto-generated" class="hidden absolute right-3 top-3 text-xs text-green-600 bg-green-50 px-2 py-1 rounded">
                        Auto-generated
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    <span id="email-manual-hint">Email will auto-generate for Shelter Admins based on name and location</span>
                    <span id="email-auto-hint" class="hidden text-green-600">✓ Email auto-generated from name and shelter location</span>
                </p>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Admin Role <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- System Admin Card -->
                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="role" 
                            value="system_admin" 
                            class="peer sr-only"
                            {{ old('role') === 'system_admin' ? 'checked' : '' }}
                        >
                        <div class="border-2 border-gray-300 rounded-lg p-6 hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition duration-200">
                            <div class="flex items-center mb-3">
                                <div class="text-3xl mr-3">🔧</div>
                                <h3 class="text-lg font-bold text-gray-800">System Admin</h3>
                            </div>
                            <p class="text-sm text-gray-600">Full system access including user management and analytics</p>
                        </div>
                    </label>

                    <!-- Shelter Admin Card -->
                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="role" 
                            value="shelter_admin" 
                            class="peer sr-only"
                            {{ old('role') === 'shelter_admin' || !old('role') ? 'checked' : '' }}
                        >
                        <div class="border-2 border-gray-300 rounded-lg p-6 hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition duration-200">
                            <div class="flex items-center mb-3">
                                <div class="text-3xl mr-3">🏠</div>
                                <h3 class="text-lg font-bold text-gray-800">Shelter Admin</h3>
                            </div>
                            <p class="text-sm text-gray-600">Manage pets, applications, and shelter analytics</p>
                        </div>
                    </label>
                </div>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Shelter Location (shown only for shelter admins) -->
            <div class="mb-6" id="shelterLocationField" style="display: none;">
                <label for="shelter_location" class="block text-sm font-medium text-gray-700 mb-2">
                    Assigned Shelter Location <span class="text-red-500">*</span>
                </label>
                <select 
                    id="shelter_location" 
                    name="shelter_location" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('shelter_location') border-red-500 @enderror"
                >
                    <option value="">-- Select Shelter Location --</option>
                    @foreach(\App\Models\User::getShelterLocations() as $location)
                        <option value="{{ $location }}" {{ old('shelter_location') === $location ? 'selected' : '' }}>
                            {{ $location }}
                        </option>
                    @endforeach
                </select>
                @error('shelter_location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">This admin will only manage pets and applications from this shelter</p>
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                    placeholder="Enter password (min. 8 characters)"
                    required
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Password must be at least 8 characters</p>
            </div>

            <!-- Confirm Password Field -->
            <div class="mb-8">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirm Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    placeholder="Re-enter password"
                    required
                >
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.system.users') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-orange-600 hover:bg-[#c1431d] text-white rounded-lg transition duration-200 flex items-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Show/hide shelter location field based on role selection
    document.addEventListener('DOMContentLoaded', function() {
        const roleInputs = document.querySelectorAll('input[name="role"]');
        const shelterLocationField = document.getElementById('shelterLocationField');
        const shelterLocationSelect = document.getElementById('shelter_location');
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const emailAutoGeneratedBadge = document.getElementById('email-auto-generated');
        const emailManualHint = document.getElementById('email-manual-hint');
        const emailAutoHint = document.getElementById('email-auto-hint');
        
        let emailWasAutoGenerated = false;

        function toggleShelterLocation() {
            const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
            
            if (selectedRole === 'shelter_admin') {
                shelterLocationField.style.display = 'block';
                shelterLocationSelect.setAttribute('required', 'required');
                // Email field is readonly and will auto-generate
                emailInput.setAttribute('readonly', 'readonly');
                emailInput.classList.add('bg-gray-50', 'cursor-not-allowed');
                emailInput.classList.remove('focus:ring-2', 'focus:ring-orange-500');
                // Try to generate email when role is selected
                generateEmail();
            } else {
                shelterLocationField.style.display = 'none';
                shelterLocationSelect.removeAttribute('required');
                shelterLocationSelect.value = '';
                // For System Admin, allow manual entry
                emailInput.removeAttribute('readonly');
                emailInput.classList.remove('bg-gray-50', 'cursor-not-allowed');
                emailInput.classList.add('focus:ring-2', 'focus:ring-orange-500', 'focus:border-transparent');
                // Clear email if it was auto-generated
                if (emailWasAutoGenerated) {
                    emailInput.value = '';
                    emailWasAutoGenerated = false;
                    hideAutoGeneratedIndicators();
                }
            }
        }

        function generateEmail() {
            const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
            const fullName = nameInput.value.trim();
            const shelterLocation = shelterLocationSelect.value;
            
            // Only auto-generate for shelter admins
            if (selectedRole !== 'shelter_admin') {
                return;
            }
            
            // Check if we have both name and location
            if (!fullName || !shelterLocation) {
                return;
            }
            
            // Parse the name
            const nameParts = fullName.toLowerCase().split(' ').filter(part => part.length > 0);
            if (nameParts.length < 2) {
                return; // Need at least first and last name
            }
            
            // Get first initial and last name
            const firstInitial = nameParts[0].charAt(0);
            const lastName = nameParts[nameParts.length - 1];
            
            // Parse shelter location (e.g., "Manila Shelter" -> "manilashelter")
            const shelterDomain = shelterLocation.toLowerCase()
                .replace(/\s+/g, '')  // Remove all spaces
                .replace(/[^a-z]/g, ''); // Remove non-alphabetic characters
            
            // Generate email: [first initial][lastname]@[shelterlocation].com
            const generatedEmail = `${firstInitial}${lastName}@${shelterDomain}.com`;
            
            // Set the email value
            emailInput.value = generatedEmail;
            emailWasAutoGenerated = true;
            
            // Show auto-generated indicators
            showAutoGeneratedIndicators();
        }

        function showAutoGeneratedIndicators() {
            emailAutoGeneratedBadge.classList.remove('hidden');
            emailManualHint.classList.add('hidden');
            emailAutoHint.classList.remove('hidden');
        }

        function hideAutoGeneratedIndicators() {
            emailAutoGeneratedBadge.classList.add('hidden');
            emailManualHint.classList.remove('hidden');
            emailAutoHint.classList.add('hidden');
        }

        // Add event listeners to all role radio buttons
        roleInputs.forEach(input => {
            input.addEventListener('change', toggleShelterLocation);
        });
        
        // Add event listeners for auto-generation
        nameInput.addEventListener('input', function() {
            const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
            if (selectedRole === 'shelter_admin') {
                generateEmail();
            }
        });
        
        shelterLocationSelect.addEventListener('change', function() {
            const selectedRole = document.querySelector('input[name="role"]:checked')?.value;
            if (selectedRole === 'shelter_admin') {
                generateEmail();
            }
        });

        // Initialize on page load
        toggleShelterLocation();
    });
</script>
@endsection
