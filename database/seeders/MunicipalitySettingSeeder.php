<?php

namespace Database\Seeders;

use App\Models\MunicipalitySetting;
use Illuminate\Database\Seeder;

class MunicipalitySettingSeeder extends Seeder
{
    public function run(): void
    {
        MunicipalitySetting::create([
            'address' => '30, rue de l\'Église',
            'postal_code' => '57370',
            'city' => 'Veckersviller',
            'contact_email' => 'mairie@veckersviller.fr',
            'contact_phone' => '03 87 08 01 87',
        ]);
    }
}
