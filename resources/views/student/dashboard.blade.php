<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Student - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $grades = Schema::hasTable('tutor_grades')
            ? DB::table('tutor_grades')
                ->leftJoin('subjects', 'tutor_grades.subject_id', '=', 'subjects.id')
                ->select(
                    'subjects.name as subject_name',
                    'tutor_grades.final_grade',
                    'tutor_grades.semester'
                )
                ->take(5)
                ->get()
            : collect();
    @endphp

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-green-900 text-white p-6">
            <h1 class="text-2xl font-bold mb-10">Student Panel</h1>

            <nav class="space-y-4">
                <a href="/student/dashboard"
                   class="block bg-green-700 px-4 py-3 rounded-lg">
                    Dashboard
                </a>

                <a href="/students"
                   class="block hover:bg-green-700 px-4 py-3 rounded-lg">
                    Data Siswa
                </a>

                <a href="/"
                   class="block hover:bg-green-700 px-4 py-3 rounded-lg">
                    Home
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <main class="flex-1 p-10">

            <div class="mb-10">
                <h2 class="text-4xl font-bold">Dashboard Student</h2>
                <p class="text-gray-600">
                    Informasi nilai dan pembelajaran siswa
                </p>
            </div>

            <!-- Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Status</p>
                    <h3 class="text-3xl font-bold text-green-800">
                        Aktif
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Semester</p>
                    <h3 class="text-3xl font-bold text-green-800">
                        2
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">Rata-rata Nilai</p>
                    <h3 class="text-3xl font-bold text-green-800">
                        88
                    </h3>
                </div>

            </div>

            <!-- Nilai -->
            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Nilai Terbaru
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full">

                        <thead class="border-b">
                            <tr>
                                <th class="text-left p-3">Mata Pelajaran</th>
                                <th class="text-left p-3">Semester</th>
                                <th class="text-left p-3">Nilai</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($grades as $grade)
                                <tr class="border-b hover:bg-gray-50">

                                    <td class="p-3">
                                        {{ $grade->subject_name ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        {{ $grade->semester ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                            {{ $grade->final_grade ?? '-' }}
                                        </span>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"
                                        class="p-6 text-center text-gray-500">
                                        Belum ada data nilai.
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
