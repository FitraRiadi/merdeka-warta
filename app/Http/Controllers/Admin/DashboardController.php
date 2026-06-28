<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\RunningText;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->isSuperAdmin()) {
            $data['totalArticles'] = Article::count();
            $data['totalPublished'] = Article::where('is_published', true)->count();
            $data['totalDraft'] = Article::where('is_published', false)->count();
            $data['totalAnnouncements'] = Announcement::count();
            $data['totalRunningTexts'] = RunningText::count();
            $data['totalAuthors'] = User::where('role', 'author')->count();
            $data['recentArticles'] = Article::with('author')->withCount('views')->latest()->take(5)->get();
            $data['recentAnnouncements'] = Announcement::withCount('views')->latest()->take(3)->get();
            $data['runningTexts'] = RunningText::latest()->get();
            $data['activityLogs'] = ActivityLog::with('user')->latest()->take(5)->get();

            // View statistics for donut chart
            $articleViews = View::where('viewable_type', Article::class)->count();
            $announcementViews = View::where('viewable_type', Announcement::class)->count();
            $data['articleViews'] = $articleViews;
            $data['announcementViews'] = $announcementViews;
            $data['totalViews'] = $articleViews + $announcementViews;

            // Trending articles (paling banyak dilihat)
            $data['trendingArticles'] = Article::with('author')
                ->withCount('views')
                ->whereHas('views')
                ->orderBy('views_count', 'desc')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        } else {
            $data['totalArticles'] = Article::where('user_id', $user->id)->count();
            $data['totalPublished'] = Article::where('user_id', $user->id)->where('is_published', true)->count();
            $data['totalDraft'] = Article::where('user_id', $user->id)->where('is_published', false)->count();
            $data['recentArticles'] = Article::with('author')
                ->withCount('views')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();
            $data['activityLogs'] = ActivityLog::with('user')->latest()->take(5)->get();

            // View statistics for author's donut chart
            $authorArticleIds = Article::where('user_id', $user->id)->pluck('id');
            $data['authorArticleViews'] = View::where('viewable_type', Article::class)
                ->whereIn('viewable_id', $authorArticleIds)
                ->count();
            $data['authorTotalArticles'] = $authorArticleIds->count();

            // Trending articles milik author (paling banyak dilihat)
            $data['trendingArticles'] = Article::with('author')
                ->withCount('views')
                ->where('user_id', $user->id)
                ->whereHas('views')
                ->orderBy('views_count', 'desc')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }

        return view('admin.dashboard', $data);
    }
}
