@extends('layouts.admin')

@section('title', 'Tambah Siswa')
@section('page-title', 'Tambah Siswa')
@section('eyebrow', 'Manajemen akademik')

@section('content')
    <form method="POST" action="{{ route('admin.students.store') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.students.partials.form', ['student' => null])
    </form>
@endsection
