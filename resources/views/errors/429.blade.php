<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>429 - Terlalu Banyak Permintaan</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                    borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
                    fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] },
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
        .dark body { background-color: var(--background); background-image: radial-gradient(#333 1px, transparent 1px); }
        body { background-color: #f8f9fa; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(var(--r,0deg)); } 50% { transform: translateY(-16px) rotate(var(--r,0deg)); } }
        @keyframes wobble { 0%,100% { transform: rotate(var(--r,0deg)) translateX(0); } 25% { transform: rotate(var(--r,0deg)) translateX(6px); } 75% { transform: rotate(var(--r,0deg)) translateX(-6px); } }
        .anim-float { animation: float 4s ease-in-out infinite; }
        .anim-float-delayed { animation: float 5s ease-in-out 1s infinite; }
        .anim-wobble { animation: wobble 3s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center px-6 md:px-8 py-8 relative text-on-surface">
    {{-- Dark Mode Toggle --}}
    <div x-data="{ dark: document.documentElement.classList.contains('dark') }" class="fixed top-4 right-4 z-50">
        <button @click="dark = !dark; document.documentElement.classList.toggle('dark'); localStorage.setItem('dark-mode', dark)"
            class="w-10 h-10 bg-surface border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center"
            :title="dark ? 'Mode Terang' : 'Mode Gelap'">
            <span class="material-symbols-outlined text-sm" x-text="dark ? 'light_mode' : 'dark_mode'">dark_mode</span>
        </button>
    </div>

    {{-- Brutalist Decorations --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-12 left-12 w-8 h-8 bg-tertiary border-3 border-on-background rotate-12 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float"></div>
        <div class="absolute top-20 right-20 w-10 h-10 bg-secondary-container border-3 border-on-background rounded-full -rotate-6 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float-delayed"></div>
        <div class="absolute bottom-24 left-16 w-0 h-0 border-l-[14px] border-l-transparent border-r-[14px] border-r-transparent border-b-[28px] border-b-tertiary-container rotate-12 drop-shadow-[3px_3px_0px_rgba(0,0,0,1)] hidden md:block" style="animation: spin-slow 8s linear infinite;"></div>
        <div class="absolute bottom-32 right-16 w-6 h-6 bg-tertiary-fixed-dim border-3 border-on-background rotate-45 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float"></div>
        <div class="absolute top-1/3 left-8 w-5 h-5 bg-error border-3 border-on-background rounded-full -rotate-3 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-wobble"></div>
        <div class="absolute top-1/2 right-10 w-7 h-7 bg-primary-fixed-dim border-3 border-on-background rotate-[20deg] shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-float-delayed"></div>
        <div class="absolute bottom-1/3 left-20 w-6 h-6 bg-secondary-fixed-dim border-3 border-on-background rotate-[30deg] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-wobble"></div>
        <div class="absolute top-40 left-1/3 w-4 h-4 bg-error-container border-3 border-on-background -rotate-12 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-float"></div>
    </div>

    <div class="relative z-10 text-center max-w-lg">
        <div class="text-[120px] md:text-[160px] font-headline-lg leading-none text-tertiary tracking-tight">429</div>
        <div class="-mt-4 mb-6 w-20 h-2 bg-tertiary mx-auto"></div>
        <p class="font-body-md text-lg text-on-surface-variant mb-8">Terlalu banyak permintaan dalam waktu singkat. Coba beberapa saat lagi.</p>
        <div class="flex items-center justify-center gap-4 flex-wrap">
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary border-3 border-on-background brutalist-shadow font-label-mono text-xs uppercase tracking-wider hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                <span class="material-symbols-outlined text-sm">refresh</span>
                Muat Ulang
            </a>
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-surface border-3 border-on-background brutalist-shadow font-label-mono text-xs uppercase tracking-wider hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>