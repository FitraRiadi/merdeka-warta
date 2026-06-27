@extends('admin.layouts.admin')

@section('title', 'Kontributor - Panel Admin')
@section('page_title', 'Kontributor')
@section('page_description', 'Kelola author dan kontributor')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $authors->total() }}</span> kontributor
        </div>
        <a href="{{ route('admin.users.create') }}" class="admin-btn-primary admin-btn-sm">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Kontributor
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Nama</th>
                        <th class="text-left hidden sm:table-cell">Email</th>
                        <th class="text-center hidden md:table-cell">Artikel</th>
                        <th class="text-left hidden lg:table-cell">Bergabung</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] shrink-0">
                                        <span class="material-symbols-outlined text-on-primary text-sm">person</span>
                                    </div>
                                    <div>
                                        <p class="font-body-md text-sm font-bold">{{ $author->name }}</p>
                                        <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">{{ $author->role }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell">
                                <span class="font-body-md text-sm text-on-surface-variant">{{ $author->email }}</span>
                            </td>
                            <td class="text-center hidden md:table-cell">
                                <span class="font-label-mono text-sm font-bold">{{ $author->articles()->count() }}</span>
                            </td>
                            <td class="hidden lg:table-cell">
                                <span class="font-label-mono text-xs text-on-surface-variant">{{ $author->created_at->format('d M Y') }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.users.edit', $author) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $author) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message='Kontributor {{ $author->name }} akan dihapus!' class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">group</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada kontributor.</p>
                                    <a href="{{ route('admin.users.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tambah Kontributor</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($authors->hasPages())
        <div class="mt-6 pagination">
            {{ $authors->links() }}
        </div>
    @endif
@endsection
