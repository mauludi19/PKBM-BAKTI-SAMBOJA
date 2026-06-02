<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Menampilkan daftar mata pelajaran.
     */
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();

        return view(
            'admin.subjects.index',
            compact('subjects')
        );
    }

    /**
     * Menampilkan form tambah mata pelajaran.
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Menyimpan mata pelajaran baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name',
            'description' => 'nullable|string',
        ]);

        Subject::create($validated);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail mata pelajaran.
     */
    public function show(Subject $subject)
    {
        return view(
            'admin.subjects.show',
            compact('subject')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Subject $subject)
    {
        return view(
            'admin.subjects.edit',
            compact('subject')
        );
    }

    /**
     * Update mata pelajaran.
     */
    public function update(
        Request $request,
        Subject $subject
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:subjects,name,' . $subject->id,
            'description' => 'nullable|string',
        ]);

        $subject->update($validated);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /**
     * Hapus mata pelajaran.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}