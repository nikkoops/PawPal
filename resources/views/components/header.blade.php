<!-- Navigation Header Component - UPDATED FOR CONSISTENCY -->
<style>
  /* Header Component Styles - Ensuring consistency across all pages */
  nav.nav-header {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: blur(12px) !important;
    border-bottom: 1px solid rgba(229, 231, 235, 1) !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 50 !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
  }
  
  nav.nav-header .nav-container {
    max-width: 1280px !important;
    margin: 0 auto !important;
    padding-right: 1rem !important;
    padding-left: 1rem !important;
  }
  
  nav.nav-header .nav-flex {
    display: flex !important;
    align-items: center !important;
    height: 4rem !important;
    justify-content: space-between !important;
  }
  
  nav.nav-header .nav-logo {
    display: flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
  }
  
  nav.nav-header .nav-logo img {
    height: 2rem !important;
    width: 2rem !important;
    object-fit: contain !important;
  }
  
  nav.nav-header .nav-logo span {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #111827 !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
  }
  
  nav.nav-header .nav-desktop {
    display: none !important;
    align-items: center !important;
    gap: 2rem !important;
    margin-left: auto !important;
  }
  
  nav.nav-header .nav-link {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
    color: #6b7280 !important;
    text-decoration: none !important;
    transition: color 0.2s ease !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
  }
  
  nav.nav-header .nav-link:hover {
    color: #fe7701 !important;
  }
  
  nav.nav-header .nav-link.active {
    color: #fe7701 !important;
    font-weight: 600 !important;
  }
  
  nav.nav-header .nav-signin-btn {
    background: #fe7701 !important;
    color: white !important;
    padding: 0.5rem 1rem !important;
    border-radius: 0.375rem !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
    border: none !important;
    cursor: pointer !important;
    transition: background-color 0.2s ease !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
  }
  
  nav.nav-header .nav-signin-btn:hover {
    background: #c1431d !important;
  }
  
  nav.nav-header .nav-mobile-btn {
    display: block !important;
    padding: 0.5rem !important;
    border-radius: 0.375rem !important;
    color: #6b7280 !important;
    background: none !important;
    border: none !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
  }
  
  nav.nav-header .nav-mobile-btn:hover {
    color: #111827 !important;
    background: #f3f4f6 !important;
  }
  
  nav.nav-header .nav-mobile-btn:focus {
    outline: 2px solid #fe7701 !important;
    outline-offset: 2px !important;
  }
  
  nav.nav-header .nav-mobile-menu {
    display: none !important;
    background: white !important;
    border-top: 1px solid rgba(229, 231, 235, 1) !important;
  }
  
  nav.nav-header .nav-mobile-menu.active {
    display: block !important;
  }
  
  nav.nav-header .nav-mobile-links {
    padding: 0.5rem !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 0.25rem !important;
  }
  
  nav.nav-header .nav-mobile-link {
    display: block !important;
    padding: 0.75rem !important;
    border-radius: 0.375rem !important;
    color: #6b7280 !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
    transition: all 0.2s ease !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
  }
  
  nav.nav-header .nav-mobile-link:hover {
    color: #fe7701 !important;
    background: #f3e8ff !important;
  }
  
  nav.nav-header .nav-mobile-link.active {
    color: #fe7701 !important;
    font-weight: 600 !important;
  }
  
  nav.nav-header .nav-mobile-signin {
    width: 100% !important;
    text-align: left !important;
    padding: 0.75rem !important;
    border-radius: 0.375rem !important;
    background: #fe7701 !important;
    color: white !important;
    border: none !important;
    cursor: pointer !important;
    font-weight: 500 !important;
    font-size: 1rem !important;
    transition: background-color 0.2s ease !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segmented UI', Roboto, sans-serif !important;
  }
  
  nav.nav-header .nav-mobile-signin:hover {
    background: #c1431d !important;
  }
  
  /* Responsive breakpoints */
  @media (min-width: 768px) {
    nav.nav-header .nav-desktop {
      display: flex !important;
    }
    
    nav.nav-header .nav-mobile-btn {
      display: none !important;
    }
    
    nav.nav-header .nav-container {
      padding-right: 1.5rem !important;
      padding-left: 1.5rem !important;
    }
  }
  
  @media (min-width: 1024px) {
    nav.nav-header .nav-container {
      padding-right: 2rem !important;
      padding-left: 2rem !important;
    }
  }
</style>

<nav class="nav-header">
  <div class="nav-container">
    <div class="nav-flex">
      <!-- Logo -->
      <div class="nav-logo">
        <img src="{{ asset('images/pawpal-logo.png') }}?v={{ time() }}" alt="PawPal Logo">
        <span>PawPal</span>
      </div>
      
      <!-- Desktop Navigation -->
      <div class="nav-desktop">
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('home') }}#pets-section" class="nav-link">Find Pets</a>
        <a href="{{ url('/success-stories') }}" class="nav-link {{ Request::is('success-stories') ? 'active' : '' }}">Success Stories</a>
        <a href="{{ url('/learn-more') }}" class="nav-link {{ Request::is('learn-more') ? 'active' : '' }}">Learn More</a>
        <a href="{{ url('/contact') }}" class="nav-link {{ Request::is('contact') ? 'active' : '' }}">Contact Us</a>
        <button onclick="openRoleModal()" class="nav-signin-btn">
          Sign In
        </button>
      </div>
      
      <!-- Mobile Menu Button -->
      <button type="button" class="nav-mobile-btn" onclick="toggleMobileMenu()">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
    
    <!-- Mobile Navigation Menu -->
    <div class="nav-mobile-menu" id="mobileMenu">
      <div class="nav-mobile-links">
        <a href="{{ route('home') }}" class="nav-mobile-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('home') }}#pets-section" class="nav-mobile-link">Find Pets</a>
        <a href="{{ url('/success-stories') }}" class="nav-mobile-link {{ Request::is('success-stories') ? 'active' : '' }}">Success Stories</a>
        <a href="{{ url('/learn-more') }}" class="nav-mobile-link {{ Request::is('learn-more') ? 'active' : '' }}">Learn More</a>
        <a href="{{ url('/contact') }}" class="nav-mobile-link {{ Request::is('contact') ? 'active' : '' }}">Contact Us</a>
        <button onclick="openRoleModal()" class="nav-mobile-signin">
          Sign In
        </button>
      </div>
    </div>
  </div>
</nav>
<!-- Mobile Menu JavaScript -->
<script>
function toggleMobileMenu() {
  const mobileMenu = document.getElementById('mobileMenu');
  if (mobileMenu) {
    mobileMenu.classList.toggle('active');
  }
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(event) {
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileButton = document.querySelector('.nav-mobile-btn');
  
  if (mobileMenu && mobileButton && 
      !mobileMenu.contains(event.target) && 
      !mobileButton.contains(event.target)) {
    mobileMenu.classList.remove('active');
  }
});

// Close mobile menu on window resize
window.addEventListener('resize', function() {
  if (window.innerWidth >= 768) {
    const mobileMenu = document.getElementById('mobileMenu');
    if (mobileMenu) {
      mobileMenu.classList.remove('active');
    }
  }
});
</script>
