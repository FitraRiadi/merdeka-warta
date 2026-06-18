<!DOCTYPE html>
<html lang="id">
<head>
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
                        "tertiary-container": "#aa5700", "surface-variant": "#e1e3e4", "on-background": "#191c1d",
                        "background": "#f8f9fa", "on-tertiary-container": "#ffede3", "error": "#ba1a1a",
                        "on-error": "#ffffff", "on-secondary-container": "#76014e", "on-primary-container": "#eeefff",
                        "secondary": "#a43073", "surface": "#f8f9fa", "error-container": "#ffdad6",
                        "inverse-primary": "#b4c5ff", "tertiary-fixed-dim": "#ffb783", "tertiary-fixed": "#ffdcc5",
                        "tertiary": "#864300", "on-secondary": "#ffffff", "surface-container-highest": "#e1e3e4",
                        "outline-variant": "#c3c6d7", "on-tertiary-fixed": "#301400", "secondary-fixed": "#ffd8e7",
                        "surface-container-lowest": "#ffffff", "secondary-fixed-dim": "#ffafd3",
                        "on-error-container": "#93000a", "outline": "#737686", "primary": "#004ac6",
                        "surface-container": "#edeeef", "surface-container-high": "#e7e8e9", "surface-dim": "#d9dadb",
                        "inverse-surface": "#2e3132", "on-primary-fixed": "#00174b", "on-tertiary-fixed-variant": "#713700",
                        "on-tertiary": "#ffffff", "on-surface-variant": "#434655", "primary-container": "#2563eb",
                        "surface-container-low": "#f3f4f5", "on-surface": "#191c1d", "primary-fixed-dim": "#b4c5ff",
                        "on-secondary-fixed-variant": "#85145a", "on-secondary-fixed": "#3d0026",
                        "inverse-on-surface": "#f0f1f2", "on-primary": "#ffffff", "secondary-container": "#fc79bd",
                        "primary-fixed": "#dbe1ff", "surface-tint": "#0053db", "on-primary-fixed-variant": "#003ea8",
                        "surface-bright": "#f8f9fa"
                    },
                    borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
                    spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px", "grid-unit": "8px", "border-width": "3px" },
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
        body { background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .sticker-tilt { transform: rotate(-2deg); }
        .sticker-tilt-alt { transform: rotate(3deg); }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: none !important; }
        body { background-color: #f8f9fa; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        #mobile-sidebar.open { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.open { opacity: 1 !important; pointer-events: auto !important; }
        #categoryDropdown { transition: opacity 0.2s ease, transform 0.2s ease; transform-origin: top left; }
        #categoryDropdown.hidden { opacity: 0; transform: scale(0.95); pointer-events: none; }
        .brutalist-card { border: 3px solid #191c1d; box-shadow: 8px 8px 0px 0px #191c1d; transition: all 0.2s ease; }
        .brutalist-card:hover { transform: translate(4px, 4px); box-shadow: 4px 4px 0px 0px #191c1d; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 30s linear infinite; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col font-body-md">

    {{-- NAVBAR --}}
    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-4 md:px-margin-desktop py-12">

        {{-- PAGE TITLE --}}
        <div class="mb-12 text-center">
            <div class="relative flex items-center justify-center gap-4 md:gap-8 mb-2">
                <div class="hidden md:flex items-center gap-2 md:gap-4">
                    <div class="w-5 h-5 md:w-6 md:h-6 bg-primary border-3 border-on-surface rotate-3 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></div>
                    <div class="w-6 h-6 md:w-8 md:h-8 bg-secondary-container border-3 border-on-surface rounded-full -rotate-6 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></div>
                    <div class="w-0 h-0 border-l-[10px] md:border-l-[12px] border-l-transparent border-r-[10px] md:border-r-[12px] border-r-transparent border-b-[20px] md:border-b-[24px] border-b-tertiary-container rotate-12 drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]"></div>
                </div>
                <h1 class="font-headline-lg text-3xl sm:text-5xl md:text-headline-lg text-on-surface uppercase tracking-tighter">PEMBERITAHUAN SEKOLAH</h1>
                <div class="hidden md:flex items-center gap-2 md:gap-4">
                    <div class="w-0 h-0 border-l-[10px] md:border-l-[12px] border-l-transparent border-r-[10px] md:border-r-[12px] border-r-transparent border-b-[20px] md:border-b-[24px] border-b-primary -rotate-12 drop-shadow-[2px_2px_0px_rgba(0,0,0,1)]"></div>
                    <div class="w-6 h-6 md:w-8 md:h-8 bg-secondary-fixed border-3 border-on-surface rotate-6 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></div>
                    <div class="w-5 h-5 md:w-6 md:h-6 bg-tertiary border-3 border-on-surface rounded-full -rotate-3 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></div>
                </div>
            </div>
            <div class="h-2 w-24 md:w-32 bg-primary mx-auto mt-4 border-2 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
        </div>

        {{-- FEATURED SECTION (Pemberitahuan Sorotan) --}}
        @if($featured)
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-primary text-2xl md:text-3xl">star</span>
                <h2 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight">Pemberitahuan Sorotan</h2>
            </div>
            <a href="{{ route('public.announcement.show', $featured->id) }}"
               class="bg-primary-container text-on-primary-container border-3 border-on-surface p-6 md:p-8 brutalist-shadow transition-all flex flex-col md:flex-row items-center gap-6 md:gap-8 group hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                <div class="flex-shrink-0 bg-white p-4 md:p-6 border-3 border-on-surface shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-primary text-4xl md:text-6xl scale-125">campaign</span>
                </div>
                <div class="flex-grow text-center md:text-left">
                    <div class="flex items-center gap-3 mb-4 justify-center md:justify-start">
                        @php
                            $featTypeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                            $featTypeColors = ['important' => 'bg-white text-error', 'warning' => 'bg-white text-tertiary', 'info' => 'bg-white text-secondary'];
                            $featLabel = $featTypeLabels[$featured->type] ?? 'PENGUMUMAN';
                            $featColor = $featTypeColors[$featured->type] ?? 'bg-white text-secondary';
                        @endphp
                        <span class="{{ $featColor }} px-4 py-1 font-label-mono text-[10px] md:text-sm border-2 border-on-surface -rotate-1 uppercase font-bold">{{ $featLabel }}</span>
                        <span class="font-label-mono text-[10px] md:text-sm opacity-80 uppercase font-bold">Diperbarui: {{ $featured->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-headline-lg text-3xl md:text-4xl lg:text-5xl uppercase leading-none mb-4 group-hover:underline underline-offset-8 decoration-4">{{ $featured->title }}</h3>
                    <p class="font-body-md text-sm md:text-lg opacity-90 max-w-3xl mb-6">{{ Str::limit($featured->content_text, 150) }}</p>
                    <span class="inline-block bg-white text-on-surface border-3 border-on-surface px-6 md:px-8 py-2 md:py-3 font-label-mono uppercase font-bold brutalist-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">Pelajari Selengkapnya</span>
                </div>
            </a>
        </section>
        @endif

        {{-- LATEST SECTION (Pemberitahuan Terbaru) --}}
        @if($latestAnnouncements->isNotEmpty())
        <section class="mb-16">
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-secondary text-2xl md:text-3xl">new_releases</span>
                <h2 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight">Pemberitahuan Terbaru</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                @foreach($latestAnnouncements as $i => $la)
                    @php
                        $latestPalette = [
                            ['cardBg' => 'bg-secondary-fixed', 'badgeBg' => 'bg-secondary-container', 'badgeText' => 'text-on-secondary-container', 'iconBg' => 'bg-white', 'iconText' => 'text-secondary', 'icon' => 'school'],
                            ['cardBg' => 'bg-tertiary-fixed', 'badgeBg' => 'bg-tertiary-container', 'badgeText' => 'text-on-tertiary-container', 'iconBg' => 'bg-white', 'iconText' => 'text-tertiary', 'icon' => 'event'],
                        ];
                        $lp = $latestPalette[$i] ?? $latestPalette[0];
                        $laLabel = $featTypeLabels[$la->type] ?? 'PENGUMUMAN';
                    @endphp
                    <a href="{{ route('public.announcement.show', $la->id) }}"
                       class="{{ $lp['cardBg'] }} border-3 border-on-surface p-4 md:p-6 brutalist-shadow transition-all flex flex-row items-start gap-4 group hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="{{ $lp['badgeBg'] }} {{ $lp['badgeText'] }} px-3 py-1 font-label-mono text-[10px] border-2 border-on-surface rotate-2 uppercase">{{ $laLabel }}</span>
                                <span class="font-label-mono text-[10px] opacity-60">{{ $la->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="font-headline-lg text-xl md:text-2xl uppercase leading-tight mb-2 group-hover:text-primary transition-colors">{{ $la->title }}</h3>
                            <p class="text-on-surface-variant text-sm line-clamp-2">{{ Str::limit($la->content_text, 100) }}</p>
                        </div>
                        <div class="{{ $lp['iconBg'] }} p-2 md:p-3 border-3 border-on-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex-shrink-0">
                            <span class="material-symbols-outlined {{ $lp['iconText'] }}">{{ $lp['icon'] }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- CATEGORY FILTER & SEARCH --}}
        <section class="mb-12" id="announcements-section">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-8">
                <div class="flex items-center gap-4 flex-wrap">
                    {{-- Hamburger Button (category dropdown trigger) --}}
                    <div class="relative">
                        <button class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white border-3 border-on-background flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press" id="categoryToggle">
                            <span class="material-symbols-outlined text-2xl md:text-3xl">menu</span>
                        </button>
                        {{-- Dropdown --}}
                        <div class="absolute top-full left-0 mt-3 w-56 md:w-64 bg-surface border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] z-50 hidden" id="categoryDropdown">
                            <div class="p-4">
                                <h4 class="font-label-mono text-xs uppercase mb-4 text-on-surface-variant">Tipe Pemberitahuan</h4>
                                <div class="space-y-2">
                                    <a href="{{ route('public.announcement.list') }}#announcements-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed transition-colors rounded">Semua Pemberitahuan</a>
                                    @foreach($categories as $cat)
                                    @php
                                        $typeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                                        $catLabel = $typeLabels[$cat->type] ?? $cat->type;
                                    @endphp
                                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => $cat->type, 'page' => null])) }}#announcements-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed transition-colors rounded">{{ $catLabel }} ({{ $cat->total }})</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Category Filter Buttons (all types) --}}
                    <div class="flex flex-wrap gap-3 md:gap-4" id="categoryButtons">
                        @php
                            $btnTypeColors = [
                                'info' => ['bg' => 'bg-secondary', 'text' => 'text-on-secondary'],
                                'warning' => ['bg' => 'bg-tertiary-container', 'text' => 'text-on-tertiary'],
                                'important' => ['bg' => 'bg-error', 'text' => 'text-on-error'],
                            ];
                            $typeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                        @endphp
                        <a href="{{ route('public.announcement.list') }}#announcements-section"
                           class="{{ !request('type') ? 'bg-on-background text-surface' : 'bg-white text-on-surface' }} border-3 border-on-background px-5 md:px-6 py-2 md:py-3 font-label-mono text-[10px] md:text-label-mono uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">Semua</a>
                        @foreach($categories as $cat)
                            @php
                                $catColors = $btnTypeColors[$cat->type] ?? ['bg' => 'bg-secondary', 'text' => 'text-on-secondary'];
                                $isActive = request('type') === $cat->type;
                                $catLabel = $typeLabels[$cat->type] ?? $cat->type;
                            @endphp
                            <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => $cat->type, 'page' => null])) }}#announcements-section"
                               class="{{ $isActive ? 'opacity-100' : 'opacity-80 hover:opacity-100' }} {{ $catColors['bg'] }} {{ $catColors['text'] }} border-3 border-on-background px-5 md:px-6 py-2 md:py-3 font-label-mono text-[10px] md:text-label-mono uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                                {{ $catLabel }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('public.announcement.list') }}" class="relative w-full md:w-80" id="searchForm">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <input name="search" class="bg-surface border-3 border-on-background px-4 py-3 font-label-mono focus:outline-none focus:ring-0 focus:border-primary-container w-full text-sm uppercase" placeholder="CARI PEMBERITAHUAN..." type="text" value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>

            {{-- Active Filters --}}
            @if(request('type') || request('search'))
            <div class="flex flex-wrap items-center gap-3 mb-8">
                <span class="font-label-mono text-xs uppercase text-on-surface-variant">Filter aktif:</span>
                @if(request('type'))
                <span class="inline-flex items-center gap-2 bg-primary-fixed border-3 border-on-background px-4 py-2 font-label-mono text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    {{ $typeLabels[request('type')] ?? request('type') }}
                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['type' => null, 'page' => null])) }}#announcements-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-secondary-fixed border-3 border-on-background px-4 py-2 font-label-mono text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    "{{ request('search') }}"
                    <a href="{{ route('public.announcement.list', array_merge(request()->query(), ['search' => null, 'page' => null])) }}#announcements-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                <a href="{{ route('public.announcement.list') }}#announcements-section" class="font-label-mono text-xs text-primary hover:underline">Hapus semua</a>
            </div>
            @endif

            {{-- ALL ANNOUNCEMENTS GRID --}}
            <div class="flex items-center gap-4 mb-6">
                <span class="material-symbols-outlined text-on-surface-variant text-2xl md:text-3xl">list_alt</span>
                <h2 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight">Semua Pemberitahuan</h2>
            </div>

            @if($announcements->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @php
                    $cardIcons = ['campaign', 'school', 'event', 'sports_basketball', 'account_balance', 'menu_book', 'volunteer_activism', 'groups', 'record_voice_over', 'storefront', 'sports_soccer', 'celebration'];
                    $iconBgPalette = [
                        'bg-primary-fixed', 'bg-secondary-container', 'bg-surface-container-high',
                        'bg-tertiary-fixed', 'bg-error-container', 'bg-secondary-fixed',
                        'bg-primary-fixed', 'bg-secondary-container', 'bg-surface-container-high',
                        'bg-tertiary-fixed', 'bg-error-container', 'bg-secondary-fixed',
                    ];
                    $iconColorPalette = [
                        'text-on-primary-fixed', 'text-on-secondary-container', 'text-on-surface',
                        'text-on-tertiary-fixed', 'text-error', 'text-secondary',
                        'text-on-primary-fixed', 'text-on-secondary-container', 'text-on-surface',
                        'text-on-tertiary-fixed', 'text-error', 'text-secondary',
                    ];
                    $badgePalette = [
                        'bg-tertiary-container text-on-tertiary-container',
                        'bg-secondary-fixed text-on-secondary-fixed-variant',
                        'bg-secondary-container text-on-secondary-container',
                        'bg-outline-variant text-on-surface-variant',
                        'bg-primary-container text-on-primary-container',
                        'bg-secondary-fixed text-on-secondary-fixed-variant',
                        'bg-tertiary-container text-on-tertiary-container',
                        'bg-secondary-container text-on-secondary-container',
                        'bg-primary-container text-on-primary-container',
                        'bg-secondary-fixed text-on-secondary-fixed-variant',
                        'bg-outline-variant text-on-surface-variant',
                        'bg-tertiary-container text-on-tertiary-container',
                    ];
                    $typeLabels = ['important' => 'PENTING', 'warning' => 'PERHATIAN', 'info' => 'INFORMASI'];
                @endphp
                @foreach($announcements as $index => $announcement)
                    @php
                        $paletteIndex = $index % count($cardIcons);
                        $icon = $cardIcons[$paletteIndex];
                        $iconBg = $iconBgPalette[$paletteIndex];
                        $iconColor = $iconColorPalette[$paletteIndex];
                        $badgeClass = $badgePalette[$paletteIndex];
                        $annLabel = $typeLabels[$announcement->type] ?? 'PENGUMUMAN';
                    @endphp
                    <a href="{{ route('public.announcement.show', $announcement->id) }}"
                       class="bg-white border-3 border-on-surface p-4 md:p-6 brutalist-shadow transition-all flex flex-row items-start gap-4 group hover:translate-x-1 hover:translate-y-1 hover:shadow-none">
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="{{ $badgeClass }} px-3 py-1 font-label-mono text-[10px] border-2 border-on-surface -rotate-1 uppercase">{{ $annLabel }}</span>
                                <span class="font-label-mono text-[10px] opacity-60">{{ $announcement->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="font-headline-lg text-xl md:text-2xl uppercase leading-tight mb-2 group-hover:text-primary transition-colors">{{ $announcement->title }}</h3>
                            <p class="text-on-surface-variant text-sm line-clamp-2">{{ Str::limit($announcement->content_text, 100) }}</p>
                        </div>
                        <div class="{{ $iconBg }} p-2 md:p-3 border-3 border-on-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex-shrink-0">
                            <span class="material-symbols-outlined {{ $iconColor }}">{{ $icon }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($announcements->hasPages())
            @php
                $currentPage = $announcements->currentPage();
                $lastPage = $announcements->lastPage();
                $window = 5;

                if ($lastPage <= $window) {
                    $start = 1;
                    $end = $lastPage;
                } else {
                    $start = max(1, min($currentPage, $lastPage - $window + 1));
                    $end = min($lastPage, $start + $window - 1);
                }
                $pageRange = range($start, $end);
            @endphp
            <nav class="flex justify-center items-center mt-16 gap-2 md:gap-3">
                {{-- Previous --}}
                @if($announcements->onFirstPage())
                    <span class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $announcements->previousPageUrl() . '#announcements-section' }}"
                       class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif

                {{-- Pages --}}
                <div class="flex gap-1 md:gap-2">
                    @foreach($pageRange as $page)
                        @php $url = $announcements->url($page) . '#announcements-section'; @endphp
                        @if($page == $currentPage)
                            <span class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-primary text-on-primary font-label-mono shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                               class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-white font-label-mono hover:bg-surface-variant transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                {{-- Next --}}
                @if($announcements->hasMorePages())
                    <a href="{{ $announcements->nextPageUrl() . '#announcements-section' }}"
                       class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <span class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </span>
                @endif
            </nav>
            @endif

            @else
                <div class="text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">campaign</span>
                    <p class="font-headline-lg text-3xl uppercase text-on-surface-variant">Tidak ada pemberitahuan ditemukan</p>
                    <a href="{{ route('public.announcement.list') }}" class="inline-block mt-6 bg-primary text-on-primary px-8 py-4 font-label-mono border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">RESET FILTER</a>
                </div>
            @endif
        </section>
    </main>

    {{-- FOOTER --}}
    @include('layouts.partials.public-footer')

    <script>
        // Category dropdown toggle
        const catToggle = document.getElementById('categoryToggle');
        const catDropdown = document.getElementById('categoryDropdown');
        if (catToggle && catDropdown) {
            catToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                catDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function() {
                catDropdown.classList.add('hidden');
            });
            catDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // Scroll ke filter section hanya jika ada hash #announcements-section di URL
        if (window.location.hash === '#announcements-section') {
            var section = document.getElementById('announcements-section');
            if (section) {
                setTimeout(function() { section.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 100);
            }
        }

        // Search form: append hash on submit agar scroll tetap jalan
        var searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', function() {
                this.action = this.action.split('#')[0] + '#announcements-section';
            });
        }

        // Mobile sidebar
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

            document.querySelectorAll('.btn-press').forEach(function(button) {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translate(4px, 4px)';
                    if (!this.classList.contains('dot')) this.style.boxShadow = 'none';
                });
                button.addEventListener('mouseup', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });
        });
    </script>
</body>
</html>