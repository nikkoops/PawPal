@extends('admin.layouts.app')

@section('title', 'Edit Shelter - PawPal Admin')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-2xl font-bold mb-4">Edit Shelter</h1>

    <form method="POST" action="{{ route('admin.system.shelters.update', $shelter) }}" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Shelter Name</label>
            <input type="text" name="name" value="{{ old('name', $shelter->name) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded" />
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Maximum Capacity</label>
            <input type="number" name="max_capacity" id="max_capacity" value="{{ old('max_capacity', $shelter->max_capacity) }}" min="50" max="300" required class="mt-1 block w-40 px-3 py-2 border border-gray-300 rounded" />
            <p class="text-sm text-gray-500 mt-1">Enter a value between 50 and 300.</p>
            @error('max_capacity')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.system.shelters') }}" class="text-gray-600 hover:underline">← Back</a>
            <button type="submit" class="bg-orange-600 text-white px-4 py-2 rounded">Save</button>
        </div>
    </form>
</div>

<script>
// Simple client-side validation to prevent invalid values
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('max_capacity');
    input.addEventListener('input', function() {
        let v = parseInt(this.value, 10);
        if (isNaN(v)) return;
        if (v < 50) this.value = 50;
        if (v > 300) this.value = 300;
    });
});
</script>
@endsection
