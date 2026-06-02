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

        // =========================
        // STATISTIK UTAMA
        // =========================
        $statistics = [
            'total_students' => Student::count(),
            'total_tutors'   => Tutor::count(),
            'total_users'    => User::count(),
            'total_ppdb'     => PpdbRegistration::count(),
            'total_news'     => News::count(),
        ];

        // =========================
        // STATUS PPDB
        // =========================
        $ppdbStatus = PpdbRegistration::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ppdbStatus = [
            'pending'  => $ppdbStatus['pending'] ?? 0,
            'approved' => $ppdbStatus['approved'] ?? 0,
            'rejected' => $ppdbStatus['rejected'] ?? 0,
        ];

        // =========================
        // JENIS PENDAFTARAN PPDB
        // =========================
        $ppdbType = PpdbRegistration::selectRaw('registration_type, COUNT(*) as total')
            ->groupBy('registration_type')
            ->pluck('total', 'registration_type');

        $ppdbType = [
            'bop'     => $ppdbType['bop'] ?? 0,
            'mandiri' => $ppdbType['mandiri'] ?? 0,
        ];

        // =========================
        // DATA TERBARU
        // =========================
        $latestRegistrations = PpdbRegistration::latest()->take(5)->get();
        $latestNews          = News::latest()->take(5)->get();
        $latestUsers         = User::latest()->take(5)->get();

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