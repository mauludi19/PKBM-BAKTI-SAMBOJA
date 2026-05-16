<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paket A',
                'description' => 'Program pendidikan setara SD',
            ],
            [
                'name' => 'Paket B',
                'description' => 'Program pendidikan setara SMP',
            ],
            [
                'name' => 'Paket C',
                'description' => 'Program pendidikan setara SMA',
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['name' => $package['name']],
                $package
            );
        }
    }
}
