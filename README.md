---
created: 2025-09-15T08:20
updated: 2025-09-15T11:52
completed: true
author(s):
  - TL
time: 01:00
chapter: TP - Space Tourism Project - User Stories
type: TP
---

# TP - Space Tourism - Partie 7 — Gestion des utilisateurs & rôles (Breeze + Spatie)

Ce dépôt contient la **Partie 07** du projet *Space Tourism*.
Objectif : mettre en place la **gestion des utilisateurs** (CRUD back-office) et le **RBAC** avec *spatie/laravel-permission*.

---

## Stack & Prérequis

- Laravel 11 (Breeze pour l’auth)
- PHP 8.2+ (Laragon : vhost Apache, mod_rewrite)
- Base de données : **SQLite**
- Paquet : `spatie/laravel-permission` (v6.x)

---

## Installation rapide

```bash
# cloner le projet
git clone https://github.com/edevars45/space-tourism-partie07.git
cd space-tourism-partie07

# dépendances
composer install
npm install && npm run build # (optionnel si front)

# .env
cp .env.example .env
# éditer .env :
# APP_URL=http://space-tourism-partie07.test
# DB_CONNECTION=sqlite
# DB_DATABASE=C:/laragon/www/space-tourism-partie07/database/database.sqlite
# SESSION_DRIVER=file

# BDD
php artisan key:generate
php artisan migrate
php artisan db:seed  # inclut le seeder RolesAndPermissionsSeeder

# caches
php artisan optimize:clear
