<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            // Ces colonnes existent déjà dans votre modèle, mais au cas où :
            if (!Schema::hasColumn('technologies', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('technologies', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });
    }
};
