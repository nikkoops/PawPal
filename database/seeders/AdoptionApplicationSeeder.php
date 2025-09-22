<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdoptionApplication;
use App\Models\User;

class AdoptionApplicationSeeder extends Seeder
{
    public function run()
    {
        // Create some test users first
        $users = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Robert Chen',
                'email' => 'robert.chen@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Jennifer Williams',
                'email' => 'jennifer.williams@email.com',
                'password' => bcrypt('password'),
            ],
        ];

        $createdUsers = [];
        foreach ($users as $userData) {
            $createdUsers[] = User::create($userData);
        }

        $applications = [
            [
                'user_id' => $createdUsers[0]->id,
                'pet_id' => 1, // Max
                'status' => 'pending',
                'answers' => json_encode([
                    'First Name' => 'Sarah',
                    'Last Name' => 'Johnson',
                    'Email Address' => 'sarah.johnson@email.com',
                    'Phone Number' => '+1234567890',
                    'Address' => '123 Main Street, Springfield, IL 62701',
                    'Who do you live with?' => 'My husband Mike and our two children, Emma (12) and Jake (8)',
                    'What type of building do you live in?' => 'house',
                    'Are any members of your household allergic to animals?' => 'no',
                    'Do you have other pets?' => 'yes',
                    'Have you had pets in the past?' => 'yes',
                    'How many hours will your pet be left alone daily?' => '6-7 hours',
                    'Who will be responsible for daily pet care?' => 'The whole family will take turns, with primary responsibility being mine.',
                ]),
            ],
            [
                'user_id' => $createdUsers[1]->id,
                'pet_id' => 2, // Bella
                'status' => 'approved',
                'reviewed_at' => now()->subDays(2),
                'answers' => json_encode([
                    'First Name' => 'Robert',
                    'Last Name' => 'Chen',
                    'Email Address' => 'robert.chen@email.com',
                    'Phone Number' => '+1987654321',
                    'Address' => '456 Oak Avenue, Chicago, IL 60601',
                    'Who do you live with?' => 'I live alone in a quiet apartment',
                    'What type of building do you live in?' => 'apartment',
                    'Are any members of your household allergic to animals?' => 'no',
                    'Do you have other pets?' => 'no',
                    'Have you had pets in the past?' => 'yes',
                    'How many hours will your pet be left alone daily?' => '2-3 hours',
                    'Who will be responsible for daily pet care?' => 'I will be the sole caregiver.',
                ]),
            ],
            [
                'user_id' => $createdUsers[2]->id,
                'pet_id' => 5, // Milo
                'status' => 'under_review',
                'answers' => json_encode([
                    'First Name' => 'Jennifer',
                    'Last Name' => 'Williams',
                    'Email Address' => 'jennifer.williams@email.com',
                    'Phone Number' => '+1555666777',
                    'Address' => '789 Pine Street, Boston, MA 02101',
                    'Who do you live with?' => 'I share the apartment with my roommate Lisa',
                    'What type of building do you live in?' => 'apartment',
                    'Are any members of your household allergic to animals?' => 'no',
                    'Do you have other pets?' => 'no',
                    'Have you had pets in the past?' => 'no',
                    'How many hours will your pet be left alone daily?' => '8 hours',
                    'Who will be responsible for daily pet care?' => 'I will be the primary caregiver with help from my roommate.',
                ]),
            ],
        ];

        foreach ($applications as $applicationData) {
            AdoptionApplication::create($applicationData);
        }
    }
}
