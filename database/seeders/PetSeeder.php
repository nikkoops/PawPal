<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run()
    {
        $pets = [
            [
                'name' => 'Max',
                'type' => 'dog',
                'breed' => 'German Shepherd Mix',
                'age' => 3,
                'size' => 'large',
                'gender' => 'male',
                'description' => 'Max was rescued in Quincy City and has been in the shelter for 34 days. Energetic and playful, he\'ll make a great companion for an active family.',
                'image' => 'images/golden-retriever-puppy-happy-face.png',
                'is_available' => true,
                'adoption_fee' => 150.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'good_with_kids' => true,
                'good_with_pets' => true,
                'location' => 'Quincy City Shelter',
                'characteristics' => json_encode(['energetic', 'playful', 'friendly']),
            ],
            [
                'name' => 'Bella',
                'type' => 'dog',
                'breed' => 'Labrador Mix',
                'age' => 8,
                'size' => 'large',
                'gender' => 'female',
                'description' => 'Bella, rescued in Caboolture, has spent 60 days in the shelter. A gentle giant, she loves quiet walks and cuddles.',
                'image' => 'images/white-and-brown-senior-dog-gentle-expression.png',
                'is_available' => true,
                'adoption_fee' => 100.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'good_with_kids' => true,
                'good_with_pets' => false,
                'location' => 'Caboolture Animal Shelter',
                'characteristics' => json_encode(['gentle', 'calm', 'senior']),
            ],
            [
                'name' => 'Charlie',
                'type' => 'dog',
                'breed' => 'Mixed Breed',
                'age' => 4,
                'size' => 'medium',
                'gender' => 'male',
                'description' => 'Charlie is a friendly, energetic dog who loves to play and explore.',
                'image' => 'images/brown-dog-with-blue-collar-smiling.png',
                'is_available' => true,
                'adoption_fee' => 125.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'characteristics' => json_encode(['friendly', 'energetic', 'playful']),
            ],
            [
                'name' => 'Rocky',
                'type' => 'dog',
                'breed' => 'Mixed Breed',
                'age' => 9,
                'size' => 'large',
                'gender' => 'male',
                'description' => 'Rocky is a gentle senior dog looking for a quiet home to spend his golden years.',
                'image' => 'images/senior-dog-with-gray-muzzle-loyal-expression.jpg',
                'is_available' => true,
                'adoption_fee' => 75.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'characteristics' => json_encode(['loyal', 'gentle', 'senior']),
            ],
            [
                'name' => 'Milo',
                'type' => 'cat',
                'breed' => 'Tabby',
                'age' => 4,
                'size' => 'medium',
                'gender' => 'male',
                'description' => 'Milo is an alert, intelligent cat who enjoys interactive play and exploring.',
                'image' => 'images/tabby-cat-with-green-eyes-alert.png',
                'is_available' => true,
                'adoption_fee' => 85.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'characteristics' => json_encode(['alert', 'intelligent', 'interactive']),
            ],
            [
                'name' => 'Whiskers',
                'type' => 'cat',
                'breed' => 'Mixed Breed',
                'age' => 10,
                'size' => 'medium',
                'gender' => 'female',
                'description' => 'Whiskers is a calm senior cat who prefers a quiet, loving home.',
                'image' => 'images/orange-and-white-senior-cat-calm-expression.png',
                'is_available' => true,
                'adoption_fee' => 60.00,
                'is_vaccinated' => true,
                'is_neutered' => true,
                'characteristics' => json_encode(['calm', 'senior', 'quiet']),
            ],
        ];

        foreach ($pets as $petData) {
            Pet::create($petData);
        }
    }
}
