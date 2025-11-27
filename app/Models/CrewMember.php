<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    use HasFactory;

    protected $table = 'crew_members';

    protected $fillable = [
        'name',
        'slug',
        'role',      // FR
        'role_en',   // EN
        'bio',       // FR
        'bio_en',    // EN
        'order',
        'image_path',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
