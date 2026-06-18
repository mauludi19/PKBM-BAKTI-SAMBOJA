@extends('layouts.admin')

@section('title', 'Review PPDB')
@section('page-title', 'Review PPDB')
@section('eyebrow', $ppdb->full_name)
@section('page-actions')
    @if ($ppdb->status !== 'approved')
        <form method="POST" action="{{ route('admin.ppdb.approve', $ppdb) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Setujui</button>
        </form>
    @endif
    @if ($ppdb->status !== 'rejected')
        <form method="POST" action="{{ route('admin.ppdb.reject', $ppdb) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="rounded-md border border-red-300 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-50">Tolak</button>
        </form>
    @endif
@endsection

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <h3 class="font-semibold">Data Pendaftar</h3>
            <dl class="mt-5 grid gap-5 sm:grid-cols-2">
                <div><dt class="text-sm text-slate-500">Nama Lengkap</dt><dd class="mt-1 font-semibold">{{ $ppdb->full_name }}</dd></div>
                <div><dt class="text-sm text-slate-500">Email</dt><dd class="mt-1 font-semibold">{{ $ppdb->email }}</dd></div>
                <div><dt class="text-sm text-slate-500">NIK</dt><dd class="mt-1 font-semibold">{{ $ppdb->nik }}</dd></div>
                <div><dt class="text-sm text-slate-500">Jenis Kelamin</dt><dd class="mt-1 font-semibold">{{ $ppdb->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Tempat Lahir</dt><dd class="mt-1 font-semibold">{{ $ppdb->birth_place }}</dd></div>
                <div><dt class="text-sm text-slate-500">Tanggal Lahir</dt><dd class="mt-1 font-semibold">{{ $ppdb->birth_date?->format('d M Y') }}</dd></div>
                <div><dt class="text-sm text-slate-500">Pendidikan Terakhir</dt><dd class="mt-1 font-semibold">{{ $ppdb->last_education ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Telepon</dt><dd class="mt-1 font-semibold">{{ $ppdb->phone }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-sm text-slate-500">Alamat</dt><dd class="mt-1 text-slate-700">{{ $ppdb->address }}</dd></div>
            </dl>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-semibold">Akademik</h3>
            <dl class="mt-5 space-y-4">
                <div><dt class="text-sm text-slate-500">Status</dt><dd class="mt-1 font-semibold">{{ ucfirst($ppdb->status) }}</dd></div>
                <div><dt class="text-sm text-slate-500">Jenis Pendaftaran</dt><dd class="mt-1 font-semibold">{{ strtoupper($ppdb->registration_type) }}</dd></div>
                <div><dt class="text-sm text-slate-500">Paket</dt><dd class="mt-1 font-semibold">{{ $ppdb->package?->name ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Tahun Ajaran</dt><dd class="mt-1 font-semibold">{{ $ppdb->academicYear?->year ?? '-' }}</dd></div>
            </dl>
        </section>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-semibold">Data Orang Tua</h3>
            <dl class="mt-5 grid gap-5 sm:grid-cols-2">
                <div><dt class="text-sm text-slate-500">Nama Ayah</dt><dd class="mt-1 font-semibold">{{ $ppdb->father_name ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Telepon Ayah</dt><dd class="mt-1 font-semibold">{{ $ppdb->father_phone ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Nama Ibu</dt><dd class="mt-1 font-semibold">{{ $ppdb->mother_name ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Telepon Ibu</dt><dd class="mt-1 font-semibold">{{ $ppdb->mother_phone ?? '-' }}</dd></div>
            </dl>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="font-semibold">Dokumen</h3>
            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                @foreach ([
                    'Kartu Keluarga' => $ppdb->family_card_file,
                    'Akta Kelahiran' => $ppdb->birth_certificate_file,
                    'Foto' => $ppdb->photo_file,
                    'Rapor Terakhir' => $ppdb->last_report_file,
                ] as $label => $path)
                    @if ($path)
                        <a href="{{ asset('storage/' . $path) }}" target="_blank" class="rounded-md border border-slate-200 px-4 py-3 text-sm font-medium hover:bg-slate-50">{{ $label }}</a>
                    @else
                        <span class="rounded-md border border-slate-200 px-4 py-3 text-sm text-slate-500">{{ $label }} tidak ada</span>
                    @endif
                @endforeach
            </div>
        </section>
    </div>
@endsection
