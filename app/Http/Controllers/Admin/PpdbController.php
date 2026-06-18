<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

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

        return view('admin.ppdb.index', compact('registrations'));
    }

    /**
     * Detail pendaftar.
     */
    public function show(PpdbRegistration $ppdb)
    {
        $ppdb->load([
            'academicYear',
            'package'
        ]);

        return view('admin.ppdb.show', compact('ppdb'));
    }

    /**
     * Approve pendaftaran → buat user + student
     */
    public function approve(PpdbRegistration $ppdb)
    {
        // Cegah approve 2x
        if ($ppdb->status === 'approved') {
            return back()->with('error', 'Pendaftaran sudah disetujui sebelumnya.');
        }

        /**
         * 1. Buat USER (akun login siswa)
         */
        $user = User::create([
            'name' => $ppdb->full_name,
            'email' => $ppdb->email,
            'password' => Hash::make('password'), // default password
            'role' => 'student',
        ]);

        /**
         * 2. Buat STUDENT (data akademik)
         */
        Student::create([
            'user_id' => $user->id,
            'package_id' => $ppdb->package_id,

            'nisn' => null,

            'nik' => $ppdb->nik,
            'gender' => $ppdb->gender,

            'birth_place' => $ppdb->birth_place,
            'birth_date' => $ppdb->birth_date,

            'address' => $ppdb->address,
            'phone' => $ppdb->phone,

            'parent_name' => $ppdb->father_name,

            'status' => 'active',
        ]);

        /**
         * 3. Update status PPDB
         */
        $ppdb->update([
            'status' => 'approved'
        ]);

        return redirect()
            ->route('admin.ppdb.index')
            ->with('success', 'Pendaftaran berhasil disetujui dan akun siswa dibuat.');
    }

    /**
     * Tolak pendaftaran.
     */
    public function reject(PpdbRegistration $ppdb)
    {
        $ppdb->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('admin.ppdb.index')
            ->with('success', 'Pendaftaran berhasil ditolak.');
    }

    /**
     * Hapus data pendaftaran.
     */
    public function destroy(PpdbRegistration $ppdb)
    {
        $ppdb->delete();

        return redirect()
            ->route('admin.ppdb.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
