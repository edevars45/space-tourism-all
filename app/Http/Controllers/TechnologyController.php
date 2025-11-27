<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use Illuminate\Support\Facades\App;

class TechnologyController extends Controller
{
    public function show(?string $slug = null)
    {
        $locale = App::getLocale(); // "fr" ou "en"

        // Je récupère toutes les technologies publiées, triées par ordre
        $technologies = Technology::query()
            ->where('is_published', true)
            ->orderBy('order')
            ->get();

        // Si aucune technologie n'est publiée, j'affiche une erreur
        if ($technologies->isEmpty()) {
            abort(404, 'Aucune technologie disponible.');
        }

        // Si un slug est fourni, je cherche la technologie correspondante
        if ($slug) {
            $currentTechnology = $technologies->firstWhere('slug', $slug);

            // Si le slug n'existe pas, je prends la première technologie
            if (!$currentTechnology) {
                $currentTechnology = $technologies->first();
            }
        } else {
            // Si aucun slug n'est fourni, je prends la première technologie
            $currentTechnology = $technologies->first();
        }

        return view('pages.technology', [
            'technologies'      => $technologies,
            'currentTechnology' => $currentTechnology,
            'locale'            => $locale,
        ]);
    }
}
