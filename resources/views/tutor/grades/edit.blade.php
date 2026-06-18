<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Nilai - PKBM Bakti Samboja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('tutor.grades.index') }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">Kembali ke nilai</a>
            <h1 class="mt-3 text-2xl font-semibold tracking-tight">Edit Nilai Siswa</h1>
            <p class="mt-1 text-sm text-slate-500">Perbarui komponen nilai dan catatan pembelajaran siswa.</p>
        </div>

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

        <form method="POST" action="{{ route('tutor.grades.update', $grade) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')
            @include('tutor.grades.partials.form')
        </form>
    </main>
</body>
</html>
