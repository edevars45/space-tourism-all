<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('crew_members', function (Blueprint $table) {
            $table->string('role_en')->nullable()->after('role');
            $table->text('bio_en')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('crew_members', function (Blueprint $table) {
            $table->dropColumn(['role_en', 'bio_en']);
        });
    }
};
