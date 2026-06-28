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
    <title>Galeri | Merdeka Warta</title>
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
        .bento-grid-gallery { display: grid; gap: 12px; grid-template-columns: repeat(2, 1fr); }
        @media (min-width: 768px) { .bento-grid-gallery { gap: 16px; grid-template-columns: repeat(3, 1fr); } }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        #mobile-sidebar.closed { transform: translateX(100%); }
        #mobile-sidebar:not(.closed) { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.closed { opacity: 0 !important; pointer-events: none !important; }
        #sidebar-overlay:not(.closed) { opacity: 1 !important; pointer-events: auto !important; }
        #previewModal { transition: opacity 0.3s ease; }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 15s linear infinite; }
    </style>
</head>
<body class="font-body-md text-on-surface min-h-screen flex flex-col">

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-4 md:px-margin-desktop py-8 md:py-12">

        {{-- PAGE TITLE --}}
        <div class="mb-10 md:mb-12 text-center">
            <div class="flex items-center justify-center gap-3 mb-3">
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-primary rounded"></span>
                <h1 class="font-headline-lg text-3xl sm:text-4xl md:text-5xl uppercase tracking-tighter">GALERI SMK MERDEKA</h1>
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-secondary rounded"></span>
            </div>
            <div class="h-1 w-20 md:w-24 bg-primary rounded mx-auto"></div>
        </div>

        {{-- BENTO GALLERY GRID --}}
        @if($galleries->isNotEmpty())
        <div class="bento-grid-gallery">
            @foreach($galleries as $g)
                <div class="bg-white dark:bg-surface-container rounded-xl bento-shadow bento-card bento-shadow-hover overflow-hidden group cursor-pointer open-preview"
                     data-image="{{ $g->image_url }}"
                     data-caption="{{ $g->caption ?? 'Momen SMK Merdeka' }}"
                     data-date="{{ $g->created_at->format('d F Y') }}">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img alt="{{ $g->caption ?? 'Momen SMK Merdeka' }}"
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                             src="{{ $g->image_url }}"
                             loading="lazy">
                    </div>
                    <div class="p-3 md:p-4 border-t border-outline-variant">
                        <h3 class="font-headline-lg text-sm md:text-base uppercase leading-tight truncate">{{ $g->caption ?? 'Momen SMK Merdeka' }}</h3>
                        <span class="font-label-mono text-[10px] text-on-surface-variant uppercase">{{ $g->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($galleries->hasPages())
        @php
            $currentPage = $galleries->currentPage();
            $lastPage = $galleries->lastPage();
            $window = 5;
            if ($lastPage <= $window) { $start = 1; $end = $lastPage; }
            else { $start = max(1, min($currentPage, $lastPage - $window + 1)); $end = min($lastPage, $start + $window - 1); }
            $pageRange = range($start, $end);
        @endphp
        <nav class="flex justify-center items-center mt-10 gap-2">
            @if($galleries->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center bg-surface-container-high rounded-xl opacity-50">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $galleries->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif
            <div class="flex gap-1.5">
                @foreach($pageRange as $page)
                    @if($page == $currentPage)
                        <span class="w-10 h-10 flex items-center justify-center bg-primary text-on-primary font-label-mono rounded-xl bento-shadow">{{ $page }}</span>
                    @else
                        <a href="{{ $galleries->url($page) }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container font-label-mono rounded-xl hover:bg-surface-container-high transition-colors bento-shadow">{{ $page }}</a>
                    @endif
                @endforeach
            </div>
            @if($galleries->hasMorePages())
                <a href="{{ $galleries->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-surface-container rounded-xl bento-shadow hover:bg-primary hover:text-on-primary transition-all bento-card">
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
            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">photo_library</span>
            <p class="font-headline-lg text-2xl uppercase text-on-surface-variant">Belum ada galeri</p>
        </div>
        @endif
    </main>

    {{-- PREVIEW MODAL --}}
    <div class="fixed inset-0 z-[100] items-center justify-center hidden" id="previewModal">
        <div class="fixed inset-0 bg-on-background/80 backdrop-blur-sm" id="previewOverlay"></div>
        <div class="relative z-10 w-[92%] max-w-4xl max-h-[90vh] flex flex-col">
            <button class="absolute -top-3 -right-3 z-20 w-10 h-10 flex items-center justify-center bg-error text-on-error rounded-xl bento-shadow hover:bg-error/90 transition-all bento-card" id="closePreview">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="bg-white dark:bg-surface-container rounded-xl bento-shadow overflow-hidden flex flex-col md:flex-row border-2 border-black dark:border-gray-700">
                <div class="md:w-3/4 bg-on-background flex items-center justify-center min-h-[280px]">
                    <img id="previewImage" class="w-full h-full object-contain max-h-[70vh]" src="" alt="">
                </div>
                <div class="md:w-1/4 p-5 md:p-6 border-t md:border-t-0 md:border-l border-outline-variant flex flex-col justify-center gap-3">
                    <span class="material-symbols-outlined text-4xl text-primary">photo</span>
                    <h3 id="previewCaption" class="font-headline-lg text-xl uppercase leading-tight"></h3>
                    <div class="flex items-center gap-1.5 font-label-mono text-[10px] text-on-surface-variant uppercase">
                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                        <span id="previewDate"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.public-footer')

    <script>
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

            // Preview Modal
            const previewModal = document.getElementById('previewModal');
            const previewOverlay = document.getElementById('previewOverlay');
            const closePreview = document.getElementById('closePreview');
            const previewImage = document.getElementById('previewImage');
            const previewCaption = document.getElementById('previewCaption');
            const previewDate = document.getElementById('previewDate');
            const previewTriggers = document.querySelectorAll('.open-preview');

            function openPreview(img, cap, date) {
                previewImage.src = img;
                previewCaption.textContent = cap;
                previewDate.textContent = date;
                previewModal.classList.remove('hidden');
                previewModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closePreviewModal() {
                previewModal.classList.add('hidden');
                previewModal.style.display = '';
                document.body.style.overflow = '';
            }

            previewTriggers.forEach(function(el) {
                el.addEventListener('click', function() {
                    openPreview(el.dataset.image, el.dataset.caption, el.dataset.date);
                });
            });

            closePreview.addEventListener('click', closePreviewModal);
            previewOverlay.addEventListener('click', closePreviewModal);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) closePreviewModal();
            });
        });
    </script>
</body>
</html>