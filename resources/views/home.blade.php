
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <title>PawPal - Pet Adoption</title>
  <link href="styles/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    /* CSS Variables for warm pet adoption design */
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
      --popover: oklch(1 0 0);
      --popover-foreground: oklch(0.35 0 0);
      --primary: oklch(0.45 0.15 65);
      --primary-foreground: oklch(1 0 0);
      --secondary: oklch(0.65 0.25 330);
      --secondary-foreground: oklch(1 0 0);
    }

    body {
      font-size: 15px;
    }

        <div class="pet-modal-grid">
          <!-- Pet Image Section with Carousel -->
          <div class="pet-image-container">
            <div style="position: relative;">
              <!-- Image Carousel -->
              <div class="image-carousel-container">
                <img id="modalImage" class="pet-modal-image" src="" alt="">
                
                <!-- Navigation Arrows -->
                <button id="prevImageBtn" class="carousel-arrow carousel-arrow-left" onclick="previousImage()" style="display: none;">
                  <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                  </svg>
                </button>
                <button id="nextImageBtn" class="carousel-arrow carousel-arrow-right" onclick="nextImage()" style="display: none;">
                  <svg width="24" height="24" fill="none" stroke="#fff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </button>
                
                <!-- Image Counter -->
                <div id="imageCounter" class="image-counter" style="display: none;">
                  <span id="currentImageIndex">1</span>/<span id="totalImages">1</span>
                </div>
              </div>
              
              <div id="modalUrgentBadge" class="urgent-badge" style="position: absolute; top: 1rem; left: 1rem; display: none;">
                🚨 Urgent: Adopt this week
              </div>
              
              <!-- Thumbnail Strip -->
              <div id="thumbnailStrip" class="thumbnail-strip" style="display: none;">
              </div>
            </div>
          </div>

          <!-- Pet Details Section -->
          <div>
            <!-- About Section -->
            <div class="about-section">
              <h2>About <span id="aboutPetName">Duke</span></h2>
              <p id="modalDescription" class="about-text">
                Duke was found in Plaza City and has been here 30 days. This happy pup's goofy energy will bring joy to any home.
              </p>
            </div>

            <!-- Characteristics -->
            <div class="characteristics-section" style="margin-bottom: 6rem;">
              <h3>Health</h3>
              <div class="characteristics-grid">
                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span class="characteristic-label">Vaccinated</span>
                  </div>
                  <span id="modalVaccinated" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a3.5 3.5 0 117 0H19M9 10v.5A3.5 3.5 0 005.5 14v0A3.5 3.5 0 009 10.5M19 10v.5a3.5 3.5 0 01-3.5 3.5v0a3.5 3.5 0 01-3.5-3.5V10"></path>
                    </svg>
                    <span class="characteristic-label">Spayed/Neutered</span>
                  </div>
                  <span id="modalSpayedNeutered" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    <span class="characteristic-label">Dewormed</span>
                  </div>
                  <span id="modalDewormed" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="characteristic-label">Tick/Flea Treated</span>
                  </div>
                  <span id="modalTickFleaTreated" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <span class="characteristic-label">On Preventive Medication</span>
                  </div>
                  <span id="modalPreventiveMedication" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="characteristic-label">Has Special Medical Needs</span>
                  </div>
                  <span id="modalSpecialMedicalNeeds" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    <span class="characteristic-label">Disabled / Mobility Impaired</span>
                  </div>
                  <span id="modalMobilityImpaired" class="characteristic-badge badge-no">✕</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="characteristic-label">Undergoing Treatment</span>
                  </div>
                  <span id="modalUndergoingTreatment" class="characteristic-badge badge-no">✕</span>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="modal-actions" style="margin-top:auto; padding-top:1.1rem;">
              <a href="{{ url('/adopt') }}" class="btn-adopt" id="adoptLink">
                ❤️ Adopt <span id="modalAdoptName">Duke</span>
              </a>
            </div>
          </div>
        </div>
      text-decoration: none;
    }

    .nav-link.active,
    .nav-link:active,
    .nav-link:focus {
      color: #fe7701;
      font-weight: 600;
    }

    /* Main Content Styles */
    .gradient-bg {
      background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
      min-height: 100vh;
    }

    .hero-section {
      padding: 6rem 1rem;
      background: #ffecdd;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 10rem;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
    }

    @media (min-width: 1024px) {
      .hero-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .hero-content h1 {
      font-weight: bold;
      color: #111827;
      margin-bottom: 4rem;
      line-height: 0.6;
      font-family: serif;
    }

    .hero-content h1 .line1 {
      font-size: 6rem;
      display: block;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
    }

    .hero-content h1 .line2 {
      font-size: 6rem;
      display: block;
      margin-bottom: 2rem;
      letter-spacing: -0.02em;
    }

    .hero-content .subtitle {
      font-size: 2.50rem;
      font-family: serif;
      margin-top: 1rem;
    }

    .hero-content p {
      font-size: 1.125rem;
      color: #374151;
      margin-bottom: 2.5rem;
      line-height: 1.6;
      text-align: justify;
    }

    .hero-buttons {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: #fe7701;
      color: white;
      padding: 0.625rem 1.5rem;
      border: none;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s;
      font-size: 0.875rem;
    }

    .btn-primary:hover {
      background: #c1431d;
      color: white;
      text-decoration: none;
    }

    .btn-outline {
      background: transparent;
      color: #fe7701;
      padding: 0.625rem 1.5rem;
      border: 1px solid #fe7701;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
      font-size: 0.875rem;
    }

    .btn-outline:hover {
      background: #c1431d;
      color: white;
      text-decoration: none;
    }

    .hero-images {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .hero-images img {
      width: 100%;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      object-fit: cover;
      background: linear-gradient(135deg, #f3e8ff, #ffecdd);
      display: block;
      min-height: 130px;
    }

    .hero-images img[src=""], 
    .hero-images img:not([src]) {
      background: linear-gradient(135deg, #f3e8ff, #ffecdd);
      position: relative;
    }

    .hero-images img[src=""]:after, 
    .hero-images img:not([src]):after {
      content: "🐕";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 2rem;
      color: #6b7280;
    }

    .pets-section {
      background: white;
      padding: 4rem 1rem;
    }

    .pets-container {
      max-width: 1200px;
      margin: 0 auto;
    }

    .section-header {
      text-align: center;
      margin-bottom: 3rem;
    }

    .section-header h2 {
      font-size: 3.5rem;
      font-weight: bold;
  color: #111827;
      margin-bottom: 1rem;
      font-family: serif;
    }

    .section-header p {
      font-size: 1rem;
      color: #6b7280;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .filters {
      margin-bottom: 3rem;
    }

    .filters h3 {
      font-size: 1rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 1.5rem;
    }

    .filter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .filter-input, .filter-select {
      padding: 0.625rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 0.875rem;
      width: 100%;
      color: #1f2937;
    }

    .filter-select {
      text-align: left;
      text-align-last: left;
      padding-left: 1rem;
      padding-right: 1.75rem;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
    }

    .pets-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .pet-card {
  background: white;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      overflow: hidden;
      transition: box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .pet-card:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .pet-image {
      position: relative;
    }

    .pet-image img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      background: linear-gradient(135deg, #f3e8ff, #e0e7ff);
      display: block;
    }

    .pet-image img[src=""], 
    .pet-image img:not([src]) {
      background: linear-gradient(135deg, #f3e8ff, #e0e7ff);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pet-image img[src=""]:after, 
    .pet-image img:not([src]):after {
      content: "🐾";
      font-size: 3rem;
      color: #6b7280;
    }

    .urgent-badge {
      position: absolute;
      top: 0.5rem;
      left: 0.5rem;
      background: #ef4444;
      color: white;
      padding: 0.5rem 0.75rem;
      border-radius: 30px;
  font-size: 1rem;
      font-weight: 400;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      z-index: 10;
    }

    .pet-info {
      padding: 1rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .pet-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.5rem;
    }

    .pet-name {
  font-size: 1rem;
      font-weight: bold;
      color: #1f2937;
      margin: 0;
    }

    .pet-type {
      font-size: 0.875rem;
      color: #1f2937;
      font-weight: 500;
      background: #f0f6ff;
      padding: 0.125rem 0.375rem;
      border-radius: 0.25rem;
    }

    .pet-details {
      font-size: 0.75rem;
      color: #6b7280;
      margin-bottom: 0.75rem;
    }

    .pet-description {
      font-size: 0.75rem;
  color: #111827;
      margin-bottom: 1rem;
      line-height: 1.7;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
      flex-grow: 1;
    }

    .meet-btn {
      width: 100%;
      background: #fe7701;
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 0.375rem;
      font-weight: 500;
      font-size: 0.860rem;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: auto;
    }

    .meet-btn:hover {
      background: #c1431d;
    }

    /* Modal Styles with new color system */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background-color: var(--card);
      margin: 2% auto;
      padding: 0;
      border-radius: 0.5rem;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 1000px;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      border: 1px solid var(--border);
    }

    .modal-header {
      background: #f3f4f6;
      padding: 2rem;
      text-align: center;
      position: relative;
      border-top-left-radius: calc(var(--radius) + 4px);
      border-top-right-radius: calc(var(--radius) + 4px);
      border-bottom: 1px solid #d1d5db;
    }

    .modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      color: var(--foreground);
      font-size: 1.5rem;
      font-weight: bold;
      cursor: pointer;
      border: none;
      background: rgba(0, 0, 0, 0.1);
      padding: 0.5rem;
      border-radius: var(--radius);
      transition: all 0.2s;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .modal-close:hover {
      background: rgba(0, 0, 0, 0.2);
    }

    .modal-header h1 {
      font-size: 1.4rem;
      font-weight: bold;
      color: var(--foreground);
      margin: 0 0 0.5rem 0;
    }

    .modal-header-badge {
      display: inline-flex;
      align-items: center;
      background: var(--secondary);
      color: var(--secondary-foreground);
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.875rem;
      font-weight: 500;
      margin-right: 0.5rem;
    }

    .urgent-badge {
      display: inline-flex;
      align-items: center;
      background: #ef4444;
      color: white;
      padding: 0.375rem 0.875rem;
      border-radius: 30px;
      font-size: 0.875rem;
      font-weight: 600;
      box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: 0.8;
      }
    }

    .modal-body {
      padding: 2rem;
      background-color: var(--background);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .pet-modal-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
      align-items: start;
      flex: 1 1 auto;
    }

    @media (min-width: 768px) {
      .pet-modal-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .pet-image-container {
      space-y: 1rem;
    }

    .image-carousel-container {
      position: relative;
      width: 100%;
      border-radius: 12px;
      overflow: hidden;
    }

    .pet-modal-image {
      width: 100%;
      height: 400px;
      object-fit: cover;
      border-radius: 12px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      position: relative;
      display: block;
    }

    .carousel-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.95);
      color: #fe7701;
      border: none;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      z-index: 10;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .carousel-arrow:hover {
      background: #fe7701;
      color: white;
      transform: translateY(-50%) scale(1.1);
      box-shadow: 0 10px 15px -3px rgba(147, 51, 234, 0.3), 0 4px 6px -2px rgba(147, 51, 234, 0.2);
    }

    .carousel-arrow:active {
      transform: translateY(-50%) scale(0.95);
    }

    .carousel-arrow-left {
      left: 16px;
    }

    .carousel-arrow-right {
      right: 16px;
    }

    .image-counter {
      position: absolute;
      bottom: 16px;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(255, 255, 255, 0.95);
      color: #1f2937;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.875rem;
      font-weight: 600;
      z-index: 10;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .thumbnail-strip {
      display: flex;
      gap: 10px;
      margin-top: 16px;
      overflow-x: auto;
      padding: 8px 4px;
      scrollbar-width: thin;
      scrollbar-color: #fe7701 #f3f4f6;
    }

    .thumbnail-strip::-webkit-scrollbar {
      height: 6px;
    }

    .thumbnail-strip::-webkit-scrollbar-track {
      background: #f3f4f6;
      border-radius: 10px;
    }

    .thumbnail-strip::-webkit-scrollbar-thumb {
      background: #fe7701;
      border-radius: 10px;
    }

    .thumbnail-strip::-webkit-scrollbar-thumb:hover {
      background: #7e22ce;
    }

    .thumbnail {
      width: 90px;
      height: 70px;
      object-fit: cover;
      border-radius: 8px;
      cursor: pointer;
      border: 3px solid transparent;
      transition: all 0.3s ease;
      flex-shrink: 0;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    .thumbnail:hover {
      border-color: #fe7701;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px -1px rgba(147, 51, 234, 0.2);
    }

    .thumbnail.active {
      border-color: #fe7701;
      box-shadow: 0 0 0 2px #fe7701, 0 4px 6px -1px rgba(147, 51, 234, 0.3);
      transform: scale(1.05);
    }

    .pet-image-badge {
      position: absolute;
      top: 1rem;
      left: 1rem;
      background: var(--primary);
      color: var(--primary-foreground);
      padding: 0.5rem 0.75rem;
      border-radius: var(--radius);
      font-size: 0.75rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.25rem;
    }

    .quick-stats {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
      margin-top: 1rem;
    }

    .quick-stat-card {
      background: var(--muted);
      padding: 0.75rem;
      border-radius: var(--radius);
      display: flex;
      align-items: center;
      gap: 0.5rem;
      border: 1px solid var(--border);
    }

    .stat-icon {
      width: 1rem;
      height: 1rem;
      color: var(--primary);
    }

    .stat-content {
      display: flex;
      flex-direction: column;
    }

    .stat-label {
      font-size: 0.75rem;
      color: var(--muted-foreground);
    }

    .stat-value {
      font-weight: 600;
      color: var(--foreground);
    }

    .about-section {
      margin-bottom: 2.5rem;
    }

    .about-section h2 {
      font-size: 1.1rem;
      font-weight: 600;
      color: #18181b;
      margin: 0 0 1rem 0;
    }

    .about-text {
      color: #18181b;
      line-height: 1.6;
      margin-bottom: 1rem;
      font-size: 0.85rem;
    }

    .characteristics-section h3 {
      font-weight: 600;
      color: #18181b;
      margin: 0 0 1rem 0;
      font-size: 1.1rem;
    }

    .characteristics-grid {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .characteristic-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: none;
      padding: 0.1rem 0;
      border-radius: 0;
      border: none;
    }

    .characteristic-left {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .characteristic-icon {
      width: 1rem;
      height: 1rem;
      color: var(--muted-foreground);
    }

    .characteristic-label {
      font-size: 0.85rem;
      color: var(--foreground);
    }

    .characteristic-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      font-size: 1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .characteristic-value {
      font-size: 0.85rem;
      color: var(--foreground);
      font-weight: 500;
    }

    .badge-yes {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
      color: white;
    }

    .badge-yes:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 8px rgba(34, 197, 94, 0.3);
    }

    .badge-no {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
    }

    .badge-no:hover {
      transform: scale(1.1);
      box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }

    .modal-actions {
      display: flex;
      gap: 0.75rem;
      margin-top: 6.6rem;
    }

    .btn-adopt, .btn-contact {
      flex: 1;
      padding: 1rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.2s;
      border: none;
      cursor: pointer;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-adopt {
      background: #fe7701;
      color: white;
    }

    .btn-adopt:hover {
      background: #c1431d;
      color: white;
      transform: translateY(-1px);
    }

    .btn-contact {
      background: transparent;
      color: #000;
      border: 1px solid #000;
    }

    .btn-contact:hover {
      background: #000;
      color: white;
      border-color: #000;
    }

    .smooth-scroll {
      scroll-behavior: smooth;
    }

    /* Responsive Layout System */
    .container {
      width: var(--container-width);
      margin: 0 auto;
      padding: var(--spacing-md);
      box-sizing: border-box;
    }

    /* Responsive typography */
    html {
      font-size: 16px;
    }

    @media (max-width: 480px) {
      html {
        font-size: 14px;
      }
      .nav {
        flex-direction: column;
        gap: var(--spacing-xs);
        position: fixed;
        top: var(--header-height);
        left: 0;
        right: 0;
        background: var(--background);
        padding: var(--spacing-sm);
        transform: translateY(-100%);
        transition: transform 0.3s ease;
      }
      .nav.active {
        transform: translateY(0);
      }
      .logo {
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .logo img {
        max-height: 1.5rem;
        width: auto;
      }
      .pet-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--spacing-sm);
      }
      .modal-content {
        width: 95%;
        margin: var(--spacing-xs);
      }
    }

    @media (min-width: 481px) and (max-width: 768px) {
      .pet-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: var(--spacing-sm);
      }
      .modal-content {
        width: 90%;
      }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
      .pet-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: var(--spacing-sm);
      }
    }

    @media (min-width: 1025px) {
      html {
        font-size: 14px;
      }
      .pet-grid {
        grid-template-columns: repeat(5, 1fr);
        gap: var(--spacing-sm);
      }
    }

    /* Make images responsive */
    img {
      max-width: 100%;
      height: auto;
      display: block;
    }

    /* Flexible boxes and grids */
    .flex-container {
      display: flex;
      flex-wrap: wrap;
      gap: var(--spacing-md);
    }

    .grid-container {
      display: grid;
      gap: var(--spacing-md);
      width: 100%;
    }

    /* Touch-friendly interactions */
    @media (hover: none) {
      .btn, .nav-link, .card {
        min-height: 44px;
        min-width: 44px;
        padding: var(--spacing-sm) var(--spacing-md);
      }
    }

    /* Print styles */
    @media print {
      .no-print {
        display: none;
      }
      body {
        font-size: 12pt;
      }
    }



    /* Mobile Menu Styles */
    .menu-toggle {
      display: none;
      background: none;
      border: none;
      color: var(--foreground);
      cursor: pointer;
      padding: var(--spacing-sm);
      margin-left: auto;
    }

    @media (max-width: 480px) {
      .menu-toggle {
        display: block;
      }
      .menu-toggle svg {
        width: 24px;
        height: 24px;
      }
    }
  </style>
</head>

<body>
  <!-- Header -->
  @include('components.header')

  <style>
    /* Mild zoom effect for hero images */
    .hero-zoom {
      transition: transform 0.35s ease, box-shadow 0.35s ease;
      transform-origin: center;
      will-change: transform;
    }
    .hero-zoom:hover,
    .hero-zoom:focus {
      transform: scale(1.04);
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }
    /* Disable hover scale on small screens for layout stability */
    @media (max-width: 768px) {
      .hero-zoom { transform: none; }
    }
  </style>

  <div class="gradient-bg">
    <!-- Hero Section -->
    <section id="home-section" class="hero-section">
      <div class="hero-grid">
        <div class="hero-content">
          <h1>
            <span class="line1">Give a Life a</span><br>
            <span class="line2">Second Chance</span><br>
            <span class="subtitle">– Adopt Today</span>
          </h1>
          <p>
            Thousands of pets face euthanasia each year due to overcrowded shelters and lack of adopters. By
            adopting, you can save a life, reduce shelter overcrowding, and bring love into your home. Browse pets
            at risk, fill out an adoption application, and make a lasting difference today.
          </p>
          <div class="hero-buttons">
            <a href="#pets-section" class="btn-primary" onclick="smoothScroll(event, '#pets-section')">Start Adopting Today</a>
            <a href="{{ url('/learn-more') }}" class="btn-outline">Learn More</a>
          </div>
        </div>

        <!-- Hero Images Grid -->
        <div class="hero-images">
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <img class="hero-zoom" src="{{ asset('images/biyaya top left.png') }}" alt="Top Left" style="height: 220px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='{{ asset('images/placeholder-pet.jpg') }}'">
            <img class="hero-zoom" src="{{ asset('images/biyaya bottom left.png') }}" alt="Top Right" style="height: 150px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='{{ asset('images/placeholder-pet.jpg') }}'">
          </div>
          <div style="display: flex; flex-direction: column; gap: 1rem; padding-top: 2rem;">
            <img class="hero-zoom" src="{{ asset('images/biyaya top right.png') }}" alt="Bottom Left" style="height: 150px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='{{ asset('images/placeholder-pet.jpg') }}'">
            <img class="hero-zoom" src="{{ asset('images/biyaya bottom right.png') }}" alt="Bottom Right" style="height: 220px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='{{ asset('images/placeholder-pet.jpg') }}'">
          </div>
        </div>
      </div>
    </section>

    <!-- Available Pets Section -->
    <section id="pets-section" class="pets-section">
      <div class="pets-container">
        <div class="section-header">
          <h2>Meet Our Available Pets</h2>
          <p>
            Each of these wonderful animals is looking for a loving home. Use the filters below to<br>
            find pets that match what you're looking for.
          </p>
        </div>

        <!-- Filters -->
        <div class="filters">
          <h3>🔍 Find Your Perfect Companion</h3>
          <div class="filter-grid">
            <select id="location-filter" class="filter-select" onchange="filterPets()">
              <option value="">All Locations</option>
              @php
                // Combine static NCR cities with dynamic extracted cities from shelters
                $ncrCities = collect([
                  'Caloocan', 'Las Piñas', 'Makati', 'Malabon', 'Mandaluyong', 'Manila',
                  'Marikina', 'Muntinlupa', 'Navotas', 'Parañaque', 'Pasay', 'Pasig',
                  'Quezon City', 'San Juan', 'Taguig', 'Valenzuela'
                ]);
                
                $dynamicCities = isset($extractedCities) ? $extractedCities : collect();
                $allLocations = $ncrCities->merge($dynamicCities)->unique()->sort()->values();
              @endphp
              
              @foreach($allLocations as $location)
                <option value="{{ $location }}">{{ $location }}</option>
              @endforeach
            </select>
            <select id="type-filter" class="filter-select" onchange="filterPets()">
              <option value="">All Types</option>
              <option value="dog">Dogs</option>
              <option value="cat">Cats</option>
            </select>
            <select id="age-filter" class="filter-select" onchange="filterPets()">
              <option value="">All Ages</option>
              <option value="puppy">Kitten/Puppy</option>
              <option value="adult">Adult</option>
              <option value="senior">Senior</option>
            </select>
            <select id="size-filter" class="filter-select" onchange="filterPets()">
              <option value="">All Sizes</option>
              <option value="small">Small</option>
              <option value="medium">Medium</option>
              <option value="large">Large</option>
            </select>
          </div>
        </div>

        <!-- Pet Cards Grid -->
        <div id="pets-grid" class="pets-grid">
          <!-- Pet cards will be generated here -->
        </div>
      </div>
    </section>
  </div>

  <script>
    // Dynamic pet data from database
    const pets = @json($pets ?? []);
    
    // Debug: Log pets data on page load
    console.log('Pets data loaded:', pets);
    console.log('Number of pets:', pets.length);

    function renderPets(petsToRender = pets) {
      const grid = document.getElementById('pets-grid');
      grid.innerHTML = '';
      
      if (petsToRender.length === 0) {
        grid.innerHTML = '<div class="no-pets-message" style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #6b7280; font-size: 1.1rem;">No pets match your current filters. Try adjusting your search criteria.</div>';
        return;
      }
      
      petsToRender.forEach(pet => {
        const petEmoji = pet.type.toLowerCase() === 'dog' ? '🐕' : '🐱';
        const petCard = document.createElement('div');
        petCard.className = 'pet-card';
        petCard.innerHTML = `
          <div class="pet-image">
            <img src="${pet.image || ''}" alt="${pet.name}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
            <div class="emoji-fallback" style="width: 100%; height: 200px; background: linear-gradient(135deg, #f3e8ff, #e0e7ff); display: none; align-items: center; justify-content: center; font-size: 4rem; border-radius: 0;">${petEmoji}</div>
            ${pet.urgent ? `<div class="urgent-badge">🚨 URGENT (${Math.floor(pet.days_in_shelter)} days)</div>` : ''}
          </div>
          <div class="pet-info">
            <div class="pet-header">
              <h4 class="pet-name">${pet.name}</h4>
              <span class="pet-type">${pet.type.charAt(0).toUpperCase() + pet.type.slice(1)}</span>
            </div>
            <p class="pet-details">
              ${[pet.breed, pet.age, pet.size].filter(Boolean).join(' • ')}
            </p>
            ${pet.location ? `<div class="pet-location" style="font-size: 0.85rem; color: #c1431d; margin-top: 0.5rem;">📍 ${pet.location}</div>` : ''}
            ${pet.description ? `<p class="pet-description">${pet.description}</p>` : ''}
            <button class="meet-btn" onclick="meetPet(${pet.id})">Meet ${pet.name}</button>
          </div>
        `;
        grid.appendChild(petCard);
      });
    }

    function filterPets() {
      const locationFilter = document.getElementById('location-filter').value;
      const typeFilter = document.getElementById('type-filter').value;
      const ageFilter = document.getElementById('age-filter').value;
      const sizeFilter = document.getElementById('size-filter').value;

      const filteredPets = pets.filter(pet => {
        // Match if pet's location starts with selected city (e.g., "Taguig" matches "Taguig Shelter")
        const matchesLocation = !locationFilter || (pet.location && pet.location.toLowerCase().startsWith(locationFilter.toLowerCase()));
        const matchesType = !typeFilter || pet.type.toLowerCase() === typeFilter;
        const matchesAge = !ageFilter || pet.age_filter_category === ageFilter; // Use age_filter_category for filtering
        const matchesSize = !sizeFilter || (pet.size && pet.size.toLowerCase() === sizeFilter);

        return matchesLocation && matchesType && matchesAge && matchesSize;
      });

      renderPets(filteredPets);
    }

    function meetPet(id) {
      console.log('meetPet called with id:', id);
      console.log('Available pets array:', pets);
      
      // Find the pet data - make sure we're comparing the right types
      const pet = pets.find(p => p.id == id); // Use == instead of === to handle type differences
      console.log('Found pet:', pet);
      
      if (!pet) {
        console.error('Pet not found with id:', id);
        customAlert('Pet not found! ID: ' + id, 'warning');
        return;
      }
      
      try {
        // Populate modal with pet data
        document.getElementById('modalHeaderName').textContent = `Meet ${pet.name}`;
        document.getElementById('modalHeaderBadge').textContent = pet.type.charAt(0).toUpperCase() + pet.type.slice(1);
        
        // Handle image gallery
        const modalImage = document.getElementById('modalImage');
        window.currentPetImages = pet.image_gallery || (pet.image ? [pet.image] : []);
        window.currentImageIndex = 0;
        
        console.log('Pet image_gallery:', pet.image_gallery);
        console.log('window.currentPetImages:', window.currentPetImages);
        console.log('Length:', window.currentPetImages.length);
        
        if (modalImage && window.currentPetImages.length > 0) {
          modalImage.src = window.currentPetImages[0];
          modalImage.alt = pet.name;
          
          // Show/hide carousel controls
          const prevBtn = document.getElementById('prevImageBtn');
          const nextBtn = document.getElementById('nextImageBtn');
          const counter = document.getElementById('imageCounter');
          const thumbnailStrip = document.getElementById('thumbnailStrip');
          
          console.log('prevBtn:', prevBtn);
          console.log('nextBtn:', nextBtn);
          console.log('Images length:', window.currentPetImages.length);
          
          if (window.currentPetImages.length > 1) {
            console.log('Showing carousel controls...');
            if (prevBtn) {
              prevBtn.style.display = 'flex';
              console.log('PrevBtn display set to flex');
            }
            if (nextBtn) {
              nextBtn.style.display = 'flex';
              console.log('NextBtn display set to flex');
            }
            if (counter) counter.style.display = 'block';
            if (thumbnailStrip) thumbnailStrip.style.display = 'flex';
            
            const totalImagesEl = document.getElementById('totalImages');
            if (totalImagesEl) totalImagesEl.textContent = window.currentPetImages.length;
            updateImageCounter();
            renderThumbnails();
          } else {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            if (counter) counter.style.display = 'none';
            if (thumbnailStrip) thumbnailStrip.style.display = 'none';
          }
        }
        
        document.getElementById('aboutPetName').textContent = pet.name;
        document.getElementById('modalDescription').textContent = pet.description || 'No description available';
        document.getElementById('modalAdoptName').textContent = pet.name;

        // Update adopt link with pet name
        const adoptLink = document.getElementById('adoptLink');
        if (adoptLink) {
          adoptLink.href = `/adopt?pet=${encodeURIComponent(pet.name)}`;
        }
        
        // Update health badges safely
        const vaccinated = document.getElementById('modalVaccinated');
        if (vaccinated) {
          vaccinated.innerHTML = pet.is_vaccinated ? '✓' : '✕';
          vaccinated.className = `characteristic-badge ${pet.is_vaccinated ? 'badge-yes' : 'badge-no'}`;
        }
        
        const spayedNeutered = document.getElementById('modalSpayedNeutered');
        if (spayedNeutered) {
          spayedNeutered.innerHTML = pet.is_neutered ? '✓' : '✕';
          spayedNeutered.className = `characteristic-badge ${pet.is_neutered ? 'badge-yes' : 'badge-no'}`;
        }
        
        const dewormed = document.getElementById('modalDewormed');
        if (dewormed) {
          dewormed.innerHTML = pet.is_dewormed ? '✓' : '✕';
          dewormed.className = `characteristic-badge ${pet.is_dewormed ? 'badge-yes' : 'badge-no'}`;
        }
        
        const preventiveMedication = document.getElementById('modalPreventiveMedication');
        if (preventiveMedication) {
          preventiveMedication.innerHTML = pet.on_preventive_medication ? '✓' : '✕';
          preventiveMedication.className = `characteristic-badge ${pet.on_preventive_medication ? 'badge-yes' : 'badge-no'}`;
        }
        
        const specialMedicalNeeds = document.getElementById('modalSpecialMedicalNeeds');
        if (specialMedicalNeeds) {
          specialMedicalNeeds.innerHTML = pet.has_special_medical_needs ? '✓' : '✕';
          specialMedicalNeeds.className = `characteristic-badge ${pet.has_special_medical_needs ? 'badge-yes' : 'badge-no'}`;
        }
        
        const mobilityImpaired = document.getElementById('modalMobilityImpaired');
        if (mobilityImpaired) {
          mobilityImpaired.innerHTML = pet.is_mobility_impaired ? '✓' : '✕';
          mobilityImpaired.className = `characteristic-badge ${pet.is_mobility_impaired ? 'badge-yes' : 'badge-no'}`;
        }
        
        const undergoingTreatment = document.getElementById('modalUndergoingTreatment');
        if (undergoingTreatment) {
          undergoingTreatment.innerHTML = pet.is_undergoing_treatment ? '✓' : '✕';
          undergoingTreatment.className = `characteristic-badge ${pet.is_undergoing_treatment ? 'badge-yes' : 'badge-no'}`;
        }
        
        // Show/hide urgent badge based on pet's urgent property
        const urgentBadge = document.getElementById('modalUrgentBadge');
        if (urgentBadge) {
          if (pet.urgent) {
            urgentBadge.style.display = 'block';
            urgentBadge.textContent = `🚨 URGENT (${Math.floor(pet.days_in_shelter || 0)} days)`;
          } else {
            urgentBadge.style.display = 'none';
          }
        }
        
        // Show modal
        console.log('Opening modal...');
        document.getElementById('petModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // Attach close event every time modal is opened
        const closeBtn = document.querySelector('.modal-close');
        if (closeBtn) {
          closeBtn.onclick = function() {
            document.getElementById('petModal').style.display = 'none';
            document.body.style.overflow = 'auto';
          };
        }
        
        console.log('Modal should be visible now');
        
      } catch (error) {
        console.error('Error in meetPet function:', error);
        customAlert('Error opening pet details: ' + error.message, 'danger');
      }
    }

    function smoothScroll(event, target) {
      event.preventDefault();
      document.querySelector(target).scrollIntoView({
        behavior: 'smooth'
      });
    }

    // Image carousel functions
    window.currentPetImages = [];
    window.currentImageIndex = 0;

    function nextImage() {
      if (window.currentPetImages.length <= 1) return;
      window.currentImageIndex = (window.currentImageIndex + 1) % window.currentPetImages.length;
      updateCarouselImage();
    }

    function previousImage() {
      if (window.currentPetImages.length <= 1) return;
      window.currentImageIndex = (window.currentImageIndex - 1 + window.currentPetImages.length) % window.currentPetImages.length;
      updateCarouselImage();
    }

    function goToImage(index) {
      window.currentImageIndex = index;
      updateCarouselImage();
    }

    function updateCarouselImage() {
      const modalImage = document.getElementById('modalImage');
      if (modalImage && window.currentPetImages.length > 0) {
        modalImage.src = window.currentPetImages[window.currentImageIndex];
        updateImageCounter();
        updateThumbnails();
      }
    }

    function updateImageCounter() {
      const currentIndexEl = document.getElementById('currentImageIndex');
      if (currentIndexEl) {
        currentIndexEl.textContent = window.currentImageIndex + 1;
      }
    }

    function renderThumbnails() {
      const thumbnailStrip = document.getElementById('thumbnailStrip');
      if (!thumbnailStrip) return;
      
      thumbnailStrip.innerHTML = '';
      
      window.currentPetImages.forEach((imgSrc, index) => {
        const thumb = document.createElement('img');
        thumb.src = imgSrc;
        thumb.className = 'thumbnail' + (index === 0 ? ' active' : '');
        thumb.onclick = () => goToImage(index);
        thumbnailStrip.appendChild(thumb);
      });
    }

    function updateThumbnails() {
      const thumbnails = document.querySelectorAll('.thumbnail');
      thumbnails.forEach((thumb, index) => {
        if (index === window.currentImageIndex) {
          thumb.classList.add('active');
        } else {
          thumb.classList.remove('active');
        }
      });
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      renderPets();
      
      // Modal functionality
      document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('petModal');
        const closeBtn = document.querySelector('.modal-close');
        if (closeBtn) {
          closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
          });
        }
        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
          if (event.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
          }
        });
      });
      
      // Close modal with Escape key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
          modal.style.display = 'none';
          document.body.style.overflow = 'auto';
        }
      });
      
      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });
      
      // Handle scroll down detection
      let lastScrollTop = 0;
      const navLinks = document.querySelectorAll('nav a');
      
      window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const petsSection = document.querySelector('#pets-section');
        
        if (!petsSection) return;
        
        const petsSectionTop = petsSection.offsetTop;
        
        // If user scrolls down past the hero section, make Find Pets bold
        if (scrollTop > petsSectionTop - window.innerHeight * 0.5) {
          navLinks.forEach(l => l.classList.remove('active'));
          const findPetsLink = document.querySelector('a[href="#pets-section"]');
          if (findPetsLink) findPetsLink.classList.add('active');
        } else if (scrollTop < petsSectionTop - window.innerHeight * 0.7) {
          // If scrolled back up to near the top, make Home bold
          navLinks.forEach(l => l.classList.remove('active'));
          const homeLink = document.querySelector('a[href="#home-section"]');
          if (homeLink) homeLink.classList.add('active');
        }
        
        lastScrollTop = scrollTop;
      });
    });
  </script>

  <!-- Pet Details Modal -->
  <div id="petModal" class="modal">
    <div class="modal-content">
      <!-- Header -->
      <div class="modal-header">
        <button class="modal-close">&times;</button>
        <h1 id="modalHeaderName">Meet Duke</h1>
        <div>
          <span id="modalHeaderBadge" class="modal-header-badge">Dog</span>
          <span style="color: #6b7280;">• Available for adoption</span>
        </div>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <div class="pet-modal-grid">
          <!-- Pet Image Section -->
          <div class="pet-image-container">
            <div style="position: relative;">
              <!-- Image Carousel -->
              <div class="image-carousel-container">
                <img id="modalImage" class="pet-modal-image" src="" alt="">
                
                <!-- Navigation Arrows -->
                <button id="prevImageBtn" class="carousel-arrow carousel-arrow-left" onclick="previousImage()" style="display: none;">
                  <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                  </svg>
                </button>
                <button id="nextImageBtn" class="carousel-arrow carousel-arrow-right" onclick="nextImage()" style="display: none;">
                  <svg width="24" height="24" fill="none" stroke="#fff" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </button>
                
                <!-- Image Counter -->
                <div id="imageCounter" class="image-counter" style="display: none;">
                  <span id="currentImageIndex">1</span>/<span id="totalImages">1</span>
                </div>
              </div>
              
              <div id="modalUrgentBadge" class="urgent-badge" style="position: absolute; top: 1rem; left: 1rem; display: none;">
                🚨 Urgent: Adopt this week
              </div>
              
              <!-- Thumbnail Strip -->
              <div id="thumbnailStrip" class="thumbnail-strip" style="display: none;">
              </div>
            </div>
            
          </div>

          <!-- Pet Details Section -->
          <div>
            <!-- About Section -->
            <div class="about-section">
              <h2>About <span id="aboutPetName">Duke</span></h2>
              <p id="modalDescription" class="about-text">
                Duke was found in Plaza City and has been here 30 days. This happy pup's goofy energy will bring joy to any home.
              </p>
            </div>

            <!-- Health -->
            <div class="characteristics-section" style="margin-bottom: 1.5rem;">
              <h3>Health</h3>
              <div class="characteristics-grid">
                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span class="characteristic-label">Vaccinated</span>
                  </div>
                  <span id="modalVaccinated" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a3.5 3.5 0 117 0H19M9 10v.5A3.5 3.5 0 005.5 14v0A3.5 3.5 0 009 10.5M19 10v.5a3.5 3.5 0 01-3.5 3.5v0a3.5 3.5 0 01-3.5-3.5V10"></path>
                    </svg>
                    <span class="characteristic-label">Spayed/Neutered</span>
                  </div>
                  <span id="modalSpayedNeutered" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    <span class="characteristic-label">Dewormed</span>
                  </div>
                  <span id="modalDewormed" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <span class="characteristic-label">On Preventive Medication</span>
                  </div>
                  <span id="modalPreventiveMedication" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="characteristic-label">Has Special Medical Needs</span>
                  </div>
                  <span id="modalSpecialMedicalNeeds" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                    <span class="characteristic-label">Disabled / Mobility Impaired</span>
                  </div>
                  <span id="modalMobilityImpaired" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span class="characteristic-label">Undergoing Treatment</span>
                  </div>
                  <span id="modalUndergoingTreatment" class="characteristic-badge badge-no">No</span>
                </div>

              </div>
            </div>

            <!-- Action Buttons -->
            <div class="modal-actions" style="margin-top:auto; padding-top:0.5rem;">
              <a href="{{ url('/adopt') }}" class="btn-adopt" id="adoptLink">
                ❤️ Adopt <span id="modalAdoptName">Duke</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('components.footer')

  

  <!-- Custom Modal Component -->
  @include('components.custom-modal')

<!-- Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js-na2.hs-scripts.com/244156819.js"></script>
<!-- End of HubSpot Embed Code -->
</body>
</html>
