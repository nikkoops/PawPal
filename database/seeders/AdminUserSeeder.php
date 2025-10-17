<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // First, check if admin user already exists and update if necessary
        $existingAdmin = User::where('email', 'admin@pawpal.com')->first();
        
        if ($existingAdmin) {
            // Update existing admin to ensure they have the correct role
            $existingAdmin->update([
                'role' => 'system_admin',
                'is_admin' => true,
                'password' => Hash::make('password'), // Ensure password is correct
            ]);
            echo "Admin user updated successfully!\n";
        } else {
            // Create new admin user
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@pawpal.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => true,
                'role' => 'system_admin',
            ]);
            echo "Admin user created successfully!\n";
        }

        echo "Email: admin@pawpal.com\n";
        echo "Password: password\n";
        echo "Role: system_admin\n";
    }
}