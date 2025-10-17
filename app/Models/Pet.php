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
        'is_dewormed',
        'is_tick_flea_treated',
        'on_preventive_medication',
        'has_special_medical_needs',
        'is_mobility_impaired',
        'is_undergoing_treatment',
        'date_added',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'is_available' => 'boolean',
        'is_vaccinated' => 'boolean',
        'is_neutered' => 'boolean',
        'is_dewormed' => 'boolean',
        'is_tick_flea_treated' => 'boolean',
        'on_preventive_medication' => 'boolean',
        'has_special_medical_needs' => 'boolean',
        'is_mobility_impaired' => 'boolean',
        'is_undergoing_treatment' => 'boolean',
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
     * CRITICAL: This method must return consistent values between admin and public views
     */
    public function getAgeDisplayAttribute()
    {
        if (is_null($this->age) || $this->age == 0) {
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
     * Get age category for display purposes
     * Uses specific age ranges: 0-11 months = Puppy/Kitten, 1-6 years = Adult, 7+ years = Senior
     * For cats: 11-12+ years = Senior
     */
    public function getAgeCategoryAttribute()
    {
        if (is_null($this->age) || $this->age == 0) {
            return 'Adult'; // Default category for unknown ages
        }
        
        // 0-11 months = Puppy or Kitten
        if ($this->age < 1) {
            return $this->type === 'cat' ? 'Kitten' : 'Puppy';
        }
        
        // For cats: 11+ years = Senior, for dogs: 7+ years = Senior
        $seniorAge = $this->type === 'cat' ? 11 : 7;
        
        if ($this->age >= $seniorAge) {
            return 'Senior';
        }
        
        // 1-6 years (or 1-10 for cats) = Adult
        return 'Adult';
    }

    /**
     * Get age category for filtering purposes (lowercase for filters)
     * Maps database age to category labels used in public filters
     */
    public function getAgeFilterCategoryAttribute()
    {
        if (is_null($this->age) || $this->age == 0) {
            return 'adult'; // Default category for unknown ages
        }
        
        if ($this->age < 1) {
            return 'puppy'; // Covers both kittens and puppies for filtering
        }
        
        if ($this->age < 7) {
            return 'adult';
        }
        
        return 'senior';
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
        
        // Build URL with proper formatting - ensure port 8000 for Docker
        $baseUrl = request()->getSchemeAndHttpHost();
        if (strpos($baseUrl, ':8000') === false && strpos($baseUrl, 'localhost') !== false) {
            $baseUrl = str_replace('localhost', 'localhost:8000', $baseUrl);
        }
        
        return $baseUrl . '/storage/pets/' . $imagePath;
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