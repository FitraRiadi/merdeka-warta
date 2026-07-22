<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Artikel | Merdeka Warta</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "var(--tertiary-container)", "surface-variant": "var(--surface-variant)", "on-background": "var(--on-background)",
                        "background": "var(--background)", "on-tertiary-container": "var(--on-tertiary-container)", "error": "var(--error)",
                        "on-error": "var(--on-error)", "on-secondary-container": "var(--on-secondary-container)", "on-primary-container": "var(--on-primary-container)",
                        "secondary": "var(--secondary)", "surface": "var(--surface)", "error-container": "var(--error-container)",
                        "inverse-primary": "var(--inverse-primary)", "tertiary-fixed-dim": "var(--tertiary-fixed-dim)", "tertiary-fixed": "var(--tertiary-fixed)",
                        "tertiary": "var(--tertiary)", "on-secondary": "var(--on-secondary)", "surface-container-highest": "var(--surface-container-highest)",
                        "outline-variant": "var(--outline-variant)", "on-tertiary-fixed": "var(--on-tertiary-fixed)", "secondary-fixed": "var(--secondary-fixed)",
                        "surface-container-lowest": "var(--surface-container-lowest)", "secondary-fixed-dim": "var(--secondary-fixed-dim)",
                        "on-error-container": "var(--on-error-container)", "outline": "var(--outline)", "primary": "var(--primary)",
                        "surface-container": "var(--surface-container)", "surface-container-high": "var(--surface-container-high)", "surface-dim": "var(--surface-dim)",
                        "inverse-surface": "var(--inverse-surface)", "on-primary-fixed": "var(--on-primary-fixed)", "on-tertiary-fixed-variant": "var(--on-tertiary-fixed-variant)",
                        "on-tertiary": "var(--on-tertiary)", "on-surface-variant": "var(--on-surface-variant)", "primary-container": "var(--primary-container)",
                        "surface-container-low": "var(--surface-container-low)", "on-surface": "var(--on-surface)", "primary-fixed-dim": "var(--primary-fixed-dim)",
                        "on-secondary-fixed-variant": "var(--on-secondary-fixed-variant)", "on-secondary-fixed": "var(--on-secondary-fixed)",
                        "inverse-on-surface": "var(--inverse-on-surface)", "on-primary": "var(--on-primary)", "secondary-container": "var(--secondary-container)",
                        "primary-fixed": "var(--primary-fixed)", "surface-tint": "var(--surface-tint)", "on-primary-fixed-variant": "var(--on-primary-fixed-variant)",
                        "surface-bright": "var(--surface-bright)"
                    },
                    borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.75rem", "2xl": "1rem", full: "0.75rem" },
                    spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px", "grid-unit": "8px" },
                    fontFamily: { "headline-lg-mobile": ["Anton"], "label-mono": ["JetBrains Mono"], "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "display-xl": ["Anton"] },
                    fontSize: {
                        "headline-lg-mobile": ["36px", { lineHeight: "100%", fontWeight: "400" }],
                        "label-mono": ["12px", { lineHeight: "1.2", fontWeight: "700" }],
                        "headline-lg": ["48px", { lineHeight: "100%", fontWeight: "400" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }],
                        "display-xl": ["84px", { lineHeight: "90%", letterSpacing: "-0.02em", fontWeight: "400" }]
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --tertiary-container: #aa5700; --surface-variant: #e1e3e4; --on-background: #191c1d;
            --background: #f8f9fa; --on-tertiary-container: #ffede3; --error: #ba1a1a;
            --on-error: #ffffff; --on-secondary-container: #76014e; --on-primary-container: #eeefff;
            --secondary: #a43073; --surface: #f8f9fa; --error-container: #ffdad6;
            --inverse-primary: #b4c5ff; --tertiary-fixed-dim: #ffb783; --tertiary-fixed: #ffdcc5;
            --tertiary: #864300; --on-secondary: #ffffff; --surface-container-highest: #e1e3e4;
            --outline-variant: #c3c6d7; --on-tertiary-fixed: #301400; --secondary-fixed: #ffd8e7;
            --surface-container-lowest: #ffffff; --secondary-fixed-dim: #ffafd3;
            --on-error-container: #93000a; --outline: #737686; --primary: #004ac6;
            --surface-container: #edeeef; --surface-container-high: #e7e8e9; --surface-dim: #d9dadb;
            --inverse-surface: #2e3132; --on-primary-fixed: #00174b; --on-tertiary-fixed-variant: #713700;
            --on-tertiary: #ffffff; --on-surface-variant: #434655; --primary-container: #2563eb;
            --surface-container-low: #f3f4f5; --on-surface: #191c1d; --primary-fixed-dim: #b4c5ff;
            --on-secondary-fixed-variant: #85145a; --on-secondary-fixed: #3d0026;
            --inverse-on-surface: #f0f1f2; --on-primary: #ffffff; --secondary-container: #fc79bd;
            --primary-fixed: #dbe1ff; --surface-tint: #0053db; --on-primary-fixed-variant: #003ea8;
            --surface-bright: #f8f9fa;
        }
        .dark {
            --tertiary-container: #665500; --surface-variant: #2a2a2a; --on-background: #ffffff;
            --background: #0a0a0a; --on-tertiary-container: #ffe082; --error: #ff6b6b;
            --on-error: #000000; --on-secondary-container: #ffe0b2; --on-primary-container: #fff8e1;
            --secondary: #ff8c00; --surface: #111111; --error-container: #6b0000;
            --inverse-primary: #004ac6; --tertiary-fixed-dim: #ffcc02; --tertiary-fixed: #fff3cd;
            --tertiary: #ffcc02; --on-secondary: #000000; --surface-container-highest: #2a2a2a;
            --outline-variant: #333333; --on-tertiary-fixed: #1a1400; --secondary-fixed: #ffe0b2;
            --surface-container-lowest: #080808; --secondary-fixed-dim: #ffb347;
            --on-error-container: #ffcccc; --outline: #444444; --primary: #ffd700;
            --surface-container: #1a1a1a; --surface-container-high: #222222; --surface-dim: #0a0a0a;
            --inverse-surface: #ffffff; --on-primary-fixed: #1a1400; --on-tertiary-fixed-variant: #332a00;
            --on-tertiary: #000000; --on-surface-variant: #cccccc; --primary-container: #ffed4a;
            --surface-container-low: #141414; --on-surface: #ffffff; --primary-fixed-dim: #ffd700;
            --on-secondary-fixed-variant: #331c00; --on-secondary-fixed: #1a0e00;
            --inverse-on-surface: #000000; --on-primary: #000000; --secondary-container: #e67e00;
            --primary-fixed: #fff3b0; --surface-tint: #ffd700; --on-primary-fixed-variant: #332a00;
            --surface-bright: #2a2a2a;
        }
        * { box-sizing: border-box; }
        body { margin: 0;             background-color: var(--background); font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; width: 100%; max-width: 100%; }
        .bento-shadow { box-shadow: 3px 3px 0px 0px #000; }
        .bento-shadow-hover:hover { box-shadow: 5px 5px 0px 0px #000; transform: translateY(-2px); }
        .bento-card { border: 2px solid #000; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .bento-grid-article { display: grid; gap: 12px; grid-template-columns: repeat(2, 1fr); }
        @media (min-width: 768px) { .bento-grid-article { gap: 16px; grid-template-columns: repeat(3, 1fr); } }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        #mobile-sidebar.open { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.open { opacity: 1 !important; pointer-events: auto !important; }
        #categoryDropdown { transition: opacity 0.2s ease, transform 0.2s ease; transform-origin: top left; }
        #categoryDropdown.hidden { opacity: 0; transform: scale(0.95); pointer-events: none; }
        .carousel-item { display: none; opacity: 0; transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .carousel-item.active { display: flex; opacity: 1; }
        .carousel-item .slide-content { transform: translateY(20px); opacity: 0; transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); transition-delay: 200ms; }
        .carousel-item.active .slide-content { transform: translateY(0); opacity: 1; }
        .carousel-item .slide-image { transform: scale(1.1); transition: transform 1.2s ease-out; }
        .carousel-item.active .slide-image { transform: scale(1); }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 30s linear infinite; }
    </style>
    @include('layouts.partials.pattern-styles')
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col font-body-md">

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-4 md:px-margin-desktop py-8 md:py-12 overflow-x-hidden">

        {{-- TITLE SECTION --}}
        <div class="mb-10 md:mb-12">
            <div class="flex items-center gap-2 text-on-surface-variant font-label-mono text-xs uppercase mb-3">
                <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary">Berita</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-primary rounded"></span>
                <h1 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl uppercase tracking-tighter">BERITA SEKOLAH</h1>
            </div>
            <div class="h-px bg-outline-variant flex-grow mt-3"></div>
        </div>

        {{-- HERO CAROUSEL --}}
        @if($spotlights->isNotEmpty())
        <section class="mb-12 md:mb-16 relative">
            <div class="relative" id="hero-carousel">
                    <div class="bg-white dark:bg-surface-container rounded-xl bento-shadow overflow-hidden min-h-[360px] md:min-h-[400px] border-2 border-black dark:border-gray-700">
                    @foreach($spotlights as $s)
                        @php $art = $s->article; @endphp
                        @if(!$art) @continue @endif
                        <div class="carousel-item flex-col lg:flex-row w-full @if($loop->first) active @endif" style="opacity: @if($loop->first) 1 @else 0 @endif;">
                            <div class="lg:w-3/5 h-[320px] md:h-[400px] relative overflow-hidden bg-on-background">
                                @if($art->image)
                                    <img alt="{{ $art->title }}" class="slide-image w-full h-full object-cover" src="{{ $art->image }}">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-6 left-6 right-6 slide-content">
                                    <div class="inline-block bg-primary text-on-primary px-3 py-1 font-label-mono text-[10px] md:text-xs rounded mb-3 uppercase">{{ $art->category ?? 'HIGHLIGHT' }}</div>
                                    <h1 class="text-white font-headline-lg text-2xl md:text-4xl uppercase leading-none">{{ $art->title }}</h1>
                                </div>
                            </div>
                            <div class="lg:w-2/5 p-6 md:p-8 flex flex-col justify-between bg-surface-container-low">
                                <div class="slide-content">
                                    <div class="font-label-mono text-primary mb-2 uppercase text-xs">{{ $art->category }}</div>
                                    <h3 class="font-headline-lg text-xl md:text-2xl mb-3 leading-tight">{{ $art->title }}</h3>
                                    <p class="font-body-md text-sm text-on-surface-variant mb-6">{{ Str::limit($art->content_text, 120) }}</p>
                                    <a href="{{ route('public.article.show', $art->slug) }}" class="inline-flex items-center gap-1.5 bg-on-background text-surface font-label-mono text-xs px-5 py-2.5 rounded-xl hover:bg-on-background/90 transition-all bento-shadow">
                                        LIHAT DETAIL <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($spotlights->count() > 1)
                <div class="flex justify-center gap-2 mt-6" id="articles-section">
                    @foreach($spotlights as $s)
                        @if(!$s->article) @continue @endif
                        <button class="dot w-2.5 h-2.5 rounded-full bg-surface-variant transition-all @if($loop->first) bg-primary @endif" data-slide="{{ $loop->index }}" style="@if($loop->first) width: 1.5rem; @endif"></button>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
        @endif

        {{-- CATEGORY FILTER & SEARCH --}}
        <section class="mb-12 bg-dots py-6 md:py-16 -mx-4 md:-mx-16 max-lg:-mx-8 px-4 md:px-16 max-lg:px-8 rounded-none">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <button class="w-11 h-11 md:w-12 md:h-12 bg-white dark:bg-surface-container dark:text-on-surface bento-shadow rounded-xl flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all bento-card" id="categoryToggle">
                            <span class="material-symbols-outlined text-2xl">menu</span>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white dark:bg-surface-container rounded-xl bento-shadow z-50 hidden" id="categoryDropdown">
                            <div class="p-4">
                                <h4 class="font-label-mono text-xs uppercase mb-3 text-on-surface-variant">Kategori</h4>
                                <div class="space-y-1">
                                    <a href="{{ route('public.article.list') }}#articles-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed rounded transition-colors text-sm">Semua Artikel</a>
                                    @foreach($categories as $cat)
                                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => $cat->category, 'page' => null])) }}#articles-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed rounded transition-colors text-sm">{{ $cat->category }} ({{ $cat->total }})</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2" id="categoryButtons">
                        <a href="{{ route('public.article.list') }}#articles-section" class="bg-primary text-on-primary rounded-xl px-4 py-2 font-label-mono text-[10px] uppercase bento-shadow hover:bg-primary/90 transition-all">All News</a>
                        @foreach($categories->take(5) as $cat)
                            @php
                                $colors = [
                                    'Berita' => ['bg' => 'bg-primary/10', 'text' => 'text-primary'],
                                    'Pengumuman' => ['bg' => 'bg-secondary/10', 'text' => 'text-secondary'],
                                    'Prestasi' => ['bg' => 'bg-error/10', 'text' => 'text-error'],
                                    'Alumni' => ['bg' => 'bg-on-background/10', 'text' => 'text-on-background'],
                                    'Event' => ['bg' => 'bg-tertiary/10', 'text' => 'text-tertiary'],
                                    'Opini' => ['bg' => 'bg-error/10', 'text' => 'text-error'],
                                ];
                                $catColors = $colors[$cat->category] ?? ['bg' => 'bg-secondary/10', 'text' => 'text-secondary'];
                                $isActive = request('category') === $cat->category;
                            @endphp
                            <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => $cat->category, 'page' => null])) }}#articles-section"
                               class="{{ $isActive ? $catColors['bg'] . ' ' . $catColors['text'] : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-2 font-label-mono text-[10px] uppercase transition-all bento-shadow">
                                {{ $cat->category }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form method="GET" action="{{ route('public.article.list') }}" class="relative w-full md:w-72" id="searchForm">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('tag'))
                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                    @endif
                    <input name="search" class="bg-white dark:bg-surface-container dark:text-on-surface bento-shadow rounded-xl px-4 py-2.5 font-label-mono focus:outline-none focus:ring-2 focus:ring-primary/30 w-full text-sm uppercase" placeholder="SEARCH ARTICLE..." type="text" value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>

            @if(request('category') || request('search') || request('tag'))
            <div class="flex flex-wrap items-center gap-2 mb-8">
                <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Filter aktif:</span>
                @if(request('category'))
                <span class="inline-flex items-center gap-1.5 bg-primary-fixed dark:bg-surface-container rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    {{ request('category') }}
                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => null, 'page' => null])) }}#articles-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('search'))
                <span class="inline-flex items-center gap-1.5 bg-secondary-fixed dark:bg-surface-container-high rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    "{{ request('search') }}"
                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['search' => null, 'page' => null])) }}#articles-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('tag'))
                <span class="inline-flex items-center gap-1.5 bg-tertiary-fixed dark:bg-surface-container-high rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    #{{ request('tag') }}
                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['tag' => null, 'page' => null])) }}#articles-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                <a href="{{ route('public.article.list') }}#articles-section" class="font-label-mono text-[10px] text-primary hover:underline">Hapus semua</a>
            </div>
            @endif

            {{-- BENTO ARTICLE GRID --}}
            @if($articles->isNotEmpty())
            <div class="bento-grid-article">
                @foreach($articles as $index => $article)
                    <article class="bg-surface-container-low rounded-xl bento-shadow bento-card bento-shadow-hover flex flex-col overflow-hidden group">
                        <div class="aspect-video relative overflow-hidden">
                            @if($article->image)
                            <img alt="{{ $article->title }}" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105" src="{{ $article->image }}">
                            @else
                            <div class="w-full h-full bg-surface-variant"></div>
                            @endif
                            <div class="absolute top-3 left-3 bg-white/90 dark:bg-surface-container dark:text-on-surface px-2.5 py-1 text-[10px] font-label-mono uppercase rounded bento-shadow">{{ $article->category ?? 'BERITA' }}</div>
                        </div>
                        <div class="p-3 md:p-4 flex flex-col flex-grow">
                            <div class="font-label-mono text-primary text-[10px] uppercase mb-1">{{ $article->published_at->format('d M Y') }}</div>
                            <h3 class="font-headline-lg text-sm md:text-base uppercase leading-tight mb-1.5 line-clamp-2 dark:text-gray-400">{{ $article->title }}</h3>
                            <p class="font-body-md text-xs text-on-surface-variant mb-3 flex-grow line-clamp-2">{{ Str::limit($article->content_text, 100) }}</p>
                            <a class="inline-flex items-center font-label-mono text-[10px] text-primary font-bold group-hover:gap-2 transition-all" href="{{ route('public.article.show', $article->slug) }}">
                                Lihat Detail
                                <span class="material-symbols-outlined ml-1 text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
            @php
                $currentPage = $articles->currentPage();
                $lastPage = $articles->lastPage();
                $window = 5;
                if ($lastPage <= $window) { $start = 1; $end = $lastPage; }
                else { $start = max(1, min($currentPage, $lastPage - $window + 1)); $end = min($lastPage, $start + $window - 1); }
                $pageRange = range($start, $end);
            @endphp
            <div class="mt-12 flex justify-center items-center gap-2">
                @if($articles->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center bg-surface-container-high rounded-xl opacity-50">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() . '#articles-section' }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif

                <div class="flex gap-1.5">
                    @foreach($pageRange as $page)
                        @php $url = $articles->url($page) . '#articles-section'; @endphp
                        @if($page == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center bg-primary text-on-primary font-label-mono rounded-xl bento-shadow">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container font-label-mono rounded-xl hover:bg-surface-container-high transition-colors bento-shadow">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() . '#articles-section' }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center bg-surface-container-high rounded-xl opacity-50">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </span>
                @endif
            </div>
            @endif

        @else
            <div class="text-center py-16">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">newspaper</span>
                <p class="font-headline-lg text-2xl uppercase text-on-surface-variant">Tidak ada artikel ditemukan</p>
                <a href="{{ route('public.article.list') }}" class="inline-block mt-6 bg-primary text-on-primary rounded-xl px-6 py-3 font-label-mono text-sm bento-shadow hover:bg-primary/90 transition-all">RESET FILTER</a>
            </div>
        @endif
        </section>
    </main>

    @include('layouts.partials.public-footer')

    <script>
        // Carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;
        let slideInterval, isTransitioning = false;

        function showSlide(index) {
            if (isTransitioning || !slides[index] || index === currentSlide && slides[index].classList.contains('active')) return;
            isTransitioning = true;

            const oldSlide = slides[currentSlide];
            const newSlide = slides[index];

            dots.forEach(function(d) { d.classList.remove('bg-primary'); d.classList.add('bg-surface-variant'); });
            if (dots[index]) { dots[index].classList.remove('bg-surface-variant'); dots[index].classList.add('bg-primary'); }

            if (oldSlide) {
                oldSlide.style.opacity = '0';
                setTimeout(function() {
                    oldSlide.classList.remove('active');
                    newSlide.classList.add('active');
                    newSlide.offsetHeight;
                    newSlide.style.opacity = '1';
                    setTimeout(function() { isTransitioning = false; }, 600);
                }, 100);
            } else {
                newSlide.classList.add('active');
                newSlide.style.opacity = '1';
                isTransitioning = false;
            }
            currentSlide = index;
        }

        function nextSlide() { showSlide((currentSlide + 1) % totalSlides); }
        function startAutoSlide() { clearInterval(slideInterval); slideInterval = setInterval(nextSlide, 6000); }

        if (dots.length > 0) {
            dots.forEach(function(dot, index) {
                dot.addEventListener('click', function() { showSlide(index); startAutoSlide(); });
            });
            showSlide(0);
            startAutoSlide();
        }

        // Category dropdown toggle
        const catToggle = document.getElementById('categoryToggle');
        const catDropdown = document.getElementById('categoryDropdown');
        if (catToggle && catDropdown) {
            catToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                catDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function() { catDropdown.classList.add('hidden'); });
            catDropdown.addEventListener('click', function(e) { e.stopPropagation(); });
        }

        if (window.location.hash === '#articles-section') {
            var section = document.getElementById('articles-section');
            if (section) { setTimeout(function() { section.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 100); }
        }

        var searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', function() { this.action = this.action.split('#')[0] + '#articles-section'; });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (openBtn && closeBtn && sidebar && overlay) {
                function openSidebar() { sidebar.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow = 'hidden'; }
                function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow = ''; }
                openBtn.addEventListener('click', openSidebar);
                closeBtn.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }
        });
    </script>
    @include('layouts.partials.scroll-to-top')
</body>
</html>