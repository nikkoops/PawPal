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
        'characteristics',
        'is_available',
        'adoption_fee',
        'medical_history',
        'is_vaccinated',
        'is_neutered',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'is_available' => 'boolean',
        'is_vaccinated' => 'boolean',
        'is_neutered' => 'boolean',
        'adoption_fee' => 'decimal:2',
    ];

    public function adoptionApplications()
    {
        return $this->hasMany(AdoptionApplication::class);
    }

    public function getCharacteristicsListAttribute()
    {
        return $this->characteristics ? implode(', ', $this->characteristics) : '';
    }
}