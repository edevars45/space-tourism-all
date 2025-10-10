<?php

use Illuminate\Support\Facades\Route;     // j’utilise l’API de routing Laravel
use Illuminate\Support\Facades\App;       // je peux forcer la langue (switch)
use Illuminate\Support\Facades\Session;   // je stocke la langue en session

// Pages publiques (maquette)
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\PublicCrewController;

// Espace authentifié (Breeze)
use App\Http\Controllers\ProfileController;

// Back-office (Partie 07)
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TechnologyController;

/*
|--------------------------------------------------------------------------
| 1) Pages publiques (accès libre)
|--------------------------------------------------------------------------
| Je déclare les pages visibles sans authentification.
*/

Route::view('/', 'pages.home')->name('home'); // home

// Destinations : je redirige /destinations vers /destinations/moon
Route::redirect('/destinations', '/destinations/moon')->name('destinations');
Route::get('/destinations/{planet?}', [DestinationsController::class, 'show'])
    ->name('destinations.show');

// Équipage public (fallback i18n si BDD vide)
Route::get('/crew', [PublicCrewController::class, 'index'])->name('crew');

// Technologies publiques (page maquette)
Route::view('/technology', 'pages.technology')->name('technology');


/*
|--------------------------------------------------------------------------
| 2) Espace authentifié (Breeze)
|--------------------------------------------------------------------------
| Je protège dashboard et le profil avec le middleware 'auth'.
*/

Route::middleware('auth')->group(function () {
    // pour le TP, je réutilise la home comme dashboard
    Route::view('/dashboard', 'pages.home')->name('dashboard');

    // gestion du profil (Breeze)
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes Breeze : login, register, reset, email verify, etc.
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3) Commutateur de langue FR/EN
|--------------------------------------------------------------------------
| Je force la locale souhaitée et je la stocke en session.
*/

Route::get('/lang/{locale}', function (string $locale) {
    // je limite aux langues supportées
    abort_unless(in_array($locale, ['fr','en']), 404);

    // je mémorise et j’applique la langue
    Session::put('locale', $locale);
    App::setLocale($locale);

    // je reviens sur la page précédente
    return back();
})->name('lang.switch');


/*
|--------------------------------------------------------------------------
| 4) Back-office (Partie 07) — auth + verified
|--------------------------------------------------------------------------
| Toutes les routes /admin exigent un compte connecté ET vérifié.
| Ensuite je segmente par rôle/permission via Spatie.
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {

        /*
        |------------------------------------------------------------------
        | 5) Utilisateurs — réservé aux Administrateurs
        |------------------------------------------------------------------
        | Seuls les Admins voient et utilisent le CRUD des utilisateurs.
        */
        Route::middleware(['role:Administrateur'])->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
            // routes générées : admin.users.index/create/store/edit/update/destroy
        });

        /*
        |------------------------------------------------------------------
        | 6) Technologies — protégé par la permission dédiée
        |------------------------------------------------------------------
        | Toute personne disposant de 'technologies.manage' accède au CRUD.
        | Je conserve aussi les routes d’actions additionnelles.
        */
        Route::middleware(['permission:technologies.manage'])->group(function () {
            Route::resource('technologies', TechnologyController::class)->except(['show']);
            Route::post('technologies/{technology}/move-up',   [TechnologyController::class, 'moveUp'])->name('technologies.moveUp');
            Route::post('technologies/{technology}/move-down', [TechnologyController::class, 'moveDown'])->name('technologies.moveDown');
            Route::post('technologies/bulk',                   [TechnologyController::class, 'bulk'])->name('technologies.bulk');
            Route::post('technologies/reorder',                [TechnologyController::class, 'reorder'])->name('technologies.reorder');
        });

        /*
        |------------------------------------------------------------------
        | 7) (Option) Autres modules back-office
        |------------------------------------------------------------------
        | Si je gère Planètes/Équipage en BDD, je reproduis exactement
        | le même schéma :
        |  - role:Gestionnaire Planètes  OU permission:planets.manage
        |  - role:Gestionnaire Équipage OU permission:crew.manage
        */
    });
