<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\CdnService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected CdnService $cdn;

    public function __construct(CdnService $cdn)
    {
        $this->cdn = $cdn;
    }

    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $this->authorize('viewAny', Article::class);

        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $articles = Article::with('author')->latest()->paginate(10);
        } else {
            $articles = Article::where('user_id', $user->id)
                ->with('author')
                ->latest()
                ->paginate(10);
        }

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        $authors = [];
        if (Auth::user()->isSuperAdmin()) {
            $authors = User::where('role', 'author')->get();
        }

        return view('admin.articles.create', compact('authors'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'category' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Article::where('slug', $validated['slug'])->count();
            if ($count > 0) {
                $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
            }
        }

        // Upload gambar ke CDN
        if ($request->hasFile('image')) {
            $result = $this->cdn->upload($request->file('image'));
            if ($result && $result['success']) {
                $validated['image'] = $result['url'];
            } else {
                return back()->withErrors([
                    'image' => $result['error'] ?? 'Gagal upload gambar ke CDN.'
                ])->withInput();
            }
        }

        // Assign user_id
        if (!Auth::user()->isSuperAdmin()) {
            $validated['user_id'] = Auth::id();
        }

        // Published at
        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['is_published'] = $request->has('is_published');

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        $this->authorize('view', $article);
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        $authors = [];
        if (Auth::user()->isSuperAdmin()) {
            $authors = User::where('role', 'author')->get();
        }

        return view('admin.articles.edit', compact('article', 'authors'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'category' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Article::where('slug', $validated['slug'])
                ->where('id', '!=', $article->id)
                ->count();
            if ($count > 0) {
                $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
            }
        }

        if ($request->hasFile('image')) {
            $result = $this->cdn->upload($request->file('image'));
            if ($result && $result['success']) {
                if ($article->image) {
                    $this->cdn->delete($article->image);
                }
                $validated['image'] = $result['url'];
            } else {
                return back()->withErrors([
                    'image' => $result['error'] ?? 'Gagal upload gambar ke CDN.'
                ])->withInput();
            }
        }

        if (!Auth::user()->isSuperAdmin()) {
            unset($validated['user_id']);
        }

        $validated['is_published'] = $request->has('is_published');

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        if ($article->image) {
            $this->cdn->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}