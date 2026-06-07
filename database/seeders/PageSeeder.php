<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Profil PKBM Bakti Samboja',
                'slug' => 'profil',
                'content' => 'Halaman profil PKBM Bakti Samboja - Pusat Kegiatan Belajar Masyarakat terpercaya.',
                'is_active' => true,
            ],
            [
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'content' => 'Visi dan Misi PKBM Bakti Samboja untuk memberikan pendidikan berkualitas kepada masyarakat.',
                'is_active' => true,
            ],
            [
                'title' => 'Struktur Organisasi',
                'slug' => 'struktur-organisasi',
                'content' => 'Struktur Organisasi PKBM Bakti Samboja beserta tugas dan tanggungjawab setiap unit.',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
