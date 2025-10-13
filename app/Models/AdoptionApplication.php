<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_id',
        'answers',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
        // Individual form fields
        'first_name',
        'last_name',
        'address',
        'phone',
        'email',
        'birth_date',
        'occupation',
        'company',
        'social_media',
        'pronouns',
        'housing_type',
        'housing_ownership',
        'landlord_name',
        'landlord_phone',
        'yard_type',
        'household_size',
        'household_members',
        'allergies',
        'previous_pets',
        'previous_pets_details',
        'current_pets',
        'veterinarian_name',
        'veterinarian_phone',
        'pet_care_experience',
        'daily_routine',
        'emergency_plan',
        'reference1_name',
        'reference1_phone',
        'reference1_relationship',
        'reference2_name',
        'reference2_phone',
        'reference2_relationship',
        'additional_comments',
        'submitted_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'reviewed_at' => 'datetime',
        'birth_date' => 'date',
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUnderReview($query)
    {
        return $query->where('status', 'under_review');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}