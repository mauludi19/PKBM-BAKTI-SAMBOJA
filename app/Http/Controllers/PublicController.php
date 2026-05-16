<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Page;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Package;

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
}