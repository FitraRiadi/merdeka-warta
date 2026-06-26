<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $announcement->title }} | Merdeka Warta</title>
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
        * { box-sizing: border-box; }
        body { margin: 0; background-color: #f8f9fa; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; width: 100%; max-width: 100%; }
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

        {{-- Bento layout: 8 cols content + 4 cols sidebar --}}
        <div class="bento-grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">

            {{-- MAIN CONTENT --}}
            <article class="lg:col-span-8 flex flex-col gap-6">

                {{-- Breadcrumbs & Type Badge --}}
                <div class="flex items-center gap-3 flex-wrap">
                    @php
                        $typeColors = [
                            'important' => 'bg-error/10 text-error',
                            'warning' => 'bg-tertiary/10 text-tertiary',
                            'info' => 'bg-secondary/10 text-secondary',
                        ];
                        $typeLabels = [
                            'important' => 'PENTING',
                            'warning' => 'PERHATIAN',
                            'info' => 'INFORMASI',
                        ];
                        $typeColor = $typeColors[$announcement->type] ?? 'bg-secondary/10 text-secondary';
                        $typeLabel = $typeLabels[$announcement->type] ?? 'PENGUMUMAN';
                    @endphp
                    <span class="{{ $typeColor }} px-3 py-1 rounded font-label-mono text-[10px] uppercase flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-xs">campaign</span>
                        {{ $typeLabel }}
                    </span>
                    <div class="flex items-center text-on-surface-variant font-label-mono text-[10px] uppercase gap-1.5">
                        <a class="hover:underline" href="{{ route('home') }}">Home</a>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <a class="hover:underline" href="{{ route('public.announcement.list') }}">Pengumuman</a>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="truncate max-w-[120px] md:max-w-[200px]">{{ $announcement->title }}</span>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="font-headline-lg text-headline-lg-mobile md:text-4xl lg:text-headline-lg text-on-surface leading-tight uppercase">{{ $announcement->title }}</h1>

                {{-- Metadata --}}
                <div class="flex flex-wrap items-center gap-4 md:gap-6 py-4 border-y border-outline-variant font-label-mono uppercase text-xs">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">calendar_today</span>
                        {{ $announcement->created_at->format('d F Y') }}
                    </div>
                    @if($announcement->expired_at)
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">schedule</span>
                        Berlaku hingga {{ $announcement->expired_at->format('d F Y') }}
                    </div>
                    @endif
                </div>

                {{-- Rich Content --}}
                <div class="prose max-w-none font-body-md text-on-surface">
                    {!! $announcement->renderContent() !!}
                </div>

                {{-- Tags --}}
                @php $tags = $announcement->tags; @endphp
                @if(count($tags) > 0)
                <div class="flex flex-wrap gap-2 pt-6 border-t border-outline-variant">
                    @foreach($tags as $tag)
                    <a class="bg-surface-container-high rounded px-3 py-1 font-label-mono text-[10px] hover:bg-primary hover:text-on-primary transition-all bento-shadow" href="#">{{ $tag }}</a>
                    @endforeach
                </div>
                @endif

                {{-- Other Announcements --}}
                @if($otherAnnouncements->isNotEmpty())
                <section class="mt-8 pt-8 border-t border-outline-variant">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-1.5 h-5 bg-secondary rounded"></span>
                        <h2 class="font-headline-lg text-xl md:text-2xl uppercase">PENGUMUMAN LAINNYA</h2>
                    </div>
                    <div class="bento-grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($otherAnnouncements as $other)
                        <a href="{{ route('public.announcement.show', $other->id) }}" class="bg-white rounded-xl bento-shadow bento-card bento-shadow-hover p-4 md:p-5 group">
                            <div class="flex items-center gap-2 mb-2">
                                @php
                                    $oColor = $typeColors[$other->type] ?? 'bg-secondary/10 text-secondary';
                                    $oLabel = $typeLabels[$other->type] ?? 'PENGUMUMAN';
                                @endphp
                                <span class="{{ $oColor }} px-2 py-0.5 text-[10px] font-label-mono uppercase rounded">{{ $oLabel }}</span>
                                <span class="text-[10px] font-label-mono text-on-surface-variant">{{ $other->created_at->format('d F Y') }}</span>
                            </div>
                            <h3 class="font-headline-lg text-base uppercase leading-tight group-hover:text-primary transition-colors">{{ $other->title }}</h3>
                            <p class="font-body-md text-xs mt-2 text-on-surface-variant line-clamp-2">{{ Str::limit($other->content_text, 120) }}</p>
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif
            </article>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-4 flex flex-col gap-6">

                {{-- Info Type --}}
                <section class="bg-white rounded-xl bento-shadow p-5 md:p-6 border-2 border-black">
                    <h3 class="font-headline-lg text-lg md:text-xl uppercase mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">info</span> Tentang Pengumuman
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-lg">campaign</span>
                            <span class="font-label-mono text-[10px] uppercase">Tipe: {{ $typeLabel }}</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-lg">calendar_today</span>
                            <span class="font-label-mono text-[10px] uppercase">Dibuat: {{ $announcement->created_at->format('d F Y') }}</span>
                        </div>
                        @if($announcement->expired_at)
                        <div class="flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-secondary text-lg">schedule</span>
                            <span class="font-label-mono text-[10px] uppercase">Berakhir: {{ $announcement->expired_at->format('d F Y') }}</span>
                        </div>
                        @endif
                    </div>
                </section>

                {{-- Pengumuman Terbaru --}}
                @if($otherAnnouncements->isNotEmpty())
                <section class="bg-white rounded-xl bento-shadow p-5 md:p-6 border-2 border-black">
                    <h3 class="font-headline-lg text-lg md:text-xl uppercase mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">campaign</span> Pengumuman Terbaru
                    </h3>
                    <div class="space-y-4">
                        @foreach($otherAnnouncements->take(4) as $i => $other)
                        <a href="{{ route('public.announcement.show', $other->id) }}" class="group cursor-pointer block rounded-xl p-2 -mx-2 hover:bg-surface-container-low">
                            @php
                                $oColor = $typeColors[$other->type] ?? 'bg-secondary/10 text-secondary';
                                $oLabel = $typeLabels[$other->type] ?? 'PENGUMUMAN';
                            @endphp
                            <span class="text-[10px] font-label-mono {{ $oColor }} px-2 py-0.5 rounded inline-block mb-1">{{ $oLabel }}</span>
                            <h4 class="font-bold text-sm leading-tight group-hover:text-primary transition-colors">{{ $other->title }}</h4>
                            <span class="text-[10px] font-label-mono text-on-surface-variant mt-0.5 block">{{ $other->created_at->format('d F Y') }}</span>
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- CTA Card --}}
                <section class="bg-tertiary-container text-on-tertiary rounded-xl bento-shadow p-6 md:p-7 relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="font-headline-lg text-2xl mb-3 leading-none uppercase">Punya Berita Menarik?</h3>
                        <p class="mb-5 font-bold text-sm opacity-90">Kirimkan tulisan, foto, atau video kegiatan sekolahmu ke Redaksi Merdeka Warta!</p>
                        <button class="bg-on-tertiary text-tertiary font-label-mono text-xs px-5 py-2.5 rounded-xl bento-shadow hover:bg-white transition-all open-contributor-modal inline-flex items-center gap-1.5">
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
        const modal = document.getElementById('contributorModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModal');
        const openBtns = document.querySelectorAll('.open-contributor-modal');
        const cForm = document.getElementById('contributorForm');
        const cSubmitBtn = document.getElementById('submitBtn');

        if (modal && modalOverlay && closeModalBtn) {
            function openContributorModal() { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            function closeContributorModal() { modal.classList.add('hidden'); document.body.style.overflow = ''; }

            openBtns.forEach(function(btn) { btn.addEventListener('click', openContributorModal); });
            closeModalBtn.addEventListener('click', closeContributorModal);
            modalOverlay.addEventListener('click', closeContributorModal);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeContributorModal();
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
                                popup: 'rounded-xl shadow-2xl',
                                title: 'font-headline-lg text-2xl uppercase',
                                confirmButton: 'bg-primary text-on-primary rounded-xl px-8 py-3 font-bold'
                            }
                        });
                        cForm.reset();
                        closeContributorModal();
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
                    cSubmitBtn.disabled = false;
                    cSubmitBtn.innerHTML = '<span class="material-symbols-outlined">send</span> KIRIM PERMINTAAN';
                });
            });
        }

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
    </script>
</body>
</html>