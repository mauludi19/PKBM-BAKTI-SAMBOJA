@extends('layouts.admin')

@section('title', 'Tahun Ajaran')
@section('page-title', 'Tahun Ajaran')
@section('eyebrow', 'Data master akademik')
@section('page-actions')
    <a href="{{ route('admin.academic-years.create') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Tambah</a>
@endsection

@section('content')
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Tahun</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-5 py-3 text-right text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($academicYears as $academicYear)
                    <tr>
                        <td class="px-5 py-4 font-medium">{{ $academicYear->year }}</td>
                        <td class="px-5 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-medium {{ $academicYear->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                                {{ $academicYear->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right text-sm">
                            <a href="{{ route('admin.academic-years.show', $academicYear) }}" class="font-medium text-slate-700 hover:text-slate-900">Detail</a>
                            <a href="{{ route('admin.academic-years.edit', $academicYear) }}" class="ml-3 font-medium text-emerald-700 hover:text-emerald-900">Edit</a>
                            <form method="POST" action="{{ route('admin.academic-years.destroy', $academicYear) }}" class="ml-3 inline" onsubmit="return confirm('Hapus tahun ajaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada tahun ajaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
