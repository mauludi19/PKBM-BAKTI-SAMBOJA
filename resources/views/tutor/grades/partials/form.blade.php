<div class="space-y-6">
    <div class="grid gap-4 sm:grid-cols-2">
        <div>
            <label for="student_id" class="block text-sm font-medium text-slate-700">Siswa</label>
            <select id="student_id" name="student_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="">Pilih siswa</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" @selected(old('student_id', $grade?->student_id) == $student->id)>
                        {{ $student->user?->name ?? 'Siswa #' . $student->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="subject_id" class="block text-sm font-medium text-slate-700">Mata Pelajaran</label>
            <select id="subject_id" name="subject_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="">Pilih mata pelajaran</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" @selected(old('subject_id', $grade?->subject_id) == $subject->id)>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="semester" class="block text-sm font-medium text-slate-700">Semester</label>
            <select id="semester" name="semester" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                <option value="1" @selected(old('semester', $grade?->semester) === '1')>Semester 1</option>
                <option value="2" @selected(old('semester', $grade?->semester) === '2')>Semester 2</option>
            </select>
        </div>

        <div>
            <label for="academic_year" class="block text-sm font-medium text-slate-700">Tahun Ajaran</label>
            <input id="academic_year" name="academic_year" type="text" value="{{ old('academic_year', $grade?->academic_year) }}" placeholder="2025/2026" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
        </div>

        <div>
            <label for="assignment_score" class="block text-sm font-medium text-slate-700">Nilai Tugas</label>
            <input id="assignment_score" name="assignment_score" type="number" min="0" max="100" step="0.01" value="{{ old('assignment_score', $grade?->assignment_score) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>

        <div>
            <label for="mid_score" class="block text-sm font-medium text-slate-700">Nilai Tengah Semester</label>
            <input id="mid_score" name="mid_score" type="number" min="0" max="100" step="0.01" value="{{ old('mid_score', $grade?->mid_score) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>

        <div>
            <label for="final_score" class="block text-sm font-medium text-slate-700">Nilai Akhir Semester</label>
            <input id="final_score" name="final_score" type="number" min="0" max="100" step="0.01" value="{{ old('final_score', $grade?->final_score) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">
        </div>
    </div>

    <div>
        <label for="notes" class="block text-sm font-medium text-slate-700">Catatan</label>
        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('notes', $grade?->notes) }}</textarea>
    </div>

    <div class="flex flex-wrap items-center gap-3 pt-2">
        <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('tutor.grades.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
    </div>
</div>
