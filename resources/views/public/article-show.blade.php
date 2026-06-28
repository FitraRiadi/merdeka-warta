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
        @keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .animate-marquee { animation: marquee 30s linear infinite; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        #mobile-sidebar { transition: transform 0.3s ease-in-out; transform: translateX(100%); }
        #mobile-sidebar.open { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.open { opacity: 1 !important; pointer-events: auto !important; }
        .prose h2 { font-family: 'Anton', sans-serif; text-transform: uppercase; font-size: 1.5rem; line-height: 1.1; margin-top: 2rem; margin-bottom: 0.75rem; }
        .prose h3 { font-family: 'Anton', sans-serif; text-transform: uppercase; font-size: 1.25rem; line-height: 1.1; margin-top: 1.5rem; margin-bottom: 0.5rem; }
        .prose p { margin-bottom: 1rem; line-height: 1.7; }
        .prose img { border-radius: 0.25rem; margin: 1.5rem 0; }
        .prose ul, .prose ol { margin-bottom: 1rem; padding-left: 1.5rem; }
        .prose li { margin-bottom: 0.25rem; }
        .prose blockquote { border-left: 3px solid #004ac6; padding-left: 1rem; margin: 1.5rem 0; font-style: italic; color: #434655; }
        .prose a { color: #004ac6; text-decoration: underline; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-body-md text-on-surface">

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts])

    <main class="max-w-[1440px] mx-auto px-4 md:px-margin-desktop py-8 md:py-12">

        {{-- Bento layout: 2 columns — content 2fr, sidebar 1fr --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">

            {{-- MAIN CONTENT --}}
            <article class="lg:col-span-2 flex flex-col gap-6">

                {{-- Breadcrumbs & Category --}}
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded font-label-mono text-[10px] uppercase">
                        {{ $article->category ?? 'NEWS' }}
                    </span>
                    <div class="flex items-center text-on-surface-variant font-label-mono text-[10px] uppercase gap-1.5">
                        <a class="hover:underline" href="{{ route('home') }}">Home</a>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <a class="hover:underline" href="{{ route('public.article.list') }}">Berita</a>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="truncate max-w-[120px] md:max-w-[200px]">{{ $article->title }}</span>
                    </div>
                </div>

                {{-- Typewriter Title --}}
                <h1 id="article-title" class="font-headline-lg text-headline-lg-mobile md:text-4xl lg:text-headline-lg text-on-surface leading-tight uppercase" data-text="{{ $article->title }}"></h1>

                {{-- Metadata --}}
                <div class="flex flex-wrap items-center gap-4 md:gap-6 py-4 border-y border-outline-variant font-label-mono uppercase text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                        {{ $article->published_at->format('d F Y') }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">person</span>
                        BY {{ $article->author->name ?? 'ADMIN' }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">visibility</span>
                        {{ $article->views_count }} PELIHAT
                    </div>
                </div>

                {{-- Featured Image --}}
                @if($article->image)
                <div class="relative w-full rounded-xl overflow-hidden bento-shadow">
                    <img class="w-full aspect-video object-cover" src="{{ $article->image }}" alt="{{ $article->title }}">
                </div>
                @endif

                {{-- Rich Content --}}
                <div class="prose max-w-none font-body-md text-on-surface">
                    {!! $article->renderContent() !!}
                </div>

                {{-- Tags --}}
                @php $tags = $article->tags; @endphp
                @if(count($tags) > 0)
                <div class="flex flex-wrap gap-2 pt-6 border-t border-outline-variant">
                    @foreach($tags as $tag)
                    <a class="bg-surface-container-high rounded px-3 py-1 font-label-mono text-[10px] hover:bg-primary hover:text-on-primary transition-all bento-shadow" href="#">{{ $tag }}</a>
                    @endforeach
                </div>
                @endif

                {{-- Related Articles (bento) --}}
                @if($relatedArticles->isNotEmpty())
                <section class="mt-8 pt-8 border-t border-outline-variant">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-5 bg-primary rounded"></span>
                        <h2 class="font-headline-lg text-xl md:text-2xl uppercase">ARTIKEL LAINNYA</h2>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-5">
                        @foreach($relatedArticles as $related)
                        <div class="bg-surface-container-low rounded-xl bento-shadow bento-card bento-shadow-hover flex flex-col overflow-hidden">
                            <div class="relative">
                                @if($related->image)
                                <img alt="{{ $related->title }}" class="w-full aspect-video object-cover" src="{{ $related->image }}">
                                @else
                                <div class="w-full aspect-video bg-surface-variant"></div>
                                @endif
                                <span class="absolute top-2 left-2 bg-white/90 dark:bg-surface-container dark:text-on-surface px-2 py-0.5 text-[10px] font-label-mono uppercase rounded bento-shadow">{{ $related->category ?? 'BERITA' }}</span>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="font-headline-lg text-base uppercase mb-1.5 leading-tight dark:text-gray-400">{{ $related->title }}</h3>
                                <p class="text-xs text-on-surface-variant mb-3 flex-grow line-clamp-2">{{ Str::limit($related->content_text, 100) }}</p>
                                <a class="font-label-mono text-[10px] uppercase font-bold text-primary hover:underline flex items-center gap-1" href="{{ route('public.article.show', $related->slug) }}">
                                    Baca Selengkapnya <span class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </article>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-1 flex flex-col gap-6">

                {{-- Berita Populer --}}
                @if($popularArticles->isNotEmpty())
                <section class="bg-white dark:bg-surface-container rounded-xl bento-shadow p-5 md:p-6 border-2 border-black dark:border-gray-700">
                    <h3 class="font-headline-lg text-lg md:text-xl uppercase mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">trending_up</span> Berita Populer
                    </h3>
                    <div class="space-y-4">
                        @foreach($popularArticles as $i => $popular)
                        <a href="{{ route('public.article.show', $popular->slug) }}" class="group cursor-pointer block rounded-xl p-2 -mx-2 hover:bg-surface-container-low">
                            <span class="text-[10px] font-label-mono text-secondary uppercase mb-0.5 block flex items-center gap-2">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ $popular->category ?? 'NEWS' }}
                                <span class="flex items-center gap-0.5 text-on-surface-variant ml-auto">
                                    <span class="material-symbols-outlined text-[10px]">visibility</span>
                                    {{ $popular->views_count }}
                                </span>
                            </span>
                            <h4 class="font-bold text-sm leading-tight group-hover:text-primary transition-colors">{{ $popular->title }}</h4>
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- Kategori --}}
                @if($categories->isNotEmpty())
                <section class="bg-white dark:bg-surface-container rounded-xl bento-shadow p-5 md:p-6 border-2 border-black dark:border-gray-700">
                    <h3 class="font-headline-lg text-lg md:text-xl uppercase mb-4">Kategori</h3>
                    <ul class="space-y-1.5">
                        @foreach($categories->take(6) as $cat)
                        <li>
                            <a class="flex justify-between items-center group p-2.5 rounded-xl hover:bg-primary-fixed transition-all" href="{{ route('public.article.list', ['category' => $cat->category]) }}#articles-section">
                                <span class="font-bold text-sm">{{ $cat->category }}</span>
                                <span class="bg-surface-container-high px-2 py-0.5 text-[10px] font-label-mono rounded">{{ str_pad($cat->total, 2, '0', STR_PAD_LEFT) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </section>
                @endif

                {{-- CTA Card --}}
                <section class="bg-blue-900 text-blue-100 dark:bg-blue-950 rounded-xl bento-shadow p-6 md:p-7 relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="font-headline-lg text-2xl mb-3 leading-none uppercase">Punya Berita Menarik?</h3>
                        <p class="mb-5 font-bold text-sm opacity-90">Kirimkan tulisan, foto, atau video kegiatan sekolahmu ke Redaksi Merdeka Warta!</p>
                        <button class="bg-white text-blue-900 font-label-mono text-xs px-5 py-2.5 rounded-xl bento-shadow hover:bg-blue-100 transition-all open-contributor-modal inline-flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">edit_note</span> KIRIM TULISANMU
                        </button>
                    </div>
                    <span class="material-symbols-outlined absolute -bottom-6 -right-6 text-8xl opacity-20 rotate-12 group-hover:rotate-0 transition-transform duration-500">send</span>
                </section>
            </aside>
        </div>
    </main>

    @include('layouts.partials.contributor-modal')
    @include('layouts.partials.public-footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

        // Contributor Modal
        const modal = document.getElementById('contributorModal');
        const mOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModal');
        const openBtns = document.querySelectorAll('.open-contributor-modal');
        const form = document.getElementById('contributorForm');
        const submitBtn = document.getElementById('submitBtn');

        if (modal && mOverlay && closeModalBtn) {
            function openModal() { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            function closeModal() { modal.classList.add('hidden'); document.body.style.overflow = ''; }

            openBtns.forEach(function(btn) { btn.addEventListener('click', openModal); });
            closeModalBtn.addEventListener('click', closeModal);
            mOverlay.addEventListener('click', closeModal);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
            });
        }

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
                                popup: 'rounded-xl shadow-2xl',
                                title: 'font-headline-lg text-2xl uppercase',
                                confirmButton: 'bg-primary text-on-primary rounded-xl px-8 py-3 font-bold'
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
                            popup: 'rounded-xl shadow-2xl',
                            title: 'font-headline-lg text-2xl uppercase',
                            confirmButton: 'bg-primary text-on-primary rounded-xl px-8 py-3 font-bold'
                        }
                    });
                })
                .finally(function() {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span class="material-symbols-outlined">send</span> KIRIM PERMINTAAN';
                });
            });
        }

        // Typewriter animation
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