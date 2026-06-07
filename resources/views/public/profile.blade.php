@extends('layouts.public')

@section('title', 'Profil PKBM Bakti Samboja')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        <div class="flex items-center gap-4 mb-4">
            <div class="text-5xl">🏫</div>
        </div>
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Profil PKBM Bakti Samboja</h1>
        <p class="text-lg text-green-50 max-w-2xl">
            Pusat Kegiatan Belajar Masyarakat yang berkomitmen memberikan pendidikan berkualitas untuk semua kalangan dengan pendekatan modern dan inovatif.
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-6 sm:px-10 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Daftar Isi</h3>
                <nav class="space-y-2">
                    <a href="#tentang" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Tentang Kami
                    </a>
                    <a href="#visi-misi" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Visi & Misi
                    </a>
                    <a href="#nilai-inti" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Nilai Inti
                    </a>
                    <a href="#sejarah" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Sejarah
                    </a>
                    <a href="#struktur" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Struktur Organisasi
                    </a>
                    <a href="#program" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition font-medium">
                        Program Unggulan
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="lg:col-span-2">
            <!-- Tentang Kami -->
            <section id="tentang" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Tentang PKBM Bakti Samboja</h2>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <p>
                        <strong>PKBM Bakti Samboja</strong> adalah Pusat Kegiatan Belajar Masyarakat (PKBM) yang berdiri sejak tahun 2015 dan telah terakreditasi dengan status <strong>Akreditasi B</strong>. Kami berkomitmen untuk memberikan pendidikan berkualitas kepada seluruh masyarakat tanpa terkecuali.
                    </p>
                    <p>
                        Sebagai lembaga pendidikan non-formal, kami menyediakan program kesetaraan yang setara dengan pendidikan formal, mulai dari Paket A (setara SD), Paket B (setara SMP), hingga Paket C (setara SMA). Dengan kurikulum yang relevan dan metode pembelajaran yang inovatif, kami memastikan setiap peserta didik dapat mengembangkan potensi maksimal mereka.
                    </p>
                    <p>
                        Tim pengajar kami terdiri dari para profesional berpengalaman dan berdedikasi yang siap membimbing setiap siswa dalam perjalanan pendidikan mereka. Kami juga menyediakan fasilitas belajar modern yang mendukung proses pembelajaran yang efektif dan menyenangkan.
                    </p>
                </div>
            </section>

            <!-- Visi & Misi -->
            <section id="visi-misi" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Visi & Misi</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Visi -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-blue-900 mb-4 flex items-center gap-3">
                            <span class="text-3xl">🎯</span>
                            Visi
                        </h3>
                        <p class="text-gray-800 leading-relaxed font-medium">
                            Menjadi pusat kegiatan belajar masyarakat yang terpercaya dalam memberikan pendidikan berkualitas, inklusif, dan berkelanjutan untuk memberdayakan masyarakat dalam mengembangkan potensi diri.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-green-900 mb-4 flex items-center gap-3">
                            <span class="text-3xl">✨</span>
                            Misi
                        </h3>
                        <div class="text-gray-800 space-y-2">
                            <p>• Menyediakan program pendidikan yang relevan dan berkualitas tinggi</p>
                            <p>• Memberdayakan masyarakat melalui pendidikan berkelanjutan</p>
                            <p>• Menciptakan lingkungan belajar yang inklusif dan mendukung</p>
                            <p>• Mengembangkan kompetensi sesuai kebutuhan pasar kerja modern</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Nilai Inti -->
            <section id="nilai-inti" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Nilai-Nilai Inti Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nilai 1 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-start gap-4">
                            <div class="text-4xl">🤝</div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Integritas</h3>
                                <p class="text-gray-700">Kami berkomitmen untuk menjunjung tinggi nilai-nilai etika dan kejujuran dalam setiap aspek pendidikan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai 2 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-start gap-4">
                            <div class="text-4xl">💡</div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Inovasi</h3>
                                <p class="text-gray-700">Kami terus berinovasi dalam metode pembelajaran dan pengembangan kurikulum yang relevan dengan perkembangan zaman.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai 3 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-start gap-4">
                            <div class="text-4xl">🌍</div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Inklusivitas</h3>
                                <p class="text-gray-700">Pendidikan kami terbuka untuk semua orang tanpa memandang latar belakang, usia, atau kondisi sosial ekonomi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai 4 -->
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="flex items-start gap-4">
                            <div class="text-4xl">🎓</div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Keunggulan</h3>
                                <p class="text-gray-700">Kami berkomitmen untuk memberikan pendidikan terbaik dengan standar kualitas internasional.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sejarah -->
            <section id="sejarah" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Sejarah Singkat</h2>
                <div class="relative">
                    <div class="space-y-8">
                        <!-- Timeline Item 1 -->
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg">2015</div>
                                <div class="w-1 h-24 bg-green-300 mt-2"></div>
                            </div>
                            <div class="pt-2">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pendirian PKBM Bakti Samboja</h3>
                                <p class="text-gray-700">PKBM Bakti Samboja didirikan dengan visi untuk memberdayakan masyarakat melalui pendidikan non-formal berkualitas.</p>
                            </div>
                        </div>

                        <!-- Timeline Item 2 -->
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg">2018</div>
                                <div class="w-1 h-24 bg-green-300 mt-2"></div>
                            </div>
                            <div class="pt-2">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Akreditasi Nasional</h3>
                                <p class="text-gray-700">Memperoleh akreditasi status B dari Badan Akreditasi Nasional Pendidikan Non-Formal dan Informal (BAN-PNFI).</p>
                            </div>
                        </div>

                        <!-- Timeline Item 3 -->
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg">2020</div>
                                <div class="w-1 h-24 bg-green-300 mt-2"></div>
                            </div>
                            <div class="pt-2">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Digitalisasi Pembelajaran</h3>
                                <p class="text-gray-700">Meluncurkan platform pembelajaran digital untuk mendukung pendidikan jarak jauh dan pembelajaran hybrid.</p>
                            </div>
                        </div>

                        <!-- Timeline Item 4 -->
                        <div class="flex gap-6">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-lg">2023</div>
                            </div>
                            <div class="pt-2">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Ekspansi Program</h3>
                                <p class="text-gray-700">Memperluas jangkauan program dengan menambah paket pembelajaran dan kemitraan strategis dengan industri.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Struktur Organisasi -->
            <section id="struktur" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Struktur Organisasi</h2>
                <div class="bg-white border border-gray-200 rounded-lg p-8 overflow-x-auto">
                    <div class="space-y-4">
                        <!-- Kepala PKBM -->
                        <div class="flex justify-center mb-8">
                            <div class="bg-green-600 text-white px-6 py-3 rounded-lg font-bold text-center">
                                📋 Kepala PKBM Bakti Samboja
                            </div>
                        </div>

                        <!-- Second Level -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <div class="bg-green-50 border border-green-300 rounded-lg p-4 text-center">
                                <p class="font-bold text-gray-900">Kepala Bidang Akademik</p>
                                <p class="text-sm text-gray-600 mt-2">Mengelola kurikulum dan pembelajaran</p>
                            </div>
                            <div class="bg-green-50 border border-green-300 rounded-lg p-4 text-center">
                                <p class="font-bold text-gray-900">Kepala Bidang Administrasi</p>
                                <p class="text-sm text-gray-600 mt-2">Mengelola data dan keuangan</p>
                            </div>
                            <div class="bg-green-50 border border-green-300 rounded-lg p-4 text-center">
                                <p class="font-bold text-gray-900">Kepala Bidang Kesiswaan</p>
                                <p class="text-sm text-gray-600 mt-2">Mengelola siswa dan pengembangan karakter</p>
                            </div>
                        </div>

                        <!-- Divisions -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-gray-300 rounded-lg p-6">
                                <h4 class="font-bold text-gray-900 mb-4">Divisi Paket A</h4>
                                <ul class="text-sm text-gray-700 space-y-2">
                                    <li>✓ Koordinator Paket A</li>
                                    <li>✓ Tim Pengajar (5-7 orang)</li>
                                    <li>✓ Tutor Pendamping</li>
                                </ul>
                            </div>
                            <div class="border border-gray-300 rounded-lg p-6">
                                <h4 class="font-bold text-gray-900 mb-4">Divisi Paket B</h4>
                                <ul class="text-sm text-gray-700 space-y-2">
                                    <li>✓ Koordinator Paket B</li>
                                    <li>✓ Tim Pengajar (7-9 orang)</li>
                                    <li>✓ Tutor Pendamping</li>
                                </ul>
                            </div>
                            <div class="border border-gray-300 rounded-lg p-6">
                                <h4 class="font-bold text-gray-900 mb-4">Divisi Paket C</h4>
                                <ul class="text-sm text-gray-700 space-y-2">
                                    <li>✓ Koordinator Paket C</li>
                                    <li>✓ Tim Pengajar (10-12 orang)</li>
                                    <li>✓ Tutor Pendamping</li>
                                </ul>
                            </div>
                            <div class="border border-gray-300 rounded-lg p-6">
                                <h4 class="font-bold text-gray-900 mb-4">Unit Penunjang</h4>
                                <ul class="text-sm text-gray-700 space-y-2">
                                    <li>✓ Tim IT & Digital</li>
                                    <li>✓ Staff Administrasi</li>
                                    <li>✓ Keamanan & Kebersihan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Program Unggulan -->
            <section id="program" class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Program Unggulan Kami</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Paket A -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-300 rounded-lg overflow-hidden hover:shadow-xl transition">
                        <div class="bg-blue-600 text-white px-6 py-4">
                            <h3 class="text-2xl font-bold">Paket A</h3>
                            <p class="text-blue-100">Setara SD / MI</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📚 Durasi Belajar</p>
                                <p class="text-gray-700">6 bulan - 1 tahun</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">👥 Target Peserta</p>
                                <p class="text-gray-700">Anak usia 7-12 tahun yang belum menyelesaikan SD</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📖 Mata Pelajaran</p>
                                <ul class="text-gray-700 text-sm space-y-1">
                                    <li>• Bahasa Indonesia</li>
                                    <li>• Matematika</li>
                                    <li>• IPA & IPS</li>
                                    <li>• PKn & Agama</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Paket B -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-300 rounded-lg overflow-hidden hover:shadow-xl transition">
                        <div class="bg-green-600 text-white px-6 py-4">
                            <h3 class="text-2xl font-bold">Paket B</h3>
                            <p class="text-green-100">Setara SMP / MTs</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📚 Durasi Belajar</p>
                                <p class="text-gray-700">1 - 1.5 tahun</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">👥 Target Peserta</p>
                                <p class="text-gray-700">Remaja & dewasa yang belum menyelesaikan SMP</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📖 Mata Pelajaran</p>
                                <ul class="text-gray-700 text-sm space-y-1">
                                    <li>• Bahasa Indonesia & Inggris</li>
                                    <li>• Matematika</li>
                                    <li>• IPA & IPS</li>
                                    <li>• PKn & Agama</li>
                                    <li>• Keterampilan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Paket C -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-300 rounded-lg overflow-hidden hover:shadow-xl transition">
                        <div class="bg-purple-600 text-white px-6 py-4">
                            <h3 class="text-2xl font-bold">Paket C</h3>
                            <p class="text-purple-100">Setara SMA / MA</p>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📚 Durasi Belajar</p>
                                <p class="text-gray-700">1.5 - 2 tahun</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">👥 Target Peserta</p>
                                <p class="text-gray-700">Dewasa yang belum menyelesaikan SMA</p>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 mb-2">📖 Mata Pelajaran</p>
                                <ul class="text-gray-700 text-sm space-y-1">
                                    <li>• Bahasa Indonesia & Inggris</li>
                                    <li>• Matematika</li>
                                    <li>• Sains & Sosial</li>
                                    <li>• Sejarah & Geografi</li>
                                    <li>• Ekonomi & Kewirausahaan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas -->
                <div class="bg-white border border-gray-200 rounded-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Fasilitas & Sarana Pendidikan</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">🏫</div>
                            <p class="font-semibold text-gray-900">Ruang Belajar</p>
                            <p class="text-sm text-gray-600">Modern & Nyaman</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">💻</div>
                            <p class="font-semibold text-gray-900">Lab Komputer</p>
                            <p class="text-sm text-gray-600">35 Unit Komputer</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">📚</div>
                            <p class="font-semibold text-gray-900">Perpustakaan</p>
                            <p class="text-sm text-gray-600">2000+ Koleksi Buku</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">📡</div>
                            <p class="font-semibold text-gray-900">WiFi Gratis</p>
                            <p class="text-sm text-gray-600">Akses Internet 24/7</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">🎓</div>
                            <p class="font-semibold text-gray-900">Auditorium</p>
                            <p class="text-sm text-gray-600">Kapasitas 200 Orang</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">☕</div>
                            <p class="font-semibold text-gray-900">Kantin</p>
                            <p class="text-sm text-gray-600">Makanan Sehat</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">🛡️</div>
                            <p class="font-semibold text-gray-900">Keamanan 24/7</p>
                            <p class="text-sm text-gray-600">Sistem CCTV</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <div class="text-4xl mb-2">♿</div>
                            <p class="font-semibold text-gray-900">Aksesibilitas</p>
                            <p class="text-sm text-gray-600">Ramah Difabel</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Statistik -->
            <section class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 pb-4 border-b-4 border-green-600">Statistik PKBM</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg p-8 text-center hover:shadow-lg transition">
                        <div class="text-5xl font-bold mb-2">{{ $statistics['total_students'] ?? 0 }}</div>
                        <p class="text-lg font-semibold">Siswa Aktif</p>
                        <p class="text-blue-100 text-sm mt-2">Terdaftar di berbagai paket</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg p-8 text-center hover:shadow-lg transition">
                        <div class="text-5xl font-bold mb-2">{{ $statistics['total_tutors'] ?? 0 }}</div>
                        <p class="text-lg font-semibold">Tutor Berpengalaman</p>
                        <p class="text-green-100 text-sm mt-2">Profesional bersertifikat</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg p-8 text-center hover:shadow-lg transition">
                        <div class="text-5xl font-bold mb-2">{{ $statistics['total_packages'] ?? 0 }}</div>
                        <p class="text-lg font-semibold">Program Unggulan</p>
                        <p class="text-purple-100 text-sm mt-2">Paket A, B, dan C</p>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="bg-gradient-to-r from-green-600 to-green-800 text-white rounded-lg p-12 text-center">
                <h2 class="text-3xl font-bold mb-4">Siap untuk Bergabung?</h2>
                <p class="text-lg text-green-100 mb-8 max-w-2xl mx-auto">
                    Jangan lewatkan kesempatan untuk mengembangkan potensi diri Anda melalui pendidikan berkualitas di PKBM Bakti Samboja.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/ppdb" class="bg-white text-green-700 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition">
                        Daftar Sekarang
                    </a>
                    <a href="#kontak" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-green-700 transition">
                        Hubungi Kami
                    </a>
                </div>
            </section>
        </main>
    </div>
</div>
@endsection
