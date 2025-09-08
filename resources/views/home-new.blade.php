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
      font-size: 1.125rem;
      font-weight: bold;
      color: #1f2937;
      text-decoration: none;
    }

    .logo img {
      height: 1.75rem;
      width: auto;
    }

    .nav {
      display: none;
    }

    @media (min-width: 768px) {
      .nav {
        display: flex;
        gap: 1.5rem;
      }
    }

    .nav-link {
      color: #4b5563;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: color 0.3s;
    }

    .nav-link:hover {
      color: #1f2937;
      text-decoration: none;
    }

    .nav-link.active {
      color: #1f2937;
      font-weight: 600;
    }

    /* Main Content Styles */
    .gradient-bg {
      background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
      min-height: 100vh;
    }

    .hero-section {
      padding: 4rem 1rem;
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
      font-size: 1rem;
    }

    .btn-primary:hover {
      background: #374151;
      color: white;
      text-decoration: none;
    }

    .btn-outline {
      background: transparent;
      color: #000;
      padding: 0.875rem 2rem;
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
      font-size: 1rem;
    }

    .btn-outline:hover {
      background: #f9fafb;
      color: #000;
      text-decoration: none;
    }

    .hero-images {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .hero-images img {
      width: 100%;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      object-fit: cover;
    }

    .pets-section {
      background: white;
      padding: 4rem 1rem;
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
      color: #6b7280;
      max-width: 600px;
      margin: 0 auto;
    }

    .filters {
      margin-bottom: 3rem;
    }

    .filters h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 1.5rem;
    }

    .filter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .filter-input, .filter-select {
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 1rem;
      width: 100%;
    }

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
      font-size: 1.25rem;
      font-weight: bold;
      color: #1f2937;
      margin: 0;
    }

    .pet-type {
      font-size: 0.875rem;
      color: #6b7280;
    }

    .pet-details {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.75rem;
    }

    .pet-description {
      font-size: 0.875rem;
      color: #4b5563;
      margin-bottom: 1rem;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .meet-btn {
      width: 100%;
      background: #000;
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s;
    }

    .meet-btn:hover {
      background: #374151;
    }

    .smooth-scroll {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-container">
      <div class="header-content">
        <a href="index.php" class="logo">
          <img src="images/PAWPAL LOGO.png" alt="PawPal Logo">
          PawPal
        </a>
        <nav class="nav">
          <a href="index.php" class="nav-link active">Home</a>
          <a href="shop.php" class="nav-link">Find Pets</a>
          <a href="about.php" class="nav-link">Pet Matching</a>
          <a href="about.php" class="nav-link">Learn More</a>
          <a href="contact.php" class="nav-link">Contact Us</a>
        </nav>
      </div>
    </div>
  </header>

  <div class="gradient-bg">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-grid">
        <div class="hero-content">
          <h1>
            Give a Life a Second Chance<br>
            <span class="subtitle">– Adopt Today</span>
          </h1>
          <p>
            Thousands of pets face euthanasia each year due to overcrowded shelters and lack of adopters. By
            adopting, you can save a life, reduce shelter overcrowding, and bring love into your home. Browse pets
            at risk, fill out an adoption application, and make a lasting difference today.
          </p>
          <div class="hero-buttons">
            <a href="#pets-section" class="btn-primary" onclick="smoothScroll(event, '#pets-section')">Start Adopting Today</a>
            <a href="about.php" class="btn-outline">Learn More</a>
          </div>
        </div>

        <!-- Hero Images Grid -->
        <div class="hero-images">
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <img src="images/hero-pet-1.jpg" alt="Adoptable pet" style="height: 200px;" onerror="this.src='images/placeholder-pet.jpg'">
            <img src="images/hero-pet-3.jpg" alt="Adoptable pet" style="height: 150px;" onerror="this.src='images/placeholder-pet.jpg'">
          </div>
          <div style="display: flex; flex-direction: column; gap: 1rem; padding-top: 2rem;">
            <img src="images/hero-pet-2.jpg" alt="Adoptable pet" style="height: 130px;" onerror="this.src='images/placeholder-pet.jpg'">
            <img src="images/hero-pet-4.jpg" alt="Adoptable pet" style="height: 170px;" onerror="this.src='images/placeholder-pet.jpg'">
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

        <!-- Pet Cards Grid -->
        <div id="pets-grid" class="pets-grid">
          <!-- Pet cards will be generated here -->
        </div>
      </div>
    </section>
  </div>

  <script>
    // Sample pet data
    const pets = [
      {
        id: 1,
        name: "Max",
        type: "dog",
        age: "adult",
        size: "large",
        location: "Quezon City",
        description: "Max was rescued in Quezon City and has been in the shelter for 34 days. Energetic and playful, he'll make a great companion for an active family.",
        image: "images/pet-1.jpg",
        urgent: false,
      },
      {
        id: 2,
        name: "Bella",
        type: "dog",
        age: "senior",
        size: "large",
        location: "Makati",
        description: "Bella, rescued in Makati, has spent 60 days in the shelter. A gentle giant, she loves quiet walks and cuddles.",
        image: "images/pet-2.jpg",
        urgent: true,
      },
      {
        id: 3,
        name: "Duke",
        type: "dog",
        age: "adult",
        size: "large",
        location: "Makati",
        description: "Duke was found in Makati and has been here 30 days. This happy pup's goofy energy will bring joy to any home.",
        image: "images/pet-3.jpg",
        urgent: false,
      },
      {
        id: 4,
        name: "Rocky",
        type: "dog",
        age: "senior",
        size: "large",
        location: "Manila",
        description: "Rocky, rescued from Manila, has stayed 42 days in the shelter. Loyal and affectionate, perfect for a calm household.",
        image: "images/pet-4.jpg",
        urgent: false,
      },
      {
        id: 5,
        name: "Cleo",
        type: "cat",
        age: "adult",
        size: "small",
        location: "Pasig",
        description: "Cleo was rescued in Pasig and has been here 25 days. Independent yet loving, she enjoys sunny windowsills.",
        image: "images/pet-5.jpg",
        urgent: false,
      },
      {
        id: 6,
        name: "Whiskers",
        type: "cat",
        age: "puppy",
        size: "small",
        location: "Marikina",
        description: "Whiskers, from Marikina, has been in the shelter 10 days. Playful and sweet, she's eager to find her forever home.",
        image: "images/pet-6.jpg",
        urgent: false,
      },
      {
        id: 7,
        name: "Milo",
        type: "cat",
        age: "adult",
        size: "medium",
        location: "Taguig",
        description: "Milo, rescued in Taguig, has been here 39 days. Mischievous and curious, he loves exploring and playing with toys.",
        image: "images/pet-7.jpg",
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
        image: "images/pet-8.jpg",
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

    function meetPet(id, name) {
      // Redirect to pet details page
      window.location.href = `pet-details.php?id=${id}`;
    }

    function smoothScroll(event, target) {
      event.preventDefault();
      document.querySelector(target).scrollIntoView({
        behavior: 'smooth'
      });
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      renderPets();
    });
  </script>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <div class="flex items-center mb-4">
            <img src="images/PAWPAL LOGO.png" alt="PawPal Logo" class="h-8 w-auto mr-2">
            <span class="text-xl font-bold">PawPal</span>
          </div>
          <p class="text-gray-400 text-sm">
            Connecting loving families with pets in need of homes.
          </p>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
            <li><a href="/find-pets" class="text-gray-400 hover:text-white">Find Pets</a></li>
            <li><a href="/pet-matching" class="text-gray-400 hover:text-white">Pet Matching</a></li>
            <li><a href="/learn-more" class="text-gray-400 hover:text-white">Learn More</a></li>
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

</body>
</html>
