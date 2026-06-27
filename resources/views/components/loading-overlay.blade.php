<div x-data="{
    show: false,
    activeIndex: 0,
    interval: null,
    init() {
        this.$watch('show', val => {
            if (val) {
                this.activeIndex = 0;
                this.interval = setInterval(() => {
                    this.activeIndex = this.activeIndex >= 16 ? 0 : this.activeIndex + 1;
                }, 150);
            } else if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
        });
        document.addEventListener('submit', () => { this.show = true; });
    },
    destroy() {
        if (this.interval) clearInterval(this.interval);
    }
}"
x-show="show"
x-transition.opacity.duration.200
class="fixed inset-0 z-[9999] flex items-center justify-center"
style="background-color: rgba(0,0,0,0.6); backdrop-filter: blur(2px);">
    <div class="bg-surface border-4 border-on-background shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 flex flex-col items-center gap-6 max-w-xs w-full">
        <div class="grid grid-cols-4 gap-2">
            <template x-for="(_, idx) in Array.from({length: 16})" :key="idx">
                <div class="w-5 h-5 border-3 border-on-background"
                    :style="{
                        backgroundColor: idx < activeIndex ? '#7c3aed' : 'transparent',
                        transition: 'background-color 0.15s ease'
                    }">
                </div>
            </template>
        </div>
        <p class="font-headline-lg text-sm uppercase tracking-wider text-on-background">Memuat...</p>
    </div>
</div>
