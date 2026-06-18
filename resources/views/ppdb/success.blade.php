@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil')

@section('content')
    <section class="px-6 py-20 sm:px-10">
        <div class="mx-auto max-w-2xl rounded-lg border border-green-100 bg-green-50 p-8 text-center">
            <h2 class="text-3xl font-bold text-green-900">Pendaftaran Berhasil</h2>
            <p class="mt-4 text-green-800">Data PPDB Anda sudah diterima. Admin PKBM akan meninjau berkas dan status pendaftaran.</p>
            <a href="{{ route('home') }}" class="mt-8 inline-flex rounded-lg bg-green-800 px-6 py-3 font-semibold text-white hover:bg-green-900">Kembali ke Beranda</a>
        </div>
    </section>
@endsection
