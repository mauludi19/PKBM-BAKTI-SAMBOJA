<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\Subject;
use Illuminate\Http\Request;

class TutorSubjectController extends Controller
{
    /**
     * Menampilkan daftar tutor beserta mapel yang diampu.
     */
    public function index()
    {
        $tutors = Tutor::with([
            'user',
            'subjects'
        ])->get();

        return view(
            'admin.tutor-subjects.index',
            compact('tutors')
        );
    }

    /**
     * Form assign mapel ke tutor.
     */
    public function create()
    {
        $tutors = Tutor::with('user')
            ->orderBy('id')
            ->get();

        $subjects = Subject::orderBy('name')
            ->get();

        return view(
            'admin.tutor-subjects.create',
            compact(
                'tutors',
                'subjects'
            )
        );
    }

    /**
     * Simpan assignment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tutor_id' => 'required|exists:tutors,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $tutor = Tutor::findOrFail(
            $validated['tutor_id']
        );

        $tutor->subjects()->syncWithoutDetaching([
            $validated['subject_id']
        ]);

        return redirect()
            ->route('admin.tutor-subjects.index')
            ->with(
                'success',
                'Mapel berhasil ditugaskan.'
            );
    }

    /**
     * Hapus assignment.
     */
    public function destroy(
        Tutor $tutor,
        Subject $subject
    ) {
        $tutor->subjects()->detach(
            $subject->id
        );

        return redirect()
            ->route('admin.tutor-subjects.index')
            ->with(
                'success',
                'Mapel berhasil dilepas dari tutor.'
            );
    }
}