<?php
// ===========================================================
// FR — Page Équipage (fallback i18n si BDD vide)
// ===========================================================
return [
    'title'       => 'Équipage',
    'heading'     => 'Rencontrez l’équipage',
    'goto_member' => 'Aller au membre de l’équipage',

    'members' => [
        'commander' => [
            'name'  => 'Douglas Hurley',
            'role'  => 'Commandant',
            'bio'   => "Pilote d’essai et astronaute chevronné, il a commandé plusieurs missions et supervise les opérations critiques à bord.",
            'alt'   => "Portrait du commandant Douglas Hurley",
            'image' => 'images/crew/commander.png',
        ],
        'engineer' => [
            'name'  => 'Anousheh Ansari',
            'role'  => 'Ingénieure de vol',
            'bio'   => "Entrepreneuse et ingénieure ; elle gère les systèmes de soutien de vie et coordonne les réparations techniques en vol.",
            'alt'   => "Portrait de l’ingénieure de vol Anousheh Ansari",
            'image' => 'images/crew/engineer.png',
        ],
        'pilot' => [
            'name'  => 'Victor Glover',
            'role'  => 'Pilote',
            'bio'   => "Spécialiste des manœuvres orbitales, responsable des approches, des amarrages et des trajectoires complexes.",
            'alt'   => "Portrait du pilote Victor Glover",
            'image' => 'images/crew/pilot.png',
        ],
        'specialist' => [
            'name'  => 'Mark Shuttleworth',
            'role'  => 'Spécialiste de mission',
            'bio'   => "En charge des expériences scientifiques à bord et de l’analyse des données en temps réel.",
            'alt'   => "Portrait du spécialiste de mission Mark Shuttleworth",
            'image' => 'images/crew/specialist.png',
        ],
    ],
];
