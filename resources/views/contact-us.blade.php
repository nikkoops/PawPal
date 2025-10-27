<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contact Us - PawPal</title>
      <!-- Include Inter font for consistency -->
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
      <!-- Include Montserrat font for headings -->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
      <!-- Include Tailwind CSS -->
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- Include Lucide Icons -->
      <script src="https://unpkg.com/lucide@latest"></script>
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
      <!-- Add custom styles -->
      <style>
          /* CSS Variables for warm pet adoption design - matching Learn More page */
          :root {
              --background: oklch(1 0 0);
              --foreground: oklch(0.35 0 0);
              --card: oklch(0.99 0.02 85);
              --card-foreground: oklch(0.35 0 0);
              --container-width: min(100% - 2rem, 1200px);
              --header-height: 3rem;
              --spacing-xs: 0.25rem;
              --spacing-sm: 0.5rem;
              --spacing-md: 1rem;
              --spacing-lg: 2rem;
              --spacing-xl: 4rem;
          }

          body {
              font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif;
              font-size: 15px;
              line-height: 1.6;
          }

          /* Force header consistency overrides */
          nav.nav-header * {
              font-size: 1rem !important;
              font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
          }

          /* Main Content Styles */
          .gradient-bg {
              background: linear-gradient(to bottom, #ffecdd, #ffe8d6);
              min-height: 100vh;
          }

          /* Hero Section - matching Learn More page scale */
          .hero-section {
              padding: 4rem 1rem;
              background: #ffecdd;
          }

          .hero-content {
              max-width: 1200px;
              margin: 0 auto;
              text-align: center;
          }

          .hero-content h1 {
              font-size: 3rem;
              font-weight: bold;
              color: #111827;
              margin-bottom: 1.5rem;
              line-height: 1.1;
              font-family: 'Montserrat', sans-serif;
          }

          .hero-content p {
              font-size: 0.875rem;
              color: #374151;
              margin-bottom: 2rem;
              line-height: 1.6;
              max-width: 700px;
              margin-left: auto;
              margin-right: auto;
          }

          /* Button styles matching Learn More page */
          .btn-primary {
              background: #fe7701;
              color: white;
              padding: 0.625rem 1.5rem;
              border: none;
              border-radius: 0.5rem;
              font-weight: 600;
              text-decoration: none;
              display: inline-flex;
              align-items: center;
              transition: background-color 0.2s;
          }

          .btn-primary:hover {
              background: #c1431d;
          }

          /* Section styles */
          .section {
              padding: var(--spacing-xl) var(--spacing-md);
              max-width: var(--container-width);
              margin: 0 auto;
          }

          .section-header {
              text-align: center;
              margin-bottom: 2.5rem;
          }

          .section-header h2 {
              font-size: 2rem;
              font-weight: bold;
              color: #111827;
              margin-bottom: 0.75rem;
              font-family: 'Montserrat', sans-serif;
          }

          .section-header p {
              font-size: 0.875rem;
              color: #6b7280;
              max-width: 600px;
              margin: 0 auto;
          }

          /* Grid layouts */
          .card-grid {
              display: grid;
              grid-template-columns: repeat(4, 1fr);
              gap: 1.5rem;
              margin-top: 3rem;
          }

          .card {
              background: white;
              border-radius: 0.875rem;
              padding: 1.5rem;
              text-align: left;
              border: 1px solid #e5e7eb;
              transition: transform 0.2s, box-shadow 0.2s;
          }

          .card:hover {
              transform: translateY(-2px);
              box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
          }

          .card h3 {
              font-size: 1rem;
              font-weight: 600;
              color: #111827;
              margin: 0.75rem 0;
          }

          .card p {
              color: #6b7280;
              line-height: 1.6;
              font-size: 0.875rem;
              margin-bottom: 0.5rem;
          }

          /* Contact specific styles */
          .contact-item {
              display: flex;
              align-items: flex-start;
              gap: 0.875rem;
          }

          .contact-icon {
              width: 3rem;
              height: 3rem;
              color: #fe7701;
              margin: 0 auto;
              display: block;
              margin-bottom: 1rem;
          }

          /* Donation section styles */
          .donation-methods {
              display: grid;
              grid-template-columns: repeat(4, 1fr);
              gap: 1.5rem;
              margin-top: 3rem;
          }

          .donation-detail {
              margin-bottom: 0.75rem;
          }

          .donation-detail-label {
              font-weight: 600;
              color: #374151;
              font-size: 0.875rem;
              margin-bottom: 0.25rem;
              display: block;
          }

          .donation-detail-value {
              color: #6b7280;
              font-size: 0.875rem;
              font-family: 'SF Mono', 'Monaco', 'Consolas', monospace;
              background: #f8fafc;
              padding: 0.5rem 0.75rem;
              border-radius: 0.5rem;
              border: 1px solid #e2e8f0;
              display: block;
              word-break: break-all;
          }

          /* Emergency section */
          .emergency-card {
              background: #fef2f2;
              border: 2px solid #fca5a5;
              border-radius: 0.875rem;
              padding: 1.5rem;
              text-align: center;
              margin-top: 0;
          }

          .emergency-card h3 {
              color: #dc2626;
              font-size: 1rem;
              font-weight: 600;
              margin-bottom: 0.75rem;
              display: flex;
              align-items: center;
              justify-content: center;
              gap: 0.5rem;
          }

          .emergency-card p {
              color: #7f1d1d;
              margin-bottom: 0.5rem;
              font-weight: 500;
          }

          /* Tax note */
          .tax-note {
              background: #f0f9ff;
              border: 2px solid #7dd3fc;
              border-radius: 0.875rem;
              padding: 1.5rem;
              margin-top: 2rem;
              text-align: center;
          }

          .tax-note h5 {
              color: #0369a1;
              font-weight: 600;
              margin-bottom: 0.5rem;
              font-size: 1rem;
          }

          .tax-note p {
              color: #0284c7;
              font-size: 0.875rem;
              margin: 0;
              font-weight: 500;
          }

          /* Responsive design */
          @media (max-width: 1024px) {
              .card-grid, .donation-methods {
                  grid-template-columns: repeat(2, 1fr);
                  gap: 1rem;
              }
          }

          @media (max-width: 768px) {
              .hero-content h1 {
                  font-size: 2rem;
              }
              
              .hero-section {
                  padding: 3rem 1rem;
              }
              
              .section-header h2 {
                  font-size: 2rem;
              }
              
              .card-grid, .donation-methods {
                  grid-template-columns: 1fr;
                  gap: 1rem;
              }
          }

          .text-balance {
              text-wrap: balance;
          }
          .text-pretty {
              text-wrap: pretty;
          }
      </style>
  </head>

  <body>
      <!-- Header -->
      @include('components.header')

      <div class="gradient-bg">
          <!-- Hero Section -->
          <section class="hero-section">
              <div class="hero-content">
                  <h1 class="text-balance">Contact Us</h1>
                  <p class="text-pretty">
                      Have questions about pet adoption, volunteering, or our services? We're here to help you<br>
                      connect with your perfect companion and support our mission of<br>
                      rescuing animals across the Philippines.
                  </p>
              </div>
          </section>

          <!-- Contact Information Section -->
          <section style="background: white;">
              <div class="section">
                  <div class="section-header">
                      <h2>Get in Touch</h2>
                      <p>
                          Connect with us through any channel. We're here to help animals find loving homes across the Philippines.
                      </p>
                  </div>

                  <div class="card-grid">
                      <!-- Email Card -->
                      <div class="card">
                          <div style="margin-bottom: 1rem;">
                              <i data-lucide="mail" class="contact-icon"></i>
                          </div>
                          <h3>Email</h3>
                          <p>hello@pawpal.com.ph</p>
                          <p>adoptions@pawpal.com.ph</p>
                          <p>volunteers@pawpal.com.ph</p>
                      </div>

                      <!-- Phone Card -->
                      <div class="card">
                          <div style="margin-bottom: 1rem;">
                              <i data-lucide="phone" class="contact-icon"></i>
                          </div>
                          <h3>Phone</h3>
                          <p>+63 2 8123-PAWS (7297)</p>
                          <p>+63 917 555-7297</p>
                          <p>+63 908 123-PETS (7387)</p>
                      </div>

                      <!-- Address Card -->
                      <div class="card">
                          <div style="margin-bottom: 1rem;">
                              <i data-lucide="map-pin" class="contact-icon"></i>
                          </div>
                          <h3>Office Address</h3>
                          <p>123 Katipunan Avenue</p>
                          <p>Quezon City, Metro Manila</p>
                          <p>1108 Philippines</p>
                      </div>

                      <!-- Hours Card -->
                      <div class="card">
                          <div style="margin-bottom: 1rem;">
                              <i data-lucide="clock" class="contact-icon"></i>
                          </div>
                          <h3>Business Hours</h3>
                          <p>Monday - Friday: 8AM - 6PM</p>
                          <p>Saturday - Sunday: 9AM - 5PM</p>
                          <p>Public Holidays: 10AM - 3PM</p>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Donation Section -->
          <section style="background: #ffecdd;">
              <div class="section">
                  <div class="section-header">
                      <h2>Support Our Mission</h2>
                      <p>
                          Every peso helps provide food, medical care, and shelter for rescued animals across the Philippines.
                      </p>
                  </div>

                  <div class="donation-methods">
                      <!-- Bank Transfer -->
                      <div class="card">
                          <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                              <i data-lucide="building-2" style="height: 1.25rem; width: 1.25rem; color: #fe7701; margin-right: 0.5rem;"></i>
                              <h3 style="margin: 0;">Bank Transfer</h3>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Bank:</div>
                              <div class="donation-detail-value">Bank of the Philippine Islands (BPI)</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Account Name:</div>
                              <div class="donation-detail-value">PawPal Animal Rescue<br>Foundation Inc.</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Account Number:</div>
                              <div class="donation-detail-value">0011-1921-65</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Branch:</div>
                              <div class="donation-detail-value">Katipunan Avenue,<br>Quezon City</div>
                          </div>
                      </div>

                      <!-- E-Wallet -->
                      <div class="card">
                          <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                              <i data-lucide="smartphone" style="height: 1.25rem; width: 1.25rem; color: #3b82f6; margin-right: 0.5rem;"></i>
                              <h3 style="margin: 0;">E-Wallet</h3>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">GCash:</div>
                              <div class="donation-detail-value">+63 917 555-7297</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Maya (PayMaya):</div>
                              <div class="donation-detail-value">+63 908 123-7387</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Account Name:</div>
                              <div class="donation-detail-value">PawPal Animal Rescue</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Reference:</div>
                              <div class="donation-detail-value">Include "DONATION"<br>in message</div>
                          </div>
                      </div>

                      <!-- Online Payment -->
                      <div class="card">
                          <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                              <i data-lucide="credit-card" style="height: 1.25rem; width: 1.25rem; color: #ef4444; margin-right: 0.5rem;"></i>
                              <h3 style="margin: 0;">Online Payment</h3>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">PayPal:</div>
                              <div class="donation-detail-value">donate@pawpal.com.ph</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Dragonpay:</div>
                              <div class="donation-detail-value">Available for all major<br>PH banks</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Paymongo:</div>
                              <div class="donation-detail-value">Secure credit/debit card<br>payments</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Instapay/PESONet:</div>
                              <div class="donation-detail-value">Real-time bank<br>transfers</div>
                          </div>
                      </div>

                      <!-- Alternative Donation -->
                      <div class="card">
                          <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                              <i data-lucide="heart-handshake" style="height: 1.25rem; width: 1.25rem; color: #f59e0b; margin-right: 0.5rem;"></i>
                              <h3 style="margin: 0;">Other Ways to Help</h3>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Physical Donations:</div>
                              <div class="donation-detail-value">Pet food, toys,<br>blankets</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Volunteer Work:</div>
                              <div class="donation-detail-value">Dog walking, feeding,<br>cleaning</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Foster Care:</div>
                              <div class="donation-detail-value">Temporary homes for<br>recovery</div>
                          </div>
                          <div class="donation-detail">
                              <div class="donation-detail-label">Adoption Drives:</div>
                              <div class="donation-detail-value">Help organize<br>events</div>
                          </div>
                      </div>
                  </div>

                  <!-- Call to Action -->
                  <div style="text-align: center; margin-top: 2rem;">
                      <a href="mailto:donations@pawpal.com.ph?subject=Donation Inquiry" class="btn-primary">
                          <i data-lucide="heart" style="width: 1rem; height: 1rem; margin-right: 0.5rem;"></i>
                          Start Your Donation Today
                      </a>
                  </div>
              </div>
          </section>


          <!-- Enhanced For Animal Shelters & Rescue Organizations (Orange Theme) -->
          <section style="background: linear-gradient(135deg, #fff8ed 70%, #ffe8d6 100%);">
              <div class="section">
                  <div class="text-center mb-10">
                      <span class="inline-block bg-orange-100 text-orange-700 font-semibold rounded-full px-4 py-2 text-sm mb-4">Partner With Us</span>
                      <h2 class="text-3xl md:text-4xl font-extrabold text-orange-600 mb-2">For Animal Shelters & Rescue Organizations</h2>
                      <p class="text-lg text-orange-900 max-w-2xl mx-auto">Join our network of shelters and rescue organizations dedicated to finding loving homes for animals in need.</p>
                  </div>

                  <!-- Requirements as Cards -->
                  <div class="max-w-5xl mx-auto mb-12">
                      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14M3 21h18"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Shelter Name</h4>
                              <p class="text-orange-700">Official name of your organization</p>
                          </div>
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Location & Address</h4>
                              <p class="text-orange-700">City/Province and complete address if possible</p>
                          </div>
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Contact Person</h4>
                              <p class="text-orange-700">Name and position of primary contact</p>
                          </div>
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 4L12 14.01 2 4"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Email Address</h4>
                              <p class="text-orange-700">Official email for communication</p>
                          </div>
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92V19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2.08"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M8 3.13a4 4 0 0 0 0 7.75"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Contact Number</h4>
                              <p class="text-orange-700">Phone number for direct contact</p>
                          </div>
                          <div class="bg-white border-2 border-orange-200 rounded-xl shadow p-8 flex flex-col items-center text-center hover:border-orange-400 transition">
                              <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                                  <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7c0 6 8 10 8 10z"/></svg>
                              </div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Proof of Legitimacy</h4>
                              <p class="text-orange-700">Registration or legitimacy documentation</p>
                          </div>
                      </div>
                  </div>

                  <!-- Additional Info Section -->
                  <div class="max-w-4xl mx-auto mb-12 space-y-6">
                      <div class="bg-white border-l-4 border-orange-400 p-8 rounded-xl flex items-start gap-4">
                          <svg class="h-6 w-6 text-orange-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h18"/></svg>
                          <div>
                              <h4 class="text-lg font-bold text-orange-900 mb-2">Brief Shelter Overview</h4>
                              <p class="text-orange-700">Include how long your organization has been operating, your mission, animal types, and any special programs or services.</p>
                          </div>
                      </div>
                      <div class="bg-white border-l-4 border-orange-400 p-8 rounded-xl flex items-start gap-4">
                          <svg class="h-6 w-6 text-orange-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10A15.3 15.3 0 0 1 12 2z"/></svg>
                          <div>
                              <h4 class="text-lg font-bold text-orange-900 mb-2">Social Media & Web Presence</h4>
                              <p class="text-orange-700">If available, provide links to your website, Facebook, Instagram, or other social media accounts. This helps us verify your organization.</p>
                          </div>
                      </div>
                  </div>

                  <!-- Application Process Steps -->
                  <div class="max-w-5xl mx-auto mb-12">
                      <div class="text-center mb-10">
                          <h3 class="text-2xl font-bold text-orange-700 mb-2">Application Process</h3>
                          <p class="text-orange-800">Follow these simple steps to become a PawPal partner</p>
                      </div>
                      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                          <div class="relative flex flex-col items-center text-center">
                              <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mb-4">01</div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Prepare Your Information</h4>
                              <p class="text-orange-700 text-sm">Gather all required details about your shelter including mission, animal types, and social media links.</p>
                          </div>
                          <div class="relative flex flex-col items-center text-center">
                              <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mb-4">02</div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Submit Application</h4>
                              <p class="text-orange-700 text-sm">Send your complete information to <span class="font-semibold">adopt@pawpal.com</span> with all required documentation.</p>
                          </div>
                          <div class="relative flex flex-col items-center text-center">
                              <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mb-4">03</div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Review & Verification</h4>
                              <p class="text-orange-700 text-sm">Our team will review your application and verify your organization within 24-48 hours.</p>
                          </div>
                          <div class="relative flex flex-col items-center text-center">
                              <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mb-4">04</div>
                              <h4 class="text-lg font-bold text-orange-900 mb-1">Partnership Onboarding</h4>
                              <p class="text-orange-700 text-sm">Once approved, we'll guide you through setup and get you connected to our network.</p>
                          </div>
                      </div>
                  </div>

                  <!-- CTA Section -->
                  <div class="max-w-3xl mx-auto mb-4">
                      <div class="bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-400 rounded-2xl shadow-2xl p-10 text-center">
                          <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Ready to Partner With Us?</h3>
                          <p class="text-lg text-orange-50 mb-6">Send your shelter information to our team and let's work together to help more animals find their forever homes.</p>
                          <a href="mailto:adopt@pawpal.com" class="inline-block bg-white hover:bg-orange-50 text-orange-600 font-semibold px-8 py-4 text-lg rounded-xl transition-all duration-300 shadow">Email: adopt@pawpal.com</a>
                          <div class="pt-8 border-t border-white/20 mt-8">
                              <p class="text-orange-50 text-sm">Our team will review your application within 24-48 hours and reach out with next steps.</p>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <!-- Emergency Contact Section -->
          <section style="background: white;">
              <div class="section">
                  <div class="emergency-card">
                      <h3>
                          <i data-lucide="phone-call" style="width: 1.25rem; height: 1.25rem;"></i>
                          Emergency Animal Rescue Hotline
                      </h3>
                      <p><strong>24/7 Emergency Line:</strong> +63 917 RESCUE (732-2830)</p>
                      <p>For immediate animal rescue, abuse reports, or life-threatening emergencies</p>
                      <p><em>This line is monitored around the clock by our emergency response team</em></p>
                  </div>
              </div>
          </section>

      </div>

      <script>
          // Initialize Lucide icons
          document.addEventListener('DOMContentLoaded', function() {
              lucide.createIcons();
          });
      </script>
  </body>

  </html>