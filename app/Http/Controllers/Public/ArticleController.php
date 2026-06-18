<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\RunningText;
use App\Models\Spotlight;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $spotlights = Spotlight::with('article')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $articles = Article::where('is_published', true)
            ->with('author')
            ->latest('published_at')
            ->take(9)
            ->get();

        $runningTexts = RunningText::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $announcements = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->latest()
            ->limit(3)
            ->get();

        $galleries = Gallery::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.index', compact(
            'spotlights', 'articles', 'runningTexts',
            'announcements', 'galleries', 'testimonials'
        ));
    }

    public function list(Request $request)
    {
        $query = Article::where('is_published', true)->with('author');

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

        $articles = $query->latest('published_at')->paginate(9);

        // Categories list for filter dropdown
        $categories = Article::where('is_published', true)
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Spotlights for hero carousel (ambil 5)
        $spotlights = Spotlight::with('article')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        $runningTexts = RunningText::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('public.article-list', compact(
            'articles', 'categories', 'spotlights', 'runningTexts'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->with('author')
            ->firstOrFail();

        // Sidebar: artikel populer (3 terbaru, kecuali current)
        $popularArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->limit(3)
            ->get();

        // Bottom section: artikel lain secara acak (kecuali artikel yang sedang dibuka)
        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Sidebar: kategori dengan jumlah artikel
        $categories = Article::where('is_published', true)
            ->select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Running texts untuk navbar
        $runningTexts = RunningText::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('public.article-show', compact(
            'article', 'popularArticles', 'relatedArticles',
            'categories', 'runningTexts'
        ));
    }
}