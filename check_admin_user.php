<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "Checking admin user in database...\n\n";

// Check if admin user exists
$adminUser = User::where('email', 'admin@pawpal.com')->first();

if ($adminUser) {
    echo "✓ Admin user found:\n";
    echo "  ID: " . $adminUser->id . "\n";
    echo "  Name: " . $adminUser->name . "\n";
    echo "  Email: " . $adminUser->email . "\n";
    echo "  Is Admin: " . ($adminUser->is_admin ? 'Yes' : 'No') . "\n";
    echo "  Email Verified: " . ($adminUser->email_verified_at ? 'Yes' : 'No') . "\n";
    echo "  Password Hash: " . substr($adminUser->password, 0, 30) . "...\n";
    
    // Test password verification
    if (Hash::check('password', $adminUser->password)) {
        echo "  Password verification: ✓ SUCCESS\n";
    } else {
        echo "  Password verification: ✗ FAILED\n";
    }
} else {
    echo "✗ Admin user NOT found in database\n";
    echo "  Solution: Run 'php artisan db:seed --class=AdminUserSeeder'\n";
}

echo "\nTotal users in database: " . User::count() . "\n";