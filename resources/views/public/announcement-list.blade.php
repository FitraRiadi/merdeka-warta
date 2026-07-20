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
    <title>Pemberitahuan | Merdeka Warta</title>
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        #mobile-sidebar.open { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.open { opacity: 1 !important; pointer-events: auto !important; }
        #categoryDropdown { transition: opacity 0.2s ease, transform 0.2s ease; transform-origin: top left; }
        #categoryDropdown.hidden { opacity: 0; transform: scale(0.95); pointer-events: none; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 30s linear infinite; }
    </style>
    @include('layouts.partials.pattern-styles')
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col font-body-md">

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-4 md:px-margin-desktop py-8 md:py-12">

        {{-- PAGE TITLE --}}
        <div class="mb-10 md:mb-12">
            <div class="flex items-center gap-2 text-on-surface-variant font-label-mono text-xs uppercase mb-3">
                <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary">Pengumuman</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-primary rounded"></span>
                <h1 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl uppercase tracking-tighter">PEMBERITAHUAN SEKOLAH</h1>
            </div>
            <div class="h-px bg-outline-variant flex-grow mt-3"></div>
        </div>

        {{-- FEATURED + LATEST BENTO SECTION --}}
        @if($featured || $latestAnnouncements->isNotEmpty())
        <section class="mb-12 md:mb-16 bento-grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">

            {{-- Featured spotlight (large) --}}
            @if($featured)
            <a href="{{ route('public.announcement.show', $featured->id) }}"
               class="md:col-span-2 lg:col-span-2 bg-white dark:bg-surface-container rounded-xl bento-shadow bento-card bento-shadow-hover p-5 md:p-7 flex flex-col md:flex-row items-start gap-5 group">
                <div class="flex-shrink-0 bg-primary/10 p-4 rounded-xl">
                    <span class="material-symbols-outlined text-primary text-3xl md:text-4xl">campaign</span>
                </div>
                <div class="flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        @php
                            $featTypeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                            $featTypeColors = ['important' => 'bg-error/10 text-error', 'warning' => 'bg-tertiary/10 text-tertiary', 'info' => 'bg-secondary/10 text-secondary'];
                            $featLabel = $featTypeLabels[$featured->type] ?? 'PENGUMUMAN';
                            $featColor = $featTypeColors[$featured->type] ?? 'bg-secondary/10 text-secondary';
                        @endphp
                        <span class="{{ $featColor }} px-3 py-1 font-label-mono text-[10px] rounded uppercase font-bold">{{ $featLabel }}</span>
                        <span class="font-label-mono text-[10px] text-on-surface-variant uppercase">{{ $featured->created_at->format('d M Y') }}</span>
                    </div>
                    <h2 class="font-headline-lg text-xl md:text-2xl lg:text-3xl uppercase leading-none mb-3 group-hover:text-primary transition-colors">{{ $featured->title }}</h2>
                    <p class="font-body-md text-sm text-on-surface-variant mb-4 line-clamp-2">{{ Str::limit($featured->content_text, 150) }}</p>
                    <span class="inline-flex items-center gap-1 text-xs font-label-mono text-primary group-hover:gap-2 transition-all">
                        Pelajari Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </span>
                </div>
            </a>
            @endif

           
        </section>
        @endif

        {{-- CATEGORY FILTER & SEARCH --}}
        <section class="mb-12 bg-stripes py-6 md:py-16 -mx-4 md:-mx-16 max-lg:-mx-8 px-4 md:px-16 max-lg:px-8" id="announcements-section">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative">
                        <button class="w-11 h-11 md:w-12 md:h-12 bg-white dark:bg-surface-container dark:text-on-surface bento-shadow rounded-xl flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all bento-card" id="categoryToggle">
                            <span class="material-symbols-outlined text-2xl">menu</span>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-56 bg-white dark:bg-surface-container rounded-xl bento-shadow z-50 hidden" id="categoryDropdown">
                            <div class="p-4">
                                <h4 class="font-label-mono text-xs uppercase mb-3 text-on-surface-variant">Tipe Pemberitahuan</h4>
                                <div class="space-y-1">
                                    <a href="{{ route('public.announcement.list') }}#announcements-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed rounded transition-colors text-sm">Semua Pemberitahuan</a>
                                    @foreach($categories as $cat)
                                    @php
                                        $typeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                                        $catLabel = $typeLabels[$cat->type] ?? $cat->type;
                                    @endphp
                                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => $cat->type, 'page' => null])) }}#announcements-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed rounded transition-colors text-sm">{{ $catLabel }} ({{ $cat->total }})</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2" id="categoryButtons">
                        @php
                            $btnTypeColors = [
                                'info' => ['bg' => 'bg-secondary/10', 'text' => 'text-secondary'],
                                'warning' => ['bg' => 'bg-tertiary/10', 'text' => 'text-tertiary'],
                                'important' => ['bg' => 'bg-error/10', 'text' => 'text-error'],
                            ];
                            $typeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                        @endphp
                        <a href="{{ route('public.announcement.list') }}#announcements-section"
                           class="bg-primary text-on-primary rounded-xl px-4 py-2 font-label-mono text-[10px] uppercase bento-shadow hover:bg-primary/90 transition-all">Semua</a>
                        @foreach($categories as $cat)
                            @php
                                $catColors = $btnTypeColors[$cat->type] ?? ['bg' => 'bg-secondary/10', 'text' => 'text-secondary'];
                                $isActive = request('type') === $cat->type;
                                $catLabel = $typeLabels[$cat->type] ?? $cat->type;
                            @endphp
                            <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => $cat->type, 'page' => null])) }}#announcements-section"
                               class="{{ $isActive ? $catColors['bg'] . ' ' . $catColors['text'] : 'bg-surface-container-low text-on-surface-variant hover:bg-surface-container-high' }} rounded-xl px-4 py-2 font-label-mono text-[10px] uppercase transition-all bento-shadow">
                                {{ $catLabel }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form method="GET" action="{{ route('public.announcement.list') }}" class="relative w-full md:w-72" id="searchForm">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    @if(request('tag'))
                        <input type="hidden" name="tag" value="{{ request('tag') }}">
                    @endif
                    <input name="search" class="bg-white dark:bg-surface-container dark:text-on-surface bento-shadow rounded-xl px-4 py-2.5 font-label-mono focus:outline-none focus:ring-2 focus:ring-primary/30 w-full text-sm uppercase" placeholder="CARI PEMBERITAHUAN..." type="text" value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>

            @if(request('type') || request('search') || request('tag'))
            <div class="flex flex-wrap items-center gap-2 mb-8">
                <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Filter aktif:</span>
                @if(request('type'))
                <span class="inline-flex items-center gap-1.5 bg-primary-fixed dark:bg-surface-container rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    {{ $typeLabels[request('type')] ?? request('type') }}
                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => null, 'page' => null])) }}#announcements-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('search'))
                <span class="inline-flex items-center gap-1.5 bg-secondary-fixed dark:bg-surface-container-high rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    "{{ request('search') }}"
                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['search' => null, 'page' => null])) }}#announcements-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('tag'))
                <span class="inline-flex items-center gap-1.5 bg-tertiary-fixed dark:bg-surface-container-high rounded-xl px-3 py-1.5 font-label-mono text-[10px] bento-shadow">
                    #{{ request('tag') }}
                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['tag' => null, 'page' => null])) }}#announcements-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                <a href="{{ route('public.announcement.list') }}#announcements-section" class="font-label-mono text-[10px] text-primary hover:underline">Hapus semua</a>
            </div>
            @endif

            {{-- ALL ANNOUNCEMENTS BENTO GRID --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="w-1.5 h-5 bg-secondary rounded"></span>
                <h2 class="font-headline-lg text-lg md:text-xl uppercase">Semua Pemberitahuan</h2>
            </div>

            @if($announcements->isNotEmpty())
            <div class="bento-grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
                @php
                    $typeStyles = [
                        'important' => ['icon' => 'error', 'bg' => 'bg-error/10', 'color' => 'text-error', 'label' => 'PENTING'],
                        'warning' => ['icon' => 'warning_amber', 'bg' => 'bg-tertiary/10', 'color' => 'text-tertiary', 'label' => 'PERHATIAN'],
                        'info' => ['icon' => 'campaign', 'bg' => 'bg-secondary/10', 'color' => 'text-secondary', 'label' => 'INFORMASI'],
                    ];
                @endphp
                @foreach($announcements as $index => $announcement)
                    @php
                        $ts = $typeStyles[$announcement->type] ?? $typeStyles['info'];
                        $isFeaturedGrid = $index == 0;
                    @endphp
                    <a href="{{ route('public.announcement.show', $announcement->id) }}"
                       class="bg-white dark:bg-surface-container rounded-xl bento-shadow bento-card bento-shadow-hover p-4 md:p-5 flex flex-col group @if($isFeaturedGrid) md:col-span-2 lg:col-span-2 @endif">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center {{ $ts['bg'] }}">
                                <span class="material-symbols-outlined {{ $ts['color'] }} text-xl">{{ $ts['icon'] }}</span>
                            </div>
                            <div class="flex-grow min-w-0">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-[10px] font-label-mono text-on-surface-variant uppercase">{{ $ts['label'] }}</span>
                                    <span class="text-[10px] font-label-mono text-on-surface-variant">/</span>
                                    <span class="text-[10px] font-label-mono text-on-surface-variant">{{ $announcement->created_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="font-headline-lg text-sm md:text-base uppercase leading-tight group-hover:text-primary transition-colors line-clamp-2">{{ $announcement->title }}</h3>
                            </div>
                        </div>
                        @if($isFeaturedGrid)
                        <p class="text-xs text-on-surface-variant mt-3 line-clamp-2">{{ Str::limit($announcement->content_text, 120) }}</p>
                        @else
                        <p class="text-xs text-on-surface-variant mt-2 line-clamp-1">{{ Str::limit($announcement->content_text, 80) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($announcements->hasPages())
            @php
                $currentPage = $announcements->currentPage();
                $lastPage = $announcements->lastPage();
                $window = 5;
                if ($lastPage <= $window) { $start = 1; $end = $lastPage; }
                else { $start = max(1, min($currentPage, $lastPage - $window + 1)); $end = min($lastPage, $start + $window - 1); }
                $pageRange = range($start, $end);
            @endphp
            <nav class="flex justify-center items-center mt-10 gap-2">
                @if($announcements->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center bg-surface-container-high rounded-xl opacity-50">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $announcements->previousPageUrl() . '#announcements-section' }}"
                       class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif

                <div class="flex gap-1.5">
                    @foreach($pageRange as $page)
                        @php $url = $announcements->url($page) . '#announcements-section'; @endphp
                        @if($page == $currentPage)
                            <span class="w-10 h-10 flex items-center justify-center bg-primary text-on-primary font-label-mono rounded-xl bento-shadow">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                               class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container font-label-mono rounded-xl hover:bg-surface-container-high transition-colors bento-shadow">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                @if($announcements->hasMorePages())
                    <a href="{{ $announcements->nextPageUrl() . '#announcements-section' }}"
                       class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center bg-surface-container-high rounded-xl opacity-50">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </span>
                @endif
            </nav>
            @endif

            @else
                <div class="text-center py-16">
                    <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">campaign</span>
                    <p class="font-headline-lg text-2xl uppercase text-on-surface-variant">Tidak ada pemberitahuan ditemukan</p>
                    <a href="{{ route('public.announcement.list') }}" class="inline-block mt-6 bg-primary text-on-primary rounded-xl px-6 py-3 font-label-mono text-sm bento-shadow hover:bg-primary/90 transition-all">RESET FILTER</a>
                </div>
            @endif
        </section>
    </main>

    @include('layouts.partials.public-footer')

    <script>
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

        if (window.location.hash === '#announcements-section') {
            var section = document.getElementById('announcements-section');
            if (section) { setTimeout(function() { section.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 100); }
        }

        var searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', function() { this.action = this.action.split('#')[0] + '#announcements-section'; });
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
</body>
</html>