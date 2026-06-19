@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit User')
@section('eyebrow', 'Akun dan peran')

@section('content')
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('admin.users.partials.form', ['user' => $user])
    </form>
@endsection
