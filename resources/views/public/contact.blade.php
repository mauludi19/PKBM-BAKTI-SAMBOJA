@extends('layouts.public')

@section('title', 'Kontak')

@section('content')
    <section class="px-6 py-14 sm:px-10">
        <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-2">
            <div>
                <h2 class="text-3xl font-bold">Kontak PKBM</h2>
                <p class="mt-4 text-gray-600">Hubungi admin PKBM Bakti Samboja untuk informasi pendaftaran, jadwal belajar, dan program kesetaraan.</p>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                <dl class="space-y-5">
                    <div><dt class="text-sm text-gray-500">Email</dt><dd class="font-semibold">info@pkbmbakti.ac.id</dd></div>
                    <div><dt class="text-sm text-gray-500">Telepon</dt><dd class="font-semibold">(0274) 555-0999</dd></div>
                    <div><dt class="text-sm text-gray-500">Alamat</dt><dd class="font-semibold">Korong Kayu Samuk, Jorong Simpang, Nagari Kotobaru, Kec. Kubung, Kab. Solok</dd></div>
                </dl>
            </div>
        </div>
    </section>
@endsection
