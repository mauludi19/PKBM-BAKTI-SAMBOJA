<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tutor - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $grades = Schema::hasTable('tutor_grades')
            ? DB::table('tutor_grades')
                ->leftJoin('students', 'tutor_grades.student_id', '=', 'students.id')
                ->leftJoin('users', 'students.user_id', '=', 'users.id')
                ->leftJoin('subjects', 'tutor_grades.subject_id', '=', 'subjects.id')
                ->select(
                    'users.name as student_name',
                    'subjects.name as subject_name',
                    'tutor_grades.final_grade'
                )
                ->latest('tutor_grades.created_at')
                ->take(5)
                ->get()
            : collect();

        $subjects = Schema::hasTable('subjects')
            ? DB::table('subjects')->take(5)->get()
            : collect();
    @endphp

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-green-900 text-white p-6">

            <h1 class="text-2xl font-bold mb-10">
                Tutor Panel
            </h1>

            <nav class="space-y-4">

                <a href="/tutor/dashboard"
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
                <h2 class="text-4xl font-bold">
                    Dashboard Tutor
                </h2>

                <p class="text-gray-600">
                    Kelola nilai dan mata pelajaran siswa
                </p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">
                        Mata Pelajaran
                    </p>

                    <h3 class="text-3xl font-bold text-green-800">
                        {{ $subjects->count() }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">
                        Nilai Diinput
                    </p>

                    <h3 class="text-3xl font-bold text-green-800">
                        {{ $grades->count() }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500 mb-2">
                        Status Tutor
                    </p>

                    <h3 class="text-3xl font-bold text-green-800">
                        Aktif
                    </h3>
                </div>

            </div>

            <!-- Mata Pelajaran -->
            <div class="bg-white rounded-xl shadow p-6 mb-10">

                <h3 class="text-2xl font-bold mb-6">
                    Mata Pelajaran
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @forelse ($subjects as $subject)

                        <div class="border rounded-xl p-5 hover:bg-gray-50">
                            <h4 class="font-bold text-lg">
                                {{ $subject->name }}
                            </h4>

                            <p class="text-gray-500 mt-2">
                                Kode:
                                {{ $subject->code }}
                            </p>
                        </div>

                    @empty

                        <p class="text-gray-500">
                            Belum ada mata pelajaran.
                        </p>

                    @endforelse

                </div>

            </div>

            <!-- Nilai Terbaru -->
            <div class="bg-white rounded-xl shadow p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Nilai Terbaru
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="border-b">
                            <tr>
                                <th class="text-left p-3">
                                    Nama Siswa
                                </th>

                                <th class="text-left p-3">
                                    Mata Pelajaran
                                </th>

                                <th class="text-left p-3">
                                    Nilai
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($grades as $grade)

                                <tr class="border-b hover:bg-gray-50">

                                    <td class="p-3">
                                        {{ $grade->student_name ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        {{ $grade->subject_name ?? '-' }}
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
