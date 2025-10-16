<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Role constants
    const ROLE_SYSTEM_ADMIN = 'system_admin';
    const ROLE_SHELTER_ADMIN = 'shelter_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'role',
        'shelter_location',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Check if user is a system admin
     */
    public function isSystemAdmin(): bool
    {
        return $this->role === self::ROLE_SYSTEM_ADMIN;
    }

    /**
     * Check if user is a shelter admin
     */
    public function isShelterAdmin(): bool
    {
        return $this->role === self::ROLE_SHELTER_ADMIN;
    }

    /**
     * Get the dashboard route based on user role
     */
    public function getDashboardRoute(): string
    {
        return match($this->role) {
            self::ROLE_SYSTEM_ADMIN => 'admin.pets.index',
            self::ROLE_SHELTER_ADMIN => 'admin.pets.index',
            default => 'home',
        };
    }

    /**
     * Get list of NCR shelter locations
     */
    public static function getShelterLocations(): array
    {
        return [
            'Manila Shelter',
            'Quezon City Shelter',
            'Makati Shelter',
            'Pasig Shelter',
            'Taguig Shelter',
            'Mandaluyong Shelter',
            'San Juan Shelter',
            'Pasay Shelter',
            'Parañaque Shelter',
            'Las Piñas Shelter',
            'Muntinlupa Shelter',
            'Caloocan Shelter',
            'Malabon Shelter',
            'Navotas Shelter',
            'Valenzuela Shelter',
            'Marikina Shelter',
            'Pateros Shelter',
        ];
    }

    /**
     * Check if user has a specific shelter location assigned
     */
    public function hasShelterLocation(): bool
    {
        return !empty($this->shelter_location);
    }
}
