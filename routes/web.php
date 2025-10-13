<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\FormQuestionController;
use App\Http\Controllers\Admin\AdoptionApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\AdoptionApplication;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('home');

Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');

// API endpoint to get pet details by name
Route::get('/api/pets/by-name/{name}', [PetController::class, 'getByName']);

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

Route::post('/submit-adoption', function (Request $request) {
    // Detailed debug log to help trace submission issues
    Log::info('submit-adoption route hit', [
        'ip' => $request->ip(),
        'hasFile' => $request->hasFile('idUpload'),
        'all_keys' => array_keys($request->all()),
        'content_type' => $request->header('Content-Type'),
        'accept' => $request->header('Accept'),
        'isAjax' => $request->ajax(),
        'wantsJson' => $request->wantsJson(),
        'pet_id_present' => $request->has('pet_id'),
        'pet_id_value' => $request->input('pet_id'),
        'raw_request' => $request->all()
    ]);

    $isAjax = $request->wantsJson() || $request->ajax();

    $rules = [
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'address' => 'required|string|max:1000',
        'phone' => 'required|string|max:50',
        'email' => 'required|email|max:255',
        'birthDate' => 'required|date',
        'occupation' => 'required|string|max:255',
        'idUpload' => $request->hasFile('idUpload') ? 'file|mimes:png,jpg,jpeg,pdf|max:10240' : 'required',
        // other fields are optional or validated client-side
    ];
    
    // Additional debugging for the file
    if ($request->hasFile('idUpload')) {
        $file = $request->file('idUpload');
        Log::info('File data', [
            'originalName' => $file->getClientOriginalName(),
            'mimeType' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'error' => $file->getError()
        ]);
    } else {
        Log::warning('No file uploaded', [
            'has_idUpload_key' => $request->has('idUpload'),
            'all_files' => $request->allFiles(),
            'file_keys' => array_keys($request->allFiles())
        ]);
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        // Log validation failures for debugging
        Log::info('Validation failed', [
            'errors' => $validator->errors()->toArray(),
            'request_data' => $request->except(['idUpload'])
        ]);
        
        if ($isAjax) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Store uploaded ID
    $idPath = null;
    if ($request->hasFile('idUpload')) {
        try {
            $file = $request->file('idUpload');
            $idPath = $file->store('adoption_ids', 'public');
            Log::info('File uploaded successfully', ['path' => $idPath]);
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error uploading file: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->withErrors(['idUpload' => 'Error uploading file: ' . $e->getMessage()])->withInput();
        }
    }

    // Save adoption application
    $answers = $request->except(['idUpload']);
    
    try {
        // Create application with basic fields
        $application = new AdoptionApplication();
        $application->user_id = null; // will be linked to user if logged in
        
        // Log all request keys for debugging
        Log::info('All request data keys:', [
            'all_request_keys' => array_keys($request->all()),
            'pet_id_value' => $request->input('pet_id'),
            'pet_name' => $request->input('pet_name'),
            'has_pet_id_key' => $request->has('pet_id')
        ]);
        
        // Associate with pet if pet_id is provided (ensure it's properly converted to integer)
        $petId = $request->input('pet_id');
        if (!empty($petId)) {
            $petId = intval($petId);
            if ($petId > 0) {
                // Check if pet exists
                $pet = \App\Models\Pet::find($petId);
                if ($pet) {
                    $application->pet_id = $petId;
                    Log::info('Pet found and linked to application', [
                        'pet_id' => $petId, 
                        'pet_name' => $pet->name,
                        'pet_breed' => $pet->breed,
                        'pet_type' => $pet->type
                    ]);
                } else {
                    $application->pet_id = null;
                    Log::error('Pet ID exists but pet not found in database: ' . $petId);
                }
            } else {
                $application->pet_id = null;
                Log::warning('Invalid pet_id value: ' . $request->input('pet_id'));
            }
        } else {
            $application->pet_id = null;
            Log::warning('No pet_id provided in form submission');
        }
        
        // Store all form data in the JSON answers field (as designed in migration)
        $application->answers = $answers;
        $application->status = 'pending';
        $application->save();
    } catch (\Exception $e) {
        Log::error('Error saving adoption application: ' . $e->getMessage(), [
            'exception' => $e,
            'trace' => $e->getTraceAsString()
        ]);
        
        if ($isAjax) {
            return response()->json([
                'success' => false, 
                'message' => 'Database error: ' . $e->getMessage()
            ], 500);
        }
        
        return redirect()->back()->with('error', 'Error saving application. Please try again.');
    }

    if ($isAjax) {
        return response()->json(['success' => true, 'application_id' => $application->id]);
    }

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
        Route::get('pets-filter', [AdminPetController::class, 'filter'])->name('pets.filter');
        Route::post('pets/{pet}/toggle-availability', [AdminPetController::class, 'toggleAvailability'])->name('pets.toggle-availability');
        
        // Form Questions Management
        Route::resource('form-questions', FormQuestionController::class);
        Route::post('form-questions/{formQuestion}/toggle-active', [FormQuestionController::class, 'toggleActive'])->name('form-questions.toggle-active');
        Route::post('form-questions/reorder', [FormQuestionController::class, 'reorder'])->name('form-questions.reorder');
        
        // Adoption Applications Management
        Route::prefix('applications')->name('applications.')->group(function () {
            Route::get('/', [AdoptionApplicationController::class, 'index'])->name('index');
            Route::get('filter', [AdoptionApplicationController::class, 'filter'])->name('filter');
            Route::get('{application}', [AdoptionApplicationController::class, 'show'])->name('show');
            Route::get('{application}/details', [AdoptionApplicationController::class, 'getApplicationDetails'])->name('details');
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
