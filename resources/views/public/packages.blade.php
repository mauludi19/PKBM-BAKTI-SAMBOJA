@extends('layouts.public')

@section('title', 'Paket Belajar')

@section('content')
    <section class="px-6 py-14 sm:px-10">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-3xl font-bold">Paket Belajar</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @forelse ($packages as $package)
                    <article class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="text-xl font-bold text-green-800">{{ $package->name }}</h3>
                        <p class="mt-3 text-gray-600">{{ $package->description ?? 'Informasi paket belajar tersedia melalui admin PKBM.' }}</p>
                    </article>
                @empty
                    <p class="rounded-lg border border-dashed border-gray-200 p-8 text-gray-500 md:col-span-3">Belum ada paket belajar.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
