@extends('layouts.admin')

@section('title', 'Dashboard')

@section('subtitle', Auth::user()->isSuperAdmin() ? 'Overview seluruh data' : 'Overview artikel Anda')

@section('content')

    @php $isSuperAdmin = Auth::user()->isSuperAdmin(); @endphp

    {{-- ============================================================ --}}
    {{-- HEADER SECTION --}}
    {{-- ============================================================ --}}
    <section class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="font-headline-lg text-5xl md:text-6xl uppercase text-on-background tracking-tighter">Dashboard Overview</h2>
            <div class="flex items-center gap-2 mt-1">
                <span class="w-3 h-3 bg-error animate-pulse"></span>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- STATISTICS GRID --}}
    {{-- ============================================================ --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Stat Card 1: Total Artikel --}}
        <div class="bg-primary-container p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:rotate-12 transition-transform">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">description</span>
                </div>
                @if($totalArticles > 0)
                    <span class="bg-white border-[3px] border-on-background font-label-mono text-[10px] px-2 py-0.5 sticker-tilt-right">{{ $totalPublished }}/{{ $totalArticles }}</span>
                @endif
            </div>
            <p class="font-label-mono text-on-primary-container text-xs uppercase opacity-80 font-bold mb-1">Total Articles</p>
            <p class="font-display-xl text-5xl text-on-primary-container" style="font-family: 'Anton', sans-serif;">{{ $totalArticles }}</p>
        </div>

        @if($isSuperAdmin)
            {{-- Stat Card 2: Total Pengumuman --}}
            <div class="bg-secondary-container p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:-rotate-12 transition-transform">
                        <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">campaign</span>
                    </div>
                    <span class="bg-white border-[3px] border-on-background font-label-mono text-[10px] px-2 py-0.5 sticker-tilt-left">HOT</span>
                </div>
                <p class="font-label-mono text-on-secondary-container text-xs uppercase opacity-80 font-bold mb-1">Total Pemberitahuan</p>
                <p class="font-display-xl text-5xl text-on-secondary-container" style="font-family: 'Anton', sans-serif;">{{ $totalAnnouncements }}</p>
            </div>

            {{-- Stat Card 3: Konsep / Draft --}}
            <div class="bg-tertiary-container p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-on-tertiary-container group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-tertiary text-3xl" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
                    </div>
                    @if($totalArticles > 0 && $totalDraft > 0)
                        <span class="bg-error border-[3px] border-on-background text-white font-label-mono text-[10px] px-2 py-0.5">ACTION REQ</span>
                    @endif
                </div>
                <p class="font-label-mono text-xs uppercase opacity-80 font-bold mb-1">Konsep / Draft</p>
                <p class="font-display-xl text-5xl" style="font-family: 'Anton', sans-serif;">{{ $totalDraft }}</p>
            </div>

            {{-- Stat Card 4: Penulis --}}
            <div class="bg-surface-container-highest p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:skew-x-12 transition-transform">
                        <span class="material-symbols-outlined text-on-background text-3xl" style="font-variation-settings: 'FILL' 1;">group</span>
                    </div>
                    @if($totalAuthors > 0)
                        <span class="bg-white border-[3px] border-on-background font-label-mono text-[10px] px-2 py-0.5 sticker-tilt-right">{{ $totalAuthors }}</span>
                    @endif
                </div>
                <p class="font-label-mono text-on-background text-xs uppercase opacity-80 font-bold mb-1">Kontributor</p>
                <p class="font-display-xl text-5xl text-on-background" style="font-family: 'Anton', sans-serif;">{{ $totalAuthors }}</p>
            </div>
        @else
            {{-- Author view: Published + Draft + Total --}}
            <div class="bg-secondary-container p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:-rotate-12 transition-transform">
                        <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                </div>
                <p class="font-label-mono text-on-secondary-container text-xs uppercase opacity-80 font-bold mb-1">Dipublikasikan</p>
                <p class="font-display-xl text-5xl text-on-secondary-container" style="font-family: 'Anton', sans-serif;">{{ $totalPublished }}</p>
            </div>
            <div class="bg-tertiary-container p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] text-on-tertiary-container group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-tertiary text-3xl" style="font-variation-settings: 'FILL' 1;">pending_actions</span>
                    </div>
                </div>
                <p class="font-label-mono text-xs uppercase opacity-80 font-bold mb-1">Konsep</p>
                <p class="font-display-xl text-5xl" style="font-family: 'Anton', sans-serif;">{{ $totalDraft }}</p>
            </div>
            <div class="bg-surface-container-highest p-6 border-[3px] border-on-background brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] group">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 bg-white border-[3px] border-on-background flex items-center justify-center group-hover:skew-x-12 transition-transform">
                        <span class="material-symbols-outlined text-on-background text-3xl" style="font-variation-settings: 'FILL' 1;">description</span>
                    </div>
                </div>
                <p class="font-label-mono text-on-background text-xs uppercase opacity-80 font-bold mb-1">Total Tulisan</p>
                <p class="font-display-xl text-5xl text-on-background" style="font-family: 'Anton', sans-serif;">{{ $totalArticles }}</p>
            </div>
        @endif
    </section>

    {{-- ============================================================ --}}
    {{-- MAIN MIDDLE GRID --}}
    {{-- ============================================================ --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        {{-- Recent Articles (2/3 width) --}}
        <div class="lg:col-span-2 flex flex-col bg-surface border-[3px] border-on-background brutalist-shadow min-h-[400px]">
            <div class="p-6 border-b-[3px] border-on-background flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h3 class="font-headline-lg text-3xl uppercase">Recent Articles</h3>
                <a href="{{ route('admin.articles.index') }}">
                    <span class="font-label-mono text-xs uppercase text-primary hover:text-primary-container transition-colors">View All →</span>
                </a>
            </div>
            <div class="flex-1 overflow-auto max-h-[450px]">
                @if($recentArticles->isNotEmpty())
                    <table class="w-full text-left font-label-mono text-sm min-w-[600px]">
                        <thead>
                            <tr class="bg-surface-container-low border-b-[3px] border-on-background sticky top-0 z-10">
                                <th class="p-4 uppercase">Date</th>
                                <th class="p-4 uppercase">Author</th>
                                <th class="p-4 uppercase">Title</th>
                                <th class="p-4 uppercase">Status</th>
                                <th class="p-4 uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-[3px] divide-on-background/10">
                            @foreach($recentArticles as $article)
                                <tr class="hover:bg-primary-container/10 transition-colors group">
                                    <td class="p-4 font-bold text-sm">{{ $article->published_at ? $article->published_at->format('d M') : '-' }}</td>
                                    <td class="p-4">
                                        <span class="font-bold text-sm">{{ $article->author ? $article->author->name : '-' }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-sm max-w-xs truncate">{{ $article->title }}</td>
                                    <td class="p-4">
                                        @if($article->is_published)
                                            <span class="badge bg-primary-container text-on-primary-container">PUBLISHED</span>
                                        @else
                                            <span class="badge bg-tertiary-container text-on-tertiary-container">DRAFT</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('admin.articles.show', $article) }}" class="inline-flex w-8 h-8 items-center justify-center bg-on-background text-white hover:bg-primary transition-colors" title="View">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="flex flex-col items-center justify-center py-16 px-4">
                        <div class="w-16 h-16 bg-surface-container border-[3px] border-on-background flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-3xl text-on-background">description</span>
                        </div>
                        <p class="font-label-mono text-sm uppercase opacity-60 mb-2">Belum ada artikel</p>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary text-sm">Buat Artikel</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Quick Management (1/3 width) --}}
        <div class="space-y-6">
            <h3 class="font-headline-lg text-3xl uppercase">Quick Management</h3>
            <div class="grid grid-cols-1 gap-4">
                <a href="{{ route('admin.articles.create') }}" class="w-full bg-primary-container text-on-primary-container border-[3px] border-on-background p-4 flex items-center gap-4 brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-1 active:translate-y-1 group relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-8xl">post_add</span>
                    </div>
                    <span class="material-symbols-outlined text-4xl bg-surface text-primary border-[3px] border-on-background p-2">post_add</span>
                    <span class="font-headline-lg text-xl uppercase tracking-tight">CRUD Articles</span>
                </a>
                @if($isSuperAdmin)
                    <a href="{{ route('admin.announcements.create') }}" class="w-full bg-secondary-container text-on-secondary-container border-[3px] border-on-background p-4 flex items-center gap-4 brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-1 active:translate-y-1 group relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-8xl">notification_add</span>
                        </div>
                        <span class="material-symbols-outlined text-4xl bg-surface text-secondary border-[3px] border-on-background p-2">notification_add</span>
                        <span class="font-headline-lg text-xl uppercase tracking-tight">CRUD Pemberitahuan</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="w-full bg-[#fb923c] text-on-background border-[3px] border-on-background p-4 flex items-center gap-4 brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-1 active:translate-y-1 group relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-8xl">person_add</span>
                        </div>
                        <span class="material-symbols-outlined text-4xl bg-surface text-[#ea580c] border-[3px] border-on-background p-2">person_add</span>
                        <span class="font-headline-lg text-xl uppercase tracking-tight">CRUD Kontributor</span>
                    </a>
                @endif
                <a href="{{ route('admin.articles.index') }}" class="w-full bg-surface-container-highest border-[3px] border-on-background p-4 flex items-center gap-4 brutalist-shadow transition-all hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-1 active:translate-y-1 group relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-8xl">manage_search</span>
                    </div>
                    <span class="material-symbols-outlined text-4xl bg-surface text-on-background border-[3px] border-on-background p-2">manage_search</span>
                    <span class="font-headline-lg text-xl uppercase tracking-tight">Manage Articles</span>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- RUNNING TEXT MONITOR (super admin) --}}
    {{-- ============================================================ --}}
    @if($isSuperAdmin)
        <section class="grid grid-cols-1 gap-8">
            <div class="space-y-6">
                <h3 class="font-headline-lg text-3xl uppercase">Running Text Monitor</h3>
                <div class="bg-surface border-[3px] border-on-background p-6 brutalist-shadow">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-label-mono font-bold uppercase flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">campaign</span> TICKER ENTRIES
                        </h4>
                        <a href="{{ route('admin.running-texts.create') }}" class="font-label-mono text-xs uppercase text-primary hover:text-primary-container transition-colors">+ Add New</a>
                    </div>
                    @if(isset($runningTexts) && $runningTexts->isNotEmpty())
                        <div class="space-y-3">
                            @foreach($runningTexts as $rt)
                                <div class="flex items-center gap-3 bg-surface-container-low border-[3px] border-on-background p-3">
                                    <span class="font-label-mono font-bold text-sm text-on-background/40">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="w-10 h-10 flex items-center justify-center bg-surface border-[3px] border-on-background shrink-0">
                                        <span class="material-symbols-outlined text-sm" style="color: {{ $rt->text_color ?? '#191c1d' }};">campaign</span>
                                    </div>
                                    <span class="flex-1 font-bold text-sm truncate">{{ $rt->text }}</span>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.running-texts.edit', $rt) }}" class="material-symbols-outlined text-sm hover:text-primary transition-colors">edit</a>
                                        <form method="POST" action="{{ route('admin.running-texts.destroy', $rt) }}" class="inline" onsubmit="return confirm('Hapus running text ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="material-symbols-outlined text-sm hover:text-error transition-colors cursor-pointer">delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('admin.running-texts.index') }}" class="w-full bg-on-background text-surface p-3 font-headline-lg text-xl uppercase brutalist-shadow-active hover:bg-secondary transition-colors text-center block">Manage All</a>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10">
                            <div class="w-14 h-14 bg-surface-container border-[3px] border-on-background flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-2xl">campaign</span>
                            </div>
                            <p class="font-label-mono text-sm uppercase opacity-60 mb-3">Belum ada running text</p>
                            <a href="{{ route('admin.running-texts.create') }}" class="btn btn-primary text-sm">+ Add Running Text</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- ============================================================ --}}
    {{-- RECENT ANNOUNCEMENTS (super admin) --}}
    {{-- ============================================================ --}}
    @if($isSuperAdmin && isset($recentAnnouncements) && $recentAnnouncements->isNotEmpty())
        <section>
            <div class="bg-surface border-[3px] border-on-background p-6 brutalist-shadow">
                <div class="flex justify-between items-center mb-6">
                    <h4 class="font-label-mono font-bold uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">campaign</span> Latest Announcements
                    </h4>
                    <a href="{{ route('admin.announcements.index') }}" class="font-label-mono text-xs uppercase text-primary">View All →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($recentAnnouncements as $ann)
                        <div class="flex items-start gap-3 p-4 bg-secondary-container/20 border-[3px] border-on-background">
                            <div class="w-10 h-10 bg-secondary-container border-[3px] border-on-background flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-sm text-on-secondary-container">campaign</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-sm text-on-background truncate">{{ $ann->title }}</p>
                                <p class="font-label-mono text-[10px] opacity-60 mt-0.5">{{ $ann->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
