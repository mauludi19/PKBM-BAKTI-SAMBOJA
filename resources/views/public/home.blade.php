@extends('layouts.public')

@section('title', 'PKBM Bakti Samboja')

@section('content')
    <section class="bg-green-800 px-6 py-20 text-white sm:px-10">
        <div class="mx-auto max-w-7xl">
            <p class="mb-3 text-sm font-semibold uppercase tracking-wide text-yellow-300">Pendidikan Kesetaraan</p>
            <h2 class="max-w-3xl text-4xl font-extrabold leading-tight sm:text-5xl">PKBM Bakti Samboja</h2>
            <p class="mt-5 max-w-2xl text-lg text-green-50">Program Paket A, B, dan C untuk masyarakat yang membutuhkan jalur belajar fleksibel dan tetap terarah.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('ppdb.create') }}" class="rounded-lg bg-yellow-400 px-6 py-3 text-center font-bold text-gray-950 hover:bg-yellow-500">Daftar PPDB</a>
                <a href="{{ route('about') }}" class="rounded-lg border border-white px-6 py-3 text-center font-semibold hover:bg-white hover:text-green-800">Lihat Profil</a>
            </div>
        </div>
    </section>

    <section class="px-6 py-14 sm:px-10">
        <div class="mx-auto grid max-w-7xl gap-5 md:grid-cols-3">
            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm"><p class="text-4xl font-black text-green-700">{{ $statistics['total_students'] ?? 0 }}</p><p class="mt-2 text-gray-600">Siswa terdaftar</p></div>
            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm"><p class="text-4xl font-black text-green-700">{{ $statistics['total_tutors'] ?? 0 }}</p><p class="mt-2 text-gray-600">Tutor aktif</p></div>
            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm"><p class="text-4xl font-black text-green-700">{{ $statistics['total_packages'] ?? 0 }}</p><p class="mt-2 text-gray-600">Paket belajar</p></div>
        </div>
    </section>

    <section class="bg-gray-50 px-6 py-14 sm:px-10">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-end justify-between gap-4">
                <div>
                    <h3 class="text-3xl font-bold">Berita Terbaru</h3>
                    <p class="mt-1 text-gray-500">Informasi kegiatan dan pengumuman lembaga.</p>
                </div>
                <a href="{{ route('news') }}" class="text-sm font-semibold text-green-700">Semua berita</a>
            </div>
            <div class="grid gap-5 md:grid-cols-3">
                @forelse ($latestNews as $item)
                    <article class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                        <h4 class="text-lg font-bold">{{ $item->title }}</h4>
                        <p class="mt-3 text-sm leading-6 text-gray-600">{{ Str::limit(strip_tags($item->content), 140) }}</p>
                    </article>
                @empty
                    <p class="rounded-lg border border-dashed border-gray-200 bg-white p-8 text-center text-gray-500 md:col-span-3">Belum ada berita dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
