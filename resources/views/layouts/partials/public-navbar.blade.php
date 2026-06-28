@props(['runningTexts' => []])

{{-- MOBILE SIDEBAR --}}
<div class="fixed inset-0 bg-on-background/50 z-[60] closed transition-opacity" id="sidebar-overlay" style="opacity: 0; pointer-events: none;"></div>
<div class="fixed top-0 right-0 h-full w-[85%] max-w-[400px] bg-surface z-[70] closed p-8 flex flex-col" id="mobile-sidebar">
    <div class="flex justify-between items-center mb-12">
        <span class="font-headline-lg text-2xl uppercase">Merdeka Warta</span>
        <button class="p-2 brutalist-border brutalist-shadow-sm bg-error text-on-error btn-press" id="close-sidebar">
            <span class="material-symbols-outlined block">close</span>
        </button>
    </div>
    <nav class="flex flex-col gap-6">
        <a class="text-2xl font-bold font-body-md @if(request()->routeIs('home')) text-primary border-l-4 border-primary @else hover:text-primary border-l-4 border-transparent @endif pl-4 transition-colors" href="{{ route('home') }}">Home</a>
        <a class="text-2xl font-bold font-body-md @if(request()->routeIs('public.article.list')) text-primary border-l-4 border-primary @else hover:text-primary border-l-4 border-transparent @endif pl-4 transition-colors" href="{{ route('public.article.list') }}">Berita</a>
        <a class="text-2xl font-bold font-body-md @if(request()->routeIs('public.announcement.list')) text-primary border-l-4 border-primary @else hover:text-primary border-l-4 border-transparent @endif pl-4 transition-colors" href="{{ route('public.announcement.list') }}">Pengumuman</a>
        <a class="text-2xl font-bold font-body-md @if(request()->routeIs('public.gallery.list')) text-primary border-l-4 border-primary @else hover:text-primary border-l-4 border-transparent @endif pl-4 transition-colors" href="{{ route('public.gallery.list') }}">Galeri</a>
    </nav>
    <div class="mt-auto pt-12">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="w-full brutalist-border bg-primary text-on-primary px-6 py-4 font-label-mono text-label-mono brutalist-shadow-sm btn-press mb-4 text-center block">DASHBOARD</a>
        @else
            <a href="{{ route('login') }}" class="w-full brutalist-border bg-primary text-on-primary px-6 py-4 font-label-mono text-label-mono brutalist-shadow-sm btn-press mb-4 text-center block">LOGIN</a>
        @endauth
        <button onclick="toggleDarkMode()" class="w-full brutalist-border bg-surface-container-highest text-on-surface px-6 py-4 font-label-mono text-label-mono brutalist-shadow-sm btn-press text-center block flex items-center justify-center gap-2">
            <span id="theme-icon-public-mobile" class="material-symbols-outlined">dark_mode</span>
            <span>TEMA</span>
        </button>
    </div>
</div>

{{-- STICKY HEADER WRAPPER --}}
<div class="sticky top-0 z-50">
    {{-- TOP NAVBAR --}}
    <nav class="w-full bg-surface border-b-3 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <div class="flex justify-between items-center w-full px-4 md:px-margin-desktop py-4 max-w-[1440px] mx-auto">
            <div class="logo-smkmerdeka flex items-center gap-3">
                <a href="https://www.smkmerdekabdg.sch.id/" target="_blank"><img width="30" height="30" src="https://cdn.ryzahen.web.id/GQApe.png" alt="smkmerdeka-logo"></a>
                <a class="font-headline-lg text-[24px] md:text-headline-lg uppercase tracking-tighter text-on-surface" href="{{ route('home') }}">
                    MERDEKA WARTA
                </a>
            </div>            
            <div class="hidden lg:flex gap-8 items-center">
                <a class="@if(request()->routeIs('home')) text-primary border-b-3 border-primary @else text-on-surface @endif pb-1 font-bold font-body-md text-body-md hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <a class="@if(request()->routeIs('public.article.list')) text-primary border-b-3 border-primary @else text-on-surface @endif pb-1 font-bold font-body-md text-body-md hover:text-primary transition-colors" href="{{ route('public.article.list') }}">Berita</a>
                <a class="@if(request()->routeIs('public.announcement.list')) text-primary border-b-3 border-primary @else text-on-surface @endif pb-1 font-bold font-body-md text-body-md hover:text-primary transition-colors" href="{{ route('public.announcement.list') }}">Pengumuman</a>
                <a class="@if(request()->routeIs('public.gallery.list')) text-primary border-b-3 border-primary @else text-on-surface @endif pb-1 font-bold font-body-md text-body-md hover:text-primary transition-colors" href="{{ route('public.gallery.list') }}">Galeri</a>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                {{-- Dark Mode Toggle --}}
                <button id="theme-toggle-public" class="hidden lg:block p-2.5 rounded-lg hover:bg-slate-100 transition-colors text-slate-700" onclick="toggleDarkMode()">
                    <span id="theme-icon-public" class="material-symbols-outlined block">dark_mode</span>
                </button>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="hidden lg:block brutalist-border bg-primary text-on-primary px-6 py-2 font-label-mono text-label-mono brutalist-shadow-sm btn-press transition-all">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="hidden lg:block brutalist-border bg-primary text-on-primary px-6 py-2 font-label-mono text-label-mono brutalist-shadow-sm btn-press transition-all">LOGIN</a>
                @endauth
                <button class="lg:hidden p-2 brutalist-border brutalist-shadow-sm bg-surface-container-highest btn-press" id="open-sidebar">
                    <span class="material-symbols-outlined block">menu</span>
                </button>
            </div>
        </div>
    </nav>

    {{-- NEWS TICKER --}}
    @if($runningTexts->isNotEmpty())
        <div class="w-full bg-secondary text-on-secondary py-3 brutalist-border border-x-0 overflow-hidden whitespace-nowrap">
            <div class="flex animate-marquee">
                <div class="flex items-center gap-8 px-4">
                    @foreach($runningTexts as $rt)
                        <span class="font-label-mono text-label-mono uppercase tracking-widest">{{ $rt->text }}</span>
                        @if(!$loop->last)
                            <span class="material-symbols-outlined">stars</span>
                        @endif
                    @endforeach
                </div>
                <div class="flex items-center gap-8 px-4">
                    @foreach($runningTexts as $rt)
                        <span class="font-label-mono text-label-mono uppercase tracking-widest">{{ $rt->text }}</span>
                        @if(!$loop->last)
                            <span class="material-symbols-outlined">stars</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

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
