<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Poll;
use App\Models\RunningText;
use App\Models\Spotlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $spotlights = Spotlight::with('article')
            ->articleSpotlights()
            ->take(3)
            ->get();

        if ($spotlights->isEmpty()) {
            $fallback = Article::where('is_published', true)->where('status', 'published')
                ->latest('published_at')
                ->take(3)
                ->get();
            $spotlights = $fallback->map(fn ($a) => tap(new \stdClass(), fn ($o) => $o->article = $a));
        }

        $spotlightAnnouncement = Spotlight::with('announcement')
            ->announcementSpotlights()
            ->first();

        if (!$spotlightAnnouncement) {
            $fallback = Announcement::where('is_active', true)
                ->where(fn ($q) => $q->whereNull('expired_at')->orWhere('expired_at', '>', now()))
                ->latest()
                ->first();
            if ($fallback) {
                $spotlightAnnouncement = tap(new \stdClass(), fn ($o) => $o->announcement = $fallback);
            }
        }

        $articles = Article::where('is_published', true)->where('status', 'published')
            ->with('author')
            ->latest('published_at')
            ->take(9)
            ->get();

        $runningTexts = RunningText::latest()
            ->get();

        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->latest()
            ->limit(3)
            ->get();

        $galleries = Gallery::get();

        $popularWeek = Article::where('is_published', true)->where('status', 'published')
            ->withCount(['views' => function ($q) {
                $q->where('created_at', '>=', now()->startOfWeek());
            }])
            ->with('author')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get()
            ->filter(fn ($a) => $a->views_count > 0);

        if ($popularWeek->count() < 5) {
            $existingIds = $popularWeek->pluck('id');
            $pad = Article::where('is_published', true)->where('status', 'published')
                ->whereNotIn('id', $existingIds)
                ->latest('published_at')
                ->take(5 - $popularWeek->count())
                ->get()
                ->map(fn ($a) => tap(clone $a, fn ($c) => $c->views_count = 0));
            $popularWeek = $popularWeek->concat($pad);
        }

        $polls = Poll::with('options.votes')->active()->latest()->limit(1)->get();

        return view('public.index', compact(
            'spotlights', 'spotlightAnnouncement', 'articles', 'runningTexts',
            'announcements', 'galleries', 'popularWeek', 'polls'
        ));
    }

    public function list(Request $request)
    {
        $query = Article::where('is_published', true)->where('status', 'published')->with('author');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Filter by tag/hashtag
        if ($request->filled('tag')) {
            $tag = $request->tag;
            $query->where('content', 'like', '%#' . addcslashes($tag, '%_') . '%');
        }

        $articles = $query->latest('published_at')->paginate(9);

        // Categories list for filter dropdown
        $categories = Article::where('is_published', true)->where('status', 'published')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Spotlights for hero carousel (max 3)
        $spotlights = Spotlight::with('article')
            ->articleSpotlights()
            ->take(3)
            ->get();

        $runningTexts = RunningText::latest()
            ->get();

        return view('public.article-list', compact(
            'articles', 'categories', 'spotlights', 'runningTexts'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)->where('status', 'published')
            ->with('author')
            ->withCount('views')
            ->firstOrFail();

        // Sidebar: artikel populer (paling banyak dilihat)
        $popularArticles = Article::where('is_published', true)->where('status', 'published')
            ->withCount('views')
            ->orderBy('views_count', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Bottom section: artikel lain secara acak (kecuali artikel yang sedang dibuka)
        $relatedArticles = Article::where('is_published', true)->where('status', 'published')
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        // Sidebar: kategori dengan jumlah artikel
        $categories = Article::where('is_published', true)->where('status', 'published')
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Running texts untuk navbar
        $runningTexts = RunningText::latest()
            ->get();

        // Catat view — user login via user_id, guest via ip_address
        if (Auth::check()) {
            $article->views()->firstOrCreate([
                'user_id' => Auth::id(),
                'viewable_type' => Article::class,
                'viewable_id' => $article->id,
            ]);
        } else {
            $article->views()->firstOrCreate([
                'ip_address' => request()->ip(),
                'viewable_type' => Article::class,
                'viewable_id' => $article->id,
            ]);
        }

        return view('public.article-show', compact(
            'article', 'popularArticles', 'relatedArticles',
            'categories', 'runningTexts'
        ));
    }
}