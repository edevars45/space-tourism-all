<?php
return [
    'title'        => 'Destinations',
    'heading'      => 'Choisissez votre destination',
    'distance'     => 'Distance moyenne',
    'travel_time'  => 'Temps de trajet',

    // Données des planètes (slug => données)
    'planets' => [
        'moon' => [
            'name'     => 'Lune',
            'desc'     => "Découvrez notre satellite naturel, la Lune. Un paysage majestueux et tranquille où l’humanité a fait ses premiers pas hors de la Terre.",
            'distance' => '384 400 km',
            'time'     => '3 jours',
            'image'    => 'images/destinations/moon.png',
        ],
        'mars' => [
            'name'     => 'Mars',
            'desc'     => "La planète rouge vous attend avec ses dunes orangées et ses horizons infinis. Une aventure interplanétaire pleine de mystères.",
            'distance' => '225 millions km',
            'time'     => '9 mois',
            'image'    => 'images/destinations/mars.png',
        ],
        'europa' => [
            'name'     => 'Europe',
            'desc'     => "La lune glacée de Jupiter, recouverte d’une croûte de glace et peut-être d’un océan souterrain.",
            'distance' => '628 millions km',
            'time'     => '6 ans',
            'image'    => 'images/destinations/europa.png',
        ],
        'titan' => [
            'name'     => 'Titan',
            'desc'     => "La plus grande lune de Saturne, avec son atmosphère dense et ses mers d’hydrocarbures.",
            'distance' => '1,6 milliards km',
            'time'     => '7 ans',
            'image'    => 'images/destinations/titan.png',
        ],
    ],
];
