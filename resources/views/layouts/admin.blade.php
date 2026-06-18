<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Merdeka Warta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=JetBrains+Mono:wght@700&family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#004ac6",
                        "on-primary": "#ffffff",
                        "primary-container": "#2563eb",
                        "on-primary-container": "#eeefff",
                        "secondary": "#a43073",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#fc79bd",
                        "on-secondary-container": "#76014e",
                        "tertiary": "#864300",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#aa5700",
                        "on-tertiary-container": "#ffede3",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "background": "#f8f9fa",
                        "on-background": "#191c1d",
                        "surface": "#ffffff",
                        "on-surface": "#191c1d",
                        "surface-dim": "#d9dadb",
                        "surface-container": "#edeeef",
                        "surface-container-low": "#f3f4f5",
                        "surface-container-highest": "#e1e3e4",
                        "surface-bright": "#f8f9fa",
                        "outline": "#737686",
                        "outline-variant": "#c3c6d7",
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem",
                    },
                    spacing: {
                        gutter: "24px",
                        "grid-unit": "8px",
                        "margin-mobile": "16px",
                        "margin-desktop": "64px",
                        "border-width": "3px",
                    },
                    fontFamily: {
                        "label-mono": ["JetBrains Mono"],
                        "headline-lg": ["Anton"],
                        "body-md": ["Plus Jakarta Sans"],
                    },
                    fontSize: {
                        "label-mono": ["12px", { lineHeight: "1.2", fontWeight: "700" }],
                        "headline-lg": ["48px", { lineHeight: "100%", fontWeight: "400" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }],
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .brutalist-shadow {
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }
        .brutalist-shadow-hover:hover {
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            transform: translate(-2px, -2px);
        }
        .brutalist-shadow-active:active {
            box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 1);
            transform: translate(4px, 4px);
        }
        .grid-pattern {
            background-image: radial-gradient(#E5E7EB 1px, transparent 1px);
            background-size: 32px 32px;
        }
        .sticker-tilt-left {
            transform: rotate(-2deg);
        }
        .sticker-tilt-right {
            transform: rotate(2deg);
        }
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f3f4f5;
            border: 2px solid #191c1d;
        }
        ::-webkit-scrollbar-thumb {
            background: #191c1d;
            border: 1px solid #ffffff;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem;
            border: 3px solid transparent;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8125rem;
            font-weight: 700;
            transition: all 0.15s ease;
            color: #191c1d;
        }
        .sidebar-link:hover {
            background: #edeeef;
            border-color: #191c1d;
        }
        .sidebar-link.active {
            background: #fc79bd;
            border-color: #191c1d;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
            color: #76014e;
        }
        .form-input {
            width: 100%;
            padding: 0.65rem 1rem;
            border: 3px solid #191c1d;
            font-size: 0.875rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.2s;
            outline: none;
            background: #fff;
        }
        .form-input:focus {
            border-color: #004ac6;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
        }
        .form-label {
            display: block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: #191c1d;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }
        .btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.65rem 1.5rem;
            border: 3px solid #191c1d;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8125rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: all 0.15s ease;
            cursor: pointer;
            box-shadow: 4px 4px 0px 0px rgba(0,0,0,1);
        }
        .btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
        }
        .btn:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px rgba(0,0,0,1);
        }
        .btn-primary {
            background: #004ac6;
            color: #ffffff;
        }
        .btn-primary:hover {
            background: #2563eb;
        }
        .btn-secondary {
            background: #ffffff;
            color: #191c1d;
        }
        .btn-secondary:hover {
            background: #f3f4f5;
        }
        .btn-danger {
            background: #ba1a1a;
            color: #ffffff;
        }
        .btn-danger:hover {
            background: #93000a;
        }
        .btn-success {
            background: #059669;
            color: #ffffff;
        }
        .btn-success:hover {
            background: #047857;
        }
        .table-th {
            padding: 1rem;
            text-align: left;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #191c1d;
            background: #f3f4f5;
            border-bottom: 3px solid #191c1d;
        }
        .table-td {
            padding: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }
        .table-tr {
            transition: background 0.15s ease;
        }
        .table-tr:hover {
            background: rgba(0, 74, 198, 0.05);
        }
        .badge {
            display: inline-flex; align-items: center;
            padding: 0.15rem 0.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            border: 2px solid #191c1d;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-background text-on-background font-body-md text-body-md grid-pattern min-h-screen flex overflow-x-hidden">

    <div x-data="{ sidebarOpen: false, profileOpen: false, notifOpen: false }" class="min-h-screen w-full flex">

        {{-- SIDEBAR OVERLAY (MOBILE) --}}
        <div x-show="sidebarOpen" x-transition:enter.duration.200ms.opacity class="fixed inset-0 bg-on-background/40 z-40 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- SIDEBAR --}}
        <aside x-show="sidebarOpen"
               x-transition:enter="transition duration-200 ease-out"
               x-transition:enter-start="-translate-x-full"
               x-transition:leave="transition duration-150 ease-in"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 z-50 w-64 lg:w-64 lg:relative lg:translate-x-0 bg-surface border-r-[3px] border-on-background shadow-[4px_0px_0px_0px_rgba(0,0,0,1)] flex flex-col overflow-y-auto">

            {{-- Logo --}}
            <div class="p-6 border-b-[3px] border-on-background">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary border-[3px] border-on-background flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined text-on-primary text-3xl">school</span>
                    </div>
                    <div>
                        <h1 class="font-headline-lg text-2xl uppercase text-on-surface leading-none">Merdeka Warta</h1>
                        <p class="font-label-mono text-[10px] uppercase opacity-70">Admin Console</p>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <div class="flex-1 p-3 space-y-1">
                @include('layouts.partials.sidebar')
            </div>

            {{-- Bottom User Info --}}
            <div class="p-3 border-t-[3px] border-on-background">
                <div class="flex items-center gap-3 p-3 bg-surface-container border-[3px] border-on-background">
                    <div class="w-10 h-10 border-[3px] border-on-background rounded-full bg-secondary-fixed overflow-hidden flex items-center justify-center bg-secondary-container font-label-mono text-sm font-bold text-on-secondary-container">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-label-mono text-xs uppercase font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="font-label-mono text-[10px] opacity-60">
                            @if(Auth::user()->isSuperAdmin()) SUPER ADMIN @else AUTHOR @endif
                        </p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <div class="flex-1 flex flex-col min-w-0 lg:ml-0">
            {{-- TopAppBar --}}
            <header class="h-20 px-gutter sticky top-0 z-30 bg-surface border-b-[3px] border-on-background shadow-[0px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-between">
                {{-- Left: hamburger + title --}}
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 border-[3px] border-transparent hover:border-on-background hover:bg-surface-container-highest transition-all duration-75">
                        <span class="material-symbols-outlined text-on-background">menu</span>
                    </button>
                    <div>
                        <h1 class="font-headline-lg text-3xl md:text-4xl uppercase text-on-background tracking-tighter leading-none">@yield('title', 'Dashboard')</h1>
                        <p class="font-label-mono text-[11px] uppercase opacity-60 hidden sm:block">@yield('subtitle', 'Panel administrasi Merdeka Warta')</p>
                    </div>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-2 p-2 border-[3px] border-transparent hover:border-on-background hover:bg-surface-container-highest transition-all duration-75">
                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                        <span class="font-label-mono text-xs uppercase">Website</span>
                    </a>
                    {{-- Notifications (super admin) --}}
                    @if(Auth::user()->isSuperAdmin())
                    <div class="relative" @click.outside="notifOpen = false">
                        <button @click="notifOpen = !notifOpen" class="material-symbols-outlined p-2 border-[3px] border-transparent hover:border-on-background hover:bg-surface-container-highest transition-all duration-75" style="color: #004ac6;">notifications</button>
                        <div x-show="notifOpen" x-transition:enter.duration.100ms.opacity class="absolute right-0 top-full mt-2 w-72 bg-surface border-[3px] border-on-background brutalist-shadow py-2 z-50">
                            <p class="font-label-mono text-xs uppercase px-4 py-2 border-b-[3px] border-on-background">Notifications</p>
                            <p class="font-body-md text-sm p-4 opacity-60">No new notifications</p>
                        </div>
                    </div>
                    @endif
                    {{-- Profile --}}
                    <div class="relative" @click.outside="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 pl-4 border-l-[3px] border-on-background">
                            <span class="font-label-mono text-right hidden lg:block">
                                <p class="text-xs uppercase font-bold">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] opacity-60">{{ Auth::user()->isSuperAdmin() ? 'SUPER ADMINISTRATOR' : 'AUTHOR' }}</p>
                            </span>
                            <div class="w-10 h-10 border-[3px] border-on-background rounded-full overflow-hidden flex items-center justify-center bg-secondary-container font-label-mono font-bold text-on-secondary-container">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>
                        <div x-show="profileOpen" x-transition:enter.duration.100ms.opacity class="absolute right-0 top-full mt-2 w-56 bg-surface border-[3px] border-on-background brutalist-shadow py-1.5 z-50">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 font-label-mono text-xs uppercase hover:bg-surface-container transition-colors">
                                <span class="material-symbols-outlined text-sm">settings</span> Settings
                            </a>
                            <hr class="border-t-[3px] border-on-background">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 font-label-mono text-xs uppercase text-error hover:bg-error-container transition-colors">
                                    <span class="material-symbols-outlined text-sm">logout</span> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="p-gutter py-12 pb-24 space-y-12">
                <div class="max-w-7xl mx-auto">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="flex items-center gap-3 px-4 py-3.5 mb-8 bg-surface border-[3px] border-on-background brutalist-shadow text-on-background font-label-mono text-sm">
                            <span class="material-symbols-outlined text-sm text-on-background">check_circle</span>
                            <span class="flex-1 font-bold">{{ session('success') }}</span>
                            <button @click="show = false" class="p-1 hover:bg-surface-container transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div x-data="{ show: true }" x-show="show"
                             class="flex items-center gap-3 px-4 py-3.5 mb-8 bg-error-container border-[3px] border-on-background brutalist-shadow text-on-error-container font-label-mono text-sm">
                            <span class="material-symbols-outlined text-sm">error</span>
                            <span class="flex-1 font-bold">Terjadi kesalahan. Periksa kembali input Anda.</span>
                            <button @click="show = false" class="p-1 hover:bg-on-error-container/10 transition-colors"><span class="material-symbols-outlined text-sm">close</span></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            <footer class="border-t-[3px] border-on-background bg-surface px-gutter py-4">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 font-label-mono text-[10px] uppercase opacity-60">
                    <span>&copy; {{ date('Y') }} Merdeka Warta - SMK Merdeka Bandung</span>
                    <span>v1.0</span>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.querySelectorAll('.brutalist-shadow-hover').forEach(button => {
            button.addEventListener('mousedown', () => {
                button.style.transform = 'translate(4px, 4px)';
                button.style.boxShadow = '0px 0px 0px 0px rgba(0,0,0,1)';
            });
            button.addEventListener('mouseup', () => {
                button.style.transform = 'translate(-2px, -2px)';
                button.style.boxShadow = '6px 6px 0px 0px rgba(0,0,0,1)';
            });
            button.addEventListener('mouseleave', () => {
                button.style.transform = '';
                button.style.boxShadow = '4px 4px 0px 0px rgba(0,0,0,1)';
            });
        });
    </script>

</body>
</html>
