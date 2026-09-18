<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Mairie de Veckersviller',
            'site_tagline' => null,

            // Fichiers personnalisés via Filament.
            // Les valeurs par défaut sont dans public/images/.
            'logo_header' => null,
            'logo_footer' => null,
            'hero_image' => null,
        ]);
    }
}
