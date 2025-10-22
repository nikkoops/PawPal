@extends('admin.layouts.app')

@section('title', 'Edit Admin')

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
                <h1 class="text-3xl font-bold text-gray-800">Edit Admin</h1>
                <p class="text-gray-600 mt-2">Update administrator details</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.system.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
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
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="admin@example.com"
                    required
                >
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
                            {{ old('role', $user->role) === 'system_admin' ? 'checked' : '' }}
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
                            {{ old('role', $user->role) === 'shelter_admin' ? 'checked' : '' }}
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

            <!-- Password Section -->
            <div class="border-t border-gray-200 pt-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password (Optional)</h3>
                <p class="text-sm text-gray-600 mb-4">Leave blank to keep current password</p>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        New Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="Enter new password (min. 8 characters)"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Password must be at least 8 characters</p>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                        placeholder="Re-enter new password"
                    >
                </div>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
