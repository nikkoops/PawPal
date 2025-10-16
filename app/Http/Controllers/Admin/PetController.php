<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    /**
     * Display a listing of pets with filtering capabilities.
     * 
     * Enhanced with location filtering to match the adoption site experience.
     * Provides real-time filtering by type, availability status, and location.
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Pet::query();
        
        // Filter by shelter location if user has one assigned
        $user = auth()->user();
        if ($user->hasShelterLocation()) {
            $query->where('location', $user->shelter_location);
        }

        // Removed search functionality as requested

        if ($request->has('type') && $request->get('type') !== '') {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('availability') && $request->get('availability') !== '') {
            $query->where('is_available', $request->get('availability') === 'available');
        }

        // Add location filter (only if user is system admin without assigned location)
        if ($request->has('location') && $request->get('location') !== '' && !$user->hasShelterLocation()) {
            $query->where('location', $request->get('location'));
        }

        $pets = $query->orderBy('created_at', 'desc')->paginate(12);
        
        // Get unique locations for the filter dropdown
        $locationsQuery = Pet::whereNotNull('location')
            ->where('location', '!=', '');
            
        // If user has assigned location, only show their location
        if ($user->hasShelterLocation()) {
            $locationsQuery->where('location', $user->shelter_location);
        }
        
        $locations = $locationsQuery->distinct()
            ->pluck('location')
            ->sort()
            ->values();

        return view('admin.pets.index', compact('pets', 'locations'));
    }

    public function create()
    {
        return view('admin.pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:dog,cat',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0|max:25',
            'gender' => 'required|in:male,female',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|in:small,medium,large',
            'location' => 'nullable|string|max:255',
            'characteristics' => 'nullable|array',
            'adoption_fee' => 'nullable|numeric|min:0',
            'medical_history' => 'nullable|string',
            'is_vaccinated' => 'boolean',
            'is_neutered' => 'boolean',
            'is_available' => 'boolean',
            'date_added' => 'required|date',
        ]);

        $data = $request->all();
        
        // Handle empty age field - convert empty string to null (but keep valid decimal values)
        if ($data['age'] === '' || $data['age'] === null) {
            $data['age'] = null;
        }
        
        // Handle empty size field - convert empty string to null  
        if ($data['size'] === '' || $data['size'] === null) {
            $data['size'] = null;
        }
        
        // Auto-assign location if user has shelter location
        $user = auth()->user();
        if ($user->hasShelterLocation()) {
            $data['location'] = $user->shelter_location;
        }
        
        // Ensure boolean fields are properly set
        $data['is_available'] = $request->has('is_available') ? true : false;
        $data['is_vaccinated'] = $request->has('is_vaccinated') ? true : false;
        $data['is_neutered'] = $request->has('is_neutered') ? true : false;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                $file = $request->file('image');
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Store in storage/app/public/pets first
                $path = $file->storePublicly('pets', 'public');
                $data['image'] = $path; // This will be like 'pets/filename.jpg'
                
                // Ensure public directory exists
                if (!is_dir(public_path('storage/pets'))) {
                    mkdir(public_path('storage/pets'), 0755, true);
                }
                
                // Copy to public/storage/pets for immediate access
                copy(storage_path('app/public/' . $path), public_path('storage/' . $path));
                
                \Illuminate\Support\Facades\Log::info('Pet image uploaded successfully', [
                    'original_name' => $file->getClientOriginalName(),
                    'stored_path' => $path,
                    'storage_exists' => file_exists(storage_path('app/public/' . $path)),
                    'public_exists' => file_exists(public_path('storage/' . $path))
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error uploading pet image', [
                    'error' => $e->getMessage(),
                    'file' => $request->file('image')->getClientOriginalName()
                ]);
            }
        } else if ($request->hasFile('image')) {
            \Illuminate\Support\Facades\Log::warning('Invalid pet image upload', [
                'error' => $request->file('image')->getError(),
                'file' => $request->file('image')->getClientOriginalName()
            ]);
        }

        $pet = Pet::create($data);

        return redirect()->route('admin.shelter.pets.index')->with('success', 'Pet created successfully!');
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
            'type' => 'required|in:dog,cat',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|numeric|min:0|max:25',
            'gender' => 'required|in:male,female',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|in:small,medium,large',
            'location' => 'nullable|string|max:255',
            'characteristics' => 'nullable|array',
            'adoption_fee' => 'nullable|numeric|min:0',
            'medical_history' => 'nullable|string',
            'is_vaccinated' => 'boolean',
            'is_neutered' => 'boolean',
            'is_available' => 'boolean',
            'date_added' => 'required|date',
        ]);

        $data = $request->all();
        
        // Handle empty age field - convert empty string to null (but keep valid decimal values)
        if ($data['age'] === '' || $data['age'] === null) {
            $data['age'] = null;
        }
        
        // Handle empty size field - convert empty string to null  
        if ($data['size'] === '' || $data['size'] === null) {
            $data['size'] = null;
        }
        
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

        return redirect()->route('admin.shelter.pets.index')->with('success', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        // Delete image if exists
        if ($pet->image) {
            Storage::disk('public')->delete($pet->image);
        }

        $pet->delete();

        return redirect()->route('admin.shelter.pets.index')->with('success', 'Pet deleted successfully!');
    }

    public function toggleAvailability(Pet $pet)
    {
        $pet->update(['is_available' => !$pet->is_available]);

        $status = $pet->is_available ? 'available' : 'unavailable';
        return redirect()->back()->with('success', "Pet marked as {$status}!");
    }

    /**
     * Filter pets via AJAX
     */
    /**
     * Filter pets via AJAX - Enhanced with location filtering
     */
    public function filter(Request $request)
    {
        $query = Pet::query();

        // Remove search functionality - no longer needed

        if ($request->has('type') && $request->get('type') !== '') {
            $query->where('type', $request->get('type'));
        }

        if ($request->has('availability') && $request->get('availability') !== '') {
            $query->where('is_available', $request->get('availability') === 'available');
        }

        // Add location filter - matches adoption site filtering logic
        if ($request->has('location') && $request->get('location') !== '') {
            $query->where('location', $request->get('location'));
        }

        $pets = $query->orderBy('created_at', 'desc')->paginate(12);

        return response()->json([
            'success' => true,
            'pets' => $pets->items(),
            'pagination' => [
                'current_page' => $pets->currentPage(),
                'last_page' => $pets->lastPage(),
                'per_page' => $pets->perPage(),
                'total' => $pets->total(),
                'from' => $pets->firstItem(),
                'to' => $pets->lastItem(),
            ],
            'total' => $pets->total(),
            'html' => view('admin.pets.partials.pet-grid', compact('pets'))->render()
        ]);
    }
}