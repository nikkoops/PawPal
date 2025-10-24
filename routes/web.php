<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\FormQuestionController;
use App\Http\Controllers\Admin\AdoptionApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\AdoptionApplication;
use App\Models\Pet;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SystemAdminController;
use App\Http\Controllers\Admin\ShelterAdminController;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index'])->name('home');

Route::get('/logo-test', function () {
    return view('logo-test');
});

Route::get('/find-pets', [PetController::class, 'findPets'])->name('find-pets');

Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');

// API endpoint to get pet details by name
Route::get('/api/pets/by-name/{name}', [PetController::class, 'getByName']);

// Adoption acknowledgment page (shown first)
Route::get('/adopt', function () {
    $petName = request()->query('pet');
    return view('adoption-acknowledgment', ['petName' => $petName]);
});

// Adoption application form (shown after acknowledgment)
Route::get('/adoption/application', function () {
    $petName = request()->query('pet');
    return view('adopt', ['petName' => $petName]);
})->name('adoption.application');

Route::get('/about', function () {
    return view('about');
});

Route::get('/learn-more', function () {
    return view('learn-more');
});

Route::get('/success-stories', function () {
    return view('success-stories');
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
        'idUpload' => $request->hasFile('idUpload') ? 'file|mimes:png,jpg,jpeg,pdf|max:5120' : 'required',
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

    // Store uploaded home photos
    $homePhotosPaths = [];
    Log::info('Checking for home photos', [
        'hasFile' => $request->hasFile('homePhotos'),
        'files_count' => $request->hasFile('homePhotos') ? count($request->file('homePhotos')) : 0
    ]);
    
    if ($request->hasFile('homePhotos')) {
        try {
            $files = $request->file('homePhotos');
            Log::info('Processing home photos', ['count' => count($files)]);
            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('home_photos', 'public');
                    $homePhotosPaths[] = $path;
                    Log::info('Home photo uploaded successfully', [
                        'index' => $index,
                        'path' => $path,
                        'original_name' => $file->getClientOriginalName()
                    ]);
                } else {
                    Log::warning('Invalid home photo file', ['index' => $index]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Home photos upload error: ' . $e->getMessage());
        }
    } else {
        Log::warning('No home photos files found in request');
    }

    // Save adoption application
    $answers = $request->except(['idUpload', 'homePhotos', '_token']);
    
    // Remove any homePhotos key that might have snuck in
    unset($answers['homePhotos']);
    
    // Add file paths to answers
    if ($idPath) {
        $answers['id_upload_path'] = $idPath;
    }
    if (!empty($homePhotosPaths)) {
        $answers['home_photos_paths'] = $homePhotosPaths;
    }
    
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

// API endpoint to get all pets for adoption site
Route::get('/api/pets', function () {
    $pets = Pet::where('is_available', true)->get();
    // Add is_urgent flag if needed (e.g., days in shelter > 21)
    $pets->transform(function ($pet) {
        $pet->is_urgent = isset($pet->days_in_shelter) ? $pet->days_in_shelter > 21 : false;
        return $pet;
    });
    return response()->json($pets);
});

Route::get('/pet-details/{id}', function ($id) {
    $pet = Pet::find($id);
    if (!$pet || !$pet->is_available) {
        abort(404);
    }
    // Add is_urgent flag for view
    $pet->is_urgent = isset($pet->days_in_shelter) ? $pet->days_in_shelter > 21 : false;
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
        
        // Redirect admin root based on role
        Route::get('/', function () {
            $user = auth()->user();
            if ($user->role === 'system_admin') {
                return redirect()->route('admin.system.dashboard');
            } else {
                return redirect()->route('admin.shelter.pets.index');
            }
        });
        
        // SYSTEM ADMIN ROUTES (System Admin Only)
        Route::middleware(['role:system_admin'])->prefix('system')->name('system.')->group(function () {
            // System Admin Dashboard
            Route::get('dashboard', [SystemAdminController::class, 'index'])->name('dashboard');
            
            // User Management (CRUD for admins)
            Route::get('users', [SystemAdminController::class, 'users'])->name('users');
            Route::get('users/create', [SystemAdminController::class, 'createUser'])->name('users.create');
            Route::post('users', [SystemAdminController::class, 'storeUser'])->name('users.store');
            Route::get('users/{user}/edit', [SystemAdminController::class, 'editUser'])->name('users.edit');
            Route::put('users/{user}', [SystemAdminController::class, 'updateUser'])->name('users.update');
            Route::delete('users/{user}', [SystemAdminController::class, 'deleteUser'])->name('users.delete');
            
            // System Analytics
            Route::get('analytics', [SystemAdminController::class, 'analytics'])->name('analytics');
            Route::get('analytics/export', [SystemAdminController::class, 'exportAnalytics'])->name('analytics.export');
        });
        
        // SHELTER ADMIN ROUTES (Shelter Admin Only)
        Route::middleware(['role:shelter_admin'])->prefix('shelter')->name('shelter.')->group(function () {
            // Shelter Admin Dashboard - REMOVED: Shelter admins go directly to Pet Management
            // Route::get('dashboard', [ShelterAdminController::class, 'index'])->name('dashboard');
            
            // Pet Management (accessible from shelter dashboard)
            Route::resource('pets', AdminPetController::class);
            Route::get('pets-filter', [AdminPetController::class, 'filter'])->name('pets.filter');
            Route::post('pets/{pet}/toggle-availability', [AdminPetController::class, 'toggleAvailability'])->name('pets.toggle-availability');
            
            // Adoption Applications Management
            Route::prefix('applications')->name('applications.')->group(function () {
                Route::get('/', [AdoptionApplicationController::class, 'index'])->name('index');
                Route::get('filter', [AdoptionApplicationController::class, 'filter'])->name('filter');
                Route::get('export', [AdoptionApplicationController::class, 'export'])->name('export');
                Route::get('{application}', [AdoptionApplicationController::class, 'show'])->name('show');
                Route::get('{application}/details', [AdoptionApplicationController::class, 'getApplicationDetails'])->name('details');
                Route::post('{application}/update-status', [AdoptionApplicationController::class, 'updateStatus'])->name('update-status');
                Route::post('bulk-action', [AdoptionApplicationController::class, 'bulkAction'])->name('bulk-action');
            });
            
            // Shelter Analytics
            Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');
            Route::get('analytics/export', [AnalyticsController::class, 'export'])->name('analytics.export');
            
            // Settings
            Route::get('settings', [ShelterAdminController::class, 'settings'])->name('settings');
            Route::post('settings/password', [ShelterAdminController::class, 'updatePassword'])->name('settings.password');
        });
        
        // SHARED ROUTES (Accessible by both roles - kept for backward compatibility)
        // Form Questions Management (both can access)
        Route::resource('form-questions', FormQuestionController::class);
        Route::post('form-questions/{formQuestion}/toggle-active', [FormQuestionController::class, 'toggleActive'])->name('form-questions.toggle-active');
        Route::post('form-questions/reorder', [FormQuestionController::class, 'reorder'])->name('form-questions.reorder');
    });
});
