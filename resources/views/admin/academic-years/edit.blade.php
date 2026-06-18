@extends('layouts.admin')

@section('title', 'Edit Tahun Ajaran')
@section('page-title', 'Edit Tahun Ajaran')
@section('eyebrow', 'Data master akademik')

@section('content')
    <form method="POST" action="{{ route('admin.academic-years.update', $academicYear) }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.academic-years.partials.form', ['academicYear' => $academicYear])
    </form>
@endsection
