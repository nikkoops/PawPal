<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$adminUsers = App\Models\User::where('is_admin', true)->get();

echo "Admin users in the system:\n";
if ($adminUsers->count() > 0) {
    foreach($adminUsers as $user) {
        echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
    }
} else {
    echo "No admin users found.\n";
}

echo "\nAdmin login credentials:\n";
echo "Email: admin@pawpal.com\n";
echo "Password: password\n";
