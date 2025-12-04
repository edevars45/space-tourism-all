# Space Tourism — P1 → P7

Projet pédagogique : Front public, i18n FR/EN, tests, back-office (Planètes / Équipage / Technologies),
gestion des utilisateurs & rôles (RBAC).
**Stack** : Laravel 11, PHP ≥ 8.2, Tailwind, Vite, Breeze, Spatie/laravel-permission.

---

## Sommaire
- [Fonctionnalités](#fonctionnalités)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration `.env`](#configuration-env)
- [Données de démo](#données-de-démo)
- [Comptes & rôles](#comptes--rôles)
- [Lancer le projet](#lancer-le-projet)
- [Tests](#tests)
- [Accessibilité & SEO](#accessibilité--seo)
- [i18n](#i18n)
- [Routes back-office](#routes-back-office)
- [Tags & archives](#tags--archives)
- [Dépannage](#dépannage)
- [Licence](#licence)

---

## Fonctionnalités
- **P1** Maquette Blade + Tailwind, responsive, SEO & a11y de base
- **P2** i18n FR/EN + switch langue
- **P3** Tests Feature FR/EN (routes) — **40 tests / 97 assertions OK**
- **P4** CRUD Planètes • **P5** CRUD Équipage • **P6** CRUD Technologies
- **P7** Auth Breeze, rôles Spatie, CRUD utilisateurs + garde-fous

---

## Prérequis
PHP 8.2+, Composer, Node 18+, MySQL 8 (ou SQLite)

---

## Installation
```bash
git clone https://github.com/edevars45/space-tourism-partie07.git
cd space-tourism-partie07
composer install
npm install
cp .env.example .env
"# space-tourism-all" 
