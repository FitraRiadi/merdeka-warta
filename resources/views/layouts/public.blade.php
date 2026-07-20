<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Merdeka Warta')) - Merdeka Warta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background: #ffffff; }

        .marquee-wrapper {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        .marquee-content {
            display: inline-flex;
            animation: marquee 40s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .article-card {
            transition: all 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        }
        .article-card .thumbnail {
            transition: transform 0.5s ease;
        }
        .article-card:hover .thumbnail {
            transform: scale(1.08);
        }

        .category-badge {
            transition: all 0.2s ease;
        }
        .category-badge:hover {
            transform: translateY(-1px);
        }

        .hero-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.05) 100%);
        }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .scrollbar-thin::-webkit-scrollbar { height: 4px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="antialiased text-gray-800">

    {{-- ============================================================ --}}
    {{-- TOPBAR --}}
    {{-- ============================================================ --}}
    <div class="hidden lg:block bg-slate-900 text-slate-400 text-xs py-1.5">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span><i class="far fa-calendar-alt mr-1.5"></i> {{ date('l, d F Y') }}</span>
                <span class="text-slate-600">|</span>
                <span><i class="fas fa-school mr-1.5"></i> SMK Merdeka Bandung</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-youtube"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- NAVBAR --}}
    {{-- ============================================================ --}}
    <nav x-data="{ open: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
         class="sticky top-0 z-50 w-full transition-all duration-300"
         :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-white'">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between h-16 md:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white font-black text-lg shadow-lg shadow-blue-200 group-hover:shadow-blue-300 transition-shadow">
                        MW
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-lg md:text-xl leading-tight text-slate-900">Merdeka</span>
                        <span class="font-bold text-xs md:text-sm leading-tight text-blue-600 -mt-0.5">Warta</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50 hover:text-blue-700 @if(Route::currentRouteNamed('home')) bg-blue-50 text-blue-700 @endif">
                        <i class="fas fa-home mr-1.5 text-xs"></i>Beranda
                    </a>
                    <a href="{{ route('home') }}#articles" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50 hover:text-blue-700">
                        <i class="fas fa-newspaper mr-1.5 text-xs"></i>Artikel
                    </a>
                    <a href="{{ route('home') }}#announcements" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:bg-blue-50 hover:text-blue-700">
                        <i class="fas fa-bullhorn mr-1.5 text-xs"></i>Pengumuman
                    </a>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold shadow-lg shadow-blue-200 hover:shadow-blue-300 transition-all hover:-translate-y-0.5">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-slate-200 text-slate-700 text-sm font-semibold hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Masuk</span>
                        </a>
                    @endauth

                    {{-- Mobile Hamburger --}}
                    <button @click="open = !open" class="lg:hidden p-2.5 rounded-lg hover:bg-slate-100 transition-colors" :class="{'bg-slate-100': open}">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" x-show="!open"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" x-show="open"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition:enter.duration.200ms.opacity x-cloak class="fixed inset-0 bg-black/30 z-40 lg:hidden" @click="open = false"></div>
        <div x-show="open"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="-translate-x-full"
             x-transition:leave="transition duration-150 ease-in"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             x-cloak
             class="fixed top-0 left-0 w-72 h-full bg-white z-50 shadow-2xl overflow-y-auto lg:hidden">
            <div class="p-5">
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center text-white font-black text-sm">MW</div>
                        <span class="font-black text-lg">Merdeka Warta</span>
                    </a>
                    <button @click="open = false" class="p-2 rounded-lg hover:bg-slate-100">
                        <i class="fas fa-times text-lg text-slate-500"></i>
                    </button>
                </div>
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-all" @click="open = false">
                        <i class="fas fa-home w-5 text-center text-blue-600"></i> Beranda
                    </a>
                    <a href="{{ route('home') }}#articles" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-all" @click="open = false">
                        <i class="fas fa-newspaper w-5 text-center text-emerald-600"></i> Artikel
                    </a>
                    <a href="{{ route('home') }}#announcements" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition-all" @click="open = false">
                        <i class="fas fa-bullhorn w-5 text-center text-amber-600"></i> Pengumuman
                    </a>
                </div>
                <hr class="my-5 border-slate-200">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg" @click="open = false">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 shadow-lg" @click="open = false">
                        <i class="fas fa-sign-in-alt w-5 text-center"></i> Masuk
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- MAIN CONTENT --}}
    {{-- ============================================================ --}}
    <main>
        @yield('content')
    </main>

    {{-- ============================================================ --}}
    {{-- FOOTER --}}
    {{-- ============================================================ --}}
    <footer class="bg-slate-900 text-slate-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            {{-- Main Footer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 py-12 md:py-16">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-black text-lg shadow-lg">MW</div>
                        <div class="flex flex-col">
                            <span class="font-black text-xl text-white leading-tight">Merdeka</span>
                            <span class="font-bold text-sm text-blue-400 -mt-0.5">Warta</span>
                        </div>
                    </a>
                    <p class="text-sm text-slate-400 leading-relaxed mb-5">
                        Portal berita dan informasi resmi SMK Merdeka Bandung. Menyajikan berita terkini seputar kegiatan sekolah, prestasi, dan pengumuman.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white transition-all"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-black hover:text-white transition-all"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Navigasi</h4>
                    <div class="flex flex-col gap-3 text-sm">
                        <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-blue-400"></i> Beranda</a>
                        <a href="{{ route('home') }}#articles" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-blue-400"></i> Artikel</a>
                        <a href="{{ route('home') }}#announcements" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-blue-400"></i> Pengumuman</a>
                    </div>
                </div>

                {{-- Link --}}
                <div>
                    <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Lainnya</h4>
                    <div class="flex flex-col gap-3 text-sm">
                        <a href="{{ route('login') }}" class="hover:text-white transition flex items-center gap-2"><i class="fas fa-chevron-right text-xs text-blue-400"></i> Panel Admin</a>
                    </div>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Kontak</h4>
                    <div class="flex flex-col gap-3 text-sm">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-0.5 text-blue-400"></i>
                            <span>Jl. Merdeka No. 1, Bandung, Jawa Barat</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <span>info@merdekawarta.sch.id</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="border-t border-slate-800 py-6 flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-slate-500">
                <span>&copy; {{ date('Y') }} Merdeka Warta. All rights reserved.</span>
                <span class="text-xs">SMK Merdeka Bandung</span>
            </div>
        </div>
    </footer>

    <script>
        window.contributorPhone = '{{ $globalSettings['contributor_phone'] ?? '6281322263716' }}';
    </script>

    {{-- Alpine x-cloak --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
