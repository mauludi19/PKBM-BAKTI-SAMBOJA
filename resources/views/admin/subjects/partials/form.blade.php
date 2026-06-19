<div class="space-y-5">
    <div>
        <label for="code" class="block text-sm font-medium text-slate-700">Kode Mapel</label>
        <input id="code" name="code" type="text" value="{{ old('code', $subject?->code) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-slate-700">Nama Mapel</label>
        <input id="name" name="name" type="text" value="{{ old('name', $subject?->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.subjects.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
