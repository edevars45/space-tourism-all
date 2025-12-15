<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrewMembersSeeder extends Seeder
{
    public function run(): void
    {
        $table = 'crew_members';
        if (! Schema::hasTable($table)) {
            return;
        }

        $now = now();

        $data = [
            [
                'order'      => 1,
                'role'       => 'Commandant',
                'name'       => 'Douglas Hurley',
                'bio'        => "Douglas Gerald Hurley est un ingénieur et ancien astronaute.",
                'photo_path' => 'crew/douglas-hurley.webp',
                'published'  => true,
            ],
            [
                'order'      => 2,
                'role'       => 'Pilote',
                'name'       => 'Victor Glover',
                'bio'        => "Pilote d'essai et astronaute de la NASA.",
                'photo_path' => 'crew/victor-glover.webp',
                'published'  => true,
            ],
            [
                'order'      => 3,
                'role'       => 'Spécialiste de mission',
                'name'       => 'Mark Shuttleworth',
                'bio'        => "Entrepreneur et premier touriste spatial africain.",
                'photo_path' => 'crew/mark-shuttleworth.webp',
                'published'  => true,
            ],
            [
                'order'      => 4,
                'role'       => 'Ingénieure',
                'name'       => 'Anousheh Ansari',
                'bio'        => "Ingénieure et première femme touriste spatiale.",
                'photo_path' => 'crew/anousheh-ansari.webp',
                'published'  => true,
            ],
        ];

        // Liste des colonnes réellement présentes (on ne pousse que ce qui existe)
        $cols = Schema::getColumnListing($table);

        foreach ($data as $row) {
            // slug obligatoire si la colonne existe et est NOT NULL
            if (in_array('slug', $cols)) {
                // si tu veux des slugs uniques même avec des noms identiques, concatène le rôle
                $row['slug'] = Str::slug($row['name']);
            }

            $row['created_at'] = $now;
            $row['updated_at'] = $now;

            // Ne garder que les clés existantes dans la table
            $filtered = array_intersect_key($row, array_flip($cols));

            // Déterminer la clé d'unicité pour l'upsert
            $unique = in_array('slug', $cols)
                ? ['slug']
                : (in_array('name', $cols) && in_array('role', $cols) ? ['name','role'] : ['name']);

            // Upsert compatible SQLite
            DB::table($table)->updateOrInsert(
                array_intersect_key($filtered, array_flip($unique)),
                $filtered
            );
        }
    }
}