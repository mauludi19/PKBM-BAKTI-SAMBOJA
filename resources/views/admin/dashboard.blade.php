<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $totalStudents = Schema::hasTable('students')
            ? DB::table('students')->count()
            : 0;

        $totalTutors = Schema::hasTable('tutors')
            ? DB::table('tutors')->count()
            : 0;

        $totalPPDB = Schema::hasTable('ppdb_registrations')
            ? DB::table('ppdb_registrations')->count()
            : 0;

        $latestStudents = Schema::hasTable('students')
            ? DB::table('students')
                ->leftJoin('users', 'students.user_id', '=', 'users.id')
                ->select('students.*', 'users.name')
                ->latest('students.created_at')
                ->take(5)
                ->get()
            : collect();
    @endphp

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-green-900 text-white p-6">
            <h1 class="text-2xl font-bold mb-10">PKBM Admin</h1>

            <nav class="space-y-4">
                <a href="/admin/dashboard" class="block bg-green-700 px-4 py-3 rounded-lg">
                    Dashboard
                </a>

                <a href="/students" class="block hover:bg-green-700 px-4 py-3 rounded-lg">
                    Data Siswa
                </a>

                <a href="/tutors" class="block hover:bg-green-700 px-4 py-3 rounded-lg">
                    Data Tutor
                </a>

                <a href="/ppdb/create" class="block hover:bg-green-700 px-4 py-3 rounded-lg">
                    PPDB
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <main class="flex-1 p-10">

            <div class="mb-10">
                <h2 class="text-4xl font-bold">Dashboard Admin</h2>
                <p class="text-gray-600">Selamat datang di sistem PKBM Bakti Samboja</p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Total Siswa</p>
                    <h3 class="text-4xl font-bold text-green-800">
                        {{ $totalStudents }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Total Tutor</p>
                    <h3 class="text-4xl font-bold text-green-800">
                        {{ $totalTutors }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Pendaftaran PPDB</p>
                    <h3 class="text-4xl font-bold text-green-800">
                        {{ $totalPPDB }}
                    </h3>
                </div>

            </div>

            <!-- Siswa Terbaru -->
            <div class="bg-white rounded-xl shadow p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Siswa Terbaru</h3>

                    <a href="/students"
                       class="text-green-700 font-semibold">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">

                        <thead class="border-b">
                            <tr>
                                <th class="text-left p-3">Nama</th>
                                <th class="text-left p-3">NISN</th>
                                <th class="text-left p-3">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($latestStudents as $student)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">
                                        {{ $student->name ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        {{ $student->nisn ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                            {{ ucfirst($student->status ?? 'aktif') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-6 text-center text-gray-500">
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </main>

    </div>

</body>
</html>
