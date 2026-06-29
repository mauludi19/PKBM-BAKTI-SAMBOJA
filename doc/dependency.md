# Dokumentasi Dependency PKBM Bakti Samboja

Versi pada tabel diambil dari lock file dan instalasi proyek saat ini berdasarkan batasan versi yang tertera pada konfigurasi environment.

## Dependency Backend

| Package | Fungsi | Alasan digunakan | Versi terpasang | Risiko/Perhatian |
| --- | --- | --- | --- | --- |
| `laravel/framework` | Framework aplikasi | Routing, Eloquent, validasi, multi-role auth, queue, dan fondasi sistem | 13.15.0 | Upgrade mayor dapat mengubah API framework |
| `filament/filament` | Panel admin, tutor, siswa | Mempercepat pembuatan CRUD nilai, verifikasi PPDB, dan dashboard multi-panel | 5.6.7 | Resource dan schema perlu mengikuti API Filament 5 |
| `livewire/livewire` | UI reaktif | Katalog data siswa publik (Paket A, B, C) dan komponen panel reaktif | 4.3.1 | Constraint `*` di composer.json terlalu longgar dan sebaiknya dikunci |
| `laravel/tinker` | REPL Laravel | Debug dan inspeksi aplikasi pada lingkungan lokal | ^3.0 | Jangan dipakai untuk mutasi data production tanpa kontrol |
| `barryvdh/laravel-dompdf` | Pembuatan PDF | Disiapkan untuk kebutuhan cetak laporan raport digital oleh siswa | 3.1.2 | Konsumsi memori meningkat untuk dokumen besar |
| `spatie/laravel-permission` | Role dan permission | Disiapkan untuk otorisasi granular akses panel | 7.4.2 | Saat ini role utama masih disimpan langsung pada kolom `users.role` |

## Dependency Development

| Package | Fungsi | Versi terpasang | Risiko/Perhatian |
| --- | --- | --- | --- |
| `phpunit/phpunit` | Framework automated testing | 12.5.12 | Test database memerlukan `pdo_sqlite` aktif |
| `phpstan/phpstan` | Tool static analysis kode PHP | 2.1 | Pastikan level pengecekan tidak memicu false positive |
| `laravel/pint` | Formatter gaya kode PHP | 1.29 | Jalankan perintah linting sebelum melakukan commit |
| `laravel/breeze` | Scaffolding autentikasi awal | 2.4 | Digunakan untuk basis otentikasi login bersama |
| `laravel/pail` | Pembaca log Laravel di CLI | 1.2.5 | Jangan mengekspos log sensitif pada environment live |
| `laravel/pao` | Output test untuk agent | 1.0.6 | Pada sebagian lingkungan Windows perlu parameter penyesuaian |
| `fakerphp/faker` | Penghasil data tiruan (seeder) | 1.23 | Data siswa dan tutor yang dihasilkan hanya bersifat sintetis |
| `mockery/mockery` | Mock object untuk unit testing | 1.6 | Mock berlebihan dapat membuat unit test menjadi rapuh |
| `nunomaduro/collision` | Tampilan error detail di CLI | 8.6 | Dependency khusus lingkup development saja |

## Dependency Frontend

| Package | Fungsi | Versi terpasang | Risiko/Perhatian |
| --- | --- | --- | --- |
| `vite` | Build tool frontend utama | 8.0.0 | Memerlukan Node.js yang kompatibel pada runner CI |
| `laravel-vite-plugin` | Integrasi Laravel-Vite | 3.1 | Build gagal jika entry point script tidak sesuai |
| `tailwindcss` | Utility-first CSS framework | 3.1.0 | Perubahan mayor berbeda dari konfigurasi versi di atasnya |
| `@tailwindcss/vite` | Plugin Tailwind untuk Vite | 4.0.0 | Perhatikan keselarasan versi build compiler |
| `@tailwindcss/forms` | Normalisasi komponen form | 0.5.2 | Style dapat memengaruhi input form bawaan Filament |
| `alpinejs` | Interaksi frontend ringan | 3.15.12 | Mengatur reaktivitas komponen mini di landing page |
| `alpine` | Core framework script | 0.2.1 | Jaga agar script global tidak tabrakan dengan alpinejs |
| `axios` | HTTP Client untuk request AJAX | 1.16.1 | Digunakan untuk fetch data asynchronous |
| `autoprefixer` | Parsing CSS ke browser compatibility | 10.4.2 | Memastikan tampilan CSS Tailwind rapi di semua browser |
| `postcss` | Tool transformasi CSS dengan JS | 8.4.31 | Diperlukan oleh Tailwind untuk memproses utility class |
| `concurrently` | Menjalankan proses dev serentak | 9.0.1 | Menjalankan `php artisan serve` dan `vite` bersamaan |

## Cara Instalasi

Instal seluruh dependency sesuai lock file:

```bash
composer install
npm ci

Menambahkan dependency PHP:

```bash
composer require vendor/package
```

Menambahkan dependency frontend:

```bash
npm install package-name
```

Setelah mengubah dependency:

```bash
composer validate
npm run build
php artisan test --compact
```

## Dampak Dependency terhadap Proyek

- Filament: Mengurangi jumlah kode CRUD tetapi meningkatkan keterikatan pada API panel builder tri-role 
          (Admin, Tutor, Siswa).
- Livewire: Membuat halaman data siswa publik menjadi reaktif sekaligus menjadi fondasi komponen panel.
- Tailwind dan Vite: Mempercepat pengembangan UI kustom untuk profil sekolah dan PPDB, tetapi membutuhkan
                   proses build Node.js pada pipeline GitHub Actions.
- DomPDF dan Spatie Permission: Telah dideklarasikan untuk kebutuhan cetak raport dan otorisasi lanjutan, 
                              tetapi penggunaannya perlu diaudit berkala agar package yang tidak terpakai 
                              tidak menambah beban maintenance.

## Strategi Pemeliharaan
- Gunakan composer outdated --direct dan npm outdated secara berkala.
- Hindari constraint tanpa batas seperti livewire/livewire: "*".
- Commit composer.lock dan package-lock.json.
- Jalankan CI (GitHub Actions) setiap ada perubahan dependency.
- Uji upgrade mayor pada branch terpisah sebelum digabung ke main.
