@extends('admin.layouts.admin')

@section('title', 'Running Text - Panel Admin')
@section('page_title', 'Running Text')
@section('page_description', 'Kelola teks berjalan di halaman utama')

@section('content')
    @php $totalRunning = $runningTexts->total(); @endphp
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $totalRunning }}</span> / <span class="text-on-surface-variant">4</span> teks
            @if($totalRunning >= 4)
                <span class="text-error ml-2">(penuh)</span>
            @endif
        </div>
        <a href="{{ route('admin.running-texts.create') }}"
           class="admin-btn-primary admin-btn-sm {{ $totalRunning >= 4 ? 'opacity-40 pointer-events-none' : '' }}">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Running Text
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Teks</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($runningTexts as $rt)
                        <tr>
                            <td>
                                <span class="font-body-md text-sm font-bold">{{ $rt->text }}</span>
                            </td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.running-texts.edit', $rt) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.running-texts.destroy', $rt) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message="Running text ini akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">format_list_bulleted</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada running text.</p>
                                    @if($totalRunning < 4)
                                        <a href="{{ route('admin.running-texts.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tambah Running Text</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($runningTexts->hasPages())
        <div class="mt-6 pagination">
            {{ $runningTexts->links() }}
        </div>
    @endif
@endsection
