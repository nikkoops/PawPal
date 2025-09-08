<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="http    }

    .nav-link.active {
      color: #1f2937;
      font-weight: 600;
    }

    .container {s.com/css?family=Montserrat:400,700%7CRoboto" rel="stylesheet">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <title>PawPal - Contact Us</title>
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
      background-color: #f3f4f6;
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

    /* Contact Page Styles */
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 4rem 1rem;
    }

    .text-center {
      text-align: center;
    }

    .page-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 1rem;
      line-height: 1.2;
      font-family: 'Montserrat', sans-serif;
    }

    .page-description {
      font-size: 1rem;
      color: #6b7280;
      max-width: 600px;
      margin: 0 auto 3rem;
      line-height: 1.6;
      font-family: 'Montserrat', sans-serif;
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
      margin-bottom: 4rem;
    }

    @media (min-width: 1024px) {
      .contact-grid {
        grid-template-columns: 1fr 2fr;
      }
    }

    .contact-card {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      padding: 1.5rem;
    }

    .contact-info {
      margin-bottom: 2rem;
    }

    .contact-info-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 1rem;
      line-height: 1.2;
      font-family: 'Montserrat', sans-serif;
    }

    .contact-info-item {
      display: flex;
      align-items: start;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .contact-info-icon {
      width: 1.5rem;
      height: 1.5rem;
      color: #9333ea;
    }

    .contact-info-text {
      flex: 1;
    }

    .contact-info-label {
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.25rem;
      font-size: 0.9375rem;
    }

    .contact-info-value {
      color: #6b7280;
      line-height: 1.6;
      font-size: 0.875rem;
    }

    .contact-form {
      padding: 2rem;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }

    @media (min-width: 640px) {
      .form-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.5rem;
      font-size: 0.9375rem;
    }

    .form-input,
    .form-textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
      border-color: #9333ea;
      outline: none;
    }

    .form-textarea {
      min-height: 150px;
      resize: vertical;
    }

    .submit-btn {
      background: #9333ea;
      color: white;
      padding: 0.75rem 2rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-btn:hover {
      background: #7928ca;
    }

    .emergency-section {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

    .emergency-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 1rem;
    }

    .emergency-text {
      color: #6b7280;
      line-height: 1.6;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="header-container">
      <div class="header-content">
        <a href="{{ url('/') }}" class="logo">
          <img src="{{ asset('images/PAWPAL LOGO.png') }}" alt="PawPal Logo">
          <span class="text-xl font-bold">PawPal</span>
        </a>
        <nav class="nav">
          <a href="{{ url('/') }}" class="nav-link">Home</a>
          <a href="{{ url('/#available-pets') }}" class="nav-link">Find Pets</a>
          <a href="{{ url('/about') }}" class="nav-link">Pet Matching</a>
          <a href="{{ url('/learn-more') }}" class="nav-link">Learn More</a>
          <a href="{{ url('/contact') }}" class="nav-link active">Contact Us</a>
        </nav>
      </div>
    </div>
  </header>

  <div class="gradient-bg">

  <!-- Main Content -->
  <div class="container">
    <div class="text-center">
      <h1 class="page-title">Get in Touch</h1>
      <p class="page-description">
        Have questions about adoption, volunteering, or our services? We'd love to hear from you!
      </p>
    </div>

    <div class="contact-grid">
      <!-- Contact Information -->
      <div class="contact-card">
        <div class="contact-info">
          <h2 class="contact-info-title">Contact Information</h2>
          
          <div class="contact-info-item">
            <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
            <div class="contact-info-text">
              <p class="contact-info-label">Email</p>
              <p class="contact-info-value">hello@pawpal.com</p>
              <p class="contact-info-value">adoptions@pawpal.com</p>
            </div>
          </div>

          <div class="contact-info-item">
            <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            <div class="contact-info-text">
              <p class="contact-info-label">Phone</p>
              <p class="contact-info-value">(555) 123-PAWS</p>
              <p class="contact-info-value">(555) 123-7297</p>
            </div>
          </div>

          <div class="contact-info-item">
            <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <div class="contact-info-text">
              <p class="contact-info-label">Address</p>
              <p class="contact-info-value">123 Pet Rescue Lane</p>
              <p class="contact-info-value">Animal City, AC 12345</p>
            </div>
          </div>

          <div class="contact-info-item">
            <svg class="contact-info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
            <div class="contact-info-text">
              <p class="contact-info-label">Hours</p>
              <p class="contact-info-value">Mon-Fri: 9AM - 6PM</p>
              <p class="contact-info-value">Sat-Sun: 10AM - 4PM</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="contact-card">
        <form class="contact-form" id="contactForm" action="{{ url('/contact/submit') }}" method="POST">
          @csrf
          <h2 class="contact-info-title">Send us a Message</h2>
          @if(session('success'))
          <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
              {{ session('success') }}
          </div>
          @endif
          
          <div class="form-grid">
            <div class="form-group">
              <label class="form-label" for="name">Full Name *</label>
              <input type="text" id="name" name="name" class="form-input" required placeholder="Your full name">
            </div>

            <div class="form-group">
              <label class="form-label" for="email">Email Address *</label>
              <input type="email" id="email" name="email" class="form-input" required placeholder="your.email@example.com">
            </div>

            <div class="form-group">
              <label class="form-label" for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" class="form-input" placeholder="(555) 123-4567">
            </div>

            <div class="form-group">
              <label class="form-label" for="subject">Subject *</label>
              <input type="text" id="subject" name="subject" class="form-input" required placeholder="What's this about?">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="message">Message *</label>
            <textarea id="message" name="message" class="form-textarea" required placeholder="Tell us how we can help you..."></textarea>
          </div>

          <button type="submit" class="submit-btn">Send Message</button>
        </form>
      </div>
    </div>

    <!-- Emergency Section -->
    <div class="emergency-section">
      <h3 class="emergency-title">Emergency Pet Situations</h3>
      <p class="emergency-text">
        If you've found a lost pet or have an emergency situation involving an animal in need, please call our
        emergency hotline immediately at <strong>(555) 911-PETS</strong>.
      </p>
      <p class="emergency-text">
        For non-emergency inquiries about adoptions, volunteering, donations, or general questions, please use
        the contact form above or our regular phone number during business hours.
      </p>
    </div>
  </div>

  <script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form data
      const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
      };

      // Log form data (replace with your actual form submission logic)
      console.log('Form submitted:', formData);
      
      // Show success message
      alert('Thank you for your message! We\'ll get back to you soon.');
      
      // Reset form
      this.reset();
    });
  </script>
</body>
</html>
