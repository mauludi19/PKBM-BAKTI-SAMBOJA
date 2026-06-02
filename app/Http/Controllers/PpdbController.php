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

            'registration_type' => 'required|in:BOP,mandiri',

            'email' => 'required|email|max:255',

            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|max:20',

            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',

            'gender' => 'required|in:L,P',

            'last_education' => 'required|string|max:255',

            'address' => 'required|string',

            'phone' => 'required|string|max:20',

            'father_name' => 'required|string|max:255',
            'father_phone' => 'nullable|string|max:20',

            'mother_name' => 'required|string|max:255',
            'mother_phone' => 'nullable|string|max:20',

            'family_card_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'birth_certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'photo_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'last_report_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ]);

        // Upload file
        $validated['family_card_file'] = $request
            ->file('family_card_file')
            ->store('ppdb/family-cards', 'public');

        $validated['birth_certificate_file'] = $request
            ->file('birth_certificate_file')
            ->store('ppdb/birth-certificates', 'public');

        $validated['photo_file'] = $request
            ->file('photo_file')
            ->store('ppdb/photos', 'public');

        $validated['last_report_file'] = $request
            ->file('last_report_file')
            ->store('ppdb/reports', 'public');

        // Status default
        $validated['status'] = 'pending';

        PpdbRegistration::create($validated);

        return redirect()
            ->route('ppdb.create')
            ->with('success', 'Pendaftaran berhasil dikirim.');
    }
}