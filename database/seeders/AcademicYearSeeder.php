<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        AcademicYear::updateOrCreate(
            [
                'year' => '2025/2026',
            ],
            [
                'is_active' => true,
            ]
        );
    }
}