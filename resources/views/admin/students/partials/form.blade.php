<div class="space-y-6">
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $student?->user?->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $student?->user?->email) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>
        <div>
            <label for="package_id" class="block text-sm font-medium text-slate-700">Paket Belajar</label>
            <select id="package_id" name="package_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}" @selected(old('package_id', $student?->package_id) == $package->id)>{{ $package->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="nisn" class="block text-sm font-medium text-slate-700">NISN</label>
            <input id="nisn" name="nisn" type="text" value="{{ old('nisn', $student?->nisn) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>
        <div>
            <label for="nik" class="block text-sm font-medium text-slate-700">NIK</label>
            <input id="nik" name="nik" type="text" value="{{ old('nik', $student?->nik) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="gender" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
            <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="L" @selected(old('gender', $student?->gender) === 'L')>Laki-laki</option>
                <option value="P" @selected(old('gender', $student?->gender) === 'P')>Perempuan</option>
            </select>
        </div>
        <div>
            <label for="birth_place" class="block text-sm font-medium text-slate-700">Tempat Lahir</label>
            <input id="birth_place" name="birth_place" type="text" value="{{ old('birth_place', $student?->birth_place) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="birth_date" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
            <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $student?->birth_date) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
            <select id="status" name="status" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="active" @selected(old('status', $student?->status ?? 'active') === 'active')>Aktif</option>
                <option value="inactive" @selected(old('status', $student?->status) === 'inactive')>Nonaktif</option>
                <option value="graduated" @selected(old('status', $student?->status) === 'graduated')>Lulus</option>
            </select>
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-slate-700">Telepon</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $student?->phone) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="parent_name" class="block text-sm font-medium text-slate-700">Nama Orang Tua</label>
            <input id="parent_name" name="parent_name" type="text" value="{{ old('parent_name', $student?->parent_name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
    </div>

    <div>
        <label for="address" class="block text-sm font-medium text-slate-700">Alamat</label>
        <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('address', $student?->address) }}</textarea>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.students.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
