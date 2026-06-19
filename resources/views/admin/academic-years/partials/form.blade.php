<div class="space-y-5">
    <div>
        <label for="year" class="block text-sm font-medium text-slate-700">Tahun Ajaran</label>
        <input id="year" name="year" type="text" value="{{ old('year', $academicYear?->year) }}" placeholder="2026/2027" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
    </div>

    <label class="flex items-center gap-3">
        <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" @checked(old('is_active', $academicYear?->is_active))>
        <span class="text-sm font-medium text-slate-700">Jadikan tahun ajaran aktif</span>
    </label>

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.academic-years.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
