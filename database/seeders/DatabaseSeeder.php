<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // PetSeeder::class, // Commented out to prevent demo pets from auto-loading
            // FormQuestionSeeder::class, // Temporarily commented out due to missing table
            // AdoptionApplicationSeeder::class, // Temporarily commented out due to missing table
            AdminUserSeeder::class, // Keep admin user seeder for authentication
        ]);
    }
}
