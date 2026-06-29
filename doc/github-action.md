# Laporan Praktikum & Dokumentasi Sistem Website PKBM Bakti Samboja

**MATA KULIAH:** Komunikasi Bisnis & Manajemen Proyek TRPL  
**TAHUN AJARAN:** 2026/2027  
**PROGRAM STUDI:** D4 - Teknologi Rekayasa Perangkat Lunak (TRPL)  
**MAHASISWA:** Mauludi  

---

## BAGIAN 1: OUTPUT PRAKTIKUM (PERTEMUAN 1 - 3)

### PERTEMUAN 1: Simulasi Komunikasi Profesional (Skrip Lisan Perkenalan)
* **Peran:** Backend Developer & Project Manager
* **Audiens:** Jajaran Pengelola/Manajemen PKBM Bakti Samboja
* **Karakteristik:** Menggunakan bahasa formal, berorientasi tujuan, dan mengedepankan prinsip 5C (*Clarity, Conciseness, Completeness, Courtesy, Correctness*).

#### Skrip Perkenalan Resmi:
> "Selamat pagi Bapak/Ibu Pengelola PKBM Bakti Samboja dan rekan-rekan tim pengembang semua. Perkenalkan, nama saya **Mauludi**, mahasiswa Teknologi Rekayasa Perangkat Lunak yang dalam proyek ini bertindak sebagai *Backend Developer* sekaligus penanggung jawab integrasi sistem.
>
> Saya memiliki fokus keahlian dalam pengembangan arsitektur basis data dan manajemen hak akses pengguna (*Multi-User Role-Based Access Control*). Pada proyek Website PKBM Bakti Samboja ini, saya bertanggung jawab penuh untuk merancang arsitektur keamanan database yang memisahkan fungsionalitas tiga pilar login, yaitu untuk Admin, Tutor, dan Siswa.
> 
> Saya juga akan memastikan bahwa sistem penginputan nilai oleh tutor dapat tersinkronisasi secara instan dan aman agar bisa langsung diakses oleh siswa secara *real-time* setelah mereka berhasil login ke dashboard masing-masing.
>
> Saya memiliki perhatian khusus pada efisiensi kueri data. Mengingat data siswa akan dikelompokkan secara dinamis per kategori Paket A, Paket B, dan Paket C untuk konsumsi publik, saya akan mengoptimalkan performa server agar halaman publik tersebut tetap ringan, responsif, dan bebas kendala saat diakses oleh masyarakat umum. Saya berharap dapat berkontribusi secara optimal dan berkolaborasi aktif dengan pihak PKBM Bakti Samboja guna mewujudkan website yang informatif, transparan, dan akuntabel. Terima kasih atas kesempatan yang diberikan."

---

### PERTEMUAN 2: Penyampaian Instruksi Proyek (Briefing Tim Internal)
* **Peran:** Project Manager / Lead Developer (Mauludi)
* **Forum:** Rapat Koordinasi Internal / Sprint Planning
* **Metode:** Komunikasi SMART (*Specific, Measurable, Achievable, Relevant, Time-bound*)

#### Skrip Instruksi Kerja:
> "Selamat pagi rekan-rekan pengembang. Pada sprint pertama minggu ini, kita akan berfokus penuh pada dua modul krusial Website PKBM Bakti Samboja, yaitu **Sistem Otentikasi Multi-user** dan **Modul PPDB (Pendaftaran Peserta Didik Baru) per Tahun Ajaran**.
>
> Untuk memastikan pembagian tugas berjalan spesifik dan efektif, berikut koordinasi kerjanya:
> 1. **Tim UI/UX:** Saya instruksikan untuk membuat mockup halaman landing page yang memuat konten publik (Berita, Visi-Misi, profil data Tutor, dan data siswa per paket pendidikan A, B, C). Pastikan navigasinya intuitif bagi masyarakat umum.
> 2. **Tim Backend (Saya/Mauludi):** Saya bertanggung jawab membangun struktur tabel basis data untuk skema pendaftaran PPDB. Form pendaftaran harus dikategorikan secara tegas menjadi dua jalur: Penerima BOP (wajib menyediakan field unggahan dokumen KIP/SKTM) dan Non-BOP/Mandiri.
> 3. **Tim Frontend:** Setelah API siap, lakukan integrasi halaman login untuk Admin, Tutor, dan Siswa menggunakan enkripsi token keamanan (JWT) agar hak akses tidak tumpang tindih.
>
> Semua fungsionalitas sistem login multi-user dan database PPDB terstruktur ini harus sudah masuk ke tahap pengujian lingkungan *staging* dalam waktu **7 hari kerja** dari sekarang, dengan target demo internal pada hari ke-6.
>
> Instruksi ini sangat penting agar manajemen BOP pemerintah dan transparansi publik PKBM dapat berjalan akurat. Apakah ada kendala atau hal teknis yang perlu diklarifikasi (*repeat-back*) sebelum kita mulai pengerjaan kode? Jika cukup jelas, mari kita mulai sprint minggu ini."

---

### PERTEMUAN 3: Penulisan Email Bisnis (Dokumentasi Koordinasi Formal)

**Subject:** Permohonan Klarifikasi Alur Input Nilai Akademik - Proyek Website PKBM Bakti Samboja

Yth. Bapak/Ibu Manajemen PKBM Bakti Samboja,

Sehubungan dengan pengerjaan modul akademik pada proyek website PKBM Bakti Samboja yang saat ini memasuki tahap perancangan basis data, kami memerlukan beberapa informasi tambahan guna memastikan kesesuaian sistem dengan regulasi internal lembaga.

Melalui email ini, kami ingin memohon klarifikasi terkait teknis penginputan **Nilai Siswa** oleh komponen Tutor:
1. Apakah struktur komponen nilai yang diinput oleh Tutor cukup berupa rekap nilai akhir per mata pelajaran, atau harus dipecah kembali menjadi komponen nilai tugas, UTS, dan UAS?
2. Terkait hak akses login siswa, apakah siswa diperkenankan untuk mengunduh raport dalam bentuk format dokumen PDF secara mandiri, atau sistem cukup menampilkan transkrip nilai pada halaman *dashboard* saja?

Kami mengharapkan konfirmasi dan arahan dari Bapak/Ibu agar tim pengembang dapat menyusun struktur tabel *database* nilai ini dengan akurat tanpa menghambat lini masa pengembangan yang telah disepakati bersama.

Terima kasih atas perhatian, arahan, dan kerja samanya yang baik.

Hormat kami,

**Mauludi**  
*Project Manager & Backend Developer*  
Tim Pengembang Sistem PKBM Bakti Samboja  
Email: mauludi@trpl-project.id  

---

## BAGIAN 2: DOKUMENTASI FITUR & ALUR SISTEM

Website PKBM Bakti Samboja melayani tiga aktor utama: admin lembaga, tutor (tenaga pendidik), dan siswa. Akses panel dibatasi melalui role, status verifikasi pendaftaran, dan model policy.

### Landing Page
* **Tujuan:** Menampilkan identitas lembaga, visi misi, konten berita terbaru, dan informasi umum mengenai program kesetaraan.
* **Aktor:** Pengunjung umum / masyarakat.
* **Alur:** Pengunjung membuka beranda, sistem mengambil data konten berita terbaru serta visi misi lembaga, lalu menampilkannya pada halaman utama.
* **Route dan kode terkait:**
  * `GET /`
  * `HomeController`
  * `resources/views/welcome.blade.php`

### Data Siswa per Kategori
* **Tujuan:** Memudahkan publik untuk melihat transparansi daftar siswa aktif berdasarkan kelompok Paket Pendidikan.
* **Aktor:** Pengunjung umum.
* **Alur:** Pengunjung membuka halaman data siswa, sistem memfilter dan menampilkan daftar nama siswa berdasarkan kategori Paket A, Paket B, atau Paket C dengan pagination.
* **Route dan kode terkait:**
  * `GET /data-siswa`
  * `StudentCatalog`
  * `resources/views/livewire/student-catalog.blade.php`
* **Kategori Paket Pendidikan yang tersedia:**
  * **Paket A:** Setara Sekolah Dasar (SD).
  * **Paket B:** Setara Sekolah Menengah Pertama (SMP).
  * **Paket C:** Setara Sekolah Menengah Atas (SMA).

### Data Tutor
* **Tujuan:** Menampilkan daftar tenaga pendidik aktif beserta kompetensi mata pelajaran yang diampu.
* **Aktor:** Pengunjung umum.
* **Alur:** Pengunjung membuka halaman profil pengajar, sistem melakukan kueri data dari repositori tutor, lalu menampilkan kartu informasi berisi nama, foto, dan bidang keahlian tutor.
* **Route dan kode terkait:**
  * `GET /tutor`
  * `TutorController@index`
  * `resources/views/tutors/index.blade.php`

### Detail Berita
* **Tujuan:** Menampilkan isi lengkap dari berita atau artikel kegiatan yang dipublikasikan oleh PKBM.
* **Aktor:** Pengunjung umum.
* **Alur:** Pengunjung memilih salah satu judul berita di beranda, sistem melakukan route model binding menggunakan slug, lalu menampilkan halaman konten berita secara utuh.
* **Route dan kode terkait:**
  * `GET /berita/{post:slug}`
  * `PostController@show`
  * `resources/views/posts/show.blade.php`

### Login
* **Tujuan:** Mengautentikasi tiga pilar pengguna (Admin, Tutor, dan Siswa) melalui satu gerbang halaman login.
* **Aktor:** Admin, Tutor, dan Siswa aktif.
* **Alur:** Pengguna memasukkan email/NISN/NIDN dan password, sistem memvalidasi status keaktifan akun, melakukan rate limiting, membuat session, lalu mengarahkan:
  * role `admin` ke `/admin`;
  * role `tutor` ke `/tutor`;
  * role `siswa` ke `/siswa`.
* **Route dan kode terkait:**
  * `GET /login`
  * `POST /login`
  * `AuthenticatedSessionController`
  * `LoginRequest`

### Pendaftaran Peserta Didik Baru (PPDB)
* **Tujuan:** Memungkinkan calon siswa baru melakukan pendaftaran secara mandiri per tahun ajaran aktif.
* **Aktor:** Calon siswa baru (pengunjung umum).
* **Alur:** Pendaftar mengisi form identitas, memilih tahun ajaran, dan menentukan kategori jalur masuk. Data yang tersimpan akan berstatus `pending` sampai diverifikasi oleh admin.
* **Route dan kode terkait:**
  * `GET /ppdb/daftar`
  * `POST /ppdb/daftar`
  * `RegistrationController`
  * `RegistrationRequest`
* **Kategori PPDB yang dikelompokkan:**
  * **Penerima BOP:** Jalur bantuan operasional pemerintah (wajib mengunggah berkas pendukung seperti KIP/SKTM).
  * **Non BOP (Mandiri):** Jalur reguler dengan pembiayaan mandiri secara swadaya.

### Lupa Password & Reset Password
* **Tujuan:** Mengamankan pemulihan akun melalui token verifikasi email.
* **Aktor:** Pengguna yang lupa kata sandi.
* **Alur:** Pengguna meminta tautan reset melalui email. Setelah tautan dibuka, pengguna memasukkan password baru yang valid, sistem memperbarui database, dan mengarahkan kembali ke login.
* **Route dan kode terkait:**
  * `GET|POST /forgot-password`
  * `GET /reset-password/{token}`
  * `POST /reset-password`
  * `PasswordResetLinkController`
  * `NewPasswordController`

### Profil Pengguna pada Panel Filament
* **Tujuan:** Menyediakan pengelolaan profil dan pembaruan kredensial keamanan secara mandiri di setiap panel khusus.
* **Aktor:** Admin, Tutor, dan Siswa aktif.
* **Batasan khusus aktor Siswa & Tutor:**
  * Siswa dan Tutor hanya diberikan izin mandiri untuk mengubah kata sandi.
  * Data master identitas (Nama, NISN, NIDN, Kelas Paket) dikunci (*read-only*) dan hanya dapat diubah melalui intervensi Admin.
* **Kode terkait:**
  * `app/Filament/Pages/Auth/CustomEditProfile.php`
  * `AdminPanelProvider`
  * `TutorPanelProvider`
  * `StudentPanelProvider`

### Manajemen Panel (Filament Dashboard)

#### 1. Panel Admin (`/admin`)
Pusat kendali operasional, akademik, dan konten website.
* **CRUD Konten & Berita:** Mengelola berita, pengumuman, serta pembaruan teks Visi Misi lembaga (`PostResource` -> `/admin/posts`).
* **CRUD Data Siswa:** Verifikasi akun siswa, pengelompokan Paket A, B, atau C (`StudentResource` -> `/admin/students`).
* **CRUD Data Tutor:** Mengelola data induk tenaga pendidik dan mapel yang diampu (`TutorResource` -> `/admin/tutors`).
* **CRUD Verifikasi PPDB:** Validasi berkas masuk calon siswa baru jalur BOP dan Mandiri per Tahun Ajaran (`RegistrationVerificationResource` -> `/admin/verifikasi-ppdb`).

#### 2. Panel Tutor (`/tutor`)
Fasilitas bagi pengajar untuk memasukkan evaluasi belajar siswa.
* **Modul Input Nilai Siswa:** Menginput nilai capaian belajar siswa berdasarkan mata pelajaran dan Tahun Ajaran berjalan (`AcademicScoreResource` -> `/tutor/academic-scores`). Tutor tidak dapat melihat atau memanipulasi data panel admin.

#### 3. Panel Siswa (`/siswa`)
Area layanan informasi akademik personal siswa secara privat.
* **Modul Nilai Siswa:** Mengakses dan mengunduh transkrip/raport digital secara mandiri (`MyScoreResource` -> `/siswa/my-scores`). Seluruh data bersifat *read-only* sesuai ID siswa yang sedang login.

### Authorization dan Policy
Model `User` menerapkan implementasi `FilamentUser::canAccessPanel()`:
* Admin diizinkan penuh hanya untuk mengakses panel `admin`.
* Tutor diizinkan khusus hanya untuk mengakses panel `tutor`.
* Siswa diizinkan khusus hanya untuk mengakses panel `siswa`.
* Akses ke panel akan ditolak secara otomatis oleh sistem apabila status akun pendaftaran belum diverifikasi oleh admin (status masih `pending`).

---

## BAGIAN 3: DOKUMENTASI GITHUB ACTIONS (CI)

### Workflow yang Digunakan
Sistem menggunakan workflow Continuous Integration (CI) untuk memverifikasi dependency, menyiapkan database, membangun aset frontend, dan menjalankan test secara otomatis guna memastikan stabilitas sistem multi-role sebelum masuk ke tahap production.

### Lokasi File
```text
.github/workflows/ci.yml
