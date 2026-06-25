@extends('admin.layouts.admin')

@section('title', $announcement->title . ' - Panel Admin')
@section('page_title', 'Detail Pengumuman')
@section('breadcrumb')
    <a href="{{ route('admin.announcements.index') }}" class="hover:text-primary transition-colors">Pengumuman</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $announcement->title }}</span>
@endsection

@section('content')
    <div class="max-w-3xl">
        <div class="admin-card p-6 md:p-8">
            <div class="flex flex-wrap items-center gap-3 mb-4 font-label-mono text-xs uppercase text-on-surface-variant">
                @if($announcement->type === 'important')
                    <span class="admin-badge bg-error-container text-error">Penting</span>
                @elseif($announcement->type === 'warning')
                    <span class="admin-badge bg-tertiary-fixed text-tertiary">Peringatan</span>
                @else
                    <span class="admin-badge bg-primary-fixed-dim text-primary">Info</span>
                @endif
                @if($announcement->is_active)
                    <span class="admin-badge bg-green-100 text-green-700 border-green-700 text-[10px]">Terbit</span>
                @else
                    <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400 text-[10px]">Draft</span>
                @endif
                <span>{{ $announcement->created_at->format('d M Y H:i') }}</span>
                @if($announcement->expired_at)
                    <span class="text-error">Kedaluwarsa: {{ $announcement->expired_at->format('d M Y') }}</span>
                @endif
            </div>

            <h1 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight mb-6">{{ $announcement->title }}</h1>

            <div class="prose prose-sm max-w-none">
                {!! $announcement->renderContent() !!}
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">edit</span>
                Edit
            </a>
            <a href="{{ route('admin.announcements.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali
            </a>
            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="ml-auto">
                @csrf @method('DELETE')
                <button type="submit" data-confirm-delete data-message='Pengumuman {{ $announcement->title }} akan dihapus!' class="admin-btn-danger admin-btn-sm">
                    <span class="material-symbols-outlined text-sm">delete</span>
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection
