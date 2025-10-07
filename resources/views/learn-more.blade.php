<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - PawPal</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <!-- Add custom styles -->
    <style>
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
        <section class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 text-balance">
                    Everything You Need to Know About Pet Adoption
                </h1>
                <p class="text-xl text-gray-600 mb-8 text-pretty">
                    Discover the joy of giving a rescued pet a loving home. Learn about our adoption process, pet care
                    essentials, and how to prepare for your new furry family member.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg">
                        Start Your Adoption Journey
                        <i data-lucide="arrow-right" class="ml-2 h-4 w-4"></i>
                    </button>
                    <button class="px-6 py-3 border border-gray-300 hover:border-gray-400 text-gray-700 font-medium rounded-lg">
                        Browse Available Pets
                    </button>
                </div>
            </div>
        </section>

        <!-- Why Adopt Section -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Adoption?</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        When you adopt, you're not just gaining a companion—you're saving a life and making room for another pet
                        in need.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg border p-6 text-center">
                        <div class="mb-4">
                            <i data-lucide="heart" class="h-12 w-12 text-red-500 mx-auto"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Save a Life</h3>
                        <p class="text-gray-600">
                            Every year, millions of healthy, loving pets are euthanized due to overcrowding in shelters. Your
                            adoption directly saves a life.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg border p-6 text-center">
                        <div class="mb-4">
                            <i data-lucide="home" class="h-12 w-12 text-blue-500 mx-auto"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Pre-Trained Companions</h3>
                        <p class="text-gray-600">
                            Many shelter pets are already house-trained and socialized, making the transition to your home
                            smoother.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg border p-6 text-center">
                        <div class="mb-4">
                            <i data-lucide="users" class="h-12 w-12 text-green-500 mx-auto"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Support Your Community</h3>
                        <p class="text-gray-600">
                            By adopting, you support local shelter operations and rescue efforts, helping us continue our mission
                            to save more animals in need.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Adoption Process -->
        <section class="py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Adoption Process</h2>
                    <p class="text-lg text-gray-600">
                        We've designed a simple, thorough process to ensure the perfect match between pets and families.
                    </p>
                </div>

                <div class="space-y-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Browse & Connect</h3>
                            <p class="text-gray-600">
                                Explore our available pets online or visit our shelter. Use our Pet Matching tool to find companions
                                that fit your lifestyle.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold">
                                2
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Meet & Greet</h3>
                            <p class="text-gray-600">
                                Schedule a meet-and-greet with your potential new family member. Bring family members and current pets
                                if applicable.
                            </p>
                        </div>
                    </div>



                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold">
                                3
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Welcome Home</h3>
                            <p class="text-gray-600">
                                Once approved, finalize the adoption paperwork and take your new companion home!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Preparation Tips -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Preparing for Your New Pet</h2>
                    <p class="text-lg text-gray-600">
                        Set your new companion up for success with these essential preparation tips.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-lg border p-6">
                        <div class="flex items-center mb-4">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-500 mr-2"></i>
                            <h3 class="text-xl font-semibold">Essential Supplies</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
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

                    <div class="bg-white rounded-lg border p-6">
                        <div class="flex items-center mb-4">
                            <i data-lucide="home" class="h-5 w-5 text-blue-500 mr-2"></i>
                            <h3 class="text-xl font-semibold">Home Preparation</h3>
                        </div>
                        <ul class="space-y-2 text-gray-600">
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
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                    <p class="text-lg text-gray-600">Get answers to common questions about pet adoption and care.</p>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg border p-6">
                        <h3 class="text-lg font-semibold mb-2">How much does adoption cost?</h3>
                        <p class="text-gray-600">
                            Our adoptions are completely free! All pets come spayed/neutered, vaccinated, and microchipped at no
                            cost to you. We believe that financial barriers shouldn't prevent loving families from finding their
                            perfect companion.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg border p-6">
                        <h3 class="text-lg font-semibold mb-2">What if my new pet doesn't get along with my current pets?</h3>
                        <p class="text-gray-600">
                            We offer a trial period and will work with you to ensure a successful integration. Our team provides
                            guidance on proper introductions, and we're always available for support during the adjustment period.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg border p-6">
                        <h3 class="text-lg font-semibold mb-2">Are shelter pets healthy?</h3>
                        <p class="text-gray-600">
                            All our pets receive thorough veterinary examinations, vaccinations, and necessary medical treatment
                            before adoption. We provide complete medical histories and ongoing support for any health concerns.
                        </p>
                    </div>

                    <div class="bg-white rounded-lg border p-6">
                        <h3 class="text-lg font-semibold mb-2">How long does the adoption process take?</h3>
                        <p class="text-gray-600">
                            The process typically takes 1-3 days, depending on application review and scheduling. We prioritize
                            finding the right match over speed, ensuring both you and your new pet will be happy together.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-purple-600">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ready to Find Your Perfect Companion?</h2>
                <p class="text-xl text-purple-100 mb-8">
                    Browse our available pets or get matched with your ideal companion today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="px-6 py-3 bg-white text-purple-600 font-medium rounded-lg hover:bg-gray-100">
                        Browse Available Pets
                    </button>
                    <button class="px-6 py-3 border border-white text-white font-medium rounded-lg hover:bg-white hover:text-purple-600">
                        Try Pet Matching
                    </button>
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
