<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mettre à jour les images de l'équipage (Crew)
        DB::table('crews')->where('name', 'Douglas Hurley')->update(['image' => 'crew/commander.webp']);
        DB::table('crews')->where('name', 'Mark Shuttleworth')->update(['image' => 'crew/specialist.webp']);
        DB::table('crews')->where('name', 'Victor Glover')->update(['image' => 'crew/pilot.webp']);
        DB::table('crews')->where('name', 'Anousheh Ansari')->update(['image' => 'crew/engineer.webp']);

        // Mettre à jour les images des destinations (Planets)
        DB::table('destinations')->where('name', 'Moon')->update(['image' => 'planets/moon.webp']);
        DB::table('destinations')->where('name', 'Mars')->update(['image' => 'planets/mars.webp']);
        DB::table('destinations')->where('name', 'Europa')->update(['image' => 'planets/europa.webp']);
        DB::table('destinations')->where('name', 'Titan')->update(['image' => 'planets/titan.webp']);

        // Mettre à jour les images des technologies
        DB::table('technologies')->where('name', 'Launch vehicle')->update(['image' => 'technologies/launch-vehicle.webp']);
        DB::table('technologies')->where('name', 'Space capsule')->update(['image' => 'technologies/space-capsule.webp']);
        DB::table('technologies')->where('name', 'Spaceport')->update(['image' => 'technologies/spaceport.webp']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retour aux anciens noms (optionnel)
        DB::table('crews')->where('name', 'Douglas Hurley')->update(['image' => 'crew/commander.png']);
        DB::table('crews')->where('name', 'Mark Shuttleworth')->update(['image' => 'crew/specialist.png']);
        DB::table('crews')->where('name', 'Victor Glover')->update(['image' => 'crew/pilot.png']);
        DB::table('crews')->where('name', 'Anousheh Ansari')->update(['image' => 'crew/engineer.png']);

        DB::table('destinations')->where('name', 'Moon')->update(['image' => 'planets/moon.png']);
        DB::table('destinations')->where('name', 'Mars')->update(['image' => 'planets/mars.png']);
        DB::table('destinations')->where('name', 'Europa')->update(['image' => 'planets/europa.png']);
        DB::table('destinations')->where('name', 'Titan')->update(['image' => 'planets/titan.png']);

        DB::table('technologies')->where('name', 'Launch vehicle')->update(['image' => 'technologies/launch-vehicle.jpg']);
        DB::table('technologies')->where('name', 'Space capsule')->update(['image' => 'technologies/space-capsule.jpg']);
        DB::table('technologies')->where('name', 'Spaceport')->update(['image' => 'technologies/spaceport.jpg']);
    }
};