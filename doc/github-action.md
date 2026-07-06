# GitHub Actions CI Documentation

## 1. Ringkasan

Website PKBM Bakti Samboja menggunakan workflow Continuous Integration (CI) untuk melakukan validasi otomatis terhadap dependency, database, build frontend, serta pengujian aplikasi sebelum perubahan direview atau digabungkan ke branch utama.

---

## 2. Lokasi Workflow

```text
.github/workflows/ci.yml
```

---

## 3. Trigger Workflow

Workflow akan dijalankan ketika:

1. Terjadi **push** ke semua branch.
2. Terjadi **pull request** menuju branch `main`.
3. Workflow dijalankan secara manual menggunakan `workflow_dispatch`.

---

## 4. Environment yang Digunakan

| No | Komponen            | Konfigurasi                                    |
| -- | ------------------- | ---------------------------------------------- |
| 1  | Runner              | Ubuntu Latest                                  |
| 2  | PHP                 | 8.4                                            |
| 3  | Node.js             | 22                                             |
| 4  | Database Test       | SQLite (temporary database pada GitHub Runner) |
| 5  | Dependency PHP      | Composer (`composer.lock`)                     |
| 6  | Dependency Frontend | npm (`package-lock.json`)                      |

---

## 5. Alur Eksekusi Workflow

Workflow menjalankan proses berikut secara berurutan:

### Tahap 1 — Persiapan Source Code

* Checkout source code
* Setup PHP dan extension yang diperlukan
* Setup Node.js

### Tahap 2 — Verifikasi Dependency

* Validasi konfigurasi Composer
* Install dependency Composer berdasarkan lockfile
* Audit kerentanan dependency PHP
* Install dependency npm berdasarkan lockfile
* Audit dependency frontend level High dan Critical

### Tahap 3 — Persiapan Laravel

* Membuat file `.env`
* Generate Laravel Application Key
* Membuat database SQLite sementara
* Menjalankan migration

### Tahap 4 — Build dan Optimasi

* Build asset menggunakan Vite
* Membuat Config Cache
* Membuat Event Cache
* Membuat Route Cache
* Membuat View Cache

### Tahap 5 — Pengujian

* Menjalankan seluruh test menggunakan Pest

---

## 6. Perintah yang Diverifikasi oleh CI

```bash
composer validate --no-check-publish

composer audit --locked --no-interaction

npm audit --audit-level=high

npm run build

php artisan optimize

vendor/bin/pest --ci
```

---

## 7. Monitoring Hasil Workflow

Status eksekusi workflow dapat dipantau melalui halaman Actions repository berikut:

https://github.com/mauludi/pkbm-samboja/actions

---

## 8. Badge Continuous Integration

Tambahkan badge berikut pada file README:

```html
<a href="https://github.com/mauludi/pkbm-samboja/actions/workflows/ci.yml">
    <img src="https://github.com/mauludi/pkbm-samboja/actions/workflows/ci.yml/badge.svg" alt="CI">
</a>
```

---

## 9. Dokumentasi Screenshot

Apabila workflow berhasil dijalankan untuk pertama kali, simpan screenshot pada lokasi berikut:

```text
docs/images/github-actions-success.png
```

---

## 10. Interpretasi Status Workflow

| Status     | Keterangan                                                           |
| ---------- | -------------------------------------------------------------------- |
| 🟢 Success | Semua tahapan berhasil dijalankan dan perubahan siap direview.       |
| 🔴 Failed  | Terdapat proses yang gagal dan perlu diperiksa lebih lanjut.         |
| 🟡 Queued  | Workflow sedang menunggu runner atau sedang diproses GitHub Actions. |

---

## 11. Jaminan yang Diberikan CI

Pipeline CI ini memastikan bahwa pada lingkungan berikut:

* Ubuntu Latest
* PHP 8.4
* Node.js 22
* SQLite

proses berikut berhasil dilakukan:

### Build Verification

* Dependency berhasil dipasang dari lockfile.
* Migration database berhasil dijalankan.
* Asset frontend berhasil dibangun.
* Cache production Laravel berhasil dibuat.

### Dependency Verification

* Composer Audit berhasil dijalankan.
* npm Audit berhasil dijalankan.
* Tidak terdapat advisory dependency yang menyebabkan workflow gagal.

### Test Verification

* Seluruh test Pest berhasil dijalankan.

---

## 12. Ruang Lingkup Test Saat Ini

Pengujian yang telah tersedia mencakup:

### Authentication

* Login

### Authorization

* Admin
* Tutor
* Siswa

### Business Process

* PPDB per Tahun Ajaran
* Penerima BOP
* Non BOP / Mandiri

### User Features

* Reset Password View
* Workflow Profil Filament

Coverage tersebut belum mencakup seluruh fitur aplikasi.

---

## 13. Keterbatasan Audit Dependency

Audit dependency tidak dapat mendeteksi:

* Kesalahan logika aplikasi
* Konfigurasi server yang tidak aman
* Kebocoran secret
* SQL Injection pada implementasi
* Cross Site Scripting (XSS)
* Kesalahan implementasi CSRF
* Kesalahan Authorization

Validasi terhadap aspek tersebut memerlukan pengujian tambahan maupun tools static analysis.

> **Status hijau hanya menunjukkan bahwa seluruh proses CI berhasil dilewati dan bukan merupakan sertifikasi keamanan aplikasi.**

---

## 14. Status Audit Dependency

Status audit dependency selalu mengikuti hasil workflow CI terbaru.

Pipeline secara otomatis menjalankan:

```bash
composer audit --locked --no-interaction

npm audit --audit-level=high
```

Oleh karena itu, log workflow terakhir menjadi sumber informasi utama terkait advisory dependency yang masih aktif.

---



### Quality Assurance

* Menambahkan Browser Smoke Test setelah UI stabil
* Mengunggah artifact log workflow
* Mengunggah screenshot workflow sebagai lampiran laporan PBL
