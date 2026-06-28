@extends('admin.layouts.admin')

@section('title', 'Dashboard - Panel Admin')
@section('page_title', 'Dashboard')
@section('page_description', 'Ringkasan data dan aktivitas terbaru')

@section('content')
    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="admin-card stat-card stat-card-blue p-4 md:p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="font-label-mono text-[10px] uppercase text-primary font-bold tracking-wider">Total Artikel</span>
                <span class="w-9 h-9 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary text-sm">description</span>
                </span>
            </div>
            <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalArticles }}</p>
        </div>

        <div class="admin-card stat-card stat-card-green p-4 md:p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="font-label-mono text-[10px] uppercase text-green-700 dark:text-green-400 font-bold tracking-wider">Terbit</span>
                <span class="w-9 h-9 bg-green-600 dark:bg-green-700 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">publish</span>
                </span>
            </div>
            <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalPublished }}</p>
        </div>

        <div class="admin-card stat-card stat-card-orange p-4 md:p-5">
            <div class="flex items-center justify-between mb-3">
                <span class="font-label-mono text-[10px] uppercase text-orange-800 dark:text-orange-400 font-bold tracking-wider">Draft</span>
                <span class="w-9 h-9 bg-orange-600 dark:bg-orange-700 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">edit_note</span>
                </span>
            </div>
            <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalDraft }}</p>
        </div>

        @if(Auth::user()->isSuperAdmin())
            <div class="admin-card stat-card stat-card-pink p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-mono text-[10px] uppercase text-secondary font-bold tracking-wider">Pengumuman</span>
                    <span class="w-9 h-9 bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-secondary text-sm">campaign</span>
                        </span>
                    </div>
                    <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalAnnouncements }}</p>
            </div>

            <div class="admin-card stat-card stat-card-purple p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-mono text-[10px] uppercase text-purple-700 dark:text-purple-400 font-bold tracking-wider">Running Text</span>
                    <span class="w-9 h-9 bg-purple-700 dark:bg-purple-800 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined text-white text-sm">format_list_bulleted</span>
                    </span>
                </div>
                <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalRunningTexts }}</p>
            </div>

            <div class="admin-card stat-card stat-card-teal p-4 md:p-5">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-label-mono text-[10px] uppercase text-teal-700 dark:text-teal-400 font-bold tracking-wider">Kontributor</span>
                    <span class="w-9 h-9 bg-teal-700 dark:bg-teal-800 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined text-white text-sm">group</span>
                    </span>
                </div>
                <p class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalAuthors }}</p>
            </div>
        @endif
    </div>

    @if(Auth::user()->isSuperAdmin())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent Articles --}}
            <div class="admin-card overflow-hidden">
                <div class="border-b-3 border-on-background bg-primary-fixed-dim/20 px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary text-xs">description</span>
                        </span>
                        <h2 class="font-headline-lg text-lg uppercase tracking-tight">Artikel Terbaru</h2>
                    </div>
                    <a href="{{ route('admin.articles.index') }}" class="font-label-mono text-xs uppercase text-primary hover:text-primary-container transition-colors flex items-center gap-1">
                        Lihat Semua
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
                <div class="p-5 divide-y-2 divide-on-background/10">
                    @forelse($recentArticles as $article)
                        <div class="flex items-start justify-between py-3 first:pt-0 last:pb-0">
                            <div class="flex-1 min-w-0 mr-4">
                                <p class="font-body-md text-sm font-bold truncate hover:text-primary transition-colors">
                                    <a href="{{ route('admin.articles.edit', $article) }}">{{ $article->title }}</a>
                                </p>
                                <div class="flex items-center gap-3 mt-1.5 font-label-mono text-[10px] uppercase text-on-surface-variant">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">person</span>
                                        {{ $article->author?->name ?? 'Tanpa Penulis' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                                    </span>
                                    @if($article->is_published)
                                        <span class="admin-badge bg-green-100 text-green-700 border-green-700">Terbit</span>
                                    @else
                                        <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400">Draft</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="action-btn action-btn-edit shrink-0">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="empty-state-icon">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">description</span>
                            </div>
                            <p class="font-body-md text-sm text-on-surface-variant">Belum ada artikel.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Announcements --}}
            <div class="admin-card overflow-hidden">
                <div class="border-b-3 border-on-background bg-secondary-fixed/20 px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-secondary text-xs">campaign</span>
                        </span>
                        <h2 class="font-headline-lg text-lg uppercase tracking-tight">Pengumuman Terbaru</h2>
                    </div>
                    <a href="{{ route('admin.announcements.index') }}" class="font-label-mono text-xs uppercase text-primary hover:text-primary-container transition-colors flex items-center gap-1">
                        Lihat Semua
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
                <div class="p-5 divide-y-2 divide-on-background/10">
                    @forelse($recentAnnouncements as $announcement)
                        <div class="flex items-start justify-between py-3 first:pt-0 last:pb-0">
                            <div class="flex-1 min-w-0 mr-4">
                                <p class="font-body-md text-sm font-bold truncate hover:text-primary transition-colors">
                                    <a href="{{ route('admin.announcements.edit', $announcement) }}">{{ $announcement->title }}</a>
                                </p>
                                <div class="flex items-center gap-3 mt-1.5 font-label-mono text-[10px] uppercase text-on-surface-variant">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $announcement->created_at->format('d M Y') }}
                                    </span>
                                    @if($announcement->type === 'important')
                                        <span class="admin-badge bg-red-100 text-red-700 border-red-700">Penting</span>
                                    @elseif($announcement->type === 'warning')
                                        <span class="admin-badge bg-orange-100 text-orange-700 border-orange-700">Peringatan</span>
                                    @else
                                        <span class="admin-badge bg-blue-100 text-blue-700 border-blue-700">Info</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="action-btn action-btn-edit shrink-0">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="empty-state-icon">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">campaign</span>
                            </div>
                            <p class="font-body-md text-sm text-on-surface-variant">Belum ada pengumuman.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Running Texts Preview --}}
        @if($runningTexts->isNotEmpty())
            <div class="admin-card overflow-hidden mt-6">
                <div class="border-b-3 border-on-background bg-purple-100/30 dark:bg-purple-900/20 px-5 py-4">
                    <div class="flex items-center gap-3 justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 bg-purple-700 dark:bg-purple-800 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-white text-xs">format_list_bulleted</span>
                            </span>
                            <h2 class="font-headline-lg text-lg uppercase tracking-tight">Running Text Aktif</h2>
                        </div>
                        <a href="{{ route('admin.running-texts.index') }}" class="admin-btn-primary admin-btn-sm">
                            <span class="material-symbols-outlined text-sm">settings</span>
                            Manage Running Text
                        </a>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($runningTexts as $rt)
                            <div class="flex items-center gap-3 p-3 border-2 border-on-background bg-purple-50/50 dark:bg-purple-950/40 dark:border-gray-600 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.08)]">
                                <span class="w-8 h-8 rounded-full bg-purple-700 dark:bg-purple-800 border-2 border-on-background dark:border-gray-600 flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)]">
                                    <span class="material-symbols-outlined text-white text-sm">stars</span>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="font-body-md text-sm font-bold truncate">{{ $rt->text }}</p>
                                </div>
                                <a href="{{ route('admin.running-texts.edit', $rt) }}" class="action-btn action-btn-edit shrink-0" title="Edit">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent Articles --}}
            <div class="admin-card overflow-hidden">
                <div class="border-b-3 border-on-background bg-primary-fixed-dim/20 px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary text-xs">description</span>
                        </span>
                        <h2 class="font-headline-lg text-lg uppercase tracking-tight">Artikel Terbaru</h2>
                    </div>
                    <a href="{{ route('admin.articles.index') }}" class="font-label-mono text-xs uppercase text-primary hover:text-primary-container transition-colors flex items-center gap-1">
                        Lihat Semua
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
                <div class="p-5 divide-y-2 divide-on-background/10">
                    @forelse($recentArticles as $article)
                        <div class="flex items-start justify-between py-3 first:pt-0 last:pb-0">
                            <div class="flex-1 min-w-0 mr-4">
                                <p class="font-body-md text-sm font-bold truncate hover:text-primary transition-colors">
                                    <a href="{{ route('admin.articles.edit', $article) }}">{{ $article->title }}</a>
                                </p>
                                <div class="flex items-center gap-3 mt-1.5 font-label-mono text-[10px] uppercase text-on-surface-variant">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">person</span>
                                        {{ $article->author?->name ?? 'Tanpa Penulis' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                                    </span>
                                    @if($article->is_published)
                                        <span class="admin-badge bg-green-100 text-green-700 border-green-700">Terbit</span>
                                    @else
                                        <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400">Draft</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="action-btn action-btn-edit shrink-0">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="empty-state-icon">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">description</span>
                            </div>
                            <p class="font-body-md text-sm text-on-surface-variant">Belum ada artikel.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Activity Log --}}
            <div class="admin-card overflow-hidden">
                <div class="border-b-3 border-on-background bg-surface-container-highest/50 px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 bg-tertiary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-tertiary text-xs">history</span>
                        </span>
                        <h2 class="font-headline-lg text-lg uppercase tracking-tight">Aktivitas Terbaru</h2>
                    </div>
                </div>
                <div class="p-5 divide-y-2 divide-on-background/10">
                    @forelse($activityLogs as $log)
                        <div class="flex items-start gap-3 py-3 first:pt-0 last:pb-0">
                            @if($log->action === 'EXPIRED')
                                <span class="w-7 h-7 rounded-full bg-surface-container-highest border-2 border-on-background flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)]">
                                    <span class="material-symbols-outlined text-on-surface-variant text-xs">schedule</span>
                                </span>
                            @else
                                <span class="w-7 h-7 rounded-full border-2 border-on-background flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)] @if($log->user->isSuperAdmin()) bg-primary @else bg-green-600 dark:bg-green-700 @endif">
                                    <span class="material-symbols-outlined text-white text-xs">person</span>
                                </span>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="font-body-md text-sm leading-tight">
                                    @if($log->action === 'EXPIRED')
                                        <span class="text-on-surface-variant">{!! $log->description !!}</span>
                                    @else
                                        <span class="font-bold">{{ $log->user->name }}</span>
                                        <span class="text-on-surface-variant">{!! $log->description !!}</span>
                                    @endif
                                </p>
                                <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                            @php
                                $badgeClass = match($log->action) {
                                    'CREATED' => 'bg-green-100 text-green-700 border-green-700',
                                    'UPDATED' => 'bg-blue-100 text-blue-700 border-blue-700',
                                    'DELETED' => 'bg-red-100 text-red-700 border-red-700',
                                    'SIGN_IN' => 'bg-teal-100 text-teal-700 border-teal-700',
                                    'SIGN_OUT' => 'bg-orange-100 text-orange-700 border-orange-700',
                                    'EXPIRED' => 'bg-purple-100 text-purple-700 border-purple-700',
                                    default => 'bg-gray-100 text-gray-600 border-gray-400',
                                };
                            @endphp
                            <span class="admin-badge {{ $badgeClass }} text-[10px] shrink-0">{{ $log->action }}</span>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="empty-state-icon">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">history</span>
                            </div>
                            <p class="font-body-md text-sm text-on-surface-variant">Belum ada aktivitas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    {{-- Activity Log (Super Admin: below running text) --}}
    @if(Auth::user()->isSuperAdmin())
        <div class="admin-card overflow-hidden mt-6">
            <div class="border-b-3 border-on-background bg-surface-container-highest/50 px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 bg-tertiary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined text-white text-xs">history</span>
                    </span>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Aktivitas Terbaru</h2>
                </div>
            </div>
            <div class="p-5 divide-y-2 divide-on-background/10">
                @forelse($activityLogs as $log)
                    <div class="flex items-start gap-3 py-3 first:pt-0 last:pb-0">
                        @if($log->action === 'EXPIRED')
                            <span class="w-7 h-7 rounded-full bg-surface-container-highest border-2 border-on-background flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)]">
                                <span class="material-symbols-outlined text-on-surface-variant text-xs">schedule</span>
                            </span>
                        @else
                            <span class="w-7 h-7 rounded-full border-2 border-on-background flex items-center justify-center shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)] @if($log->user->isSuperAdmin()) bg-primary @else bg-green-600 @endif">
                                <span class="material-symbols-outlined text-white text-xs">person</span>
                            </span>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-body-md text-sm leading-tight">
                                @if($log->action === 'EXPIRED')
                                    <span class="text-on-surface-variant">{!! $log->description !!}</span>
                                @else
                                    <span class="font-bold">{{ $log->user->name }}</span>
                                    <span class="text-on-surface-variant">{!! $log->description !!}</span>
                                @endif
                            </p>
                            <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                        @php
                            $badgeClass = match($log->action) {
                                'CREATED' => 'bg-green-100 text-green-700 border-green-700',
                                'UPDATED' => 'bg-blue-100 text-blue-700 border-blue-700',
                                'DELETED' => 'bg-red-100 text-red-700 border-red-700',
                                'SIGN_IN' => 'bg-teal-100 text-teal-700 border-teal-700',
                                'SIGN_OUT' => 'bg-orange-100 text-orange-700 border-orange-700',
                                'EXPIRED' => 'bg-purple-100 text-purple-700 border-purple-700',
                                default => 'bg-gray-100 text-gray-600 border-gray-400',
                            };
                        @endphp
                        <span class="admin-badge {{ $badgeClass }} text-[10px] shrink-0">{{ $log->action }}</span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="empty-state-icon">
                            <span class="material-symbols-outlined text-2xl text-on-surface-variant">history</span>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant">Belum ada aktivitas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

@endsection
