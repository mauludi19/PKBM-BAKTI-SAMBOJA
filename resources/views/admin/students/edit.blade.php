@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')
@section('eyebrow', 'Manajemen akademik')

@section('content')
    <form method="POST" action="{{ route('admin.students.update', $student) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.students.partials.form', ['student' => $student])
    </form>
@endsection
