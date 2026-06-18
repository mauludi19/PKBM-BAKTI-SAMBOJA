@extends('layouts.admin')

@section('title', 'Detail Mata Pelajaran')
@section('page-title', 'Detail Mata Pelajaran')
@section('eyebrow', 'Data master akademik')
@section('page-actions')
    <a href="{{ route('admin.subjects.edit', $subject) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2">
            <div><dt class="text-sm text-slate-500">Kode</dt><dd class="mt-1 font-semibold">{{ $subject->code }}</dd></div>
            <div><dt class="text-sm text-slate-500">Nama</dt><dd class="mt-1 font-semibold">{{ $subject->name }}</dd></div>
        </dl>
    </div>
@endsection
