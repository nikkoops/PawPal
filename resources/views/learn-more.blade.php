<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - PawPal</title>
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
        /* CSS Variables for warm pet adoption design - matching Home page */
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
            font-size: 0.875rem !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
        }

        /* Main Content Styles */
        .gradient-bg {
            background: linear-gradient(to bottom, #ffecdd, #ffe8d6);
            min-height: 100vh;
        }

        /* Hero Section - matching Home page scale */
        .hero-section {
            /* reduced vertical padding for a tighter layout */
            padding: 2.5rem 1rem;
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

        /* Button styles matching Home page */
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

        .btn-outline {
            background: transparent;
            color: #374151;
            padding: 0.625rem 1.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            border-color: #9ca3af;
            background: #f9fafb;
        }

        /* Section styles */
        .section {
            /* reduce top/bottom padding to tighten spacing */
            padding: 2rem var(--spacing-md);
            max-width: var(--container-width);
            margin: 0 auto;
        }

        /* Adoption steps */
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .step-icon {
            /* slightly smaller round icon to reduce visual bulk */
            width: 2.25rem;
            height: 2.25rem;
            background: #fe7701;
            color: white;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 6px 18px rgba(254,119,1,0.14);
        }

        .step-title {
            font-size: 1.125rem;
            font-weight: 700;
            /* Gradient text to match Contact Us page */
            color: transparent;
            margin-bottom: 0.25rem;
            background-image: linear-gradient(90deg, #f97316 0%, #fb923c 50%, #fde047 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .step-desc {
            color: #6b7280;
            line-height: 1.7;
        }

        /* Accordion behaviour */
        .step-panel {
            border-radius: 0.75rem;
            /* tighter panel padding */
            padding: 0.25rem 0.25rem;
        }

        .step-header {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            cursor: pointer;
            /* reduced paddings for denser layout */
            padding: 0.375rem 0.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.18s, transform 0.12s;
        }

        .step-header:focus {
            outline: 3px solid rgba(254,119,1,0.18);
            outline-offset: 2px;
        }

        .step-header:hover { background: rgba(254,119,1,0.03); }

        .step-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.32s ease, padding 0.24s ease;
            padding: 0 0.75rem;
        }

        .step-panel.open .step-body {
            max-height: 400px; /* enough for our content */
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .step-toggle .toggle-icon {
            transition: transform 0.28s ease;
            color: rgba(17,24,39,0.7);
        }

        .step-panel.open .step-toggle .toggle-icon {
            transform: rotate(180deg);
            color: #fe7701;
        }

        .section-header {
            text-align: center;
            /* smaller gap under headers */
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: bold;
            /* Use same gradient treatment as Contact Us for consistency */
            color: transparent;
            background-image: linear-gradient(90deg, #f97316 0%, #fb923c 50%, #fde047 100%);
            -webkit-background-clip: text;
            background-clip: text;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 1.5rem 1rem;
            }
            
            .section-header h2 {
                font-size: 2rem;
            }
            
            .card-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
            .section-header h2 {
                font-size: 2rem;
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
                <h1 class="text-balance">
                    <span class="font-black font-[Inter,sans-serif] bg-gradient-to-r from-slate-800 via-slate-600 to-slate-800 bg-clip-text text-transparent">Everything You Need to Know</span>
                    <br>
                    <span class="font-black font-[Inter,sans-serif] bg-gradient-to-r from-orange-600 via-orange-500 to-amber-500 bg-clip-text text-transparent">About Pet Adoption</span>
                </h1>
                <p class="text-pretty">
                    Discover the joy of giving a rescued pet a loving home. Learn about our adoption process, pet care
                    essentials, and how to prepare for your new furry family member.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('home') }}#pets-section" class="btn-primary">
                        Start Your Adoption Journey
                        <i data-lucide="arrow-right" style="margin-left: 0.5rem; height: 1rem; width: 1rem;"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Why Adopt Section -->
        <section style="background: white;">
            <div class="section">
                <div class="section-header">
                    <h2>Why Choose Adoption?</h2>
                    <p>
                        When you adopt, you're not just gaining a companion—you're saving a life and making room for another pet
                        in need.
                    </p>
                </div>

                <div class="card-grid">
                    <div class="card">
                        <div style="margin-bottom: 1rem;">
                            <i data-lucide="heart" style="height: 3rem; width: 3rem; color: #ef4444; margin: 0 auto; display: block;"></i>
                        </div>
                        <h3>Save a Life</h3>
                        <p>
                            Every year, millions of healthy, loving pets are euthanized due to overcrowding in shelters. Your
                            adoption directly saves a life.
                        </p>
                    </div>

                    <div class="card">
                        <div style="margin-bottom: 1rem;">
                            <i data-lucide="home" style="height: 3rem; width: 3rem; color: #3b82f6; margin: 0 auto; display: block;"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Pre-Trained Companions</h3>
                        <p class="text-gray-600">
                            Many shelter pets are already house-trained and socialized, making the transition to your home
                            smoother.
                        </p>
                    </div>

                    <div class="card">
                        <div style="margin-bottom: 1rem;">
                            <i data-lucide="users" style="height: 3rem; width: 3rem; color: #fe7701; margin: 0 auto; display: block;"></i>
                        </div>
                        <h3>Support Your Community</h3>
                        <p>
                            By adopting, you support local shelter operations and rescue efforts, helping us continue our mission
                            to save more animals in need.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Adoption Process -->
        <section>
            <div class="section">
                <div class="section-header">
                    <h2>Our Adoption Process</h2>
                    <p>
                        We've made adopting your perfect pet simple, convenient, and heartwarming through PawPal.
                    </p>
                </div>

                <div class="steps-accordion" style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="search" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Discover & Apply for Adoption</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">Browse through our list of adorable pets available for adoption. Once you find your match, submit an adoption application directly.</p></div>
                    </div>

                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="clipboard" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Submit Application</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">Fill out the adoption form, submit a valid ID, and provide pictures or videos of your home environment.</p></div>
                    </div>

                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="message-circle" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Connect & Interview</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">After your application is reviewed, a meeting will be scheduled via Viber or Telegram to discuss your readiness and get to know you better.</p></div>
                    </div>

                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="home" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Home Check & Approval</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">Once approved, our team will personally deliver your chosen pet to your home to verify the environment and finalize the adoption.</p></div>
                    </div>

                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="file-text" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Sign & Prepare</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">You’ll sign the adoption contract and prepare essentials like food, leash, and vitamins. Pets come with medical history records and 1 month of free medication if needed.</p></div>
                    </div>

                    <div class="step-panel">
                        <div class="step-header" role="button" tabindex="0" aria-expanded="false">
                            <div class="step-icon"><i data-lucide="heart" class="lucide-icon" style="width:22px;height:22px; color: white;"></i></div>
                            <div style="flex:1">
                                <div class="step-title">Post-Adoption Support</div>
                            </div>
                            <div class="step-toggle"><i data-lucide="chevron-down" class="toggle-icon"></i></div>
                        </div>
                        <div class="step-body"><p class="step-desc">We provide one-year follow-up and lifetime support to ensure your pet is happy, healthy, and loved in their new home.</p></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preparation Tips -->
        <section style="background: #f9fafb;">
            <div class="section">
                <div class="section-header">
                    <h2>Preparing for Your New Pet</h2>
                    <p>
                        Set your new companion up for success with these essential preparation tips.
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
                    <div class="card">
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <i data-lucide="check-circle" style="height: 1.25rem; width: 1.25rem; color: #fe7701; margin-right: 0.5rem;"></i>
                            <h3 style="margin: 0;">Essential Supplies</h3>
                        </div>
                        <ul style="list-style: none; padding: 0; color: #6b7280; line-height: 1.8;">
                            <li>• Food and water bowls</li>
                            <li>• High-quality pet food</li>
                            <li>• Collar with ID tag</li>
                            <li>• Leash (for dogs)</li>
                            <li>• Comfortable bed or crate</li>
                            <li>• Toys for mental stimulation</li>
                            <li>• Grooming supplies</li>
                            <li>• First aid kit</li>
                        </ul>
                    </div>

                    <div class="card">
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <i data-lucide="home" style="height: 1.25rem; width: 1.25rem; color: #3b82f6; margin-right: 0.5rem;"></i>
                            <h3 style="margin: 0;">Home Preparation</h3>
                        </div>
                        <ul style="list-style: none; padding: 0; color: #6b7280; line-height: 1.8;">
                            <li>• Pet-proof your home</li>
                            <li>• Remove toxic plants and substances</li>
                            <li>• Secure loose wires and small objects</li>
                            <li>• Create a quiet space for adjustment</li>
                            <li>• Install baby gates if needed</li>
                            <li>• Research local veterinarians</li>
                            <li>• Plan for the first few weeks</li>
                            <li>• Prepare family members</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section style="background: white;">
            <div class="section">
                <div class="section-header">
                    <h2>Frequently Asked Questions</h2>
                    <p>Get answers to common questions about pet adoption and care.</p>
                </div>

                <div class="space-y-6">
                                    </div>

                <div style="display: grid; gap: 1.5rem;">
                    <div class="card" style="text-align: left;">
                        <h3 style="margin-bottom: 0.5rem;">How much does adoption cost?</h3>
                        <p>
                            Our adoptions are completely free! All pets come spayed/neutered and vaccinated at no
                            cost to you. We believe that financial barriers shouldn't prevent loving families from finding their
                            perfect companion.
                        </p>
                    </div>

                    <div class="card" style="text-align: left;">
                        <h3 style="margin-bottom: 0.5rem;">What if my new pet doesn't get along with my current pets?</h3>
                        <p>
                            We offer a trial period and will work with you to ensure a successful integration. Our team provides
                            guidance on proper introductions, and we're always available for support during the adjustment period.
                        </p>
                    </div>

                    <div class="card" style="text-align: left;">
                        <h3 style="margin-bottom: 0.5rem;">Are shelter pets healthy?</h3>
                        <p>
                            All our pets receive thorough veterinary examinations, vaccinations, and necessary medical treatment
                            before adoption. We provide complete medical histories and ongoing support for any health concerns.
                        </p>
                    </div>

                    <div class="card" style="text-align: left;">
                        <h3 style="margin-bottom: 0.5rem;">How long does the adoption process take?</h3>
                        <p>
                            The process typically takes 1-3 days, depending on application review and scheduling. We prioritize
                            finding the right match over speed, ensuring both you and your new pet will be happy together.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('components.footer')
    </div>

    

    <script>
        // Accordion interactivity for adoption steps
        document.addEventListener('DOMContentLoaded', function() {
            const panels = document.querySelectorAll('.step-panel');
            panels.forEach(panel => {
                const header = panel.querySelector('.step-header');
                const body = panel.querySelector('.step-body');

                function toggle(openFromKeyboard = false) {
                    const isOpen = panel.classList.contains('open');
                    if (isOpen) {
                        panel.classList.remove('open');
                        header.setAttribute('aria-expanded', 'false');
                    } else {
                        panel.classList.add('open');
                        header.setAttribute('aria-expanded', 'true');
                    }
                }

                header.addEventListener('click', () => toggle());
                header.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        toggle(true);
                    }
                });
            });

            // Recreate Lucide icons in case new elements were added dynamically
            if (window.lucide && typeof lucide.createIcons === 'function') {
                lucide.createIcons();
            }
        });
    </script>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>
