<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CRoboto" rel="stylesheet">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <title>PawPal - Pet Adoption</title>
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

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      padding: 4rem 0.75rem;
    }

    .hero-content h1 {
      font-size: 30px;
      margin-bottom: 1.5rem;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 3rem;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    @media (min-width: 1024px) {
      .hero-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 1.5rem;
      line-height: 1.1;
    }

    .hero-content .subtitle {
      font-size: 2.5rem;
    }

    .hero-content p {
      font-size: 1.125rem;
      color: #4b5563;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .hero-buttons {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: #000;
      color: white;
      padding: 0.875rem 2rem;
      border: none;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s;
    }

    .btn-primary:hover {
      background: #374151;
      color: white;
      text-decoration: none;
    }

    .btn-secondary {
      background: transparent;
      color: #374151;
      padding: 0.875rem 2rem;
      border: 2px solid #374151;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
    }

    .btn-secondary:hover {
      background: #374151;
      color: white;
      text-decoration: none;
    }

    .hero-images {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      align-items: end;
    }

    .hero-images img {
      width: 100%;
      border-radius: 0.5rem;
      object-fit: cover;
    }

    /* Pets Section */
    .pets-section {
      padding: 4rem 0.75rem;
      background-color: #f9fafb;
    }

    .pets-container {
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
      border-radius: 0.25rem;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .pet-info {
      padding: 1rem;
    }

    .pet-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.5rem;
    }

    .pet-name {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0;
    }

    .pet-type {
      background: #e5e7eb;
      color: #374151;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.75rem;
      font-weight: 500;
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
    .bg-blue-600 { background-color: #fe7701; }
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
          <img src="{{ asset('images/PAWPAL LOGO.png') }}" alt="PawPal">
          <span>PawPal</span>
        </div>
        <nav>
          <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="#pets-section">Find Pets</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-grid">
        <div class="hero-content">
          <h1>
            Find Your Perfect <span class="subtitle">Companion</span>
          </h1>
          <p>
            Every pet deserves a loving home. Browse our available pets and find your new best friend today. 
            We connect families across Metro Manila with rescued pets who need a second chance at happiness.
          </p>
          <div class="hero-buttons">
            <a href="#pets-section" class="btn-primary">Find Pets</a>
            <a href="/about" class="btn-secondary">Learn More</a>
          </div>
        </div>
        <div class="hero-images">
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <img src="images/golden-retriever-puppy-happy-face.png" alt="Adoptable pet" style="height: 200px;" onerror="this.src='images/placeholder-pet.jpg'">
            <img src="images/orange-and-white-kitten-playful-expression.png" alt="Adoptable pet" style="height: 150px;" onerror="this.src='images/placeholder-pet.jpg'">
          </div>
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <img src="images/white-and-brown-senior-dog-gentle-expression.png" alt="Adoptable pet" style="height: 130px;" onerror="this.src='images/placeholder-pet.jpg'">
            <img src="images/tabby-cat-with-green-eyes-alert.png" alt="Adoptable pet" style="height: 170px;" onerror="this.src='images/placeholder-pet.jpg'">
          </div>
        </div>
      </div>
    </section>

    <!-- Available Pets Section -->
    <section id="pets-section" class="pets-section">
      <div class="pets-container">
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
              <option value="Caloocan">Caloocan</option>
              <option value="Las Piñas">Las Piñas</option>
              <option value="Makati">Makati</option>
              <option value="Malabon">Malabon</option>
              <option value="Mandaluyong">Mandaluyong</option>
              <option value="Manila">Manila</option>
              <option value="Marikina">Marikina</option>
              <option value="Muntinlupa">Muntinlupa</option>
              <option value="Navotas">Navotas</option>
              <option value="Parañaque">Parañaque</option>
              <option value="Pasay">Pasay</option>
              <option value="Pasig">Pasig</option>
              <option value="Quezon City">Quezon City</option>
              <option value="San Juan">San Juan</option>
              <option value="Taguig">Taguig</option>
              <option value="Valenzuela">Valenzuela</option>
            </select>
          </div>
        </div>

        <!-- Pets Grid -->
        <div id="pets-grid" class="pets-grid"></div>
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
              <img src="{{ asset('images/PAWPAL LOGO.png') }}" alt="PawPal" class="w-6 h-6">
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
            <li><a href="#pets-section" class="text-gray-400 hover:text-white">Find Pets</a></li>
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
    const pets = [
      {
        id: 1,
        name: "Max",
        type: "dog",
        age: "adult",
        size: "large",
        location: "Quezon City",
        description: "Max is a friendly, energetic Golden Retriever looking for an active family. He's been with us for 15 days and loves playing fetch!",
        image: "images/golden-retriever-puppy-happy-face.png",
        urgent: false,
      },
      {
        id: 2,
        name: "Bella",
        type: "dog",
        age: "senior",
        size: "medium",
        location: "Makati",
        description: "Bella, from Makati, has been with us for 28 days. This gentle senior dog has so much love to give and would thrive in a calm home.",
        image: "images/white-and-brown-senior-dog-gentle-expression.png",
        urgent: true,
      },
      {
        id: 3,
        name: "Charlie",
        type: "dog",
        age: "adult",
        size: "medium",
        location: "Manila",
        description: "Charlie is an energetic and friendly dog from Manila. He's been waiting 12 days for his forever home!",
        image: "images/brown-dog-with-blue-collar-smiling.png",
        urgent: false,
      },
      {
        id: 4,
        name: "Rocky",
        type: "dog",
        age: "senior",
        size: "large",
        location: "Pasig",
        description: "Rocky is a wise, gentle senior dog from Pasig who's been with us for 31 days. He enjoys quiet walks and cozy naps.",
        image: "images/senior-dog-with-gray-muzzle-loyal-expression.jpg",
        urgent: true,
      },
      {
        id: 5,
        name: "Luna",
        type: "cat",
        age: "adult",
        size: "small",
        location: "Taguig",
        description: "Luna is a beautiful, independent cat from Taguig. She's been here 18 days and is looking for a quiet home where she can be the queen.",
        image: "images/tabby-cat-with-green-eyes-alert.png",
        urgent: false,
      },
      {
        id: 6,
        name: "Milo",
        type: "cat",
        age: "puppy",
        size: "small",
        location: "Muntinlupa",
        description: "Milo is a playful kitten from Muntinlupa who's been with us 8 days. He's full of energy and ready to bring joy to his new family!",
        image: "images/orange-and-white-kitten-playful-expression.png",
        urgent: false,
      },
      {
        id: 7,
        name: "Shadow",
        type: "cat",
        age: "adult",
        size: "medium",
        location: "Parañaque",
        description: "Shadow is a calm, affectionate cat from Parañaque. After 22 days with us, he's ready to find a loving family.",
        image: "images/black-and-white-cat-sitting-on-wooden-surface.png",
        urgent: false,
      },
      {
        id: 8,
        name: "Oliver",
        type: "cat",
        age: "senior",
        size: "medium",
        location: "San Juan",
        description: "Oliver, from San Juan, has been at the shelter 43 days. Calm and graceful, he's perfect for a quiet, loving home.",
        image: "images/orange-and-white-senior-cat-calm-expression.png",
        urgent: false,
      },
    ];

    function renderPets(petsToRender = pets) {
      const grid = document.getElementById('pets-grid');
      grid.innerHTML = '';
      
      petsToRender.forEach(pet => {
        const petCard = document.createElement('div');
        petCard.className = 'pet-card';
        petCard.innerHTML = `
          <div class="pet-image">
            <img src="${pet.image}" alt="${pet.name}" onerror="this.src='images/placeholder-pet.jpg'">
            ${pet.urgent ? '<div class="urgent-badge">🚨 Urgent: Adopt this week</div>' : ''}
          </div>
          <div class="pet-info">
            <div class="pet-header">
              <h4 class="pet-name">${pet.name}</h4>
              <span class="pet-type">${pet.type.charAt(0).toUpperCase() + pet.type.slice(1)}</span>
            </div>
            <p class="pet-details">
              ${pet.age.charAt(0).toUpperCase() + pet.age.slice(1)} • ${pet.location}
            </p>
            <p class="pet-description">${pet.description}</p>
            <button class="meet-btn" onclick="meetPet(${pet.id}, '${pet.name}')">Meet ${pet.name}</button>
          </div>
        `;
        grid.appendChild(petCard);
      });
    }

    function filterPets() {
      const searchTerm = document.getElementById('search-input').value.toLowerCase();
      const typeFilter = document.getElementById('type-filter').value;
      const ageFilter = document.getElementById('age-filter').value;
      const locationFilter = document.getElementById('location-filter').value;

      const filteredPets = pets.filter(pet => {
        const matchesSearch = pet.name.toLowerCase().includes(searchTerm) || 
                            pet.description.toLowerCase().includes(searchTerm);
        const matchesType = !typeFilter || pet.type === typeFilter;
        const matchesAge = !ageFilter || pet.age === ageFilter;
        const matchesLocation = !locationFilter || pet.location === locationFilter;

        return matchesSearch && matchesType && matchesAge && matchesLocation;
      });

      renderPets(filteredPets);
    }

    function meetPet(petId, petName) {
      alert(`Great choice! You'd like to meet ${petName}. In a real application, this would redirect to the adoption application page for pet ID ${petId}.`);
    }

    // Initialize pets display
    document.addEventListener('DOMContentLoaded', function() {
      renderPets();
    });
  </script>
</body>
</html>
