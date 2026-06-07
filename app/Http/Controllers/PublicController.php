<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Package;
use App\Models\Page;
use App\Models\Student;
use App\Models\Tutor;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman utama website.
     */
    public function home()
    {
        $latestNews = News::where('is_published', true)
            ->latest()
            ->take(6)
            ->get();

        $pages = Page::whereIn('slug', [
            'profil',
            'visi-misi',
            'struktur-organisasi',
        ])->get();

        $statistics = [
            'total_students' => Student::count(),
            'total_tutors' => Tutor::count(),
            'total_packages' => Package::count(),
        ];

        return view('home', compact(
            'latestNews',
            'pages',
            'statistics'
        ));
    }

    /**
     * Menampilkan daftar tutor.
     */
    public function tutors()
    {
        $tutors = Tutor::with('user')
            ->latest()
            ->paginate(12);

        return view('tutors.index', compact('tutors'));
    }

    /**
     * Menampilkan daftar siswa per paket.
     */
    public function students()
    {
        $packages = Package::withCount('students')
            ->orderBy('name')
            ->get();

        $students = Student::with(['user', 'package'])
            ->latest()
            ->paginate(12);

        return view('students.index', compact(
            'packages',
            'students'
        ));
    }

    /**
     * Menampilkan halaman profil PKBM.
     */
    public function profile()
    {
        $profile = Page::where('slug', 'profil')->first();

        if (!$profile) {
            $profile = new Page([
                'title' => 'Profil PKBM Bakti Samboja',
                'slug' => 'profil',
                'content' => 'Halaman profil PKBM Bakti Samboja',
                'is_active' => true,
            ]);
        }

        $statistics = [
            'total_students' => Student::count(),
            'total_tutors' => Tutor::count(),
            'total_packages' => Package::count(),
        ];

        return view('public.profile', compact('profile', 'statistics'));
    }
}
