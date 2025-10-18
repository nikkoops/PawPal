<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <!-- Include Inter font for consistency -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <title>PawPal - Contact Us</title>
  <!-- Include Tailwind CSS for header component -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Include Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="styles/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif;
      background-color: #f3f4f6;
      font-size: 15px;
    }

    /* Main Content Styles */
    .gradient-bg {
      background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
      min-height: 100vh;
    }

    /* Contact Page Styles */
    .container {
      max-width: min(100% - 2rem, 1200px);
      margin: 0 auto;
      padding: 3rem 1rem;
    }

    .text-center {
      text-align: center;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.75rem;
      line-height: 1.2;
      font-family: 'Montserrat', sans-serif;
    }

    .page-description {
      font-size: 0.9375rem;
      color: #6b7280;
      max-width: 600px;
      margin: 0 auto 2.5rem;
      line-height: 1.6;
      font-family: 'Montserrat', sans-serif;
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      margin-bottom: 3rem;
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
      padding: 1.25rem;
    }

    .contact-info {
      margin-bottom: 1.5rem;
    }

    .contact-info-title {
      font-size: 1.125rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.75rem;
      line-height: 1.2;
      font-family: 'Montserrat', sans-serif;
    }

    .contact-info-item {
      display: flex;
      align-items: start;
      gap: 0.75rem;
      margin-bottom: 1.25rem;
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
      padding: 1.5rem;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.25rem;
    }

    @media (min-width: 640px) {
      .form-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .form-group {
      margin-bottom: 1.25rem;
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
      padding: 0.625rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 0.9375rem;
      transition: border-color 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
      border-color: #9333ea;
      outline: none;
    }

    .form-textarea {
      min-height: 130px;
      resize: vertical;
    }

    .submit-btn {
      background: #9333ea;
      color: white;
      padding: 0.625rem 1.5rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 600;
      font-size: 0.9375rem;
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
      padding: 1.5rem;
      max-width: 700px;
      margin: 0 auto;
      text-align: center;
    }

    .emergency-title {
      font-size: 1.25rem;
      font-weight: bold;
      color: #1f2937;
      margin-bottom: 0.75rem;
    }

    .emergency-text {
      color: #6b7280;
      line-height: 1.6;
      font-size: 0.9375rem;
    }
  </style>
</head>

<body>
  <!-- Header -->
  @include('components.header')

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

  <!-- Footer -->
  @include('components.footer')

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
      customAlert('Thank you for your message! We\'ll get back to you soon.', 'success');
      
      // Reset form
      this.reset();
    });

    // Initialize Lucide icons
    lucide.createIcons();
  </script>

  <!-- Role Selection Modal -->
  <div id="roleModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center">
    <div class="bg-white rounded-2xl max-w-2xl w-[90%] max-h-[90vh] overflow-y-auto shadow-2xl">
      <!-- Modal Header -->
      <div class="p-8 pb-6 border-b relative">
        <h2 class="text-3xl font-bold text-gray-900">Welcome to PawPal</h2>
        <p class="text-gray-600 mt-2">Please select your role to continue</p>
        <button onclick="closeRoleModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg w-8 h-8 flex items-center justify-center transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      
      <!-- Modal Body -->
      <div class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- System Admin Card -->
          <div onclick="selectRole('system_admin')" class="role-card cursor-pointer border-2 border-gray-200 rounded-xl p-8 text-center transition-all hover:border-blue-500 hover:shadow-lg hover:-translate-y-1">
            <div class="text-6xl mb-4">🔧</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">System Admin</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Full system access with permissions to manage all shelters, users, and system settings
            </p>
          </div>
          
          <!-- Shelter Admin Card -->
          <div onclick="selectRole('shelter_admin')" class="role-card cursor-pointer border-2 border-gray-200 rounded-xl p-8 text-center transition-all hover:border-blue-500 hover:shadow-lg hover:-translate-y-1">
            <div class="text-6xl mb-4">🏠</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Shelter Admin</h3>
            <p class="text-sm text-gray-600 leading-relaxed">
              Manage your shelter's pets, applications, and adoption processes
            </p>
          </div>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="px-8 pb-8 pt-6 border-t flex justify-end gap-4">
        <button onclick="closeRoleModal()" class="px-6 py-2.5 rounded-lg font-semibold text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
          Cancel
        </button>
        <button id="continueBtn" onclick="continueToLogin()" disabled class="px-6 py-2.5 rounded-lg font-semibold text-white bg-purple-600 hover:bg-purple-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors">
          Continue
        </button>
      </div>
    </div>
  </div>

  <style>
    .role-card.selected {
      border-color: #3b82f6 !important;
      background-color: #eff6ff;
    }
  </style>

  <script>
    let selectedRole = null;

    function openRoleModal() {
      const modal = document.getElementById('roleModal');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }

    function closeRoleModal() {
      const modal = document.getElementById('roleModal');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = 'auto';
      selectedRole = null;
      
      // Reset selected state
      document.querySelectorAll('.role-card').forEach(card => {
        card.classList.remove('selected');
      });
      document.getElementById('continueBtn').disabled = true;
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
        window.location.href = `/admin/login?role=${selectedRole}`;
      }
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('roleModal');
      if (modal) {
        modal.addEventListener('click', function(e) {
          if (e.target === this) {
            closeRoleModal();
          }
        });
      }
    });
  </script>

  <!-- Custom Modal Component -->
  @include('components.custom-modal')
</body>
</html>
