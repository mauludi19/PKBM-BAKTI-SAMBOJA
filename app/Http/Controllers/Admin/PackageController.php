<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Menampilkan semua paket.
     */
    public function index()
    {
        $packages = Package::orderBy('name')->get();

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Menampilkan form tambah paket.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Menyimpan paket baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:packages,name',
            'description' => 'nullable|string',
        ]);

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail paket.
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Menampilkan form edit paket.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Mengupdate paket.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:packages,name,' . $package->id,
            'description' => 'nullable|string',
        ]);

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    /**
     * Menghapus paket.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}