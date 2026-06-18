@extends('layouts.public')

@section('title', 'Form PPDB')

@section('content')
    <section class="bg-gray-50 px-6 py-12 sm:px-10">
        <div class="mx-auto max-w-5xl">
            <div class="mb-8">
                <h2 class="text-3xl font-bold">Form Pendaftaran Siswa Baru</h2>
                <p class="mt-2 text-gray-600">Lengkapi data berikut untuk mendaftar ke PKBM Bakti Samboja.</p>
            </div>

            @if (! $activeAcademicYear)
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-5 text-yellow-900">
                    Tahun ajaran aktif belum ditentukan. Silakan hubungi admin sebelum melakukan pendaftaran.
                </div>
            @else
                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
                        <p class="font-semibold">Periksa kembali data pendaftaran.</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                    @csrf
                    <input type="hidden" name="academic_year_id" value="{{ $activeAcademicYear->id }}">

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold">Tahun Ajaran</label>
                            <input type="text" value="{{ $activeAcademicYear->year }}" class="mt-1 w-full rounded-md border-gray-300 bg-gray-100" disabled>
                        </div>

                        <div>
                            <label for="package_id" class="block text-sm font-semibold">Program Paket</label>
                            <select id="package_id" name="package_id" class="mt-1 w-full rounded-md border-gray-300" required>
                                <option value="">Pilih Paket</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="registration_type" class="block text-sm font-semibold">Jenis Pendaftaran</label>
                            <select id="registration_type" name="registration_type" class="mt-1 w-full rounded-md border-gray-300" required>
                                <option value="BOP" @selected(old('registration_type') === 'BOP')>BOP</option>
                                <option value="mandiri" @selected(old('registration_type') === 'mandiri')>Mandiri</option>
                            </select>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="full_name" class="block text-sm font-semibold">Nama Lengkap</label>
                            <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="nik" class="block text-sm font-semibold">NIK</label>
                            <input id="nik" type="text" name="nik" value="{{ old('nik') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="birth_place" class="block text-sm font-semibold">Tempat Lahir</label>
                            <input id="birth_place" type="text" name="birth_place" value="{{ old('birth_place') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-semibold">Tanggal Lahir</label>
                            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-semibold">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="mt-1 w-full rounded-md border-gray-300" required>
                                <option value="L" @selected(old('gender') === 'L')>Laki-laki</option>
                                <option value="P" @selected(old('gender') === 'P')>Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label for="last_education" class="block text-sm font-semibold">Pendidikan Terakhir</label>
                            <input id="last_education" type="text" name="last_education" value="{{ old('last_education') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold">Nomor HP</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="father_name" class="block text-sm font-semibold">Nama Ayah</label>
                            <input id="father_name" type="text" name="father_name" value="{{ old('father_name') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="father_phone" class="block text-sm font-semibold">Nomor HP Ayah</label>
                            <input id="father_phone" type="text" name="father_phone" value="{{ old('father_phone') }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label for="mother_name" class="block text-sm font-semibold">Nama Ibu</label>
                            <input id="mother_name" type="text" name="mother_name" value="{{ old('mother_name') }}" class="mt-1 w-full rounded-md border-gray-300" required>
                        </div>

                        <div>
                            <label for="mother_phone" class="block text-sm font-semibold">Nomor HP Ibu</label>
                            <input id="mother_phone" type="text" name="mother_phone" value="{{ old('mother_phone') }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-semibold">Alamat</label>
                            <textarea id="address" name="address" rows="3" class="mt-1 w-full rounded-md border-gray-300" required>{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="family_card_file" class="block text-sm font-semibold">Kartu Keluarga</label>
                            <input id="family_card_file" type="file" name="family_card_file" class="mt-1 w-full rounded-md border border-gray-300 p-2" required>
                        </div>
                        <div>
                            <label for="birth_certificate_file" class="block text-sm font-semibold">Akta Kelahiran</label>
                            <input id="birth_certificate_file" type="file" name="birth_certificate_file" class="mt-1 w-full rounded-md border border-gray-300 p-2" required>
                        </div>
                        <div>
                            <label for="photo_file" class="block text-sm font-semibold">Foto</label>
                            <input id="photo_file" type="file" name="photo_file" class="mt-1 w-full rounded-md border border-gray-300 p-2" required>
                        </div>
                        <div>
                            <label for="last_report_file" class="block text-sm font-semibold">Rapor Terakhir</label>
                            <input id="last_report_file" type="file" name="last_report_file" class="mt-1 w-full rounded-md border border-gray-300 p-2" required>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('home') }}" class="rounded-lg border px-6 py-3 font-semibold">Batal</a>
                        <button type="submit" class="rounded-lg bg-green-800 px-6 py-3 font-bold text-white hover:bg-green-900">Submit Pendaftaran</button>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection
