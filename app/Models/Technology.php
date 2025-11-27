<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    // J’autorise l’assignation de masse sur ces champs.
    protected $fillable = [
        'name',          // nom français
        'slug',          // slug
        'order',         // ordre d’affichage
        'description',   // description FR
        'website_url',   // URL officielle
        'image_path',    // chemin de l’image
        'name_en',       // nom anglais
        'description_en',// description anglaise
        'is_published',  // publié ou non
    ];

    // Je demande à Laravel de caster automatiquement vers booléen.
    protected $casts = [
        'is_published' => 'boolean',
    ];
}
