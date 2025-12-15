<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Pages publiques (maquette)
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\PublicCrewController;
use App\Http\Controllers\TechnologyController as PublicTechnologyController;

// Espace authentifié (Breeze)
use App\Http\Controllers\ProfileController;

// Back-office (Partie 07)
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\PlanetController;
use App\Http\Controllers\Admin\CrewMemberController;

/*
|--------------------------------------------------------------------------
| 1) Pages publiques (accès libre)
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::view('/', 'pages.home')->name('home');

// Destinations
Route::redirect('/destinations', '/destinations/moon')->name('destinations');

Route::get('/destinations/{slug?}', [DestinationsController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('destinations.show');

// Équipage public (fallback i18n si BDD vide)
Route::get('/crew', [PublicCrewController::class, 'index'])
    ->name('crew');

// Technologies publiques
Route::get('/technology/{slug?}', [PublicTechnologyController::class, 'show'])
    ->name('technology');


/*
|--------------------------------------------------------------------------
| 2) Espace authentifié (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'pages.home')->name('dashboard');

    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes d'authentification (login/register/etc.)
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3) Commutateur de langue FR/EN
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function (string $locale) {
    if (!in_array($locale, ['fr', 'en'])) {
        abort(404);
    }

    Session::put('locale', $locale);
    App::setLocale($locale);

    return redirect()->back();
})->name('lang.switch');


/*
|--------------------------------------------------------------------------
| 4) Routes de CONNEXION D'URGENCE (Bypass 419)
|--------------------------------------------------------------------------
| À SUPPRIMER APRÈS AVOIR CORRIGÉ LE PROBLÈME D'ENVIRONNEMENT.
*/

// Route de connexion simple
Route::get('/login-bypass', function () {
    $user = User::first(); 
    Auth::login($user); 
    session()->save();
    
    return redirect('/')->with('success', 'Connecté en bypass !');
});

// Route d'accès direct à l'administration
Route::get('/admin-bypass', function () {
    $user = User::first(); 
    Auth::login($user);
    session()->save();
    
    // Redirige directement vers la liste des utilisateurs (admin)
    return redirect('/admin/users');
});


/*
|--------------------------------------------------------------------------
| 5) Back-office — auth + rôles/permissions
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| 5) Back-office — AUTHENTIFICATION DÉSACTIVÉE TEMPORAIREMENT
|--------------------------------------------------------------------------
| ⚠️ MIDDLEWARE AUTH DÉSACTIVÉ POUR CONTOURNER LE BUG DE SESSION DOCKER/WINDOWS
| À RÉACTIVER IMMÉDIATEMENT APRÈS AVOIR CORRIGÉ L'ENVIRONNEMENT
*/
Route::prefix('admin')
    ->name('admin.')
    // ->middleware(['auth'])  // ⚠️ DÉSACTIVÉ TEMPORAIREMENT
    ->group(function () {

        // Utilisateurs — TEMPORAIREMENT SANS RESTRICTION
        // Route::middleware(['role:Administrateur'])->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
        // });

        // Technologies — TEMPORAIREMENT SANS RESTRICTION
        // Route::middleware(['permission:technologies.manage'])->group(function () {
            Route::resource('technologies', TechnologyController::class)->except(['show']);
        // });

        // Planètes — TEMPORAIREMENT SANS RESTRICTION
        // Route::middleware(['permission:planets.manage'])->group(function () {
            Route::resource('planets', PlanetController::class)->except(['show']);
        // });

        // Équipage — TEMPORAIREMENT SANS RESTRICTION
        // Route::middleware(['permission:crew.manage'])->group(function () {
            Route::resource('crew', CrewMemberController::class)->except(['show']);
        // });
    });