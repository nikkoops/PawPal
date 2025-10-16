<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Check if the image file actually exists
     */
    public function imageFileExists()
    {
        if (!$this->image) {
            return false;
        }
        
        $path = storage_path('app/public/' . $this->image);
        return file_exists($path);
    }
    
    /**
     * Get the default image based on pet type
     */
    public function getDefaultImageUrl()
    {
        $type = strtolower($this->type ?? 'unknown');
        if ($type === 'dog') {
            return asset('images/default-dog.jpg');
        } elseif ($type === 'cat') {
            return asset('images/default-cat.jpg');
        } else {
            return asset('images/default-pet.jpg');
        }
    }
    
    /**
     * Get the image URL for the pet
     */
    public function getImageUrlAttribute()
    {
        // If no image, return default
        if (!$this->image) {
            return $this->getDefaultImageUrl();
        }
        
        // If file doesn't exist physically, return default
        if (!$this->imageFileExists()) {
            return $this->getDefaultImageUrl();
        }
        
        // Try to encode the image as base64 if we're having URL issues
        try {
            $imagePath = storage_path('app/public/' . $this->image);
            if (file_exists($imagePath) && filesize($imagePath) < 1048576) { // Less than 1MB for performance
                $imageData = base64_encode(file_get_contents($imagePath));
                return 'data:image/png;base64,' . $imageData;
            }
        } catch (\Exception $e) {
            // If base64 encoding fails, continue to URL approach
            \Illuminate\Support\Facades\Log::warning('Failed to base64 encode image: ' . $e->getMessage());
        }
        
        // Check if image already contains full URL or path
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        // Check if image starts with 'storage/' or not
        if (strpos($this->image, 'storage/') === 0) {
            return asset($this->image);
        }
        
        // Otherwise, use asset helper to get URL
        return asset('storage/' . $this->image);
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