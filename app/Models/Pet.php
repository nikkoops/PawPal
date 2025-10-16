<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'breed',
        'age',
        'gender',
        'description',
        'image',
        'size',
        'location',
        'characteristics',
        'is_available',
        'adoption_fee',
        'medical_history',
        'is_vaccinated',
        'is_neutered',
        'date_added',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'is_available' => 'boolean',
        'is_vaccinated' => 'boolean',
        'is_neutered' => 'boolean',
        'adoption_fee' => 'decimal:2',
        'age' => 'decimal:2',
        'date_added' => 'date',
    ];

    public function adoptionApplications()
    {
        return $this->hasMany(AdoptionApplication::class);
    }

    public function getCharacteristicsListAttribute()
    {
        return $this->characteristics ? implode(', ', $this->characteristics) : '';
    }

    /**
     * Get the number of days the pet has been in the shelter
     */
    public function getDaysInShelterAttribute()
    {
        if (!$this->date_added) {
            return 0;
        }
        
        return floor($this->date_added->diffInDays(now()));
    }

    /**
     * Check if the pet is urgent (7+ days in shelter and still available)
     */
    public function getIsUrgentAttribute()
    {
        return $this->is_available && $this->days_in_shelter >= 7;
    }

    /**
     * Get urgency reason for display
     */
    public function getUrgentReasonAttribute()
    {
        if (!$this->is_urgent) {
            return null;
        }
        
        return "In shelter for {$this->days_in_shelter} days";
    }

    /**
     * Get age in human-readable format
     */
    public function getAgeDisplayAttribute()
    {
        if (!$this->age) {
            return 'Unknown age';
        }
        
        if ($this->age < 1) {
            $months = round($this->age * 12);
            return $months . ($months == 1 ? ' month' : ' months');
        }
        
        $years = floor($this->age);
        return $years . ($years == 1 ? ' year' : ' years');
    }
    
    /**
     * Verify image file exists in public directory
     */
    public function imageFileExists()
    {
        if (!$this->image) {
            return false;
        }
        
        return file_exists(public_path($this->image));
    }
    
    /**
     * Get the image URL for the pet
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Generate clean URL without double slashes
        // Remove 'pets/' prefix if it exists since we'll add it
        $imagePath = str_replace('pets/', '', $this->image);
        
        // Build URL with proper formatting
        return url('storage/pets/' . $imagePath);
    }

    /**
     * Scope to get urgent pets
     */
    public function scopeUrgent($query)
    {
        return $query->where('is_available', true)
                    ->where('date_added', '<=', now()->subDays(7));
    }
}