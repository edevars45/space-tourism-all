<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'order',
        'image_path',
        'distance',
        'travel_time',
        'description',
        'description_en',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
