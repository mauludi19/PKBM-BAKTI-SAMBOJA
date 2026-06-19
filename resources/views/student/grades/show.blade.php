<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Nilai Saya - PKBM Bakti Samboja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('student.grades.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">Kembali ke nilai saya</a>
            <h1 class="mt-3 text-2xl font-semibold tracking-tight">Detail Nilai Saya</h1>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div><dt class="text-sm text-slate-500">Mata Pelajaran</dt><dd class="mt-1 font-semibold">{{ $grade->subject?->name ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Tutor</dt><dd class="mt-1 font-semibold">{{ $grade->tutor?->user?->name ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Semester</dt><dd class="mt-1 font-semibold">{{ $grade->semester }}</dd></div>
                <div><dt class="text-sm text-slate-500">Tahun Ajaran</dt><dd class="mt-1 font-semibold">{{ $grade->academic_year }}</dd></div>
                <div><dt class="text-sm text-slate-500">Nilai Tugas</dt><dd class="mt-1 font-semibold">{{ $grade->assignment_score ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Nilai Tengah Semester</dt><dd class="mt-1 font-semibold">{{ $grade->mid_score ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Nilai Akhir Semester</dt><dd class="mt-1 font-semibold">{{ $grade->final_score ?? '-' }}</dd></div>
                <div><dt class="text-sm text-slate-500">Nilai Akhir</dt><dd class="mt-1 text-2xl font-bold text-emerald-700">{{ $grade->final_grade ?? '-' }}</dd></div>
                <div class="sm:col-span-2"><dt class="text-sm text-slate-500">Catatan Tutor</dt><dd class="mt-1 leading-6 text-slate-700">{{ $grade->notes ?? '-' }}</dd></div>
            </dl>
        </div>
    </main>
</body>
</html>
