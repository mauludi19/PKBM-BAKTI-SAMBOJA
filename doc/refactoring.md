# Dokumentasi Refactoring

Dokumen ini mencatat perubahan struktur yang meningkatkan konsistensi dan kemudahan pemeliharaan tanpa mengubah tujuan utama aplikasi Website PKBM Bakti Samboja.

## Standardisasi Model, Factory, dan Seeder

**Sebelum**

- Nama kolom identitas pengguna tidak konsisten antara `nis`, `nisn`, `nidn`, `is_verified`, dan `account_status`.
- Role menggunakan campuran nilai `peserta_didik`, `pengajar`, dan `user`.
- Factory dan seeder dapat menulis kolom yang tidak tersedia pada database.

**Masalah**

Seeder gagal dan logika autentikasi serta verifikasi tidak memiliki satu kontrak data yang jelas.

**Perubahan**

- Kolom identitas distandardisasi menjadi `nisn` untuk siswa dan `nidn` untuk tutor.
- Role distandardisasi menjadi `admin`, `tutor`, dan `siswa`.
- Status persetujuan akun menggunakan `account_status` (termasuk status pendaftaran PPDB `pending`).
- Model, factory, seeder, route, dan view diselaraskan.

**Alasan**

Satu vocabulary domain mengurangi bug schema dan mempermudah validasi alur akademik kesetaraan.

**Dampak**

Seeder, autentikasi, dan akses panel memakai kontrak akun yang sama.

**Bukti commit:** `2d744a4 . f883c76`.

## Pemisahan Authorization ke Model Policy

**Sebelum**

Pembatasan aksi resource bergantung pada akses panel dan berpotensi tersebar di komponen UI.

**Masalah**

Menyembunyikan tombol tidak cukup untuk melindungi operasi backend (seperti manipulasi nilai oleh siswa).

**Perubahan**

Ditambahkan policy untuk Post, Student, Tutor, AcademicScore, dan Registration.

**Alasan**

Authorization harus berada pada lapisan domain Laravel dan dapat digunakan kembali oleh Filament maupun controller publik.

**Dampak**

Admin dan Tutor aktif mendapatkan aksi yang sesuai, sementara siswa atau akun pendaftaran yang belum disetujui (`pending`) ditolak. Admin juga tidak dapat menghapus akunnya sendiri melalui `UserPolicy`.

**Bukti commit:** `c70658e`.

## Penggantian Konsep Pendaftaran ke PPDB

**Sebelum**

Aplikasi memiliki resource dan controller `Pendaftaran` yang terpisah dari model transaksi induk `Registration`.

**Masalah**

Dua istilah untuk proses yang sama menimbulkan duplikasi dan kebingungan klasifikasi antara Penerima BOP dan Non BOP (Mandiri).

**Perubahan**

CRUD `Pendaftaran` lama dihapus. Proses seleksi dipusatkan pada `Registration` yang diarsipkan per Tahun Ajaran berjalan.

**Alasan**

Struktur data pendaftaran menjadi lebih jelas: satu entitas registrasi wajib mencantumkan kategori pembiayaan yang tegas.

**Dampak**

Resource pendaftaran baru lebih konsisten dengan schema database dan relasi laporan bantuan operasional.

**Bukti commit:** `c70658e`.

## Pemisahan Panel Admin, Tutor, dan Siswa

**Sebelum**

Semua kebutuhan Filament diarahkan ke satu panel admin.

**Masalah**

Admin, Tutor, dan Siswa memiliki kebutuhan navigasi serta hak akses operasional yang jauh berbeda.

**Perubahan**

- `AdminPanelProvider` melayani `/admin`.
- `TutorPanelProvider` melayani `/tutor`.
- `StudentPanelProvider` melayani `/siswa`.
- `User::canAccessPanel()` membatasi panel berdasarkan role masing-masing dan status akun.
- Controller login mengarahkan role ke dashboard yang sesuai.

**Alasan**

Pemisahan panel mengurangi risiko modul admin dan form penginputan nilai terlihat oleh pengguna yang tidak berwenang.

**Dampak**

Struktur sekarang mendukung resource khusus aktor tanpa mencampur CRUD operasional admin. Saat ini panel siswa sudah memiliki resource `Nilai Saya` yang bersifat read-only.

**Bukti commit:** `c70658e`.

## Penggunaan Form dan Table Class pada Resource Filament

**Sebelum**

Schema form dan konfigurasi tabel akademik berpotensi menumpuk di kelas resource Filament.

**Masalah**

Resource menjadi sangat panjang dan sulit dipindai saat menangani banyak field data personal siswa.

**Perubahan**

Setiap resource memisahkan:

- `*Resource.php` untuk metadata dan routing;
- `Schemas/*Form.php` untuk field form;
- `Tables/*Table.php` untuk kolom, filter, dan action;
- `Pages/` untuk halaman list, create, dan edit.

**Alasan**

Setiap kelas memiliki satu tanggung jawab yang lebih jelas sesuai prinsip pembagian modul.

**Dampak**

CRUD akademik lebih mudah dikembangkan dan diuji secara terpisah.

## Pengelompokan Navigasi dan SPA Filament

**Sebelum**

Resource tampil tanpa pengelompokan domain yang konsisten pada sidebar.

**Masalah**

Navigasi panel sulit dipindai ketika jumlah CRUD penginputan data paket pendidikan bertambah.

**Perubahan**

- Resource berita dikelompokkan pada `Manajemen Konten`.
- Data akademik dan PPDB dikelompokkan pada `Administrasi Sekolah`.
- Mode SPA (Single Page Application) Filament diaktifkan pada seluruh panel.

**Alasan**

Navigasi menu perlu mengikuti aktivitas alur kerja harian pengelola lembaga.

**Dampak**

Menu lebih terstruktur dan perpindahan halaman panel terasa lebih cepat.

**Bukti commit:** `60531bd`.

## Pengalihan Otomatis Setelah Pembuatan Data di Filament

**Sebelum**

Setelah admin atau tutor membuat data baru di form Create, sistem tetap menahan user di halaman form kosong.

**Masalah**

Alur kerja kurang efisien karena admin sering kali ingin langsung melihat data siswa atau nilai yang baru dibuat di tabel utama.

**Perubahan**

Disesuaikan agar setelah pembuatan data, sistem otomatis mengarahkan (redirect) ke halaman index (tabel data).

**Alasan**

Meningkatkan efisiensi navigasi bagi pengguna admin dan tutor.

**Dampak**

Pengalaman pengguna yang lebih mulus dan cepat pada seluruh CRUD di panel.

**Bukti commit:** `83f16df`.

## Perubahan Tipe Kolom registration_date

**Sebelum**

Kolom `registration_date` pada tabel `registrations` bertipe `date`.

**Masalah**

Waktu pendaftaran masuk calon peserta didik baru yang presisi (termasuk jam dan menit) tidak dapat dicatat untuk kebutuhan verifikasi kuota BOP.

**Perubahan**

Tipe kolom `registration_date` diubah dari `date` menjadi `datetime` melalui migrasi `2026_06_27_040243`.

**Alasan**

Mendukung pencatatan waktu kirim formulir pendaftaran PPDB yang lebih akurat.

**Dampak**

Seluruh query dan form yang menampilkan data pendaftaran kini menyertakan informasi jam dan menit.

**Bukti commit:** migrasi `2026_06_27_040243_alter_registration_date_column_on_registrations_table`.

## Identifikasi Dead Code

**Temuan**

Dua resource controller ditemukan dalam kondisi tidak aktif:

- `app/Http/Controllers/ScoreReportController.php` — seluruh method kosong, tidak terdaftar di route manapun.
- `app/Http/Controllers/OldStudentController.php` — seluruh method kosong, mereferensi model siswa lama yang sudah didepresiasi dari basis kode.

**Masalah**

File tanpa fungsi menambah beban maintenance dan membingungkan tim pengembang baru.

**Rekomendasi**

Kedua controller dapat dihapus pada refactoring berikutnya setelah dipastikan tidak ada dependensi dari komponen lain.

## Rencana Refactoring Berikutnya

- Memberi return type pada seluruh method controller dan komponen Livewire.
- Menambahkan service khusus untuk enkripsi dan penanganan dokumen pendukung jalur PPDB BOP (seperti KIP/SKTM).
- Menambah cakupan automated test untuk authorization tiga panel, autentikasi multi-role, dan penguncian nilai.
- Meninjau dependency paket PDF pihak ketiga apabila modul cetak raport digital belum diimplementasikan.
