<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
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
                    fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] },
                },
            },
        }
    </script>
    <style>
        body { background-color: #f8f9fa; background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 32px 32px; font-family: 'Plus Jakarta Sans', sans-serif; }
        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .sticker-tilt { transform: rotate(-2deg); }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: none !important; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        input:focus { outline: none; box-shadow: none; }
        @keyframes float { 0%,100% { transform: translateY(0) rotate(var(--r,0deg)); } 50% { transform: translateY(-16px) rotate(var(--r,0deg)); } }
        @keyframes spin-slow { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes wobble { 0%,100% { transform: rotate(var(--r,0deg)) translateX(0); } 25% { transform: rotate(var(--r,0deg)) translateX(6px); } 75% { transform: rotate(var(--r,0deg)) translateX(-6px); } }
        .anim-float { animation: float 4s ease-in-out infinite; }
        .anim-float-delayed { animation: float 5s ease-in-out 1s infinite; }
        .anim-spin { animation: spin-slow 8s linear infinite; }
        .anim-spin-reverse { animation: spin-slow 10s linear infinite reverse; }
        .anim-wobble { animation: wobble 3s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center px-6 md:px-8 py-8 relative">
    {{-- Brutalist Decorations --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-12 left-12 w-8 h-8 bg-primary border-3 border-on-background rotate-12 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float"></div>
        <div class="absolute top-20 right-20 w-10 h-10 bg-secondary-container border-3 border-on-background rounded-full -rotate-6 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float-delayed"></div>
        <div class="absolute bottom-24 left-16 w-0 h-0 border-l-[14px] border-l-transparent border-r-[14px] border-r-transparent border-b-[28px] border-b-tertiary-container rotate-12 drop-shadow-[3px_3px_0px_rgba(0,0,0,1)] hidden md:block anim-spin"></div>
        <div class="absolute bottom-32 right-16 w-6 h-6 bg-secondary-fixed border-3 border-on-background rotate-45 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden md:block anim-float"></div>
        <div class="absolute top-1/3 left-8 w-5 h-5 bg-tertiary border-3 border-on-background rounded-full -rotate-3 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-wobble"></div>
        <div class="absolute top-1/2 right-10 w-7 h-7 bg-primary-fixed-dim border-3 border-on-background rotate-[20deg] shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-float-delayed"></div>
        <div class="absolute bottom-1/3 left-20 w-6 h-6 bg-secondary-fixed-dim border-3 border-on-background rotate-[30deg] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-wobble"></div>
        <div class="absolute top-40 left-1/3 w-4 h-4 bg-error-container border-3 border-on-background -rotate-12 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-float"></div>
        <div class="absolute bottom-40 right-1/4 w-0 h-0 border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-b-[20px] border-b-secondary -rotate-[15deg] drop-shadow-[2px_2px_0px_rgba(0,0,0,1)] hidden lg:block anim-spin-reverse"></div>
        <div class="absolute top-1/4 right-1/3 w-5 h-5 bg-on-background border-3 border-on-background rounded-full shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hidden lg:block anim-float-delayed"></div>
    </div>
    <div class="relative z-10">
        {{ $slot }}
    </div>
</body>
</html>