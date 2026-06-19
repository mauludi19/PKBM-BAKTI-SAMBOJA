<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TutorController extends Controller
{
    /**
     * Daftar tutor.
     */
    public function index()
    {
        $tutors = Tutor::with('user')
            ->latest()
            ->get();

        return view(
            'admin.tutors.index',
            compact('tutors')
        );
    }

    /**
     * Form tambah tutor.
     */
    public function create()
    {
        return view('admin.tutors.create');
    }

    /**
     * Simpan tutor baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',

            'nip' => 'nullable|string|max:50',
            'gender' => 'required|in:L,P',
            'education' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password123'),
                'role' => 'tutor',
            ]);

            Tutor::create([
                'user_id' => $user->id,
                'nip' => $validated['nip'] ?? null,
                'gender' => $validated['gender'],
                'education' => $validated['education'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.tutors.index')
            ->with('success', 'Tutor berhasil ditambahkan.');
    }

    /**
     * Detail tutor.
     */
    public function show(Tutor $tutor)
    {
        $tutor->load('user');

        return view(
            'admin.tutors.show',
            compact('tutor')
        );
    }

    /**
     * Form edit tutor.
     */
    public function edit(Tutor $tutor)
    {
        $tutor->load('user');

        return view(
            'admin.tutors.edit',
            compact('tutor')
        );
    }

    /**
     * Update tutor.
     */
    public function update(
        Request $request,
        Tutor $tutor
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' .
                $tutor->user_id,

            'nip' => 'nullable|string|max:50',
            'gender' => 'required|in:L,P',
            'education' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        DB::transaction(function () use (
            $validated,
            $tutor
        ) {

            $tutor->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            $tutor->update([
                'nip' => $validated['nip'] ?? null,
                'gender' => $validated['gender'],
                'education' => $validated['education'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.tutors.index')
            ->with('success', 'Tutor berhasil diperbarui.');
    }

    /**
     * Hapus tutor.
     */
    public function destroy(Tutor $tutor)
    {
        $tutor->user()->delete();

        return redirect()
            ->route('admin.tutors.index')
            ->with('success', 'Tutor berhasil dihapus.');
    }
}
