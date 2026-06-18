@extends('layouts.admin')

@section('title', 'Tambah Paket')
@section('page-title', 'Tambah Paket Belajar')
@section('eyebrow', 'Data master akademik')

@section('content')
    <form method="POST" action="{{ route('admin.packages.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @include('admin.packages.partials.form', ['package' => null])
    </form>
@endsection
