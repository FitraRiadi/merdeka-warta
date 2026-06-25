@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center gap-4">

        {{-- Mobile --}}
        <div class="flex sm:hidden gap-2 w-full">
            @if ($paginator->onFirstPage())
                <span class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-slate-500 bg-slate-100 border-2 border-slate-300 cursor-not-allowed font-['JetBrains_Mono']">
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-[#004ac6] bg-white border-2 border-[#004ac6] hover:bg-blue-50 active:bg-blue-100 transition-all shadow-[2px_2px_0px_0px_rgba(0,74,198,0.3)] font-['JetBrains_Mono']">
                    <i class="fas fa-chevron-left"></i> Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-[#004ac6] bg-white border-2 border-[#004ac6] hover:bg-blue-50 active:bg-blue-100 transition-all shadow-[2px_2px_0px_0px_rgba(0,74,198,0.3)] font-['JetBrains_Mono']">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span class="flex-1 flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-slate-500 bg-slate-100 border-2 border-slate-300 cursor-not-allowed font-['JetBrains_Mono']">
                    Selanjutnya <i class="fas fa-chevron-right"></i>
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            <div>
                <p class="text-sm text-slate-500 font-bold font-['JetBrains_Mono']">
                    Menampilkan
                    <span class="font-bold text-slate-700 font-['Plus_Jakarta_Sans']">{{ $paginator->firstItem() }}</span>
                    -
                    <span class="font-bold text-slate-700 font-['Plus_Jakarta_Sans']">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-bold text-slate-700 font-['Plus_Jakarta_Sans']">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            <div class="flex items-center gap-1.5">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center justify-center w-10 h-10 text-slate-400 bg-slate-100 border-2 border-slate-300 cursor-not-allowed font-['JetBrains_Mono']">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-10 h-10 text-[#004ac6] bg-white border-2 border-[#004ac6] hover:bg-blue-50 active:bg-blue-100 transition-all shadow-[2px_2px_0px_0px_rgba(0,74,198,0.25)] font-['JetBrains_Mono']">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                {{-- Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center w-10 h-10 text-slate-400 text-sm font-bold bg-transparent font-['JetBrains_Mono']">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-[#004ac6] border-2 border-[#191c1d] shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] font-['JetBrains_Mono']">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-slate-600 bg-white border-2 border-[#191c1d] hover:border-[#004ac6] hover:text-[#004ac6] hover:bg-blue-50 transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,0.1)] font-['JetBrains_Mono']" aria-label="Ke halaman {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-10 h-10 text-[#004ac6] bg-white border-2 border-[#004ac6] hover:bg-blue-50 active:bg-blue-100 transition-all shadow-[2px_2px_0px_0px_rgba(0,74,198,0.25)] font-['JetBrains_Mono']">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center w-10 h-10 text-slate-400 bg-slate-100 border-2 border-slate-300 cursor-not-allowed font-['JetBrains_Mono']">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
