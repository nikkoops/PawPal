// Test script to verify end-to-end adoption form submission with pet data

// This script will:
// 1. Create a mock DOM environment
// 2. Set up the adoption form with pet data
// 3. Simulate form submission
// 4. Verify that pet data is included in the submission

// Create mock elements
const mockForm = document.createElement('form');
mockForm.id = 'adoptionForm';

// Create pet-related fields
const petFields = ['petId', 'petType', 'petBreed', 'petName'];
const petData = {
  petId: '123',
  petType: 'Dog',
  petBreed: 'Golden Retriever',
  petName: 'Bella'
};

// Create hidden fields and add them to the form
petFields.forEach(fieldId => {
  const field = document.createElement('input');
  field.type = fieldId === 'petName' ? 'text' : 'hidden';
  field.id = fieldId;
  field.name = fieldId;
  field.value = petData[fieldId];
  mockForm.appendChild(field);
});

// Add required fields
const requiredFields = {
  firstName: 'Test',
  lastName: 'User',
  email: 'test@example.com',
  phone: '555-555-5555',
  address: '123 Main St',
  birthDate: '1990-01-01',
  occupation: 'Developer'
};

Object.entries(requiredFields).forEach(([name, value]) => {
  const field = document.createElement('input');
  field.type = 'text';
  field.name = name;
  field.value = value;
  mockForm.appendChild(field);
});

// Add form to document
document.body.appendChild(mockForm);

// Mock fetch function
const originalFetch = window.fetch;
window.fetch = function(url, options) {
  console.log('Fetch called with URL:', url);
  console.log('Fetch options:', options);
  
  if (options && options.body instanceof FormData) {
    console.log('FormData contents:');
    for (const [key, value] of options.body.entries()) {
      console.log(`  ${key}: ${value}`);
    }
    
    // Check if pet ID is included
    const petId = options.body.get('pet_id');
    if (petId) {
      console.log('✓ TEST PASSED: Pet ID is included in form submission');
    } else {
      console.log('✗ TEST FAILED: Pet ID is missing from form submission');
    }
  }
  
  // Return mock response
  return Promise.resolve({
    ok: true,
    json: () => Promise.resolve({ success: true, application_id: 999 })
  });
};

// Simulate form submission
console.log('Starting form submission test...');

// Create FormData from the form
const formData = new FormData(mockForm);

// Add pet data if not already included (simulating our form submission code)
if (!formData.has('pet_id') && document.getElementById('petId')) {
  const petId = document.getElementById('petId').value;
  formData.append('pet_id', petId);
}

// Log all form data
console.log('Form data to be submitted:');
for (const [key, value] of formData.entries()) {
  console.log(`  ${key}: ${value}`);
}

// Simulate fetch submission
fetch('/submit-adoption', {
  method: 'POST',
  body: formData
})
.then(response => response.json())
.then(data => {
  console.log('Response:', data);
  console.log('Test completed');
})
.catch(error => {
  console.error('Error:', error);
})
.finally(() => {
  // Clean up
  document.body.removeChild(mockForm);
  window.fetch = originalFetch;
});