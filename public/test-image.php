<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Display Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .image-test {
            margin-bottom: 40px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
        img {
            max-width: 100%;
            border: 1px dashed #ccc;
        }
        pre {
            background: #f5f5f5;
            padding: 10px;
            overflow: auto;
            font-size: 14px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>PawPal Image Display Test</h1>
    <p>This page tests various ways of displaying the pet image to determine why it's not showing properly in the admin panel.</p>
    
    <div class="image-test">
        <h2>1. Direct Image Tag</h2>
        <img src="storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png" alt="Pet Image">
        <pre>&lt;img src="storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png" alt="Pet Image"&gt;</pre>
    </div>
    
    <div class="image-test">
        <h2>2. Full Path URL</h2>
        <img src="/storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png" alt="Pet Image">
        <pre>&lt;img src="/storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png" alt="Pet Image"&gt;</pre>
    </div>
    
    <div class="image-test">
        <h2>3. With Asset Helper</h2>
        <img src="<?php echo asset('storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png'); ?>" alt="Pet Image">
        <pre>&lt;img src="&lt;?php echo asset('storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png'); ?&gt;" alt="Pet Image"&gt;</pre>
    </div>
    
    <div class="image-test">
        <h2>4. Base64 Encoded Image</h2>
        <?php
        $imagePath = storage_path('app/public/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png');
        if (file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));
            echo '<img src="data:image/png;base64,' . $imageData . '" alt="Base64 Encoded Pet Image">';
            echo '<p>✓ Image file read successfully and displayed as base64</p>';
        } else {
            echo '<p>✗ Image file not found at: ' . $imagePath . '</p>';
        }
        ?>
        <pre>&lt;img src="data:image/png;base64,..." alt="Base64 Encoded Pet Image"&gt;</pre>
    </div>
    
    <div class="image-test">
        <h2>5. System Information</h2>
        <pre>
<?php
echo "Storage Path: " . storage_path('app/public/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png') . "\n";
echo "Public Path: " . public_path('storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png') . "\n";
echo "Storage URL: " . asset('storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png') . "\n";
echo "APP_URL: " . env('APP_URL') . "\n";
echo "File Exists (Storage): " . (file_exists(storage_path('app/public/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png')) ? 'Yes' : 'No') . "\n";
echo "File Exists (Public): " . (file_exists(public_path('storage/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png')) ? 'Yes' : 'No') . "\n";

// Check symlink
echo "Symlink Status: " . (is_link(public_path('storage')) ? 'Valid Symlink' : 'Not a symlink') . "\n";
if (is_link(public_path('storage'))) {
    echo "Symlink Target: " . readlink(public_path('storage')) . "\n";
}

// Check environment
echo "PHP Version: " . phpversion() . "\n";
echo "Laravel Version: " . app()->version() . "\n";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";

// Check image dimensions
$imageInfo = getimagesize(storage_path('app/public/pets/JnR5q0urNmRVtVQs3DOg2NCJCtT9QSizSVQ0HEKb.png'));
if ($imageInfo) {
    echo "Image Dimensions: {$imageInfo[0]}x{$imageInfo[1]}\n";
    echo "Image Type: " . $imageInfo['mime'] . "\n";
}
?>
        </pre>
    </div>
    
    <h2>Conclusion</h2>
    <p>If the base64 encoded image displays correctly but the others don't, it's likely a URL/path issue rather than a file permission issue.</p>
</body>
</html>