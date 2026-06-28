<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
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
                    spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px", "grid-unit": "8px", "border-width": "3px" },
                    fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] },
                    fontSize: {
                        "headline-lg": ["36px", { lineHeight: "100%", fontWeight: "400" }],
                        "label-mono": ["12px", { lineHeight: "1.2", fontWeight: "700" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }]
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
        .dark .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(255,255,255,0.12); }
        .dark .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12); }
        .dark .brutalist-border { border-color: var(--on-background); }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--surface-container); }

        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: none !important; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--on-surface-variant);
            transition: all 0.15s ease;
            border: 2px solid transparent;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            background: var(--surface-container);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        .sidebar-link.active {
            background: var(--primary);
            color: var(--on-primary);
            border-left-color: var(--on-background);
            border-color: var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .sidebar-link.active {
            box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15);
        }
        .sidebar-link.active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            font-size: 1.25rem;
        }
        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        input:focus { outline: none; box-shadow: none; }
        textarea:focus { outline: none; box-shadow: none; }
        select:focus { outline: none; box-shadow: none; }

        [x-cloak] { display: none !important; }

        .admin-card {
            background: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            position: relative;
        }
        .dark .admin-card {
            box-shadow: 8px 8px 0px 0px rgba(255,255,255,0.12);
        }
        .admin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary);
            opacity: 0.5;
        }
        .admin-card-sm {
            background: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .admin-card-sm {
            box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12);
        }
        .admin-input {
            width: 100%;
            background-color: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.08);
        }
        .admin-input:focus {
            border-color: var(--primary);
            box-shadow: 3px 3px 0px 0px color-mix(in srgb, var(--primary) 15%, transparent);
            background-color: var(--background);
        }
        .admin-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary);
            color: var(--on-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-primary { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-primary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--on-primary-fixed-variant);
        }
        .dark .admin-btn-primary:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-primary:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--surface-container-lowest);
            color: var(--on-surface);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-secondary { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-secondary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--primary-fixed);
            border-color: var(--primary);
            color: var(--primary);
        }
        .dark .admin-btn-secondary:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-secondary:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--error);
            color: var(--on-error);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-danger { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-danger:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--on-error-container);
        }
        .dark .admin-btn-danger:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-danger:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.7rem;
        }
        .admin-btn-success {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #2e7d32;
            color: #ffffff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-success { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-success:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: #1b5e20;
        }
        .dark .admin-btn-success:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-success:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 2px solid #191c1d;
        }
        .admin-badge-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        .admin-badge-warning {
            background-color: #fff3e0;
            color: #e65100;
            border-color: #e65100;
        }
        .admin-badge-info {
            background-color: #e3f2fd;
            color: #004ac6;
            border-color: #004ac6;
        }
        .admin-badge-error {
            background-color: #ffebee;
            color: #c62828;
            border-color: #c62828;
        }
        .admin-badge-neutral {
            background-color: #f5f5f5;
            color: #616161;
            border-color: #616161;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border: 2px solid var(--on-background);
            background: var(--surface-container-lowest);
            color: var(--on-surface-variant);
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .action-btn { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }
        .action-btn:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .action-btn:hover { box-shadow: 3px 3px 0px 0px rgba(255,255,255,0.12); }
        .action-btn:active {
            transform: translate(1px, 1px);
            box-shadow: none;
        }
        .action-btn-edit:hover {
            background: var(--primary-fixed);
            color: var(--primary);
            border-color: var(--primary);
        }
        .action-btn-view:hover {
            background: #e8f5e9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        .dark .action-btn-view:hover {
            background: #1b5e20;
            color: #a5d6a7;
            border-color: #a5d6a7;
        }
        .action-btn-delete:hover {
            background: #ffebee;
            color: #c62828;
            border-color: #c62828;
        }
        .dark .action-btn-delete:hover {
            background: #93000a;
            color: #ffb4ab;
            border-color: #ffb4ab;
        }

        /* Stat card variants */
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
        }
        .stat-card-blue::after { background: #004ac6; }
        .stat-card-pink::after { background: #a43073; }
        .stat-card-orange::after { background: #864300; }
        .stat-card-green::after { background: #2e7d32; }
        .stat-card-purple::after { background: #7b1fa2; }
        .stat-card-teal::after { background: #00695c; }

        /* Card header accent colors */
        .card-header-blue { border-bottom-color: #004ac6 !important; }
        .card-header-pink { border-bottom-color: #a43073 !important; }
        .card-header-orange { border-bottom-color: #864300 !important; }
        .card-header-green { border-bottom-color: #2e7d32 !important; }

        /* Table styling */
        .admin-table th {
            background: var(--primary-fixed);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            padding: 0.75rem;
            border-bottom: 3px solid var(--on-background);
        }
        .dark .admin-table th {
            background: var(--surface-container-high);
            color: var(--on-surface);
        }
        .admin-table td {
            padding: 0.75rem;
            border-bottom: 2px solid color-mix(in srgb, var(--on-background) 10%, transparent);
        }
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        .admin-table tbody tr {
            transition: background 0.15s ease;
        }
        .admin-table tbody tr:hover {
            background: color-mix(in srgb, var(--primary) 8%, var(--surface));
        }

        /* Custom file input */
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-input::before {
            content: 'Pilih File';
            display: inline-block;
            background: var(--primary);
            color: var(--on-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 0.375rem 0.75rem;
            border: 2px solid var(--on-background);
            margin-right: 0.5rem;
            cursor: pointer;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .custom-file-input::before { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }

        /* Page header accent */
        .page-header-accent {
            width: 3rem;
            height: 4px;
            background: #004ac6;
            margin-top: 0.25rem;
        }

        /* Empty state styling */
        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            background: var(--surface-container-highest);
            border: 3px solid var(--on-background);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 0.1);
        }
        .dark .empty-state-icon { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12); }
        .dark .admin-input { background-color: var(--surface-container); color: var(--on-surface); }
        .dark .admin-input::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark input:not([class]):not(.admin-input) { background-color: var(--surface-container); color: var(--on-surface); }
        .dark input:not([class]):not(.admin-input)::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark textarea:not([class]):not(.admin-input)::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark select:not([class]):not(.admin-input) { background-color: var(--surface-container); color: var(--on-surface); }

        /* Section title with accent line */
        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: var(--on-background);
            opacity: 0.3;
        }

        /* Navbar accent */
        .navbar-brand-icon {
            background: var(--primary);
            box-shadow: 3px 3px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .navbar-brand-icon { box-shadow: 3px 3px 0px 0px rgba(255,255,255,0.12); }

        /* Dark mode - badge overrides for inline Tailwind classes */
        .dark [class*="bg-green-100"]:is(.admin-badge) { background-color: #1b5e20 !important; color: #a5d6a7 !important; border-color: #4caf50 !important; }
        .dark [class*="bg-blue-100"]:is(.admin-badge) { background-color: #0d47a1 !important; color: #90caf9 !important; border-color: #2196f3 !important; }
        .dark [class*="bg-red-100"]:is(.admin-badge) { background-color: #8b0000 !important; color: #ef9a9a !important; border-color: #f44336 !important; }
        .dark [class*="bg-orange-100"]:is(.admin-badge) { background-color: #993d00 !important; color: #ffcc80 !important; border-color: #ff9800 !important; }
        .dark [class*="bg-teal-100"]:is(.admin-badge) { background-color: #004d40 !important; color: #80cbc4 !important; border-color: #009688 !important; }
        .dark [class*="bg-purple-100"]:is(.admin-badge) { background-color: #4a148c !important; color: #ce93d8 !important; border-color: #9c27b0 !important; }
        .dark [class*="bg-gray-100"]:is(.admin-badge) { background-color: #424242 !important; color: #e0e0e0 !important; border-color: #9e9e9e !important; }

        /* Dark mode - admin badge CSS variants */
        .dark .admin-badge-success { background-color: #1b5e20 !important; color: #a5d6a7 !important; border-color: #4caf50 !important; }
        .dark .admin-badge-warning { background-color: #993d00 !important; color: #ffcc80 !important; border-color: #ff9800 !important; }
        .dark .admin-badge-info { background-color: #0d47a1 !important; color: #90caf9 !important; border-color: #2196f3 !important; }
        .dark .admin-badge-error { background-color: #8b0000 !important; color: #ef9a9a !important; border-color: #f44336 !important; }
        .dark .admin-badge-neutral { background-color: #424242 !important; color: #e0e0e0 !important; border-color: #9e9e9e !important; }

        /* Dark mode - stat card accents */
        .dark .stat-card-blue::after { background: #ffd700; }
        .dark .stat-card-pink::after { background: #ff8c00; }
        .dark .stat-card-orange::after { background: #ffcc02; }
        .dark .stat-card-green::after { background: #66bb6a; }
        .dark .stat-card-purple::after { background: #ffd700; }
        .dark .stat-card-teal::after { background: #ffd700; }

        /* Dark mode - card header accents */
        .dark .card-header-blue { border-bottom-color: #ffd700 !important; }
        .dark .card-header-pink { border-bottom-color: #ff8c00 !important; }
        .dark .card-header-orange { border-bottom-color: #ffcc02 !important; }
        .dark .card-header-green { border-bottom-color: #66bb6a !important; }

        /* Dark mode - page header accent */
        .dark .page-header-accent { background: #ffd700; }

        /* Dark mode toggle */
        .dark-mode-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border: 2px solid var(--on-background);
            background: var(--surface-container-lowest);
            color: var(--on-surface);
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,0.1);
        }
        .dark-mode-toggle:hover {
            background: var(--primary-fixed);
            color: var(--primary);
            border-color: var(--primary);
        }
        .dark .dark-mode-toggle { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }
        .dark .dark-mode-toggle:hover {
            background: var(--primary);
            color: var(--on-primary);
        }
    </style>
    @stack('styles')
</head>
<body class="text-on-surface antialiased">

    {{-- Mobile Sidebar Overlay --}}
    <div x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('dark-mode') === 'true' }" x-init="$watch('sidebarOpen', val => document.body.classList.toggle('overflow-hidden', val)); $watch('darkMode', val => { localStorage.setItem('dark-mode', val); document.documentElement.classList.toggle('dark', val) })">
        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-on-background/50 z-40 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Mobile Sidebar --}}
        <div x-show="sidebarOpen" x-cloak x-transition:enter="transition transform duration-200 ease-out" x-transition:enter-start="-translate-x-full" x-transition:leave="transition transform duration-150 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 h-full w-[280px] bg-surface z-50 overflow-y-auto border-r-3 border-on-background shadow-[4px_0px_0px_0px_rgba(0,0,0,1)]">
            <div class="p-4">
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 navbar-brand-icon border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary text-lg">dashboard</span>
                        </div>
                        <span class="font-headline-lg text-lg uppercase tracking-tight">Admin</span>
                    </a>
                    <button @click="sidebarOpen = false" class="p-1.5 border-2 border-on-background hover:bg-surface-container-highest">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                @include('layouts.partials.sidebar')
            </div>
        </div>

        {{-- DESKTOP SIDEBAR --}}
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-30 lg:flex lg:w-[260px] lg:flex-col">
            <div class="flex grow flex-col gap-y-4 overflow-y-auto bg-surface border-r-3 border-on-background px-4 pb-4 shadow-[4px_0px_0px_0px_rgba(0,0,0,1)]">
                {{-- Brand --}}
                <div class="flex items-center gap-3 h-16 shrink-0 border-b-3 border-on-background">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 navbar-brand-icon border-3 border-on-background flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary">dashboard</span>
                        </div>
                        <span class="font-headline-lg text-xl uppercase tracking-tight text-on-surface">Admin</span>
                    </a>
                </div>

                {{-- Sidebar Navigation --}}
                <nav class="flex flex-1 flex-col gap-0.5">
                    @include('layouts.partials.sidebar')
                </nav>

                {{-- Sidebar footer accent --}}
                <div class="h-1 bg-primary opacity-20"></div>
            </div>
        </div>

        {{-- MAIN CONTENT AREA --}}
        <div class="lg:pl-[260px]">
            {{-- TOP NAVBAR --}}
            <div class="sticky top-0 z-20 bg-surface/95 backdrop-blur-md border-b-3 border-on-background shadow-[0_4px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex items-center justify-between h-16 px-4 md:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 border-2 border-on-background hover:bg-surface-container-highest">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div class="hidden md:flex items-center gap-2 font-label-mono text-xs uppercase text-on-surface-variant">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                            @hasSection('breadcrumb')
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                                @yield('breadcrumb')
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2" x-data="{ userMenu: false }">
                        {{-- Dark Mode Toggle --}}
                        <button @click="darkMode = !darkMode" class="dark-mode-toggle" title="Toggle dark mode">
                            <template x-if="!darkMode">
                                <span class="material-symbols-outlined text-sm">dark_mode</span>
                            </template>
                            <template x-if="darkMode">
                                <span class="material-symbols-outlined text-sm">light_mode</span>
                            </template>
                        </button>
                        <div class="flex items-center gap-2 font-label-mono text-xs uppercase text-on-surface-variant truncate max-w-[120px] sm:max-w-none">
                            <span class="w-7 h-7 rounded-full bg-primary flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-primary text-xs">person</span>
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="relative">
                            <button @click="userMenu = !userMenu" class="w-9 h-9 bg-primary border-3 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
                                <span class="material-symbols-outlined text-on-primary text-sm">more_vert</span>
                            </button>
                            <div x-show="userMenu" x-cloak @click.outside="userMenu = false" x-transition class="absolute right-0 mt-2 w-48 bg-surface border-3 border-on-background shadow-[6px_6px_0px_0px rgba(0,0,0,1)] z-50">
                                <div class="p-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase hover:bg-surface-container-low transition-colors rounded">
                                        <span class="material-symbols-outlined text-sm">settings</span>
                                        Pengaturan
                                    </a>
                                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase hover:bg-surface-container-low transition-colors rounded">
                                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                                        Lihat Website
                                    </a>
                                    <hr class="border-on-background/20 my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase text-error hover:bg-error-container transition-colors rounded">
                                            <span class="material-symbols-outlined text-sm">logout</span>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="mx-4 md:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="bg-secondary-fixed border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-secondary text-sm">check_circle</span>
                            </span>
                            <p class="font-body-md text-sm font-bold">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="p-1 hover:bg-surface-container-highest border-2 border-on-background">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 md:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="bg-error-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-error border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-error text-sm">error</span>
                            </span>
                            <p class="font-body-md text-sm font-bold">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="p-1 hover:bg-surface-container-highest border-2 border-on-background">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            {{-- PAGE HEADER --}}
            @hasSection('page_title')
                <div class="px-4 md:px-6 pt-6 pb-2">
                    <h1 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight">
                        @yield('page_title')
                    </h1>
                    <div class="page-header-accent"></div>
                    @hasSection('page_description')
                        <p class="font-body-md text-sm text-on-surface-variant mt-3">@yield('page_description')</p>
                    @endif
                </div>
            @endif

            {{-- MAIN CONTENT --}}
            <main class="px-4 md:px-6 py-6">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <div class="border-t-3 border-on-background px-4 md:px-6 py-4 bg-surface-container-low">
                <div class="flex items-center justify-between font-label-mono text-xs uppercase text-on-surface-variant">
                    <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
                    <span>SMK Merdeka Bandung</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-confirm-delete]')) {
                e.preventDefault();
                const btn = e.target.closest('[data-confirm-delete]');
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: btn.dataset.message || 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ba1a1a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'brutalist-border shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] rounded-none',
                        confirmButton: 'admin-btn-danger admin-btn-sm',
                        cancelButton: 'admin-btn-secondary admin-btn-sm',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
    @stack('scripts')
    <x:loading-overlay />
</body>
</html>
