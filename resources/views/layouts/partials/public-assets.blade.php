<script>
    if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }
</script>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "var(--color-primary)",
                    "on-primary": "var(--color-on-primary)",
                    secondary: "var(--color-secondary)",
                    "on-secondary": "var(--color-on-secondary)",
                    accent: "var(--color-accent)",
                    surface: "var(--color-surface)",
                    "on-surface": "var(--color-on-surface)",
                    background: "var(--color-background)",
                    "on-background": "var(--color-on-background)",
                    muted: "var(--color-muted)",
                    "on-muted": "var(--color-on-muted)",
                    destructive: "var(--color-destructive)",
                    "on-destructive": "var(--color-on-destructive)",
                    "surface-variant": "var(--color-surface-variant)",
                    "on-surface-variant": "var(--color-on-surface-variant)",
                    "surface-container": "var(--color-surface-container)",
                    "surface-container-high": "var(--color-surface-container-high)",
                    "surface-container-low": "var(--color-surface-container-low)",
                },
                borderRadius: { DEFAULT: "0", lg: "0", xl: "0.25rem", "2xl": "0.5rem" },
                spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px" },
                fontFamily: {
                    headline: ["Space Grotesk", "sans-serif"],
                    body: ["Plus Jakarta Sans", "sans-serif"],
                    mono: ["JetBrains Mono", "monospace"],
                },
                fontSize: {
                    "headline-xl": ["56px", { lineHeight: "95%", fontWeight: "700", letterSpacing: "-0.03em" }],
                    "headline-lg": ["40px", { lineHeight: "100%", fontWeight: "700", letterSpacing: "-0.02em" }],
                    "headline-md": ["28px", { lineHeight: "105%", fontWeight: "700" }],
                    "headline-sm": ["20px", { lineHeight: "110%", fontWeight: "700" }],
                    "body-lg": ["18px", { lineHeight: "1.5", fontWeight: "500" }],
                    "body-md": ["15px", { lineHeight: "1.6", fontWeight: "500" }],
                    "body-sm": ["13px", { lineHeight: "1.5", fontWeight: "500" }],
                    "label-mono": ["11px", { lineHeight: "1.2", fontWeight: "700" }],
                },
            },
        },
    }
</script>
<style>
    :root {
        --color-primary: #DC2626;
        --color-on-primary: #FFFFFF;
        --color-secondary: #EF4444;
        --color-on-secondary: #FFFFFF;
        --color-accent: #1E40AF;
        --color-surface: #FFF5F5;
        --color-on-surface: #450A0A;
        --color-background: #FEF2F2;
        --color-on-background: #450A0A;
        --color-muted: #F0EDF1;
        --color-on-muted: #450A0A;
        --color-surface-variant: #FEE2E2;
        --color-on-surface-variant: #7F1D1D;
        --color-surface-container: #FECACA;
        --color-surface-container-high: #FEE2E2;
        --color-surface-container-low: #FFF5F5;
        --color-destructive: #DC2626;
        --color-on-destructive: #FFFFFF;
        --color-border: #450A0A;
    }
    .dark {
        --color-primary: #EF4444;
        --color-on-primary: #000000;
        --color-secondary: #F87171;
        --color-on-secondary: #000000;
        --color-accent: #60A5FA;
        --color-surface: #1A1A1A;
        --color-on-surface: #FEF2F2;
        --color-background: #0A0A0A;
        --color-on-background: #FEF2F2;
        --color-muted: #2A2A2A;
        --color-on-muted: #FEF2F2;
        --color-surface-variant: #2A2A2A;
        --color-on-surface-variant: #FECACA;
        --color-surface-container: #222222;
        --color-surface-container-high: #2A2A2A;
        --color-surface-container-low: #1A1A1A;
        --color-destructive: #EF4444;
        --color-on-destructive: #000000;
        --color-border: #FEF2F2;
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
        background-color: var(--color-background);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Neo Brutalism Core */
    .brutal-border { border: 4px solid var(--color-border); }
    .brutal-border-2 { border: 2px solid var(--color-border); }
    .brutal-shadow { box-shadow: 8px 8px 0px 0px var(--color-border); }
    .brutal-shadow-sm { box-shadow: 4px 4px 0px 0px var(--color-border); }
    .brutal-shadow-hover:hover { box-shadow: 12px 12px 0px 0px var(--color-border); transform: translate(-2px, -2px); }
    .brutal-card {
        border: 4px solid var(--color-border);
        box-shadow: 8px 8px 0px 0px var(--color-border);
        transition: all 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .brutal-card:hover {
        box-shadow: 12px 12px 0px 0px var(--color-border);
        transform: translate(-2px, -2px);
    }
    .brutal-card-static {
        border: 4px solid var(--color-border);
        box-shadow: 8px 8px 0px 0px var(--color-border);
    }

    /* Mechanical Press */
    .btn-press {
        transition: all 0.1s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .btn-press:active {
        transform: translate(4px, 4px);
        box-shadow: none !important;
    }
    .btn-press-sm:active {
        transform: translate(2px, 2px);
        box-shadow: none !important;
    }

    /* Tilt on hover */
    .tilt-hover {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .tilt-hover:hover {
        transform: rotate(-2deg) translateY(-4px);
    }

    /* Slight rotation default */
    .brutal-rotate { transform: rotate(-1deg); }
    .brutal-rotate-2 { transform: rotate(1deg); }

    /* Mobile sidebar */
    #mobile-sidebar { transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
    #mobile-sidebar.closed { transform: translateX(100%); }
    #mobile-sidebar:not(.closed) { transform: translateX(0); }
    #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
    #sidebar-overlay.closed { opacity: 0 !important; pointer-events: none !important; }
    #sidebar-overlay:not(.closed) { opacity: 1 !important; pointer-events: auto !important; }

    /* News slider */
    .news-slider-track { display: flex; transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .news-slider-item { flex: 0 0 100%; padding: 0 8px; }
    @media (min-width: 768px) { .news-slider-item { flex: 0 0 50%; padding: 0 6px; } }
    @media (min-width: 1024px) { .news-slider-item { flex: 0 0 33.333%; } }

    /* Gallery stack */
    .gallery-stack-wrapper { position: relative; width: 100%; height: 100%; }
    .gallery-stack { position: absolute; inset: 0; display: flex; overflow: hidden; border-radius: inherit; }
    .gallery-stack-item { flex: 1; min-width: 0; overflow: hidden; position: relative; cursor: pointer; transition: flex 0.5s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .gallery-stack-item:not(:first-child) { margin-left: -10%; }
    .gallery-stack-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; pointer-events: none; }
    .gallery-stack-item .overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.65), transparent); display: flex; align-items: flex-end; padding: 10px; opacity: 0; transition: opacity 0.3s ease; pointer-events: none; }
    .gallery-stack:hover .gallery-stack-item { flex: 0.3; }
    .gallery-stack:hover .gallery-stack-item:hover { flex: 2.4; }
    .gallery-stack:hover .gallery-stack-item:hover .overlay { opacity: 1; }
    .gallery-stack-item:hover img { transform: scale(1.05); }

    @keyframes scroll-gallery { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .animate-scroll-gallery { animation: scroll-gallery 10s linear infinite; }
    @media (max-width: 767px) { .animate-scroll-gallery { animation-duration: 6s; } }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .brutal-card:hover, .brutal-shadow-hover:hover, .tilt-hover:hover, .btn-press:active, .btn-press-sm:active {
            transform: none !important;
        }
        .news-slider-track { transition: none; }
        #mobile-sidebar { transition: none; }
    }

    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    /* Nav underline animation — melebar kiri-kanan */
    .nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        vertical-align: top;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 100%;
        height: 3px;
        background-color: var(--color-primary);
        border-radius: 999px;
        transform: translateX(-50%) scaleX(0);
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: center;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
        transform: translateX(-50%) scaleX(1);
    }

    .nav-link-mobile {
        position: relative;
        display: inline-flex;
        align-items: center;
    }
    .nav-link-mobile::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        width: 100%;
        height: 4px;
        background-color: var(--color-primary);
        border-radius: 999px;
        transform: translateX(-50%) scaleX(0);
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: center;
    }
    .nav-link-mobile:hover::after,
    .nav-link-mobile.active::after {
        transform: translateX(-50%) scaleX(1);
    }
</style>

{{-- GSAP via CDN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Register GSAP plugins
    gsap.registerPlugin(ScrollTrigger);
    gsap.config({ autoSleep: 60, force3D: true });

    // ============================================================
    // NEO BRUTALISM ANIMATION ENGINE
    // ============================================================

    // Page intro stagger animation
    function initBrutalIntro() {
        const intro = document.querySelector('[data-brutal-intro]');
        if (!intro) return;
        const targets = intro.children.length > 0
            ? [...intro.children].filter(c => c.tagName !== 'SCRIPT' && c.tagName !== 'STYLE')
            : [intro];
        if (targets.length === 0) return;

        gsap.set(targets, { y: 40, opacity: 0, scale: 0.95 });

        gsap.to(targets, {
            y: 0,
            opacity: 1,
            scale: 1,
            duration: 0.6,
            stagger: targets.length > 1 ? 0.08 : 0,
            ease: 'back.out(1.7)',
            clearProps: 'transform',
        });
    }

    // Scroll reveal animation
    function initBrutalReveal() {
        document.querySelectorAll('[data-reveal]').forEach(el => {
            const anim = el.dataset.reveal || 'up';
            const delay = parseFloat(el.dataset.revealDelay) || 0;
            const fromVars = {
                up: { y: 50, opacity: 0 },
                down: { y: -50, opacity: 0 },
                left: { x: 50, opacity: 0 },
                right: { x: -50, opacity: 0 },
                fade: { opacity: 0 },
                zoom: { scale: 0.85, opacity: 0 },
            }[anim] || { y: 50, opacity: 0 };

            gsap.fromTo(el, fromVars, {
                y: 0, x: 0, scale: 1, opacity: 1,
                duration: 0.7,
                delay: delay,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                    once: true,
                },
            });
        });
    }

    // Card stagger in grid
    function initBrutalCards() {
        document.querySelectorAll('[data-brutal-grid]').forEach(grid => {
            const items = [...grid.children].filter(c => c.tagName !== 'SCRIPT' && c.tagName !== 'STYLE');
            if (items.length < 2) return;
            gsap.fromTo(items, { opacity: 0, y: 30, scale: 0.95 }, {
                opacity: 1, y: 0, scale: 1,
                duration: 0.5,
                stagger: 0.06,
                ease: 'back.out(1.4)',
                scrollTrigger: { trigger: grid, start: 'top 85%', once: true },
            });
        });
    }

    // Floating elements
    function initBrutalFloat() {
        document.querySelectorAll('[data-float]').forEach(el => {
            gsap.to(el, {
                y: () => -(Math.random() * 20 + 8),
                x: () => (Math.random() - 0.5) * 12,
                rotation: () => (Math.random() - 0.5) * 12,
                duration: () => Math.random() * 2 + 2.5,
                repeat: -1, yoyo: true,
                ease: 'sine.inOut',
                delay: Math.random() * 2,
            });
        });
    }

    // Magnetic hover effect for buttons
    function initBrutalMagnetic() {
        document.querySelectorAll('[data-magnetic]').forEach(el => {
            el.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                gsap.to(this, { x: x * 0.3, y: y * 0.3, duration: 0.3, ease: 'power2.out' });
            });
            el.addEventListener('mouseleave', function() {
                gsap.to(this, { x: 0, y: 0, duration: 0.3, ease: 'power2.out' });
            });
        });
    }

    // Counter animation
    function initBrutalCounter() {
        document.querySelectorAll('[data-counter]').forEach(el => {
            const target = parseInt(el.dataset.counter) || 0;
            if (target === 0) return;
            ScrollTrigger.create({
                trigger: el,
                start: 'top 90%',
                once: true,
                onEnter: () => {
                    gsap.fromTo(el, { textContent: 0 }, {
                        textContent: target,
                        duration: 1.5,
                        ease: 'power2.out',
                        snap: { textContent: 1 },
                        onUpdate: () => {
                            el.textContent = (parseInt(el.textContent) || 0).toLocaleString();
                        },
                    });
                },
            });
        });
    }

    // Parallax tilt on cards
    function initBrutalTilt() {
        document.querySelectorAll('[data-tilt]').forEach(el => {
            el.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                gsap.to(this, {
                    rotationY: x * 8,
                    rotationX: -y * 8,
                    transformPerspective: 800,
                    duration: 0.3,
                    ease: 'power2.out',
                });
            });
            el.addEventListener('mouseleave', function() {
                gsap.to(this, { rotationY: 0, rotationX: 0, duration: 0.3, ease: 'power2.out' });
            });
        });
    }

    // Initialize all animations
    function initBrutalAnimations() {
        initBrutalIntro();
        initBrutalReveal();
        initBrutalCards();
        initBrutalFloat();
        initBrutalMagnetic();
        initBrutalCounter();
        initBrutalTilt();
    }

    // Run on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBrutalAnimations);
    } else {
        initBrutalAnimations();
    }

    // Dark mode toggle
    function toggleDarkMode() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('dark-mode', isDark);
        document.querySelectorAll('[data-theme-icon]').forEach(el => {
            el.textContent = isDark ? 'light_mode' : 'dark_mode';
        });
    }
</script>
