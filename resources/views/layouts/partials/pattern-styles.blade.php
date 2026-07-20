<style>
    .bg-paper {
        background-color: #f5f0e8;
        background-image:
            repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(139,119,80,0.04) 40px, rgba(139,119,80,0.04) 41px),
            repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(139,119,80,0.04) 40px, rgba(139,119,80,0.04) 41px);
        background-size: 40px 40px, 40px 40px;
    }
    .dark .bg-paper {
        background-color: #1a1814;
        background-image:
            repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(255,255,200,0.03) 40px, rgba(255,255,200,0.03) 41px),
            repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(255,255,200,0.03) 40px, rgba(255,255,200,0.03) 41px);
    }

    .bg-dots {
        background-color: var(--background);
        background-image: radial-gradient(circle, var(--outline-variant) 0.8px, transparent 0.8px);
        background-size: 24px 24px;
    }
    .dark .bg-dots {
        background-image: radial-gradient(circle, rgba(255,255,255,0.04) 0.8px, transparent 0.8px);
    }

    .bg-dots-lg {
        background-color: var(--background);
        background-image: radial-gradient(circle, var(--outline-variant) 1.5px, transparent 1.5px);
        background-size: 48px 48px;
    }
    .dark .bg-dots-lg {
        background-image: radial-gradient(circle, rgba(255,255,255,0.03) 1.5px, transparent 1.5px);
    }

    .bg-stripes {
        background-color: var(--background);
        background-image: repeating-linear-gradient(45deg, transparent, transparent 14px, var(--outline-variant) 14px, var(--outline-variant) 15px);
    }
    .dark .bg-stripes {
        background-image: repeating-linear-gradient(45deg, transparent, transparent 14px, rgba(255,255,255,0.03) 14px, rgba(255,255,255,0.03) 15px);
    }

    .bg-stripes-v {
        background-color: var(--background);
        background-image: repeating-linear-gradient(0deg, transparent, transparent 16px, var(--outline-variant) 16px, var(--outline-variant) 17px);
    }
    .dark .bg-stripes-v {
        background-image: repeating-linear-gradient(0deg, transparent, transparent 16px, rgba(255,255,255,0.03) 16px, rgba(255,255,255,0.03) 17px);
    }

    .bg-crosshatch {
        background-color: var(--background);
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 12px, var(--outline-variant) 12px, var(--outline-variant) 13px),
            repeating-linear-gradient(-45deg, transparent, transparent 12px, var(--outline-variant) 12px, var(--outline-variant) 13px);
    }
    .dark .bg-crosshatch {
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 12px, rgba(255,255,255,0.03) 12px, rgba(255,255,255,0.03) 13px),
            repeating-linear-gradient(-45deg, transparent, transparent 12px, rgba(255,255,255,0.03) 12px, rgba(255,255,255,0.03) 13px);
    }

    .bg-grid {
        background-color: var(--background);
        background-image:
            linear-gradient(var(--outline-variant) 0.5px, transparent 0.5px),
            linear-gradient(90deg, var(--outline-variant) 0.5px, transparent 0.5px);
        background-size: 30px 30px;
    }
    .dark .bg-grid {
        background-image:
            linear-gradient(rgba(255,255,255,0.03) 0.5px, transparent 0.5px),
            linear-gradient(90deg, rgba(255,255,255,0.03) 0.5px, transparent 0.5px);
    }

    .bg-checkerboard {
        background-color: var(--background);
        background-image:
            linear-gradient(45deg, var(--outline-variant) 25%, transparent 25%),
            linear-gradient(-45deg, var(--outline-variant) 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, var(--outline-variant) 75%),
            linear-gradient(-45deg, transparent 75%, var(--outline-variant) 75%);
        background-size: 16px 16px;
        background-position: 0 0, 0 8px, 8px -8px, -8px 0px;
    }
    .dark .bg-checkerboard {
        background-image:
            linear-gradient(45deg, rgba(255,255,255,0.03) 25%, transparent 25%),
            linear-gradient(-45deg, rgba(255,255,255,0.03) 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, rgba(255,255,255,0.03) 75%),
            linear-gradient(-45deg, transparent 75%, rgba(255,255,255,0.03) 75%);
    }

    .bg-plaid {
        background-color: var(--background);
        background-image:
            repeating-linear-gradient(transparent, transparent 20px, var(--outline-variant) 20px, var(--outline-variant) 21px),
            repeating-linear-gradient(90deg, transparent, transparent 20px, var(--outline-variant) 20px, var(--outline-variant) 21px);
        background-size: 40px 40px, 40px 40px;
    }
    .dark .bg-plaid {
        background-image:
            repeating-linear-gradient(transparent, transparent 20px, rgba(255,255,255,0.02) 20px, rgba(255,255,255,0.02) 21px),
            repeating-linear-gradient(90deg, transparent, transparent 20px, rgba(255,255,255,0.02) 20px, rgba(255,255,255,0.02) 21px);
    }
</style>
