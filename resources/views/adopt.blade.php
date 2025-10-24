<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption Form</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* CSS Variables matching the provided design system */
    :root {
      --background: #ffffff;
      --foreground: #374151;
      --card: #ffffff;
      --card-foreground: #374151;
      --popover: #ffffff;
      --popover-foreground: #374151;
      --primary: #fe7701;
      --primary-foreground: #ffffff;
      --secondary: #ff9534;
      --secondary-foreground: #ffffff;
      --muted: #f9fafb;
      --muted-foreground: #6b7280;
      --accent: #fe7701;
      --accent-foreground: #ffffff;
      --destructive: #e63946;
      --destructive-foreground: #ffffff;
      --border: #e5e7eb;
      --input: #f9fafb;
      --ring: #fe7701;
      --radius: 0.5rem;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
      background: linear-gradient(135deg, #fff5eb 0%, #ffe8d6 100%);
      color: var(--foreground);
      line-height: 1.6;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    /* Paw prints background pattern */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: 
        radial-gradient(circle at 20% 30%, rgba(254, 119, 1, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(254, 119, 1, 0.03) 0%, transparent 50%);
      z-index: 0;
      pointer-events: none;
    }

    .paw-print {
      position: fixed;
      font-size: 2rem;
      opacity: 0.05;
      color: #fe7701;
      z-index: 0;
      pointer-events: none;
      animation: float 20s infinite ease-in-out;
    }

    .paw-1 { top: 10%; left: 10%; animation-delay: 0s; }
    .paw-2 { top: 20%; right: 15%; animation-delay: 2s; }
    .paw-3 { top: 40%; left: 5%; animation-delay: 4s; }
    .paw-4 { top: 60%; right: 10%; animation-delay: 6s; }
    .paw-5 { top: 80%; left: 20%; animation-delay: 8s; }
    .paw-6 { bottom: 10%; right: 20%; animation-delay: 10s; }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(5deg); }
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background-color: transparent;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      z-index: 1000;
    }

    .modal-card {
      width: 100%;
      max-width: 64rem;
      background-color: white;
      max-height: 90vh;
      overflow: hidden;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      position: relative;
      z-index: 1;
      animation: slideUp 0.5s ease-out;
      display: flex;
      flex-direction: column;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
      color: white;
      padding: 2rem;
      position: sticky;
      top: 0;
      z-index: 100;
      overflow: hidden;
      flex-shrink: 0;
      border-radius: 16px 16px 0 0;
    }

    .modal-header::before {
      content: '🐾';
      position: absolute;
      font-size: 8rem;
      opacity: 0.1;
      top: -1rem;
      right: -1rem;
      animation: pulse 3s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.1; }
      50% { transform: scale(1.05); opacity: 0.15; }
    }

    .header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
      position: relative;
      z-index: 1;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      font-weight: 500;
      transition: all 0.2s;
      cursor: pointer;
      text-decoration: none;
      border: none;
      font-size: 0.875rem;
    }

    .btn-ghost {
      background: rgba(255, 255, 255, 0.2);
      color: white;
      padding: 0.5rem;
      width: 40px;
      height: 40px;
      backdrop-filter: blur(10px);
    }

    .btn-ghost:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: translateY(-2px);
    }

    .btn-primary {
      background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
      color: white;
      padding: 0.75rem 1.5rem;
      gap: 0.5rem;
      box-shadow: 0 4px 12px rgba(254, 119, 1, 0.3);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #ff9534 0%, #fe7701 100%);
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(254, 119, 1, 0.4);
    }

    .btn-outline {
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid rgba(255, 255, 255, 0.3);
      color: white;
      padding: 0.75rem 1.5rem;
      gap: 0.5rem;
      backdrop-filter: blur(10px);
    }

    .btn-outline:hover {
      background: rgba(255, 255, 255, 0.3);
      border-color: rgba(255, 255, 255, 0.5);
      transform: translateY(-2px);
    }

    .modal-title {
      font-size: 2rem;
      font-weight: 700;
      color: white;
      margin: 0;
      position: relative;
      z-index: 1;
    }

    .step-info {
      color: rgba(255, 255, 255, 0.95);
      font-size: 1rem;
      position: relative;
      z-index: 1;
    }

    .progress-bar {
      width: 100%;
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 9999px;
      height: 0.5rem;
      overflow: hidden;
      position: relative;
      z-index: 1;
    }

    .progress-fill {
      height: 100%;
      background-color: white;
      transition: width 0.3s ease;
      border-radius: 9999px;
      box-shadow: 0 2px 8px rgba(255, 255, 255, 0.5);
    }

    .modal-content {
      padding: 2.5rem 2rem;
      background: white;
      flex: 1;
      overflow-y: auto;
    }

    .form-section {
      margin-bottom: 2rem;
    }

    .section-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 2rem;
      padding-bottom: 1rem;
      border-bottom: 2px solid #ffe8d6;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1f2937;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-grid {
      display: grid;
      gap: 3.5rem;
    }

    .form-grid-2 {
      grid-template-columns: 1fr;
      gap: 1rem;
    }

    @media (min-width: 768px) {
      .form-grid-2 {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
      }
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      margin-bottom: 0.5rem;
      margin-top: 0.5rem;
    }

    .form-grid.form-grid-2 {
      margin-bottom: 0.5rem;
      margin-top: 0.5rem;
    }

    .form-section > .form-group,
    .form-section > .form-grid {
      margin-bottom: 0.5rem;
      margin-top: 0.5rem;
    }

    /* Bring back larger spacing for Living Situation and Pet Care Experience */
    #step2 .form-group,
    #step2 .form-grid,
    #step3 .form-group,
    #step3 .form-grid {
      margin-bottom: 2rem !important;
      margin-top: 0.5rem !important;
    }

    .form-label {
      font-weight: 600;
      color: #374151;
      font-size: 0.875rem;
    }

    /* Style for required field asterisks */
    .required-asterisk {
      color: #fe7701;
      font-weight: bold;
    }

    .form-input, .form-textarea, .form-select {
      padding: 0.75rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      background-color: #f9fafb;
      color: var(--foreground);
      font-size: 0.875rem;
      transition: all 0.3s;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
      outline: none;
      border-color: #fe7701;
      background-color: white;
      box-shadow: 0 0 0 3px rgba(254, 119, 1, 0.1);
    }

    .form-input:hover, .form-textarea:hover, .form-select:hover {
      border-color: #fed7aa;
    }

    .form-textarea {
      resize: vertical;
      min-height: 80px;
    }

    .radio-group {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
      margin-top: 0.5rem;
    }

    .radio-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #f9fafb;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .radio-item:hover {
      background: white;
      border-color: #fed7aa;
      transform: translateX(4px);
    }

    .radio-item:has(input:checked) {
      background: #fff7ed;
      border-color: #fe7701;
      box-shadow: 0 2px 8px rgba(254, 119, 1, 0.1);
    }

    .radio-input {
      width: 1.25rem;
      height: 1.25rem;
      accent-color: #fe7701;
      cursor: pointer;
    }

    .radio-item label {
      cursor: pointer;
      flex: 1;
    }

    .upload-area {
      margin-top: 0.5rem;
      border: 2px dashed #fed7aa;
      border-radius: 12px;
      padding: 2rem;
      text-align: center;
      background-color: #f9fafb;
      cursor: pointer;
      transition: all 0.3s;
    }

    .upload-area:hover {
      border-color: #fe7701;
      background: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(254, 119, 1, 0.1);
    }

    .upload-icon {
      width: 2.5rem;
      height: 2.5rem;
      margin: 0 auto 0.5rem;
      color: #fe7701;
    }

    .footer-actions {
      display: flex;
      justify-content: space-between;
      padding: 1.5rem 2rem;
      background: #fffbf6;
      border-top: 2px solid #ffe8d6;
      border-radius: 0 0 16px 16px;
      margin-top: 2rem;
    }

    .icon {
      width: 1.25rem;
      height: 1.25rem;
      color: #fe7701;
    }

    .hidden {
      display: none;
    }

    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    .text-center {
      text-align: center;
    }

    .text-gray-600 {
      color: #6b7280;
    }

    .text-gray-500 {
      color: #9ca3af;
    }

    .text-sm {
      font-size: 0.875rem;
    }

    .text-xs {
      font-size: 0.75rem;
    }

    .mt-1 {
      margin-top: 0.25rem;
    }

    .mb-2 {
      margin-bottom: 0.5rem;
    }

    .mx-auto {
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>
<body>
  <!-- Floating paw prints -->
  <div class="paw-print paw-1">🐾</div>
  <div class="paw-print paw-2">🐾</div>
  <div class="paw-print paw-3">🐾</div>
  <div class="paw-print paw-4">🐾</div>
  <div class="paw-print paw-5">🐾</div>
  <div class="paw-print paw-6">🐾</div>

  <div class="modal-overlay" id="applicationModal">
    <div class="modal-card">
      <!-- Header -->
      <div class="modal-header">
        <div class="header-content">
          <div class="header-left">
            <button class="btn btn-ghost" onclick="goBack()">
              <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </button>
            <div>
              <h1 class="modal-title">Adopt <span id="petName">Bella</span></h1>
              <p class="step-info">Step <span id="currentStep">1</span> of 3</p>
            </div>
          </div>
          <button class="btn btn-ghost" onclick="closePage()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        
        <div class="progress-bar">
          <div class="progress-fill" id="progressBar" style="width: 33.33%;"></div>
        </div>
      </div>

      <!-- Form Content -->
      <div class="modal-content">
  <form id="adoptionForm" enctype="multipart/form-data">
          @csrf
          <!-- Hidden fields for pet information -->
          <input type="hidden" name="pet_id" id="petId">
          <input type="hidden" name="pet_type" id="petType">
          <input type="hidden" name="pet_breed" id="petBreed">
          <!-- Step 1: Personal Information -->
          <div class="step active" id="step1">
            <div class="form-section">
              <div class="section-header">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h3 class="section-title">Personal Information</h3>
              </div>

              <div class="form-grid form-grid-2">
                <div class="form-group">
                  <label for="firstName" class="form-label">First Name <span class="required-asterisk">*</span></label>
                  <input type="text" id="firstName" name="firstName" class="form-input" required>
                </div>
                <div class="form-group">
                  <label for="lastName" class="form-label">Last Name <span class="required-asterisk">*</span></label>
                  <input type="text" id="lastName" name="lastName" class="form-input" required>
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="form-label">Address <span class="required-asterisk">*</span></label>
                <input type="text" id="address" name="address" class="form-input" required>
              </div>

              <div class="form-grid form-grid-2">
                <div class="form-group">
                  <label for="phone" class="form-label">Phone <span class="required-asterisk">*</span></label>
                  <input type="tel" id="phone" name="phone" class="form-input" required>
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                  <input type="email" id="email" name="email" class="form-input" required>
                </div>
              </div>

              <div class="form-grid form-grid-2">
                <div class="form-group">
                  <label for="birthDate" class="form-label">Birth Date <span class="required-asterisk">*</span></label>
                  <input type="date" id="birthDate" name="birthDate" class="form-input" required>
                </div>
                <div class="form-group">
                  <label for="occupation" class="form-label">Occupation <span class="required-asterisk">*</span></label>
                  <input type="text" id="occupation" name="occupation" class="form-input" required>
                </div>
              </div>

              <div class="form-group">
                <label for="company" class="form-label">Company/Business Name</label>
                <input type="text" id="company" name="company" class="form-input" placeholder="N/A if unemployed">
              </div>

              <div class="form-grid form-grid-2">
                <div class="form-group">
                  <label for="socialMedia" class="form-label">Social Media Profile</label>
                  <input type="text" id="socialMedia" name="socialMedia" class="form-input" placeholder="N/A if no social media">
                </div>
                <div class="form-group">
                  <label for="pronouns" class="form-label">Pronouns</label>
                  <select id="pronouns" name="pronouns" class="form-select">
                    <option value="">Select pronouns</option>
                    <option value="he/him">He/Him</option>
                    <option value="she/her">She/Her</option>
                    <option value="they/them">They/Them</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="status" class="form-label">Relationship Status</label>
                <select id="status" name="status" class="form-select">
                  <option value="">Select status</option>
                  <option value="single">Single</option>
                  <option value="married">Married</option>
                  <option value="partnered">Partnered</option>
                  <option value="divorced">Divorced</option>
                  <option value="widowed">Widowed</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Step 2: Living Situation -->
          <div class="step" id="step2">
            <div class="form-section">
              <div class="section-header">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <h3 class="section-title">Living Situation</h3>
              </div>

              <div class="form-group">
                <label for="liveWith" class="form-label">Who do you live with? <span class="required-asterisk">*</span></label>
                <textarea id="liveWith" name="liveWith" class="form-textarea" rows="3" required></textarea>
              </div>

              <div class="form-group">
                <label for="buildingType" class="form-label">What type of building do you live in? <span class="required-asterisk">*</span></label>
                <select id="buildingType" name="buildingType" class="form-select" required>
                  <option value="">Select building type</option>
                  <option value="house">House</option>
                  <option value="apartment">Apartment</option>
                  <option value="condo">Condo</option>
                  <option value="townhouse">Townhouse</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="form-group" style="margin-top: 2rem;">
                <label class="form-label" style="margin-bottom: 1rem;">Please attach photos of your home. This helps us get to know your living environment and ensure it’s suitable for the pet you wish to adopt.</label>
                <ol class="pl-0 mb-3 text-base text-foreground" style="padding-left: 0.1rem; list-style-position: inside; font-size: 0.95em;">
                  <li><span class="form-label">Front of the house</span></li>
                  <li><span class="form-label">Street photo</span></li>
                  <li><span class="form-label">Living room</span></li>
                  <li><span class="form-label">Dining area</span></li>
                  <li><span class="form-label">Kitchen</span></li>
                  <li><span class="form-label">Bedroom/s (if you pet will have access)</span></li>
                  <li><span class="form-label">Windows (if adopting a cat)</span></li>
                  <li><span class="form-label">Front & backyard (if adopting a dog)</span></li>
                </ol>
                <div style="height: 1.5rem;"></div>
                <label class="form-label" style="margin-bottom: 0.5rem;">Upload Photos (3-15 images required) <span class="required-asterisk">*</span></label>
                
                <!-- Hidden file input -->
                <input type="file" id="homePhotos" name="homePhotos[]" accept="image/jpeg,image/png,image/gif" multiple class="hidden" required>
                
                <!-- Custom upload button -->
                <button type="button" id="homePhotosUploadBtn" onclick="document.getElementById('homePhotos').click()" 
                        style="width: 100%; padding: 2rem 1rem; border: 2px dashed #fed7aa; border-radius: 8px; background: #fff; transition: all 0.2s; cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <svg style="width: 48px; height: 48px; color: #fe7701; margin-bottom: 0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <div>
                        <p style="font-size: 0.875rem; font-weight: 600; color: #fe7701;">Click to select images</p>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">or drag and drop here</p>
                    </div>
                </button>
                
                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.5rem;">
                    Accepted formats: JPG, PNG, GIF. Max size: 2MB per image.
                </p>
                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">
                    We value your privacy. Your photos will not be used for purposes other than this adoption application.
                </p>

                <!-- Image Previews -->
                <div id="homePhotos-previews" style="display: none; margin-top: 1rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <p style="font-size: 0.875rem; font-weight: 500; color: #374151;">Selected Images: <span id="homePhotos-count">0</span>/15</p>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="button" onclick="document.getElementById('homePhotos').click()" 
                                    style="font-size: 0.75rem; color: #fe7701; font-weight: 500; background: none; border: none; cursor: pointer;">
                                + Add More
                            </button>
                            <button type="button" onclick="clearAllHomePhotos()" style="font-size: 0.75rem; color: #dc2626; background: none; border: none; cursor: pointer;">Clear All</button>
                        </div>
                    </div>
                    <div id="homePhotos-preview-container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;"></div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Are any members of your household allergic to animals? <span class="required-asterisk">*</span></label>
                <div class="radio-group">
                  <div class="radio-item">
                    <input type="radio" id="allergies-yes" name="allergies" value="yes" class="radio-input" required>
                    <label for="allergies-yes" class="form-label">Yes</label>
                  </div>
                  <div class="radio-item">
                    <input type="radio" id="allergies-no" name="allergies" value="no" class="radio-input" required>
                    <label for="allergies-no" class="form-label">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="movingPlans" class="form-label">What happens to your pet if or when you move? <span class="required-asterisk">*</span></label>
                <textarea id="movingPlans" name="movingPlans" class="form-textarea" rows="3" required></textarea>
              </div>

              <div class="form-group">
                <label for="careResponsible" class="form-label">Who will be responsible for feeding, grooming, and generally caring for your pet? <span class="required-asterisk">*</span></label>
                <textarea id="careResponsible" name="careResponsible" class="form-textarea" rows="3" required></textarea>
              </div>

              <div class="form-group">
                <label for="financialResponsible" class="form-label">Who will be financially responsible for your pet's needs? <span class="required-asterisk">*</span></label>
                <textarea id="financialResponsible" name="financialResponsible" class="form-textarea" rows="3" required></textarea>
              </div>
            </div>
          </div>

          <!-- Step 3: Pet Care Experience -->
          <div class="step" id="step3">
            <div class="form-section">
              <div class="section-header">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <h3 class="section-title">Pet Care Experience</h3>
              </div>

              <div class="form-group">
                <label for="vacationCare" class="form-label">Who will look after your pet if you go on vacation or in case of emergency? <span class="required-asterisk">*</span></label>
                <textarea id="vacationCare" name="vacationCare" class="form-textarea" rows="3" required></textarea>
              </div>

              <div class="form-group">
                <label for="hoursAlone" class="form-label">How many hours in an average workday will your pet be left alone? <span class="required-asterisk">*</span></label>
                <select id="hoursAlone" name="hoursAlone" class="form-select" required>
                  <option value="">Select hours</option>
                  <option value="0-2 hours">0-2 hours</option>
                  <option value="2-4 hours">2-4 hours</option>
                  <option value="4-6 hours">4-6 hours</option>
                  <option value="6-8 hours">6-8 hours</option>
                  <option value="8-10 hours">8-10 hours</option>
                  <option value="More than 10 hours">More than 10 hours</option>
                </select>
              </div>

              <div class="form-group">
                <label for="timeCommitment" class="form-label">How much time are you willing to dedicate to pet care and bonding per day? <span class="required-asterisk">*</span></label>
                <select id="timeCommitment" name="timeCommitment" class="form-select" required>
                  <option value="">Select time</option>
                  <option value="Less than 1 hour">Less than 1 hour</option>
                  <option value="1-2 hours">1-2 hours</option>
                  <option value="2-3 hours">2-3 hours</option>
                  <option value="3-4 hours">3-4 hours</option>
                  <option value="4-5 hours">4-5 hours</option>
                  <option value="More than 5 hours">More than 5 hours</option>
                </select>
              </div>

              <div class="form-group">
                <label for="introductionSteps" class="form-label">What steps will you take to introduce your new pet to his/her new surroundings? <span class="required-asterisk">*</span></label>
                <textarea id="introductionSteps" name="introductionSteps" class="form-textarea" rows="4" required></textarea>
              </div>

              <div class="form-group">
                <label class="form-label">Does everyone in the family support your decision to adopt a pet? <span class="required-asterisk">*</span></label>
                <div class="radio-group">
                  <div class="radio-item">
                    <input type="radio" id="family-yes" name="familySupport" value="yes" class="radio-input" required>
                    <label for="family-yes" class="form-label">Yes</label>
                  </div>
                  <div class="radio-item">
                    <input type="radio" id="family-no" name="familySupport" value="no" class="radio-input" required>
                    <label for="family-no" class="form-label">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Do you have other pets? <span class="required-asterisk">*</span></label>
                <div class="radio-group">
                  <div class="radio-item">
                    <input type="radio" id="other-pets-yes" name="otherPets" value="yes" class="radio-input" required>
                    <label for="other-pets-yes" class="form-label">Yes</label>
                  </div>
                  <div class="radio-item">
                    <input type="radio" id="other-pets-no" name="otherPets" value="no" class="radio-input" required>
                    <label for="other-pets-no" class="form-label">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="form-label">Have you had pets in the past? <span class="required-asterisk">*</span></label>
                <div class="radio-group">
                  <div class="radio-item">
                    <input type="radio" id="past-pets-yes" name="pastPets" value="yes" class="radio-input" required>
                    <label for="past-pets-yes" class="form-label">Yes</label>
                  </div>
                  <div class="radio-item">
                    <input type="radio" id="past-pets-no" name="pastPets" value="no" class="radio-input" required>
                    <label for="past-pets-no" class="form-label">No</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="idUpload" class="form-label">Upload a valid ID <span class="required-asterisk">*</span></label>
                <div class="upload-area" id="idUploadArea" onclick="document.getElementById('idUpload').click()">
                  <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                  </svg>
                  <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                  <p class="text-xs text-gray-500 mt-1">PNG, JPG, PDF up to 5MB</p>
                </div>
                <input type="file" id="idUpload" name="idUpload" accept="image/png,image/jpeg,application/pdf" class="hidden" required>
              </div>
            </div>
          </div>

          <!-- Navigation -->
          <div class="footer-actions">
            <button type="button" class="btn btn-outline" id="prevBtn" onclick="prevStep()" disabled>
              <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              Previous
            </button>

            <button type="button" class="btn btn-primary" id="nextBtn">
              Next
              <svg class="icon" fill="none" stroke="#fff" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
        </form>
        <div id="formMessage" style="max-width:64rem;margin:0.5rem auto 1rem;color:#b91c1c;display:none;"></div>
      </div>
    </div>
  </div>

  <script>
    // Home Photos Upload - Admin-style functionality
    let selectedHomePhotos = [];
    
    document.addEventListener('DOMContentLoaded', function() {
      const homePhotosInput = document.getElementById('homePhotos');
      const uploadButton = document.getElementById('homePhotosUploadBtn');
      
      if (!homePhotosInput || !uploadButton) return;
      
      // File input change event
      homePhotosInput.addEventListener('change', function(e) {
        handleHomePhotosFiles(Array.from(e.target.files));
      });
      
      // Drag and drop functionality
      uploadButton.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = '#c1431d';
        this.style.background = '#fff7ed';
      });
      
      uploadButton.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = '#fed7aa';
        this.style.background = '#fff';
      });
      
      uploadButton.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.style.borderColor = '#fed7aa';
        this.style.background = '#fff';
        
        const files = Array.from(e.dataTransfer.files);
        handleHomePhotosFiles(files);
      });
    });
    
    function handleHomePhotosFiles(files) {
      // If no files selected, just return
      if (files.length === 0) {
        return;
      }
      
      // Append to existing files or replace
      const totalFiles = selectedHomePhotos.length + files.length;
      
      if (totalFiles > 15) {
        const remaining = 15 - selectedHomePhotos.length;
        if (remaining <= 0) {
          alert('Maximum 15 images already selected. Please clear some images first.');
          return;
        }
        alert(`Maximum 15 images allowed. Adding only ${remaining} more image(s).`);
        files = files.slice(0, remaining);
      }
      
      // Validate each file
      const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
      let hasErrors = false;
      let validFiles = [];
      
      for (let file of files) {
        // Check file size (2MB)
        if (file.size > 2097152) {
          alert(`File "${file.name}" is too large. Max size is 2MB.`);
          hasErrors = true;
          continue;
        }
        
        // Check file type
        if (!allowedTypes.includes(file.type)) {
          alert(`File "${file.name}" is not a valid image type. Only JPG, PNG, and GIF allowed.`);
          hasErrors = true;
          continue;
        }
        
        validFiles.push(file);
      }
      
      if (validFiles.length > 0) {
        selectedHomePhotos = [...selectedHomePhotos, ...validFiles];
        updateHomePhotosFileInput();
        displayHomePhotosImagePreviews(selectedHomePhotos);
      }
    }
    
    function updateHomePhotosFileInput() {
      // Create a new DataTransfer object to update the file input
      const homePhotosInput = document.getElementById('homePhotos');
      const dataTransfer = new DataTransfer();
      selectedHomePhotos.forEach(file => dataTransfer.items.add(file));
      homePhotosInput.files = dataTransfer.files;
    }
    
    function displayHomePhotosImagePreviews(files) {
      const container = document.getElementById('homePhotos-preview-container');
      const countSpan = document.getElementById('homePhotos-count');
      const previewsDiv = document.getElementById('homePhotos-previews');
      
      container.innerHTML = '';
      countSpan.textContent = files.length;
      
      if (files.length > 0) {
        previewsDiv.style.display = 'block';
        
        files.forEach((file, index) => {
          const reader = new FileReader();
          reader.onload = function(e) {
            const div = document.createElement('div');
            div.style.position = 'relative';
            div.style.cssText = 'position: relative;';
            div.className = 'home-photo-preview-item';
            div.innerHTML = `
              <img src="${e.target.result}" alt="Preview ${index + 1}" 
                   style="width: 100%; height: 128px; object-fit: cover; border-radius: 8px; border: 2px solid ${index === 0 ? '#fe7701' : '#e5e7eb'};">
              ${index === 0 ? '<div style="position: absolute; top: 4px; left: 4px; background: #fe7701; color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 4px;">Primary</div>' : ''}
              <div style="position: absolute; top: 4px; right: 4px; background: rgba(0,0,0,0.5); color: white; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 4px;">${index + 1}</div>
              <button type="button" onclick="removeHomePhoto(${index})" 
                      style="position: absolute; bottom: 4px; right: 4px; background: #dc2626; color: white; padding: 0.25rem; border-radius: 4px; border: none; cursor: pointer; opacity: 0; transition: opacity 0.2s;">
                <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            `;
            
            // Show delete button on hover
            div.addEventListener('mouseenter', function() {
              const btn = this.querySelector('button');
              if (btn) btn.style.opacity = '1';
            });
            div.addEventListener('mouseleave', function() {
              const btn = this.querySelector('button');
              if (btn) btn.style.opacity = '0';
            });
            
            container.appendChild(div);
          };
          reader.readAsDataURL(file);
        });
      } else {
        previewsDiv.style.display = 'none';
      }
    }
    
    function removeHomePhoto(index) {
      selectedHomePhotos.splice(index, 1);
      updateHomePhotosFileInput();
      displayHomePhotosImagePreviews(selectedHomePhotos);
      
      if (selectedHomePhotos.length === 0) {
        document.getElementById('homePhotos-previews').style.display = 'none';
      }
    }
    
    function clearAllHomePhotos() {
      const homePhotosInput = document.getElementById('homePhotos');
      homePhotosInput.value = '';
      selectedHomePhotos = [];
      document.getElementById('homePhotos-previews').style.display = 'none';
      document.getElementById('homePhotos-preview-container').innerHTML = '';
      document.getElementById('homePhotos-count').textContent = '0';
    }
    
    let currentStep = 1;
    const totalSteps = 3;

    // Get pet name from URL parameter and fetch pet details
    const urlParams = new URLSearchParams(window.location.search);
    const petName = urlParams.get('pet') || 'Bella';
    document.getElementById('petName').textContent = petName;
    
    // Fetch pet details by name to populate hidden fields
    async function fetchPetDetails() {
      console.log('Fetching pet details for:', petName);
      try {
        // Add timestamp to prevent caching
        const response = await fetch(`/api/pets/by-name/${encodeURIComponent(petName)}?_=${Date.now()}`);
        console.log('API response status:', response.status);
        
        if (response.ok) {
          const pet = await response.json();
          console.log('API returned pet data:', pet);
          
          if (pet && pet.id) {
            // Set values in hidden fields
            document.getElementById('petId').value = pet.id;
            document.getElementById('petType').value = pet.type || '';
            document.getElementById('petBreed').value = pet.breed || '';
            
            // Store pet data in window for later use
            window.petData = pet;
            
            console.log('Pet details loaded successfully!', {
              id: pet.id,
              name: pet.name,
              type: pet.type,
              breed: pet.breed
            });
            
            // Debug log to verify data is ready for form submission
            console.log('Hidden fields populated:',
              'pet_id=', document.getElementById('petId').value,
              'pet_type=', document.getElementById('petType').value, 
              'pet_breed=', document.getElementById('petBreed').value
            );
          } else {
            console.warn('Pet details not found or invalid for:', petName);
            customAlert('Warning: Could not load pet details. Your form submission may not be associated with the correct pet.', 'warning');
          }
        } else {
          console.error('Failed to fetch pet details:', response.status);
          const text = await response.text();
          console.error('Error response:', text);
        }
      } catch (error) {
        console.error('Error fetching pet details:', error);
      }
    }
    
    // Call the function to fetch pet details
    fetchPetDetails();

    function updateUI() {
      // Update step indicator
      document.getElementById('currentStep').textContent = currentStep;
      
      // Update progress bar
      const progress = (currentStep / totalSteps) * 100;
      document.getElementById('progressBar').style.width = progress + '%';
      
      // Show/hide steps
      for (let i = 1; i <= totalSteps; i++) {
        const step = document.getElementById('step' + i);
        if (i === currentStep) {
          step.classList.add('active');
        } else {
          step.classList.remove('active');
        }
      }
      
      // Update buttons
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      
      prevBtn.disabled = currentStep === 1;
      
      if (currentStep === totalSteps) {
        nextBtn.innerHTML = `
          <svg class="icon" fill="none" stroke="#fff" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
          Submit Application
        `;
        // Don't override the event listener, it's set up once at initialization
      } else {
        nextBtn.innerHTML = `
          Next
          <svg class="icon" fill="none" stroke="#fff" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        `;
        // Don't override the event listener
      }
    }

    function nextStep() {
      if (currentStep < totalSteps) {
        currentStep++;
        updateUI();
      }
    }

    function prevStep() {
      if (currentStep > 1) {
        currentStep--;
        updateUI();
      }
    }

    function goBack() {
      if (currentStep > 1) {
        prevStep();
      } else {
        closePage();
      }
    }

    function closePage() {
      window.history.back();
    }

    // Initialize
    updateUI();
    
    // Set up Next/Submit button click handler
    const nextBtn = document.getElementById('nextBtn');
    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Check if we're on the last step
        if (currentStep === totalSteps) {
          console.log('Submit button clicked - calling submitForm');
          submitForm();
        } else {
          console.log('Next button clicked - going to next step');
          nextStep();
        }
        return false;
      });
    }

    // File upload feedback
    document.getElementById('idUpload').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const uploadArea = document.getElementById('idUploadArea');
        if (uploadArea) {
          uploadArea.innerHTML = `
            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-gray-600">File uploaded: ${file.name}</p>
            <p class="text-xs text-gray-500 mt-1">Click to change file</p>
          `;
        }
      }
    });
  </script>

  <!-- Success Modal -->
  <div id="successModal" class="success-modal-overlay" style="display: none;">
    <div class="success-modal-card">
      <!-- Floating paw prints decoration -->
      <div class="floating-paws">
        <span class="float-paw paw-float-1">🐾</span>
        <span class="float-paw paw-float-2">🐾</span>
        <span class="float-paw paw-float-3">🐾</span>
        <span class="float-paw paw-float-4">🐾</span>
      </div>

      <div class="success-modal-content">
        <!-- Close button -->
        <button class="success-modal-close" onclick="closeSuccessModal()">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>

        <!-- Success icon with animated gradient -->
        <div class="success-icon-container">
          <div class="success-icon-bg-circle"></div>
          <div class="success-icon-circle">
            <svg class="success-check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <!-- Sparkles -->
          <div class="sparkle sparkle-1">✨</div>
          <div class="sparkle sparkle-2">✨</div>
          <div class="sparkle sparkle-3">✨</div>
        </div>

        <!-- Main heading -->
        <div class="success-heading">
          <h2 class="success-title">Congratulations!</h2>
          <p class="success-subtitle">
            Your application for <span class="pet-name-highlight" id="successPetName">Bella</span> has been submitted successfully!
          </p>
        </div>

        <!-- Next steps with icons -->
        <div class="success-steps">
          <h3 class="success-steps-title">
            <svg class="heart-icon" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
            </svg>
            What happens next?
          </h3>
          <div class="success-steps-list">
            <div class="success-step">
              <div class="step-icon-circle">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <span>Our team will review your application within 24-48 hours</span>
            </div>
            <div class="success-step">
              <div class="step-icon-circle">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <span>You'll receive an email with next steps and scheduling information</span>
            </div>
          </div>
        </div>

        <!-- Action buttons -->
        <div class="success-buttons">
          <button class="success-btn-primary" onclick="viewMorePets()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
            View More Pets
          </button>
          <button class="success-btn-secondary" onclick="closeSuccessModal()">
            Close
          </button>
        </div>

        <!-- Thank you message with heart -->
        <p class="success-thank-you">
          Thank you for choosing to adopt and give <span class="pet-name-highlight" id="successPetNameThankYou">Bella</span> a loving home! 💕
        </p>
      </div>
    </div>
  </div>

  <style>
    /* Success Modal Styles */
    .success-modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(8px);
      z-index: 50;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .success-modal-card {
      background: linear-gradient(135deg, #ffffff 0%, #fff9f5 100%);
      border: 2px solid rgba(254, 119, 1, 0.1);
      border-radius: 1.5rem;
      max-width: 28rem;
      width: 100%;
      box-shadow: 
        0 20px 60px -12px rgba(254, 119, 1, 0.25),
        0 0 0 1px rgba(254, 119, 1, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.9);
      animation: modalSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      overflow: hidden;
    }

    /* Floating paws decoration */
    .floating-paws {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
    }

    .float-paw {
      position: absolute;
      font-size: 2rem;
      opacity: 0.08;
      animation: floatPaw 8s infinite ease-in-out;
    }

    .paw-float-1 {
      top: 10%;
      left: 5%;
      animation-delay: 0s;
    }

    .paw-float-2 {
      top: 20%;
      right: 10%;
      animation-delay: 2s;
      font-size: 1.5rem;
    }

    .paw-float-3 {
      bottom: 15%;
      left: 10%;
      animation-delay: 4s;
      font-size: 1.8rem;
    }

    .paw-float-4 {
      bottom: 10%;
      right: 5%;
      animation-delay: 6s;
    }

    .success-modal-content {
      padding: 2rem;
      text-align: center;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      position: relative;
      z-index: 1;
    }

    .success-modal-close {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: rgba(254, 119, 1, 0.1);
      border: none;
      padding: 0.5rem;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      width: 2rem;
      height: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2;
    }

    .success-modal-close svg {
      width: 1rem;
      height: 1rem;
      color: #fe7701;
    }

    .success-modal-close:hover {
      background: #fe7701;
      transform: rotate(90deg);
    }

    .success-modal-close:hover svg {
      color: white;
    }

    .success-icon-container {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      width: 6rem;
      height: 6rem;
    }

    .success-icon-bg-circle {
      position: absolute;
      width: 6rem;
      height: 6rem;
      background: linear-gradient(135deg, rgba(254, 119, 1, 0.1) 0%, rgba(254, 119, 1, 0.2) 100%);
      border-radius: 50%;
      animation: pulse 2s infinite;
    }

    .success-icon-circle {
      width: 4.5rem;
      height: 4.5rem;
      background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: iconPop 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
      box-shadow: 
        0 10px 30px rgba(254, 119, 1, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
      position: relative;
      z-index: 1;
    }

    .success-check-icon {
      width: 2rem;
      height: 2rem;
      color: white;
      stroke-width: 3;
      animation: checkDraw 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.4s both;
    }

    .sparkle {
      position: absolute;
      font-size: 1.25rem;
      animation: sparkleFloat 2s infinite ease-in-out;
    }

    .sparkle-1 {
      top: -0.5rem;
      left: 0.5rem;
      animation-delay: 0s;
    }

    .sparkle-2 {
      top: 0.5rem;
      right: -0.5rem;
      animation-delay: 0.7s;
    }

    .sparkle-3 {
      bottom: 0rem;
      left: -0.25rem;
      animation-delay: 1.4s;
    }

    .success-heading {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .success-title {
      font-size: 1.75rem;
      font-weight: 900;
      background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-family: serif;
      animation: slideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
    }

    .success-subtitle {
      font-size: 0.9375rem;
      color: #6b7280;
      line-height: 1.5;
      animation: slideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.4s both;
    }

    .pet-name-highlight {
      color: #fe7701;
      font-weight: 600;
    }

    .success-steps {
      background: linear-gradient(135deg, rgba(254, 119, 1, 0.05) 0%, rgba(254, 119, 1, 0.08) 100%);
      border: 1px solid rgba(254, 119, 1, 0.15);
      border-radius: 1rem;
      padding: 1.25rem;
      text-align: left;
      animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.5s both;
    }

    .success-steps-title {
      font-weight: 700;
      color: #1f2937;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
      font-size: 0.9375rem;
    }

    .heart-icon {
      width: 1.125rem;
      height: 1.125rem;
      color: #fe7701;
      animation: heartBeat 1.5s infinite;
    }

    .success-steps-list {
      display: flex;
      flex-direction: column;
      gap: 0.875rem;
    }

    .success-step {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      font-size: 0.8125rem;
      color: #4b5563;
      line-height: 1.5;
    }

    .step-icon-circle {
      width: 1.75rem;
      height: 1.75rem;
      background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(254, 119, 1, 0.25);
    }

    .step-icon-circle svg {
      width: 1rem;
      height: 1rem;
      color: white;
    }

    .success-buttons {
      display: flex;
      gap: 0.75rem;
      padding-top: 0.5rem;
      animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.6s both;
    }

    .success-btn-primary {
      flex: 1;
      background: linear-gradient(135deg, #fe7701 0%, #ff9534 100%);
      color: white;
      border: none;
      padding: 0.75rem 1.25rem;
      border-radius: 0.75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      font-size: 0.875rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      box-shadow: 0 4px 12px rgba(254, 119, 1, 0.3);
    }

    .success-btn-primary svg {
      width: 1.125rem;
      height: 1.125rem;
    }

    .success-btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(254, 119, 1, 0.4);
    }

    .success-btn-primary:active {
      transform: translateY(0);
    }

    .success-btn-secondary {
      flex: 1;
      background: white;
      color: #fe7701;
      border: 2px solid rgba(254, 119, 1, 0.3);
      padding: 0.75rem 1.25rem;
      border-radius: 0.75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      font-size: 0.875rem;
    }

    .success-btn-secondary:hover {
      background: rgba(254, 119, 1, 0.05);
      border-color: #fe7701;
      transform: translateY(-2px);
    }

    .success-btn-secondary:active {
      transform: translateY(0);
    }

    .success-thank-you {
      font-size: 0.8125rem;
      color: #6b7280;
      line-height: 1.5;
      animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.7s both;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes modalSlideUp {
      from { 
        opacity: 0;
        transform: translateY(30px) scale(0.95);
      }
      to { 
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    @keyframes iconPop {
      0% { 
        transform: scale(0);
        opacity: 0;
      }
      50% {
        transform: scale(1.1);
      }
      100% { 
        transform: scale(1);
        opacity: 1;
      }
    }

    @keyframes checkDraw {
      0% {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
      }
      100% {
        stroke-dasharray: 100;
        stroke-dashoffset: 0;
      }
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.1);
        opacity: 0.8;
      }
    }

    @keyframes sparkleFloat {
      0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.6;
      }
      50% {
        transform: translateY(-10px) rotate(180deg);
        opacity: 1;
      }
    }

    @keyframes floatPaw {
      0%, 100% {
        transform: translateY(0) rotate(0deg);
      }
      50% {
        transform: translateY(-15px) rotate(10deg);
      }
    }

    @keyframes heartBeat {
      0%, 100% {
        transform: scale(1);
      }
      25% {
        transform: scale(1.1);
      }
      50% {
        transform: scale(1);
      }
    }

    /* Responsive */
    @media (max-width: 640px) {
      .success-modal-content {
        padding: 1.5rem;
        gap: 1.25rem;
      }

      .success-title {
        font-size: 1.5rem;
      }

      .success-buttons {
        flex-direction: column;
      }

      .success-icon-container {
        width: 5rem;
        height: 5rem;
      }

      .success-icon-bg-circle {
        width: 5rem;
        height: 5rem;
      }

      .success-icon-circle {
        width: 4rem;
        height: 4rem;
      }
    }
  </style>

  <script>
    function showSuccessModal() {
      console.log('Inside showSuccessModal function');
      const petName = document.getElementById('petName').textContent;
      console.log('Pet name:', petName);
      
      // Check if elements exist before setting their content
      const successPetNameEl = document.getElementById('successPetName');
      if (successPetNameEl) {
        successPetNameEl.textContent = petName;
      } else {
        console.error("Element with ID 'successPetName' not found");
      }
      
      const thankYouEl = document.getElementById('successPetNameThankYou');
      if (thankYouEl) {
        thankYouEl.textContent = petName;
      } else {
        console.error("Element with ID 'successPetNameThankYou' not found");
      }
      
      const modalEl = document.getElementById('successModal');
      if (modalEl) {
        console.log('Setting success modal display to flex');
        modalEl.style.display = 'flex';
      } else {
        console.error("Element with ID 'successModal' not found");
      }
    }

    function closeSuccessModal() {
      document.getElementById('successModal').style.display = 'none';
    }

    function closeApplicationModal() {
      document.getElementById('applicationModal').style.display = 'none';
    }

    function viewMorePets() {
      window.location.href = '/#pets-section';
    }

    // Submit form via AJAX to backend
    async function submitForm() {
      console.log('submitForm called');
      const form = document.getElementById('adoptionForm');
      
      // Check if form exists
      if (!form) {
        console.error('Form element not found!');
        alert('Form not found. Please refresh the page.');
        return;
      }
      
      console.log('Form found, checking validity...');
      
      // Check home photos count (minimum 3, maximum 15)
      if (selectedHomePhotos.length < 3) {
        alert('Please upload at least 3 photos of your home.');
        return;
      }
      
      if (selectedHomePhotos.length > 15) {
        alert('You can only upload up to 15 photos.');
        return;
      }
      
      // Check validity and show which fields are invalid
      if (!form.checkValidity()) {
        console.log('Form validation failed');
        
        // Find all invalid fields and log them
        const invalidFields = form.querySelectorAll(':invalid');
        console.log('Invalid fields:', invalidFields);
        invalidFields.forEach(field => {
          console.log('Invalid field:', field.name, field.validationMessage);
        });
        
        form.reportValidity();
        return;
      }

      console.log('Form is valid, preparing submission');
      const formData = new FormData(form);
      
      // Ensure file input is included
      const fileInput = document.getElementById('idUpload');
      if (fileInput && fileInput.files.length > 0) {
        console.log('File detected:', fileInput.files[0].name);
        // The FormData constructor should automatically include the file,
        // but we'll explicitly add it to be sure
        formData.append('idUpload', fileInput.files[0]);
      } else {
        console.warn('No file selected for ID upload');
      }
      
      // Append pet name (redundant but kept for backward compatibility)
      formData.append('pet_name', document.getElementById('petName').textContent);
      
      // Explicitly include all pet data fields to ensure they're sent
      const petId = document.getElementById('petId').value;
      const petType = document.getElementById('petType').value;
      const petBreed = document.getElementById('petBreed').value;
      
      // If we have stored pet data, use that as a backup
      if (window.petData && window.petData.id && !petId) {
        console.log('Using window.petData as fallback for pet information');
        formData.append('pet_id', window.petData.id);
        formData.append('pet_type', window.petData.type || '');
        formData.append('pet_breed', window.petData.breed || '');
      } else {
        // Double-check all pet-related fields and add them to formData
        formData.append('pet_id', petId || '');
        formData.append('pet_type', petType || '');
        formData.append('pet_breed', petBreed || '');
      }
      
      console.log('Pet data being submitted:', {
        pet_id: petId || '(none)',
        pet_type: petType || '(none)', 
        pet_breed: petBreed || '(none)'
      });

      // Get CSRF token
      const metaToken = document.querySelector('meta[name="csrf-token"]');
      const token = metaToken ? metaToken.getAttribute('content') : '';
      
      // Double check that token is properly included
      console.log('CSRF token present:', !!token);
      
      // Make sure _token is in the form data (Laravel expects this)
      if (!formData.has('_token')) {
        console.log('Adding _token to formData');
        formData.append('_token', token);
      }
      
      const msgEl = document.getElementById('formMessage');
      msgEl.style.display = 'none';
      msgEl.textContent = '';

      try {
        // Important: When sending FormData with files, don't set Content-Type header
        // The browser will automatically set it with the proper boundary
        const res = await fetch('/submit-adoption', {
            method: 'POST',
            credentials: 'same-origin', // ensure cookies (session) are sent for CSRF
            headers: {
              'X-CSRF-TOKEN': token,
              'Accept': 'application/json'
              // Don't set Content-Type here, it will be set automatically with boundary for multipart/form-data
            },
            body: formData
          });

        console.log('submit-adoption status', res.status);

        if (res.status === 419) {
          // CSRF token mismatch or session expired
          customAlert('Session expired or CSRF token mismatch. Please reload the page and try again.', 'warning');
          return;
        }

        if (res.status === 422) {
          const data = await res.json();
          const firstError = Object.values(data.errors)[0][0];
          console.warn('validation error', data.errors);
          msgEl.style.display = 'block';
          msgEl.textContent = firstError;
          return;
        }

        // Try to parse JSON; if parsing fails show generic error
        let data;
        try {
          // Always get response text first for debugging
          const responseText = await res.text();
          console.log('Response status:', res.status);
          console.log('Response text (first 500 chars):', responseText.substring(0, 500));
          
          try {
            // Try to parse as JSON
            data = JSON.parse(responseText);
            console.log('Successfully parsed JSON:', data);
          } catch (jsonErr) {
            // If it's not JSON, log the error and show message
            console.error('Failed to parse response as JSON:', jsonErr);
            console.error('Full response text:', responseText);
            
            if (!res.ok) {
              msgEl.style.display = 'block';
              msgEl.textContent = 'Server error: ' + responseText.substring(0, 200);
            } else {
              msgEl.style.display = 'block';
              msgEl.textContent = 'Unexpected server response format.';
            }
            return;
          }
        } catch (err) {
          console.error('Error reading response:', err);
          msgEl.style.display = 'block';
          msgEl.textContent = 'Failed to read server response.';
          return;
        }

        if (data && data.success) {
          console.log('submission success', data);
          console.log('About to close application modal and show success modal');
          closeApplicationModal();
          // Add a delay and log the success modal display
          setTimeout(() => {
            console.log('Showing success modal now');
            showSuccessModal();
            console.log('Success modal should be visible, display style:', document.getElementById('successModal').style.display);
          }, 100);
        } else {
          console.error('submission failed', data);
          // Show all error details for debugging
          console.error('Error details:', JSON.stringify(data, null, 2));
          
          msgEl.style.display = 'block';
          if (data && data.message) {
            msgEl.textContent = data.message;
          } else if (data && data.errors) {
            const errorMessages = Object.values(data.errors).flat();
            msgEl.textContent = errorMessages.join(', ');
          } else {
            msgEl.textContent = 'Submission failed. Please try again.';
          }
        }
      } catch (err) {
        console.error(err);
        msgEl.style.display = 'block';
        msgEl.textContent = 'An error occurred while submitting the form. Check the console for details.';
      }
    }
  </script>

  <!-- Custom Modal Component -->
  @include('components.custom-modal')
</body>
</html>
