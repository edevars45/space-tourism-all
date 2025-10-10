<?php

use Illuminate\Support\Facades\Route; // J'importe l'API de routing Laravel
use Illuminate\Support\Facades\App; // J'importe App pour changer la langue
use Illuminate\Support\Facades\Session; // J'importe Session pour stocker la langue

// J'importe mes contrôleurs publics
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\PublicCrewController;

// J'importe le contrôleur du profil Breeze
use App\Http\Controllers\ProfileController;

// J'importe les contrôleurs du back-office
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Pages publiques (accès libre)
|--------------------------------------------------------------------------
*/

// Je définis la route de la page d'accueil
Route::view('/', 'pages.home')->name('home');

// Je redirige /destinations vers /destinations/moon
Route::redirect('/destinations', '/destinations/moon')->name('destinations');

// J'affiche une destination selon le segment {planet?}
Route::get('/destinations/{planet?}', [DestinationsController::class, 'show'])
    ->name('destinations.show');

// J'affiche l'équipage côté public
Route::get('/crew', [PublicCrewController::class, 'index'])->name('crew');

// Je garde la page de maquette Technologies
Route::view('/technology', 'pages.technology')->name('technology');

/*
|--------------------------------------------------------------------------
| Espace authentifié (Breeze)
|--------------------------------------------------------------------------
*/

// Je protège les routes dashboard et profil par 'auth'
Route::middleware('auth')->group(function () {
    // J'utilise la home comme dashboard pour simplifier
    Route::view('/dashboard', 'pages.home')->name('dashboard');

    // Je gère l'édition de profil Breeze
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Je charge les routes d'authentification Breeze (login, register, etc.)
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Commutateur de langue FR/EN
|--------------------------------------------------------------------------
*/

// Je stocke la langue en session et je la pousse dans App::setLocale()
Route::get('/lang/{locale}', function (string $locale) {
    // Je sécurise la langue attendue
    abort_unless(in_array($locale, ['fr','en']), 404);
    // Je mémorise la langue en session
    Session::put('locale', $locale);
    // J'applique la langue courante à l'exécution
    App::setLocale($locale);
    // Je reviens sur la page précédente
    return back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Back-office (Partie 07)
|--------------------------------------------------------------------------
|
| Je regroupe les routes /admin derrière 'auth' et 'verified'.
| Ensuite, je segmente par rôle/permission avec Spatie.
|
*/

Route::prefix('admin') // Je préfixe toutes les routes par /admin
    ->name('admin.') // Je préfixe tous les noms par admin.
    ->middleware(['auth', 'verified']) // J'exige une session et un email vérifié
    ->group(function () {

        // Gestion des UTILISATEURS — réservé aux Administrateurs
        Route::middleware(['role:Administrateur'])->group(function () {
            // Je génère toutes les routes REST sauf 'show'
            Route::resource('users', UserController::class)->except(['show']);
        });

        // Gestion des TECHNOLOGIES — protégé par la permission dédiée
        Route::middleware(['permission:technologies.manage'])->group(function () {
            // Je génère le CRUD des technologies côté back-office
            Route::resource('technologies', TechnologyController::class)->except(['show']);

            // Je garde les routes complémentaires d'ordre et d'actions groupées
            Route::post('technologies/{technology}/move-up',   [TechnologyController::class, 'moveUp'])->name('technologies.moveUp');
            Route::post('technologies/{technology}/move-down', [TechnologyController::class, 'moveDown'])->name('technologies.moveDown');
            Route::post('technologies/bulk',                   [TechnologyController::class, 'bulk'])->name('technologies.bulk');
            Route::post('technologies/reorder',                [TechnologyController::class, 'reorder'])->name('technologies.reorder');
        });

        // Si je veux segmenter Planètes/Équipage, je reproduis le même schéma avec leurs permissions
});
