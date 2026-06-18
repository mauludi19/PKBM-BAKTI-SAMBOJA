<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Daftar nilai yang diinput tutor.
     */
    public function index()
    {
        $tutor = Auth::user()->tutor;

        $grades = Grade::with([
            'student.user',
            'subject'
        ])
            ->where('tutor_id', $tutor->id)
            ->latest()
            ->get();

        return view(
            'tutor.grades.index',
            compact('grades')
        );
    }

    /**
     * Form input nilai.
     */
    public function create()
    {
        $students = Student::with('user')
            ->orderBy('id')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return view(
            'tutor.grades.create',
            compact(
                'students',
                'subjects'
            )
        );
    }

    /**
     * Simpan nilai.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',

            'semester' => 'required|in:1,2',

            'academic_year' => 'required|string|max:20',

            'assignment_score' => 'nullable|numeric|min:0|max:100',

            'mid_score' => 'nullable|numeric|min:0|max:100',

            'final_score' => 'nullable|numeric|min:0|max:100',

            'notes' => 'nullable|string',
        ]);

        $tutor = Auth::user()->tutor;

        $assignment = $validated['assignment_score'] ?? 0;
        $mid = $validated['mid_score'] ?? 0;
        $final = $validated['final_score'] ?? 0;

        $validated['final_grade'] =
            round(
                ($assignment + $mid + $final) / 3,
                2
            );

        $validated['tutor_id'] = $tutor->id;

        Grade::create($validated);

        return redirect()
            ->route('tutor.grades.index')
            ->with(
                'success',
                'Nilai berhasil disimpan.'
            );
    }

    /**
     * Detail nilai.
     */
    public function show(Grade $grade)
    {
        $grade->load([
            'student.user',
            'subject',
            'tutor.user'
        ]);

        return view(
            'tutor.grades.show',
            compact('grade')
        );
    }

    /**
     * Form edit nilai.
     */
    public function edit(Grade $grade)
    {
        $students = Student::with('user')->get();

        $subjects = Subject::all();

        return view(
            'tutor.grades.edit',
            compact(
                'grade',
                'students',
                'subjects'
            )
        );
    }

    /**
     * Update nilai.
     */
    public function update(
        Request $request,
        Grade $grade
    ) {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',

            'semester' => 'required|in:1,2',

            'academic_year' => 'required|string|max:20',

            'assignment_score' => 'nullable|numeric|min:0|max:100',

            'mid_score' => 'nullable|numeric|min:0|max:100',

            'final_score' => 'nullable|numeric|min:0|max:100',

            'notes' => 'nullable|string',
        ]);

        $assignment = $validated['assignment_score'] ?? 0;
        $mid = $validated['mid_score'] ?? 0;
        $final = $validated['final_score'] ?? 0;

        $validated['final_grade'] =
            round(
                ($assignment + $mid + $final) / 3,
                2
            );

        $grade->update($validated);

        return redirect()
            ->route('tutor.grades.index')
            ->with(
                'success',
                'Nilai berhasil diperbarui.'
            );
    }

    /**
     * Hapus nilai.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()
            ->route('tutor.grades.index')
            ->with(
                'success',
                'Nilai berhasil dihapus.'
            );
    }
}
