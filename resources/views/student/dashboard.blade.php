<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Siswa - PKBM Bakti Samboja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen lg:flex">
        <aside class="bg-emerald-950 text-white lg:min-h-screen lg:w-72">
            <div class="border-b border-white/10 px-6 py-5">
                <p class="text-sm text-emerald-200">PKBM Bakti Samboja</p>
                <h1 class="text-xl font-semibold">Siswa Panel</h1>
            </div>

            <nav class="space-y-1 px-4 py-5">
                <a href="{{ route('student.dashboard') }}" class="block rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-medium text-white">Dashboard</a>
                <a href="{{ route('student.grades.index') }}" class="block rounded-md px-4 py-2.5 text-sm font-medium text-emerald-50 hover:bg-white/10">Nilai Saya</a>
                <a href="{{ route('home') }}" class="block rounded-md px-4 py-2.5 text-sm font-medium text-emerald-50 hover:bg-white/10">Halaman Publik</a>
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-5 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-sm text-slate-500">Informasi akademik</p>
                        <h2 class="text-2xl font-semibold tracking-tight">Dashboard Siswa</h2>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50">Keluar</button>
                    </form>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="mb-8 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">Selamat datang</p>
                    <h3 class="mt-1 text-2xl font-semibold">{{ $student->user?->name }}</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Paket belajar: {{ $student->package?->name ?? '-' }}</p>
                </div>

                <div class="mb-8 grid gap-5 md:grid-cols-3">
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                        <p class="text-sm text-slate-500">Status</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">{{ ucfirst($student->status) }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                        <p class="text-sm text-slate-500">Total Nilai</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">{{ $statistics['total_grades'] }}</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                        <p class="text-sm text-slate-500">Rata-rata Nilai</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">{{ number_format($statistics['average_final_grade'], 2) }}</p>
                    </div>
                </div>

                <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                    <div class="flex items-center justify-between gap-3 border-b border-slate-200 px-5 py-4">
                        <h3 class="text-lg font-semibold">Nilai Terbaru</h3>
                        <a href="{{ route('student.grades.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">Lihat semua</a>
                    </div>

                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Mata Pelajaran</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Tutor</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Semester</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($latestGrades as $grade)
                                <tr>
                                    <td class="px-5 py-4 font-medium">{{ $grade->subject?->name ?? '-' }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $grade->tutor?->user?->name ?? '-' }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $grade->semester }}</td>
                                    <td class="px-5 py-4"><span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700">{{ $grade->final_grade ?? '-' }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada data nilai.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
