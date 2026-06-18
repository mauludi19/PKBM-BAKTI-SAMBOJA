@extends('layouts.admin')

@section('title', 'Siswa')
@section('page-title', 'Data Siswa')
@section('eyebrow', 'Manajemen akademik')
@section('page-actions')
    <a href="{{ route('admin.students.create') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Tambah</a>
@endsection

@section('content')
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">NISN</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Paket</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-5 py-3 text-right text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($students as $student)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $student->user?->name }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $student->nisn }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $student->package?->name ?? '-' }}</td>
                        <td class="px-5 py-4"><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium">{{ ucfirst($student->status) }}</span></td>
                        <td class="px-5 py-4 text-right text-sm">
                            <a href="{{ route('admin.students.show', $student) }}" class="font-medium text-slate-700 hover:text-slate-900">Detail</a>
                            <a href="{{ route('admin.students.edit', $student) }}" class="ml-3 font-medium text-emerald-700 hover:text-emerald-900">Edit</a>
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" class="ml-3 inline" onsubmit="return confirm('Hapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada siswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
