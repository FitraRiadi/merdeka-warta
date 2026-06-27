<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Services\CdnService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected CdnService $cdn;

    public function __construct(CdnService $cdn)
    {
        $this->middleware('super_admin');
        $this->cdn = $cdn;
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|string|max:500',
            'caption' => 'nullable|string|max:200',
        ]);

        if ($request->hasFile('image')) {
            $result = $this->cdn->upload($request->file('image'));
            if ($result && $result['success']) {
                $validated['image_url'] = $result['url'];
            } else {
                return back()->withErrors([
                    'image' => $result['error'] ?? 'Gagal upload gambar ke CDN.'
                ])->withInput();
            }
        }

        if (empty($validated['image_url'])) {
            return back()->withErrors([
                'image_url' => 'URL gambar atau file upload harus diisi.'
            ])->withInput();
        }

        unset($validated['image']);

        $gallery = Gallery::create($validated);

        ActivityLog::log('CREATED', 'gallery', $gallery->id, "Menambahkan galeri" . ($gallery->caption ? ": \"{$gallery->caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|string|max:500',
            'caption' => 'nullable|string|max:200',
        ]);

        if ($request->hasFile('image')) {
            $result = $this->cdn->upload($request->file('image'));
            if ($result && $result['success']) {
                $validated['image_url'] = $result['url'];
            } else {
                return back()->withErrors([
                    'image' => $result['error'] ?? 'Gagal upload gambar ke CDN.'
                ])->withInput();
            }
        }

        if (empty($validated['image_url'])) {
            $validated['image_url'] = $gallery->image_url;
        }

        unset($validated['image']);

        $gallery->update($validated);

        ActivityLog::log('UPDATED', 'gallery', $gallery->id, "Memperbarui galeri" . ($gallery->caption ? ": \"{$gallery->caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $caption = $gallery->caption;
        $gallery->delete();

        ActivityLog::log('DELETED', 'gallery', null, "Menghapus galeri" . ($caption ? ": \"{$caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
