@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('eyebrow', 'Ringkasan sistem')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            'Siswa' => $statistics['total_students'] ?? 0,
            'Tutor' => $statistics['total_tutors'] ?? 0,
            'Users' => $statistics['total_users'] ?? 0,
            'PPDB' => $statistics['total_ppdb'] ?? 0,
            'Berita' => $statistics['total_news'] ?? 0,
        ] as $label => $value)
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="font-semibold">Tahun Ajaran Aktif</h3>
            <p class="mt-3 text-2xl font-semibold text-emerald-700">
                {{ $activeAcademicYear?->year ?? 'Belum ditentukan' }}
            </p>
            <a href="{{ route('admin.academic-years.index') }}" class="mt-4 inline-flex text-sm font-medium text-emerald-700 hover:text-emerald-900">Kelola tahun ajaran</a>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="font-semibold">Status PPDB</h3>
            <div class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between"><span>Pending</span><strong>{{ $ppdbStatus['pending'] ?? 0 }}</strong></div>
                <div class="flex justify-between"><span>Disetujui</span><strong>{{ $ppdbStatus['approved'] ?? 0 }}</strong></div>
                <div class="flex justify-between"><span>Ditolak</span><strong>{{ $ppdbStatus['rejected'] ?? 0 }}</strong></div>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="font-semibold">Jenis Pendaftaran</h3>
            <div class="mt-4 space-y-2 text-sm">
                <div class="flex justify-between"><span>BOP</span><strong>{{ $ppdbType['bop'] ?? 0 }}</strong></div>
                <div class="flex justify-between"><span>Mandiri</span><strong>{{ $ppdbType['mandiri'] ?? 0 }}</strong></div>
            </div>
        </section>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                <h3 class="font-semibold">PPDB Terbaru</h3>
                <a href="{{ route('admin.ppdb.index') }}" class="text-sm font-medium text-emerald-700">Lihat semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse ($latestRegistrations as $registration)
                    <a href="{{ route('admin.ppdb.show', $registration) }}" class="block px-5 py-4 hover:bg-slate-50">
                        <div class="flex justify-between gap-4">
                            <p class="font-medium">{{ $registration->full_name }}</p>
                            <span class="text-sm text-slate-500">{{ ucfirst($registration->status) }}</span>
                        </div>
                        <p class="text-sm text-slate-500">{{ $registration->email }}</p>
                    </a>
                @empty
                    <p class="px-5 py-6 text-sm text-slate-500">Belum ada pendaftaran PPDB.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
                <h3 class="font-semibold">User Terbaru</h3>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse ($latestUsers as $user)
                    <a href="{{ route('admin.users.show', $user) }}" class="block px-5 py-4 hover:bg-slate-50">
                        <div class="flex justify-between gap-4">
                            <p class="font-medium">{{ $user->name }}</p>
                            <span class="text-sm text-slate-500">{{ ucfirst($user->role) }}</span>
                        </div>
                        <p class="text-sm text-slate-500">{{ $user->email }}</p>
                    </a>
                @empty
                    <p class="px-5 py-6 text-sm text-slate-500">Belum ada user.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
