<!DOCTYPE html>
<html lang="id">
<head>
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
        body { background-color: #f8f9fa; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .sticker-tilt { transform: rotate(-2deg); }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: none !important; }
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

    {{-- NAVBAR --}}
    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="flex-grow max-w-[1440px] mx-auto w-full px-4 md:px-margin-desktop py-12">

        {{-- PAGE TITLE --}}
        <div class="mb-12 text-center">
            <div class="relative inline-flex items-center justify-center gap-2 md:gap-8">
                <div class="flex gap-2 md:gap-3 items-center">
                    <div class="w-4 h-4 md:w-8 md:h-8 bg-primary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] sticker-tilt"></div>
                    <div class="w-3 h-3 md:w-6 md:h-6 rounded-full bg-secondary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
                </div>
                <h1 class="font-headline-lg text-3xl sm:text-5xl md:text-6xl uppercase tracking-tighter text-on-surface relative z-10">
                    GALERI SMK MERDEKA
                </h1>
                <div class="flex gap-2 md:gap-3 items-center">
                    <div class="w-3 h-3 md:w-6 md:h-6 rounded-full bg-secondary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] sticker-tilt"></div>
                    <div class="w-4 h-4 md:w-8 md:h-8 bg-primary-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
                </div>
            </div>
            <div class="h-2 w-32 bg-primary mx-auto mt-4 border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
        </div>

        {{-- GALLERY GRID --}}
        @if($galleries->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $g)
            <div class="brutalist-border brutalist-shadow bg-surface-container-lowest overflow-hidden group cursor-pointer open-preview"
                 data-image="{{ $g->image_url }}"
                 data-caption="{{ $g->caption ?? 'Momen SMK Merdeka' }}"
                 data-date="{{ $g->created_at->format('d F Y') }}">
                <div class="aspect-square overflow-hidden">
                    <img alt="{{ $g->caption ?? 'Momen SMK Merdeka' }}"
                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                         src="{{ $g->image_url }}"
                         loading="lazy">
                </div>
                <div class="p-4 border-t-3 border-on-background">
                    <h3 class="font-headline-lg text-lg uppercase leading-tight truncate">{{ $g->caption ?? 'Momen SMK Merdeka' }}</h3>
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
        <nav class="flex justify-center items-center mt-16 gap-3">
            @if($galleries->onFirstPage())
                <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $galleries->previousPageUrl() }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif
            <div class="flex gap-2">
                @foreach($pageRange as $page)
                    @if($page == $currentPage)
                        <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-primary text-on-primary font-label-mono shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">{{ $page }}</span>
                    @else
                        <a href="{{ $galleries->url($page) }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white font-label-mono hover:bg-surface-variant transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
            </div>
            @if($galleries->hasMorePages())
                <a href="{{ $galleries->nextPageUrl() }}" class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            @else
                <span class="w-12 h-12 flex items-center justify-center border-3 border-on-background bg-surface-variant shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] opacity-50">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
            @endif
        </nav>
        @endif

        @else
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">photo_library</span>
            <p class="font-headline-lg text-3xl uppercase text-on-surface-variant">Belum ada galeri</p>
        </div>
        @endif
    </main>

    {{-- PREVIEW MODAL --}}
    <div class="fixed inset-0 z-[100] items-center justify-center hidden" id="previewModal">
        <div class="fixed inset-0 bg-on-background/80 backdrop-blur-sm" id="previewOverlay"></div>
        <div class="relative z-10 w-[92%] max-w-4xl max-h-[90vh] flex flex-col">
            <button class="absolute -top-4 -right-4 z-20 w-12 h-12 flex items-center justify-center bg-error text-on-error border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all btn-press" id="closePreview">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="bg-surface border-4 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] overflow-hidden flex flex-col md:flex-row">
                <div class="md:w-3/4 bg-on-background flex items-center justify-center min-h-[300px]">
                    <img id="previewImage" class="w-full h-full object-contain max-h-[70vh]" src="" alt="">
                </div>
                <div class="md:w-1/4 p-6 border-t-4 md:border-t-0 md:border-l-4 border-on-background flex flex-col justify-center gap-4">
                    <span class="material-symbols-outlined text-5xl text-primary">photo</span>
                    <h3 id="previewCaption" class="font-headline-lg text-2xl uppercase leading-tight"></h3>
                    <div class="flex items-center gap-2 font-label-mono text-xs text-on-surface-variant uppercase">
                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                        <span id="previewDate"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('layouts.partials.public-footer')

    <script>
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
                    openPreview(
                        el.dataset.image,
                        el.dataset.caption,
                        el.dataset.date
                    );
                });
            });

            closePreview.addEventListener('click', closePreviewModal);
            previewOverlay.addEventListener('click', closePreviewModal);
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) closePreviewModal();
            });

            // Brutalist button interactions
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