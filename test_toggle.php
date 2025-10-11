<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Before toggle:\n";
$pet = App\Models\Pet::find(5);
echo "Pet: {$pet->name}, Available: " . ($pet->is_available ? 'YES' : 'NO') . "\n";

echo "\nToggling availability...\n";
$pet->update(['is_available' => !$pet->is_available]);

echo "\nAfter toggle:\n";
$pet->refresh();
echo "Pet: {$pet->name}, Available: " . ($pet->is_available ? 'YES' : 'NO') . "\n";
