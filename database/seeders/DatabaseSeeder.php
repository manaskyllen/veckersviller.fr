<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            MunicipalitySettingSeeder::class,
            OpeningHourSeeder::class,
            MailSettingSeeder::class,
        ]);
    }
}
