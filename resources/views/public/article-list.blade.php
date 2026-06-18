<!DOCTYPE html>
<html lang="id">
<head>
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
        .carousel-item { display: none; opacity: 0; transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .carousel-item.active { display: flex; opacity: 1; }
        .carousel-item .slide-content { transform: translateY(20px); opacity: 0; transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); transition-delay: 200ms; }
        .carousel-item.active .slide-content { transform: translateY(0); opacity: 1; }
        .carousel-item .slide-image { transform: scale(1.1); transition: transform 1.2s ease-out; }
        .carousel-item.active .slide-image { transform: scale(1); }
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

        {{-- TITLE SECTION --}}
        <div class="mb-12 text-center relative">
            <div class="relative inline-flex items-center justify-center gap-2 md:gap-8">
                <div class="flex gap-2 md:gap-3 items-center">
                    <div class="w-4 h-4 md:w-8 md:h-8 bg-primary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] sticker-tilt"></div>
                    <div class="w-3 h-3 md:w-6 md:h-6 rounded-full bg-secondary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
                    <div class="w-0 h-0 border-l-[8px] md:border-l-[15px] border-l-transparent border-r-[8px] md:border-r-[15px] border-r-transparent border-b-[14px] md:border-b-[26px] border-b-tertiary-container relative after:content-[''] after:absolute after:top-[2px] md:after:top-[3px] after:-left-[6px] md:after:-left-[12px] after:border-l-[6px] md:after:border-l-[12px] after:border-l-transparent after:border-r-[6px] md:after:border-r-[12px] after:border-r-transparent after:border-b-[10px] md:after:border-b-[20px] after:border-b-on-background after:-z-10 sticker-tilt-alt"></div>
                </div>
                <h1 class="font-headline-lg text-3xl sm:text-5xl md:text-6xl uppercase tracking-tighter text-on-surface relative z-10">
                    Merdeka Article
                </h1>
                <div class="flex gap-2 md:gap-3 items-center">
                    <div class="w-0 h-0 border-l-[8px] md:border-l-[15px] border-l-transparent border-r-[8px] md:border-r-[15px] border-r-transparent border-b-[14px] md:border-b-[26px] border-b-tertiary-container relative after:content-[''] after:absolute after:top-[2px] md:after:top-[3px] after:-left-[6px] md:after:-left-[12px] after:border-l-[6px] md:after:border-l-[12px] after:border-l-transparent after:border-r-[6px] md:after:border-r-[12px] after:border-r-transparent after:border-b-[10px] md:after:border-b-[20px] after:border-b-on-background after:-z-10 sticker-tilt"></div>
                    <div class="w-3 h-3 md:w-6 md:h-6 rounded-full bg-secondary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] sticker-tilt-alt"></div>
                    <div class="w-4 h-4 md:w-8 md:h-8 bg-primary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
                </div>
            </div>
            <div class="h-2 w-32 bg-primary mx-auto mt-4 border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
        </div>

        {{-- HERO CAROUSEL --}}
        @if($spotlights->isNotEmpty())
        <section class="mb-16 relative">
            <div class="relative" id="hero-carousel">
                <div class="brutalist-card bg-surface-container-lowest overflow-hidden min-h-[400px]">
                    @foreach($spotlights as $s)
                        @php $art = $s->article; @endphp
                        @if(!$art) @continue @endif
                        <div class="carousel-item flex-col lg:flex-row w-full @if($loop->first) active @endif" style="opacity: @if($loop->first) 1 @else 0 @endif;">
                            <div class="lg:w-2/3 h-[400px] relative overflow-hidden bg-on-surface">
                                @if($art->image)
                                    <img alt="{{ $art->title }}" class="slide-image w-full h-full object-cover opacity-80" src="{{ $art->image }}">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-8 left-8 right-8 slide-content">
                                    <div class="inline-block bg-primary text-on-primary px-4 py-1 font-label-mono text-label-mono border-2 border-on-background mb-4 uppercase">{{ $art->category ?? 'HIGHLIGHT' }}</div>
                                    <h1 class="text-white font-headline-lg text-4xl md:text-6xl uppercase leading-none drop-shadow-lg">{{ $art->title }}</h1>
                                </div>
                            </div>
                            <div class="lg:w-1/3 p-8 flex flex-col @if($loop->index == 1) bg-secondary-fixed @elseif($loop->index == 2) bg-primary-fixed @elseif($loop->index == 3) bg-error-container @else bg-tertiary-fixed @endif border-l-0 lg:border-l-3 border-on-background justify-between">
                                <div class="slide-content">
                                    @php
                                        $textColors = ['text-on-tertiary-fixed','text-on-secondary-fixed','text-on-primary-fixed','text-on-error-container','text-on-tertiary-fixed'];
                                        $textColor = $textColors[$loop->index] ?? 'text-on-tertiary-fixed';
                                        $varColors = ['text-on-tertiary-fixed-variant','text-on-secondary-fixed-variant','text-on-primary-fixed-variant','text-on-error-container','text-on-tertiary-fixed-variant'];
                                        $varColor = $varColors[$loop->index] ?? 'text-on-tertiary-fixed-variant';
                                        $shadowColors = ['rgba(252,121,189,1)','rgba(0,74,198,1)','rgba(252,121,189,1)','rgba(252,121,189,1)','rgba(252,121,189,1)'];
                                        $shadowColor = $shadowColors[$loop->index] ?? 'rgba(252,121,189,1)';
                                    @endphp
                                    <div class="font-label-mono {{ $textColor }} mb-2 uppercase">{{ $art->category }}</div>
                                    <h3 class="font-headline-lg text-2xl mb-4 leading-tight">{{ $art->title }}</h3>
                                    <p class="font-body-md {{ $varColor }} mb-6">{{ Str::limit($art->content_text, 100) }}</p>
                                    <a href="{{ route('public.article.show', $art->slug) }}" class="inline-block bg-on-background text-surface font-label-mono px-6 py-3 border-3 border-on-background shadow-[4px_4px_0px_0px_{{ $shadowColor }}] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all self-start">
                                        LIHAT DETAIL &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($spotlights->count() > 1)
                <div class="absolute -bottom-10 left-1/2 -translate-x-1/2 flex gap-3" id="articles-section">
                    @foreach($spotlights as $s)
                        @if(!$s->article) @continue @endif
                        <button class="dot w-4 h-4 rounded-full border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all @if($loop->first) bg-primary @else bg-surface-container-highest @endif" data-slide="{{ $loop->index }}"></button>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
        @endif

        {{-- CATEGORY FILTER & SEARCH --}}
        <section class="mb-12" >
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-8">
                <div class="flex items-center gap-4 flex-wrap">
                    {{-- Hamburger Button (category dropdown trigger) --}}
                    <div class="relative">
                        <button class="w-14 h-14 rounded-full bg-white border-3 border-on-background flex items-center justify-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press" id="categoryToggle">
                            <span class="material-symbols-outlined text-3xl">menu</span>
                        </button>
                        {{-- Dropdown --}}
                        <div class="absolute top-full left-0 mt-3 w-64 bg-surface border-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] z-50 hidden" id="categoryDropdown">
                            <div class="p-4">
                                <h4 class="font-label-mono text-xs uppercase mb-4 text-on-surface-variant">Kategori</h4>
                                <div class="space-y-2">
                                    <a href="{{ route('public.article.list') }}#articles-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed transition-colors rounded">Semua Artikel</a>
                                    @foreach($categories as $cat)
                                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => $cat->category, 'page' => null])) }}#articles-section" class="block px-3 py-2 font-bold hover:bg-primary-fixed transition-colors rounded">{{ $cat->category }} ({{ $cat->total }})</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Category Filter Buttons (5 teratas) --}}
                    <div class="flex flex-wrap gap-4" id="categoryButtons">
                        <a href="{{ route('public.article.list') }}#articles-section" class="bg-secondary text-on-secondary border-3 border-on-background px-6 py-3 font-label-mono text-label-mono uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">All News</a>
                        @foreach($categories->take(5) as $cat)
                            @php
                                $colors = [
                                    'Berita' => ['bg-tertiary-container', 'text-on-tertiary-container'],
                                    'Pengumuman' => ['bg-primary', 'text-on-primary'],
                                    'Prestasi' => ['bg-error', 'text-on-error'],
                                    'Alumni' => ['bg-on-background', 'text-surface'],
                                    'Event' => ['bg-secondary', 'text-on-secondary'],
                                    'Opini' => ['bg-error', 'text-on-error'],
                                ];
                                $catColors = $colors[$cat->category] ?? ['bg-secondary', 'text-on-secondary'];
                                $isActive = request('category') === $cat->category;
                            @endphp
                            <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => $cat->category, 'page' => null])) }}#articles-section"
                               class="{{ $isActive ? 'opacity-100' : 'opacity-80 hover:opacity-100' }} {{ $catColors[0] }} {{ $catColors[1] }} border-3 border-on-background px-6 py-3 font-label-mono text-label-mono uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
                                {{ $cat->category }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('public.article.list') }}" class="relative w-full md:w-80" id="searchForm">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <input name="search" class="bg-surface border-3 border-on-background px-4 py-3 font-label-mono focus:outline-none focus:ring-0 focus:border-primary-container w-full text-sm uppercase" placeholder="SEARCH ARTICLE..." type="text" value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </form>
            </div>

            {{-- Active Filters --}}
            @if(request('category') || request('search'))
            <div class="flex flex-wrap items-center gap-3 mb-8">
                <span class="font-label-mono text-xs uppercase text-on-surface-variant">Filter aktif:</span>
                @if(request('category'))
                <span class="inline-flex items-center gap-2 bg-primary-fixed border-3 border-on-background px-4 py-2 font-label-mono text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    {{ request('category') }}
                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['category' => null, 'page' => null])) }}#articles-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                @if(request('search'))
                <span class="inline-flex items-center gap-2 bg-secondary-fixed border-3 border-on-background px-4 py-2 font-label-mono text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    "{{ request('search') }}"
                    <a href="{{ route('public.article.list', array_merge(request()->query(), ['search' => null, 'page' => null])) }}#articles-section" class="hover:text-error transition-colors">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </a>
                </span>
                @endif
                <a href="{{ route('public.article.list') }}#articles-section" class="font-label-mono text-xs text-primary hover:underline">Hapus semua</a>
            </div>
            @endif

            {{-- Article Grid --}}
            @if($articles->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter items-stretch">
                @foreach($articles as $article)
                <article class="md:col-span-4 brutalist-card bg-surface-container-lowest flex flex-col overflow-hidden group">
                    <div class="aspect-video relative overflow-hidden border-b-3 border-on-background">
                        @if($article->image)
                        <img alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:grayscale-0 transition-all duration-500" src="{{ $article->image }}">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-primary to-secondary"></div>
                        @endif
                        <span class="absolute top-3 left-3 bg-secondary text-on-secondary px-3 py-1 text-[10px] font-label-mono uppercase border-2 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">{{ $article->category ?? 'BERITA' }}</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="font-label-mono text-primary mb-2 uppercase">{{ $article->published_at->format('d M Y') }}</div>
                        <h3 class="font-headline-lg text-[28px] mb-3 uppercase leading-tight">{{ $article->title }}</h3>
                        <p class="font-body-md text-sm text-on-surface-variant mb-6">{{ Str::limit($article->content_text, 120) }}</p>
                        <a class="mt-auto inline-flex items-center font-label-mono text-primary font-bold group hover:underline" href="{{ route('public.article.show', $article->slug) }}">
                            Lihat Detail
                            <span class="material-symbols-outlined ml-2 group-hover:translate-x-2 transition-transform">arrow_forward</span>
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

                if ($lastPage <= $window) {
                    $start = 1;
                    $end = $lastPage;
                } else {
                    $start = max(1, min($currentPage, $lastPage - $window + 1));
                    $end = min($lastPage, $start + $window - 1);
                }
                $pageRange = range($start, $end);
            @endphp
            <div class="mt-16 flex justify-center items-center gap-4">
                {{-- Previous --}}
                @if($articles->onFirstPage())
                    <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() . '#articles-section' }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </a>
                @endif

                {{-- Pages --}}
                <div class="flex gap-2">
                    @foreach($pageRange as $page)
                        @php $url = $articles->url($page) . '#articles-section'; @endphp
                        @if($page == $currentPage)
                            <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-primary text-on-primary font-label-mono shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white font-label-mono hover:bg-surface-variant transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                {{-- Next --}}
                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() . '#articles-section' }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </a>
                @else
                    <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </span>
                @endif
            </div>
            @endif

        @else
            <div class="text-center py-20">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">newspaper</span>
                <p class="font-headline-lg text-3xl uppercase text-on-surface-variant">Tidak ada artikel ditemukan</p>
                <a href="{{ route('public.article.list') }}" class="inline-block mt-6 bg-primary text-on-primary px-8 py-4 font-label-mono border-3 border-on-background brutalist-shadow-sm hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">RESET FILTER</a>
            </div>
        @endif
        </section>
    </main>

    {{-- FOOTER --}}
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

            dots.forEach(function(d) {
                d.classList.remove('bg-primary');
                d.classList.add('bg-surface-container-highest');
            });
            if (dots[index]) {
                dots[index].classList.remove('bg-surface-container-highest');
                dots[index].classList.add('bg-primary');
            }

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
                dot.addEventListener('click', function() {
                    showSlide(index);
                    startAutoSlide();
                });
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
            document.addEventListener('click', function() {
                catDropdown.classList.add('hidden');
            });
            catDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // Scroll ke filter section hanya jika ada hash #articles-section di URL
        if (window.location.hash === '#articles-section') {
            var section = document.getElementById('articles-section');
            if (section) {
                setTimeout(function() { section.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 100);
            }
        }

        // Search form: append hash on submit agar scroll tetap jalan
        var searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', function() {
                this.action = this.action.split('#')[0] + '#articles-section';
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
