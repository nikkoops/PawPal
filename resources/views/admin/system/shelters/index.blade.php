@extends('admin.layouts.app')

@section('title', 'Shelters - PawPal Admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Shelters</h1>
            <p class="text-gray-600">Manage shelter capacity settings</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left text-sm text-gray-600">
                    <th class="py-2">Shelter</th>
                    <th class="py-2">Max Capacity</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shelters as $s)
                <tr class="border-t">
                    <td class="py-3">{{ $s->name }}</td>
                    <td class="py-3">{{ $s->max_capacity }}</td>
                    <td class="py-3">
                        <a href="{{ route('admin.system.shelters.edit', $s) }}" class="text-orange-600 hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $shelters->links() }}</div>
    </div>
</div>
@endsection
