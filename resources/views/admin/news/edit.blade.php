@extends('layouts.admin')

@section('title', 'Edit Berita: ' . $news->title)

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.news.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Berita</h1>
    </div>

    <!-- Form -->
    <div class="bg-white border border-gray-200 rounded-lg p-8">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">
                            Judul Berita <span class="text-red-600">*</span>
                        </label>
                        <input type="text" name="title" id="title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul berita"
                            value="{{ old('title', $news->title) }}">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-900 mb-2">
                            Konten <span class="text-red-600">*</span>
                        </label>
                        <textarea name="content" id="content" required rows="20"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            placeholder="Masukkan konten berita...">{{ old('content', $news->content) }}</textarea>
                        <p class="text-gray-500 text-xs mt-1">💡 Tip: Gunakan paragraf yang jelas dan mudah dipahami</p>
                        @error('content')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Thumbnail -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <label for="thumbnail" class="block text-sm font-semibold text-gray-900 mb-3">
                            📷 Thumbnail Berita
                        </label>
                        <div id="thumbnailPreview" class="mb-4 rounded-lg overflow-hidden bg-gray-200 h-40 flex items-center justify-center text-gray-400">
                            @if($news->thumbnail)
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <span>Tidak ada gambar</span>
                            @endif
                        </div>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 @error('thumbnail') border-red-500 @enderror"
                            onchange="previewThumbnail(event)">
                        <p class="text-gray-500 text-xs mt-2">Format: JPG, PNG, GIF | Max 2MB</p>
                        @error('thumbnail')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publish Status -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Status Publikasi</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="is_published" id="is_published"
                                    class="w-4 h-4 text-green-600 rounded focus:ring-2 focus:ring-green-500"
                                    {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                                <span class="text-sm font-medium text-gray-900">Publikasikan</span>
                            </label>
                            @if($news->published_at)
                                <p class="text-xs text-gray-600 pl-7">
                                    Dipublikasikan pada: {{ $news->published_at->format('d M Y H:i') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                            💾 Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.news.show', $news->id) }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-900 px-4 py-2 rounded-lg font-semibold transition text-center">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewThumbnail(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumbnailPreview').innerHTML =
                    '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
