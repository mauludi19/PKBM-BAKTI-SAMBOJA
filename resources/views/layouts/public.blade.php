<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PKBM Bakti Samboja')</title>
    <meta name="description" content="PKBM Bakti Samboja - Pusat Kegiatan Belajar Masyarakat terpercaya">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="text-3xl">🎓</div>
                <div>
                    <h1 class="text-xl font-bold text-green-700">PKBM</h1>
                    <p class="text-xs text-gray-500">Bakti Samboja</p>
                </div>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center gap-8">
                <a href="/" class="text-gray-700 hover:text-green-700 font-medium transition">Beranda</a>
                <a href="/pages/profil" class="text-gray-700 hover:text-green-700 font-medium transition">Profil</a>
                <a href="#" class="text-gray-700 hover:text-green-700 font-medium transition">Program</a>
                <a href="/news" class="text-gray-700 hover:text-green-700 font-medium transition">Berita</a>
                <a href="#" class="text-gray-700 hover:text-green-700 font-medium transition">Kontak</a>
            </div>

            <!-- CTA Button -->
            <div class="hidden md:block">
                <a href="/ppdb" class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Daftar
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="md:hidden text-gray-700 text-2xl" id="mobileMenuBtn">
                ☰
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100 px-6 py-4 space-y-3">
            <a href="/" class="block text-gray-700 hover:text-green-700 font-medium py-2">Beranda</a>
            <a href="/pages/profil" class="block text-gray-700 hover:text-green-700 font-medium py-2">Profil</a>
            <a href="#" class="block text-gray-700 hover:text-green-700 font-medium py-2">Program</a>
            <a href="/news" class="block text-gray-700 hover:text-green-700 font-medium py-2">Berita</a>
            <a href="#" class="block text-gray-700 hover:text-green-700 font-medium py-2">Kontak</a>
            <a href="/ppdb" class="block w-full bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg font-semibold text-center transition mt-4">
                Daftar PPDB
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-200 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Tentang -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">PKBM Bakti Samboja</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Lembaga pendidikan non-formal terpercaya yang menyediakan program kesetaraan berkualitas untuk semua kalangan masyarakat.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="/pages/profil" class="text-gray-400 hover:text-white transition">Profil</a></li>
                        <li><a href="/news" class="text-gray-400 hover:text-white transition">Berita</a></li>
                        <li><a href="/ppdb" class="text-gray-400 hover:text-white transition">PPDB Online</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="text-gray-400">
                            <span class="block font-medium text-white">Telepon</span>
                            (0274) 555-0999 <br>
                            (0274) 555-0999 <br>
                            (0274) 555-0999 <br>
                            (0274) 555-0999 <br>
                        </li>
                        <li class="text-gray-400">
                            <span class="block font-medium text-white">Email</span>
                            info@pkbmbakti.ac.id
                        </li>
                        <li class="text-gray-400">
                            <span class="block font-medium text-white">Alamat</span>
                            Korong Kayu Samuk, Jorong Simpang, Nagari Kotobaru, Kec. Kubung, Kab. Solok
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-700 rounded-lg flex items-center justify-center transition text-white">
                            f
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-700 rounded-lg flex items-center justify-center transition text-white">
                            𝕏
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-700 rounded-lg flex items-center justify-center transition text-white">
                            📷
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-green-700 rounded-lg flex items-center justify-center transition text-white">
                            ▶
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; 2026 PKBM Bakti Samboja. Semua hak dilindungi.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        // Close menu when link clicked
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('mobileMenu').classList.add('hidden');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
