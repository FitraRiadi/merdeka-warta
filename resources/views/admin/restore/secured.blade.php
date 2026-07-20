<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Terjaga</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: { extend: { colors: {
                "on-background": "var(--on-background)", "background": "var(--background)",
                "surface": "var(--surface)", "primary": "var(--primary)", "on-primary": "var(--on-primary)",
                "on-surface-variant": "var(--on-surface-variant)", "error": "var(--error)",
                "secondary": "var(--secondary)", "tertiary": "var(--tertiary)",
                "tertiary-container": "var(--tertiary-container)", "surface-container-highest": "var(--surface-container-highest)",
                "primary-fixed-dim": "var(--primary-fixed-dim)", "secondary-fixed-dim": "var(--secondary-fixed-dim)",
                "error-container": "var(--error-container)", "secondary-container": "var(--secondary-container)",
            }, borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
            fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] } } }
        }
    </script>
    <style>
        :root {
            --on-surface: #191c1d; --tertiary-container: #aa5700; --on-background: #191c1d; --background: #f8f9fa;
            --surface: #f8f9fa; --primary: #004ac6; --on-primary: #ffffff;
            --on-surface-variant: #434655; --error: #ba1a1a; --secondary: #a43073;
            --tertiary: #864300; --surface-container-highest: #e1e3e4; --primary-fixed-dim: #b4c5ff;
            --secondary-fixed-dim: #ffafd3; --error-container: #ffdad6; --secondary-container: #fc79bd;
        }
        .dark {
            --on-surface: #ffffff; --tertiary-container: #665500; --on-background: #ffffff; --background: #0a0a0a;
            --surface: #111111; --primary: #ffd700; --on-primary: #000000;
            --on-surface-variant: #cccccc; --error: #ff6b6b; --secondary: #ff8c00;
            --tertiary: #ffcc02; --surface-container-highest: #2a2a2a; --primary-fixed-dim: #ffd700;
            --secondary-fixed-dim: #ffb347; --error-container: #6b0000; --secondary-container: #e67e00;
        }
        .dark body { background-color: var(--background); background-image: radial-gradient(#333 1px, transparent 1px); }
        body { background-color: #f8f9fa; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center px-6 py-8 relative text-on-surface">
    <div x-data="{ dark: document.documentElement.classList.contains('dark') }" class="fixed top-4 right-4 z-50">
        <button @click="dark = !dark; document.documentElement.classList.toggle('dark'); localStorage.setItem('dark-mode', dark)"
            class="w-10 h-10 bg-surface border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center"
            :title="dark ? 'Mode Terang' : 'Mode Gelap'">
            <span class="material-symbols-outlined text-sm" x-text="dark ? 'light_mode' : 'dark_mode'">dark_mode</span>
        </button>
    </div>

    <div class="relative z-10 text-center max-w-md">
        <div class="w-24 h-24 bg-primary border-4 border-on-background flex items-center justify-center mx-auto mb-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-5xl text-on-primary">security</span>
        </div>
        <h1 class="font-headline-lg text-4xl uppercase tracking-tight mb-4">Akses Terjaga</h1>
        <div class="w-16 h-1.5 bg-primary mx-auto mb-6"></div>
        <p class="font-body-md text-base text-on-surface-variant mb-8">
            Super Admin utama masih aktif. Akun ini hanya berfungsi sebagai cadangan untuk pemulihan jika Super Admin utama tidak tersedia.
        </p>
        <p class="font-label-mono text-xs text-on-surface-variant mb-8">
            Tidak ada tindakan yang diperlukan saat ini.
        </p>
        <div class="flex items-center justify-center gap-4 flex-wrap">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary border-3 border-on-background brutalist-shadow font-label-mono text-xs uppercase tracking-wider hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    Kembali ke Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>