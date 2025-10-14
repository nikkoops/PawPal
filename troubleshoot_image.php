<?php
// This script troubleshoots a specific image issue

// Initialize Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Set the specific image path to troubleshoot
$imagePath = 'pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png';

// Check if the file exists in storage
$storagePath = storage_path('app/public/' . $imagePath);
echo "Checking if image exists at: {$storagePath}\n";
echo "File exists: " . (file_exists($storagePath) ? "YES" : "NO") . "\n";

if (file_exists($storagePath)) {
    echo "File size: " . filesize($storagePath) . " bytes\n";
    echo "File permissions: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "\n";
    
    // Check if the file is readable
    echo "File is readable: " . (is_readable($storagePath) ? "YES" : "NO") . "\n";
    
    // Check if the file is a valid image
    $imageInfo = getimagesize($storagePath);
    if ($imageInfo) {
        echo "Valid image file: YES\n";
        echo "Image type: " . $imageInfo['mime'] . "\n";
        echo "Image dimensions: " . $imageInfo[0] . "x" . $imageInfo[1] . "\n";
    } else {
        echo "Valid image file: NO\n";
    }
}

// Check public symlink
$publicPath = public_path('storage/' . $imagePath);
echo "\nChecking if image exists in public path: {$publicPath}\n";
echo "File exists: " . (file_exists($publicPath) ? "YES" : "NO") . "\n";

// Try to fix the issue
echo "\nTrying to fix the issue...\n";

// Check if pets directory exists in storage
$petsDir = storage_path('app/public/pets');
if (!is_dir($petsDir)) {
    echo "Creating pets directory...\n";
    mkdir($petsDir, 0755, true);
}

// Check if the storage link exists
if (!file_exists(public_path('storage'))) {
    echo "Creating storage symlink...\n";
    symlink(storage_path('app/public'), public_path('storage'));
}

// Find the pet with this image
$pet = \App\Models\Pet::where('image', $imagePath)->first();
if ($pet) {
    echo "\nFound pet using this image: {$pet->name} (ID: {$pet->id})\n";
    echo "Pet image path: {$pet->image}\n";
    echo "Image file exists: " . ($pet->imageFileExists() ? "YES" : "NO") . "\n";
    echo "Image URL: {$pet->image_url}\n";
    
    // Check for the file in multiple locations
    $possibleLocations = [
        storage_path('app/public/' . $imagePath),
        storage_path('app/' . $imagePath),
        public_path('storage/' . $imagePath),
        public_path($imagePath),
    ];
    
    echo "\nChecking possible file locations:\n";
    foreach ($possibleLocations as $location) {
        echo "- {$location}: " . (file_exists($location) ? "EXISTS" : "NOT FOUND") . "\n";
    }
    
    // Check if we can load the image with curl
    $url = asset('storage/' . $imagePath);
    echo "\nTrying to load image from URL: {$url}\n";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "HTTP response code: {$responseCode}\n";
    
    // Check web server permissions
    $webUser = posix_getpwuid(posix_geteuid());
    echo "\nWeb server running as user: " . $webUser['name'] . "\n";
}

echo "\nTroubleshooting completed.\n";