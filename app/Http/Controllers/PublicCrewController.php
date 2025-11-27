<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CrewMember;
use Illuminate\Support\Facades\App;

class PublicCrewController extends Controller
{
    public function index()
    {
        $locale = App::getLocale(); // "fr" ou "en"

        // 1) On récupère les membres publiés, triés par "order" puis par id
        $members = CrewMember::query()
            ->where('is_published', true)
            ->orderBy('order')
            ->orderBy('id')
            ->get()
            ->map(function (CrewMember $member) use ($locale) {
                // Le nom reste identique
                $name = $member->name;

                // Le rôle et la bio changent selon la langue
                if ($locale === 'en') {
                    // Si les champs EN sont vides, on garde le français
                    $role = !empty($member->role_en) ? $member->role_en : $member->role;
                    $bio  = !empty($member->bio_en) ? $member->bio_en : $member->bio;
                } else {
                    $role = $member->role;
                    $bio  = $member->bio;
                }

                // Image
                if ($member->image_path) {
                    $imageUrl = asset('storage/' . ltrim($member->image_path, '/'));
                } else {
                    $imageUrl = asset('images/crew/' . $member->slug . '.webp');
                }

                return [
                    'name'  => $name,
                    'role'  => $role,
                    'bio'   => $bio,
                    'image' => $imageUrl,
                    'alt'   => $name,
                ];
            })
            ->values()
            ->all();

        // 2) Si la BDD est vide, on retombe sur la maquette i18n
        if (empty($members)) {
            $translatedMembers = __('crew.members');

            if (is_array($translatedMembers)) {
                $members = collect($translatedMembers)
                    ->map(function ($m) {
                        return [
                            'name'  => $m['name'] ?? '',
                            'role'  => $m['role'] ?? '',
                            'bio'   => $m['bio'] ?? '',
                            'image' => isset($m['image']) ? asset($m['image']) : null,
                            'alt'   => $m['alt'] ?? ($m['name'] ?? ''),
                        ];
                    })
                    ->values()
                    ->all();
            }
        }

        return view('pages.crew', [
            'members'   => $members,
            'heading'   => __('crew.heading'),
            'pageTitle' => __('crew.title'),
        ]);
    }
}
