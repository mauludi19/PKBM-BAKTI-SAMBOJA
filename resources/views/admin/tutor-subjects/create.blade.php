@extends('layouts.admin')

@section('title', 'Tambah Mapel Tutor')
@section('page-title', 'Tambah Mapel Tutor')
@section('eyebrow', 'Manajemen akademik')

@section('content')
    <form method="POST" action="{{ route('admin.tutor-subjects.store') }}" class="max-w-2xl rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        @csrf

        <div class="space-y-5">
            <div>
                <label for="tutor_id" class="block text-sm font-medium text-slate-700">Tutor</label>
                <select id="tutor_id" name="tutor_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                    @foreach ($tutors as $tutor)
                        <option value="{{ $tutor->id }}" @selected(old('tutor_id') == $tutor->id)>{{ $tutor->user?->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="subject_id" class="block text-sm font-medium text-slate-700">Mata Pelajaran</label>
                <select id="subject_id" name="subject_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->code }} - {{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Simpan</button>
                <a href="{{ route('admin.tutor-subjects.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-medium hover:bg-slate-50">Batal</a>
            </div>
        </div>
    </form>
@endsection
