<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('planets', function (Blueprint $table) {
            // J'ajoute name_en après name (si ça n'existe pas déjà)
            if (!Schema::hasColumn('planets', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
            // J'ajoute description_en après description (si ça n'existe pas déjà)
            if (!Schema::hasColumn('planets', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('planets', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });
    }
};
