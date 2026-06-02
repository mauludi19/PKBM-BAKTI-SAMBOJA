<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;

class PpdbController extends Controller
{
    /**
     * Daftar seluruh pendaftar PPDB.
     */
    public function index()
    {
        $registrations = PpdbRegistration::with([
            'academicYear',
            'package'
        ])
        ->latest()
        ->get();

        return view(
            'admin.ppdb.index',
            compact('registrations')
        );
    }

    /**
     * Detail pendaftar.
     */
    public function show(
        PpdbRegistration $ppdb
    ) {
        $ppdb->load([
            'academicYear',
            'package'
        ]);

        return view(
            'admin.ppdb.show',
            compact('ppdb')
        );
    }

    /**
     * Approve pendaftaran.
     */
    public function approve(
        PpdbRegistration $ppdb
    ) {
        $ppdb->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Pendaftaran berhasil disetujui.'
            );
    }

    /**
     * Tolak pendaftaran.
     */
    public function reject(
        PpdbRegistration $ppdb
    ) {
        $ppdb->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Pendaftaran berhasil ditolak.'
            );
    }

    /**
     * Hapus data pendaftaran.
     */
    public function destroy(
        PpdbRegistration $ppdb
    ) {
        $ppdb->delete();

        return redirect()
            ->route('admin.ppdb.index')
            ->with(
                'success',
                'Data pendaftaran berhasil dihapus.'
            );
    }
}