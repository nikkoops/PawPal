<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        // Get all available pets with their information
        $pets = Pet::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($pet) {
                return [
                    'id' => $pet->id,
                    'name' => $pet->name,
                    'type' => strtolower($pet->type),
                    'age' => $this->determineAgeCategory($pet->age),
                    'size' => strtolower($pet->size ?? 'medium'),
                    'location' => $this->getLocation($pet),
                    'description' => $pet->description ?? "Meet {$pet->name}, a wonderful {$pet->type} looking for a loving home.",
                    'image' => $this->getImageUrl($pet),
                    'vaccinated' => $pet->is_vaccinated ?? false,
                    'spayed_neutered' => $pet->is_neutered ?? false,
                    'good_with_kids' => $this->getCharacteristic($pet, 'good_with_kids'),
                    'good_with_pets' => $this->getCharacteristic($pet, 'good_with_pets'),
                    'breed' => $pet->breed ?? 'Mixed',
                    'gender' => ucfirst($pet->gender ?? 'Unknown'),
                    'adoption_fee' => $pet->adoption_fee ?? 0,
                    'days_in_shelter' => $pet->days_in_shelter ?? 0,
                    'urgent' => $pet->is_urgent ?? false,
                    'urgent_reason' => $pet->urgent_reason ?? null,
                ];
            });

        return view('home', compact('pets'));
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        
        if (!$pet->is_available) {
            return redirect()->route('home')->with('error', 'This pet is no longer available for adoption.');
        }

        return view('pet-details', compact('pet'));
    }

    private function determineAgeCategory($age)
    {
        if (is_numeric($age)) {
            if ($age < 1) return 'puppy';
            if ($age < 7) return 'adult';
            return 'senior';
        }
        
        // If age is already a category, return lowercase
        return strtolower($age ?? 'adult');
    }

    private function getImageUrl($pet)
    {
        // If pet has an image stored, use it
        if ($pet->image) {
            // Check if it's a full URL or a storage path
            if (str_starts_with($pet->image, 'http')) {
                return $pet->image;
            } else {
                return asset('storage/' . $pet->image);
            }
        }
        
        // Otherwise use default images based on type
        return $this->getDefaultImage($pet->type);
    }

    private function getDefaultImage($type)
    {
        $defaultImages = [
            'dog' => 'images/golden-retriever-puppy-happy-face.png',
            'cat' => 'images/orange-tabby-kitten-cute-expression.png',
            'other' => 'images/placeholder-pet.jpg',
        ];

        return asset($defaultImages[strtolower($type)] ?? $defaultImages['other']);
    }

    private function getLocation($pet)
    {
        // Return the actual location from the database, fallback to 'Manila' if not set
        return $pet->location ?? 'Manila';
    }

    private function getCharacteristic($pet, $characteristicName)
    {
        if (!$pet->characteristics || !is_array($pet->characteristics)) {
            return true; // Default to true for compatibility
        }
        
        return in_array($characteristicName, $pet->characteristics);
    }
}
