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
    <title>Merdeka Warta | Portal Berita SMK Merdeka</title>
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
        body {
            margin: 0;
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
            background-color: var(--background);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .bento-shadow { box-shadow: 3px 3px 0px 0px #000; }
        .bento-shadow-hover:hover { box-shadow: 5px 5px 0px 0px #000; transform: translateY(-2px); }
        .bento-card { border: 2px solid #000; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .bento-grid { display: grid; gap: 16px; }
        @media (min-width: 768px) { .bento-grid { gap: 20px; } }
        @media (min-width: 1024px) { .bento-grid { gap: 24px; } }
        .gallery-stack-wrapper { position: relative; width: 100%; height: 100%; }
        .gallery-stack { position: absolute; inset: 0; display: flex; overflow: hidden; border-radius: inherit; }
        .gallery-stack-item { flex: 1; min-width: 0; overflow: hidden; position: relative; cursor: pointer; transition: flex 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .gallery-stack-item:not(:first-child) { margin-left: -10%; }
        .gallery-stack-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; pointer-events: none; }
        .gallery-stack-item .overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.65), transparent); display: flex; align-items: flex-end; padding: 10px; opacity: 0; transition: opacity 0.3s ease; pointer-events: none; }
        .gallery-stack:hover .gallery-stack-item { flex: 0.3; }
        .gallery-stack:hover .gallery-stack-item:hover { flex: 2.4; }
        .gallery-stack:hover .gallery-stack-item:hover .overlay { opacity: 1; }
        .gallery-stack-item:hover img { transform: scale(1.05); }

        @keyframes scroll-gallery { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-scroll-gallery { animation: scroll-gallery 10s linear infinite; }
        @media (max-width: 767px) { .animate-scroll-gallery { animation-duration: 6s; } }

        #mobile-sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        #mobile-sidebar.closed { transform: translateX(100%); }
        #mobile-sidebar:not(.closed) { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.closed { opacity: 0 !important; pointer-events: none !important; }
        #sidebar-overlay:not(.closed) { opacity: 1 !important; pointer-events: auto !important; }
        .news-slider-track { display: flex; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .news-slider-item { flex: 0 0 100%; padding: 0 8px; }
        @media (min-width: 768px) { .news-slider-item { flex: 0 0 50%; padding: 0 6px; } }
        @media (min-width: 1024px) { .news-slider-item { flex: 0 0 33.333%; } }

        .testimonial-track { display: flex; width: max-content; animation: scroll-testimonial 40s linear infinite; }
        .testimonial-track:hover { animation-play-state: paused; }
        @keyframes scroll-testimonial { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* Intro Animation */
        #app-intro {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--background);
            transition: opacity 0.5s ease;
        }
        #intro-content {
            display: flex;
            align-items: center;
            gap: 0;
            opacity: 0;
            transform: scale(0.4);
            transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #intro-logo {
            width: auto;
            height: 80px;
            transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        #intro-text {
            font-family: 'Anton', sans-serif;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            color: var(--on-surface);
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            white-space: nowrap;
        }
        .intro-logo-show #intro-content {
            opacity: 1;
            transform: scale(1);
        }
        .intro-text-show #intro-content {
            gap: 16px;
        }
        .intro-text-show #intro-text {
            opacity: 1;
            transform: translateX(0);
        }
        .intro-split #intro-content {
            gap: 0;
        }
        .intro-split #intro-logo {
            transform: translateX(-30px);
        }
        .intro-split #intro-text {
            opacity: 0;
            transform: translateX(60px);
        }
        .intro-split #intro-text {
            opacity: 1;
            transform: translateX(0);
        }
        .intro-lift #app-intro {
            opacity: 0;
            pointer-events: none;
        }
        .intro-lift #intro-content {
            transform: translateY(-50vh) scale(0.35);
            opacity: 0;
        }
        .intro-lift #intro-text {
            opacity: 0;
        }
        .intro-lift #intro-logo {
            transform: translateX(-20px);
        }

        .navbar-hidden {
            opacity: 0 !important;
            transform: translateY(-100%) !important;
            transition: none !important;
        }
        .navbar-reveal {
            animation: slide-down 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards !important;
        }
        @keyframes slide-down {
            0% { opacity: 0; transform: translateY(-100%); }
            100% { opacity: 1; transform: translateY(0); }
        }

        [data-intro-pop] {
            opacity: 0;
            transform: scale(0.8);
        }
        [data-intro-pop].pop-reveal {
            animation: pop-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        @keyframes pop-in {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }

        [data-intro-fade] {
            opacity: 0;
            transform: translateY(30px);
        }
        [data-intro-fade].fade-reveal {
            animation: fade-up 0.6s ease-out forwards;
        }
        @keyframes fade-up {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .intro-skip #app-intro { display: none; }
        .intro-skip .navbar-hidden { opacity: 1 !important; transform: translateY(0) !important; }
        .intro-skip [data-intro-pop] { opacity: 1; transform: scale(1); }
        .intro-skip [data-intro-fade] { opacity: 1; transform: translateY(0); }
    </style>
    @include('layouts.partials.pattern-styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="text-on-surface font-body-md">

    <div id="app-intro">
        <div id="intro-content">
            <img id="intro-logo" src="{{ asset('smk-merdeka-logo.png') }}" alt="SMK Merdeka">
            <span id="intro-text">MERDEKA WARTA</span>
        </div>
    </div>

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="w-full max-w-[1440px] mx-auto px-4 md:px-16 max-lg:px-8 py-8 md:py-12 box-border">

        {{-- ============================================================ --}}
        {{-- BENTO HERO + SPOTLIGHT + ANNOUNCEMENTS --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 bento-grid grid-cols-2 md:grid-cols-6 lg:grid-cols-12 auto-rows-auto" data-intro-pop>

            {{-- Featured Hero --}}
            @forelse($spotlights->take(1) as $s)
                @php $article = $s->article; @endphp
                <div class="col-span-2 md:col-span-4 lg:col-span-7 md:row-span-2 bento-card relative overflow-hidden rounded-xl bento-shadow bento-shadow-hover bg-surface-container-highest min-h-[320px] md:min-h-[460px] max-lg:min-h-[340px] flex flex-col justify-end group">
                    @if($article->image)
                        <img alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $article->image }}">
                    @else
                        <div class="absolute inset-0 bg-primary"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                    <div class="relative z-10 p-5 md:p-8 max-lg:p-5">
                        <span class="inline-flex items-center gap-1.5 bg-primary text-on-primary font-label-mono text-[10px] md:text-xs px-3 py-1 rounded mb-3 md:mb-4">
                            {{ $article->category ?? 'FEATURED' }}
                        </span>
                        <h1 class="font-headline-lg text-xl md:text-3xl lg:text-4xl max-lg:text-2xl text-white mb-2 md:mb-3 leading-none uppercase [text-shadow:0_2px_8px_rgba(0,0,0,0.6),0_0_4px_rgba(0,0,0,0.4)]">{{ $article->title }}</h1>
                        <p class="text-white/80 font-body-md text-xs md:text-sm mb-3 md:mb-4 max-w-xl line-clamp-2 md:line-clamp-3">{{ Str::limit($article->content_text, 200) }}</p>
                        <a href="{{ route('public.article.show', $article->slug) }}" class="inline-flex items-center gap-1.5 bg-blue-300 text-blue-900 px-5 py-2 md:px-6 md:py-2.5 font-bold rounded-xl text-xs md:text-sm hover:bg-blue-200 transition-all">
                            BACA SELENGKAPNYA <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 md:col-span-4 lg:col-span-7 md:row-span-2 bento-card relative overflow-hidden rounded-xl bento-shadow bg-primary min-h-[320px] md:min-h-[460px] flex items-center justify-center">
                    @if($articles->isEmpty())
                        <div class="text-center text-on-primary p-8">
                            <span class="material-symbols-outlined text-5xl md:text-6xl mb-4">description</span>
                            <h1 class="font-headline-lg text-2xl md:text-4xl uppercase">Belum Ada Artikel</h1>
                            <p class="font-body-md text-sm md:text-base mt-2">Belum ada artikel yang diterbitkan.</p>
                        </div>
                    @else
                        <div class="text-center text-on-primary p-8">
                            <span class="material-symbols-outlined text-5xl md:text-6xl mb-4">newspaper</span>
                            <h1 class="font-headline-lg text-2xl md:text-4xl uppercase">Selamat Datang</h1>
                            <p class="font-body-md text-sm md:text-base mt-2">Portal Berita SMK Merdeka</p>
                        </div>
                    @endif
                </div>
            @endforelse

            {{-- Spotlight secondary --}}
            @php $secondarySpotlight = $spotlights->skip(1)->take(2); @endphp
            @foreach($secondarySpotlight as $i => $s)
                @php $art = $s->article; @endphp
                @if($art)
                <a href="{{ route('public.article.show', $art->slug) }}" class="col-span-1 md:col-span-2 lg:col-span-5 bento-card relative overflow-hidden rounded-xl bento-shadow bento-shadow-hover min-h-[140px] md:min-h-[200px] max-lg:min-h-[150px] flex flex-col justify-end group">
                    @if($art->image)
                        <img alt="{{ $art->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $art->image }}">
                    @else
                        <div class="absolute inset-0 bg-secondary"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/5 to-transparent"></div>
                    <div class="relative z-10 p-4 md:p-5">
                        <span class="inline-flex items-center gap-1.5 bg-primary text-on-primary text-[10px] font-label-mono uppercase px-2 py-0.5 rounded mb-1">{{ $art->category ?? 'BERITA' }}</span>
                        <h2 class="font-headline-lg text-sm md:text-lg text-white leading-tight uppercase mt-1 [text-shadow:0_2px_8px_rgba(0,0,0,0.6),0_0_4px_rgba(0,0,0,0.4)]">{{ $art->title }}</h2>
                    </div>
                </a>
                @endif
            @endforeach

            {{-- Announcements bento cards --}}
            <div class="col-span-2 md:col-span-2 lg:col-span-5 bento-card rounded-xl bento-shadow bg-tertiary-fixed dark:bg-surface-container-high p-4 md:p-5 max-lg:p-4 flex flex-col min-h-[200px] max-lg:min-h-[160px]">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-tertiary text-xl">campaign</span>
                    <h2 class="font-headline-lg text-lg md:text-xl uppercase" data-intro-fade>PENGUMUMAN</h2>
                </div>
                @if(isset($spotlightAnnouncement) && $spotlightAnnouncement && $spotlightAnnouncement->announcement)
                    @php $featAnn = $spotlightAnnouncement->announcement; @endphp
                    <a href="{{ route('public.announcement.show', $featAnn->id) }}" class="block p-3 bg-white/80 dark:bg-surface-container dark:hover:bg-surface-container-high rounded-xl hover:bg-white transition-all mb-2 bento-shadow">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-secondary text-lg flex-shrink-0">star</span>
                            <div>
                                <h3 class="font-headline-lg text-sm uppercase leading-tight">{{ $featAnn->title }}</h3>
                                <p class="font-body-md text-xs text-on-surface-variant line-clamp-1 mt-0.5">{{ $featAnn->content_text }}</p>
                            </div>
                        </div>
                    </a>
                @endif
                @if($announcements->isNotEmpty())
                    <div class="flex-1 space-y-1.5 overflow-hidden">
                        @foreach($announcements->take(2) as $ann)
                            <a href="{{ route('public.announcement.show', $ann->id) }}" class="block p-2.5 bg-white/60 dark:bg-surface-container dark:hover:bg-surface-container-high rounded hover:bg-white/90 transition-all text-xs">
                                <span class="font-label-mono text-[10px] text-tertiary">{{ $ann->created_at->format('d F Y') }}</span>
                                <p class="font-bold truncate">{{ $ann->title }}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-center py-4">
                        <span class="material-symbols-outlined text-2xl text-on-surface-variant/40">campaign</span>
                        <p class="font-body-md text-xs text-on-surface-variant/60 mt-1">Belum ada pengumuman.</p>
                    </div>
                @endif
                <a href="{{ route('public.announcement.list') }}" class="mt-auto text-xs font-label-mono text-primary hover:underline pt-2">Lihat semua &rarr;</a>
            </div>

            {{-- Gallery stack: 3 photos tumpuk (desktop), 1 foto (mobile) --}}
            @php $galleryStack = $galleries->take(3); @endphp
            @if($galleryStack->isNotEmpty())
            <a href="{{ route('public.gallery.list') }}" class="col-span-2 md:col-span-3 lg:col-span-4 bento-card rounded-xl bento-shadow overflow-hidden md:min-h-[160px] max-lg:min-h-[130px] block relative">
                {{-- Mobile: carousel --}}
                <div class="w-full h-[140px] md:hidden relative" id="mobileGalleryCarousel">
                    <div class="flex h-full transition-transform duration-500 ease-in-out" id="mobileGalleryTrack" style="transform: translateX(0%);">
                        @foreach($galleryStack as $g)
                        <div class="w-full h-full flex-shrink-0 relative">
                            <img alt="{{ $g->caption ?? 'Galeri Foto' }}" class="w-full h-full object-cover" src="{{ $g->image_url }}" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent flex items-end p-3">
                                <span class="text-white font-label-mono text-[10px] uppercase">{{ $g->caption ?? 'Galeri Foto' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($galleryStack->count() > 1)
                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1.5 z-10" id="mobileGalleryDots">
                        @foreach($galleryStack as $i => $g)
                        <button class="w-1.5 h-1.5 rounded-full bg-white/60 transition-all dot-mobile-gallery @if($i === 0) bg-white w-3 @endif" data-index="{{ $i }}"></button>
                        @endforeach
                    </div>
                    @endif
                </div>
                {{-- Desktop: stack 3 foto --}}
                <div class="gallery-stack-wrapper hidden md:block">
                    <div class="gallery-stack">
                        @foreach($galleryStack as $g)
                        <div class="gallery-stack-item">
                            <img alt="{{ $g->caption ?? 'Momen SMK Merdeka' }}" src="{{ $g->image_url }}" loading="lazy">
                            <div class="overlay">
                                <span class="text-white font-label-mono text-[10px] uppercase">{{ $g->caption ?? 'Galeri Foto' }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </a>
            @endif

            {{-- Category quick links --}}
            <div class="col-span-2 md:col-span-2 lg:col-span-3 bento-card rounded-xl bento-shadow bg-primary-container text-on-primary p-4 md:p-5 max-lg:p-4 flex flex-col justify-between">
                <span class="material-symbols-outlined text-2xl">explore</span>
                <div>
                    <h3 class="font-headline-lg text-lg uppercase leading-tight">Jelajahi</h3>
                    <p class="text-xs opacity-80 mt-1 font-body-md">Temukan berbagai kategori berita menarik</p>
                </div>
                <a href="{{ route('public.article.list') }}" class="text-xs font-label-mono mt-2 hover:underline">Lihat Artikel &rarr;</a>
            </div>

            {{-- Another spotlight if available --}}
            @php $thirdSpotlight = $spotlights->skip(3)->take(1)->first(); @endphp
            @if($thirdSpotlight && $thirdSpotlight->article)
                @php $art3 = $thirdSpotlight->article; @endphp
                <a href="{{ route('public.article.show', $art3->slug) }}" class="col-span-1 md:col-span-2 lg:col-span-3 bento-card relative overflow-hidden rounded-xl bento-shadow bento-shadow-hover min-h-[140px] md:min-h-[200px] max-lg:min-h-[150px] flex flex-col justify-end">
                    @if($art3->image)
                        <img alt="{{ $art3->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $art3->image }}">
                    @else
                        <div class="absolute inset-0 bg-primary"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/5 to-transparent"></div>
                    <div class="relative z-10 p-4">
                        <span class="inline-flex items-center gap-1.5 bg-primary text-on-primary text-[10px] font-label-mono uppercase px-2 py-0.5 rounded mb-1">{{ $art3->category ?? 'BERITA' }}</span>
                        <h2 class="font-headline-lg text-base md:text-lg text-white leading-tight uppercase [text-shadow:0_2px_8px_rgba(0,0,0,0.6),0_0_4px_rgba(0,0,0,0.4)]">{{ $art3->title }}</h2>
                    </div>
                </a>
            @endif

        </section>

        {{-- ============================================================ --}}
        {{-- POPULAR THIS WEEK --}}
        {{-- ============================================================ --}}
        @if($popularWeek->isNotEmpty())
        <section class="mb-12 md:mb-16 bg-dots py-6 md:py-16 -mx-4 md:-mx-16 max-lg:-mx-8 px-4 md:px-16 max-lg:px-8" data-intro-pop>
            <div class="flex items-center gap-3 mb-6 md:mb-8">
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-secondary rounded"></span>
                <h2 class="font-headline-lg text-xl md:text-3xl uppercase" data-intro-fade>TERPOPULER MINGGU INI</h2>
                <div class="h-px bg-outline-variant flex-grow hidden md:block"></div>
            </div>
            <div class="flex lg:grid lg:grid-cols-5 gap-3 md:gap-5 overflow-x-auto lg:overflow-visible pb-4 snap-x snap-mandatory scrollbar-thin">
                @foreach($popularWeek as $i => $article)
                <a href="{{ route('public.article.show', $article->slug) }}"
                   class="min-w-[220px] sm:min-w-[240px] lg:min-w-0 snap-start bento-card rounded-xl bento-shadow bento-shadow-hover bg-surface-container-low overflow-hidden flex flex-col group relative">
                    <div class="aspect-[4/3] overflow-hidden bg-surface-variant relative">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="{{ $article->title }}"
                                 class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-secondary/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-secondary/40">image</span>
                            </div>
                        @endif
                        <div class="absolute top-2 left-2 w-8 h-8 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="font-headline-lg text-sm text-on-primary">{{ $i + 1 }}</span>
                        </div>

                    </div>
                    <div class="p-3 md:p-4 flex flex-col flex-grow">
                        <span class="font-label-mono text-[10px] text-primary uppercase mb-1">{{ $article->category ?? 'BERITA' }}</span>
                        <h3 class="font-headline-lg text-sm md:text-base leading-tight uppercase group-hover:text-primary transition-colors line-clamp-2">{{ $article->title }}</h3>
                        <p class="font-label-mono text-[10px] text-on-surface-variant mt-auto pt-2">{{ $article->published_at->format('d M Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endif

        {{-- ============================================================ --}}
        {{-- NEWS SLIDER (BERITA TERBARU) --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 bg-stripes py-6 md:py-16 -mx-4 md:-mx-16 max-lg:-mx-8 px-4 md:px-16 max-lg:px-8" id="berita" data-intro-pop>
            <div class="flex items-center justify-between mb-6 md:mb-8 gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-6 md:w-2 md:h-8 bg-primary rounded"></span>
                    <h2 class="font-headline-lg text-xl md:text-3xl uppercase" data-intro-fade>BERITA TERBARU</h2>
                </div>
                <div class="h-px bg-outline-variant flex-grow hidden md:block"></div>
                @if($articles->count() > 3)
                    <div class="flex gap-2 shrink-0">
                        <button class="bg-white text-on-surface dark:bg-surface-container-high dark:text-on-surface bento-shadow rounded-xl p-2.5 hover:bg-primary hover:text-on-primary transition-all" id="newsPrevBtn">
                            <span class="material-symbols-outlined block text-lg">arrow_back</span>
                        </button>
                        <button class="bg-white text-on-surface dark:bg-surface-container-high dark:text-on-surface bento-shadow rounded-xl p-2.5 hover:bg-primary hover:text-on-primary transition-all" id="newsNextBtn">
                            <span class="material-symbols-outlined block text-lg">arrow_forward</span>
                        </button>
                    </div>
                @endif
            </div>
            @if($articles->isNotEmpty())
                <div class="overflow-hidden pb-8">
                    <div class="news-slider-track" id="newsSliderTrack" style="transform: translateX(0%);">
                        @foreach($articles as $article)
                            <div class="news-slider-item">
                                <article class="bg-surface-container-low rounded-xl bento-shadow bento-card bento-shadow-hover h-full flex flex-col overflow-hidden">
                                    <div class="aspect-video overflow-hidden bg-surface-variant">
                                        @if($article->image)
                                            <img alt="{{ $article->title }}" class="w-full h-full object-cover transition-all duration-500 hover:scale-105" src="{{ $article->image }}">
                                        @else
                                            <div class="w-full h-full bg-surface-variant"></div>
                                        @endif
                                    </div>
                                    <div class="p-5 max-lg:p-4 flex-grow flex flex-col">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="bg-white dark:bg-surface-container px-2.5 py-0.5 font-label-mono text-[10px] rounded">{{ $article->category ?? 'BERITA' }}</span>
                                            <span class="font-label-mono text-[10px] text-on-surface-variant">{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="font-bold font-headline-lg text-lg md:text-xl max-lg:text-base leading-tight mb-2 uppercase dark:text-gray-400 line-clamp-2">{{ $article->title }}</h3>
                                        <p class="font-body-md text-xs md:text-sm max-lg:text-xs text-on-surface-variant mb-4 flex-grow">{{ Str::limit($article->content_text, 120) }}</p>
                                        <a class="font-bold flex items-center gap-1.5 text-sm text-primary group" href="{{ route('public.article.show', $article->slug) }}">
                                            BACA BERITA <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center gap-2 mt-4" id="newsSliderDots">
                    <button class="w-2.5 h-2.5 rounded-full bg-primary transition-all" style="width: 1.5rem;"></button>
                </div>
            @else
                <div class="bg-white rounded-xl bento-shadow p-12 text-center">
                    <span class="material-symbols-outlined text-4xl opacity-30 mb-4 block">description</span>
                    <p class="font-label-mono text-sm uppercase opacity-60">Belum ada berita</p>
                </div>
            @endif
        </section>

        {{-- ============================================================ --}}
        {{-- CTA SECTION --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 bento-card rounded-xl bento-shadow bg-blue-900 text-blue-100 dark:bg-blue-950 dark:text-blue-100 p-8 md:p-12 max-lg:p-6 md:px-12 relative overflow-hidden" data-intro-pop>
            <div class="absolute top-0 right-0 w-40 md:w-60 h-40 md:h-60 bg-secondary/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-32 md:w-48 h-32 md:h-48 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="relative z-10 max-w-2xl mx-auto text-center">
                <span class="material-symbols-outlined text-4xl md:text-5xl mb-4 text-secondary block">edit_note</span>
                <h2 class="font-headline-lg text-2xl md:text-4xl mb-4 leading-none" data-intro-fade>PUNYA BERITA MENARIK? SUARAKAN DISINI!</h2>
                <p class="font-body-md text-sm md:text-base mb-8 text-white/70">Ayo, suarakan ide dan ceritamu! Kirimkan tulisanmu sekarang dan jadilah bagian dari Merdeka Warta.</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a class="cursor-pointer open-contributor-modal bg-primary text-on-primary rounded-xl px-8 py-3.5 font-bold text-base btn-press hover:bg-primary/90 transition-all inline-flex items-center gap-2 bento-shadow">
                        <span class="material-symbols-outlined">send</span> KIRIM DISINI
                    </a>
                </div>
            </div>
        </section>

        

        {{-- ============================================================ --}}
        {{-- TESTIMONIALS --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 bg-crosshatch py-6 md:py-16 -mx-4 md:-mx-16 max-lg:-mx-8 px-4 md:px-16 max-lg:px-8" data-intro-pop>
            <div class="flex items-center justify-between mb-6 gap-4">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-6 md:w-2 md:h-8 bg-tertiary rounded"></span>
                    <h2 class="font-headline-lg text-xl md:text-3xl uppercase" data-intro-fade>TANGGAPAN</h2>
                </div>
                <div class="h-px bg-outline-variant flex-grow hidden md:block"></div>
            </div>
            @php
                $staticTestimonials = [
                    [
                        'quote' => 'Sangat membantu untuk mengetahui info sekolah terbaru! Merdeka Warta jadi rujukan utama saya.',
                        'name' => 'Budi Santoso',
                        'role' => 'Siswa Kelas XI',
                    ],
                    [
                        'quote' => 'Desain beritanya sangat modern dan mudah dibaca oleh semua kalangan civitas akademika.',
                        'name' => 'Siti Aisyah',
                        'role' => 'Guru',
                    ],
                    [
                        'quote' => 'Informasi pengumuman sekarang jauh lebih jelas dan transparan. Sukses terus untuk tim redaksi!',
                        'name' => 'Rian Pratama',
                        'role' => 'Alumni',
                    ],
                    [
                        'quote' => 'Pelayanan administrasi sekolah jadi lebih cepat dan efisien dengan adanya portal ini!',
                        'name' => 'Dewi Sartika',
                        'role' => 'Siswa Kelas XII',
                    ],
                    [
                        'quote' => 'Semoga SMK Merdeka semakin maju dan jadi kebanggaan sekolah unggulan.',
                        'name' => 'Ahmad Fauzi',
                        'role' => 'Orang Tua Siswa',
                    ],
                    [
                        'quote' => 'Sangat membantu dalam menyebarkan informasi secara luas dan cepat ke seluruh warga sekolah.',
                        'name' => 'Nurul Hidayah',
                        'role' => 'Staff Tata Usaha',
                    ],
                ];
            @endphp
            <div class="overflow-hidden w-full">
                <div class="flex gap-6 testimonial-track">
                    @foreach($staticTestimonials as $t)
                        <div class="bg-white dark:bg-surface-container-high rounded-xl bento-shadow p-6 flex flex-col gap-4 bento-card min-w-[240px] max-w-[280px] md:max-w-[300px]">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center border-2 border-on-background bg-surface-container-high dark:bg-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-on-surface-variant"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold font-body-md text-sm text-on-surface">{{ $t['name'] }}</p>
                                    <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">{{ $t['role'] }}</p>
                                </div>
                            </div>
                            <div class="border-t border-outline-variant pt-4">
                                <span class="material-symbols-outlined text-primary text-xl leading-none select-none">format_quote</span>
                                <p class="font-body-md text-sm text-on-surface mt-1 leading-relaxed">{{ $t['quote'] }}</p>
                            </div>
                        </div>
                    @endforeach
                    @foreach($staticTestimonials as $t)
                        <div class="bg-white dark:bg-surface-container-high rounded-xl bento-shadow p-6 flex flex-col gap-4 bento-card min-w-[240px] max-w-[280px] md:max-w-[300px]">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center border-2 border-on-background bg-surface-container-high dark:bg-surface shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-on-surface-variant"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold font-body-md text-sm text-on-surface">{{ $t['name'] }}</p>
                                    <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">{{ $t['role'] }}</p>
                                </div>
                            </div>
                            <div class="border-t border-outline-variant pt-4">
                                <span class="material-symbols-outlined text-primary text-xl leading-none select-none">format_quote</span>
                                <p class="font-body-md text-sm text-on-surface mt-1 leading-relaxed">{{ $t['quote'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>

    @include('layouts.partials.contributor-modal')
    @include('layouts.partials.public-footer')

    <script>
        // Contributor Modal
        const cModal = document.getElementById('contributorModal');
        const cOverlay = document.getElementById('modalOverlay');
        const cCloseBtn = document.getElementById('closeModal');
        const cOpenBtns = document.querySelectorAll('.open-contributor-modal');
        const cForm = document.getElementById('contributorForm');
        const cSubmitBtn = document.getElementById('submitBtn');

        if (cModal && cOverlay && cCloseBtn) {
            function openCModal() { cModal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            function closeCModal() { cModal.classList.add('hidden'); document.body.style.overflow = ''; }

            cOpenBtns.forEach(function(btn) { btn.addEventListener('click', openCModal); });
            cCloseBtn.addEventListener('click', closeCModal);
            cOverlay.addEventListener('click', closeCModal);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !cModal.classList.contains('hidden')) closeCModal();
            });
        }

        if (cForm) {
            cForm.addEventListener('submit', function(e) {
                e.preventDefault();

                var nama = cForm.querySelector('[name="name"]').value;
                var kelas = cForm.querySelector('[name="class"]').value;
                var alasan = cForm.querySelector('[name="reason"]').value;
                var phone = cForm.querySelector('[name="phone"]').value;

                var pesan = 'Halo, saya ' + nama + ' dari kelas ' + kelas + '. Saya ingin bergabung menjadi kontributor Merdeka Warta.\n\n'
                          + 'Alasan: ' + alasan + '\n'
                          + 'No. HP: ' + phone;

                var waUrl = 'https://api.whatsapp.com/send/?phone=' + (window.contributorPhone || '6281322263716') + '&text=' + encodeURIComponent(pesan);

                cForm.reset();
                closeCModal();

                window.open(waUrl, '_blank');
            });
        }

        // Sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (openBtn && closeBtn && sidebar && overlay) {
                function openSidebar() { sidebar.classList.remove('closed'); overlay.classList.remove('closed'); document.body.style.overflow = 'hidden'; }
                function closeSidebar() { sidebar.classList.add('closed'); overlay.classList.add('closed'); document.body.style.overflow = ''; }
                openBtn.addEventListener('click', openSidebar);
                closeBtn.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }
        });

        // News Slider
        let newsCurrentIndex = 0;
        const newsSliderTrack = document.getElementById('newsSliderTrack');
        const newsItems = document.querySelectorAll('.news-slider-item');
        const newsDotsContainer = document.getElementById('newsSliderDots');
        let newsAutoSlideInterval;

        function getVisibleCount() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        }

        function getMaxIndex() {
            var vc = getVisibleCount();
            return Math.max(0, newsItems.length - vc);
        }

        function updateNewsSlider() {
            var vc = getVisibleCount();
            var maxIdx = newsItems.length - vc;
            if (newsCurrentIndex > maxIdx) newsCurrentIndex = Math.max(0, maxIdx);
            if (newsCurrentIndex < 0) newsCurrentIndex = 0;
            var itemPercent = 100 / vc;
            var offset = -(newsCurrentIndex * itemPercent);
            if (newsSliderTrack) newsSliderTrack.style.transform = 'translateX(' + offset + '%)';
            if (newsDotsContainer) {
                var dots = newsDotsContainer.querySelectorAll('button');
                var totalDots = newsItems.length - vc + 1;
                dots.forEach(function(btn, i) {
                    if (i === newsCurrentIndex) {
                        btn.style.backgroundColor = '#004ac6';
                        btn.style.width = window.innerWidth >= 768 ? '1.5rem' : '1.25rem';
                    } else {
                        btn.style.backgroundColor = '#edeeef';
                        btn.style.width = '1rem';
                    }
                });
            }
        }

        function createNewsDots() {
            if (!newsDotsContainer) return;
            newsDotsContainer.innerHTML = '';
            var vc = getVisibleCount();
            var count = Math.max(0, newsItems.length - vc + 1);
            if (count <= 0) return;
            for (var i = 0; i < count; i++) {
                (function(idx) {
                    var btn = document.createElement('button');
                    btn.className = 'w-2.5 h-2.5 rounded-full bg-surface-variant transition-all';
                    btn.addEventListener('click', function() {
                        newsCurrentIndex = idx;
                        updateNewsSlider();
                        startNewsAutoSlide();
                    });
                    newsDotsContainer.appendChild(btn);
                })(i);
            }
        }

        function newsNext() {
            var maxIdx = getMaxIndex();
            if (newsCurrentIndex < maxIdx) newsCurrentIndex++;
            else newsCurrentIndex = 0;
            updateNewsSlider();
        }

        function newsPrev() {
            var maxIdx = getMaxIndex();
            if (newsCurrentIndex > 0) newsCurrentIndex--;
            else newsCurrentIndex = maxIdx;
            updateNewsSlider();
        }

        function startNewsAutoSlide() {
            clearInterval(newsAutoSlideInterval);
            newsAutoSlideInterval = setInterval(newsNext, 4000);
        }

        var newsNextBtn = document.getElementById('newsNextBtn');
        var newsPrevBtn = document.getElementById('newsPrevBtn');
        if (newsNextBtn) newsNextBtn.addEventListener('click', function() { newsNext(); startNewsAutoSlide(); });
        if (newsPrevBtn) newsPrevBtn.addEventListener('click', function() { newsPrev(); startNewsAutoSlide(); });

        window.addEventListener('resize', function() {
            createNewsDots();
            updateNewsSlider();
        });

        if (newsItems.length > 0) { createNewsDots(); updateNewsSlider(); startNewsAutoSlide(); }

        // Mobile Gallery Carousel
        (function() {
            var track = document.getElementById('mobileGalleryTrack');
            var dots = document.querySelectorAll('.dot-mobile-gallery');
            if (!track || dots.length === 0) return;
            var current = 0;
            var total = dots.length;
            function goTo(index) {
                if (index < 0) index = total - 1;
                if (index >= total) index = 0;
                current = index;
                track.style.transform = 'translateX(-' + (current * 100) + '%)';
                dots.forEach(function(d, i) {
                    d.classList.toggle('bg-white', i === current);
                    d.classList.toggle('w-3', i === current);
                    d.classList.toggle('bg-white/60', i !== current);
                    d.classList.toggle('w-1.5', i !== current);
                });
            }
            dots.forEach(function(dot) {
                dot.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    goTo(parseInt(dot.dataset.index));
                });
            });
            setInterval(function() { goTo(current + 1); }, 4000);
        })();

        // Intro Animation
        (function() {
            var played = localStorage.getItem('intro_merdekawarta');
            var intro = document.getElementById('app-intro');
            var navbar = document.querySelector('.navbar-sticky');
            var main = document.querySelector('main');
            var popEls = document.querySelectorAll('[data-intro-pop]');
            var fadeEls = document.querySelectorAll('[data-intro-fade]');

            if (!intro) return;

            if (played) {
                document.body.classList.add('intro-skip');
                return;
            }

            if (navbar) navbar.classList.add('navbar-hidden');
            if (main) main.style.opacity = '0';

            // Phase 1: Logo muncul (0.3s)
            setTimeout(function() {
                intro.classList.add('intro-logo-show');
            }, 300);

            // Phase 2: Text MERDEKA WARTA muncul (1s)
            setTimeout(function() {
                intro.classList.add('intro-text-show');
            }, 1000);

            // Phase 3: Split (1.9s)
            setTimeout(function() {
                intro.classList.remove('intro-logo-show', 'intro-text-show');
                intro.classList.add('intro-split');
            }, 1900);

            // Phase 4: Lift + reveal (2.7s)
            setTimeout(function() {
                intro.style.opacity = '0';
            }, 2700);

            setTimeout(function() {
                intro.style.display = 'none';
                if (navbar) {
                    navbar.classList.remove('navbar-hidden');
                    navbar.classList.add('navbar-reveal');
                }
                if (main) {
                    main.style.transition = 'opacity 0.5s ease';
                    main.style.opacity = '1';
                }
                popEls.forEach(function(el, i) {
                    setTimeout(function() {
                        el.classList.add('pop-reveal');
                    }, 200 + i * 120);
                });
                fadeEls.forEach(function(el, i) {
                    setTimeout(function() {
                        el.classList.add('fade-reveal');
                    }, 300 + i * 100);
                });
                localStorage.setItem('intro_merdekawarta', 'true');
            }, 3200);
        })();
    </script>

    <script>
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark-mode', isDark);
            const icon = document.getElementById('theme-icon-public');
            if (icon) {
                icon.textContent = isDark ? 'light_mode' : 'dark_mode';
            }
            const iconMobile = document.getElementById('theme-icon-public-mobile');
            if (iconMobile) {
                iconMobile.textContent = isDark ? 'light_mode' : 'dark_mode';
            }
        }
    </script>
</body>
</html>