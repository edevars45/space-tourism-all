<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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

// Technologies publiques : CORRECTION ICI
// J'enlève la contrainte where() pour permettre les slugs avec tirets
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
    // Je vérifie que la langue est valide
    if (!in_array($locale, ['fr', 'en'])) {
        abort(404);
    }

    // Je sauvegarde la langue dans la session
    Session::put('locale', $locale);
    App::setLocale($locale);

    // Je redirige vers la page précédente
    return redirect()->back();
})->name('lang.switch');


/*
|--------------------------------------------------------------------------
| 4) Back-office — auth + rôles/permissions
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        // Utilisateurs — réservé aux Administrateurs
        Route::middleware(['role:Administrateur'])->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
        });

        // Technologies — permission:technologies.manage
        Route::middleware(['permission:technologies.manage'])->group(function () {
            Route::resource('technologies', TechnologyController::class)->except(['show']);
        });

        // Planètes — permission:planets.manage
        Route::middleware(['permission:planets.manage'])->group(function () {
            Route::resource('planets', PlanetController::class)->except(['show']);
        });

        // Équipage — permission:crew.manage
        Route::middleware(['permission:crew.manage'])->group(function () {
            Route::resource('crew', CrewMemberController::class)->except(['show']);
        });
    });
