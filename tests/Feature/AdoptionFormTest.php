<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pet;
use App\Models\AdoptionApplication;

class AdoptionFormTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that adoption form correctly associates with a pet.
     */
    public function test_adoption_form_associates_with_pet(): void
    {
        // Create a test pet
        $pet = Pet::factory()->create([
            'name' => 'TestPet',
            'breed' => 'TestBreed',
            'type' => 'dog',
            'is_available' => true
        ]);

        // Simulate form submission with pet_id
        $response = $this->post('/submit-adoption', [
            '_token' => csrf_token(),
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@example.com',
            'phone' => '555-555-5555',
            'address' => '123 Test St',
            'birthDate' => '1990-01-01',
            'occupation' => 'Tester',
            'pet_id' => $pet->id,
            'pet_type' => 'dog',
            'pet_breed' => 'TestBreed',
            'pet_name' => 'TestPet'
        ]);

        // Check if application was created
        $this->assertDatabaseHas('adoption_applications', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'pet_id' => $pet->id
        ]);

        // Check if application has correct pet relationship
        $application = AdoptionApplication::latest()->first();
        $this->assertNotNull($application->pet);
        $this->assertEquals('TestPet', $application->pet->name);
        $this->assertEquals('TestBreed', $application->pet->breed);
    }

    /**
     * Test API endpoint for getting pet by name
     */
    public function test_get_pet_by_name_api(): void
    {
        // Create a test pet
        $pet = Pet::factory()->create([
            'name' => 'Bella',
            'breed' => 'Labrador',
            'type' => 'dog',
            'is_available' => true
        ]);

        // Call API endpoint
        $response = $this->get('/api/pets/by-name/Bella');

        // Check response
        $response->assertStatus(200)
            ->assertJson([
                'id' => $pet->id,
                'name' => 'Bella',
                'breed' => 'Labrador',
                'type' => 'dog'
            ]);
    }
}