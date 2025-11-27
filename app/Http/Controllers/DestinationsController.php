<?php

namespace App\Http\Controllers;

use App\Models\Planet;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class DestinationsController extends Controller
{
    /**
     * J’affiche la page /destinations/{planet?}.
     * Je lis les planètes dans la base (table planets).
     * Je choisis la langue FR/EN en fonction de App::getLocale().
     */
    public function show(?string $planetSlug = 'moon'): View
    {
        // Je récupère la langue courante (fr ou en).
        $locale = App::getLocale();

        // Ici je mets le code dont tu parles :
        // je récupère toutes les planètes publiées, triées par "order".
        $planets = Planet::query()
            ->where('is_published', true)  // colonne is_published dans la table planets
            ->orderBy('order')             // colonne order dans la table planets
            ->get();

        // Si je n’ai aucune planète publiée, je renvoie une erreur simple.
        if ($planets->isEmpty()) {
            abort(404, 'Aucune planète publiée dans la base.');
        }

        // Je cherche la planète courante par slug (moon, mars, europa, titan…).
        $current = $planetSlug
            ? $planets->firstWhere('slug', $planetSlug)
            : null;

        // Si le slug est invalide ou absent, je prends la première planète.
        if (!$current) {
            $current = $planets->first();
        }

        // Je construis le tableau $data comme ta vue Blade l’attend (name, desc, distance, time).
        $data = [
            'name' => $locale === 'en'
                ? ($current->name_en ?: $current->name)
                : $current->name,

            'desc' => $locale === 'en'
                ? ($current->description_en ?: $current->description)
                : $current->description,

            'distance' => $current->distance,
            'time'     => $current->travel_time,
        ];

        // Je prépare aussi un tableau $allPlanets pour les onglets dans la vue.
        $allPlanets = [];
        foreach ($planets as $p) {
            $allPlanets[$p->slug] = [
                'name' => $locale === 'en'
                    ? ($p->name_en ?: $p->name)
                    : $p->name,

                'desc' => $locale === 'en'
                    ? ($p->description_en ?: $p->description)
                    : $p->description,

                'distance' => $p->distance,
                'time'     => $p->travel_time,
            ];
        }

        // J’envoie exactement ce que ta vue resources/views/pages/destinations.blade.php utilise :
        // - $planet  (slug courant)
        // - $data    (données de la planète courante)
        // - $planets (toutes les planètes pour les onglets)
        return view('pages.destinations', [
            'planet'  => $current->slug,
            'data'    => $data,
            'planets' => $allPlanets,
        ]);
    }
}
