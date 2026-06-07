@extends('layouts.admin')

@section('title', 'Edit Halaman')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.pages.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Halaman: {{ $page->title }}</h1>
    </div>

    <!-- Form -->
    <div class="bg-white border border-gray-200 rounded-lg p-8">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                    Judul Halaman
                </label>
                <input type="text" name="title" id="title" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    placeholder="Masukkan judul halaman"
                    value="{{ old('title', $page->title) }}">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-semibold text-gray-900 mb-2">
                    Slug (URL)
                </label>
                <input type="text" name="slug" id="slug" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('slug') border-red-500 @enderror"
                    placeholder="masukkan-slug-halaman"
                    value="{{ old('slug', $page->slug) }}">
                <p class="text-gray-500 text-sm mt-1">Slug digunakan untuk URL halaman. Gunakan huruf kecil dan tanda hubung.</p>
                @error('slug')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-semibold text-gray-900 mb-2">
                    Konten
                </label>
                <textarea name="content" id="content" required rows="15"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('content') border-red-500 @enderror"
                    placeholder="Masukkan konten halaman...">{{ old('content', $page->content) }}</textarea>
                @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active"
                    class="w-4 h-4 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                    {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-medium text-gray-900">
                    Halaman Aktif
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pages.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-900 px-6 py-2 rounded-lg font-semibold transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
