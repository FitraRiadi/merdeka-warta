<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\Setting;
use App\Services\CdnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    protected CdnService $cdn;

    public function __construct(CdnService $cdn)
    {
        $this->cdn = $cdn;
    }

    public function index(Request $request)
    {
        Gate::authorize('viewAny', Gallery::class);

        $user = Auth::user();
        $status = $request->get('status');

        $galleries = Gallery::when(!$user->isSuperAdmin(), function ($q) use ($user) {
                return $q->where('user_id', $user->id);
            })
            ->when($user->isSuperAdmin() && $status === 'pending', function ($q) {
                return $q->where('status', 'pending');
            })
            ->latest()
            ->paginate(10);

        $pendingCount = $user->isSuperAdmin() ? Gallery::pending()->count() : 0;

        return view('admin.galleries.index', compact('galleries', 'pendingCount', 'status'));
    }

    public function create()
    {
        Gate::authorize('create', Gallery::class);

        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Gallery::class);

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

        $user = Auth::user();
        $validated['user_id'] = $user->id;

        if (!$user->isSuperAdmin() && Setting::getValue('contributor_gallery_without_permission', '1') !== '1') {
            $validated['status'] = 'pending';
        }

        $gallery = Gallery::create($validated);

        $statusText = $gallery->status === 'pending' ? ' (menunggu persetujuan)' : '';
        ActivityLog::log('CREATED', 'gallery', $gallery->id, "Menambahkan galeri" . ($gallery->caption ? ": \"{$gallery->caption}\"" : '') . $statusText);

        if ($gallery->status === 'pending') {
            return redirect()->route('admin.galleries.index')
                ->with('success', 'Galeri berhasil ditambahkan dan menunggu persetujuan admin.');
        }

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        Gate::authorize('update', $gallery);

        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        Gate::authorize('update', $gallery);

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

    public function approve(Gallery $gallery)
    {
        Gate::authorize('update', $gallery);

        $gallery->update(['status' => 'approved']);

        ActivityLog::log('UPDATED', 'gallery', $gallery->id, "Menyetujui galeri" . ($gallery->caption ? ": \"{$gallery->caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil disetujui.');
    }

    public function reject(Gallery $gallery)
    {
        Gate::authorize('update', $gallery);

        $gallery->update(['status' => 'rejected']);

        ActivityLog::log('UPDATED', 'gallery', $gallery->id, "Menolak galeri" . ($gallery->caption ? ": \"{$gallery->caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditolak.');
    }

    public function destroy(Gallery $gallery)
    {
        Gate::authorize('delete', $gallery);

        $caption = $gallery->caption;
        $gallery->delete();

        ActivityLog::log('DELETED', 'gallery', null, "Menghapus galeri" . ($caption ? ": \"{$caption}\"" : ''));

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
