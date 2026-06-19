@extends('layouts.admin')

@section('title', 'PPDB')
@section('page-title', 'Pendaftaran PPDB')
@section('eyebrow', 'Review pendaftar')

@section('content')
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Paket</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Tahun Ajaran</th>
                    <th class="px-5 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-5 py-3 text-right text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($registrations as $registration)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="font-medium">{{ $registration->full_name }}</p>
                            <p class="text-sm text-slate-500">{{ $registration->email }}</p>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $registration->package?->name ?? '-' }}</td>
                        <td class="px-5 py-4 text-sm text-slate-600">{{ $registration->academicYear?->year ?? '-' }}</td>
                        <td class="px-5 py-4"><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium">{{ ucfirst($registration->status) }}</span></td>
                        <td class="px-5 py-4 text-right text-sm">
                            <a href="{{ route('admin.ppdb.show', $registration) }}" class="font-medium text-emerald-700 hover:text-emerald-900">Review</a>
                            <form method="POST" action="{{ route('admin.ppdb.destroy', $registration) }}" class="ml-3 inline" onsubmit="return confirm('Hapus data pendaftaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada pendaftaran PPDB.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
