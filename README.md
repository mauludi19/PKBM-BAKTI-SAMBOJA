# PKBM BAKTI SAMBOJA 🏫

**PKBM BAKTI SAMBOJA** adalah sistem manajemen operasional Pusat Kegiatan Belajar Masyarakat (PKBM) Bakti Samboja. Sistem ini dirancang untuk mengotomatisasi pendaftaran siswa baru (PPDB), manajemen akademik, profil siswa dan pengajar (tutor), penginputan nilai, serta publikasi berita dan informasi umum.

Sistem ini dibangun menggunakan framework **Laravel 13**, **Vite**, dan **Tailwind CSS**.

---

## 🚀 Fitur Utama

1. **Sistem Autentikasi & Otorisasi**: Manajemen pengguna berbasis peran (Role-Based Access Control) untuk Admin, Tutor, dan Siswa.
2. **Dashboard Interaktif**: Statistik ringkas yang disesuaikan untuk masing-masing peran pengguna.
3. **Pendaftaran PPDB Online**: Formulir pendaftaran publik disertai unggah dokumen pendukung, pelacakan status, dan persetujuan admin yang secara otomatis membuat akun siswa baru.
4. **Manajemen Akademik**: Pengelolaan tahun ajaran, paket belajar, mata pelajaran, dan nilai siswa.
5. **Manajemen Konten (CMS)**: Publikasi berita, pengelolaan halaman statis, dan pengaturan umum situs.
6. **Portal Publik**: Landing page informasi lembaga, daftar tutor, daftar siswa, dan pengumuman berita.

---

## 🛠️ Spesifikasi Teknologi

- **Backend**: PHP ^8.3 & Laravel 13.x
- **Frontend**: Blade Templates & Tailwind CSS
- **Build Tool**: Vite
- **Database**: MySQL / SQLite (untuk pengujian)
- **Code Quality**: Laravel Pint (PSR-12)

---

## 📦 Petunjuk Pemasangan (Setup)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Prasyarat
Pastikan Anda telah memasang **PHP ^8.3**, **Composer**, dan **Node.js** di komputer Anda.

### 2. Kloning Repositori
```bash
git clone https://github.com/mauludi19/PKBM-BAKTI-SAMBOJA.git
cd PKBM-BAKTI-SAMBOJA
```

### 3. Pasang Dependensi
Pasang dependensi PHP dan Node.js:
```bash
composer install
npm install
```

### 4. Konfigurasi Lingkungan (Environment)
Salin file konfigurasi lingkungan:
```bash
cp .env.example .env
```
Sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) pada file `.env` baru Anda.

### 5. Generate Application Key & Link Storage
```bash
php artisan key:generate
php artisan storage:link
```

### 6. Migrasi & Seeding Database
Jalankan migrasi tabel beserta data awal bawaan:
```bash
php artisan migrate --seed
```

### 7. Jalankan Server Pengembangan
Jalankan Laravel serve dan compiler Vite secara bersamaan:

```bash
# Terminal 1: Menjalankan Laravel
php artisan serve

# Terminal 2: Menjalankan Vite Dev Server
npm run dev
```

Aplikasi sekarang dapat diakses melalui browser Anda di `http://127.0.0.1:8000`.

---

## 🧪 Pengujian (Testing)

Jalankan perintah berikut untuk mengeksekusi semua automated tests:
```bash
composer test
```
Atau gunakan Artisan:
```bash
php artisan test
```

---

## 📚 Dokumen Sumber Daya Tambahan

Untuk panduan pengembangan dan dokumentasi teknis lebih detail, silakan baca berkas berikut:

- 🤖 [agent.md](agent.md) - Panduan agen AI, konvensi kode, dan status tugas saat ini.
- 📋 [srs.md](srs.md) - Spesifikasi kebutuhan perangkat lunak (Software Requirements Specification).
- 🏗️ [architecture.md](architecture.md) - Arsitektur teknis dan struktur proyek.
- 🗄️ [db-schema.md](db-schema.md) - Skema database dan relasi antar tabel.
- 🛣️ [roadmap.md](roadmap.md) - Rencana fase pengembangan dan timeline proyek.
- 🔐 [.instructions.md](.instructions.md) - Aturan dan prinsip kerja pengembangan.
- 📚 [Panduan Keahlian (Skills Index)](skills/INDEX.md) - Direktori panduan spesifik per fitur aplikasi.
