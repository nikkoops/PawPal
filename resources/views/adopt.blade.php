<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption Form</title>
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
      background: #030213;
      color: white;
      padding: 0.75rem 1.5rem;
      gap: 0.5rem;
    }

    .btn-primary:hover {
      opacity: 0.9;
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
      background-color: #030213;
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
      accent-color: #030213;
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
      color: #030213;
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
        <form id="adoptionForm" method="POST" action="submit_adoption.php" enctype="multipart/form-data">
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
                <div class="upload-area" onclick="document.getElementById('idUpload').click()">
                  <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                  </svg>
                  <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                  <p class="text-xs text-gray-500 mt-1">PNG, JPG, PDF up to 10MB</p>
                </div>
                <input type="file" id="idUpload" name="idUpload" accept=".png,.jpg,.jpeg,.pdf" class="hidden" required>
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

            <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">
              Next
              <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    let currentStep = 1;
    const totalSteps = 3;

    // Get pet name from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const petName = urlParams.get('pet') || 'Bella';
    document.getElementById('petName').textContent = petName;

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
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
          Submit Application
        `;
        nextBtn.onclick = submitForm;
      } else {
        nextBtn.innerHTML = `
          Next
          <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        `;
        nextBtn.onclick = nextStep;
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

    function submitForm() {
      const form = document.getElementById('adoptionForm');
      if (form.checkValidity()) {
        alert('Application submitted successfully!');
        form.submit();
      } else {
        form.reportValidity();
      }
    }

    // Initialize
    updateUI();

    // File upload feedback
    document.getElementById('idUpload').addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const uploadArea = document.querySelector('.upload-area');
        uploadArea.innerHTML = `
          <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-sm text-gray-600">File uploaded: ${file.name}</p>
          <p class="text-xs text-gray-500 mt-1">Click to change file</p>
        `;
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
      background: #10b981;
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
      color: #10b981;
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
      color: #10b981;
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
      background: #059669;
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
      background: #047857;
    }

    .success-btn-secondary {
      flex: 1;
      background: transparent;
      color: #059669;
      border: 2px solid #059669;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-size: 0.75rem;
    }

    .success-btn-secondary:hover {
      background: rgba(5, 150, 105, 0.1);
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
      const petName = document.getElementById('petName').textContent;
      document.getElementById('successPetName').textContent = petName;
      document.getElementById('successPetNameThankYou').textContent = petName;
      document.getElementById('successModal').style.display = 'flex';
    }

    function closeSuccessModal() {
      document.getElementById('successModal').style.display = 'none';
    }

    function closeApplicationModal() {
      document.getElementById('applicationModal').style.display = 'none';
    }

    function viewMorePets() {
      window.location.href = 'index.php#pets-section';
    }

    // Update the submit form function to show the success modal
    function submitForm() {
      // Remove validation temporarily to test the modal design
      // const form = document.getElementById('adoptionForm');
      // if (form.checkValidity()) {
        // Close the application modal first
        closeApplicationModal();
        // Then show the success modal
        setTimeout(() => {
          showSuccessModal();
        }, 100);
        // Uncomment the line below when you want to actually submit the form
        // form.submit();
      // } else {
      //   alert('Please fill in all required fields.');
      // }
    }
  </script>
</body>
</html>
