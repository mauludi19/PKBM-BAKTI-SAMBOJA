<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PKBM Bakti Samboja')</title>
    <meta name="description" content="PKBM Bakti Samboja - Pusat Kegiatan Belajar Masyarakat">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">

    <nav class="sticky top-0 z-50 border-b border-gray-100 bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 sm:px-10">

            <a href="{{ route('home') }}" class="block">
                <h1 class="text-xl font-bold text-green-700">PKBM</h1>
                <p class="text-xs text-gray-500">Bakti Samboja</p>
            </a>

            <div class="hidden items-center gap-8 md:flex">
                <a href="{{ route('home') }}" class="font-medium text-gray-700 hover:text-green-700">Beranda</a>
                <a href="{{ route('about') }}" class="font-medium text-gray-700 hover:text-green-700">Profil</a>
                <a href="{{ route('packages') }}" class="font-medium text-gray-700 hover:text-green-700">Program</a>
                <a href="{{ route('tutors') }}" class="font-medium text-gray-700 hover:text-green-700">Tutor</a>
                <a href="{{ route('news') }}" class="font-medium text-gray-700 hover:text-green-700">Berita</a>
                <a href="{{ route('contact') }}" class="font-medium text-gray-700 hover:text-green-700">Kontak</a>
            </div>

            <div class="hidden items-center gap-3 md:flex md:ml-auto">

                @auth

                    @php
                        $dashboardRoute = match(auth()->user()->role) {
                            'admin' => route('admin.dashboard'),
                            'tutor' => route('tutor.dashboard'),
                            'student' => route('student.dashboard'),
                            default => route('dashboard'),
                        };
                    @endphp

                    <a href="{{ $dashboardRoute }}"
                       class="rounded-lg bg-green-700 px-5 py-2 font-semibold text-white hover:bg-green-800">
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit"
                                class="rounded-lg border border-red-500 px-5 py-2 font-semibold text-red-600 hover:bg-red-500 hover:text-white transition">
                            Logout
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-green-700 px-5 py-2 font-semibold text-white hover:bg-green-800">
                        Login
                    </a>

                @endauth

            </div>

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 bg-gray-900 text-gray-200">
        <div class="mx-auto grid max-w-7xl gap-8 px-6 py-10 sm:px-10 md:grid-cols-3">
            <div>
                <h3 class="font-bold text-white">PKBM Bakti Samboja</h3>
                <p class="mt-3 text-sm leading-6 text-gray-400">
                    Lembaga pendidikan non-formal untuk program kesetaraan Paket A, B, dan C.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-white">Menu</h4>
                <div class="mt-3 grid gap-2 text-sm">
                    <a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Profil</a>
                    <a href="{{ route('packages') }}" class="text-gray-400 hover:text-white">Program</a>
                    <a href="{{ route('news') }}" class="text-gray-400 hover:text-white">Berita</a>
                    <a href="{{ route('ppdb.create') }}" class="text-gray-400 hover:text-white">PPDB Online</a>
                </div>
            </div>

            <div>
                <h4 class="font-semibold text-white">Kontak</h4>
                <p class="mt-3 text-sm leading-6 text-gray-400">
                    info@pkbmbakti.ac.id<br>
                    (0274) 555-0999<br>
                    Korong Kayu Samuk, Kab. Solok
                </p>
            </div>
        </div>
    </footer>

</body>
</html>