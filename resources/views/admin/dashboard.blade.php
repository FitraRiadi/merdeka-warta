@extends('admin.layouts.admin')

@section('title', 'Dashboard - Panel Admin')
@section('page_title', 'Dashboard')
@section('page_description', 'Ringkasan data dan aktivitas terbaru')

@section('content')
    @if(Auth::user()->isSuperAdmin() && isset($totalPending) && $totalPending > 0)
        <a href="{{ route('admin.articles.index', ['status' => 'pending']) }}" class="block bg-amber-50 border-3 border-amber-500 rounded-xl p-5 mb-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
            <div class="flex items-start gap-4">
                <span class="material-symbols-outlined text-3xl text-amber-600 shrink-0 mt-0.5">pending_actions</span>
                <div class="flex-1">
                    <p class="font-headline-lg text-lg uppercase text-amber-900">Perhatian!</p>
                    <p class="font-body-md text-sm text-amber-800 mt-1">
                        Terdapat <strong class="text-amber-900">{{ $totalPending }}</strong> artikel dari kontributor yang memerlukan persetujuan Anda.
                    </p>
                    <span class="inline-flex items-center gap-1 mt-3 font-label-mono text-xs uppercase text-amber-700 font-bold underline underline-offset-4">
                        Tinjau Sekarang
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </a>
    @endif

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

    {{-- Donut Chart Section --}}
    @if(Auth::user()->isSuperAdmin())
        @php
            $artPct = $totalViews > 0 ? round($articleViews / $totalViews * 100, 1) : 0;
            $annPct = max(0, 100 - $artPct);
        @endphp
        <div class="admin-card p-5 md:p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-8 h-8 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary text-sm">visibility</span>
                </span>
                <h2 class="font-headline-lg text-xl uppercase tracking-tight">Statistik Pelihat</h2>
            </div>
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex flex-col md:flex-row items-center gap-8 lg:w-1/2">
                    {{-- Donut SVG --}}
                    <div class="relative w-44 h-44 shrink-0">
                        <svg class="w-full h-full" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#e11d48" stroke-width="3.2" stroke-dasharray="100 0"/>
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#2563eb" stroke-width="3.2"
                                    stroke-dasharray="{{ $artPct }} {{ $annPct }}"
                                    stroke-dashoffset="25"@if($artPct > 0 && $artPct < 100) stroke-linecap="round"@endif/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $totalViews }}</span>
                            <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Total Dilihat</span>
                        </div>
                    </div>
                    {{-- Legend --}}
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3 px-4 py-3 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="w-5 h-5 bg-blue-600 border-2 border-on-background shrink-0"></span>
                            <div>
                                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Artikel Dilihat</p>
                                <p class="font-headline-lg text-xl tracking-tight">{{ $articleViews }} <span class="font-label-mono text-xs text-on-surface-variant">({{ $totalViews > 0 ? round($articleViews / $totalViews * 100) : 0 }}%)</span></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="w-5 h-5 bg-pink-600 border-2 border-on-background shrink-0"></span>
                            <div>
                                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Pengumuman Dilihat</p>
                                <p class="font-headline-lg text-xl tracking-tight">{{ $announcementViews }} <span class="font-label-mono text-xs text-on-surface-variant">({{ $totalViews > 0 ? round($announcementViews / $totalViews * 100) : 0 }}%)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Trending Articles --}}
                <div class="lg:w-1/2 border-t lg:border-t-0 lg:border-l border-on-background/10 pt-6 lg:pt-0 lg:pl-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-sm text-secondary">trending_up</span>
                        <h3 class="font-label-mono text-[11px] uppercase tracking-wider">Artikel Yang Paling Banyak Dilihat</h3>
                    </div>
                    <div class="space-y-3">
                        @forelse($trendingArticles as $ta)
                            <a href="{{ route('admin.articles.edit', $ta) }}" class="flex items-center gap-3 p-2.5 border-2 border-on-background hover:bg-primary-fixed-dim/10 transition-all shadow-[1px_1px_0px_0px_rgba(0,0,0,0.1)] group">
                                <span class="w-7 h-7 flex items-center justify-center font-headline-lg text-sm {{ $loop->iteration <= 3 ? 'text-secondary' : 'text-on-surface-variant' }}">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="flex-1 min-w-0">
                                    <p class="font-body-md text-xs font-bold truncate group-hover:text-primary transition-colors">{{ $ta->title }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="flex items-center gap-0.5 font-label-mono text-[10px] text-on-surface-variant">
                                            <span class="material-symbols-outlined text-[10px]">visibility</span>
                                            {{ $ta->views_count }}
                                        </span>
                                        <span class="font-label-mono text-[10px] text-on-surface-variant">{{ $ta->display_author }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">trending_up</span>
                                <p class="font-body-md text-sm text-on-surface-variant mt-2">Belum ada artikel yang dilihat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @else
        @php
            $authFullPct = $authorTotalArticles > 0
                ? min(100, round($authorArticleViews / max($authorTotalArticles, 1) * 100, 1))
                : 0;
            $authRemainingPct = max(0, 100 - $authFullPct);
        @endphp
        <div class="admin-card p-5 md:p-6 mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-8 h-8 bg-green-600 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">visibility</span>
                </span>
                <h2 class="font-headline-lg text-xl uppercase tracking-tight">Statistik Pelihat Artikel Saya</h2>
            </div>
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex flex-col md:flex-row items-center gap-8 lg:w-1/2">
                    <div class="relative w-44 h-44 shrink-0">
                        <svg class="w-full h-full" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#d1d5db" stroke-width="3.2" stroke-dasharray="100 0"/>
                            <circle cx="18" cy="18" r="15.9" fill="none" stroke="#16a34a" stroke-width="3.2"
                                    stroke-dasharray="{{ $authFullPct }} {{ $authRemainingPct }}"
                                    stroke-dashoffset="25"@if($authFullPct > 0 && $authFullPct < 100) stroke-linecap="round"@endif/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="font-headline-lg text-3xl md:text-4xl tracking-tight">{{ $authorArticleViews }}</span>
                            <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Dilihat</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-3 px-4 py-3 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="w-5 h-5 bg-green-600 border-2 border-on-background shrink-0"></span>
                            <div>
                                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Artikel Saya Dilihat</p>
                                <p class="font-headline-lg text-xl tracking-tight">{{ $authorArticleViews }} <span class="font-label-mono text-xs text-on-surface-variant">kali</span></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="w-5 h-5 bg-gray-300 dark:bg-gray-600 border-2 border-on-background shrink-0"></span>
                            <div>
                                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Total Artikel Saya</p>
                                <p class="font-headline-lg text-xl tracking-tight">{{ $authorTotalArticles }} <span class="font-label-mono text-xs text-on-surface-variant">artikel</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Trending Articles --}}
                <div class="lg:w-1/2 border-t lg:border-t-0 lg:border-l border-on-background/10 pt-6 lg:pt-0 lg:pl-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-sm text-secondary">trending_up</span>
                        <h3 class="font-label-mono text-[11px] uppercase tracking-wider">Artikel Saya Yang Paling Banyak Dilihat</h3>
                    </div>
                    <div class="space-y-3">
                        @forelse($trendingArticles as $ta)
                            <a href="{{ route('admin.articles.edit', $ta) }}" class="flex items-center gap-3 p-2.5 border-2 border-on-background hover:bg-primary-fixed-dim/10 transition-all shadow-[1px_1px_0px_0px_rgba(0,0,0,0.1)] group">
                                <span class="w-7 h-7 flex items-center justify-center font-headline-lg text-sm {{ $loop->iteration <= 3 ? 'text-secondary' : 'text-on-surface-variant' }}">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="flex-1 min-w-0">
                                    <p class="font-body-md text-xs font-bold truncate group-hover:text-primary transition-colors">{{ $ta->title }}</p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="flex items-center gap-0.5 font-label-mono text-[10px] text-on-surface-variant">
                                            <span class="material-symbols-outlined text-[10px]">visibility</span>
                                            {{ $ta->views_count }}
                                        </span>
                                        <span class="font-label-mono text-[10px] text-on-surface-variant">{{ $ta->display_author }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8">
                                <span class="material-symbols-outlined text-2xl text-on-surface-variant">trending_up</span>
                                <p class="font-body-md text-sm text-on-surface-variant mt-2">Artikel mu belum ada yang populer.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                                        {{ $article->display_author }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">visibility</span>
                                        {{ $article->views_count }}
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
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">visibility</span>
                                        {{ $announcement->views_count }}
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
                                        {{ $article->display_author }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">visibility</span>
                                        {{ $article->views_count }}
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
