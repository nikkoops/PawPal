<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\FormQuestionController;
use App\Http\Controllers\Admin\AdoptionApplicationController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('home');

Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');

Route::get('/adopt', function () {
    $petName = request()->query('pet');
    return view('adopt', ['petName' => $petName]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/learn-more', function () {
    return view('learn-more');
});

Route::get('/contact', function () {
    return view('contact-us', [
        'pet' => request()->query('pet'),
        'action' => request()->query('action')
    ]);
});

Route::post('/submit-adoption', function () {
    // TODO: Implement adoption form submission
    return redirect('/')->with('success', 'Adoption request submitted successfully!');
});

Route::post('/adopt/submit', function () {
    // Here you would typically:
    // 1. Validate the form data
    // 2. Save to database
    // 3. Send confirmation emails
    // 4. etc.
    
    $petName = request()->input('pet_name');
    
    // For now, just redirect back with a success message
    return redirect('/')
        ->with('success', "Thank you for applying to adopt $petName! We'll contact you soon.");
});

// Handle contact form submission
Route::post('/contact/submit', function () {
    // Validate the form data
    $validated = request()->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
        'phone' => 'nullable'
    ]);
    
    // Here you would typically:
    // 1. Save to database
    // 2. Send notification email
    // 3. etc.
    
    // For now, just redirect back with a success message
    return redirect()->back()
        ->with('success', 'Thank you for your message! We\'ll get back to you soon.');
});

// Add default login route to redirect to admin login
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/pet-details/{id}', function ($id) {
    // Find the pet with the given ID
    $pets = [
        1 => [
            'name' => 'Max',
            'type' => 'Dog',
            'age' => 'Adult',
            'size' => 'Large',
            'breed' => 'German Shepherd Mix',
            'gender' => 'Male',
            'description' => 'Max was rescued in Quincy City and has been in the shelter for 34 days. Energetic and playful, he\'ll make a great companion for an active family. Max loves long walks, playing fetch, and meeting new people.',
            'image' => 'images/golden-retriever-puppy-happy-face.png',
            'urgent' => false,
            'location' => 'Quincy City Shelter',
            'vaccinated' => true,
            'spayed_neutered' => true,
            'good_with_kids' => true,
            'good_with_pets' => true,
        ],
        2 => [
            'name' => 'Bella',
            'type' => 'Dog',
            'age' => 'Senior',
            'size' => 'Large',
            'breed' => 'Labrador Mix',
            'gender' => 'Female',
            'description' => 'Bella, rescued in Caboolture, has spent 60 days in the shelter. A gentle giant, she loves quiet walks and cuddles. Perfect for a calm household looking for a loving companion.',
            'image' => 'images/brown-dog-with-blue-collar-smiling.png',
            'urgent' => true,
            'location' => 'Caboolture Animal Shelter',
            'vaccinated' => true,
            'spayed_neutered' => true,
            'good_with_kids' => true,
            'good_with_pets' => false,
        ],
        3 => [
            'name' => 'Duke',
            'type' => 'Dog',
            'age' => 'Adult',
            'size' => 'Large',
            'breed' => 'Mixed Breed',
            'gender' => 'Male',
            'description' => 'Duke was found in Plaza City and has been here 30 days. This happy pup\'s goofy energy will bring joy to any home. He\'s a playful and friendly dog who gets along well with everyone he meets.',
            'image' => 'images/senior-dog-with-gentle-eyes-resting.png',
            'urgent' => false,
            'location' => 'Plaza City Shelter',
            'vaccinated' => false,
            'spayed_neutered' => false,
            'good_with_kids' => false,
            'good_with_pets' => false,
        ],
        4 => [
            'name' => 'Rocky',
            'type' => 'Dog',
            'age' => 'Senior',
            'size' => 'Large',
            'breed' => 'Mixed Breed',
            'gender' => 'Male',
            'description' => 'Rocky, rescued from Manila Bay area, has stayed 42 days in the shelter. He\'s a calm and gentle soul who loves lounging in the sun and going for leisurely walks. Perfect for a quiet home.',
            'image' => 'images/white-and-brown-senior-dog-gentle-expression.png',
            'urgent' => false,
            'location' => 'Manila Bay Shelter',
            'vaccinated' => true,
            'spayed_neutered' => true,
            'good_with_kids' => false,
            'good_with_pets' => true,
        ],
        5 => [
            'name' => 'Cleo',
            'type' => 'Cat',
            'age' => 'Adult',
            'size' => 'Small',
            'breed' => 'Domestic Short Hair',
            'gender' => 'Female',
            'description' => 'Cleo was rescued in Mamallapuram and has been here 25 days. Independent yet loving, she enjoys sunny windowsills and gentle pets. She\'s a quiet observer who would make a perfect companion.',
            'image' => 'images/black-and-white-cat-sitting-on-wooden-surface.png',
            'urgent' => false,
            'location' => 'Mamallapuram Shelter',
            'vaccinated' => true,
            'spayed_neutered' => false,
            'good_with_kids' => true,
            'good_with_pets' => false,
        ],
        6 => [
            'name' => 'Whiskers',
            'type' => 'Cat',
            'age' => 'Kitten',
            'size' => 'Small',
            'breed' => 'Domestic Medium Hair',
            'gender' => 'Female',
            'description' => 'Whiskers, from Plaza City, has been in the shelter 10 days. This playful kitten brings joy wherever she goes. Full of energy and curiosity, she\'s ready to explore her forever home.',
            'image' => 'images/orange-tabby-kitten-cute-expression.png',
            'urgent' => false,
            'location' => 'Plaza City Shelter',
            'vaccinated' => true,
            'spayed_neutered' => true,
            'good_with_kids' => true,
            'good_with_pets' => true,
        ],
        7 => [
            'name' => 'Milo',
            'type' => 'Cat',
            'age' => 'Adult',
            'size' => 'Medium',
            'breed' => 'Tabby',
            'gender' => 'Male',
            'description' => 'Milo, rescued in Taguig City, has been here 39 days. Mischievous and curious, he loves exploring and playing with toys. He\'s a social butterfly who gets along with everyone.',
            'image' => 'images/orange-and-white-kitten-playful-expression.png',
            'urgent' => false,
            'location' => 'Taguig City Shelter',
            'vaccinated' => false,
            'spayed_neutered' => true,
            'good_with_kids' => true,
            'good_with_pets' => true,
        ],
        8 => [
            'name' => 'Oliver',
            'type' => 'Cat',
            'age' => 'Senior',
            'size' => 'Medium',
            'breed' => 'Domestic Long Hair',
            'gender' => 'Male',
            'description' => 'Oliver, from San Juan City, has been at the shelter 43 days. He\'s a dignified gentleman who enjoys the finer things in life - like sunny spots and gentle scratches. Perfect for a quiet home.',
            'image' => 'images/tabby-cat-lying-down-curious-expression.png',
            'urgent' => false,
            'location' => 'San Juan City Shelter',
            'vaccinated' => true,
            'spayed_neutered' => false,
            'good_with_kids' => false,
            'good_with_pets' => true,
        ],
    ];

    $pet = $pets[$id] ?? null;
    
    if (!$pet) {
        abort(404);
    }

    return view('pet-details', ['pet' => $pet]);
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin authentication routes (accessible without admin middleware)
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    
    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        
        // Redirect admin root to Pet Management
        Route::get('/', function () {
            return redirect()->route('admin.pets.index');
        });
        
        // Pet Management
        Route::resource('pets', AdminPetController::class);
        Route::post('pets/{pet}/toggle-availability', [AdminPetController::class, 'toggleAvailability'])->name('pets.toggle-availability');
        
        // Form Questions Management
        Route::resource('form-questions', FormQuestionController::class);
        Route::post('form-questions/{formQuestion}/toggle-active', [FormQuestionController::class, 'toggleActive'])->name('form-questions.toggle-active');
        Route::post('form-questions/reorder', [FormQuestionController::class, 'reorder'])->name('form-questions.reorder');
        
        // Adoption Applications Management
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('/', [AdoptionApplicationController::class, 'index'])->name('index');
            Route::get('{application}', [AdoptionApplicationController::class, 'show'])->name('show');
            Route::post('{application}/update-status', [AdoptionApplicationController::class, 'updateStatus'])->name('update-status');
            Route::post('bulk-action', [AdoptionApplicationController::class, 'bulkAction'])->name('bulk-action');
        });
        
        // Analytics
        Route::prefix('analytics')->name('analytics.')->group(function () {
            Route::get('/', [AnalyticsController::class, 'index'])->name('index');
            Route::get('export', [AnalyticsController::class, 'export'])->name('export');
        });
    });
});
