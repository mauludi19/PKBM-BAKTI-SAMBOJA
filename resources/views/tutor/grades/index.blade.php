<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nilai Siswa - PKBM Bakti Samboja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen lg:flex">
        <aside class="bg-emerald-950 text-white lg:min-h-screen lg:w-72">
            <div class="border-b border-white/10 px-6 py-5">
                <p class="text-sm text-emerald-200">PKBM Bakti Samboja</p>
                <h1 class="text-xl font-semibold">Tutor Panel</h1>
            </div>
            <nav class="space-y-1 px-4 py-5">
                <a href="{{ route('tutor.dashboard') }}" class="block rounded-md px-4 py-2.5 text-sm font-medium text-emerald-50 hover:bg-white/10">Dashboard</a>
                <a href="{{ route('tutor.grades.index') }}" class="block rounded-md bg-emerald-700 px-4 py-2.5 text-sm font-medium text-white">Nilai Siswa</a>
                <a href="{{ route('home') }}" class="block rounded-md px-4 py-2.5 text-sm font-medium text-emerald-50 hover:bg-white/10">Halaman Publik</a>
            </nav>
        </aside>

        <div class="min-w-0 flex-1">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-5 sm:px-6 lg:px-8">
                    <div>
                        <p class="text-sm text-slate-500">Akademik tutor</p>
                        <h2 class="text-2xl font-semibold tracking-tight">Nilai Siswa</h2>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('tutor.grades.create') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Input Nilai</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium hover:bg-slate-50">Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                @endif

                <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Siswa</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Mata Pelajaran</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Semester</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Tahun Ajaran</th>
                                <th class="px-5 py-3 text-left text-sm font-semibold">Nilai Akhir</th>
                                <th class="px-5 py-3 text-right text-sm font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($grades as $grade)
                                <tr>
                                    <td class="px-5 py-4 font-medium">{{ $grade->student?->user?->name ?? '-' }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $grade->subject?->name ?? '-' }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $grade->semester }}</td>
                                    <td class="px-5 py-4 text-sm text-slate-600">{{ $grade->academic_year }}</td>
                                    <td class="px-5 py-4"><span class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700">{{ $grade->final_grade ?? '-' }}</span></td>
                                    <td class="px-5 py-4 text-right text-sm">
                                        <a href="{{ route('tutor.grades.show', $grade) }}" class="font-medium text-slate-700 hover:text-slate-900">Detail</a>
                                        <a href="{{ route('tutor.grades.edit', $grade) }}" class="ml-3 font-medium text-emerald-700 hover:text-emerald-900">Edit</a>
                                        <form method="POST" action="{{ route('tutor.grades.destroy', $grade) }}" class="ml-3 inline" onsubmit="return confirm('Hapus nilai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-5 py-8 text-center text-sm text-slate-500">Belum ada nilai yang diinput.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
