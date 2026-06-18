@extends('layouts.admin')

@section('title', 'Edit Paket')
@section('page-title', 'Edit Paket Belajar')
@section('eyebrow', 'Data master akademik')

@section('content')
    <form method="POST" action="{{ route('admin.packages.update', $package) }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.packages.partials.form', ['package' => $package])
    </form>
@endsection
