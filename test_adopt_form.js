// PawPal Form Submission Test
// Paste this in your browser console when on the adoption form page

// Function to test form submission after filling all required fields
async function testFormSubmission() {
  console.log("=== PawPal Form Submission Test ===");
  
  // Check if we're on the adoption form page
  if (!document.getElementById('adoptionForm')) {
    console.error("Not on adoption form page!");
    return;
  }
  
  // Fill out required form fields
  console.log("Filling out required form fields...");
  const requiredFields = {
    firstName: "Test",
    lastName: "User",
    address: "123 Main St",
    phone: "555-123-4567",
    email: "test@example.com",
    birthDate: "1990-01-01",
    occupation: "Developer"
  };
  
  // Fill text inputs
  Object.entries(requiredFields).forEach(([id, value]) => {
    const field = document.getElementById(id);
    if (field) {
      field.value = value;
      console.log(`Set ${id} to "${value}"`);
    } else {
      console.warn(`Field ${id} not found`);
    }
  });
  
  // Select radio buttons
  const radioFields = [
    'familySupport',
    'otherPets',
    'pastPets'
  ];
  
  radioFields.forEach(name => {
    const yesOption = document.querySelector(`input[name="${name}"][value="yes"]`);
    if (yesOption) {
      yesOption.checked = true;
      console.log(`Selected "Yes" for ${name}`);
    } else {
      console.warn(`Radio field ${name} not found`);
    }
  });
  
  // Create a sample file for upload
  const dataTransfer = new DataTransfer();
  const file = new File(["test file content"], "test-id.png", {
    type: "image/png"
  });
  dataTransfer.items.add(file);
  
  const fileInput = document.getElementById('idUpload');
  if (fileInput) {
    fileInput.files = dataTransfer.files;
    console.log("Added test file to idUpload");
    
    // Trigger the change event to update any UI
    const event = new Event('change', { bubbles: true });
    fileInput.dispatchEvent(event);
  } else {
    console.warn("File input 'idUpload' not found");
  }
  
  // Navigate to last step
  console.log("Moving to last step...");
  currentStep = totalSteps;
  updateUI();
  
  console.log("Form prepared for submission. Submit button should be ready.");
  console.log("You can now click the 'Submit Application' button to test.");
}

// Run the test
testFormSubmission();