# Dokumentasi GitHub Actions

## Workflow yang Digunakan

GitHub Actions merupakan layanan otomatisasi yang digunakan untuk menjalankan proses pengujian, validasi, dan integrasi kode secara otomatis sebelum perubahan kode digabungkan (merge) ke branch utama (main/master). PKBM Bakti Samboja menggunakan workflow Continuous Integration (CI) untuk memverifikasi dependency, menyiapkan database, membangun aset frontend, dan menjalankan test secara otomatis.

## Lokasi File

```text
.github/workflows/ci.yml

```

# GitHub Actions - Continuous Integration (CI)

## Trigger Workflow

Workflow akan berjalan pada kondisi berikut:

- Push ke semua branch
- Pull Request menuju branch `main`
- Dijalankan secara manual melalui `workflow_dispatch`

---

# Environment

| Komponen | Konfigurasi |
|----------|-------------|
| Runner | Ubuntu Latest |
| PHP | 8.4 |
| Node.js | 22 |
| Database Test | SQLite (temporary database pada GitHub Runner) |
| Dependency PHP | Composer (`composer.lock`) |
| Dependency Frontend | npm (`package-lock.json`) |

---

# Tahapan Workflow

Workflow menjalankan tahapan berikut secara berurutan:

1. Checkout source code
2. Setup PHP beserta extension yang diperlukan
3. Setup Node.js
4. Validasi konfigurasi Composer
5. Install dependency Composer berdasarkan `composer.lock`
6. Audit kerentanan dependency PHP
7. Install dependency npm berdasarkan `package-lock.json`
8. Audit kerentanan dependency frontend (High/Critical)
9. Membuat file `.env`
10. Generate Laravel Application Key
11. Membuat database SQLite
12. Menjalankan migration
13. Build asset menggunakan Vite
14. Memastikan cache production Laravel dapat dibuat:
    - Config Cache
    - Event Cache
    - Route Cache
    - View Cache
15. Menjalankan seluruh test menggunakan Pest

---

# Perintah Verifikasi

```bash
composer validate --no-check-publish

composer audit --locked --no-interaction

npm audit --audit-level=high

npm run build

php artisan optimize

vendor/bin/pest --ci
```

---

# Hasil Workflow

Status workflow dapat dilihat pada tab **Actions** repository.

https://github.com/mauludi/pkbm-samboja/actions

---

# Badge CI

Tambahkan badge berikut pada README.

```html
<a href="https://github.com/mauludi/pkbm-samboja/actions/workflows/ci.yml">
    <img src="https://github.com/mauludi/pkbm-samboja/actions/workflows/ci.yml/badge.svg" alt="CI">
</a>
```

---

# Screenshot Workflow

Setelah workflow pertama berhasil dijalankan, tambahkan screenshot pada lokasi berikut.

```
docs/images/github-actions-success.png
```

---

# Interpretasi Hasil

| Status | Arti |
|--------|------|
| 🟢 Hijau | Seluruh tahapan berhasil dijalankan dan perubahan siap untuk direview. |
| 🔴 Merah | Terdapat tahapan yang gagal. Buka job pertama yang error untuk mengetahui penyebabnya. |
| 🟡 Queued | Workflow masih menunggu runner atau sedang diproses GitHub Actions. |

---

# Batas Jaminan CI

Pipeline CI ini memastikan bahwa pada environment:

- Ubuntu Latest
- PHP 8.4
- Node.js 22
- SQLite

hal-hal berikut berhasil dilakukan:

- Dependency berhasil dipasang dari lockfile.
- Migration database berhasil dijalankan.
- Asset frontend berhasil dibangun.
- Cache production Laravel berhasil dibuat.
- Dependency tidak memiliki advisory yang menyebabkan workflow gagal berdasarkan:
  - Composer Audit
  - npm Audit
- Seluruh test Pest berhasil dijalankan.

Namun CI **tidak menjamin** bahwa seluruh fitur aplikasi telah berjalan sempurna ataupun aplikasi sepenuhnya aman.

Saat ini test yang tersedia telah mencakup:

- Login
- Pemisahan Role:
  - Admin
  - Tutor
  - Siswa
- PPDB per Tahun Ajaran
- Penerima BOP
- Non BOP / Mandiri
- Reset Password View
- Workflow Profil Filament

Coverage pengujian tersebut masih belum mencakup seluruh fitur aplikasi.

Selain itu, audit dependency **tidak dapat mendeteksi**:

- Kesalahan logika aplikasi
- Konfigurasi server
- Kebocoran Secret
- SQL Injection pada implementasi
- Cross Site Scripting (XSS)
- Kesalahan implementasi CSRF
- Masalah Authorization

Pengujian tersebut memerlukan test tambahan maupun tools static analysis.

> **Status hijau hanya menunjukkan bahwa seluruh pemeriksaan CI berhasil dilewati, bukan merupakan sertifikasi keamanan aplikasi.**

---

# Status Audit

Status audit dependency selalu mengikuti hasil workflow CI terbaru.

Karena pipeline menjalankan:

```bash
composer audit --locked --no-interaction

npm audit --audit-level=high
```

maka log workflow terakhir merupakan sumber informasi utama mengenai advisory dependency yang masih aktif.

---

# Pengembangan Selanjutnya

Beberapa pengembangan yang direkomendasikan:

- Menambahkan Feature Test autentikasi dan redirect untuk:
  - Admin
  - Tutor
  - Siswa
- Menambahkan Policy Test pada setiap Resource
- Menambahkan CRUD Test terutama fitur Input Nilai Siswa oleh Tutor
- Menambahkan Browser Smoke Test ketika UI telah stabil
- Menambahkan Static Analysis
- Menambahkan Secret Scanning
- Mengunggah Artifact log maupun Screenshot workflow sebagai lampiran laporan PBL
