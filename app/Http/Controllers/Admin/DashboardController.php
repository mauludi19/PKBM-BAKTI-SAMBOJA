<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\News;
use App\Models\PpdbRegistration;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Tahun ajaran aktif
        $activeAcademicYear = AcademicYear::where('is_active', true)->first();

        // Statistik utama
        $statistics = [
            'total_students' => Student::count(),
            'total_tutors' => Tutor::count(),
            'total_users' => User::count(),
            'total_ppdb' => PpdbRegistration::count(),
            'total_news' => News::count(),
        ];

        // Statistik PPDB berdasarkan status
        $ppdbStatus = [
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
            'approved' => PpdbRegistration::where('status', 'approved')->count(),
            'rejected' => PpdbRegistration::where('status', 'rejected')->count(),
        ];

        // Statistik PPDB berdasarkan jenis pendaftaran
        $ppdbType = [
            'bop' => PpdbRegistration::where('registration_type', 'bop')->count(),
            'mandiri' => PpdbRegistration::where('registration_type', 'mandiri')->count(),
        ];

        // 5 pendaftaran PPDB terbaru
        $latestRegistrations = PpdbRegistration::latest()
            ->take(5)
            ->get();

        // 5 berita terbaru
        $latestNews = News::latest()
            ->take(5)
            ->get();

        // 5 user terbaru
        $latestUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'activeAcademicYear',
            'statistics',
            'ppdbStatus',
            'ppdbType',
            'latestRegistrations',
            'latestNews',
            'latestUsers'
        ));
    }
}