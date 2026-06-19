@extends('layouts.admin')

@section('title', 'Edit Tutor')
@section('page-title', 'Edit Tutor')
@section('eyebrow', 'Manajemen akademik')

@section('content')
    <form method="POST" action="{{ route('admin.tutors.update', $tutor) }}" class="max-w-3xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.tutors.partials.form', ['tutor' => $tutor])
    </form>
@endsection
