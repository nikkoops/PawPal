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
    ];

    protected $casts = [
        'answers' => 'array',
        'reviewed_at' => 'datetime',
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

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Helper methods to access form data from JSON answers field
    public function getFirstNameAttribute()
    {
        return $this->answers['firstName'] ?? null;
    }

    public function getLastNameAttribute()
    {
        return $this->answers['lastName'] ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->answers['email'] ?? null;
    }

    public function getPhoneAttribute()
    {
        return $this->answers['phone'] ?? null;
    }

    public function getAddressAttribute()
    {
        return $this->answers['address'] ?? null;
    }

    public function getBirthDateAttribute()
    {
        return $this->answers['birthDate'] ?? null;
    }

    public function getOccupationAttribute()
    {
        return $this->answers['occupation'] ?? null;
    }

    public function getCompanyAttribute()
    {
        return $this->answers['company'] ?? null;
    }
}