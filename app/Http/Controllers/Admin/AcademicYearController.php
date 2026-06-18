<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Menampilkan daftar tahun ajaran.
     */
    public function index()
    {
        $academicYears = AcademicYear::latest()->get();

        return view(
            'admin.academic-years.index',
            compact('academicYears')
        );
    }

    /**
     * Menampilkan form tambah tahun ajaran.
     */
    public function create()
    {
        return view('admin.academic-years.create');
    }

    /**
     * Menyimpan tahun ajaran baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:50|unique:academic_years,year',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_active')) {
            AcademicYear::query()->update([
                'is_active' => false
            ]);
        }

        AcademicYear::create([
            'year' => $validated['year'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail tahun ajaran.
     */
    public function show(AcademicYear $academicYear)
    {
        return view(
            'admin.academic-years.show',
            compact('academicYear')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view(
            'admin.academic-years.edit',
            compact('academicYear')
        );
    }

    /**
     * Update tahun ajaran.
     */
    public function update(
        Request $request,
        AcademicYear $academicYear
    ) {
        $validated = $request->validate([
            'year' => 'required|string|max:50|unique:academic_years,year,' . $academicYear->id,
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->boolean('is_active')) {
            AcademicYear::query()->update([
                'is_active' => false
            ]);
        }

        $academicYear->update([
            'year' => $validated['year'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    /**
     * Hapus tahun ajaran.
     */
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();

        return redirect()
            ->route('admin.academic-years.index')
            ->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
