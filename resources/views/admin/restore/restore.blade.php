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
    <title>Restore Super Admin</title>
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
                "surface-container-lowest": "var(--surface-container-lowest)",
            }, borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
            fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] } } }
        }
    </script>
    <style>
        :root {
            --tertiary-container: #aa5700; --on-background: #191c1d; --background: #f8f9fa;
            --surface: #f8f9fa; --primary: #004ac6; --on-primary: #ffffff;
            --on-surface-variant: #434655; --error: #ba1a1a; --secondary: #a43073;
            --tertiary: #864300; --surface-container-highest: #e1e3e4; --primary-fixed-dim: #b4c5ff;
            --secondary-fixed-dim: #ffafd3; --error-container: #ffdad6; --secondary-container: #fc79bd;
            --surface-container-lowest: #ffffff;
        }
        .dark {
            --tertiary-container: #665500; --on-background: #ffffff; --background: #0a0a0a;
            --surface: #111111; --primary: #ffd700; --on-primary: #000000;
            --on-surface-variant: #cccccc; --error: #ff6b6b; --secondary: #ff8c00;
            --tertiary: #ffcc02; --surface-container-highest: #2a2a2a; --primary-fixed-dim: #ffd700;
            --secondary-fixed-dim: #ffb347; --error-container: #6b0000; --secondary-container: #e67e00;
            --surface-container-lowest: #080808;
        }
        .dark body { background-color: var(--background); background-image: radial-gradient(#333 1px, transparent 1px); }
        body { background-color: #f8f9fa; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .admin-input {
            width: 100%; background-color: var(--surface-container-lowest);
            border: 3px solid var(--on-background); padding: 0.625rem 0.75rem;
            font-size: 0.875rem; font-weight: 500; transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.08);
        }
        .admin-input:focus { border-color: var(--primary); box-shadow: 3px 3px 0px 0px color-mix(in srgb, var(--primary) 15%, transparent); background-color: var(--background); }
        .dark .admin-input { background-color: var(--surface-container); color: var(--on-surface); }
        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: var(--primary); color: var(--on-primary);
            font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem; border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); transition: all 0.15s ease;
        }
        .btn-primary:hover { transform: translate(-2px, -2px); box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1); }
        .btn-primary:active { transform: translate(2px, 2px); box-shadow: none; }
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

    <div class="relative z-10 w-full max-w-lg">
        <div class="bg-surface border-3 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-10 h-10 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary text-sm">restore_page</span>
                </span>
                <div>
                    <h1 class="font-headline-lg text-lg uppercase tracking-tight">Restore Super Admin</h1>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Buat akun super admin utama baru</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.restore.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="admin-input" placeholder="Masukkan nama super admin">
                    @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="admin-input" placeholder="superadmin@merdekawarta.com">
                    @error('email') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Password</label>
                    <input type="password" name="password" required
                        class="admin-input" placeholder="Minimal 8 karakter">
                    @error('password') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="admin-input" placeholder="Ulangi password">
                </div>

                <button type="submit" class="btn-primary w-full justify-center mt-2">
                    <span class="material-symbols-outlined text-sm">restore_page</span>
                    Restore Super Admin
                </button>
            </form>
        </div>
    </div>
</body>
</html>