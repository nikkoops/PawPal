<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pet->name ?? 'Pet Details' }} - PawPal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
</head>

<body>
  <!-- Header -->
  @include('components.header')

  <!-- Pet Details Content -->
  <div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4">
      <!-- Back Button -->
      <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700">
          <i data-lucide="arrow-left" class="h-4 w-4 mr-2"></i>
          Back to Available Pets
        </a>
      </div>

      <!-- Pet Information -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="md:flex">
          <!-- Pet Image -->
          <div class="md:w-1/2">
            @if($pet->image)
              <img src="{{ Storage::url($pet->image) }}" alt="{{ $pet->name }}" class="w-full h-96 md:h-full object-cover">
            @else
              <div class="w-full h-96 md:h-full bg-gray-200 flex items-center justify-center">
                <i data-lucide="heart" class="h-24 w-24 text-gray-400"></i>
              </div>
            @endif
          </div>

          <!-- Pet Details -->
          <div class="md:w-1/2 p-8">
            <div class="space-y-6">
              <!-- Pet Name and Basic Info -->
              <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $pet->name }}</h1>
                <div class="flex flex-wrap gap-2 mb-4">
                  <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">{{ ucfirst($pet->type) }}</span>
                  <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">{{ $pet->breed ?? 'Mixed' }}</span>
                  <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">{{ ucfirst($pet->size ?? 'Medium') }}</span>
                  @if($pet->is_available)
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Available</span>
                  @endif
                </div>
              </div>

              <!-- Description -->
              <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-3">About {{ $pet->name }}</h2>
                <p class="text-gray-600 leading-relaxed">
                  {{ $pet->description ?? "Meet {$pet->name}, a wonderful {$pet->type} looking for a loving home." }}
                </p>
              </div>

              <!-- Pet Characteristics -->
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Characteristics</h3>
                <div class="grid grid-cols-2 gap-4">
                  <div class="flex items-center">
                    <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mr-2"></i>
                    <span class="text-sm">{{ $pet->is_vaccinated ? 'Vaccinated' : 'Not Vaccinated' }}</span>
                  </div>
                  <div class="flex items-center">
                    <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mr-2"></i>
                    <span class="text-sm">{{ $pet->is_neutered ? 'Spayed/Neutered' : 'Not Spayed/Neutered' }}</span>
                  </div>
                  <div class="flex items-center">
                    <i data-lucide="map-pin" class="h-5 w-5 text-purple-500 mr-2"></i>
                    <span class="text-sm">{{ $pet->location ?? 'Manila' }}</span>
                  </div>
                  @if($pet->age)
                  <div class="flex items-center">
                    <i data-lucide="calendar" class="h-5 w-5 text-blue-500 mr-2"></i>
                    <span class="text-sm">{{ $pet->age }} years old</span>
                  </div>
                  @endif
                </div>
              </div>

              <!-- Adoption Fee -->
              @if($pet->adoption_fee)
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Adoption Fee</h3>
                <p class="text-2xl font-bold text-purple-600">${{ number_format($pet->adoption_fee, 2) }}</p>
              </div>
              @endif

              <!-- Contact Buttons -->
              <div class="space-y-3">
                <a href="{{ url('/contact') }}?pet={{ $pet->name }}&action=adopt" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center justify-center">
                  <i data-lucide="heart" class="h-5 w-5 mr-2"></i>
                  Adopt {{ $pet->name }}
                </a>
                <a href="{{ url('/contact') }}?pet={{ $pet->name }}&action=info" class="w-full bg-white hover:bg-gray-50 text-purple-600 border border-purple-600 px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center justify-center">
                  <i data-lucide="info" class="h-5 w-5 mr-2"></i>
                  Get More Information
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>

// Sample pet data (in a real application, this would come from a database)
$pets = [
    1 => [
        'name' => 'Max',
        'type' => 'Dog',
        'age' => 'Adult',
        'size' => 'Large',
        'breed' => 'German Shepherd Mix',
        'gender' => 'Male',
        'description' => 'Max was rescued in Quincy City and has been in the shelter for 34 days. Energetic and playful, he\'ll make a great companion for an active family. Max loves long walks, playing fetch, and meeting new people.',
        'image' => 'images/golden-retriever-mix-happy-dog-outdoors.png',
        'urgent' => false,
    'location' => 'Quincy City Shelter',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => true,
    ],
    2 => [
        'name' => 'Bella',
        'type' => 'Dog',
        'age' => 'Senior',
        'size' => 'Large',
        'breed' => 'Labrador Mix',
        'gender' => 'Female',
        'description' => 'Bella, rescued in Caboolture, has spent 60 days in the shelter. A gentle giant, she loves quiet walks and cuddles. Perfect for a calm household looking for a loving companion.',
        'image' => 'images/white-and-brown-senior-dog-gentle-expression.png',
        'urgent' => true,
    'location' => 'Caboolture Animal Shelter',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => false,
    ],
    3 => [
        'name' => 'Charlie',
        'type' => 'Dog',
        'age' => 'Adult',
        'size' => 'Medium',
        'breed' => 'Mixed Breed',
        'gender' => 'Male',
        'description' => 'Charlie is a friendly, energetic dog who loves to play and explore.',
        'image' => 'images/brown-dog-with-blue-collar-smiling.png',
        'urgent' => false,
    'location' => 'Local Animal Shelter',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => true,
    ],
    4 => [
        'name' => 'Rocky',
        'type' => 'Dog',
        'age' => 'Senior',
        'size' => 'Large',
        'breed' => 'Mixed Breed',
        'gender' => 'Male',
        'description' => 'Rocky is a gentle senior dog looking for a quiet home to spend his golden years.',
        'image' => 'images/senior-dog-with-gray-muzzle-loyal-expression.png',
        'urgent' => true,
    'location' => 'Senior Pet Sanctuary',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => true,
    ],
    5 => [
        'name' => 'Shadow',
        'type' => 'Cat',
        'age' => 'Adult',
        'size' => 'Medium',
        'breed' => 'Domestic Shorthair',
        'gender' => 'Male',
        'description' => 'Shadow is a calm, independent cat who enjoys quiet spaces and gentle attention.',
        'image' => 'images/black-and-white-cat-sitting-on-wooden-surface.png',
        'urgent' => false,
    'location' => 'City Cat Rescue',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => false,
    ],
    6 => [
        'name' => 'Ginger',
        'type' => 'Cat',
        'age' => 'Young',
        'size' => 'Small',
        'breed' => 'Orange Tabby',
        'gender' => 'Female',
        'description' => 'Ginger is a playful young cat who loves toys and climbing.',
        'image' => 'images/orange-tabby-kitten-cute-expression.png',
        'urgent' => false,
    'location' => 'Kitten Foster Network',
        'vaccinated' => true,
        'spayed_neutered' => false,
        'good_with_kids' => true,
        'good_with_pets' => true,
    ],
    7 => [
        'name' => 'Milo',
        'type' => 'Cat',
        'age' => 'Adult',
        'size' => 'Medium',
        'breed' => 'Tabby',
        'gender' => 'Male',
        'description' => 'Milo is an alert, intelligent cat who enjoys interactive play and exploring.',
        'image' => 'images/tabby-cat-with-green-eyes-alert.png',
        'urgent' => false,
    'location' => 'Downtown Cat Cafe',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => true,
    ],
    8 => [
        'name' => 'Whiskers',
        'type' => 'Cat',
        'age' => 'Senior',
        'size' => 'Medium',
        'breed' => 'Mixed Breed',
        'gender' => 'Female',
        'description' => 'Whiskers is a calm senior cat who prefers a quiet, loving home.',
        'image' => 'images/orange-and-white-senior-cat-calm-expression.png',
        'urgent' => true,
    'location' => 'Senior Cat Sanctuary',
        'vaccinated' => true,
        'spayed_neutered' => true,
        'good_with_kids' => true,
        'good_with_pets' => false,
    ],
    // Add more pets as needed
];

$pet = isset($pets[$pet_id]) ? $pets[$pet_id] : $pets[1];

?>

<style>
.pet-details-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.pet-details-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    align-items: start;
}

@media (min-width: 768px) {
    .pet-details-grid {
        grid-template-columns: 1fr 1fr;
        align-items: start;
    }
}

.pet-image-section img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.pet-info-section {
    padding: 0 1rem 1rem 1rem;
}

.pet-name {
    font-size: 2.5rem;
    font-weight: bold;
    color: #1f2937;
    margin-bottom: 0.5rem;
    margin-top: 0;
    line-height: 1;
}

.pet-type {
    font-size: 1.25rem;
    color: #6b7280;
    margin-bottom: 1rem;
}

.urgent-notice {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 1rem;
    border-radius: 30px;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.pet-details-list {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
    margin-top: 0.5rem;
}

.pet-details-list h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1rem;
    margin-top: 0;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #4b5563;
}

.detail-value {
    color: #1f2937;
}

.pet-description {
    font-size: 1.125rem;
    line-height: 1.6;
    color: #4b5563;
    margin-bottom: 2rem;
}

.adoption-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-adopt {
    background: #10b981;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: background 0.3s;
}

.btn-adopt:hover {
    background: #059669;
    color: white;
    text-decoration: none;
}

.btn-contact {
    background: #3b82f6;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: background 0.3s;
}

.btn-contact:hover {
    background: #2563eb;
    color: white;
    text-decoration: none;
}

.btn-back {
    background: #6b7280;
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 2rem;
    transition: background 0.3s;
}

.btn-back:hover {
    background: #4b5563;
    color: white;
    text-decoration: none;
}

.check-mark {
    color: #10b981;
    font-weight: bold;
}

.x-mark {
    color: #ef4444;
    font-weight: bold;
}
</style>

<div class="pet-details-container">
    <a href="{{ url('/') }}#pets-section" class="btn-back">← Back to Available Pets</a>
    
    <div class="pet-details-grid">
        <!-- Pet Image -->
        <div class="pet-image-section">
            <img src="<?php echo $pet['image']; ?>" alt="<?php echo $pet['name']; ?>" onerror="this.src='images/placeholder-pet.jpg'">
        </div>
        
        <!-- Pet Information -->
        <div class="pet-info-section">
            <h1 class="pet-name"><?php echo $pet['name']; ?></h1>
            <p class="pet-type"><?php echo $pet['breed']; ?> • <?php echo $pet['type']; ?></p>
            
            <?php if ($pet['urgent']): ?>
            <div class="urgent-notice">
                🚨 Urgent: This pet needs to be adopted this week!
            </div>
            <?php endif; ?>
            
            <!-- Pet Details -->
            <div class="pet-details-list">
                <h3>Pet Details</h3>
                <div class="detail-item">
                    <span class="detail-label">Age:</span>
                    <span class="detail-value"><?php echo $pet['age']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Size:</span>
                    <span class="detail-value"><?php echo $pet['size']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Gender:</span>
                    <span class="detail-value"><?php echo $pet['gender']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Location:</span>
                    <span class="detail-value"><?php echo $pet['location']; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Vaccinated:</span>
                    <span class="detail-value"><?php echo $pet['vaccinated'] ? '<span class="check-mark">✓ Yes</span>' : '<span class="x-mark">✗ No</span>'; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Spayed/Neutered:</span>
                    <span class="detail-value"><?php echo $pet['spayed_neutered'] ? '<span class="check-mark">✓ Yes</span>' : '<span class="x-mark">✗ No</span>'; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Good with kids:</span>
                    <span class="detail-value"><?php echo $pet['good_with_kids'] ? '<span class="check-mark">✓ Yes</span>' : '<span class="x-mark">✗ No</span>'; ?></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Good with other pets:</span>
                    <span class="detail-value"><?php echo $pet['good_with_pets'] ? '<span class="check-mark">✓ Yes</span>' : '<span class="x-mark">✗ No</span>'; ?></span>
                </div>
            </div>
            
            <!-- Description -->
            <p class="pet-description"><?php echo $pet['description']; ?></p>
            
            <!-- Adoption Actions -->
            <div class="adoption-actions">
                                <a href="{{ url('/adopt', ['pet' => $pet['name']]) }}" class="btn-adopt" id="adoptLink">
                    ❤️ Adopt {{ $pet['name'] }}
                </a>
                <a href="{{ url('/contact', ['pet' => $pet_id, 'action' => 'contact']) }}" class="btn-contact">Contact Shelter</a>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
