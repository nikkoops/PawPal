// This is a simple test script to verify the button works.
// You can run this in the browser console when on the adoption form page.

console.log('Testing adoption form submission button...');

// Check if we're on the adoption form page
if (document.getElementById('adoptionForm')) {
    console.log('Found adoption form.');
    
    // Simulate going to the last step
    const totalSteps = 3;
    currentStep = totalSteps;
    updateUI();
    
    // Check if the submit button is configured correctly
    const nextBtn = document.getElementById('nextBtn');
    console.log('Submit button text:', nextBtn.innerText.trim());
    console.log('Submit button onclick function:', nextBtn.onclick.toString());
    
    // Verify the submit function exists
    console.log('submitForm function exists:', typeof submitForm === 'function');
    
    console.log('Test complete! The button should now be clickable and call the async submitForm function.');
} else {
    console.log('Not on the adoption form page. Please navigate to the adoption form first.');
}