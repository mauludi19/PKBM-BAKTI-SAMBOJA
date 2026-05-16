<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // User yang sedang login
        $user = Auth::user();

        // Data student berdasarkan user login
        $student = Student::with('package')
            ->where('user_id', $user->id)
            ->first();

        // Jika data student tidak ditemukan
        if (! $student) {
            abort(404, 'Data siswa tidak ditemukan.');
        }

        // Statistik dashboard siswa
        $statistics = [
            'total_grades' => Grade::where('student_id', $student->id)->count(),
            'average_final_grade' => Grade::where('student_id', $student->id)
                ->avg('final_grade') ?? 0,
        ];

        // Nilai terbaru siswa
        $latestGrades = Grade::with(['subject', 'tutor.user'])
            ->where('student_id', $student->id)
            ->latest()
            ->take(10)
            ->get();

        return view('student.dashboard', compact(
            'student',
            'statistics',
            'latestGrades'
        ));
    }
}
