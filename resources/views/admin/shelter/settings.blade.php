@extends('admin.layouts.app')

@section('title', 'Settings - PawPal Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Settings</h1>
        <p class="text-gray-600 mt-2">Manage your account settings and preferences</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Password Change Form -->
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Change Password</h2>
            <p class="text-gray-600 text-sm">Update your account password to keep your account secure.</p>
        </div>

        <form method="POST" action="{{ route('admin.shelter.settings.password') }}" class="space-y-6">
            @csrf
            
            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Current Password
                </label>
                <input 
                    type="password" 
                    id="current_password" 
                    name="current_password" 
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                    placeholder="Enter your current password"
                >
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    New Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    minlength="8"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                    placeholder="Enter your new password (minimum 8 characters)"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirm New Password
                </label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    minlength="8"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    placeholder="Confirm your new password"
                >
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('admin.shelter.pets.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-200">
                    ← Back to Pet Management
                </a>
                <button 
                    type="submit" 
                    class="bg-orange-600 hover:bg-[#c1431d] text-white font-medium py-2 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Security Tips -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-6 max-w-2xl">
        <h3 class="text-sm font-semibold text-blue-800 mb-2">Password Security Tips</h3>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>• Use at least 8 characters</li>
            <li>• Include a mix of uppercase and lowercase letters</li>
            <li>• Add numbers and special characters</li>
            <li>• Don't use easily guessable information</li>
            <li>• Consider using a password manager</li>
        </ul>
    </div>
</div>

<script>
// Add client-side password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    function validatePasswordMatch() {
        if (password.value !== passwordConfirmation.value) {
            passwordConfirmation.setCustomValidity('Passwords do not match');
        } else {
            passwordConfirmation.setCustomValidity('');
        }
    }
    
    password.addEventListener('input', validatePasswordMatch);
    passwordConfirmation.addEventListener('input', validatePasswordMatch);
});
</script>
@endsection