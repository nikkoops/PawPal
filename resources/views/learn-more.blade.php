<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - PawPal</title>
    <!-- Include Inter font for consistency -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            font-size: 16px;
            line-height: 1.6;
        }

        /* Main Content Styles */
        .gradient-bg {
            background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
            min-height: 100vh;
        }

        /* Hero Section - matching Home page scale */
        .hero-section {
            padding: 6rem 1rem;
            background: #f5f6ff;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: bold;
            color: #111827;
            margin-bottom: 2rem;
            line-height: 1.1;
            font-family: serif;
        }

        .hero-content p {
            font-size: 1.125rem;
            color: #374151;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Button styles matching Home page */
        .btn-primary {
            background: #9333ea;
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
            background: #7c3aed;
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
            padding: var(--spacing-xl) var(--spacing-md);
            max-width: var(--container-width);
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #111827;
            margin-bottom: 1rem;
            font-family: serif;
        }

        .section-header p {
            font-size: 1.125rem;
            color: #6b7280;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Grid layouts */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin: 1rem 0;
        }

        .card p {
            color: #6b7280;
            line-height: 1.6;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-section {
                padding: 4rem 1rem;
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
                    Everything You Need to Know About Pet Adoption
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
                    <a href="{{ route('home') }}#pets-section" class="btn-outline">
                        Browse Available Pets
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
                            <i data-lucide="users" style="height: 3rem; width: 3rem; color: #10b981; margin: 0 auto; display: block;"></i>
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
                        We've designed a simple, thorough process to ensure the perfect match between pets and families.
                    </p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 2rem; height: 2rem; background: #9333ea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            1
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">Browse & Connect</h3>
                            <p style="color: #6b7280; line-height: 1.6;">
                                Explore our available pets online or visit our shelter. Use our Pet Matching tool to find companions
                                that fit your lifestyle.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 2rem; height: 2rem; background: #9333ea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            2
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">Meet & Greet</h3>
                            <p style="color: #6b7280; line-height: 1.6;">
                                Schedule a meet-and-greet with your potential new family member. Bring family members and current pets
                                if applicable.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 2rem; height: 2rem; background: #9333ea; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            3
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 0.5rem;">Welcome Home</h3>
                            <p style="color: #6b7280; line-height: 1.6;">
                                Once approved, finalize the adoption paperwork and take your new companion home!
                            </p>
                        </div>
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
                            <i data-lucide="check-circle" style="height: 1.25rem; width: 1.25rem; color: #10b981; margin-right: 0.5rem;"></i>
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
                            Our adoptions are completely free! All pets come spayed/neutered, vaccinated, and microchipped at no
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

        <!-- CTA Section -->
        <section style="background: #9333ea; padding: 4rem 1rem;">
            <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                <h2 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 1rem; font-family: serif;">Ready to Find Your Perfect Companion?</h2>
                <p style="font-size: 1.125rem; color: #e9d5ff; margin-bottom: 2rem;">
                    Browse our available pets or get matched with your ideal companion today.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('home') }}#pets-section" style="padding: 0.625rem 1.5rem; background: white; color: #9333ea; font-weight: 600; border-radius: 0.5rem; text-decoration: none; border: none; transition: all 0.2s;">
                        Browse Available Pets
                    </a>
                    <a href="{{ route('home') }}#pets-section" style="padding: 0.625rem 1.5rem; border: 1px solid white; color: white; font-weight: 600; border-radius: 0.5rem; text-decoration: none; background: transparent; transition: all 0.2s;">
                        Try Pet Matching
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        
        <footer class="text-white py-12" style="background-color: #2c0b47;">
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
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>
