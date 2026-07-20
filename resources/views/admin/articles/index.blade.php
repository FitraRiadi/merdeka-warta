@extends('admin.layouts.admin')

@section('title', 'Artikel - Panel Admin')
@section('page_title', 'Artikel')
@section('page_description', 'Kelola artikel berita')

@section('content')
    @if(Auth::user()->isSuperAdmin() && isset($pendingCount) && $pendingCount > 0)
        <a href="{{ route('admin.articles.index', ['status' => 'pending']) }}" class="block bg-amber-50 border-3 border-amber-500 rounded-xl p-4 mb-6 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-amber-600">pending_actions</span>
                <p class="font-body-md text-sm text-amber-800">
                    Terdapat <strong>{{ $pendingCount }}</strong> artikel menunggu persetujuan.
                </p>
            </div>
        </a>
    @endif

    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant flex items-center gap-4">
            <span>Total: <span class="font-bold text-on-surface">{{ $articles->total() }}</span> artikel</span>
            @if(Auth::user()->isSuperAdmin())
                <div class="flex gap-1">
                    <a href="{{ route('admin.articles.index') }}" class="px-3 py-1 border-2 border-on-background font-bold text-[10px] {{ !request('status') ? 'bg-on-background text-surface' : 'text-on-surface' }}">Semua</a>
                    <a href="{{ route('admin.articles.index', ['status' => 'pending']) }}" class="px-3 py-1 border-2 border-on-background font-bold text-[10px] {{ request('status') === 'pending' ? 'bg-amber-500 text-white' : 'text-on-surface' }}">Pending</a>
                    <a href="{{ route('admin.articles.index', ['status' => 'published']) }}" class="px-3 py-1 border-2 border-on-background font-bold text-[10px] {{ request('status') === 'published' ? 'bg-green-600 text-white' : 'text-on-surface' }}">Terbit</a>
                    <a href="{{ route('admin.articles.index', ['status' => 'rejected']) }}" class="px-3 py-1 border-2 border-on-background font-bold text-[10px] {{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'text-on-surface' }}">Ditolak</a>
                </div>
            @endif
        </div>
        <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary admin-btn-sm">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Artikel
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-center w-12">No</th>
                        <th class="text-left w-full min-w-0">Judul</th>
                        <th class="text-left hidden md:table-cell">Penulis</th>
                        <th class="text-left hidden sm:table-cell">Kategori</th>
                        <th class="text-left hidden lg:table-cell">Tanggal</th>
                        <th class="text-center">Pelihat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td class="text-center font-label-mono text-xs text-on-surface-variant">{{ $articles->firstItem() + $loop->index }}</td>
                            <td class="w-full min-w-0">
                                <div class="flex items-center gap-3">
                                    @if($article->image)
                                        <img src="{{ $article->image }}" alt="" class="w-10 h-10 object-cover border-2 border-on-background shrink-0 hidden sm:block shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)]">
                                    @endif
                                    <div class="min-w-0">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="font-body-md text-sm font-bold hover:text-primary truncate block">
                                            {{ $article->title }}
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell">
                                <span class="font-body-md text-sm text-on-surface-variant">{{ $article->display_author }}</span>
                            </td>
                            <td class="hidden sm:table-cell">
                                @if($article->category)
                                    <span class="admin-badge bg-blue-100 text-blue-700 border-blue-700 text-[10px]">{{ $article->category }}</span>
                                @else
                                    <span class="text-on-surface-variant font-body-md text-sm">-</span>
                                @endif
                            </td>
                        <td class="hidden lg:table-cell">
                            <span class="font-label-mono text-xs text-on-surface-variant">{{ $article->published_at?->format('d M Y') ?? '-' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="inline-flex items-center gap-1 font-label-mono text-xs {{ $article->views_count > 0 ? 'text-on-surface' : 'text-on-surface-variant' }}">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                {{ $article->views_count }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($article->status === 'pending')
                                <span class="admin-badge bg-amber-100 text-amber-700 border-amber-600 text-[10px]">Pending</span>
                            @elseif($article->status === 'rejected')
                                <span class="admin-badge bg-red-100 text-red-700 border-red-600 text-[10px]">Ditolak</span>
                            @elseif($article->status === 'published' && $article->is_published)
                                <span class="admin-badge bg-green-100 text-green-700 border-green-700 text-[10px]">Terbit</span>
                            @else
                                <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400 text-[10px]">Draft</span>
                            @endif
                        </td>
                            <td>
                                <div class="flex items-center justify-center gap-1.5">
                                    @if(Auth::user()->isSuperAdmin() && ($article->status === 'pending' || $article->status === 'rejected'))
                                        <form action="{{ route('admin.articles.approve', $article) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="action-btn bg-green-100 text-green-700 hover:bg-green-200" title="Setujui">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </button>
                                        </form>
                                        @if($article->status === 'pending')
                                        <form action="{{ route('admin.articles.reject', $article) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="action-btn bg-red-100 text-red-700 hover:bg-red-200" title="Tolak">
                                                <span class="material-symbols-outlined text-sm">close</span>
                                            </button>
                                        </form>
                                        @endif
                                    @endif
                                    @if(!Auth::user()->isSuperAdmin() && $article->status === 'rejected')
                                        <form action="{{ route('admin.articles.resubmit', $article) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="action-btn bg-amber-100 text-amber-700 hover:bg-amber-200" title="Ajukan Ulang">
                                                <span class="material-symbols-outlined text-sm">refresh</span>
                                            </button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->isSuperAdmin() || ($globalSettings['contributor_edit_without_permission'] ?? '1') === '1')
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    @endif
                                    @if($article->status === 'published')
                                        <a href="{{ route('public.article.show', $article->slug) }}" target="_blank" class="action-btn action-btn-view" title="Lihat">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>
                                    @endif
                                    @if(Auth::user()->isSuperAdmin() || ($globalSettings['contributor_delete_without_permission'] ?? '1') === '1')
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message='Artikel {{ $article->title }} akan dihapus!' class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">description</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">
                                        @if(request('status') === 'pending')
                                            Tidak ada artikel yang menunggu persetujuan.
                                        @elseif(request('status') === 'rejected')
                                            Tidak ada artikel yang ditolak.
                                        @else
                                            Belum ada artikel.
                                        @endif
                                    </p>
                                    <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tulis Artikel Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($articles->hasPages())
        <div class="mt-6 pagination">
            {{ $articles->links() }}
        </div>
    @endif
@endsection
