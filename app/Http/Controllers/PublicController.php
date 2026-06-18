<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Package;
use App\Models\Page;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman utama website.
     */
    public function home()
    {
        $latestNews = Schema::hasTable('news')
            ? News::where('is_published', true)->latest()->take(6)->get()
            : collect();

        $pages = Schema::hasTable('pages')
            ? Page::whereIn('slug', [
                'profil',
                'visi-misi',
                'struktur-organisasi',
            ])->get()
            : collect();

        $statistics = [
            'total_students' => Schema::hasTable('students') ? Student::count() : 0,
            'total_tutors' => Schema::hasTable('tutors') ? Tutor::count() : 0,
            'total_packages' => Schema::hasTable('packages') ? Package::count() : 0,
        ];

        return view('public.home', compact(
            'latestNews',
            'pages',
            'statistics'
        ));
    }

    public function about()
    {
        return $this->profile();
    }

    public function packages()
    {
        $packages = Package::orderBy('name')->get();

        return view('public.packages', compact('packages'));
    }

    /**
     * Menampilkan daftar tutor.
     */
    public function tutors()
    {
        $tutors = Tutor::with('user')
            ->latest()
            ->paginate(12);

        return view('public.tutors', compact('tutors'));
    }

    public function news()
    {
        $news = News::where('is_published', true)
            ->latest()
            ->paginate(9);

        return view('public.news', compact('news'));
    }

    public function contact()
    {
        return view('public.contact');
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
