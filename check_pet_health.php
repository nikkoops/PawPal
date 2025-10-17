<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Get the latest pet
$pet = App\Models\Pet::latest()->first();

if ($pet) {
    echo "Pet: " . $pet->name . "\n";
    echo "ID: " . $pet->id . "\n";
    echo "=== Health Fields ===\n";
    echo "is_vaccinated: " . ($pet->is_vaccinated ? 'true' : 'false') . "\n";
    echo "is_neutered: " . ($pet->is_neutered ? 'true' : 'false') . "\n";
    echo "is_dewormed: " . ($pet->is_dewormed ? 'true' : 'false') . "\n";
    echo "is_tick_flea_treated: " . ($pet->is_tick_flea_treated ? 'true' : 'false') . "\n";
    echo "on_preventive_medication: " . ($pet->on_preventive_medication ? 'true' : 'false') . "\n";
    echo "has_special_medical_needs: " . ($pet->has_special_medical_needs ? 'true' : 'false') . "\n";
    echo "is_mobility_impaired: " . ($pet->is_mobility_impaired ? 'true' : 'false') . "\n";
    echo "is_undergoing_treatment: " . ($pet->is_undergoing_treatment ? 'true' : 'false') . "\n";
    echo "=== Raw Database Values ===\n";
    print_r($pet->getAttributes());
} else {
    echo "No pets found\n";
}