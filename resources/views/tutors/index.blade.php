<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tutor - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $tutors = Schema::hasTable('tutors')
            ? DB::table('tutors')
                ->leftJoin('users', 'tutors.user_id', '=', 'users.id')
                ->select('tutors.*', 'users.name as user_name', 'users.email')
                ->get()
            : collect();
    @endphp

    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold text-green-800">PKBM Bakti Samboja</h1>
        <a href="/" class="text-green-700 font-semibold">Kembali ke Home</a>
    </nav>

    <main class="max-w-6xl mx-auto mt-10 p-6">
        <h2 class="text-3xl font-bold mb-2">Daftar Tutor</h2>
        <p class="text-gray-600 mb-8">Menampilkan daftar tutor dan mata pelajaran/spesialisasi.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($tutors as $tutor)
                <div class="bg-white rounded-xl shadow p-6">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-800 text-2xl font-bold mb-4">
                        {{ strtoupper(substr($tutor->user_name ?? 'T', 0, 1)) }}
                    </div>

                    <h3 class="text-xl font-bold">{{ $tutor->user_name ?? 'Nama Tutor' }}</h3>
                    <p class="text-gray-600">{{ $tutor->specialization ?? 'Mata Pelajaran' }}</p>

                    <div class="mt-4 text-sm text-gray-700 space-y-1">
                        <p><strong>NIP:</strong> {{ $tutor->nip ?? '-' }}</p>
                        <p><strong>Pendidikan:</strong> {{ $tutor->education ?? '-' }}</p>
                        <p><strong>No HP:</strong> {{ $tutor->phone ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $tutor->email ?? '-' }}</p>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow p-6 col-span-3">
                    <p class="text-gray-500">Belum ada data tutor.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>
