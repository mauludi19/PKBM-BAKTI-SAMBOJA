<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form PPDB - PKBM Bakti Samboja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    @php
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Facades\Schema;

        $packages = Schema::hasTable('packages') ? DB::table('packages')->get() : collect();
        $academicYears = Schema::hasTable('academic_years') ? DB::table('academic_years')->get() : collect();
    @endphp

    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold text-green-800">PKBM Bakti Samboja</h1>
        <a href="/" class="text-green-700 font-semibold">Kembali ke Home</a>
    </nav>

    <main class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">
        <h2 class="text-3xl font-bold mb-2">Form Pendaftaran Siswa Baru</h2>
        <p class="text-gray-600 mb-8">Lengkapi data berikut untuk mendaftar ke PKBM Bakti Samboja.</p>

        <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf

            <div>
                <label class="font-semibold">Nama Lengkap</label>
                <input type="text" name="full_name" class="w-full border rounded-lg p-3 mt-1" placeholder="Masukkan nama lengkap">
            </div>

            <div>
                <label class="font-semibold">NIK</label>
                <input type="text" name="nik" class="w-full border rounded-lg p-3 mt-1" placeholder="Masukkan NIK">
            </div>

            <div>
                <label class="font-semibold">NISN</label>
                <input type="text" name="nisn" class="w-full border rounded-lg p-3 mt-1" placeholder="Masukkan NISN">
            </div>

            <div>
                <label class="font-semibold">Jenis Kelamin</label>
                <select name="gender" class="w-full border rounded-lg p-3 mt-1">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Tempat Lahir</label>
                <input type="text" name="birth_place" class="w-full border rounded-lg p-3 mt-1" placeholder="Contoh: Solok">
            </div>

            <div>
                <label class="font-semibold">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="w-full border rounded-lg p-3 mt-1">
            </div>

            <div>
                <label class="font-semibold">Nomor HP</label>
                <input type="text" name="phone" class="w-full border rounded-lg p-3 mt-1" placeholder="+62...">
            </div>

            <div>
                <label class="font-semibold">Nama Orang Tua</label>
                <input type="text" name="parent_name" class="w-full border rounded-lg p-3 mt-1" placeholder="Nama orang tua/wali">
            </div>

            <div>
                <label class="font-semibold">Program Paket</label>
                <select name="package_id" class="w-full border rounded-lg p-3 mt-1">
                    <option value="">Pilih Paket</option>
                    @forelse ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @empty
                        <option>Paket A</option>
                        <option>Paket B</option>
                        <option>Paket C</option>
                    @endforelse
                </select>
            </div>

            <div>
                <label class="font-semibold">Tahun Ajaran</label>
                <select name="academic_year_id" class="w-full border rounded-lg p-3 mt-1">
                    <option value="">Pilih Tahun Ajaran</option>
                    @forelse ($academicYears as $year)
                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                    @empty
                        <option>2026/2027</option>
                    @endforelse
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="font-semibold">Alamat</label>
                <textarea name="address" rows="3" class="w-full border rounded-lg p-3 mt-1" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="font-semibold">Asal Sekolah</label>
                <input type="text" name="previous_school" class="w-full border rounded-lg p-3 mt-1" placeholder="Masukkan asal sekolah terakhir">
            </div>

            <div class="md:col-span-2 flex justify-end gap-3 mt-6">
                <a href="/" class="px-6 py-3 border rounded-lg">Batal</a>
                <button type="submit" class="px-6 py-3 bg-green-800 text-white rounded-lg font-bold">
                    Submit Pendaftaran
                </button>
            </div>
        </form>
    </main>

</body>
</html>
