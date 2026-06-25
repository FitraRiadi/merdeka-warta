<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\RunningText;
use App\Models\Spotlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function list(Request $request)
    {
        $query = Announcement::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            });

        // Filter by type (category)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        $announcements = $query->latest()->paginate(9);

        // Categories list for filter dropdown (group by type)
        $categories = Announcement::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->orderBy('total', 'desc')
            ->get();

        // Featured announcement (dari spotlight)
        $spotlightAnnouncement = Spotlight::with('announcement')
            ->announcementSpotlights()
            ->first();
        $featured = $spotlightAnnouncement?->announcement;

        // Latest announcements (2 after featured)
        $latestAnnouncements = Announcement::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->when($featured, function ($q) use ($featured) {
                $q->where('id', '!=', $featured->id);
            })
            ->latest()
            ->limit(2)
            ->get();

        $runningTexts = RunningText::orderBy('display_order')
            ->get();

        return view('public.announcement-list', compact(
            'announcements', 'categories', 'featured',
            'latestAnnouncements', 'runningTexts'
        ));
    }

    public function show($id)
    {
        $announcement = Announcement::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->findOrFail($id);

        // Pengumuman lain secara acak (kecuali pengumuman yang sedang dibuka)
        $otherAnnouncements = Announcement::where('is_active', true)
            ->where('id', '!=', $announcement->id)
            ->where(function ($query) {
                $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();

        // Running texts untuk navbar
        $runningTexts = RunningText::orderBy('display_order')
            ->get();

        return view('public.announcement-show', compact(
            'announcement', 'otherAnnouncements', 'runningTexts'
        ));
    }
}
