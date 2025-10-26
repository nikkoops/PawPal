<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdopterConfirmationMail;

class AdoptionFormController extends Controller
{
    public function submit(Request $request)
    {
        // Prevent duplicate applications for the same email and pet within the last 10 minutes
        $petId = $request->input('pet_id') ?? $request->input('pet') ?? null;
        $email = $request->input('email');
        $recentDuplicate = \App\Models\AdoptionApplication::where('pet_id', $petId)
            ->whereJsonContains('answers->email', $email)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->first();
        if ($recentDuplicate) {
            return response()->json(['success' => false, 'message' => 'You have already submitted an application for this pet recently. Please wait before submitting again.'], 429);
        }

        // Handle file uploads
        $answers = $request->except(['_token', 'idUpload', 'homePhotos']);
        if ($request->hasFile('idUpload')) {
            $idPath = $request->file('idUpload')->store('adoption_ids', 'public');
            $answers['idUploadUrl'] = asset('storage/' . $idPath);
        }
        if ($request->hasFile('homePhotos')) {
            $homePhotoFiles = $request->file('homePhotos');
            $homePhotoUrls = [];
            foreach ((array)$homePhotoFiles as $photo) {
                $photoPath = $photo->store('adoption_home_photos', 'public');
                $homePhotoUrls[] = asset('storage/' . $photoPath);
            }
            $answers['homePhotosUrls'] = $homePhotoUrls;
        }

        // Save the adoption application to the database
        $adoptionApp = new \App\Models\AdoptionApplication();
        $adoptionApp->pet_id = $petId;
        $adoptionApp->answers = $answers;
        $adoptionApp->status = 'pending';
        $adoptionApp->save();
        Log::info('submit-adoption route hit', [
            'ip' => $request->ip(),
            'hasFile' => $request->hasFile('idUpload'),
            'all_keys' => array_keys($request->all()),
            'content_type' => $request->header('Content-Type'),
        ]);

        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'birthDate' => 'required|date',
            'occupation' => 'required|string|max:255',
            'idUpload' => $request->hasFile('idUpload') ? 'file|mimes:png,jpg,jpeg,pdf|max:5120' : 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info('Validation failed', ['errors' => $validator->errors()]);
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // ✅ Send confirmation email (wrap in try/catch so mail failures don't break form submission)
        try {
            Log::info('Attempting to send adopter confirmation email', ['to' => $request->email]);
            // Prepare a copy of the submitted answers for the email (exclude files and token)
            $answers = $request->except(['_token', 'idUpload', 'homePhotos']);

            // Use the failover mailer: try SMTP first, fall back to logging if SMTP fails.
            Mail::mailer('failover')->to($request->email)->send(new AdopterConfirmationMail($request->firstName, $answers));
            Log::info('Adopter confirmation email sent (or logged via failover)', ['to' => $request->email]);
            $emailMessage = 'Confirmation email sent.';
        } catch (\Throwable $e) {
            // Log the exception but don't fail the whole request
            Log::error('Failed to send adopter confirmation email', [
                'to' => $request->email,
                'exception' => $e->getMessage(),
            ]);
            $emailMessage = 'Confirmation email could not be sent at this time.';
        }

        return response()->json(['success' => true, 'message' => 'Form submitted successfully. ' . $emailMessage]);
    }
}
