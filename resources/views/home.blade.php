
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
        <div class="pet-modal-grid">
          <!-- Pet Image Section -->
          <div class="pet-image-container">
            <div style="position: relative;">
              <img id="modalImage" class="pet-modal-image" src="" alt="">
              <div id="modalUrgentBadge" class="urgent-badge" style="position: absolute; top: 1rem; left: 1rem; display: none;">
                🚨 Urgent: Adopt this week
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
              <h3>Characteristics</h3>
              <div class="characteristics-grid">
                <!-- Location characteristic removed as requested -->

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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="characteristic-label">Good with kids</span>
                  </div>
                  <span id="modalGoodWithKids" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="characteristic-label">Good with other pets</span>
                  </div>
                  <span id="modalGoodWithPets" class="characteristic-badge badge-no">No</span>
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
      color: #9333ea;
      font-weight: 600;
    }

    /* Main Content Styles */
    .gradient-bg {
      background: linear-gradient(to bottom, #f3e8ff, #faf5ff);
      min-height: 100vh;
    }

    .hero-section {
      padding: 6rem 1rem;
      background: #f5f6ff;
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
      background: #9333ea;
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
      background: #7c3aed;
      color: white;
      text-decoration: none;
    }

    .btn-outline {
      background: transparent;
      color: #9333ea;
      padding: 0.625rem 1.5rem;
      border: 1px solid #9333ea;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s;
      font-size: 0.875rem;
    }

    .btn-outline:hover {
      background: #9333ea;
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
      background: linear-gradient(135deg, #f3e8ff, #f5f6ff);
      display: block;
      min-height: 130px;
    }

    .hero-images img[src=""], 
    .hero-images img:not([src]) {
      background: linear-gradient(135deg, #f3e8ff, #f5f6ff);
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
      background: #9333ea;
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
      background: #374151;
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

    .pet-modal-image {
      width: 100%;
      height: 400px;
      object-fit: cover;
      border-radius: 0.5rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      position: relative;
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
      gap: 0.9rem;
    }

    .characteristic-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: none;
      padding: 0.2rem 0;
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
      padding: 0.2rem 0.7rem;
      border-radius: 999px;
      font-size: 0.7rem;
      font-weight: 500;
    }

    .characteristic-value {
      font-size: 0.85rem;
      color: var(--foreground);
      font-weight: 500;
    }

    .badge-yes {
      background: #10b981;
      color: white;
    }

    .badge-no {
      background: #ef4444;
      color: white;
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
      background: #000;
      color: white;
    }

    .btn-adopt:hover {
      background: #374151;
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
      .header {
        padding: var(--spacing-xs);
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
      .header-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 0 var(--spacing-sm);
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
      .header-content {
        padding: 0 var(--spacing-sm);
      }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
      .pet-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: var(--spacing-sm);
      }
      .header-content {
        padding: 0 var(--spacing-md);
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
      .header-content {
        padding: 0 var(--spacing-lg);
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
            <img src="images/senior-dog-with-gray-muzzle-loyal-expression.jpg" alt="Rocky - Senior Dog" style="height: 200px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='images/placeholder-pet.jpg'">
            <img src="images/orange-and-white-kitten-playful-expression.png" alt="Orange and White Kitten" style="height: 130px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);" onerror="this.src='images/placeholder-pet.jpg'">
          </div>
          <div style="display: flex; flex-direction: column; gap: 1rem; padding-top: 2rem;">
            <img src="images/golden-retriever-puppy-happy-face.png" alt="Golden Retriever Puppy" style="height: 130px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <img src="images/tabby-cat-with-green-eyes-alert.png" alt="Milo - Tabby Cat" style="height: 200px; object-fit: cover; border-radius: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
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
              <option value="Caloocan">Caloocan</option>
              <option value="Las Piñas">Las Piñas</option>
              <option value="Makati">Makati</option>
              <option value="Malabon">Malabon</option>
              <option value="Mandaluyong">Mandaluyong</option>
              <option value="Manila">Manila</option>
              <option value="Marikina">Marikina</option>
              <option value="Muntinlupa">Muntinlupa</option>
              <option value="Navotas">Navotas</option>
              <option value="Parañaque">Parañaque</option>
              <option value="Pasay">Pasay</option>
              <option value="Pasig">Pasig</option>
              <option value="Quezon City">Quezon City</option>
              <option value="San Juan">San Juan</option>
              <option value="Taguig">Taguig</option>
              <option value="Valenzuela">Valenzuela</option>
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
            <img src="${pet.image}" alt="${pet.name}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
            <div class="emoji-fallback" style="width: 100%; height: 200px; background: linear-gradient(135deg, #f3e8ff, #e0e7ff); display: none; align-items: center; justify-content: center; font-size: 4rem; border-radius: 0;">${petEmoji}</div>
            ${pet.urgent ? `<div class="urgent-badge">🚨 URGENT (${Math.floor(pet.days_in_shelter)} days)</div>` : ''}
          </div>
          <div class="pet-info">
            <div class="pet-header">
              <h4 class="pet-name">${pet.name}</h4>
              <span class="pet-type">${pet.type.charAt(0).toUpperCase() + pet.type.slice(1)}</span>
            </div>
            <p class="pet-details">
              ${pet.age.charAt(0).toUpperCase() + pet.age.slice(1)} • ${pet.size.charAt(0).toUpperCase() + pet.size.slice(1)} • ${pet.location}
            </p>
            <p class="pet-description">${pet.description}</p>
            <div class="pet-extra-info" style="font-size: 0.85rem; color: #6b7280; margin: 0.5rem 0;">
              ${pet.days_in_shelter > 0 ? `${Math.floor(pet.days_in_shelter)} days in shelter` : 'New arrival'}
              ${pet.breed ? ` • ${pet.breed}` : ''}
            </div>
            <button class="meet-btn" onclick="meetPet(${pet.id}, '${pet.name}')">Meet ${pet.name}</button>
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
        const matchesLocation = !locationFilter || pet.location === locationFilter;
        const matchesType = !typeFilter || pet.type.toLowerCase() === typeFilter;
        const matchesAge = !ageFilter || pet.age.toLowerCase() === ageFilter;
        const matchesSize = !sizeFilter || pet.size.toLowerCase() === sizeFilter;

        return matchesLocation && matchesType && matchesAge && matchesSize;
      });

      renderPets(filteredPets);
    }

    function meetPet(id, name) {
      // Find the pet data
      const pet = pets.find(p => p.id === id);
      if (!pet) return;
      
      // Populate modal with pet data
      document.getElementById('modalHeaderName').textContent = `Meet ${pet.name}`;
      document.getElementById('modalHeaderBadge').textContent = pet.type;
      document.getElementById('modalImage').src = pet.image;
      document.getElementById('modalImage').alt = pet.name;
      document.getElementById('aboutPetName').textContent = pet.name;
      document.getElementById('modalLocation').textContent = pet.location || 'Unknown';
      document.getElementById('modalDescription').textContent = pet.description;
      document.getElementById('modalAdoptName').textContent = pet.name;
      
      // Update adopt link with pet name
      const adoptLink = document.getElementById('adoptLink');
      adoptLink.href = `/adopt?pet=${encodeURIComponent(pet.name)}`;
      
      // Update characteristic badges
      const vaccinated = document.getElementById('modalVaccinated');
      vaccinated.textContent = pet.vaccinated ? 'Yes' : 'No';
      vaccinated.className = `characteristic-badge ${pet.vaccinated ? 'badge-yes' : 'badge-no'}`;
      
      const spayedNeutered = document.getElementById('modalSpayedNeutered');
      spayedNeutered.textContent = pet.spayed_neutered ? 'Yes' : 'No';
      spayedNeutered.className = `characteristic-badge ${pet.spayed_neutered ? 'badge-yes' : 'badge-no'}`;
      
      const goodWithKids = document.getElementById('modalGoodWithKids');
      goodWithKids.textContent = pet.good_with_kids ? 'Yes' : 'No';
      goodWithKids.className = `characteristic-badge ${pet.good_with_kids ? 'badge-yes' : 'badge-no'}`;
      
      const goodWithPets = document.getElementById('modalGoodWithPets');
      goodWithPets.textContent = pet.good_with_pets ? 'Yes' : 'No';
      goodWithPets.className = `characteristic-badge ${pet.good_with_pets ? 'badge-yes' : 'badge-no'}`;
      
      // Show/hide urgent badge based on pet's urgent property
      const urgentBadge = document.getElementById('modalUrgentBadge');
      if (pet.urgent) {
        urgentBadge.style.display = 'block';
        urgentBadge.textContent = `🚨 URGENT (${Math.floor(pet.days_in_shelter)} days)`;
      } else {
        urgentBadge.style.display = 'none';
      }
      
      // Show modal
      document.getElementById('petModal').style.display = 'block';
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
      // Attach close event every time modal is opened (robust for dynamic content)
      const closeBtn = document.querySelector('.modal-close');
      if (closeBtn) {
        closeBtn.onclick = function() {
          document.getElementById('petModal').style.display = 'none';
          document.body.style.overflow = 'auto';
        };
      }
    }

    function smoothScroll(event, target) {
      event.preventDefault();
      document.querySelector(target).scrollIntoView({
        behavior: 'smooth'
      });
    }

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      renderPets();
      
      // Mobile navigation
      const nav = document.querySelector('.nav');
      const toggleMenu = document.createElement('button');
      toggleMenu.classList.add('menu-toggle');
      toggleMenu.setAttribute('aria-label', 'Toggle navigation menu');
      toggleMenu.innerHTML = `
        <svg viewBox="0 0 24 24" width="24" height="24">
          <path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
        </svg>
      `;
      document.querySelector('.header-content').insertBefore(toggleMenu, nav);

      function checkScreenSize() {
        if (window.innerWidth <= 480) {
          toggleMenu.style.display = 'block';
          nav.style.display = nav.classList.contains('active') ? 'flex' : 'none';
        } else {
          toggleMenu.style.display = 'none';
          nav.style.display = 'flex';
          nav.classList.remove('active');
        }
      }

      toggleMenu.addEventListener('click', () => {
        nav.classList.toggle('active');
        nav.style.display = nav.classList.contains('active') ? 'flex' : 'none';
      });

      window.addEventListener('resize', checkScreenSize);
      checkScreenSize();
      
      // Handle navigation active states
      const navLinks = document.querySelectorAll('.nav-link');
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Remove active class from all nav links
          navLinks.forEach(l => l.classList.remove('active'));
          
          // Add active class to clicked link
          this.classList.add('active');
        });
      });
      
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
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Remove active class from all nav links
          navLinks.forEach(l => l.classList.remove('active'));
          
          // Add active class to clicked link
          this.classList.add('active');
        });
      });
      
      // Handle scroll spy for sections
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            navLinks.forEach(l => l.classList.remove('active'));
            const sectionId = entry.target.id;
            if (sectionId === 'home-section') {
              document.querySelector('a[href="#home-section"]').classList.add('active');
            } else if (sectionId === 'pets-section') {
              document.querySelector('a[href="#pets-section"]').classList.add('active');
            }
          }
        });
      }, { threshold: 0.1, rootMargin: '-10% 0px -10% 0px' });
      
      // Observe both sections
      const homeSection = document.querySelector('#home-section');
      const petsSection = document.querySelector('#pets-section');
      
      if (homeSection) {
        observer.observe(homeSection);
      }
      if (petsSection) {
        observer.observe(petsSection);
      }
      
      // Handle scroll down detection
      let lastScrollTop = 0;
      window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const petsSection = document.querySelector('#pets-section');
        const petsSectionTop = petsSection.offsetTop;
        
        // If user scrolls down past the hero section, make Find Pets bold
        if (scrollTop > petsSectionTop - window.innerHeight * 0.5) {
          navLinks.forEach(l => l.classList.remove('active'));
          document.querySelector('a[href="#pets-section"]').classList.add('active');
        } else if (scrollTop < petsSectionTop - window.innerHeight * 0.7) {
          // If scrolled back up to near the top, make Home bold
          navLinks.forEach(l => l.classList.remove('active'));
          document.querySelector('a[href="#home-section"]').classList.add('active');
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
              <img id="modalImage" class="pet-modal-image" src="" alt="">
              <div id="modalUrgentBadge" class="urgent-badge" style="position: absolute; top: 1rem; left: 1rem; display: none;">
                🚨 Urgent: Adopt this week
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
            <div class="characteristics-section" style="margin-bottom: 2.5rem;">
              <h3>Characteristics</h3>
              <div class="characteristics-grid">
                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="characteristic-label">Location</span>
                  </div>
                  <span id="modalLocation" class="characteristic-value">Plaza City</span>
                </div>

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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="characteristic-label">Good with kids</span>
                  </div>
                  <span id="modalGoodWithKids" class="characteristic-badge badge-no">No</span>
                </div>

                <div class="characteristic-item">
                  <div class="characteristic-left">
                    <svg class="characteristic-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="characteristic-label">Good with other pets</span>
                  </div>
                  <span id="modalGoodWithPets" class="characteristic-badge badge-no">No</span>
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
      </div>
    </div>
  </div>

  <footer class="text-white py-12 px-4 sm:px-6 lg:px-8" style="background-color: #2c0b47;">
      <div class="max-w-6xl mx-auto">
          <div class="grid md:grid-cols-4 gap-8">
              <div>
                        <div class="flex items-center mb-4">
                            <img src="images/PAWPAL LOGO.png" alt="PawPal Logo" class="h-8 w-auto mr-2">
                            <span class="text-xl font-bold">PawPal</span>
                        </div>
                  <p class="text-gray-400">Connecting loving families with pets in need of homes.</p>
              </div>
              <div>
                  <h3 class="font-semibold mb-4">Quick Links</h3>
                  <ul class="space-y-2 text-gray-400">
                      <li><a href="/" class="hover:text-white">Home</a></li>
                      <li><a href="/find-pets" class="hover:text-white">Find Pets</a></li>
                      <li><a href="/pet-matching" class="hover:text-white">Pet Matching</a></li>
                      <li><a href="/learn-more" class="hover:text-white">Learn More</a></li>
                  </ul>
              </div>
              <div>
                  <h3 class="font-semibold mb-4">Support</h3>
                  <ul class="space-y-2 text-gray-400">
                      <li><a href="/contact" class="hover:text-white">Contact Us</a></li>
                      <li><a href="/faq" class="hover:text-white">FAQ</a></li>
                      <li><a href="/volunteer" class="hover:text-white">Volunteer</a></li>
                      <li><a href="/donate" class="hover:text-white">Donate</a></li>
                  </ul>
              </div>
              <div>
                  <h3 class="font-semibold mb-4">Contact Info</h3>
                  <div class="space-y-2 text-gray-400">
                      <p>123 Pet Street</p>
                      <p>Animal City, AC 12345</p>
                      <p>(555) 123-PETS</p>
                      <p>info@pawpal.com</p>
                  </div>
              </div>
          </div>
          <hr class="my-8 border-gray-700">
          <div class="text-center text-gray-400">
              <p>&copy; 2024 PawPal. All rights reserved. Made with ❤️ for pets in need.</p>
          </div>
      </div>
  </footer>

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

</body>
</html>
