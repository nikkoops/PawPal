<?php
// Troubleshoot and fix pet images

// Load the Laravel application
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Pet Image Troubleshooter ===\n";

// Create default images if they don't exist
$defaultImages = [
    'default-dog.jpg',
    'default-cat.jpg',
    'default-pet.jpg'
];

foreach ($defaultImages as $image) {
    $path = public_path('images/' . $image);
    if (!file_exists($path)) {
        if (!is_dir(public_path('images'))) {
            mkdir(public_path('images'), 0755, true);
        }
        
        // Create a simple colored image
        $img = imagecreatetruecolor(300, 300);
        
        // Fill with different colors based on the type
        if (strpos($image, 'dog') !== false) {
            $color = imagecolorallocate($img, 200, 150, 100); // Brown for dogs
        } elseif (strpos($image, 'cat') !== false) {
            $color = imagecolorallocate($img, 100, 150, 200); // Blue for cats
        } else {
            $color = imagecolorallocate($img, 150, 200, 150); // Green for other pets
        }
        
        imagefill($img, 0, 0, $color);
        
        // Add some text
        $textColor = imagecolorallocate($img, 255, 255, 255);
        $text = strtoupper(str_replace(['default-', '.jpg'], '', $image));
        imagestring($img, 5, 100, 140, $text, $textColor);
        
        // Save the image
        imagejpeg($img, $path);
        imagedestroy($img);
        
        echo "Created default image: {$path}\n";
    } else {
        echo "Default image exists: {$path}\n";
    }
}

// Fix storage link if needed
if (!file_exists(public_path('storage'))) {
    symlink(storage_path('app/public'), public_path('storage'));
    echo "Created storage symlink\n";
} else {
    echo "Storage symlink exists\n";
}

// Check pets with images
$pets = \App\Models\Pet::whereNotNull('image')->get();
echo "Found " . $pets->count() . " pets with images\n";

foreach ($pets as $pet) {
    echo "Pet: {$pet->name}, Image: {$pet->image}\n";
    
    // Check if the file exists
    $fullPath = storage_path('app/public/' . $pet->image);
    $exists = file_exists($fullPath);
    
    echo "  Image " . ($exists ? "exists" : "doesn't exist") . " at {$fullPath}\n";
    echo "  Image URL: {$pet->image_url}\n";
    
    // If the path doesn't include 'pets/' folder, fix it
    if (strpos($pet->image, 'pets/') === false && $exists) {
        $newPath = 'pets/' . basename($pet->image);
        echo "  Moving image to correct folder: {$newPath}\n";
        
        // Create the directory if it doesn't exist
        if (!is_dir(storage_path('app/public/pets'))) {
            mkdir(storage_path('app/public/pets'), 0755, true);
        }
        
        // Copy the file to the new path
        if (copy(storage_path('app/public/' . $pet->image), storage_path('app/public/' . $newPath))) {
            $pet->image = $newPath;
            $pet->save();
            echo "  Updated image path in database\n";
        } else {
            echo "  Failed to copy image\n";
        }
    }
}

echo "\n=== Troubleshooting Complete ===\n";