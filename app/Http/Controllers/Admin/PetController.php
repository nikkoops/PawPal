<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('breed', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        if ($request->has('type') && $request->get('type') !== '') {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('availability') && $request->get('availability') !== '') {
            $query->where('is_available', $request->get('availability') === 'available');
        }

        $pets = $query->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.pets.index', compact('pets'));
    }

    public function create()
    {
        return view('admin.pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|in:male,female',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|in:small,medium,large',
            'characteristics' => 'nullable|array',
            'adoption_fee' => 'nullable|numeric|min:0',
            'medical_history' => 'nullable|string',
            'is_vaccinated' => 'boolean',
            'is_neutered' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $data = $request->all();
        
        // Ensure boolean fields are properly set
        $data['is_available'] = $request->has('is_available') ? true : false;
        $data['is_vaccinated'] = $request->has('is_vaccinated') ? true : false;
        $data['is_neutered'] = $request->has('is_neutered') ? true : false;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        Pet::create($data);

        return redirect()->route('admin.pets.index')->with('success', 'Pet created successfully!');
    }

    public function show(Pet $pet)
    {
        return view('admin.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('admin.pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|in:male,female',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|in:small,medium,large',
            'characteristics' => 'nullable|array',
            'adoption_fee' => 'nullable|numeric|min:0',
            'medical_history' => 'nullable|string',
            'is_vaccinated' => 'boolean',
            'is_neutered' => 'boolean',
            'is_available' => 'boolean',
        ]);

        $data = $request->all();
        
        // Ensure boolean fields are properly set
        $data['is_available'] = $request->has('is_available') ? true : false;
        $data['is_vaccinated'] = $request->has('is_vaccinated') ? true : false;
        $data['is_neutered'] = $request->has('is_neutered') ? true : false;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($pet->image) {
                Storage::disk('public')->delete($pet->image);
            }
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        $pet->update($data);

        return redirect()->route('admin.pets.index')->with('success', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        // Delete image if exists
        if ($pet->image) {
            Storage::disk('public')->delete($pet->image);
        }

        $pet->delete();

        return redirect()->route('admin.pets.index')->with('success', 'Pet deleted successfully!');
    }

    public function toggleAvailability(Pet $pet)
    {
        $pet->update(['is_available' => !$pet->is_available]);

        $status = $pet->is_available ? 'available' : 'unavailable';
        return redirect()->back()->with('success', "Pet marked as {$status}!");
    }
}