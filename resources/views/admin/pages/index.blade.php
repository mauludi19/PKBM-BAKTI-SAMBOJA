@extends('layouts.admin')

@section('title', 'Manajemen Halaman')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Halaman</h1>
        <a href="{{ route('admin.pages.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition">
            + Tambah Halaman
        </a>
    </div>

    <!-- Alert Messages -->
    @if($message = session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Judul</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Slug</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $page->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <code class="bg-gray-100 px-2 py-1 rounded text-sm text-gray-700">{{ $page->slug }}</code>
                        </td>
                        <td class="px-6 py-4">
                            @if($page->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Aktif</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.pages.show', $page->id) }}" class="text-blue-600 hover:text-blue-900 font-medium text-sm">
                                Lihat
                            </a>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="text-yellow-600 hover:text-yellow-900 font-medium text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada halaman yang ditemukan. <a href="{{ route('admin.pages.create') }}" class="text-blue-600 hover:underline">Buat halaman baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pages->links() }}
        </div>
    </div>
</div>
@endsection
