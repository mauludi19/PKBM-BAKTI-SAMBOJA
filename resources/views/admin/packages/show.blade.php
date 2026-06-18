@extends('layouts.admin')

@section('title', 'Detail Paket')
@section('page-title', 'Detail Paket Belajar')
@section('eyebrow', 'Data master akademik')
@section('page-actions')
    <a href="{{ route('admin.packages.edit', $package) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="space-y-5">
            <div><dt class="text-sm text-slate-500">Nama</dt><dd class="mt-1 font-semibold">{{ $package->name }}</dd></div>
            <div><dt class="text-sm text-slate-500">Deskripsi</dt><dd class="mt-1 text-slate-700">{{ $package->description ?? '-' }}</dd></div>
        </dl>
    </div>
@endsection
