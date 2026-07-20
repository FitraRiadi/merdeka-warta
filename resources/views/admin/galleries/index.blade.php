@extends('admin.layouts.admin')

@section('title', 'Galeri - Panel Admin')
@section('page_title', 'Galeri')
@section('page_description', 'Kelola galeri gambar')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $galleries->total() }}</span> gambar
        </div>
        @can('create', App\Models\Gallery::class)
            <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary admin-btn-sm">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Gambar
            </a>
        @endcan
    </div>

    @if(Auth::user()->isSuperAdmin() && $status === 'pending')
        <div class="mb-6">
            <a href="{{ route('admin.galleries.index') }}" class="font-label-mono text-xs uppercase text-primary hover:text-secondary transition-colors inline-flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Semua Galeri
            </a>
        </div>
    @endif

    @if(Auth::user()->isSuperAdmin() && $pendingCount > 0)
        <a href="{{ route('admin.galleries.index', ['status' => 'pending']) }}" class="block bg-amber-50 border-3 border-amber-500 rounded-xl p-5 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
            <div class="flex items-start gap-4">
                <span class="material-symbols-outlined text-3xl text-amber-600 shrink-0 mt-0.5">pending_actions</span>
                <div class="flex-1">
                    <p class="font-headline-lg text-lg uppercase text-amber-900">Perhatian!</p>
                    <p class="font-body-md text-sm text-amber-800 mt-1">
                        Terdapat <strong class="text-amber-900">{{ $pendingCount }}</strong> gambar galeri yang menunggu persetujuan Anda.
                    </p>
                    <span class="inline-flex items-center gap-1 mt-3 font-label-mono text-xs uppercase text-amber-700 font-bold underline underline-offset-4">
                        Tinjau Sekarang
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($galleries as $gallery)
            <div class="admin-card overflow-hidden group">
                <div class="aspect-video bg-surface-container-highest relative overflow-hidden">
                    @if($gallery->status === 'pending')
                        <div class="absolute inset-0 bg-on-background/60 flex items-center justify-center z-10">
                            <span class="font-label-mono text-xs uppercase text-white font-bold bg-amber-600 px-3 py-1 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Pending</span>
                        </div>
                    @elseif($gallery->status === 'rejected')
                        <div class="absolute inset-0 bg-on-background/60 flex items-center justify-center z-10">
                            <span class="font-label-mono text-xs uppercase text-white font-bold bg-error px-3 py-1 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">Ditolak</span>
                        </div>
                    @endif
                    <img src="{{ $gallery->image_url }}"
                        alt="{{ $gallery->caption ?? 'Gallery image' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        onerror="this.parentElement.innerHTML='<div class=\'flex items-center justify-center h-full\' style=\'background-color:var(--surface-container)\'><span class=\'material-symbols-outlined text-4xl\' style=\'color:var(--on-surface-variant)\'>broken_image</span></div>'">
                </div>
                <div class="p-4 border-t-3 border-on-background">
                    <div class="flex items-center gap-2 mb-1">
                        @if($gallery->status === 'approved')
                            <span class="font-label-mono text-[9px] uppercase text-green-700 dark:text-green-400 font-bold bg-green-100 dark:bg-green-900/30 px-1.5 py-0.5 border border-green-500 rounded">Disetujui</span>
                        @elseif($gallery->status === 'pending')
                            <span class="font-label-mono text-[9px] uppercase text-amber-700 dark:text-amber-400 font-bold bg-amber-100 dark:bg-amber-900/30 px-1.5 py-0.5 border border-amber-500 rounded">Menunggu</span>
                        @elseif($gallery->status === 'rejected')
                            <span class="font-label-mono text-[9px] uppercase text-error font-bold bg-error-container px-1.5 py-0.5 border border-error rounded">Ditolak</span>
                        @endif
                    </div>
                    <p class="font-body-md text-sm font-bold truncate">{{ $gallery->caption ?? 'Tanpa Keterangan' }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-2 font-label-mono text-[10px] uppercase text-on-surface-variant">
                            @if($gallery->user)
                                <span>{{ $gallery->user->name }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-1.5">
                            @if(Auth::user()->isSuperAdmin() && $gallery->status === 'pending')
                                <form action="{{ route('admin.galleries.approve', $gallery) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-btn action-btn-approve" title="Setujui">
                                        <span class="material-symbols-outlined text-sm">check</span>
                                    </button>
                                </form>
                                <form action="{{ route('admin.galleries.reject', $gallery) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="action-btn action-btn-reject" title="Tolak">
                                        <span class="material-symbols-outlined text-sm">close</span>
                                    </button>
                                </form>
                            @else
                                @can('update', $gallery)
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                @endcan
                                @can('delete', $gallery)
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message="Gambar galeri akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                @endcan
                            @endif
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
                    @can('create', App\Models\Gallery::class)
                        <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tambah Gambar</a>
                    @endcan
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
