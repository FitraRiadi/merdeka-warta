<button id="scrollToTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" class="fixed bottom-6 right-4 md:bottom-8 md:right-8 z-50 w-12 h-12 md:w-14 md:h-14 rounded-xl bg-primary text-on-primary border-2 border-on-background bento-shadow flex items-center justify-center transition-all duration-300 opacity-0 scale-75 pointer-events-none hover:bg-primary/90" style="box-shadow:3px 3px 0 0 #000">
    <span class="material-symbols-outlined text-2xl md:text-3xl">arrow_upward</span>
</button>
<script>
    (function() {
        var btn = document.getElementById('scrollToTopBtn');
        if (!btn) return;
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                btn.classList.remove('opacity-0', 'scale-75', 'pointer-events-none');
                btn.classList.add('opacity-100', 'scale-100');
            } else {
                btn.classList.add('opacity-0', 'scale-75', 'pointer-events-none');
                btn.classList.remove('opacity-100', 'scale-100');
            }
        });
    })();
</script>
