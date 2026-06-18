<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $article->title }} | Merdeka Warta</title>
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
        body { background-color: #f8f9fa; background-image: linear-gradient(to right, #e5e7eb 1px, transparent 1px), linear-gradient(to bottom, #e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-hover:hover { transform: translate(-2px, -2px); box-shadow: 10px 10px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .sticker-tilt { transform: rotate(-2deg); }
        .sticker-rotate { transform: rotate(-2deg); }
        .sticker-rotate-alt { transform: rotate(2deg); }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 1); }
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 30s linear infinite; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        #mobile-sidebar.open { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.open { opacity: 1 !important; pointer-events: auto !important; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-body-md text-on-surface">

    {{-- NAVBAR --}}
    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    {{-- MAIN CONTENT --}}
    <main class="max-w-[1440px] mx-auto px-4 md:px-margin-desktop py-12 grid grid-cols-1 lg:grid-cols-12 gap-10">
        {{-- ARTICLE CONTENT (8 COLUMNS) --}}
        <article class="lg:col-span-8 flex flex-col gap-8">
            {{-- Breadcrumbs & Category --}}
            <div class="flex items-center gap-4 flex-wrap">
                <span class="bg-tertiary-container text-on-tertiary px-4 py-1 border-3 border-on-background font-label-mono uppercase sticker-rotate brutalist-shadow-sm">
                    {{ $article->category ?? 'NEWS' }}
                </span>
                <div class="flex items-center text-on-surface-variant font-label-mono text-xs uppercase gap-2">
                    <a class="hover:underline" href="{{ route('home') }}">Home</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <a class="hover:underline" href="{{ route('public.article.list') }}">Berita</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span>{{ $article->title }}</span>
                </div>
            </div>

            {{-- Title --}}
            <h1 id="article-title" class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface leading-tight uppercase" data-text="{{ $article->title }}"></h1>

            {{-- Metadata --}}
            <div class="flex flex-wrap items-center gap-6 border-y-3 border-on-background py-4 font-label-mono uppercase text-sm">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">calendar_today</span>
                    {{ $article->published_at->format('d F Y') }}
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">person</span>
                    BY {{ $article->author->name ?? 'ADMIN' }}
                </div>
            </div>

            {{-- Featured Image --}}
            @if($article->image)
            <div class="relative w-full border-3 border-on-background brutalist-shadow">
                <img class="w-full aspect-video object-cover" src="{{ $article->image }}" alt="{{ $article->title }}">
            </div>
            @endif

            {{-- Rich Content (from JSON blocks) --}}
            <div class="prose prose-lg max-w-none font-body-md text-on-surface space-y-6">
                {!! $article->renderContent() !!}
            </div>

            {{-- Tags --}}
            @php $tags = $article->tags; @endphp
            @if(count($tags) > 0)
            <div class="flex flex-wrap gap-3 pt-8 border-t-3 border-on-background">
                @foreach($tags as $tag)
                <a class="bg-surface-container-highest border-3 border-on-background px-4 py-1 font-label-mono text-sm hover:bg-primary hover:text-on-primary transition-all" href="#">{{ $tag }}</a>
                @endforeach
            </div>
            @endif

            {{-- Related Articles --}}
            @if($relatedArticles->isNotEmpty())
            <section class="mt-12 pt-12 border-t-3 border-on-background">
                <h2 class="font-headline-lg text-3xl uppercase mb-8">ARTIKEL LAINNYA</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                    <div class="bg-surface-container-low border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                        <div class="relative border-b-3 border-on-background">
                            @if($related->image)
                            <img alt="{{ $related->title }}" class="w-full aspect-video object-cover" src="{{ $related->image }}">
                            @else
                            <div class="w-full aspect-video bg-gradient-to-br from-primary to-secondary"></div>
                            @endif
                            <span class="absolute top-2 left-2 bg-secondary text-on-secondary px-2 py-1 text-xs font-label-mono uppercase border-2 border-on-background">{{ $related->category ?? 'BERITA' }}</span>
                        </div>
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="font-headline-lg text-xl uppercase mb-2 leading-tight">{{ $related->title }}</h3>
                            <p class="text-sm mb-4 flex-grow">{{ Str::limit($related->content_text, 100) }}</p>
                            <a class="font-label-mono text-xs uppercase font-bold text-primary hover:underline flex items-center gap-1" href="{{ route('public.article.show', $related->slug) }}">
                                Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </article>

        {{-- SIDEBAR (4 COLUMNS) --}}
        <aside class="lg:col-span-4 flex flex-col gap-10">
            {{-- Berita Populer --}}
            @if($popularArticles->isNotEmpty())
            <section class="bg-surface border-3 border-on-background brutalist-shadow p-6">
                <h3 class="font-headline-lg text-2xl uppercase border-b-3 border-on-background pb-3 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">trending_up</span> Berita Populer
                </h3>
                <div class="space-y-6">
                    @foreach($popularArticles as $i => $popular)
                    <a href="{{ route('public.article.show', $popular->slug) }}" class="group cursor-pointer block">
                        <span class="text-xs font-label-mono text-secondary uppercase mb-1 block">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $popular->category ?? 'NEWS' }}</span>
                        <h4 class="font-bold leading-tight group-hover:text-primary transition-colors">{{ $popular->title }}</h4>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Kategori --}}
            @if($categories->isNotEmpty())
            <section class="bg-surface border-3 border-on-background brutalist-shadow p-6">
                <h3 class="font-headline-lg text-2xl uppercase border-b-3 border-on-background pb-3 mb-6">Kategori</h3>
                <ul class="space-y-2">
                    @foreach($categories->take(6) as $cat)
                    <li>
                        <a class="flex justify-between items-center group p-2 hover:bg-primary-fixed border-2 border-transparent hover:border-on-background transition-all" href="{{ route('public.article.list', ['category' => $cat->category]) }}#articles-section">
                            <span class="font-bold">{{ $cat->category }}</span>
                            <span class="bg-on-background text-surface px-2 py-0.5 text-xs font-label-mono">{{ str_pad($cat->total, 2, '0', STR_PAD_LEFT) }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </section>
            @endif

            {{-- CTA Card --}}
            <section class="bg-tertiary-container text-on-tertiary border-3 border-on-background brutalist-shadow p-8 relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="font-headline-lg text-3xl mb-4 leading-none uppercase">Punya Berita Menarik?</h3>
                    <p class="mb-6 font-bold opacity-90">Kirimkan tulisan, foto, atau video kegiatan sekolahmu ke Redaksi Merdeka Warta!</p>
                    <button class="bg-on-tertiary text-tertiary font-label-mono px-6 py-3 border-3 border-on-background brutalist-shadow-sm btn-press hover:translate-x-[-2px] hover:translate-y-[-2px] transition-all open-contributor-modal">
                        KIRIM TULISANMU
                    </button>
                </div>
                <span class="material-symbols-outlined absolute -bottom-4 -right-4 text-9xl opacity-30 rotate-12 group-hover:rotate-0 transition-transform duration-500">send</span>
            </section>
        </aside>
    </main>

    {{-- CONTRIBUTOR MODAL --}}
    @include('layouts.partials.contributor-modal')

    {{-- FOOTER --}}
    @include('layouts.partials.public-footer')

    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function () {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (openBtn && closeBtn && sidebar && overlay) {
                function openSidebar() {
                    sidebar.classList.add('open');
                    overlay.classList.add('open');
                    document.body.style.overflow = 'hidden';
                }
                function closeSidebar() {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('open');
                    document.body.style.overflow = '';
                }
                openBtn.addEventListener('click', openSidebar);
                closeBtn.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }

            // Brutalist button interactions
            document.querySelectorAll('.btn-press').forEach(function(button) {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translate(4px, 4px)';
                    this.style.boxShadow = '0px 0px 0px 0px rgba(0,0,0,1)';
                });
                button.addEventListener('mouseup', function() {
                    this.style.transform = 'translate(0px, 0px)';
                    this.style.boxShadow = '';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translate(0px, 0px)';
                    this.style.boxShadow = '';
                });
            });
        });

        // Contributor Modal
        const modal = document.getElementById('contributorModal');
        const overlay = document.getElementById('modalOverlay');
        const closeBtn = document.getElementById('closeModal');
        const openBtns = document.querySelectorAll('.open-contributor-modal');
        const form = document.getElementById('contributorForm');
        const submitBtn = document.getElementById('submitBtn');

        if (modal && overlay && closeBtn) {
            function openModal() { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            function closeModal() { modal.classList.add('hidden'); document.body.style.overflow = ''; }

            openBtns.forEach(function(btn) { btn.addEventListener('click', openModal); });
            closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });
        }

        // Form submission
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">refresh</span> MENGIRIM...';

                var formData = new FormData(form);

                fetch('{{ route('public.contributor.permission') }}', {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
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
                        form.reset();
                        closeModal();
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
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span class="material-symbols-outlined">send</span> KIRIM PERMINTAAN';
                });
            });
        }

        // Typewriter animation for article title
        (function() {
            var el = document.getElementById('article-title');
            if (!el) return;
            var text = el.getAttribute('data-text') || '';
            var i = 0;
            var speed = 40;
            function type() {
                if (i < text.length) {
                    el.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            el.textContent = '';
            type();
        })();
    </script>
</body>
</html>
