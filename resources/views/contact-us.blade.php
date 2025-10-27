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
              background: #fff8ed;
              position: relative;
              min-height: 100vh;
          }
          .gradient-bg::before {
              content: '';
              position: absolute;
              top: 0;
              left: 0;
              right: 0;
              bottom: 0;
              background: #fff8ed;
              opacity: 0.1;
              animation: gradientShift 8s ease-in-out infinite;
              z-index: 0;
          }
          @keyframes gradientShift {
              0%, 100% { transform: translateX(-100%); }
              50% { transform: translateX(0); }
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

          /* .hero-content h1 { font-size: 3rem; ... } removed to allow Tailwind classes to control size */

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
                                                                                                                      <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 text-center drop-shadow-lg font-[Inter,sans-serif] whitespace-nowrap">
                                                                                                                        <span class="font-black font-[Inter,sans-serif] bg-gradient-to-r from-slate-800 via-slate-600 to-slate-800 bg-clip-text text-transparent">Contact </span>
                                                                                                                        <span class="font-black font-[Inter,sans-serif] bg-gradient-to-r from-orange-600 via-orange-500 to-amber-400 bg-clip-text text-transparent">PawPal</span>
                                                                                                                </h1>
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
                      <h2 class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-400 to-yellow-400 mb-4 tracking-tight font-[Montserrat,Inter,sans-serif] drop-shadow-lg text-center" style="background-image: linear-gradient(90deg, #f97316 0%, #fb923c 50%, #fde047 100%); color: transparent; -webkit-background-clip: text; background-clip: text;">Get in Touch</h2>
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
                      <h2 class="text-4xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-400 to-yellow-400 mb-4 tracking-tight font-[Montserrat,Inter,sans-serif] drop-shadow-lg text-center" style="background-image: linear-gradient(90deg, #f97316 0%, #fb923c 50%, #fde047 100%); color: transparent; -webkit-background-clip: text; background-clip: text;">Support Our Mission</h2>
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



                    <!-- For Animal Shelters & Rescue Organizations Section (Pixel-Perfect Screenshot Match) -->
                    <section class="py-14 px-4">
                        <div class="max-w-6xl mx-auto bg-gradient-to-br from-orange-50 via-white to-orange-100 rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(255,140,0,0.15)] border border-orange-200 p-12 relative backdrop-blur-md">
                            <div class="absolute -top-4 -right-4 w-8 h-8 bg-orange-400 rounded-full animate-pulse shadow-lg"></div>
                                            <div class="text-center mb-10">
                                                <h2 class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-orange-400 to-yellow-400 mb-2 tracking-tight font-[Montserrat,Inter,sans-serif] drop-shadow-lg whitespace-nowrap">For Animal Shelters & Rescue Organizations</h2>
                                                <p class="text-sm text-gray-700 max-w-2xl mx-auto font-normal">Are you a shelter or rescue group interested in partnering with PAWPAL? We welcome organizations who share our mission of helping animals find loving, forever homes!</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                                                <div class="bg-white/80 rounded-2xl border border-orange-300 shadow-lg p-8 flex flex-col justify-between">
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-3">
                                                            <i data-lucide="info" class="w-5 h-5 text-orange-400"></i>
                                                            <h3 class="text-base font-bold text-orange-700">Required Information for Admin Shelter Application:</h3>
                                                        </div>
                                                                            <ul class="list-disc pl-6 text-gray-900 space-y-2 text-sm leading-6">
                                                                                <li><span class="font-semibold">Shelter Name</span></li>
                                                                                <li><span class="font-semibold">Location</span> (City/Province + Complete Address if possible)</li>
                                                                                <li><span class="font-semibold">Contact Person</span> (Name & Position)</li>
                                                                                <li><span class="font-semibold">Official Email Address</span></li>
                                                                                <li><span class="font-semibold">Contact Number</span></li>
                                                                                <li><span class="font-semibold">Brief Shelter Overview</span> (e.g., how long operating, mission, animal types)</li>
                                                                                <li><span class="font-semibold">Website / Facebook / Instagram</span> (if available)</li>
                                                                                <li><span class="font-semibold">Proof of Legitimacy / Registration</span> (if applicable)</li>
                                                                            </ul>
                                                    </div>
                                                </div>
                                <div class="flex flex-col gap-6 justify-center">
                                                                            <div class="bg-gradient-to-br from-orange-100 via-orange-50 to-white border border-orange-200 rounded-xl p-6 shadow-md">
                                                                                <div class="flex items-center gap-2 mb-1">
                                                                                    <i data-lucide="mail" class="w-4 h-4 text-orange-500"></i>
                                                                                    <span class="font-semibold text-orange-700 text-base">How to Apply:</span>
                                                                                </div>
                                                                                <span class="text-gray-700 text-sm">Please send the above details by email to
                                                                                    <a href="mailto:adopt@pawpal.com" class="text-orange-600 underline hover:text-orange-800 font-semibold">adopt@pawpal.com</a>.
                                                                                </span>
                                                                            </div>
                                                                            <div class="bg-gradient-to-br from-yellow-100 via-yellow-50 to-white border border-yellow-200 rounded-xl p-6 shadow-md">
                                                                                <div class="flex items-center gap-2 mb-1">
                                                                                    <i data-lucide="star" class="w-4 h-4 text-yellow-500"></i>
                                                                                    <span class="font-semibold text-yellow-700 text-base">What Happens Next?</span>
                                                                                </div>
                                                                                <span class="text-gray-700 text-sm">Our team will review your information, verify your organization, and reach out for onboarding if you meet our partnership criteria.</span>
                                                                            </div>
                                </div>
                            </div>
                                              <p class="text-orange-600 text-base text-center mt-8 tracking-tight">
                                                Let's work together to help more animals find their forever homes!
                                                <span aria-label="paw" role="img">🐾</span> <span aria-label="heart" role="img">❤️</span>
                                            </p>
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