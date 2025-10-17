<!-- Navigation Header Component - UPDATED -->
<style>
  .nav-link {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif;
  }
  .nav-link.active,
  .nav-link:active,
  .nav-link:focus {
    color: #9333ea;
    font-weight: 600;
  }
</style>
<nav class="bg-white/80 backdrop-blur-sm border-b sticky top-0 z-50">
  <div class="max-w-7xl mx-auto pr-4 sm:pr-6 lg:pr-8">
    <div class="flex items-center h-16 justify-between">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <img src="{{ asset('images/pawpal-logo.png') }}?v={{ time() }}" alt="PawPal Logo" class="h-8 w-8 object-contain">
        <span class="text-xl font-bold text-gray-900">PawPal</span>
      </div>
      
      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-8 ml-auto">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }} transition-colors" style="{{ Request::is('/') ? 'color: #9333ea; font-weight: 600;' : '' }}">Home</a>
        <a href="{{ route('home') }}#pets-section" class="nav-link text-gray-600 hover:text-purple-600 transition-colors">Find Pets</a>
        <a href="{{ url('/learn-more') }}" class="nav-link {{ Request::is('learn-more') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }} transition-colors" style="{{ Request::is('learn-more') ? 'color: #9333ea; font-weight: 600;' : '' }}">Learn More</a>
        <a href="{{ url('/contact') }}" class="nav-link {{ Request::is('contact') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }} transition-colors" style="{{ Request::is('contact') ? 'color: #9333ea; font-weight: 600;' : '' }}">Contact Us</a>
        <button onclick="openRoleModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
          Sign In
        </button>
      </div>
      
      <!-- Mobile Menu Button -->
      <div class="md:hidden">
        <button type="button" class="mobile-menu-button p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-purple-500">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <div class="mobile-menu hidden md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ Request::is('/') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}" style="{{ Request::is('/') ? 'color: #9333ea; font-weight: 600;' : '' }}">Home</a>
        <a href="{{ route('home') }}#pets-section" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-purple-600 hover:bg-purple-50">Find Pets</a>
        <a href="{{ url('/learn-more') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ Request::is('learn-more') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}" style="{{ Request::is('learn-more') ? 'color: #9333ea; font-weight: 600;' : '' }}">Learn More</a>
        <a href="{{ url('/contact') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ Request::is('contact') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}" style="{{ Request::is('contact') ? 'color: #9333ea; font-weight: 600;' : '' }}">Contact Us</a>
        <button onclick="openRoleModal()" class="w-full text-left px-3 py-2 rounded-md text-base font-medium bg-purple-600 text-white hover:bg-purple-700">
          Sign In
        </button>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile Menu JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuButton = document.querySelector('.mobile-menu-button');
  const mobileMenu = document.querySelector('.mobile-menu');
  
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });
  }
});
</script>
