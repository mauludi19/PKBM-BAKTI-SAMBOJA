<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Package;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    /**
     * Menampilkan form pendaftaran PPDB.
     */
    public function create()
    {
        $activeAcademicYear = AcademicYear::where('is_active', true)->first();

        $packages = Package::orderBy('name')->get();

        return view('ppdb.create', compact(
            'activeAcademicYear',
            'packages'
        ));
    }

    /**
     * Menyimpan data pendaftaran PPDB.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'package_id' => 'required|exists:packages,id',
            'registration_type' => 'required|in:bop,mandiri',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'previous_school' => 'nullable|string|max:255',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        // Set status default jika tidak dikirim dari form
        $validated['status'] = $validated['status'] ?? 'pending';

        PpdbRegistration::create($validated);

        return redirect()
            ->route('ppdb.create')
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
