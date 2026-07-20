<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
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
        $articleSpotlights = Spotlight::with('article')
            ->where('type', 'article')
            ->paginate(10);

        $announcementSpotlights = Spotlight::with('announcement')
            ->where('type', 'announcement')
            ->get();

        return view('admin.spotlights.index', compact('articleSpotlights', 'announcementSpotlights'));
    }

    public function manage()
    {
        $currentArticleSpotlights = Spotlight::with('article')
            ->where('type', 'article')
            ->get();
        $currentArticleIds = $currentArticleSpotlights->pluck('article_id');

        $allArticles = Article::where('is_published', true)->latest('published_at')->get();
        $spotlightedArticles = $allArticles->whereIn('id', $currentArticleIds);
        $otherArticles = $allArticles->whereNotIn('id', $currentArticleIds);
        $articles = $spotlightedArticles->concat($otherArticles)->values();

        $currentAnnouncementSpotlight = Spotlight::with('announcement')
            ->where('type', 'announcement')
            ->first();

        $allAnnouncements = Announcement::latest()->get();
        if ($currentAnnouncementSpotlight) {
            $spotlightedAnn = $allAnnouncements->where('id', $currentAnnouncementSpotlight->announcement_id);
            $otherAnn = $allAnnouncements->where('id', '!=', $currentAnnouncementSpotlight->announcement_id);
            $announcements = $spotlightedAnn->concat($otherAnn)->values();
        } else {
            $announcements = $allAnnouncements;
        }

        return view('admin.spotlights.manage', compact(
            'articles', 'announcements',
            'currentArticleSpotlights', 'currentAnnouncementSpotlight'
        ));
    }

    public function store(Request $request)
    {
        $articleIds = $request->input('article_ids', []);

        if (count($articleIds) > 3) {
            return back()->withErrors(['article_ids' => 'Maksimal 3 sorotan artikel.'])->withInput();
        }

        $currentArticleSpotlights = Spotlight::where('type', 'article')->get();

        foreach ($currentArticleSpotlights as $spotlight) {
            if (!in_array($spotlight->article_id, $articleIds)) {
                $spotlight->delete();
            }
        }

        foreach ($articleIds as $i => $articleId) {
            $spotlight = Spotlight::where('type', 'article')->where('article_id', $articleId)->first();
            if ($spotlight) {
                $spotlight->update([

                ]);
            } else {
                Spotlight::create([
                    'type' => 'article',
                    'article_id' => $articleId,
                ]);
            }
        }

        $announcementId = $request->input('announcement_id');
        $currentAnnouncement = Spotlight::where('type', 'announcement')->first();

        if ($announcementId) {
            if ($currentAnnouncement) {
                $currentAnnouncement->update([
                    'announcement_id' => $announcementId,
                ]);
            } else {
                Spotlight::create([
                    'type' => 'announcement',
                    'announcement_id' => $announcementId,
                ]);
            }
        } elseif ($currentAnnouncement) {
            $currentAnnouncement->delete();
        }

        return redirect()->route('admin.spotlights.index')
            ->with('success', 'Sorotan berhasil diperbarui.');
    }
}
