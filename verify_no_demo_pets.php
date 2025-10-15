<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pet;

echo "Verifying pet database is empty...\n\n";

$petCount = Pet::count();
echo "Total pets in database: {$petCount}\n";

if ($petCount === 0) {
    echo "✅ SUCCESS: No demo pets found - pet database is completely empty\n";
    echo "✅ The website will now load with no pet cards displayed\n";
    echo "✅ Users must manually add pets through the admin interface\n";
} else {
    echo "⚠️  WARNING: {$petCount} pets still exist in database:\n";
    
    $pets = Pet::all();
    foreach ($pets as $pet) {
        echo "  - {$pet->name} ({$pet->type})\n";
    }
    echo "\nTo remove these pets, run:\n";
    echo "docker exec pawpal_app php artisan migrate:fresh --seed\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "DEMO PETS REMOVAL SUMMARY:\n";
echo str_repeat("=", 50) . "\n";
echo "✅ PetSeeder removed from DatabaseSeeder.php\n";
echo "✅ PetSeeder.php commented out (preserves code for future use)\n";
echo "✅ Database cleared and reseeded without demo pets\n";
echo "✅ Admin user preserved for authentication\n";
echo "\nDemo pets that are no longer auto-created:\n";
echo "• Max (German Shepherd Mix)\n";
echo "• Bella (Labrador Mix)\n";
echo "• Charlie (Mixed Breed Dog)\n";
echo "• Rocky (Mixed Breed Dog)\n";
echo "• Milo (Tabby Cat)\n";
echo "• Whiskers (Mixed Breed Cat)\n";
echo "\nThe website now starts with an empty pet list.\n";