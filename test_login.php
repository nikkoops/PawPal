<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "Testing login functionality...\n\n";

// Test credentials
$email = 'admin@pawpal.com';
$password = 'password';

echo "Testing credentials:\n";
echo "Email: $email\n";
echo "Password: $password\n\n";

// Get the user
$user = User::where('email', $email)->first();

if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

echo "✅ User found in database\n";
echo "   Name: {$user->name}\n";
echo "   Email: {$user->email}\n";
echo "   Is Admin: " . ($user->is_admin ? 'Yes' : 'No') . "\n";
echo "   Email Verified: " . ($user->email_verified_at ? 'Yes' : 'No') . "\n\n";

// Test password verification
echo "Testing password verification...\n";
if (Hash::check($password, $user->password)) {
    echo "✅ Password verification: SUCCESS\n";
} else {
    echo "❌ Password verification: FAILED\n";
    exit(1);
}

// Test Laravel Auth::attempt (simulated)
echo "\nTesting Laravel Auth::attempt simulation...\n";
$credentials = [
    'email' => $email,
    'password' => $password
];

// This simulates what Auth::attempt does internally
$user = User::where('email', $credentials['email'])->first();
if ($user && Hash::check($credentials['password'], $user->password)) {
    echo "✅ Auth::attempt simulation: SUCCESS\n";
    echo "✅ Admin check: " . ($user->is_admin ? 'PASSED' : 'FAILED') . "\n";
} else {
    echo "❌ Auth::attempt simulation: FAILED\n";
    exit(1);
}

echo "\n🎉 All login functionality tests PASSED!\n";
echo "The admin user should be able to log in successfully.\n";
echo "\nLogin URL: http://localhost:8000/admin/login\n";
echo "Credentials:\n";
echo "  Email: admin@pawpal.com\n";
echo "  Password: password\n";