<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Article;
use App\Models\RunningText;
use App\Models\User;
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
            $data['recentArticles'] = Article::with('author')->latest()->take(5)->get();
            $data['recentAnnouncements'] = Announcement::latest()->take(3)->get();
            $data['runningTexts'] = RunningText::latest()->get();
        } else {
            $data['totalArticles'] = Article::where('user_id', $user->id)->count();
            $data['totalPublished'] = Article::where('user_id', $user->id)->where('is_published', true)->count();
            $data['totalDraft'] = Article::where('user_id', $user->id)->where('is_published', false)->count();
            $data['recentArticles'] = Article::with('author')->where('user_id', $user->id)->latest()->take(5)->get();
        }

        return view('admin.dashboard', $data);
    }
}
