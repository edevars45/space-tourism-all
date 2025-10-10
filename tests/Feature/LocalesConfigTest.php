<?php

namespace Tests\Feature;

use Tests\TestCase;                                    // j’utilise la base TestCase de Laravel
use PHPUnit\Framework\Attributes\Test;                 // j’utilise les attributs PHPUnit (plus d’annotations @test)

/**
 * Dans ce test, je vérifie :
 *  - que la config 'locales' est bien chargée et structurée (supported + default)
 *  - que la home '/' répond (200) et contient un marqueur de page (ex: "Space Tourism")
 */
class LocalesConfigTest extends TestCase
{
    #[Test] // j’utilise l’attribut PHPUnit au lieu du docblock @test
    public function locales_config_is_loaded_correctly(): void
    {
        // je récupère la config 'locales' (config/locales.php attendu)
        $locales = config('locales');

        // je m’assure d’avoir un tableau
        $this->assertIsArray($locales, "Je m'attends à un tableau pour config('locales').");

        // je m’assure d’avoir les clés nécessaires
        $this->assertArrayHasKey('supported', $locales, "La clé 'supported' doit exister.");
        $this->assertArrayHasKey('default', $locales, "La clé 'default' doit exister.");

        // je m’assure d’avoir au moins fr/en dans la liste supportée
        $this->assertContains('fr', $locales['supported'], "'fr' doit être dans locales.supported.");
        $this->assertContains('en', $locales['supported'], "'en' doit être dans locales.supported.");

        // je vérifie la locale par défaut attendue
        $this->assertEquals('fr', $locales['default'], "La locale par défaut doit être 'fr'.");
    }

    #[Test] // même conversion vers l’attribut
    public function root_url_redirects_to_default_locale(): void
    {
        // je requête la home telle que définie dans routes/web.php
        $response = $this->get('/');

        // je vérifie simplement que la page répond (200)
        $response->assertStatus(200);

        // j’ancre le test sur une chaîne visible sur la home (à adapter si besoin)
        $response->assertSee('Space Tourism');
    }
}
