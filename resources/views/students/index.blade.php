<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $students = Schema::hasTable('students')
            ? DB::table('students')
                ->leftJoin('users', 'students.user_id', '=', 'users.id')
                ->leftJoin('packages', 'students.package_id', '=', 'packages.id')
                ->select(
                    'students.*',
                    'users.name as user_name',
                    'users.email',
                    'packages.name as package_name'
                )
                ->get()
            : collect();
    @endphp

    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold text-green-800">PKBM Bakti Samboja</h1>
        <a href="/" class="text-green-700 font-semibold">Kembali ke Home</a>
    </nav>

    <main class="max-w-7xl mx-auto mt-10 p-6">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-3xl font-bold">Data Siswa</h2>
                <p class="text-gray-600">Daftar siswa PKBM Bakti Samboja</p>
            </div>

            <a href="/ppdb/create"
               class="bg-green-800 text-white px-5 py-3 rounded-lg font-semibold">
                + Tambah Siswa
            </a>
        </div>

        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="w-full">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Paket</th>
                        <th class="p-4 text-left">NISN</th>
                        <th class="p-4 text-left">Jenis Kelamin</th>
                        <th class="p-4 text-left">No HP</th>
                        <th class="p-4 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($students as $student)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">
                                <div>
                                    <h3 class="font-semibold">
                                        {{ $student->user_name ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $student->email ?? '-' }}
                                    </p>
                                </div>
                            </td>

                            <td class="p-4">
                                {{ $student->package_name ?? '-' }}
                            </td>

                            <td class="p-4">
                                {{ $student->nisn ?? '-' }}
                            </td>

                            <td class="p-4">
                                {{ ucfirst($student->gender ?? '-') }}
                            </td>

                            <td class="p-4">
                                {{ $student->phone ?? '-' }}
                            </td>

                            <td class="p-4">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                    {{ ucfirst($student->status ?? 'aktif') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>
