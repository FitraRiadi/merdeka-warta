@if($polls->isNotEmpty())
<section class="mb-12 md:mb-16" data-intro-poll>
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-headline-lg text-xl md:text-3xl uppercase flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-2xl">how_to_vote</span>
            POLLING
        </h2>
    </div>

    <div class="flex justify-center">
        <a href="{{ route('public.polls.index') }}"
           class="group bg-white dark:bg-surface-container rounded-xl bento-shadow bento-card bento-card-static flex flex-col relative border-2 border-black dark:border-gray-700 transition-all duration-300 hover:-translate-y-1 hover:shadow-[4px_4px_0_0_#000] dark:hover:shadow-[4px_4px_0_0_#6366f1] max-w-sm w-full">
            <div class="flex-1 flex flex-col items-center justify-center p-6 text-center">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant group-hover:scale-110 transition-transform mb-3">how_to_vote</span>
                <h3 class="font-headline-lg text-base md:text-lg uppercase leading-tight mb-1">LIHAT POLLING</h3>
                <p class="font-label-mono text-[10px] text-on-surface-variant">Klik untuk melihat polling terbaru</p>
                <span class="mt-4 font-label-mono text-[10px] uppercase text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                    KUNJUNGI <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </span>
            </div>
        </a>
    </div>
</section>
@endif
