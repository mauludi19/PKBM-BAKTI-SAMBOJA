<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index()
    {
        $news = News::with('author')
            ->latest('published_at')
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Menyimpan berita baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'sometimes|boolean',
        ]);

        // Generate slug dari title
        $validated['slug'] = Str::slug($request->title) . '-' . time();
        $validated['author_id'] = auth()->id();
        $validated['is_published'] = $request->has('is_published') ? true : false;
        $validated['published_at'] = $request->has('is_published') ? now() : null;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('news', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Memperbarui berita.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'sometimes|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published') ? true : false;
        $validated['published_at'] = $request->has('is_published') ? now() : null;

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($news->thumbnail && file_exists(storage_path('app/public/' . $news->thumbnail))) {
                unlink(storage_path('app/public/' . $news->thumbnail));
            }

            $thumbnailPath = $request->file('thumbnail')->store('news', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $news->update($validated);

        return redirect()->route('admin.news.show', $news->id)
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Menghapus berita.
     */
    public function destroy(News $news)
    {
        // Hapus thumbnail jika ada
        if ($news->thumbnail && file_exists(storage_path('app/public/' . $news->thumbnail))) {
            unlink(storage_path('app/public/' . $news->thumbnail));
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
