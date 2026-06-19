@extends('layouts.admin')

@section('title', 'Paket Belajar')
@section('page-title', 'Paket Belajar')
@section('eyebrow', 'Data master akademik')
@section('page-actions')
    <a href="{{ route('admin.packages.create') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Tambah</a>
@endsection

@section('content')
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Deskripsi</th>
                    <th class="px-5 py-3 text-right text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($packages as $package)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $package->name }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $package->description ?? '-' }}</td>
                        <td class="px-5 py-4 text-right text-sm">
                            <a href="{{ route('admin.packages.show', $package) }}" class="font-medium text-slate-700 hover:text-slate-900">Detail</a>
                            <a href="{{ route('admin.packages.edit', $package) }}" class="ml-3 font-medium text-emerald-700 hover:text-emerald-900">Edit</a>
                            <form method="POST" action="{{ route('admin.packages.destroy', $package) }}" class="ml-3 inline" onsubmit="return confirm('Hapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada paket belajar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
