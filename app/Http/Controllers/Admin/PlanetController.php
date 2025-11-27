<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanetRequest;
use App\Models\Planet;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlanetController extends Controller
{
    /**
     * J’affiche la liste des planètes dans le back-office.
     */
    public function index(): View
    {
        $planets = Planet::query()
            ->orderBy('order')
            ->get();

        return view('admin.planets.index', [
            'planets' => $planets,
        ]);
    }

    /**
     * J’affiche le formulaire de création.
     */
    public function create(): View
    {
        // Je crée un modèle vide pour réutiliser le même _form.blade.php
        $planet = new Planet();

        return view('admin.planets.create', [
            'planet' => $planet,
        ]);
    }

    /**
     * J’enregistre une nouvelle planète.
     */
    public function store(PlanetRequest $request): RedirectResponse
    {
        $data = $this->buildDataFromRequest($request);

        // Si l’ordre n’est pas renseigné, je place la planète en dernier.
        if (! array_key_exists('order', $data) || $data['order'] === null) {
            $maxOrder = Planet::max('order') ?? 0;
            $data['order'] = $maxOrder + 1;
        }

        Planet::create($data);

        return redirect()
            ->route('admin.planets.index')
            ->with('success', 'La planète a bien été créée.');
    }

    /**
     * J’affiche le formulaire d’édition d’une planète.
     */
    public function edit(Planet $planet): View
    {
        return view('admin.planets.edit', [
            'planet' => $planet,
        ]);
    }

    /**
     * Je mets à jour une planète existante.
     */
    public function update(PlanetRequest $request, Planet $planet): RedirectResponse
    {
        $data = $this->buildDataFromRequest($request);

        // Si l’ordre est laissé vide, je garde l’ordre actuel.
        if (array_key_exists('order', $data) && $data['order'] === null) {
            unset($data['order']);
        }

        $planet->update($data);

        return redirect()
            ->route('admin.planets.edit', $planet)
            ->with('success', 'La planète a bien été mise à jour.');
    }

    /**
     * Je supprime une planète.
     */
    public function destroy(Planet $planet): RedirectResponse
    {
        $planet->delete();

        return redirect()
            ->route('admin.planets.index')
            ->with('success', 'La planète a bien été supprimée.');
    }

    /**
     * Je centralise la construction du tableau $data à partir de PlanetRequest.
     * - Je mappe published -> is_published (colonne en BDD)
     * - Je gère l’upload d’image (image_upload)
     * - Je nettoie les champs inutiles.
     */
    protected function buildDataFromRequest(PlanetRequest $request): array
    {
        // Je récupère les données déjà validées par PlanetRequest
        $data = $request->validated();

        // Je mappe le champ du formulaire "published" vers la colonne "is_published"
        $data['is_published'] = $data['published'] ?? false;
        unset($data['published']);

        // Je gère le fichier uploadé, si présent
        if ($request->hasFile('image_upload')) {
            // Je stocke l’image dans storage/app/public/planets
            $path = $request->file('image_upload')->store('planets', 'public');
            // Je remplace le chemin texte par le chemin réel
            $data['image'] = $path;
        }

        // Si le champ texte image est vide, je mets null
        if (empty($data['image'] ?? null)) {
            $data['image'] = null;
        }

        // Je supprime la clé du fichier pour ne pas tenter de l’enregistrer en BDD
        unset($data['image_upload']);

        return $data;
    }
}
