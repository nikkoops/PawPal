// Run this script in the browser console on the adoption form page
// It will help diagnose form submission issues

console.log('PawPal Adoption Form Test Script - Form Data Test');

// Check if we're on the right page
if (!document.getElementById('adoptionForm')) {
  console.error('Not on adoption form page!');
  throw new Error('Wrong page');
}

// Check if the form has a file input
const fileInput = document.getElementById('idUpload');
console.log('File input exists:', !!fileInput);
if (fileInput) {
  console.log('Files selected:', fileInput.files.length);
  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];
    console.log('File info:', {
      name: file.name,
      size: file.size,
      type: file.type,
      lastModified: new Date(file.lastModified)
    });
  }
}

// Check CSRF token
const metaToken = document.querySelector('meta[name="csrf-token"]');
console.log('CSRF meta tag exists:', !!metaToken);
if (metaToken) {
  console.log('CSRF token length:', metaToken.getAttribute('content').length);
}

// Check for hidden CSRF input
const csrfInput = document.querySelector('input[name="_token"]');
console.log('CSRF input exists:', !!csrfInput);
if (csrfInput) {
  console.log('CSRF input value length:', csrfInput.value.length);
}

// Test FormData creation
const testFormData = new FormData(document.getElementById('adoptionForm'));
console.log('FormData entries:');
for (const [key, value] of testFormData.entries()) {
  const valueDisplay = value instanceof File ? 
    `File: ${value.name} (${value.size} bytes)` : 
    value;
  console.log(`- ${key}: ${valueDisplay}`);
}

console.log('Test complete!');