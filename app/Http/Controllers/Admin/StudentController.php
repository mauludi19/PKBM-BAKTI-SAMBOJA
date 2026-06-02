<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar siswa.
     */
    public function index()
    {
        $students = Student::with([
            'user',
            'package'
        ])->latest()->get();

        return view(
            'admin.students.index',
            compact('students')
        );
    }

    /**
     * Menampilkan form tambah siswa.
     */
    public function create()
    {
        $packages = Package::orderBy('name')->get();

        return view(
            'admin.students.create',
            compact('packages')
        );
    }

    /**
     * Menyimpan siswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'package_id'    => 'required|exists:packages,id',
            'nisn'          => 'required|string|max:50|unique:students,nisn',
            'nik'           => 'nullable|string|max:30',
            'gender'        => 'required|in:L,P',
            'birth_place'   => 'nullable|string|max:100',
            'birth_date'    => 'nullable|date',
            'address'       => 'nullable|string',
            'phone'         => 'nullable|string|max:20',
            'parent_name'   => 'nullable|string|max:255',
            'status'        => 'required|in:active,inactive,graduated',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'password'  => Hash::make('password123'),
                'role'      => 'student',
            ]);

            Student::create([
                'user_id'       => $user->id,
                'package_id'    => $validated['package_id'],
                'nisn'          => $validated['nisn'],
                'nik'           => $validated['nik'] ?? null,
                'gender'        => $validated['gender'],
                'birth_place'   => $validated['birth_place'] ?? null,
                'birth_date'    => $validated['birth_date'] ?? null,
                'address'       => $validated['address'] ?? null,
                'phone'         => $validated['phone'] ?? null,
                'parent_name'   => $validated['parent_name'] ?? null,
                'status'        => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail siswa.
     */
    public function show(Student $student)
    {
        $student->load([
            'user',
            'package'
        ]);

        return view(
            'admin.students.show',
            compact('student')
        );
    }

    /**
     * Menampilkan form edit siswa.
     */
    public function edit(Student $student)
    {
        $student->load('user');

        $packages = Package::orderBy('name')->get();

        return view(
            'admin.students.edit',
            compact(
                'student',
                'packages'
            )
        );
    }

    /**
     * Memperbarui data siswa.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',

            'email'         => 'required|email|unique:users,email,' .
                                $student->user_id,

            'package_id'    => 'required|exists:packages,id',

            'nisn'          => 'required|string|max:50|unique:students,nisn,' .
                                $student->id,

            'nik'           => 'nullable|string|max:30',
            'gender'        => 'required|in:L,P',
            'birth_place'   => 'nullable|string|max:100',
            'birth_date'    => 'nullable|date',
            'address'       => 'nullable|string',
            'phone'         => 'nullable|string|max:20',
            'parent_name'   => 'nullable|string|max:255',

            'status'        => 'required|in:active,inactive,graduated',
        ]);

        DB::transaction(function () use (
            $validated,
            $student
        ) {

            $student->user->update([
                'name'  => $validated['name'],
                'email' => $validated['email'],
            ]);

            $student->update([
                'package_id'    => $validated['package_id'],
                'nisn'          => $validated['nisn'],
                'nik'           => $validated['nik'] ?? null,
                'gender'        => $validated['gender'],
                'birth_place'   => $validated['birth_place'] ?? null,
                'birth_date'    => $validated['birth_date'] ?? null,
                'address'       => $validated['address'] ?? null,
                'phone'         => $validated['phone'] ?? null,
                'parent_name'   => $validated['parent_name'] ?? null,
                'status'        => $validated['status'],
            ]);
        });

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus siswa.
     */
    public function destroy(Student $student)
    {
        $student->user()->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}