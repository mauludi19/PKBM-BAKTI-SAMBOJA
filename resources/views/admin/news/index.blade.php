@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Berita</h1>
        <a href="{{ route('admin.news.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
            + Tambah Berita
        </a>
    </div>

    <!-- Alert Messages -->
    @if($message = session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <input type="text" placeholder="Cari berita..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="">Semua Status</option>
                <option value="published">Dipublikasikan</option>
                <option value="draft">Draft</option>
            </select>
        </div>
    </div>

    <!-- News Table -->
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Judul</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Penulis</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $article)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($article->thumbnail)
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-12 h-12 rounded object-cover">
                                @else
                                    <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center text-gray-400">
                                        📰
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $article->title }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit(strip_tags($article->content), 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-700">{{ $article->author->name ?? 'Unknown' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-700">{{ $article->published_at ? date('d M Y', strtotime($article->published_at)) : '-' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($article->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Dipublikasikan</span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.news.show', $article->id) }}" class="text-blue-600 hover:text-blue-900 font-medium text-sm">
                                Lihat
                            </a>
                            <a href="{{ route('admin.news.edit', $article->id) }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada berita. <a href="{{ route('admin.news.create') }}" class="text-blue-600 hover:underline">Buat berita baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <pre>{{ get_class($news) }}</pre>
        </div>
    </div>
</div>
@endsection
