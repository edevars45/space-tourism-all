<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    // J’affiche la liste des technologies en back-office.
    public function index()
    {
        // Je récupère toutes les technologies, triées par ordre puis par nom.
        $technologies = Technology::orderBy('order')->orderBy('name')->get();

        // Je retourne la vue d’index avec les données.
        return view('admin.technologies.index', compact('technologies'));
    }

    // J’affiche le formulaire de création.
    public function create()
    {
        // Je crée une instance vide pour le formulaire.
        $technology = new Technology();

        // Je retourne la vue de création.
        return view('admin.technologies.create', compact('technology'));
    }

    // J’enregistre une nouvelle technologie.
    public function store(TechnologyRequest $request)
    {
        // Je récupère les données validées.
        $data = $request->validated();

        // Je génère éventuellement le slug si le champ est vide.
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Je normalise la case publié (hidden 0 + checkbox 1).
        $data['is_published'] = !empty($data['is_published']);

        // Je gère l’upload d’image si présent.
        if ($request->hasFile('image')) {
            // Je stocke l’image dans storage/app/public/technologies.
            $path = $request->file('image')->store('technologies', 'public');
            // Je mets à jour le chemin d’image.
            $data['image_path'] = $path;
        }

        // Je crée l’enregistrement en base.
        Technology::create($data);

        // Je redirige vers la liste avec un message de succès.
        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie créée.');
    }

    // J’affiche le formulaire d’édition.
    public function edit(Technology $technology)
    {
        // Je retourne la vue d’édition avec la techno existante.
        return view('admin.technologies.edit', compact('technology'));
    }

    // Je mets à jour une technologie existante.
    public function update(TechnologyRequest $request, Technology $technology)
    {
        // Je récupère les données validées.
        $data = $request->validated();

        // Je génère le slug si nécessaire.
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Je normalise la case publié.
        $data['is_published'] = !empty($data['is_published']);

        // Je gère l’upload d’une nouvelle image.
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('technologies', 'public');
            $data['image_path'] = $path;
        }

        // Je mets à jour l’enregistrement.
        $technology->update($data);

        // Je redirige vers la liste avec un message.
        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie mise à jour.');
    }

    // Je supprime une technologie.
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()
            ->route('admin.technologies.index')
            ->with('success', 'Technologie supprimée.');
    }
}
