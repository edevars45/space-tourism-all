Space Tourism — P1 à P7

Projet pédagogique mené en 7 parties : intégration, i18n, tests, back-office (Planètes / Équipage / Technologies), gestion des utilisateurs et des rôles (RBAC).
Stack : Laravel 11, PHP 8.2+, Tailwind, Breeze, Spatie laravel-permission, Vite.

Objectifs : site public accessible (RGAA/WCAG), SEO de base, back-office complet, i18n FR/EN, tests d’intégration, rôles/permissions, et gestion de versions propre (tags P1…P7).

Sommaire

Fonctionnalités par partie

Stack & prérequis

Installation

A. Installation rapide (Laragon / MySQL)

B. Variante SQLite (zéro config)

Configuration .env

Données de démo (seeders + JSON)

Comptes & rôles

Lancer le projet

Exécution des tests

Accessibilité & SEO

i18n (FR/EN)

Routes utiles (back-office)

Tags Git & archives livrables

Dépannage

Licence

Fonctionnalités par partie

P1 — Maquette / Intégration

Intégration des pages publiques en Blade + Tailwind.

Mise en page responsive fidèle à la maquette, comportement adapté entre breakpoints.

Base SEO (titres, metas, OG) + structure sémantique.

Bonnes pratiques d’accessibilité (libellés, ordre de tabulation, skip-link, contrastes).

P2 — Internationalisation

FR/EN pour l’interface publique (textes, menus, messages).

Commutateur de langue persistant, ergonomique et accessible.

P3 — Tests des routes

Suite de tests Feature (FR/EN) : statut HTTP, rendu de vues, éléments clés visibles.

Tous les tests passent (40/40 au moment du dernier run).

P4 — Back-office Planètes (CRUD)

Liste / Création / Édition / Suppression.

Validation cohérente, messages d’erreur clairs.

Synchronisation immédiate des contenus avec le front.

P5 — Back-office Équipage (CRUD)

Même expérience et règles que Planètes.

Upload/chemin d’image géré.

P6 — Back-office Technologies (CRUD)

Même logique que Planètes / Équipage.

P7 — Gestion des utilisateurs + rôles/permissions

Authentification Laravel Breeze.

Spatie laravel-permission : Administrateur, Gestionnaire Planètes, Gestionnaire Équipage, Gestionnaire Technologies.

CRUD utilisateurs + affectation des rôles depuis le back-office.

Verrous de sécurité (ex. un admin ne peut pas se supprimer seul s’il est le dernier).

Stack & prérequis

PHP 8.2+

Composer

Node 18+ (Vite)

MySQL 8 (Laragon/XAMPP) ou SQLite (variante simple)

Laravel 11

Breeze (auth)

Spatie/laravel-permission

Installation
A. Installation rapide (Laragon / MySQL)
git clone https://github.com/edevars45/space-tourism-partie07.git
cd space-tourism-partie07

composer install
npm install

# .env
cp .env.example .env
# -> Voir section "Configuration .env" (profil MySQL)

# Créer la base (Laragon)
mysql -u root -e "CREATE DATABASE IF NOT EXISTS space_tourism_partie07 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

php artisan key:generate
php artisan migrate:fresh --seed

# optionnel : build assets
npm run build

B. Variante SQLite (zéro config)
git clone https://github.com/edevars45/space-tourism-partie07.git
cd space-tourism-partie07

composer install
npm install

cp .env.example .env
# -> Voir section "Configuration .env" (profil SQLite)

# Crée physiquement la base si besoin :
type NUL > database\database.sqlite   # (Windows)
# touch database/database.sqlite      # (macOS/Linux)

php artisan key:generate
php artisan migrate:fresh --seed

Configuration .env
Profil MySQL (Laragon par défaut)
APP_NAME="Space Tourism"
APP_ENV=local
APP_KEY=            # sera rempli par `php artisan key:generate`
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

APP_LOCALE=fr
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=fr_FR

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306        # si Laragon utilise 3307, mets 3307
DB_DATABASE=space_tourism_partie07
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

FILESYSTEM_DISK=public

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"

Profil SQLite
APP_NAME="Space Tourism"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

APP_LOCALE=fr
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=fr_FR

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

FILESYSTEM_DISK=public
MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

VITE_APP_NAME="${APP_NAME}"

Données de démo (seeders + JSON)

Seeders principaux :
RolesAndPermissionsSeeder, AdminUserSeeder, PlanetsSeeder, CrewMembersSeeder, TechnologySeeder.

Data JSON : database/data/planets.json, crew_members.json, technologies.json.
Les seeders lisent ces fichiers et upsert les lignes en respectant les colonnes présentes en base (détectées via Schema::hasColumn).

Recharger la base :
php artisan migrate:fresh --seed

Comptes & rôles

Admin par défaut (seeder) :
Email admin@example.com — Mot de passe password

À changer immédiatement en environnement réel.

Rôles :

Administrateur : accès total (+ gestion utilisateurs)

Gestionnaire Planètes : CRUD planètes

Gestionnaire Équipage : CRUD équipage

Gestionnaire Technologies : CRUD technologies

Lancer le projet
# Backend
php artisan serve

# Front (Vite)
npm run dev


Back-office (après login) :
/admin/planets, /admin/crew, /admin/technologies, /admin/users.

Exécution des tests
php artisan test


Couvre les routes publiques FR/EN, l’auth, le profil, et divers comportements.

Dernier run : 40 tests / 97 assertions – OK.

Accessibilité & SEO

Accessibilité : liens “Aller au contenu”, focus visibles, labels, contrastes, navigation clavier, texte des boutons explicite.

SEO : titres structurés, metas de base, balises Open Graph, structure sémantique.

i18n (FR/EN)

Sélecteur global (FR/EN), accessible, position cohérente dans le header.

Les pages conservent le contexte lors du switch de langue.

Textes externalisés dans lang/fr et lang/en.

Routes utiles (back-office)

Planètes : admin/planets

Équipage : admin/crew

Technologies : admin/technologies

Utilisateurs : admin/users

Lang switch : lang/{locale} (ex. lang/fr, lang/en)

Tags Git & archives livrables

Des tags marquent chaque partie :

p1 → Maquette + SEO + accessibilité

p2 → i18n FR/EN

p3 → Tests routes

p4 → CRUD Planètes

p5 → CRUD Équipage

p6 → CRUD Technologies

p7 → Gestion utilisateurs + RBAC

Créer des zips propres à remettre :

git archive --format=zip --output ../edevars_space_p1.zip p1
git archive --format=zip --output ../edevars_space_p2.zip p2
git archive --format=zip --output ../edevars_space_p3.zip p3
git archive --format=zip --output ../edevars_space_p4.zip p4
git archive --format=zip --output ../edevars_space_p5.zip p5
git archive --format=zip --output ../edevars_space_p6.zip p6
git archive --format=zip --output ../edevars_space_p7.zip p7


Archive globale (Windows PowerShell) :

powershell -NoProfile -Command "Compress-Archive -Path * -DestinationPath ../edevars_space_all.zip -Force -CompressionLevel Optimal"

Dépannage

“Internal Server Error” lors d’un git push :
git fetch, puis git pull --rebase origin main, résoudre les conflits, git push --force-with-lease origin main.

MySQL ne démarre pas (Laragon) : vérifier my.ini, port (3306/3307), service MySQL80 démarré, puis :

php artisan migrate:fresh --seed


Police sur inputs (texte invisible) : la feuille admin force un fond clair pour les inputs (admin-scope).

Licence

Usage pédagogique. © 2025 — Auteurs & contributeurs du projet Space Tourism.
