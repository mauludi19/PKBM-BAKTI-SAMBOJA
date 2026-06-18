@extends('layouts.admin')

@section('title', 'Detail Tutor')
@section('page-title', 'Detail Tutor')
@section('eyebrow', 'Manajemen akademik')
@section('page-actions')
    <a href="{{ route('admin.tutors.edit', $tutor) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div><dt class="text-sm text-slate-500">Nama</dt><dd class="mt-1 font-semibold">{{ $tutor->user?->name }}</dd></div>
            <div><dt class="text-sm text-slate-500">Email</dt><dd class="mt-1 font-semibold">{{ $tutor->user?->email }}</dd></div>
            <div><dt class="text-sm text-slate-500">NIP</dt><dd class="mt-1 font-semibold">{{ $tutor->nip ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Jenis Kelamin</dt><dd class="mt-1 font-semibold">{{ $tutor->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Pendidikan</dt><dd class="mt-1 font-semibold">{{ $tutor->education ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Spesialisasi</dt><dd class="mt-1 font-semibold">{{ $tutor->specialization ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Telepon</dt><dd class="mt-1 font-semibold">{{ $tutor->phone ?? '-' }}</dd></div>
            <div class="sm:col-span-2"><dt class="text-sm text-slate-500">Alamat</dt><dd class="mt-1 text-slate-700">{{ $tutor->address ?? '-' }}</dd></div>
        </dl>
    </div>
@endsection
