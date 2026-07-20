<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('super_admin');
    }

    public function index()
    {
        return redirect()->route('admin.categories.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:announcement_categories,name',
            'type' => 'required|in:info,warning,important',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category = AnnouncementCategory::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', "Kategori pengumuman \"{$category->name}\" berhasil ditambahkan.");
    }

    public function update(Request $request, AnnouncementCategory $announcementCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:announcement_categories,name,' . $announcementCategory->id,
            'type' => 'required|in:info,warning,important',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $announcementCategory->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', "Kategori pengumuman \"{$announcementCategory->name}\" berhasil diperbarui.");
    }

    public function destroy(AnnouncementCategory $announcementCategory)
    {
        if ($announcementCategory->announcements()->count() > 0) {
            return back()->with('error', "Kategori \"{$announcementCategory->name}\" masih memiliki {$announcementCategory->announcements()->count()} pengumuman.");
        }

        $name = $announcementCategory->name;
        $announcementCategory->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "Kategori pengumuman \"{$name}\" berhasil dihapus.");
    }
}
