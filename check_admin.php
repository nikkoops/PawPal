<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$adminUsers = App\Models\User::where('is_admin', true)->get();

echo "Admin users in the system:\n";
foreach($adminUsers as $user) {
    echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
}
