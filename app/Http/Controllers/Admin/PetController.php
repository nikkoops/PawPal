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

        // Removed search functionality as requested

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
            'type' => 'required|in:dog,cat',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
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
        
        // Ensure boolean fields are properly set
        $data['is_available'] = $request->has('is_available') ? true : false;
        $data['is_vaccinated'] = $request->has('is_vaccinated') ? true : false;
        $data['is_neutered'] = $request->has('is_neutered') ? true : false;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                // Create pets directory if it doesn't exist
                if (!is_dir(storage_path('app/public/pets'))) {
                    mkdir(storage_path('app/public/pets'), 0755, true);
                }
                
                // Store the image with a more reliable approach
                $file = $request->file('image');
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = 'pets/' . $filename;
                $fullPath = storage_path('app/public/' . $path);
                
                // Move the file to the storage location
                if ($file->move(storage_path('app/public/pets'), $filename)) {
                    // Double check file was saved
                    if (file_exists($fullPath)) {
                        // Set the image path in the data array
                        $data['image'] = $path;
                        
                        // Also copy to public directory as a fallback
                        if (!is_dir(public_path('images/pets'))) {
                            mkdir(public_path('images/pets'), 0755, true);
                        }
                        copy($fullPath, public_path('images/pets/' . $filename));
                        
                        // Log for debugging
                        \Illuminate\Support\Facades\Log::info('Pet image uploaded successfully', [
                            'original_name' => $file->getClientOriginalName(),
                            'stored_path' => $path,
                            'full_path' => $fullPath,
                            'file_exists' => file_exists($fullPath),
                            'file_size' => filesize($fullPath)
                        ]);
                    } else {
                        \Illuminate\Support\Facades\Log::error('File moved but not found afterward', [
                            'path' => $fullPath
                        ]);
                    }
                } else {
                    \Illuminate\Support\Facades\Log::error('Failed to move uploaded file', [
                        'from' => $file->getPathname(),
                        'to' => $fullPath
                    ]);
                }
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
            'type' => 'required|in:dog,cat',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
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

    /**
     * Filter pets via AJAX
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