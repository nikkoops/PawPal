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
      --card: #f0fdf4;
      --card-foreground: #374151;
      --popover: #ffffff;
      --popover-foreground: #374151;
      --primary: #15803d;
      --primary-foreground: #ffffff;
      --secondary: #84cc16;
      --secondary-foreground: #374151;
      --muted: #f0fdf4;
      --muted-foreground: #374151;
      --accent: #84cc16;
      --accent-foreground: #ffffff;
      --destructive: #e63946;
      --destructive-foreground: #ffffff;
      --border: #d1d5db;
      --input: #f0fdf4;
      --ring: #84cc16;
      --radius: 0.5rem;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
      background-color: var(--background);
      color: var(--foreground);
      line-height: 1.6;
    }

    .modal-overlay {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
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
      overflow-y: auto;
      border-radius: calc(var(--radius) + 4px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
      background-color: #f3f4f6;
      padding: 2rem;
      position: relative;
    }

    .header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1rem;
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
      border-radius: var(--radius);
      font-weight: 500;
      transition: all 0.2s;
      cursor: pointer;
      text-decoration: none;
      border: none;
      font-size: 0.875rem;
    }

    .btn-ghost {
      background: transparent;
      color: var(--foreground);
      padding: 0.5rem;
      width: 40px;
      height: 40px;
    }

    .btn-ghost:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .btn-primary {
      background: #fe7701;
      color: white;
      padding: 0.75rem 1.5rem;
      gap: 0.5rem;
    }

    .btn-primary:hover {
      background: #c1431d;
    }

    .btn-outline {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--foreground);
      padding: 0.75rem 1.5rem;
      gap: 0.5rem;
    }

    .btn-outline:hover {
      background: #f9fafb;
    }

    .modal-title {
      font-size: 2rem;
      font-weight: bold;
      color: #1f2937;
      margin: 0;
    }

    .step-info {
      color: #6b7280;
      font-size: 1rem;
    }

    .progress-bar {
      width: 100%;
      background-color: #e5e7eb;
      border-radius: 9999px;
      height: 0.5rem;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background-color: #fe7701;
      transition: width 0.3s ease;
      border-radius: 9999px;
    }

    .modal-content {
      padding: 2rem;
    }

    .form-section {
      margin-bottom: 2rem;
    }

    .section-header {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 2.5rem;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
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
      font-weight: 500;
      color: #374151;
      font-size: 0.875rem;
    }

    /* Style for required field asterisks */
    .required-asterisk {
      color: #b91c1c;
    }

    .form-input, .form-textarea, .form-select {
      padding: 0.75rem;
      border: 1px solid var(--border);
      border-radius: var(--radius);
      background-color: #f9fafb;
      color: var(--foreground);
      font-size: 0.875rem;
      transition: border-color 0.2s;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
      outline: none;
      border-color: var(--ring);
      box-shadow: 0 0 0 2px rgba(132, 204, 22, 0.2);
    }

    .form-textarea {
      resize: vertical;
      min-height: 80px;
    }

    .radio-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      margin-top: 0.5rem;
    }

    .radio-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .radio-input {
      width: 1rem;
      height: 1rem;
      accent-color: #fe7701;
    }

    .upload-area {
      margin-top: 0.5rem;
      border: 2px dashed var(--border);
      border-radius: var(--radius);
      padding: 2rem;
      text-align: center;
      background-color: #f9fafb;
      cursor: pointer;
      transition: border-color 0.2s;
    }

    .upload-area:hover {
      border-color: var(--ring);
    }

    .upload-icon {
      width: 2rem;
      height: 2rem;
      margin: 0 auto 0.5rem;
      color: #9ca3af;
    }

    .footer-actions {
      display: flex;
      justify-content: space-between;
      padding-top: 1.5rem;
      border-top: 1px solid var(--border);
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
                <input type="text" id="hoursAlone" name="hoursAlone" class="form-input" placeholder="e.g., 6-8 hours" required>
              </div>

              <div class="form-group">
                <label for="timeCommitment" class="form-label">How much time are you willing to dedicate to pet care and bonding per day? <span class="required-asterisk">*</span></label>
                <input type="text" id="timeCommitment" name="timeCommitment" class="form-input" placeholder="e.g., 2-3 hours" required>
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
      <div class="success-modal-content">
        <!-- Close button -->
        <div class="success-modal-close-container">
          <button class="success-modal-close" onclick="closeSuccessModal()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Success icon with celebration -->
        <div class="success-icon-container">
          <div class="success-icon-circle">
            <svg class="success-check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <!-- Decorative paw prints -->
          <div class="paw-print paw-1">🐾</div>
          <div class="paw-print paw-2">🐾</div>
          <div class="paw-print paw-3">🐾</div>
        </div>

        <!-- Main heading -->
        <div class="success-heading">
          <h2 class="success-title">Congratulations!</h2>
          <p class="success-subtitle">
            Your application for <span id="successPetName">Bella</span> has been submitted successfully!
          </p>
        </div>

        <!-- Next steps -->
        <div class="success-steps">
          <h3 class="success-steps-title">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            What happens next?
          </h3>
          <div class="success-steps-list">
            <div class="success-step">
              <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              <span>Our team will review your application within 24-48 hours</span>
            </div>
            <div class="success-step">
              <svg class="step-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <span>You'll receive an email with next steps and scheduling information</span>
            </div>
          </div>
        </div>

        <!-- Action buttons -->
        <div class="success-buttons">
          <button class="success-btn-primary" onclick="viewMorePets()">
            View More Pets
          </button>
          <button class="success-btn-secondary" onclick="closeSuccessModal()">
            Close
          </button>
        </div>

        <!-- Thank you message -->
        <p class="success-thank-you">
          Thank you for choosing to adopt and give <span id="successPetNameThankYou">Bella</span> a loving home! 💕
        </p>
      </div>
    </div>
  </div>

  <style>
    /* Success Modal Styles */
    .success-modal-overlay {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      z-index: 50;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
      animation: fadeIn 0.3s ease-out;
    }

    .success-modal-card {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 0.5rem;
      max-width: 28rem;
      width: 100%;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      animation: zoomIn 0.3s ease-out;
    }

    .success-modal-content {
      padding: 0.15rem 2rem 2rem 2rem;
      text-align: center;
      display: flex;
      flex-direction: column;
      gap: 2rem;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .success-modal-close-container {
      display: flex;
      justify-content: flex-end;
      margin-right: -0.5rem;
    }

    .success-modal-close {
      background: transparent;
      border: none;
      padding: 0.5rem;
      border-radius: 50%;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .success-modal-close:hover {
      background-color: #f3f4f6;
    }

    .success-icon-container {
      position: relative;
      display: flex;
      justify-content: center;
      margin-bottom: 0.25rem;
    }

    .success-icon-circle {
      width: 5rem;
      height: 5rem;
      background: #fe7701;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 2s infinite;
    }

    .success-check-icon {
      width: 2.5rem;
      height: 2.5rem;
      color: white;
      stroke-width: 3;
    }

    .paw-print {
      position: absolute;
      font-size: 1.5rem;
      animation: bounce 1s infinite;
      color: #fe7701;
    }

    .paw-1 {
      top: -0.5rem;
      left: -1rem;
      animation-delay: 0s;
    }

    .paw-2 {
      top: -1rem;
      right: -0.5rem;
      font-size: 1.25rem;
      animation-delay: 0.15s;
    }

    .paw-3 {
      bottom: -0.5rem;
      left: 0.5rem;
      font-size: 1.125rem;
      animation-delay: 0.3s;
    }

    .success-heading {
      display: flex;
      flex-direction: column;
      gap: 0.125rem;
    }

    .success-title {
      font-size: 1.5rem;
      font-weight: 900;
      color: #1f2937;
      font-family: serif;
    }

    .success-subtitle {
      font-size: 0.875rem;
      color: #6b7280;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .success-steps {
      background: #f9fafb;
      border-radius: 0.5rem;
      padding: 0.75rem;
      text-align: left;
    }

    .success-steps-title {
      font-weight: 700;
      color: #374151;
      display: flex;
      align-items: center;
      gap: 0.25rem;
      margin-bottom: 0.5rem;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-size: 0.75rem;
    }

    .success-steps-title .icon {
      color: #374151;
      width: 0.75rem;
      height: 0.75rem;
    }

    .success-steps-list {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .success-step {
      display: flex;
      align-items: flex-start;
      gap: 0.5rem;
      font-size: 0.75rem;
      color: #6b7280;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .step-icon {
      width: 0.75rem;
      height: 0.75rem;
      color: #fe7701;
      margin-top: 0.125rem;
      flex-shrink: 0;
    }

    .success-buttons {
      display: flex;
      gap: 0.5rem;
      padding-top: 0.75rem;
    }

    .success-btn-primary {
      flex: 1;
      background: #fe7701;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-size: 0.75rem;
    }

    .success-btn-primary:hover {
      background: #c1431d;
    }

    .success-btn-secondary {
      flex: 1;
      background: transparent;
      color: #fe7701;
      border: 2px solid #fe7701;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-size: 0.75rem;
    }

    .success-btn-secondary:hover {
      background: rgba(147, 51, 234, 0.1);
    }

    .success-thank-you {
      font-size: 0.75rem;
      color: #6b7280;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes zoomIn {
      from { 
        opacity: 0;
        transform: scale(0.95);
      }
      to { 
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
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
          // For error responses, get the response text first to debug
          if (!res.ok) {
            const responseText = await res.text();
            console.error('Error response text:', responseText);
            try {
              // Try to parse it as JSON anyway
              data = JSON.parse(responseText);
            } catch (jsonErr) {
              // If it's not JSON, just use the text as message
              console.error('Failed to parse error response as JSON', jsonErr);
              msgEl.style.display = 'block';
              msgEl.textContent = 'Server error: ' + responseText.substring(0, 100) + '...';
              return;
            }
          } else {
            data = await res.json();
          }
        } catch (err) {
          console.error('Non-JSON response', err);
          msgEl.style.display = 'block';
          msgEl.textContent = 'Unexpected server response. Check the browser console and server logs.';
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
