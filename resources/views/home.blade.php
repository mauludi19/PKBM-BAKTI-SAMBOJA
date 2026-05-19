<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $totalStudents = Schema::hasTable('students') ? DB::table('students')->count() : 0;
        $totalTutors = Schema::hasTable('tutors') ? DB::table('tutors')->count() : 0;
        $latestNews = Schema::hasTable('news') ? DB::table('news')->latest()->take(3)->get() : collect();
    @endphp

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-green-800">PKBM Bakti Samboja</h1>
            <p class="text-sm text-gray-500">Akreditasi B</p>
        </div>

        <div class="space-x-4">
            <a href="/" class="font-semibold">Home</a>
            <a href="/ppdb/create">PPDB</a>
            <a href="/tutors">Tutor</a>
            <a href="/students">Siswa</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="bg-green-800 text-white py-20 px-10">
        <h2 class="text-4xl font-bold mb-4">Pusat Kegiatan Belajar Masyarakat</h2>
        <h3 class="text-3xl font-bold text-yellow-400 mb-4">PKBM Bakti Samboja</h3>
        <p class="max-w-2xl mb-6">
            Lembaga pendidikan non-formal untuk program kesetaraan Paket A, Paket B, dan Paket C.
        </p>
        <a href="/ppdb/create" class="bg-yellow-400 text-black px-6 py-3 rounded-lg font-bold">
            Daftar Sekarang
        </a>
    </section>

    <!-- Visi Misi -->
    <section class="py-12 px-10 bg-white">
        <h2 class="text-3xl font-bold mb-4">Visi & Misi</h2>
        <p class="mb-4">
            Menjadi lembaga pendidikan kesetaraan yang berkualitas, fleksibel, dan mudah diakses oleh masyarakat.
        </p>
        <ul class="list-disc ml-6 space-y-2">
            <li>Menyediakan pendidikan Paket A, B, dan C.</li>
            <li>Mendukung pembelajaran offline dan online.</li>
            <li>Membantu peserta didik memperoleh ijazah resmi.</li>
        </ul>
    </section>

    <!-- Statistik -->
    <section class="py-12 px-10 bg-gray-100">
        <h2 class="text-3xl font-bold mb-6">Statistik</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-4xl font-bold text-green-800">{{ $totalStudents }}</h3>
                <p>Total Siswa</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-4xl font-bold text-green-800">{{ $totalTutors }}</h3>
                <p>Total Tutor</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-4xl font-bold text-green-800">3</h3>
                <p>Program Paket A, B, C</p>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section class="py-12 px-10 bg-white">
        <h2 class="text-3xl font-bold mb-6">Berita Terbaru</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($latestNews as $news)
                <div class="bg-gray-50 p-6 rounded-xl shadow">
                    <h3 class="text-xl font-bold mb-2">{{ $news->title }}</h3>
                    <p class="text-gray-600">
                        {{ Str::limit(strip_tags($news->content), 100) }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada berita terbaru.</p>
            @endforelse
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-green-900 text-white text-center py-6">
        <p>&copy; 2026 PKBM Bakti Samboja</p>
    </footer>

</body>
</html>
