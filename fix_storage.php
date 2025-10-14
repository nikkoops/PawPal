<?php
// Fix storage links and permissions

// Ensure storage directory is writable
chmod(storage_path(), 0755);
chmod(storage_path('app'), 0755);
chmod(storage_path('app/public'), 0755);

// Create pets directory if it doesn't exist
if (!is_dir(storage_path('app/public/pets'))) {
    mkdir(storage_path('app/public/pets'), 0755, true);
}

// Check if symbolic link exists and create it if not
if (!file_exists(public_path('storage'))) {
    echo "Creating storage symbolic link...\n";
    symlink(storage_path('app/public'), public_path('storage'));
    echo "Symbolic link created.\n";
} else {
    echo "Symbolic link already exists.\n";
}

// Check sample pet and fix if needed
$pet = \App\Models\Pet::where('name', 'like', '%nicole%')->first();
if ($pet && $pet->image) {
    echo "Found pet with image: {$pet->image}\n";
    echo "Image URL: {$pet->image_url}\n";
    
    // Check if the file exists
    $filePath = storage_path('app/public/' . $pet->image);
    if (file_exists($filePath)) {
        echo "Image file exists at: {$filePath}\n";
    } else {
        echo "Image file doesn't exist at: {$filePath}\n";
    }
}

echo "Done!\n";