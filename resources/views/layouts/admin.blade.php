<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - PKBM Bakti Samboja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen lg:flex">
        <aside class="bg-emerald-950 text-white lg:min-h-screen lg:w-72">
            <div class="flex items-center justify-between border-b border-white/10 px-6 py-5">
                <div>
                    <p class="text-sm text-emerald-200">PKBM Bakti Samboja</p>
                    <h1 class="text-xl font-semibold">Admin Panel</h1>
                </div>
                <a href="{{ route('home') }}" class="rounded-md bg-white/10 px-3 py-2 text-sm hover:bg-white/20">Publik</a>
            </div>

            @php
                $menus = [
                    ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard'],
                    ['label' => 'PPDB', 'route' => 'admin.ppdb.index', 'pattern' => 'admin.ppdb.*'],
                    ['label' => 'Users', 'route' => 'admin.users.index', 'pattern' => 'admin.users.*'],
                    ['label' => 'Tahun Ajaran', 'route' => 'admin.academic-years.index', 'pattern' => 'admin.academic-years.*'],
                    ['label' => 'Paket Belajar', 'route' => 'admin.packages.index', 'pattern' => 'admin.packages.*'],
                    ['label' => 'Mata Pelajaran', 'route' => 'admin.subjects.index', 'pattern' => 'admin.subjects.*'],
                    ['label' => 'Tutor', 'route' => 'admin.tutors.index', 'pattern' => 'admin.tutors.*'],
                    ['label' => 'Siswa', 'route' => 'admin.students.index', 'pattern' => 'admin.students.*'],
                    ['label' => 'Mapel Tutor', 'route' => 'admin.tutor-subjects.index', 'pattern' => 'admin.tutor-subjects.*'],
                    ['label' => 'Berita', 'route' => 'admin.news.index', 'pattern' => 'admin.news.*'],
                    ['label' => 'Halaman', 'route' => 'admin.pages.index', 'pattern' => 'admin.pages.*'],
                ];
            @endphp

            <nav class="space-y-1 px-4 py-5">
                @foreach ($menus as $menu)
                    <a
                        href="{{ route($menu['route']) }}"
                        class="block rounded-md px-4 py-2.5 text-sm font-medium {{ request()->routeIs($menu['pattern']) ? 'bg-emerald-700 text-white' : 'text-emerald-50 hover:bg-white/10' }}"
                    >
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-5 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-sm text-slate-500">@yield('eyebrow', 'Administrasi')</p>
                        <h2 class="text-2xl font-semibold tracking-tight">@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center gap-3">
                        @yield('page-actions')
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50">Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-semibold">Periksa kembali data yang diisi.</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
