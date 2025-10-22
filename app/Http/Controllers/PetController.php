<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display pets for public adoption page (home)
     * Returns processed data for home page display
     * CRITICAL: Must match admin panel display exactly
     */
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
                    'age' => $pet->age_category, // Use age range (Puppy/Kitten, Adult, Senior)
                    'age_filter_category' => $pet->age_filter_category, // Keep for filtering
                    'size' => $pet->size ? ucfirst($pet->size) : null, // CRITICAL: No hardcoded fallbacks
                    'location' => $this->getLocation($pet),
                    'description' => $pet->description, // CRITICAL: No generated descriptions
                    'image' => $this->getImageUrl($pet),
                    'image_gallery' => $pet->image_gallery, // Multiple images support
                    'is_vaccinated' => $pet->is_vaccinated,
                    'is_neutered' => $pet->is_neutered,
                    'is_dewormed' => $pet->is_dewormed,
                    'is_tick_flea_treated' => $pet->is_tick_flea_treated,
                    'on_preventive_medication' => $pet->on_preventive_medication,
                    'has_special_medical_needs' => $pet->has_special_medical_needs,
                    'is_mobility_impaired' => $pet->is_mobility_impaired,
                    'is_undergoing_treatment' => $pet->is_undergoing_treatment,
                    'breed' => $pet->breed, // CRITICAL: No "Mixed" fallback
                    'gender' => $pet->gender ? ucfirst($pet->gender) : null, // CRITICAL: No "Unknown" fallback
                    'adoption_fee' => $pet->adoption_fee,
                    'days_in_shelter' => $pet->days_in_shelter,
                    'urgent' => $pet->is_urgent,
                    'urgent_reason' => $pet->urgent_reason,
                ];
            });

        // Get unique city names from shelter locations (extract city from "City Shelter" format)
        $shelterLocations = Pet::where('is_available', true)
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->pluck('location');

        $extractedCities = $shelterLocations->map(function ($location) {
            // Extract city name from "City Shelter" format
            // Examples: "Taguig Shelter" → "Taguig", "Makati Animal Haven" → "Makati"
            $words = explode(' ', $location);
            return $words[0]; // Take the first word as the city name
        })->unique()->sort()->values();

        return view('home', compact('pets', 'extractedCities'));
    }

    /**
     * Display pets for find-pets page
     * Returns raw pet models with all database fields for accurate display
     */
    public function findPets()
    {
        // CRITICAL: Fetch pets directly from database with NO transformations
        // This ensures 1:1 mapping between admin data and public display
        $pets = Pet::where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get unique city names from shelter locations (extract city from "City Shelter" format)
        $shelterLocations = Pet::where('is_available', true)
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->pluck('location');

        $extractedCities = $shelterLocations->map(function ($location) {
            // Extract city name from "City Shelter" format
            // Examples: "Taguig Shelter" → "Taguig", "Makati Animal Haven" → "Makati"
            $words = explode(' ', $location);
            return $words[0]; // Take the first word as the city name
        })->unique()->sort()->values();

        // Add detailed logging to track data consistency
        \Log::info('Find Pets Data Source', [
            'total_pets' => $pets->count(),
            'cities_count' => $extractedCities->count(),
            'available_cities' => $extractedCities->toArray(),
            'sample_pet' => $pets->first() ? [
                'name' => $pets->first()->name,
                'age_raw' => $pets->first()->age,
                'age_display' => $pets->first()->age_display,
                'size' => $pets->first()->size,
                'breed' => $pets->first()->breed,
                'location' => $pets->first()->location,
            ] : 'No pets found'
        ]);

        return view('find-pets', compact('pets', 'extractedCities'));
    }

    public function show($id)
    {
        $pet = Pet::findOrFail($id);
        
        if (!$pet->is_available) {
            return redirect()->route('home')->with('error', 'This pet is no longer available for adoption.');
        }

        return view('pet-details', compact('pet'));
    }
    
    /**
     * Get pet details by name - API endpoint
     *
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByName($name)
    {
        $pet = Pet::where('name', $name)->first();
        
        if (!$pet) {
            return response()->json(['error' => 'Pet not found'], 404);
        }
        
        return response()->json([
            'id' => $pet->id,
            'name' => $pet->name,
            'type' => $pet->type,
            'breed' => $pet->breed,
            'age' => $pet->age,
            'gender' => $pet->gender,
            'is_available' => $pet->is_available
        ]);
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
        // Use the Pet model's image_url accessor for consistent URL generation
        return $pet->image_url;
    }

    private function getLocation($pet)
    {
        // CRITICAL: Return ONLY database values, no hardcoded fallbacks
        // If location is not set, return null to show "Unknown location" or empty
        return $pet->location;
    }

    private function getCharacteristic($pet, $characteristicName)
    {
        if (!$pet->characteristics || !is_array($pet->characteristics)) {
            // CRITICAL: Return actual database state, not assumed defaults
            return false; // No characteristics means false, not assumed true
        }
        
        return in_array($characteristicName, $pet->characteristics);
    }
}
