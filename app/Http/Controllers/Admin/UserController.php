<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;       // J'hérite du contrôleur de base
use App\Http\Requests\UserStoreRequest;    // J'importe ma request de création
use App\Http\Requests\UserUpdateRequest;   // J'importe ma request de mise à jour
use App\Models\User;                       // J'importe le modèle User
use Illuminate\Http\Request;               // J'importe Request pour la recherche
use Illuminate\Support\Facades\Hash;       // J'importe Hash pour le mot de passe
use Spatie\Permission\Models\Role;         // J'importe les rôles Spatie

class UserController extends Controller
{
    // J'affiche la liste des utilisateurs avec recherche et pagination
    public function index(Request $request)
    {
        // Je récupère le terme de recherche éventuel
        $q = $request->string('q')->toString();

        // Je construis la requête avec un filtre conditionnel
        $users = User::query()
            ->when($q, fn($qq) => $qq->where('name','like',"%{$q}%")
                                      ->orWhere('email','like',"%{$q}%"))
            ->orderBy('name')     // Je trie par nom
            ->paginate(12)        // Je pagine 12 par page
            ->withQueryString();  // Je conserve le filtre dans la pagination

        // Je renvoie la vue index avec les données
        return view('admin.users.index', compact('users','q'));
    }

    // J'affiche le formulaire de création
    public function create()
    {
        // Je récupère les rôles disponibles pour les cases à cocher
        $roles = Role::orderBy('name')->pluck('name','name'); // Je récupère ['NomRole' => 'NomRole']
        return view('admin.users.create', compact('roles'));
    }

    // Je traite la création d'un utilisateur
    public function store(UserStoreRequest $request)
    {
        // Je récupère les données validées
        $data = $request->validated();

        // Je crée l'utilisateur en hashant le mot de passe
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // J'assigne les rôles sélectionnés
        $user->syncRoles($data['roles']);

        // Je redirige vers l'index avec un message flash
        return redirect()->route('admin.users.index')->with('success','Utilisateur créé.');
    }

    // J'affiche le formulaire d'édition
    public function edit(User $user)
    {
        // Je récupère tous les rôles disponibles
        $roles = Role::orderBy('name')->pluck('name','name');

        // Je prépare la liste des rôles cochés pour cet utilisateur
        $userRoles = $user->roles()->pluck('name')->toArray();

        // Je renvoie la vue d'édition
        return view('admin.users.edit', compact('user','roles','userRoles'));
    }

    // Je traite la mise à jour d'un utilisateur
    public function update(UserUpdateRequest $request, User $user)
    {
        // Je récupère les données validées
        $data = $request->validated();

        // Je mets à jour les colonnes simples
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Je ne change le mot de passe que si on m'en a fourni un
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // J'enregistre les modifications
        $user->save();

        // Je synchronise les rôles
        $user->syncRoles($data['roles']);

        // Je redirige avec un message de succès
        return redirect()->route('admin.users.index')->with('success','Utilisateur mis à jour.');
    }

    // Je supprime un utilisateur
    public function destroy(User $user)
    {
        // Je bloque la suppression de mon propre compte
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Je ne peux pas supprimer mon propre compte.');
        }

        // Je supprime l'utilisateur
        $user->delete();

        // Je redirige avec un message de succès
        return redirect()->route('admin.users.index')->with('success','Utilisateur supprimé.');
    }
}
