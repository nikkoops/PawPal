<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    protected $fillable = [
        'name',
        'max_capacity'
    ];

    protected $casts = [
        'max_capacity' => 'integer',
    ];
}
