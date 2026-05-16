<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // User yang sedang login
        $user = Auth::user();

        // Data tutor berdasarkan user login
        $tutor = Tutor::where('user_id', $user->id)->first();

        // Jika data tutor tidak ditemukan
        if (! $tutor) {
            abort(404, 'Data tutor tidak ditemukan.');
        }

        // Statistik dashboard tutor
        $statistics = [
            'total_subjects' => $tutor->subjects()->count(),
            'total_grades' => Grade::where('tutor_id', $tutor->id)->count(),
            'total_students' => Grade::where('tutor_id', $tutor->id)
                ->distinct('student_id')
                ->count('student_id'),
        ];

        // Mata pelajaran yang diampu
        $subjects = $tutor->subjects()->get();

        // 10 nilai terbaru yang diinput tutor
        $latestGrades = Grade::with(['student.user', 'subject'])
            ->where('tutor_id', $tutor->id)
            ->latest()
            ->take(10)
            ->get();

        return view('tutor.dashboard', compact(
            'tutor',
            'statistics',
            'subjects',
            'latestGrades'
        ));
    }
}
