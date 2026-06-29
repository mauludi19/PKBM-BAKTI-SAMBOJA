# Dokumentasi Fitur Website PKBM Bakti Samboja

Website PKBM Bakti Samboja melayani tiga aktor utama: admin lembaga, tutor (tenaga pendidik), dan siswa. Akses panel dibatasi melalui role, status verifikasi pendaftaran, dan model policy.

## Landing Page

**Tujuan:** Menampilkan identitas lembaga, visi misi, konten berita terbaru, dan informasi umum mengenai program kesetaraan.

**Aktor:** Pengunjung umum / masyarakat.

**Alur:** Pengunjung membuka beranda, sistem mengambil data konten berita terbaru serta visi misi lembaga, lalu menampilkannya pada halaman utama.

**Route dan kode terkait:**

- `GET /`
- `HomeController`
- `resources/views/home.blade.php`

## Data Siswa per Kategori

**Tujuan:** Memudahkan publik untuk melihat transparansi daftar siswa aktif berdasarkan kelompok Paket Pendidikan.

**Aktor:** Pengunjung umum.

**Alur:** Pengunjung membuka halaman data siswa, sistem memfilter dan menampilkan daftar nama siswa berdasarkan kategori Paket A, Paket B, atau Paket C dengan pagination.

**Route dan kode terkait:**

- `GET /data-siswa`
- `StudentCatalog`
- `resources/views/livewire/student-catalog.blade.php`

Kategori Paket Pendidikan yang tersedia:
- **Paket A:** Setara Sekolah Dasar (SD).
- **Paket B:** Setara Sekolah Menengah Pertama (SMP).
- **Paket C:** Setara Sekolah Menengah Atas (SMA).

## Data Tutor

**Tujuan:** Menampilkan daftar tenaga pendidik aktif beserta kompetensi mata pelajaran yang diampu.

**Aktor:** Pengunjung umum.

**Alur:** Pengunjung membuka halaman profil pengajar, sistem melakukan kueri data dari repositori tutor, lalu menampilkan kartu informasi berisi nama, foto, dan bidang keahlian tutor.

**Route dan kode terkait:**

- `GET /tutor`
- `TutorController@index`
- `resources/views/tutors/index.blade.php`

## Detail Berita

**Tujuan:** Menampilkan isi lengkap dari berita atau artikel kegiatan yang dipublikasikan oleh PKBM.

**Aktor:** Pengunjung umum.

**Alur:** Pengunjung memilih salah satu judul berita di beranda, sistem melakukan route model binding menggunakan slug, lalu menampilkan halaman konten berita secara utuh.

**Route dan kode terkait:**

- `GET /berita/{post:slug}`
- `PostController@show`
- `resources/views/posts/show.blade.php`

## Login

**Tujuan:** Mengautentikasi tiga pilar pengguna (Admin, Tutor, dan Siswa) melalui satu gerbang halaman login.

**Aktor:** Admin, Tutor, dan Siswa aktif.

**Alur:** Pengguna memasukkan email/NISN/NIDN dan password, sistem memvalidasi status keaktifan akun, melakukan rate limiting, membuat session, lalu mengarahkan:

- role `admin` ke `/admin`;
- role `tutor` ke `/tutor`;
- role `siswa` ke `/siswa`.

**Route dan kode terkait:**

- `GET /login`
- `POST /login`
- `AuthenticatedSessionController`
- `LoginRequest`

## Pendaftaran Peserta Didik Baru (PPDB)

**Tujuan:** Memungkinkan calon siswa baru melakukan pendaftaran secara mandiri per tahun ajaran aktif.

**Aktor:** Calon siswa baru (pengunjung umum).

**Alur:** Pendaftar mengisi form identitas, memilih tahun ajaran, dan menentukan kategori jalur masuk. Data yang tersimpan akan berstatus `pending` sampai diverifikasi oleh admin.

**Route dan kode terkait:**

- `GET /ppdb/daftar`
- `POST /ppdb/daftar`
- `RegistrationController`
- `RegistrationRequest`

Kategori PPDB yang dikelompokkan:
- **Penerima BOP:** Jalur bantuan operasional pemerintah (wajib mengunggah berkas pendukung seperti KIP/SKTM).
- **Non BOP (Mandiri):** Jalur reguler dengan pembiayaan mandiri secara swadaya.

## Lupa Password

**Tujuan:** Mengirimkan tautan atur ulang kata sandi ke email pengguna yang terdaftar.

**Aktor:** Pengguna yang lupa kata sandi.

**Alur:** Pengguna menginput email, sistem memvalidasi kecocokan data, mengirimkan token reset melalui broker password Laravel, lalu menampilkan notifikasi pengiriman berhasil.

**Route dan kode terkait:**

- `GET|POST /forgot-password`
- `PasswordResetLinkController`

## Reset Password

**Tujuan:** Memperbarui kata sandi lama menggunakan token verifikasi email.

**Aktor:** Pengguna yang telah menerima tautan reset.

**Alur:** Pengguna membuka tautan, mengisi password baru pada form yang tersedia, sistem memvalidasi kecocokan, memperbarui field password di database, lalu mengarahkan kembali ke halaman login.

**Route dan kode terkait:**

- `GET /reset-password/{token}`
- `POST /reset-password`
- `NewPasswordController`

## Profil Pengguna pada Panel Filament

**Tujuan:** Menyediakan pengelolaan profil dan pembaruan kredensial keamanan secara mandiri di setiap panel khusus.

**Aktor:** Admin, Tutor, dan Siswa aktif.

**Alur:** Semua aktor menggunakan ekstensi halaman profil kustom. Penggantian kata sandi mewajibkan input sandi saat ini yang sah. 

**Batasan khusus aktor Siswa & Tutor:**
- Siswa dan Tutor hanya diberikan izin mandiri untuk mengubah kata sandi.
- Data master identitas (Nama, NISN, NIDN, Kelas Paket) dikunci (*read-only*) dan hanya dapat diubah melalui intervensi Admin.

**Kode terkait:**
- `app/Filament/Pages/Auth/CustomEditProfile.php`
- `AdminPanelProvider`
- `TutorPanelProvider`
- `StudentPanelProvider`

## Panel Admin

**Tujuan:** Menjadi pusat kendali operasional, manajemen akademik, dan pengelolaan konten website.

**Aktor:** Admin aktif.

**Path:** `/admin`

### CRUD Konten & Berita
Mengelola publikasi berita, pengumuman, agenda, serta pembaruan teks Visi dan Misi lembaga.
- Resource: `PostResource`
- Path: `/admin/posts`

### CRUD Data Siswa
Mengonfirmasi akun siswa, mengelompokkan siswa ke dalam kategori Paket A, B, atau C, serta manajemen mutasi kelas.
- Resource: `StudentResource`
- Path: `/admin/students`

### CRUD Data Tutor
Mengelola data induk tenaga pendidik, riwayat mengajar, dan mata pelajaran yang diampu.
- Resource: `TutorResource`
- Path: `/admin/tutors`

### CRUD Verifikasi PPDB
Melakukan validasi berkas pendaftaran masuk calon siswa baru dan memisahkan kuota laporan antara jalur Penerima BOP dan Non BOP (Mandiri) per Tahun Ajaran.
- Resource: `RegistrationVerificationResource`
- Path: `/admin/verifikasi-ppdb`

---

## Panel Tutor

**Tujuan:** Menyediakan fasilitas bagi tenaga pendidik untuk mengelola evaluasi belajar.

**Aktor:** Tutor aktif.

**Path:** `/tutor`

### Modul Input Nilai Siswa
Tutor dapat memilih kelas Paket, mata pelajaran yang diampu, dan menginput nilai capaian belajar siswa berdasarkan Tahun Ajaran berjalan.
- Resource: `AcademicScoreResource`
- Path: `/tutor/academic-scores`

Tutor tidak dapat melihat data keuangan atau memanipulasi akun sistem milik tutor lainnya.

---

## Panel Siswa

**Tujuan:** Menjadi area layanan informasi akademik personal siswa.

**Aktor:** Siswa aktif yang telah terverifikasi.

**Path:** `/siswa`

Panel siswa menyediakan fungsionalitas:
- Mengakses dan melihat **Nilai Siswa** (Raport digital) secara privat melalui resource `MyScoreResource` pada path `/siswa/my-scores`.
- Mengunduh rekap nilai transkrip dalam format dokumen digital.

Siswa tidak memiliki otorisasi untuk membuat, mengubah, atau menghapus komponen nilai yang tertera. Seluruh data yang tersaji bersifat *read-only* sesuai dengan ID siswa yang sedang login.

---

## Authorization dan Policy

Model `User` menerapkan implementasi `FilamentUser::canAccessPanel()`:
- Admin diizinkan penuh hanya untuk mengakses panel `admin`.
- Tutor diizinkan khusus hanya untuk mengakses panel `tutor`.
- Siswa diizinkan khusus hanya untuk mengakses panel `siswa`.
- Akses ke panel akan ditolak secara otomatis oleh sistem apabila status akun pendaftaran belum diverifikasi oleh admin (status masih `pending`).

Policy pengamanan models tersedia untuk:
- Post (Berita)
- Student (Siswa)
- Tutor
- AcademicScore (Nilai)
- Registration (PPDB)
