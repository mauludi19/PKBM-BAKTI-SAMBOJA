@extends('layouts.admin')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')
@section('eyebrow', 'Manajemen akademik')
@section('page-actions')
    <a href="{{ route('admin.students.edit', $student) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div><dt class="text-sm text-slate-500">Nama</dt><dd class="mt-1 font-semibold">{{ $student->user?->name }}</dd></div>
            <div><dt class="text-sm text-slate-500">Email</dt><dd class="mt-1 font-semibold">{{ $student->user?->email }}</dd></div>
            <div><dt class="text-sm text-slate-500">Paket</dt><dd class="mt-1 font-semibold">{{ $student->package?->name ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">NISN</dt><dd class="mt-1 font-semibold">{{ $student->nisn }}</dd></div>
            <div><dt class="text-sm text-slate-500">NIK</dt><dd class="mt-1 font-semibold">{{ $student->nik ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Jenis Kelamin</dt><dd class="mt-1 font-semibold">{{ $student->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Tempat Lahir</dt><dd class="mt-1 font-semibold">{{ $student->birth_place ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Tanggal Lahir</dt><dd class="mt-1 font-semibold">{{ $student->birth_date ? \Illuminate\Support\Carbon::parse($student->birth_date)->format('d M Y') : '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Status</dt><dd class="mt-1 font-semibold">{{ ucfirst($student->status) }}</dd></div>
            <div><dt class="text-sm text-slate-500">Telepon</dt><dd class="mt-1 font-semibold">{{ $student->phone ?? '-' }}</dd></div>
            <div><dt class="text-sm text-slate-500">Orang Tua</dt><dd class="mt-1 font-semibold">{{ $student->parent_name ?? '-' }}</dd></div>
            <div class="sm:col-span-2"><dt class="text-sm text-slate-500">Alamat</dt><dd class="mt-1 text-slate-700">{{ $student->address ?? '-' }}</dd></div>
        </dl>
    </div>
@endsection
