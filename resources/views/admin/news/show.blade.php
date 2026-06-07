@extends('layouts.admin')

@section('title', $news->title)

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.news.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ $news->title }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Thumbnail -->
            @if($news->thumbnail)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover">
                </div>
            @endif

            <!-- Article Content -->
            <div class="bg-white border border-gray-200 rounded-lg p-8">
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="font-bold text-gray-900 mb-4">Status</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-600 uppercase">Publikasi</p>
                        @if($news->is_published)
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="font-semibold text-gray-900">Dipublikasikan</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <span class="font-semibold text-gray-900">Draft</span>
                            </div>
                        @endif
                    </div>

                    @if($news->published_at)
                        <div>
                            <p class="text-xs text-gray-600 uppercase">Tanggal Publikasi</p>
                            <p class="font-semibold text-gray-900 mt-1">{{ $news->published_at->format('d M Y, H:i') }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-xs text-gray-600 uppercase">Penulis</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $news->author->name ?? 'Unknown' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-600 uppercase">Dibuat</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $news->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-gray-600 uppercase">Diperbarui</p>
                        <p class="font-semibold text-gray-900 mt-1">{{ $news->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="bg-white border border-gray-200 rounded-lg p-6">
                <h3 class="font-bold text-gray-900 mb-4">Informasi</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-600 mb-1">Slug</p>
                        <code class="bg-gray-100 px-2 py-1 rounded text-xs text-gray-700 block break-all">{{ $news->slug }}</code>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('admin.news.edit', $news->id) }}" class="block w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-semibold text-center transition">
                    ✏️ Edit Berita
                </a>
                <a href="/news/{{ $news->slug }}" target="_blank" class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold text-center transition">
                    👁️ Lihat di Website
                </a>
                <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        🗑️ Hapus Berita
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
