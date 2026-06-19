<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen bg-gray-50">
            <nav class="border-b border-gray-100 bg-white shadow-sm">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 sm:px-10">
                    <a href="{{ route('home') }}" class="block">
                        <h1 class="text-xl font-bold text-green-700">PKBM</h1>
                        <p class="text-xs text-gray-500">Bakti Samboja</p>
                    </a>

                    <a href="{{ route('home') }}" class="rounded-lg border border-green-700 px-4 py-2 text-sm font-semibold text-green-700 hover:bg-green-50">
                        Beranda
                    </a>
                </div>
            </nav>

            <main class="flex min-h-[calc(100vh-73px)] items-center px-6 py-10 sm:px-10">
                <div class="mx-auto grid w-full max-w-6xl overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm lg:grid-cols-[1fr_440px]">
                    <section class="hidden bg-green-800 p-10 text-white lg:flex lg:flex-col lg:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-wide text-yellow-300">Pendidikan Kesetaraan</p>
                            <h2 class="mt-4 max-w-md text-4xl font-extrabold leading-tight">PKBM Bakti Samboja</h2>
                            <p class="mt-5 max-w-lg text-base leading-7 text-green-50">
                                Akses akun untuk mengelola layanan belajar, pendaftaran, dan informasi akademik dengan tampilan yang selaras dengan portal utama.
                            </p>
                        </div>

                        <div class="grid gap-4 text-sm text-green-50">
                            <div class="rounded-lg border border-green-600 bg-green-700/40 p-4">
                                <p class="font-semibold text-white">Program Paket A, B, dan C</p>
                                <p class="mt-1 text-green-100">Pembelajaran fleksibel untuk masyarakat Samboja dan sekitarnya.</p>
                            </div>
                            <div class="rounded-lg border border-green-600 bg-green-700/40 p-4">
                                <p class="font-semibold text-white">Portal terpadu</p>
                                <p class="mt-1 text-green-100">Masuk sebagai admin, tutor, atau siswa sesuai akun yang terdaftar.</p>
                            </div>
                        </div>
                    </section>

                    <section class="px-6 py-8 sm:px-10">
                        {{ $slot }}
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
