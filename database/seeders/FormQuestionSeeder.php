<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormQuestion;

class FormQuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // Personal Information
            [
                'question_text' => 'First Name',
                'question_type' => 'text',
                'is_required' => true,
                'options' => null,
                'order' => 1,
            ],
            [
                'question_text' => 'Last Name',
                'question_type' => 'text',
                'is_required' => true,
                'options' => null,
                'order' => 2,
            ],
            [
                'question_text' => 'Email Address',
                'question_type' => 'text',
                'is_required' => true,
                'options' => null,
                'order' => 3,
            ],
            [
                'question_text' => 'Phone Number',
                'question_type' => 'text',
                'is_required' => true,
                'options' => null,
                'order' => 4,
            ],
            [
                'question_text' => 'Address',
                'question_type' => 'textarea',
                'is_required' => true,
                'options' => null,
                'order' => 5,
            ],
            [
                'question_text' => 'Who do you live with?',
                'question_type' => 'textarea',
                'is_required' => true,
                'options' => null,
                'order' => 6,
            ],
            [
                'question_text' => 'What type of building do you live in?',
                'question_type' => 'select',
                'is_required' => true,
                'options' => json_encode(['house', 'apartment', 'condo', 'townhouse', 'other']),
                'order' => 7,
            ],
            [
                'question_text' => 'Are any members of your household allergic to animals?',
                'question_type' => 'radio',
                'is_required' => true,
                'options' => json_encode(['yes', 'no']),
                'order' => 8,
            ],
            [
                'question_text' => 'Do you have other pets?',
                'question_type' => 'radio',
                'is_required' => true,
                'options' => json_encode(['yes', 'no']),
                'order' => 9,
            ],
            [
                'question_text' => 'Have you had pets in the past?',
                'question_type' => 'radio',
                'is_required' => true,
                'options' => json_encode(['yes', 'no']),
                'order' => 10,
            ],
            [
                'question_text' => 'How many hours will your pet be left alone daily?',
                'question_type' => 'text',
                'is_required' => true,
                'options' => null,
                'order' => 11,
            ],
            [
                'question_text' => 'Who will be responsible for daily pet care?',
                'question_type' => 'textarea',
                'is_required' => true,
                'options' => null,
                'order' => 12,
            ],
        ];

        foreach ($questions as $questionData) {
            FormQuestion::create($questionData);
        }
    }
}
