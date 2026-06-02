<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Nilai milik siswa yang login.
     */
    public function index()
    {
        $student = Auth::user()->student;

        $grades = Grade::with([
            'subject',
            'tutor.user'
        ])
        ->where(
            'student_id',
            $student->id
        )
        ->latest()
        ->get();

        return view(
            'student.grades.index',
            compact('grades')
        );
    }

    /**
     * Detail nilai.
     */
    public function show(Grade $grade)
    {
        return view(
            'student.grades.show',
            compact('grade')
        );
    }
}