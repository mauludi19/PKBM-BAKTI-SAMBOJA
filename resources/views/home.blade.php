@extends('layouts.public')

@section('title', 'PKBM Bakti Samboja - Halaman Utama')

@section('content')
    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        // Mengambil data statistik langsung dari database
        $totalStudents = Schema::hasTable('students') ? DB::table('students')->count() : 0;
        $totalTutors = Schema::hasTable('tutors') ? DB::table('tutors')->count() : 0;
        $latestNews = Schema::hasTable('news') ? DB::table('news')->latest()->take(3)->get() : collect();
    @endphp

    <section class="bg-green-800 text-white py-20 px-6 sm:px-10 shadow-md">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="max-w-2xl">
                <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Akreditasi B</span>
                <h2 class="text-4xl sm:text-5xl font-extrabold mb-4 mt-3 tracking-tight leading-tight">
                    Pusat Kegiatan Belajar Masyarakat <br>
                    <span class="text-yellow-400">PKBM Bakti Samboja</span>
                </h2>
                <p class="text-lg text-green-50 max-w-xl mb-8 leading-relaxed">
                    Lembaga pendidikan non-formal terpercaya yang menyediakan program kesetaraan Paket A (Setara SD), Paket B (Setara SMP), dan Paket C (Setara SMA).
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/ppdb" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-8 py-4 rounded-xl font-bold text-center transition shadow-md transform hover:-translate-y-0.5">
                        Daftar PPDB Online
                    </a>
                    <a href="/pages/profil" class="border-2 border-white hover:bg-white hover:text-green-800 px-8 py-4 rounded-xl font-semibold text-center transition">
                        Pelajari Profil
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 sm:px-10 bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-950">Visi & Misi Lembaga</h2>
                <div class="h-1 w-20 bg-green-700 mx-auto mt-3 rounded-full"></div>
            </div>

            <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-700 text-lg leading-relaxed text-center mb-6 italic">
                    "Menjadi lembaga pendidikan kesetaraan yang berkualitas, fleksibel, dan mudah diakses oleh seluruh lapisan masyarakat."
                </p>
                <hr class="border-gray-200 my-4">
                <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-650 mt-4">
                    <li class="flex items-start gap-2 bg-white p-4 rounded-xl border border-gray-100">
                        <span class="text-green-700 font-bold">✓</span>
                        <span>Menyediakan program pendidikan Paket A, B, dan C secara merata.</span>
                    </li>
                    <li class="flex items-start gap-2 bg-white p-4 rounded-xl border border-gray-100">
                        <span class="text-green-700 font-bold">✓</span>
                        <span>Mendukung sistem pembelajaran kombinasi offline dan online yang fleksibel.</span>
                    </li>
                    <li class="flex items-start gap-2 bg-white p-4 rounded-xl border border-gray-100">
                        <span class="text-green-700 font-bold">✓</span>
                        <span>Membantu peserta didik memperoleh kompetensi dan ijazah resmi negara.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 sm:px-10 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-950">Statistik Perkembangan</h2>
                <p class="text-gray-500 text-sm mt-2">Data riil operasional pendidikan di PKBM Bakti Samboja</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-5xl font-black text-green-700 tracking-tight">{{ $totalStudents }}</h3>
                        <p class="text-gray-500 font-medium text-sm mt-1">Total Siswa Terdaftar</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl text-2xl">👥</div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-5xl font-black text-green-700 tracking-tight">{{ $totalTutors }}</h3>
                        <p class="text-gray-500 font-medium text-sm mt-1">Tutor Pengajar</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl text-2xl">👨‍🏫</div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-5xl font-black text-green-700 tracking-tight">3</h3>
                        <p class="text-gray-500 font-medium text-sm mt-1">Program Paket (A, B, C)</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl text-2xl">📚</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 sm:px-10 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-950">Berita Terbaru</h2>
                    <p class="text-gray-500 text-sm mt-1">Informasi kegiatan dan pengumuman internal lembaga</p>
                </div>
                <a href="/news" class="text-sm font-semibold text-green-700 hover:text-green-800 transition">
                    Lihat Semua Berita &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($latestNews as $news)
                    <div class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden flex flex-col justify-between shadow-sm hover:shadow-md transition">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-green-700">
                                <a href="/news/{{ $news->slug ?? '#' }}">{{ $news->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($news->content), 120) }}
                            </p>
                        </div>
                        <div class="px-6 py-4 bg-gray-100 border-t border-gray-200/50 flex justify-between items-center text-xs text-gray-400">
                            <span>Kabar Lembaga</span>
                            <a href="/news/{{ $news->slug ?? '#' }}" class="text-green-700 font-semibold hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <span class="text-3xl block mb-2">📰</span>
                        <p class="text-gray-500 text-sm">Belum ada berita terbaru yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
