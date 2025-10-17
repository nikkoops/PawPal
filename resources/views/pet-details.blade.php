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
            <img src="{{ $pet->image_url }}" alt="{{ $pet->name }}" class="w-full h-96 md:h-full object-cover">
          </div>

          <!-- Pet Details -->
          <div class="md:w-1/2 p-8">
            <div class="space-y-6">
              <!-- Pet Name and Basic Info -->
              <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $pet->name }}</h1>
                <div class="flex flex-wrap gap-2 mb-4">
                  <span class="px-3 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">{{ ucfirst($pet->type) }}</span>
                  <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">{{ $pet->breed }}</span>
                  <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">{{ ucfirst($pet->size) }}</span>
                  <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">{{ $pet->age_display }}</span>
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
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Pet Details</h3>
                <div class="grid grid-cols-1 gap-3">
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Gender:</span>
                    <span class="text-gray-600">{{ ucfirst($pet->gender) }}</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Age:</span>
                    <span class="text-gray-600">{{ $pet->age_display }}</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Size:</span>
                    <span class="text-gray-600">{{ ucfirst($pet->size) }}</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Breed:</span>
                    <span class="text-gray-600">{{ $pet->breed }}</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Location:</span>
                    <span class="text-gray-600">{{ $pet->location }}</span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Vaccinated:</span>
                    <span class="text-gray-600">
                      @if($pet->is_vaccinated)
                        <span class="text-green-600 font-medium">✓ Yes</span>
                      @else
                        <span class="text-red-600 font-medium">✗ No</span>
                      @endif
                    </span>
                  </div>
                  <div class="flex justify-between items-center py-2 border-b border-gray-200">
                    <span class="font-medium text-gray-700">Spayed/Neutered:</span>
                    <span class="text-gray-600">
                      @if($pet->is_neutered)
                        <span class="text-green-600 font-medium">✓ Yes</span>
                      @else
                        <span class="text-red-600 font-medium">✗ No</span>
                      @endif
                    </span>
                  </div>
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