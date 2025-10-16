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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
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
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-500 @enderror"
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

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('password') border-red-500 @enderror"
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
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
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
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200 flex items-center"
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
@endsection
