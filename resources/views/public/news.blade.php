@extends('layouts.public')

@section('title', 'Berita')

@section('content')
    <section class="px-6 py-14 sm:px-10">
        <div class="mx-auto max-w-7xl">
            <h2 class="text-3xl font-bold">Berita</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-3">
                @forelse ($news as $item)
                    <article class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold">{{ $item->title }}</h3>
                        <p class="mt-3 text-sm leading-6 text-gray-600">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                    </article>
                @empty
                    <p class="rounded-lg border border-dashed border-gray-200 p-8 text-gray-500 md:col-span-3">Belum ada berita.</p>
                @endforelse
            </div>
            <div class="mt-8">{{ $news->links() }}</div>
        </div>
    </section>
@endsection
