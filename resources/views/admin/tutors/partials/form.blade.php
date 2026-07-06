<div class="space-y-5">
    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $tutor?->user?->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $tutor?->user?->email) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>
        <div>
            <label for="nip" class="block text-sm font-medium text-slate-700">NIP</label>
            <input id="nip" name="nip" type="text" value="{{ old('npsn', $tutor?->nip) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="gender" class="block text-sm font-medium text-slate-700">Jenis Kelamin</label>
            <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="L" @selected(old('gender', $tutor?->gender) === 'L')>Laki-laki</option>
                <option value="P" @selected(old('gender', $tutor?->gender) === 'P')>Perempuan</option>
            </select>
        </div>
        <div>
            <label for="education" class="block text-sm font-medium text-slate-700">Pendidikan</label>
            <input id="education" name="education" type="text" value="{{ old('education', $tutor?->education) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="specialization" class="block text-sm font-medium text-slate-700">Spesialisasi</label>
            <input id="specialization" name="specialization" type="text" value="{{ old('specialization', $tutor?->specialization) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-slate-700">Telepon</label>
            <input id="phone" name="phone" type="text" value="{{ old('phone', $tutor?->phone) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
    </div>

    <div>
        <label for="address" class="block text-sm font-medium text-slate-700">Alamat</label>
        <textarea id="address" name="address" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('address', $tutor?->address) }}</textarea>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.tutors.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
