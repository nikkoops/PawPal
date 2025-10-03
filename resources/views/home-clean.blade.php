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
            <li><a href="/find-pets">Find Pets</a></li>
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
            <a href="/find-pets" class="btn-primary">Find Pets</a>
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
</body>
</html>
