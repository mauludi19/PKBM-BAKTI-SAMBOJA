<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Form tambah user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'role' => 'required|in:admin,tutor,student',

            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }

    /**
     * Detail user.
     */
    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    /**
     * Update user.
     */
    public function update(
        Request $request,
        User $user
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' .
                $user->id,

            'role' => 'required|in:admin,tutor,student',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }

    /**
     * Reset password user.
     */
    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make(
                'password123'
            ),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Password berhasil direset.'
            );
    }
}