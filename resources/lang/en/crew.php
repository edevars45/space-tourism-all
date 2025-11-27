<?php
// ===========================================================
// EN — Crew Page (i18n fallback if DB is empty)
// ===========================================================
return [
    'title'   => 'Crew',
    'heading' => 'Meet Your Crew',
    'goto_member' => 'Go to crew member',

    'members' => [
        'commander' => [
            'name'  => 'Douglas Hurley',
            'role'  => 'Commander',
            'bio'   => "A test pilot and seasoned astronaut, he has commanded several missions and oversees critical onboard operations.",
            'alt'   => "Portrait of Commander Douglas Hurley",
            'image' => 'images/crew/commander.png',
        ],
        'engineer' => [
            'name'  => 'Anousheh Ansari',
            'role'  => 'Flight Engineer',
            'bio'   => "Entrepreneur and engineer; manages life-support systems and coordinates in-flight technical repairs.",
            'alt'   => "Portrait of Flight Engineer Anousheh Ansari",
            'image' => 'images/crew/engineer.png',
        ],
        'pilot' => [
            'name'  => 'Victor Glover',
            'role'  => 'Pilot',
            'bio'   => "Specialist in orbital maneuvers, responsible for approaches, docking, and complex trajectories.",
            'alt'   => "Portrait of Pilot Victor Glover",
            'image' => 'images/crew/pilot.png',
        ],
        'specialist' => [
            'name'  => 'Mark Shuttleworth',
            'role'  => 'Mission Specialist',
            'bio'   => "In charge of scientific experiments onboard and real-time data analysis.",
            'alt'   => "Portrait of Mission Specialist Mark Shuttleworth",
            'image' => 'images/crew/specialist.png',
        ],
    ],
];
