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

    .sign-in-btn {
      background: #000;
      color: white;
      padding: 0.5rem 1.5rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s;
      cursor: pointer;
      font-size: 0.875rem;
    }

    .sign-in-btn:hover {
      background: #374151;
      color: white;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .nav-links {
        display: none;
      }
    }

    /* Modal Styles */
    .modal-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      z-index: 9999;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.3s ease;
    }

    .modal-overlay.active {
      display: flex;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    @keyframes slideUp {
      from {
        transform: translateY(20px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal-content {
      background: white;
      border-radius: 1rem;
      max-width: 600px;
      width: 90%;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      animation: slideUp 0.3s ease;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .modal-header {
      padding: 2rem 2rem 1rem;
      border-bottom: 1px solid #e5e7eb;
      position: relative;
    }

    .modal-header h2 {
      font-size: 1.875rem;
      font-weight: bold;
      color: #1f2937;
      margin: 0;
    }

    .modal-header p {
      font-size: 1rem;
      color: #6b7280;
      margin-top: 0.5rem;
    }

    .modal-close {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      background: transparent;
      border: none;
      font-size: 1.5rem;
      color: #9ca3af;
      cursor: pointer;
      width: 2rem;
      height: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 0.375rem;
      transition: all 0.2s;
    }

    .modal-close:hover {
      background: #f3f4f6;
      color: #1f2937;
    }

    .modal-body {
      padding: 2rem;
    }

    .role-cards {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    @media (max-width: 640px) {
      .role-cards {
        grid-template-columns: 1fr;
      }
    }

    .role-card {
      border: 2px solid #e5e7eb;
      border-radius: 0.75rem;
      padding: 2rem;
      cursor: pointer;
      transition: all 0.3s;
      text-align: center;
      background: white;
    }

    .role-card:hover {
      border-color: #3b82f6;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      transform: translateY(-2px);
    }

    .role-card.selected {
      border-color: #3b82f6;
      background: #eff6ff;
    }

    .role-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      display: block;
    }

    .role-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .role-description {
      font-size: 0.875rem;
      color: #6b7280;
      line-height: 1.5;
    }

    .modal-footer {
      padding: 1.5rem 2rem;
      border-top: 1px solid #e5e7eb;
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
    }

    .btn-modal {
      padding: 0.625rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 0.875rem;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
    }

    .btn-cancel {
      background: white;
      color: #374151;
      border: 1px solid #d1d5db;
    }

    .btn-cancel:hover {
      background: #f9fafb;
    }

    .btn-continue {
      background: #000;
      color: white;
    }

    .btn-continue:hover {
      background: #374151;
    }

    .btn-continue:disabled {
      background: #d1d5db;
      cursor: not-allowed;
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
    .bg-blue-600 { background-color: #9333ea; }
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
        <nav style="display: flex; align-items: center; gap: 2rem;">
          <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="#pets-section">Find Pets</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
          <button class="sign-in-btn" onclick="openRoleModal()">Sign In</button>
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
        description: "Max is a friendly, energetic Golden Retriever looking for an active family. He loves playing fetch and going on long walks!",
        image: "images/golden-retriever-puppy-happy-face.png",
        urgent: false,
      },
      {
        id: 2,
        name: "Luna",
        type: "cat",
        age: "adult",
        size: "small",
        location: "Makati",
        description: "Luna is a gentle, affectionate Persian cat. She loves cozy naps and quiet cuddles with her favorite humans.",
        image: "images/tabby-cat-lying-down-curious-expression.png",
        urgent: false,
      },
      {
        id: 3,
        name: "Charlie",
        type: "dog",
        age: "puppy",
        size: "medium",
        location: "Manila",
        description: "Charlie is an energetic Labrador puppy. He's looking for a family to teach him and play with him!",
        image: "images/brown-dog-with-blue-collar-smiling.png",
        urgent: false,
      },
      {
        id: 4,
        name: "Bella",
        type: "cat",
        age: "kitten",
        size: "small",
        location: "Pasig",
        description: "Bella is a playful orange kitten. She's looking for a family to grow up with and lots of toys to play with!",
        image: "images/orange-tabby-kitten-cute-expression.png",
        urgent: false,
      },
      {
        id: 5,
        name: "Rocky",
        type: "dog",
        age: "senior",
        size: "large",
        location: "Taguig",
        description: "Rocky is a gentle senior dog. He enjoys quiet walks and relaxing with his family.",
        image: "images/senior-dog-with-gray-muzzle-loyal-expression.jpg",
        urgent: false,
      },
      {
        id: 6,
        name: "Mimi",
        type: "cat",
        age: "adult",
        size: "small",
        location: "Quezon City",
        description: "Mimi is an independent yet affectionate cat. She's perfect for any loving home.",
        image: "images/black-and-white-cat-sitting-on-wooden-surface.png",
        urgent: false,
      },
      {
        id: 7,
        name: "Buddy",
        type: "dog",
        age: "adult",
        size: "medium",
        location: "Mandaluyong",
        description: "Buddy is a loyal and friendly companion. He's ready to be your best friend!",
        image: "images/senior-dog-with-gentle-eyes-resting.png",
        urgent: false,
      },
      {
        id: 8,
        name: "Whiskers",
        type: "cat",
        age: "adult",
        size: "small",
        location: "Pasay",
        description: "Whiskers is a curious and alert cat. He's looking for a family to explore with!",
        image: "images/tabby-cat-with-green-eyes-alert.png",
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
      customAlert(`Great choice! You'd like to meet ${petName}. In a real application, this would redirect to the adoption application page for pet ID ${petId}.`, 'success');
    }

    // Initialize pets display
    document.addEventListener('DOMContentLoaded', function() {
      renderPets();
    });

    // Role Selection Modal Logic
    let selectedRole = null;

    function openRoleModal() {
      document.getElementById('roleModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeRoleModal() {
      document.getElementById('roleModal').classList.remove('active');
      document.body.style.overflow = 'auto';
      selectedRole = null;
      // Reset selected state
      document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
      });
    }

    function selectRole(role) {
      selectedRole = role;
      // Remove selected class from all cards
      document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
      });
      // Add selected class to clicked card
      event.currentTarget.classList.add('selected');
      // Enable continue button
      document.getElementById('continueBtn').disabled = false;
    }

    function continueToLogin() {
      if (selectedRole) {
        // Redirect to login page with role parameter
        window.location.href = `/admin/login?role=${selectedRole}`;
      }
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('roleModal').addEventListener('click', function(e) {
        if (e.target === this) {
          closeRoleModal();
        }
      });
    });
  </script>

  <!-- Role Selection Modal -->
  <div id="roleModal" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Welcome to PawPal</h2>
        <p>Please select your role to continue</p>
        <button class="modal-close" onclick="closeRoleModal()">&times;</button>
      </div>
      <div class="modal-body">
        <div class="role-cards">
          <div class="role-card" onclick="selectRole('system_admin')">
            <span class="role-icon">🔧</span>
            <div class="role-title">System Admin</div>
            <div class="role-description">
              Full system access with permissions to manage all shelters, users, and system settings
            </div>
          </div>
          <div class="role-card" onclick="selectRole('shelter_admin')">
            <span class="role-icon">🏠</span>
            <div class="role-title">Shelter Admin</div>
            <div class="role-description">
              Manage your shelter's pets, applications, and adoption processes
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn-modal btn-cancel" onclick="closeRoleModal()">Cancel</button>
        <button id="continueBtn" class="btn-modal btn-continue" onclick="continueToLogin()" disabled>Continue</button>
      </div>
    </div>
  </div>

  <!-- Custom Modal Component -->
  @include('components.custom-modal')
</body>
</html>
