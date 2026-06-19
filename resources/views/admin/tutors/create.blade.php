@extends('layouts.admin')

@section('title', 'Tambah Tutor')
@section('page-title', 'Tambah Tutor')
@section('eyebrow', 'Manajemen akademik')

@section('content')
    <form method="POST" action="{{ route('admin.tutors.store') }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.tutors.partials.form', ['tutor' => null])
    </form>
@endsection
