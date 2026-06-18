@extends('layouts.admin')

@section('title', 'Mapel Tutor')
@section('page-title', 'Penugasan Mapel Tutor')
@section('eyebrow', 'Manajemen akademik')
@section('page-actions')
    <a href="{{ route('admin.tutor-subjects.create') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-800">Tambah</a>
@endsection

@section('content')
    <div class="grid gap-4">
        @forelse ($tutors as $tutor)
            <section class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-start">
                    <div>
                        <h3 class="font-semibold">{{ $tutor->user?->name }}</h3>
                        <p class="text-sm text-slate-500">{{ $tutor->specialization ?? 'Belum ada spesialisasi' }}</p>
                    </div>
                    <a href="{{ route('admin.tutors.show', $tutor) }}" class="text-sm font-medium text-emerald-700 hover:text-emerald-900">Detail tutor</a>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @forelse ($tutor->subjects as $subject)
                        <form method="POST" action="{{ route('admin.tutor-subjects.destroy', [$tutor, $subject]) }}" onsubmit="return confirm('Lepas mapel ini dari tutor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium text-slate-700 hover:bg-red-50 hover:text-red-700">
                                {{ $subject->code }} - {{ $subject->name }}
                            </button>
                        </form>
                    @empty
                        <p class="text-sm text-slate-500">Belum ada mata pelajaran yang ditugaskan.</p>
                    @endforelse
                </div>
            </section>
        @empty
            <div class="rounded-lg border border-slate-200 bg-white p-8 text-center text-sm text-slate-500 shadow-sm">Belum ada tutor.</div>
        @endforelse
    </div>
@endsection
