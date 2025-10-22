<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PetImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'image_path',
        'display_order',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Get the pet that owns the image
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image_path) {
            return asset('images/default-pet.png');
        }

        // Generate clean URL without double slashes
        // Remove 'pets/' prefix if it exists since we'll add it
        $imagePath = str_replace('pets/', '', $this->image_path);
        
        // Build URL with proper formatting - ensure port 8000 for Docker
        $baseUrl = request()->getSchemeAndHttpHost();
        if (strpos($baseUrl, ':8000') === false && strpos($baseUrl, 'localhost') !== false) {
            $baseUrl = str_replace('localhost', 'localhost:8000', $baseUrl);
        }
        
        return $baseUrl . '/storage/pets/' . $imagePath;
    }

    /**
     * Scope to get images in display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    /**
     * Scope to get primary image
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }
}
