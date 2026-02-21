<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'hero_description'],
            [
                'label' => 'Hero Description',
                'value' => 'Experience premium living in the heart of the city. Our kost offers modern facilities, high-speed internet, and a cozy atmosphere for students and professionals.'
            ]
        );
    }
}
