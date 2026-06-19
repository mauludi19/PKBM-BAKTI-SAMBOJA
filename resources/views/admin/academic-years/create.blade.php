@extends('layouts.admin')

@section('title', 'Tambah Tahun Ajaran')
@section('page-title', 'Tambah Tahun Ajaran')
@section('eyebrow', 'Data master akademik')

@section('content')
    <form method="POST" action="{{ route('admin.academic-years.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.academic-years.partials.form', ['academicYear' => null])
    </form>
@endsection
