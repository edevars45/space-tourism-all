<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Je rajoute la colonne order à la table crew_members.
     */
    public function up(): void
    {
        Schema::table('crew_members', function (Blueprint $table) {
            // Je rajoute un entier pour l’ordre d’affichage.
            $table->unsignedInteger('order')->default(0);
        });
    }

    /**
     * Je retire la colonne si je rollback.
     */
    public function down(): void
    {
        Schema::table('crew_members', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
