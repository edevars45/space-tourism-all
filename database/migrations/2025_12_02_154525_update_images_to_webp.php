<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Cette migration est vide car les seeders insèrent directement
     * les chemins d'images en .webp dans une nouvelle base de données.
     */
    public function up(): void
    {
        // Migration vide : pas besoin de modifier des données inexistantes
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rien à annuler
    }
};