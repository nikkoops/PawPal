<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CRoboto" rel="stylesheet">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <title>Find Pets - PawPal</title>
  <link href="styles/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f9fafb;
    }

    /* Header Styles */
    .header {
      background: white;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 0.75rem;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      height: 3rem;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .logo img {
      height: 1.5rem;
    }

    .logo span {
      font-size: 1.25rem;
      font-weight: bold;
      color: #1f2937;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
      list-style: none;
    }

    .nav-links a {
      text-decoration: none;
      color: #4b5563;
      font-weight: 500;
      transition: color 0.3s;
    }

    .nav-links a:hover {
      color: #1f2937;
    }

    .nav-links a.active {
      color: #1f2937;
      font-weight: 600;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
    }

    /* Main Content */
    .pets-section {
      padding: 2rem 0.75rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .section-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-header h2 {
      font-size: 2.5rem;
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 1rem;
    }

    .section-header p {
      font-size: 1.125rem;
      color: #4b5563;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Filters */
    .filters {
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }

    .filters h3 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
      color: #1f2937;
    }

    .filter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .filter-input,
    .filter-select {
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      transition: border-color 0.3s;
    }

    .filter-input:focus,
    .filter-select:focus {
      outline: none;
      border-color: #3b82f6;
    }

    /* Pets Grid */
    .pets-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .pet-card {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: box-shadow 0.3s;
    }

    .pet-card:hover {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .pet-image {
      position: relative;
    }

    .pet-image img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .urgent-badge {
      position: absolute;
      top: 0.5rem;
      left: 0.5rem;
      background: #ef4444;
      color: white;
      padding: 0.25rem 0.5rem;
      border-radius: 30px;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .pet-info {
      padding: 1rem;
    }

    .pet-header {
      display: flex !important;
      justify-content: space-between !important;
      align-items: flex-start !important;
      margin-bottom: 0.5rem !important;
      width: 100% !important;
    }

    .pet-name {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0;
    }

    .pet-type {
      background: #e5e7eb !important;
      color: #374151 !important;
      padding: 0.25rem 0.5rem !important;
      border-radius: 0.25rem !important;
      font-size: 0.75rem !important;
      font-weight: 500 !important;
      display: inline-block !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
    }

    .pet-details {
      color: #6b7280;
      font-size: 0.875rem;
      margin-bottom: 0.75rem;
    }

    .pet-description {
      color: #4b5563;
      font-size: 0.875rem;
      line-height: 1.5;
      margin-bottom: 1rem;
    }

    .meet-btn {
      background: #1f2937;
      color: white;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s;
      width: 100%;
    }

    .meet-btn:hover {
      background: #374151;
    }

    /* Footer Styles */
    .bg-gray-900 { background-color: #111827; }
    .text-white { color: white; }
    .max-w-6xl { max-width: 72rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
    .px-4 { padding-left: 1rem; padding-right: 1rem; }
    .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
    .grid { display: grid; }
    .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
    .gap-8 { gap: 2rem; }
    .w-8 { width: 2rem; }
    .h-8 { height: 2rem; }
    .bg-blue-600 { background-color: #2563eb; }
    .rounded-lg { border-radius: 0.5rem; }
    .flex { display: flex; }
    .items-center { align-items: center; }
    .justify-center { justify-content: center; }
    .mr-2 { margin-right: 0.5rem; }
    .w-6 { width: 1.5rem; }
    .h-6 { height: 1.5rem; }
    .text-xl { font-size: 1.25rem; }
    .font-bold { font-weight: 700; }
    .mb-4 { margin-bottom: 1rem; }
    .text-gray-400 { color: #9ca3af; }
    .text-lg { font-size: 1.125rem; }
    .font-semibold { font-weight: 600; }
    .space-y-2 > * + * { margin-top: 0.5rem; }
    .hover\:text-white:hover { color: white; }
    .border-t { border-top-width: 1px; }
    .border-gray-800 { border-color: #1f2937; }
    .mt-8 { margin-top: 2rem; }
    .pt-8 { padding-top: 2rem; }
    .text-center { text-align: center; }
    .text-sm { font-size: 0.875rem; }

    @media (min-width: 768px) {
      .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-container">
      <div class="header-content">
        <div class="logo">
          <img src="images/PAWPAL LOGO.png" alt="PawPal">
          <span>PawPal</span>
        </div>
        <nav>
          <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/find-pets" class="active">Find Pets</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Available Pets Section -->
    <section class="pets-section">
      <div class="section-header">
        <h2>Meet Our Available Pets</h2>
        <p>
          Each of these wonderful animals is looking for a loving home. Use the filters below to find pets that
          match what you're looking for.
        </p>
      </div>

      <!-- Filters -->
      <div class="filters">
        <h3>🔍 Find Your Perfect Companion</h3>
        <div class="filter-grid">
          <input type="text" id="search-input" class="filter-input" placeholder="Search by name..." onkeyup="filterPets()">
          <select id="type-filter" class="filter-select" onchange="filterPets()">
            <option value="">All Types</option>
            <option value="dog">Dogs</option>
            <option value="cat">Cats</option>
          </select>
          <select id="age-filter" class="filter-select" onchange="filterPets()">
            <option value="">All Ages</option>
            <option value="puppy">Kitten/Puppy</option>
            <option value="adult">Adult</option>
            <option value="senior">Senior</option>
          </select>
          <select id="location-filter" class="filter-select" onchange="filterPets()">
            <option value="">All Locations</option>
              @php
                // Combine static NCR cities with dynamic extracted cities from shelters
                $ncrCities = collect([
                  'Caloocan', 'Las Piñas', 'Makati', 'Malabon', 'Mandaluyong', 'Manila',
                  'Marikina', 'Muntinlupa', 'Navotas', 'Parañaque', 'Pasay', 'Pasig',
                  'Quezon City', 'San Juan', 'Taguig', 'Valenzuela'
                ]);
                
                $dynamicCities = isset($extractedCities) ? $extractedCities : collect();
                $allLocations = $ncrCities->merge($dynamicCities)->unique()->sort()->values();
              @endphp            @foreach($allLocations as $location)
              <option value="{{ $location }}">{{ $location }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <!-- Pets Grid -->
      <div id="pets-grid" class="pets-grid">
        @forelse($pets as $pet)
          {{-- CRITICAL: Using direct database model data for 1:1 accuracy with admin panel --}}
          <div class="pet-card" data-name="{{ $pet->name }}" data-type="{{ strtolower($pet->type) }}" data-age="{{ $pet->age_filter_category }}" data-location="{{ $pet->location }}">
            <div class="pet-image">
              @if($pet->image_url)
                <img src="{{ $pet->image_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-t-lg" />
              @else
                <div class="w-full h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                  <span class="text-gray-500">No Image</span>
                </div>
              @endif
              @if($pet->is_urgent)
                <div class="urgent-badge">🚨 Urgent: {{ $pet->days_in_shelter }} days</div>
              @endif
            </div>
            <div class="pet-info">
              <div class="pet-header">
                <h4 class="pet-name">{{ $pet->name }}</h4>
                <span class="pet-type">{{ ucfirst($pet->type ?? 'Pet') }}</span>
              </div>
              <p class="pet-details">
                {{-- NEW FORMAT: Breed • Age Range • Size (using age categories: Puppy/Kitten, Adult, Senior) --}}
                @php
                    $details = array_filter([
                        $pet->breed,
                        $pet->age_category,
                        $pet->size ? ucfirst($pet->size) : null
                    ]);
                @endphp
                {{ implode(' • ', $details) }}
              </p>
              @if($pet->location)
                <div class="pet-location" style="font-size: 0.85rem; color: #6b7280; margin-top: 0.5rem;">
                  📍 {{ $pet->location }}
                </div>
              @endif
              @if($pet->description)
                <p class="pet-description">{{ $pet->description }}</p>
              @endif
              <button class="meet-btn" onclick="window.location.href='{{ url('/adopt?pet=' . urlencode($pet->name)) }}'">Meet {{ $pet->name }}</button>
            </div>
          </div>
        @empty
          <div class="no-pets-message" style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #6b7280; font-size: 1.1rem;">No pets available for adoption at this time.</div>
        @endforelse
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-2">
              <img src="images/PAWPAL LOGO.png" alt="PawPal" class="w-6 h-6">
            </div>
            <h3 class="text-xl font-bold">PawPal</h3>
          </div>
          <p class="text-gray-400 mb-4">
            Connecting loving families with pets in need across Metro Manila.
          </p>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
            <li><a href="/find-pets" class="text-gray-400 hover:text-white">Find Pets</a></li>
            <li><a href="/about" class="text-gray-400 hover:text-white">About Us</a></li>
            <li><a href="/contact" class="text-gray-400 hover:text-white">Contact</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Resources</h3>
          <ul class="space-y-2">
            <li><a href="/adoption-process" class="text-gray-400 hover:text-white">Adoption Process</a></li>
            <li><a href="/pet-care-guides" class="text-gray-400 hover:text-white">Pet Care Guides</a></li>
            <li><a href="/success-stories" class="text-gray-400 hover:text-white">Success Stories</a></li>
            <li><a href="/faqs" class="text-gray-400 hover:text-white">FAQs</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
          <ul class="space-y-2">
            <li class="text-gray-400">Metro Manila, Philippines</li>
            <li class="text-gray-400">Phone: (02) 8123-4567</li>
            <li class="text-gray-400">Email: info@pawpal.com</li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
        <p>&copy; © 2024 PawPal. All rights reserved. Made with ❤️ for pets in need.</p>
      </div>
    </div>
  </footer>

  <script>
    /**
     * CRITICAL: Pet filtering script
     * Must work with data attributes set from actual database values
     */
    function filterPets() {
      const searchTerm = document.getElementById('search-input').value.toLowerCase();
      const typeFilter = document.getElementById('type-filter').value;
      const ageFilter = document.getElementById('age-filter').value;
      const locationFilter = document.getElementById('location-filter').value;

      document.querySelectorAll('.pet-card').forEach(card => {
        const name = card.getAttribute('data-name').toLowerCase();
        const type = card.getAttribute('data-type');
        const age = card.getAttribute('data-age');
        const location = card.getAttribute('data-location');
        
        const matchesSearch = name.includes(searchTerm);
        const matchesType = !typeFilter || type === typeFilter;
        const matchesAge = !ageFilter || age === ageFilter;
        // Match if pet's location starts with selected city (e.g., "Taguig" matches "Taguig Shelter")
        const matchesLocation = !locationFilter || (location && location.toLowerCase().startsWith(locationFilter.toLowerCase()));
        
        card.style.display = (matchesSearch && matchesType && matchesAge && matchesLocation) ? '' : 'none';
      });
    }
    
    // Initialize filters on page load
    document.addEventListener('DOMContentLoaded', filterPets);
  </script>

</body>
</html>
