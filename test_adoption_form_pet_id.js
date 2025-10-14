// Test script to verify the adoption form is correctly capturing pet ID

document.addEventListener('DOMContentLoaded', function() {
  // Mock form elements and pet data
  const mockElements = {
    'petId': document.createElement('input'),
    'petType': document.createElement('input'),
    'petBreed': document.createElement('input'),
    'petName': document.createElement('span')
  };
  
  // Set IDs for our mock elements
  Object.keys(mockElements).forEach(id => {
    mockElements[id].id = id;
  });
  
  // Add all elements to the document body for testing
  Object.values(mockElements).forEach(el => {
    document.body.appendChild(el);
  });
  
  // Set initial pet name display
  mockElements.petName.textContent = 'Max';

  // Mock pet data for testing
  const mockPetData = {
    id: 123,
    name: 'Max',
    type: 'Dog',
    breed: 'Golden Retriever',
    age: 3,
    gender: 'Male',
    is_available: true
  };
  
  // Mock fetch API for testing
  const originalFetch = window.fetch;
  window.fetch = function(url) {
    console.log('Intercepting fetch request to:', url);
    
    if (url.includes('/api/pets/by-name/')) {
      return Promise.resolve({
        ok: true,
        json: () => Promise.resolve(mockPetData)
      });
    }
    
    // Fall back to original fetch for other requests
    return originalFetch.apply(this, arguments);
  };
  
  // Test function to simulate our fetchPetDetails function
  async function testFetchPetDetails() {
    try {
      const petName = document.getElementById('petName').textContent;
      const response = await fetch(`/api/pets/by-name/${encodeURIComponent(petName)}`);
      
      if (!response.ok) {
        console.error('Failed to fetch pet details');
        return;
      }
      
      const petData = await response.json();
      if (petData) {
        // Populate hidden fields with pet data
        document.getElementById('petId').value = petData.id;
        document.getElementById('petType').value = petData.type;
        document.getElementById('petBreed').value = petData.breed;
        console.log(`Pet details loaded: ID=${petData.id}, Type=${petData.type}, Breed=${petData.breed}`);
        
        // For testing - create a FormData object to simulate form submission
        const formData = new FormData();
        formData.append('pet_name', document.getElementById('petName').textContent);
        
        // Make sure the pet ID is included
        const petId = document.getElementById('petId').value;
        if (petId) {
          formData.append('pet_id', petId);
          console.log('Including pet_id in submission:', petId);
        } else {
          console.warn('No pet_id available for submission');
        }
        
        // Log what would be submitted
        console.log('Form data to be submitted:');
        for (const [key, value] of formData.entries()) {
          console.log(`${key}: ${value}`);
        }
      }
    } catch (error) {
      console.error('Error fetching pet details:', error);
    }
  }
  
  // Run the test
  testFetchPetDetails().then(() => {
    console.log('Test completed');
    
    // Check if hidden fields were populated correctly
    console.log('Verification:');
    console.log('Pet ID field value:', document.getElementById('petId').value);
    console.log('Pet type field value:', document.getElementById('petType').value);
    console.log('Pet breed field value:', document.getElementById('petBreed').value);
    
    // Clean up - restore original fetch
    window.fetch = originalFetch;
    
    // Clean up - remove mock elements
    Object.values(mockElements).forEach(el => {
      document.body.removeChild(el);
    });
  });
});