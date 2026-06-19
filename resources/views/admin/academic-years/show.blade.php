@extends('layouts.admin')

@section('title', 'Detail Tahun Ajaran')
@section('page-title', 'Detail Tahun Ajaran')
@section('eyebrow', 'Data master akademik')
@section('page-actions')
    <a href="{{ route('admin.academic-years.edit', $academicYear) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2">
            <div><dt class="text-sm text-slate-500">Tahun</dt><dd class="mt-1 font-semibold">{{ $academicYear->year }}</dd></div>
            <div><dt class="text-sm text-slate-500">Status</dt><dd class="mt-1 font-semibold">{{ $academicYear->is_active ? 'Aktif' : 'Nonaktif' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Dibuat</dt><dd class="mt-1 font-semibold">{{ $academicYear->created_at?->format('d M Y') }}</dd></div>
            <div><dt class="text-sm text-slate-500">Diperbarui</dt><dd class="mt-1 font-semibold">{{ $academicYear->updated_at?->format('d M Y') }}</dd></div>
        </dl>
    </div>
@endsection
