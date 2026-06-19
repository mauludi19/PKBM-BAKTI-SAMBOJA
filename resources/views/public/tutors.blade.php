@extends('layouts.public')

@section('title', 'Tutor')

@section('content')
    <section class="px-6 py-14 sm:px-10">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-3xl font-bold">Tutor PKBM</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @forelse ($tutors as $tutor)
                    <article class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">{{ $tutor->user?->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $tutor->specialization ?? 'Tutor PKBM Bakti Samboja' }}</p>
                        <p class="mt-3 text-sm text-gray-600">{{ $tutor->education ?? '-' }}</p>
                    </article>
                @empty
                    <p class="rounded-lg border border-dashed border-gray-200 p-8 text-gray-500 md:col-span-3">Belum ada data tutor.</p>
                @endforelse
            </div>
            <div class="mt-8">{{ $tutors->links() }}</div>
        </div>
    </section>
@endsection
