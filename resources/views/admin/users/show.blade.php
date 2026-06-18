@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('eyebrow', 'Akun dan peran')
@section('page-actions')
    <a href="{{ route('admin.users.edit', $user) }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Edit</a>
@endsection

@section('content')
    <div class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-5 sm:grid-cols-2">
            <div><dt class="text-sm text-slate-500">Nama</dt><dd class="mt-1 font-semibold">{{ $user->name }}</dd></div>
            <div><dt class="text-sm text-slate-500">Email</dt><dd class="mt-1 font-semibold">{{ $user->email }}</dd></div>
            <div><dt class="text-sm text-slate-500">Role</dt><dd class="mt-1 font-semibold">{{ ucfirst($user->role) }}</dd></div>
            <div><dt class="text-sm text-slate-500">Dibuat</dt><dd class="mt-1 font-semibold">{{ $user->created_at?->format('d M Y') }}</dd></div>
        </dl>
    </div>
@endsection
