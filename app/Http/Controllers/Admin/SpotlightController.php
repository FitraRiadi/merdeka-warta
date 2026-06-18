<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Spotlight;
use Illuminate\Http\Request;

class SpotlightController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin');
    }

    public function index()
    {
        $spotlights = Spotlight::with('article')->orderBy('sort_order')->paginate(10);
        return view('admin.spotlights.index', compact('spotlights'));
    }

    public function create()
    {
        $articles = Article::where('is_published', true)->latest('published_at')->get();
        return view('admin.spotlights.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'badge_label' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Spotlight::create($validated);

        return redirect()->route('admin.spotlights.index')
            ->with('success', 'Sorotan berhasil ditambahkan.');
    }

    public function edit(Spotlight $spotlight)
    {
        $articles = Article::where('is_published', true)->latest('published_at')->get();
        return view('admin.spotlights.edit', compact('spotlight', 'articles'));
    }

    public function update(Request $request, Spotlight $spotlight)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'badge_label' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $spotlight->update($validated);

        return redirect()->route('admin.spotlights.index')
            ->with('success', 'Sorotan berhasil diperbarui.');
    }

    public function destroy(Spotlight $spotlight)
    {
        $spotlight->delete();
        return redirect()->route('admin.spotlights.index')
            ->with('success', 'Sorotan berhasil dihapus.');
    }
}
