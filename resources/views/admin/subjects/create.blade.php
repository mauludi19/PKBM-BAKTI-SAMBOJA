@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran')
@section('page-title', 'Tambah Mata Pelajaran')
@section('eyebrow', 'Data master akademik')

@section('content')
    <form method="POST" action="{{ route('admin.subjects.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.subjects.partials.form', ['subject' => null])
    </form>
@endsection
