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
            font-size: 15px;
            line-height: 1.6;
        }

        /* Main Content Styles */
        .gradient-bg {
            background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
            min-height: 100vh;
        }

        /* Hero Section - matching Home page scale */
        .hero-section {
            padding: 4rem 1rem;
            background: #f5f6ff;
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
            font-family: serif;
        }

        .hero-content p {
            font-size: 1rem;
            color: #374151;
            margin-bottom: 2rem;
            line-height: 1.6;
            max-width: 700px;
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
            margin-bottom: 2.5rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #111827;
            margin-bottom: 0.75rem;
            font-family: serif;
        }

        .section-header p {
            font-size: 1rem;
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
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin: 0.75rem 0;
        }

        .card p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 0.9375rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .hero-section {
                padding: 3rem 1rem;
            }
            
            .section-header h2 {
                font-size: 1.5rem;
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
                            <i data-lucide="users" style="height: 3rem; width: 3rem; color: #9333ea; margin: 0 auto; display: block;"></i>
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
                            <i data-lucide="check-circle" style="height: 1.25rem; width: 1.25rem; color: #9333ea; margin-right: 0.5rem;"></i>
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
            
            // Initialize Lucide Icons
            lucide.createIcons();
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
