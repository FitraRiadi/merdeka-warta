@extends('admin.layouts.admin')

@section('title', 'Sorotan - Panel Admin')
@section('page_title', 'Sorotan')
@section('page_description', 'Kelola sorotan artikel (maks. 3) dan sorotan pemberitahuan (maks. 1)')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Artikel: <span class="font-bold text-on-surface">{{ $articleSpotlights->total() }}</span>/3 &middot;
            Pemberitahuan: <span class="font-bold text-on-surface">{{ $announcementSpotlights->count() }}</span>/1
        </div>
        <a href="{{ route('admin.spotlights.manage') }}" class="admin-btn-primary admin-btn-sm">
            <span class="material-symbols-outlined text-sm">tune</span>
            Kelola Sorotan
        </a>
    </div>

    {{-- Article Spotlights --}}
    <div class="admin-card overflow-hidden mb-8">
        <div class="px-6 py-4 bg-primary-fixed-dim/20 border-b-3 border-on-background">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">stars</span>
                <h3 class="font-label-mono text-sm uppercase font-bold">Sorotan Artikel</h3>
                <span class="font-label-mono text-[10px] text-on-surface-variant">({{ $articleSpotlights->total() }}/3)</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Artikel</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articleSpotlights as $spotlight)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3 min-w-0">
                                    @if($spotlight->article?->image)
                                        <img src="{{ $spotlight->article->image }}" alt=""
                                            class="w-12 h-9 object-cover border-2 border-on-background flex-shrink-0">
                                    @else
                                        <div class="w-12 h-9 bg-primary border-2 border-on-background flex-shrink-0 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-on-primary text-sm">image</span>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-body-md text-sm font-bold truncate">
                                            {{ $spotlight->article?->title ?? '(Artikel tidak ditemukan)' }}
                                        </p>
                                        <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">
                                            {{ $spotlight->article?->published_at?->format('d M Y') ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">stars</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada sorotan artikel.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($articleSpotlights->hasPages())
        <div class="mt-6 pagination">
            {{ $articleSpotlights->links() }}
        </div>
    @endif

    {{-- Announcement Spotlights --}}
    <div class="admin-card overflow-hidden">
        <div class="px-6 py-4 bg-secondary-fixed/20 border-b-3 border-on-background">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary">campaign</span>
                <h3 class="font-label-mono text-sm uppercase font-bold">Sorotan Pemberitahuan</h3>
                <span class="font-label-mono text-[10px] text-on-surface-variant">({{ $announcementSpotlights->count() }}/1)</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Pemberitahuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcementSpotlights as $spotlight)
                        <tr>
                            <td>
                                <div class="min-w-0">
                                    <p class="font-body-md text-sm font-bold truncate">
                                        {{ $spotlight->announcement?->title ?? '(Pemberitahuan tidak ditemukan)' }}
                                    </p>
                                    <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">
                                        {{ $spotlight->announcement?->created_at?->format('d M Y') ?? '-' }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">campaign</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada sorotan pemberitahuan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
