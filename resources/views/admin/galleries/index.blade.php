@extends('admin.layouts.admin')

@section('title', 'Galeri - Panel Admin')
@section('page_title', 'Galeri')
@section('page_description', 'Kelola galeri gambar')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $galleries->total() }}</span> gambar
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary admin-btn-sm">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Gambar
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($galleries as $gallery)
            <div class="admin-card overflow-hidden group">
                <div class="aspect-video bg-surface-container-highest relative overflow-hidden">
                    <img src="{{ $gallery->image_url }}"
                        alt="{{ $gallery->caption ?? 'Gallery image' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        onerror="this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full\' style=\'background-color:var(--surface-container)\'><span class=\'material-symbols-outlined text-4xl\' style=\'color:var(--on-surface-variant)\'>broken_image</span></div>'">
                </div>
                <div class="p-4 border-t-3 border-on-background">
                    <p class="font-body-md text-sm font-bold truncate">{{ $gallery->caption ?? 'Tanpa Keterangan' }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-2 font-label-mono text-[10px] uppercase text-on-surface-variant">
                        </div>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="action-btn action-btn-edit" title="Edit">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" data-confirm-delete data-message="Gambar galeri akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3">
                <div class="admin-card p-12 text-center">
                    <div class="empty-state-icon">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">imagesmode</span>
                    </div>
                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada gambar di galeri.</p>
                    <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tambah Gambar</a>
                </div>
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div class="mt-6 pagination">
            {{ $galleries->links() }}
        </div>
    @endif
@endsection
