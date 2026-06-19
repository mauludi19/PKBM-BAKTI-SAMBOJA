<div class="space-y-5">
    <div>
        <label for="name" class="block text-sm font-medium text-slate-700">Nama Paket</label>
        <input id="name" name="name" type="text" value="{{ old('name', $package?->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi</label>
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('description', $package?->description) }}</textarea>
    </div>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.packages.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
