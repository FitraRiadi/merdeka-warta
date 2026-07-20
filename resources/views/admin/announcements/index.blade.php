@extends('admin.layouts.admin')

@section('title', 'Pengumuman - Panel Admin')
@section('page_title', 'Pengumuman')
@section('page_description', 'Kelola pengumuman dan pemberitahuan')

@section('content')
    {{-- Header: total, search, sort, add --}}
    <div class="mb-6 space-y-3">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $announcements->total() }}</span> pengumuman
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <form method="GET" action="{{ route('admin.announcements.index') }}" class="relative flex-1 sm:flex-none min-w-[200px]">
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
                <input type="text" name="search" placeholder="Cari judul..." value="{{ request('search') }}"
                       class="admin-input pl-8 pr-8 py-1.5 text-sm w-full sm:w-48"
                       @keydown.enter="$el.form.submit()">
                <span class="material-symbols-outlined absolute left-2 top-1/2 -translate-y-1/2 text-sm text-on-surface-variant pointer-events-none">search</span>
                @if(request('search'))
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-2 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                @endif
            </form>

            <a href="{{ request()->fullUrlWithQuery(['sort' => request('sort') === 'oldest' ? 'newest' : 'oldest']) }}"
               class="flex items-center gap-1.5 px-3 py-1.5 border-2 border-on-background font-label-mono text-xs hover:bg-surface-container transition-colors whitespace-nowrap">
                <span class="material-symbols-outlined text-sm">{{ request('sort') === 'oldest' ? 'arrow_upward' : 'arrow_downward' }}</span>
                {{ request('sort') === 'oldest' ? 'Terlama' : 'Terbaru' }}
            </a>

            <a href="{{ route('admin.announcements.create') }}" class="admin-btn-primary admin-btn-sm whitespace-nowrap">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Pengumuman
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-center w-12">No</th>
                        <th class="text-left w-full min-w-0">Judul</th>
                        <th class="text-left hidden sm:table-cell">Tipe</th>
                        <th class="text-left hidden md:table-cell">Tanggal</th>
                        <th class="text-center hidden sm:table-cell">Pelihat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcements as $announcement)
                        <tr>
                            <td class="text-center font-label-mono text-xs text-on-surface-variant">{{ $announcements->firstItem() + $loop->index }}</td>
                            <td class="w-full min-w-0">
                                <div class="min-w-0">
                                    <a href="{{ route('admin.announcements.edit', $announcement) }}" class="font-body-md text-sm font-bold hover:text-primary truncate block">
                                        {{ $announcement->title }}
                                    </a>
                                    <p class="font-body-md text-xs text-on-surface-variant mt-0.5 truncate">
                                        {{ $announcement->content_text ? Str::limit($announcement->content_text, 80) : '(Konten kosong)' }}
                                    </p>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell">
                                @if($announcement->type === 'important')
                                    <span class="admin-badge bg-red-100 text-red-700 border-red-700">Penting</span>
                                @elseif($announcement->type === 'warning')
                                    <span class="admin-badge bg-orange-100 text-orange-700 border-orange-700">Peringatan</span>
                                @else
                                    <span class="admin-badge bg-blue-100 text-blue-700 border-blue-700">Info</span>
                                @endif
                            </td>
                            <td class="hidden md:table-cell">
                                <span class="font-label-mono text-xs text-on-surface-variant">
                                    {{ $announcement->created_at->format('d M Y') }}
                                </span>
                                @if($announcement->expired_at)
                                    <br><span class="text-error font-label-mono text-[10px]">Kedaluwarsa: {{ $announcement->expired_at->format('d M Y') }}</span>
                                @endif
                            </td>
                            <td class="text-center hidden sm:table-cell">
                                @if($announcement->views_count > 0)
                                    <div class="flex items-center justify-center gap-1 text-on-surface-variant" title="{{ $announcement->views_count }} pelihat">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        <span class="font-label-mono text-xs">{{ $announcement->views_count }}</span>
                                    </div>
                                @else
                                    <span class="text-on-surface-variant/40 font-label-mono text-xs">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($announcement->expired_at && $announcement->expired_at->isPast())
                                    <span class="admin-badge bg-red-100 text-red-700 border-red-700 text-[10px]">Kedaluwarsa</span>
                                @elseif($announcement->is_active)
                                    <span class="admin-badge bg-green-100 text-green-700 border-green-700 text-[10px]">Terbit</span>
                                @else
                                    <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400 text-[10px]">Draft</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.announcements.edit', $announcement) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <a href="{{ route('admin.announcements.show', $announcement) }}" class="action-btn action-btn-view" title="Lihat">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                    </a>
                                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message='Pengumuman {{ $announcement->title }} akan dihapus!' class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">campaign</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">
                                        @if(request('search'))
                                            Tidak ada pengumuman yang cocok dengan pencarian "{{ request('search') }}".
                                        @else
                                            Belum ada pengumuman.
                                        @endif
                                    </p>
                                    @unless(request('search'))
                                    <a href="{{ route('admin.announcements.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Buat Pengumuman</a>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($announcements->hasPages())
        <div class="mt-6 pagination">
            {{ $announcements->links() }}
        </div>
    @endif
@endsection
