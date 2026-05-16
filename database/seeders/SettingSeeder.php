<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'PKBM Bakti Samboja',
            ],
            [
                'key' => 'site_email',
                'value' => 'info@pkbmbaktisamboja.sch.id',
            ],
            [
                'key' => 'site_phone',
                'value' => '081234567890',
            ],
            [
                'key' => 'site_address',
                'value' => 'Samboja, Kalimantan Timur',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
