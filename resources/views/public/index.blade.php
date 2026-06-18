<!DOCTYPE html>
<html lang="id">
<head>
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
                        "surface-tint": "#0053db", "on-primary-fixed-variant": "#003ea8", "primary-fixed": "#dbe1ff",
                        "surface-bright": "#f8f9fa", "primary-fixed": "#dbe1ff"
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
        .brutalist-shadow-hover:hover { transform: translate(-2px, -2px); box-shadow: 10px 10px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .sticker-tilt { transform: rotate(-2deg); }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 15s linear infinite; }
        @keyframes scroll-gallery { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-scroll-gallery { animation: scroll-gallery 10s linear infinite; }
        @media (max-width: 767px) { .animate-scroll-gallery { animation-duration: 6s; } }
        @keyframes scroll-testimonials { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-scroll-testimonials { animation: scroll-testimonials 10s linear infinite; }
        .pause-on-hover:hover .animate-scroll-testimonials { animation-play-state: paused; }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 1); }
        #mobile-sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        #mobile-sidebar.closed { transform: translateX(100%); }
        #mobile-sidebar:not(.closed) { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.closed { opacity: 0 !important; pointer-events: none !important; }
        #sidebar-overlay:not(.closed) { opacity: 1 !important; pointer-events: auto !important; }
        .carousel-container { position: relative; overflow: hidden; }
        .carousel-slide { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; pointer-events: none; transition: opacity 0.5s ease-in-out; display: flex; flex-direction: column; justify-content: flex-end; }
        .carousel-slide.active { opacity: 1; pointer-events: auto; position: relative; }
        .hero-height { min-height: 400px; }
        @media (min-width: 768px) { .hero-height { min-height: 500px; } }
        .news-slider-track { display: flex; transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .news-slider-item { flex: 0 0 100%; padding: 0 12px; }
        @media (min-width: 768px) { .news-slider-item { flex: 0 0 50%; } }
        @media (min-width: 1024px) { .news-slider-item { flex: 0 0 33.333%; } }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="text-on-surface">

    {{-- NAVBAR + TICKER --}}
    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="max-w-[1440px] mx-auto px-4 md:px-margin-desktop py-8 md:py-12">

        {{-- ============================================================ --}}
        {{-- HERO SECTION WITH CAROUSEL + ANNOUNCEMENTS SIDEBAR --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 grid grid-cols-1 lg:grid-cols-12 gap-gutter pb-4">

            {{-- Hero Carousel --}}
            <div class="lg:col-span-8 group relative brutalist-border brutalist-shadow bg-surface-container-highest hero-height carousel-container" id="hero-carousel">
                @forelse($spotlights as $s)
                    <div class="carousel-slide p-6 md:p-8 @if($loop->first) active @endif">
                        @php $article = $s->article; @endphp
                        @if($article->image)
                            <img alt="{{ $article->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $article->image }}">
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                        <div class="relative z-10">
                            <span class="inline-block bg-primary text-on-primary font-label-mono text-[10px] md:text-label-mono px-3 py-1 md:px-4 md:py-2 brutalist-border brutalist-shadow-sm sticker-tilt mb-4 md:mb-6">{{ $article->category ?? 'FEATURED' }}</span>
                            <h1 class="font-headline-lg text-2xl md:text-headline-lg text-white mb-2 md:mb-4 leading-none uppercase">{{ $article->title }}</h1>
                            <p class="text-white/90 font-body-md text-sm md:text-body-md mb-4 md:mb-6 max-w-xl line-clamp-3 md:line-clamp-none">{{ Str::limit($article->content_text, 200) }}</p>
                            <a href="{{ route('public.article.show', $article->slug) }}" class="inline-block bg-white text-on-surface brutalist-border brutalist-shadow-sm px-6 py-2 md:px-8 md:py-3 font-bold flex items-center gap-2 btn-press w-fit text-sm md:text-base">
                                BACA SELENGKAPNYA <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="carousel-slide p-6 md:p-8 active">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                            <div class="text-center text-on-primary">
                                <span class="material-symbols-outlined text-6xl mb-4">newspaper</span>
                                <h1 class="font-headline-lg text-3xl md:text-5xl uppercase">Selamat Datang</h1>
                                <p class="font-body-md text-lg mt-2">Portal Berita SMK Merdeka</p>
                            </div>
                        </div>
                    </div>
                @endforelse

                @if($spotlights->count() > 1)
                    <div class="absolute top-1/2 -translate-y-1/2 -left-4 md:-left-10 z-20 hidden sm:block">
                        <button class="bg-white/90 text-on-surface brutalist-border brutalist-shadow-sm p-2 hover:bg-white btn-press transition-all" id="prevBtn">
                            <span class="material-symbols-outlined block">arrow_back</span>
                        </button>
                    </div>
                    <div class="absolute top-1/2 -translate-y-1/2 -right-4 md:-right-10 z-20 hidden sm:block">
                        <button class="bg-white/90 text-on-surface brutalist-border brutalist-shadow-sm p-2 hover:bg-white btn-press transition-all" id="nextBtn">
                            <span class="material-symbols-outlined block">arrow_forward</span>
                        </button>
                    </div>
                    <div class="relative md:absolute mt-6 md:mt-0 bottom-0 md:bottom-6 left-1/2 -translate-x-1/2 z-20 flex justify-center gap-2 md:gap-3" id="hero-dots">
                        @foreach($spotlights as $s)
                            <button class="carousel-dot w-3 h-3 md:w-4 md:h-4 rounded-full border-2 border-on-background transition-all" data-slide="{{ $loop->index }}" style="background-color: {{ $loop->first ? 'white' : 'rgba(255,255,255,0.5)' }}; width: {{ $loop->first ? '1.5rem' : '1rem' }};"></button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Announcements Sidebar --}}
            <div class="lg:col-span-4 flex flex-col gap-gutter" id="pengumuman">
                <div class="brutalist-border brutalist-shadow bg-tertiary-fixed p-6 flex flex-col h-full">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-tertiary text-4xl">campaign</span>
                        <h2 class="font-headline-lg text-2xl md:text-3xl uppercase">PENGUMUMAN</h2>
                    </div>
                    @if($announcements->isNotEmpty())
                        <ul class="space-y-4 flex-grow">
                            @foreach($announcements as $ann)
                                <li>
                                    <a href="{{ route('public.announcement.show', $ann->id) }}" class="block p-4 bg-white brutalist-border brutalist-shadow-sm hover:-translate-y-1 transition-transform">
                                        <span class="material-symbols-outlined text-tertiary font-bold mb-2 block">campaign</span>
                                        <span class="font-label-mono text-xs text-tertiary">{{ $ann->created_at->format('d F Y') }}</span>
                                        <p class="font-bold font-body-md text-sm md:text-body-md mt-1">{{ $ann->title }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="flex-grow flex items-center justify-center">
                            <p class="font-label-mono text-sm uppercase opacity-40">Belum ada pengumuman</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- NEWS SLIDER (BERITA TERBARU) --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 relative" id="berita">
            <div class="flex items-center justify-between mb-8 gap-4">
                <h2 class="font-headline-lg text-2xl md:text-headline-lg uppercase whitespace-nowrap">BERITA TERBARU</h2>
                <div class="h-1 bg-on-background flex-grow hidden md:block"></div>
                @if($articles->count() > 3)
                    <div class="flex gap-2 md:gap-4 shrink-0">
                        <button class="bg-surface text-on-surface brutalist-border brutalist-shadow-sm p-2 md:p-3 btn-press hover:bg-primary hover:text-on-primary transition-all" id="newsPrevBtn">
                            <span class="material-symbols-outlined block">arrow_back</span>
                        </button>
                        <button class="bg-surface text-on-surface brutalist-border brutalist-shadow-sm p-2 md:p-3 btn-press hover:bg-primary hover:text-on-primary transition-all" id="newsNextBtn">
                            <span class="material-symbols-outlined block">arrow_forward</span>
                        </button>
                    </div>
                @endif
            </div>
            @if($articles->isNotEmpty())
                <div class="overflow-hidden pb-8 px-2 -mx-2">
                    <div class="news-slider-track" id="newsSliderTrack" style="transform: translateX(0%);">
                        @foreach($articles as $article)
                            <div class="news-slider-item">
                                <article class="brutalist-border brutalist-shadow @if($loop->even) bg-tertiary-fixed @else bg-secondary-fixed @endif h-full transition-all flex flex-col"
                                    style="@if($loop->index == 2 || $loop->index == 5 || $loop->index == 8) background-color: #dbe1ff; @endif">
                                    <div class="aspect-video brutalist-border m-4 overflow-hidden bg-surface-variant">
                                        @if($article->image)
                                            <img alt="{{ $article->title }}" class="w-full h-full object-cover" src="{{ $article->image }}">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-tertiary to-secondary-container"></div>
                                        @endif
                                    </div>
                                    <div class="p-6 flex-grow flex flex-col">
                                        <span class="inline-block bg-secondary text-on-secondary px-3 py-1 font-label-mono text-[10px] brutalist-border mb-4 w-fit sticker-tilt">{{ $article->category ?? 'BERITA' }}</span>
                                        <h3 class="font-bold font-headline-lg text-xl md:text-2xl leading-tight mb-4 uppercase">{{ $article->title }}</h3>
                                        <p class="font-body-md text-sm md:text-body-md mb-6 flex-grow">{{ Str::limit($article->content_text, 120) }}</p>
                                        <a class="font-bold flex items-center gap-2 group text-sm md:text-base" href="{{ route('public.article.show', $article->slug) }}">
                                            BACA BERITA <span class="material-symbols-outlined group-hover:translate-x-2 transition-transform">arrow_right_alt</span>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center gap-3 mt-4" id="newsSliderDots">
                    <button class="w-4 h-4 rounded-full border-2 border-on-background transition-all" style="background-color: rgb(0, 74, 198); width: 1.5rem;"></button>
                </div>
            @else
                <div class="brutalist-border brutalist-shadow bg-surface p-12 text-center">
                    <span class="material-symbols-outlined text-5xl opacity-30 mb-4 block">description</span>
                    <p class="font-label-mono text-sm uppercase opacity-60">Belum ada berita</p>
                </div>
            @endif
        </section>

        {{-- ============================================================ --}}
        {{-- CTA SECTION --}}
        {{-- ============================================================ --}}
        <section class="mb-12 md:mb-16 brutalist-border brutalist-shadow bg-on-background text-surface p-8 md:p-12 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-24 h-24 md:w-40 md:h-40 bg-secondary rounded-full brutalist-border sticker-tilt opacity-50"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 md:w-32 md:h-32 bg-primary brutalist-border sticker-tilt opacity-50"></div>
            <div class="relative z-10 max-w-2xl mx-auto text-center">
                <h2 class="font-headline-lg text-2xl md:text-headline-lg mb-4 md:mb-6 leading-none">PUNYA BERITA MENARIK? SUARAKAN DISINI!</h2>
                <p class="font-body-md text-sm md:text-body-md mb-8 text-surface-variant">Ayo, suarakan ide dan ceritamu! Kirimkan tulisanmu sekarang dan jadilah bagian dari Merdeka Warta.</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    @auth
                        <a href="{{ route('admin.articles.create') }}" class="cursor-pointer bg-primary text-on-primary brutalist-border brutalist-shadow-sm px-8 py-4 font-bold text-base md:text-lg btn-press w-full md:w-auto uppercase inline-block">KIRIM DISINI</a>
                    @else
                        <a class="cursor-pointer open-contributor-modal bg-primary text-on-primary brutalist-border brutalist-shadow-sm px-8 py-4 font-bold text-base md:text-lg btn-press w-full md:w-auto uppercase inline-block">KIRIM DISINI</a>
                    @endauth
                </div>
            </div>
        </section>

        {{-- ============================================================ --}}
        {{-- ACTIVITY GALLERY --}}
        {{-- ============================================================ --}}
        @if($galleries->isNotEmpty())
            <section class="mb-12 md:mb-16">
                <div class="flex items-center justify-between mb-8 gap-4">
                    <h2 class="font-headline-lg text-2xl md:text-headline-lg uppercase text-on-surface whitespace-nowrap">MOMEN DI SMK MERDEKA</h2>
                    <div class="h-1 bg-on-background flex-grow hidden md:block"></div>
                    <a href="{{ route('public.gallery.list') }}" class="font-label-mono text-xs uppercase text-primary hover:underline shrink-0 flex items-center gap-1">Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
                <div class="w-full overflow-hidden">
                    <div class="flex animate-scroll-gallery">
                        @for($copy = 0; $copy < 3; $copy++)
                        <div class="flex shrink-0 gap-gutter px-3">
                            @foreach($galleries as $g)
                                <div class="w-64 md:w-80 aspect-square brutalist-border brutalist-shadow overflow-hidden group shrink-0">
                                    <img alt="{{ $g->caption ?? 'Momen SMK Merdeka' }}" class="w-full h-full object-cover transition-all duration-300 group-hover:scale-110" src="{{ $g->image_url }}">
                                </div>
                            @endforeach
                        </div>
                        @endfor
                    </div>
                </div>
            </section>
        @endif

        {{-- ============================================================ --}}
        {{-- TESTIMONIALS --}}
        {{-- ============================================================ --}}
        @if($testimonials->isNotEmpty())
            <section class="mb-12 md:mb-16 overflow-hidden">
                <div class="flex items-center justify-between mb-8 gap-4">
                    <h2 class="font-headline-lg text-2xl md:text-headline-lg uppercase text-on-surface whitespace-nowrap">TANGGAPAN</h2>
                    <div class="h-1 bg-on-background flex-grow hidden md:block"></div>
                </div>
                <div class="w-full overflow-hidden pause-on-hover py-4">
                    <div class="flex animate-scroll-testimonials w-max gap-gutter">
                        <div class="flex gap-gutter px-3">
                            @foreach($testimonials as $t)
                                <div class="w-[300px] md:w-[350px] brutalist-border brutalist-shadow {{ $t->bg_color }} p-6 flex flex-col gap-4 shrink-0">
                                    <span class="material-symbols-outlined @if($t->bg_color == 'bg-secondary-fixed') text-secondary @elseif($t->bg_color == 'bg-tertiary-fixed') text-tertiary @elseif($t->bg_color == 'bg-primary-fixed') text-primary @else text-on-background @endif text-4xl md:text-5xl font-bold leading-none select-none">format_quote</span>
                                    <p class="font-bold font-body-md text-sm md:text-body-md flex-grow">{{ $t->quote }}</p>
                                    <div class="border-t-3 border-on-background pt-4">
                                        <p class="font-label-mono text-[10px] md:text-xs uppercase">{{ $t->author_name }}{{ $t->author_role ? ', ' . $t->author_role : '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex gap-gutter px-3">
                            @foreach($testimonials as $t)
                                <div class="w-[300px] md:w-[350px] brutalist-border brutalist-shadow {{ $t->bg_color }} p-6 flex flex-col gap-4 shrink-0">
                                    <span class="material-symbols-outlined @if($t->bg_color == 'bg-secondary-fixed') text-secondary @elseif($t->bg_color == 'bg-tertiary-fixed') text-tertiary @elseif($t->bg_color == 'bg-primary-fixed') text-primary @else text-on-background @endif text-4xl md:text-5xl font-bold leading-none select-none">format_quote</span>
                                    <p class="font-bold font-body-md text-sm md:text-body-md flex-grow">{{ $t->quote }}</p>
                                    <div class="border-t-3 border-on-background pt-4">
                                        <p class="font-label-mono text-[10px] md:text-xs uppercase">{{ $t->author_name }}{{ $t->author_role ? ', ' . $t->author_role : '' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

       

    </main>

    {{-- CONTRIBUTOR MODAL --}}
    @include('layouts.partials.contributor-modal')

    {{-- FOOTER --}}
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
                cSubmitBtn.disabled = true;
                cSubmitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">refresh</span> MENGIRIM...';

                var fd = new FormData(cForm);

                fetch('{{ route('public.contributor.permission') }}', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: fd
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            text: data.subtitle,
                            confirmButtonColor: '#004ac6',
                            confirmButtonText: 'OK',
                            customClass: {
                                popup: 'border-4 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]',
                                title: 'font-headline-lg text-3xl uppercase',
                                confirmButton: 'bg-primary text-on-primary font-label-mono border-3 border-on-background px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all'
                            }
                        });
                        cForm.reset();
                        closeCModal();
                    }
                })
                .catch(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        confirmButtonColor: '#004ac6',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'border-4 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]',
                            title: 'font-headline-lg text-3xl uppercase',
                            confirmButton: 'bg-primary text-on-primary font-label-mono border-3 border-on-background px-8 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all'
                        }
                    });
                })
                .finally(function() {
                    cSubmitBtn.disabled = false;
                    cSubmitBtn.innerHTML = '<span class="material-symbols-outlined">send</span> KIRIM PERMINTAAN';
                });
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

        // Hero Carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const totalSlides = slides.length;
        let autoSlideInterval;

        function showSlide(index) {
            if (index >= totalSlides) currentSlide = 0;
            else if (index < 0) currentSlide = totalSlides - 1;
            else currentSlide = index;
            slides.forEach((slide, i) => slide.classList.toggle('active', i === currentSlide));
            dots.forEach((dot, i) => {
                if (i === currentSlide) { dot.style.backgroundColor = 'white'; dot.style.width = window.innerWidth >= 768 ? '1.5rem' : '1rem'; }
                else { dot.style.backgroundColor = 'rgba(255, 255, 255, 0.5)'; dot.style.width = window.innerWidth >= 768 ? '1rem' : '0.75rem'; }
            });
        }
        function nextSlide() { showSlide(currentSlide + 1); }
        function prevSlide() { showSlide(currentSlide - 1); }
        function startAutoSlide() { stopAutoSlide(); autoSlideInterval = setInterval(nextSlide, 6000); }
        function stopAutoSlide() { clearInterval(autoSlideInterval); }

        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); startAutoSlide(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); startAutoSlide(); });
        dots.forEach(dot => { dot.addEventListener('click', () => { showSlide(parseInt(dot.dataset.slide)); startAutoSlide(); }); });

        if (totalSlides > 0) { showSlide(0); startAutoSlide(); }

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
                    btn.className = 'w-4 h-4 rounded-full border-2 border-on-background transition-all';
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
    </script>

</body>
</html>
