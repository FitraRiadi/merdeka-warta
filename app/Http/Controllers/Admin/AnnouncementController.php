<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Spotlight;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        // Hanya super_admin yang bisa akses
        $this->middleware('super_admin')->except(['index', 'show']);
    }

    public function index()
    {
        $announcements = Announcement::withCount('views')->latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        $annCategories = AnnouncementCategory::orderBy('name')->get();
        return view('admin.announcements.create', compact('annCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'announcement_category_id' => 'required|exists:announcement_categories,id',
            'is_active' => 'nullable|boolean',
            'expired_at' => 'nullable|date|after:today',
        ]);

        $category = AnnouncementCategory::findOrFail($validated['announcement_category_id']);
        $validated['type'] = $category->type;
        $validated['is_active'] = $request->has('is_active');

        $announcement = Announcement::create($validated);

        ActivityLog::log('CREATED', 'announcement', $announcement->id, "Membuat pengumuman <a href=\"" . route('public.announcement.show', $announcement->id) . "\" class=\"underline hover:text-primary\">" . e($announcement->title) . "</a>");

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pemberitahuan berhasil dibuat.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        $annCategories = AnnouncementCategory::orderBy('name')->get();
        return view('admin.announcements.edit', compact('announcement', 'annCategories'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'announcement_category_id' => 'required|exists:announcement_categories,id',
            'is_active' => 'nullable|boolean',
            'expired_at' => 'nullable|date|after:today',
        ]);

        $category = AnnouncementCategory::findOrFail($validated['announcement_category_id']);
        $validated['type'] = $category->type;
        $validated['is_active'] = $request->has('is_active');

        $announcement->update($validated);

        ActivityLog::log('UPDATED', 'announcement', $announcement->id, "Memperbarui pengumuman <a href=\"" . route('public.announcement.show', $announcement->id) . "\" class=\"underline hover:text-primary\">" . e($announcement->title) . "</a>");

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pemberitahuan berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        Spotlight::where('type', 'announcement')->where('announcement_id', $announcement->id)->delete();

        $title = $announcement->title;
        $announcement->delete();

        ActivityLog::log('DELETED', 'announcement', null, "Menghapus pengumuman \"{$title}\"");

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Pemberitahuan berhasil dihapus.');
    }
}