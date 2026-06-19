@extends('layouts.admin')

@section('title', $page->title)

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ $page->title }}</h1>
    </div>

    <!-- Detail Card -->
    <div class="bg-white border border-gray-200 rounded-lg p-8">
        <!-- Meta Information -->
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Slug</p>
                    <code class="bg-gray-100 px-2 py-1 rounded text-sm text-gray-700 block">{{ $page->slug }}</code>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        @if($page->is_active) bg-green-100 text-green-800 @else bg-gray-100 text-gray-800 @endif">
                        {{ $page->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Dibuat</p>
                    <p class="text-sm text-gray-900">{{ $page->created_at->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Diperbarui</p>
                    <p class="text-sm text-gray-900">{{ $page->updated_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Konten</h3>
            <div class="prose prose-sm max-w-none">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.pages.edit', $page->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                ✏️ Edit
            </a>
            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    🗑️ Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
