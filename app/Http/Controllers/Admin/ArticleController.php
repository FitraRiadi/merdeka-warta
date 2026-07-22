<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Setting;
use App\Models\Spotlight;
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
     * Upload an image for Editor.js.
     */
    public function uploadImage(Request $request)
    {
        $this->authorize('create', Article::class);

        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $result = $this->cdn->upload($request->file('image'));

        if ($result && $result['success']) {
            return response()->json([
                'success' => true,
                'file' => [
                    'url' => $result['url'],
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['error'] ?? 'Gagal upload gambar.',
        ], 422);
    }

    /**
     * Upload any file for the Button tool (download).
     */
    public function uploadFile(Request $request)
    {
        $this->authorize('create', Article::class);

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp,gif,zip|max:5120',
        ]);

        $file = $request->file('file');
        $result = $this->cdn->upload($file);

        if ($result && $result['success']) {
            return response()->json([
                'success' => true,
                'url' => $result['url'],
                'name' => $file->getClientOriginalName(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['error'] ?? 'Gagal upload file.',
        ], 422);
    }

    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Article::class);

        $user = Auth::user();

        $query = Article::with('author')->withCount('views');

        if (!$user->isSuperAdmin()) {
            $query->where('user_id', $user->id);
        } elseif ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        $sort = $request->input('sort', 'newest');
        $query->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc');

        $articles = $query->paginate(10)->withQueryString();

        if ($user->isSuperAdmin()) {
            $pendingCount = Article::where('status', 'pending')->count();
            return view('admin.articles.index', compact('articles', 'pendingCount'));
        }

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'is_published' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Resolve category name
        $category = \App\Models\Category::findOrFail($validated['category_id']);
        $validated['category'] = $category->name;

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

        $validated['user_id'] = Auth::id();
        $validated['published_at'] = now();

        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $validated['is_published'] = $request->has('is_published');
            $validated['status'] = $request->has('is_published') ? 'published' : 'draft';
        } elseif (Setting::getValue('contributor_add_without_permission', '1') !== '1') {
            $validated['status'] = 'pending';
            $validated['is_published'] = false;
        } else {
            $validated['status'] = 'published';
            $validated['is_published'] = true;
        }

        $validated['backup_author_name'] = $user->name;

        $article = Article::create($validated);

        ActivityLog::log('CREATED', 'article', $article->id, "Membuat artikel <a href=\"" . route('public.article.show', $article->slug) . "\" class=\"underline hover:text-primary\">" . e($article->title) . "</a>");

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

        $categories = \App\Models\Category::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'is_published' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Resolve category name
        $category = \App\Models\Category::findOrFail($validated['category_id']);
        $validated['category'] = $category->name;

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

        unset($validated['user_id']);

        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $validated['is_published'] = $request->has('is_published');
            $validated['status'] = $request->has('is_published') ? 'published' : 'draft';
        } else {
            unset($validated['is_published']);
        }

        $validated['backup_author_name'] = $user->name;

        $article->update($validated);

        ActivityLog::log('UPDATED', 'article', $article->id, "Memperbarui artikel <a href=\"" . route('public.article.show', $article->slug) . "\" class=\"underline hover:text-primary\">" . e($article->title) . "</a>");

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

        Spotlight::where('type', 'article')->where('article_id', $article->id)->delete();

        $title = $article->title;
        $article->delete();

        ActivityLog::log('DELETED', 'article', null, "Menghapus artikel \"" . e($title) . "\"");

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function approve(Article $article)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403);
        }

        $article->update([
            'status' => 'published',
            'is_published' => true,
            'published_at' => now(),
        ]);

        ActivityLog::log('UPDATED', 'article', $article->id, "Menyetujui artikel \"" . e($article->title) . "\"");

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil disetujui dan dipublikasikan.');
    }

    public function reject(Article $article)
    {
        if (!Auth::user()->isSuperAdmin()) {
            abort(403);
        }

        $article->update([
            'status' => 'rejected',
            'is_published' => false,
        ]);

        ActivityLog::log('UPDATED', 'article', $article->id, "Menolak artikel \"" . e($article->title) . "\"");

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel ditolak.');
    }

    public function resubmit(Article $article)
    {
        $this->authorize('update', $article);

        $article->update([
            'status' => 'pending',
            'is_published' => false,
        ]);

        ActivityLog::log('UPDATED', 'article', $article->id, "Mengajukan ulang artikel \"" . e($article->title) . "\"");

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diajukan ulang.');
    }
}