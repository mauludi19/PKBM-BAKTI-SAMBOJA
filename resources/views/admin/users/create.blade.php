@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')
@section('eyebrow', 'Akun dan peran')

@section('content')
    <form method="POST" action="{{ route('admin.users.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.users.partials.form', ['user' => null])
    </form>
@endsection
