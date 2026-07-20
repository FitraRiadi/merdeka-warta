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
     * Upload an image via URL for Editor.js (byUrl endpoint).
     */
    public function uploadImageByUrl(Request $request)
    {
        $this->authorize('create', Article::class);

        $request->validate([
            'url' => 'required|url',
        ]);

        $url = $request->url;
        $parsed = parse_url($url);

        if (!isset($parsed['scheme']) || !in_array($parsed['scheme'], ['https'])) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya URL HTTPS yang diizinkan.',
            ], 422);
        }

        $host = $parsed['host'] ?? '';
        $ip = @gethostbyname($host);
        $isPrivate = filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        ) === false;

        if ($isPrivate) {
            return response()->json([
                'success' => false,
                'message' => 'URL tidak valid atau tidak dapat dijangkau.',
            ], 422);
        }

        try {
            $contents = @file_get_contents($url, false, stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'method' => 'GET',
                    'follow_location' => 1,
                    'max_redirects' => 3,
                    'header' => "User-Agent: MerdekaWarta/1.0\r\n",
                ],
                'ssl' => [
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                ],
            ]));
            if ($contents === false) {
                throw new \RuntimeException('Gagal mengunduh gambar dari URL.');
            }

            $tempPath = tempnam(sys_get_temp_dir(), 'mw_');
            file_put_contents($tempPath, $contents);

            $imageInfo = @getimagesize($tempPath);
            if ($imageInfo === false) {
                @unlink($tempPath);
                throw new \RuntimeException('URL tidak mengarah ke file gambar yang valid.');
            }

            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            $mime = $imageInfo['mime'];
            if (!in_array($mime, $allowedMimes)) {
                @unlink($tempPath);
                throw new \RuntimeException('Tipe gambar tidak diizinkan. Hanya JPEG, PNG, WebP, dan GIF.');
            }

            $extension = Str::afterLast($mime, '/');
            $extension = $extension === 'jpeg' ? 'jpg' : $extension;

            $img = @imagecreatefromstring($contents);
            if ($img === false) {
                @unlink($tempPath);
                throw new \RuntimeException('File gambar rusak atau tidak valid.');
            }
            imagedestroy($img);

            $file = new \Illuminate\Http\UploadedFile($tempPath, 'image.' . $extension, $mime, null, true);
            $result = $this->cdn->upload($file);

            @unlink($tempPath);

            if ($result && $result['success']) {
                return response()->json([
                    'success' => true,
                    'file' => [
                        'url' => $result['url'],
                    ],
                ]);
            }

            throw new \RuntimeException($result['error'] ?? 'Gagal menyimpan gambar.');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
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

        $articles = $query->latest()->paginate(10);

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

        return view('admin.articles.create');
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
            'image_url' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'category' => 'required|string|max:100',
        ]);

        // Slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Article::where('slug', $validated['slug'])->count();
            if ($count > 0) {
                $validated['slug'] = $validated['slug'] . '-' . ($count + 1);
            }
        }

        // Upload gambar ke CDN atau gunakan URL langsung
        if ($request->hasFile('image')) {
            $result = $this->cdn->upload($request->file('image'));
            if ($result && $result['success']) {
                $validated['image'] = $result['url'];
            } else {
                return back()->withErrors([
                    'image' => $result['error'] ?? 'Gagal upload gambar ke CDN.'
                ])->withInput();
            }
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);

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

        return view('admin.articles.edit', compact('article'));
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
            'image_url' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'category' => 'required|string|max:100',
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
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);

        unset($validated['user_id']);

        $user = Auth::user();
        if ($user->isSuperAdmin()) {
            $validated['is_published'] = $request->has('is_published');
            $validated['status'] = $request->has('is_published') ? 'published' : 'draft';
        } else {
            unset($validated['is_published']);
        }

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