// This test script will directly test the submit functionality
// Run this in the browser console on the adoption page after filling out the form
// and reaching the last step

// First, move to the last step
currentStep = 3;
updateUI();
console.log("Set to final step. Submit button should be visible now.");

// Check if submit button exists and is configured correctly
const submitBtn = document.getElementById('nextBtn');
console.log("Submit button HTML:", submitBtn.outerHTML);
console.log("Submit button onclick:", submitBtn.onclick ? "Function set" : "No function");

// Log form validity
const form = document.getElementById('adoptionForm');
console.log("Form valid:", form.checkValidity());

// Test the submit function manually
console.log("Trying to call submitForm directly...");
try {
  // Don't actually submit, just test if function works
  const originalFetch = window.fetch;
  window.fetch = function mockFetch() {
    console.log("Fetch called with arguments:", arguments);
    return new Promise(resolve => {
      // Return a mock successful response
      resolve({
        status: 200,
        json: () => Promise.resolve({ success: true })
      });
    });
  };
  
  submitForm();
  
  // Restore original fetch after brief delay
  setTimeout(() => {
    window.fetch = originalFetch;
    console.log("Restored original fetch function");
  }, 2000);
} catch(e) {
  console.error("Error calling submitForm:", e);
}

// Check if the successModal exists
const successModal = document.getElementById('successModal');
console.log("Success modal exists:", !!successModal);
if (successModal) {
  console.log("Success modal display style:", successModal.style.display);
}

// Log all event listeners on the submit button (for debugging)
console.log("All properties of the submit button:", Object.keys(submitBtn));

console.log("Test complete!");