@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center gap-4">

        {{-- Mobile --}}
        <div class="flex sm:hidden gap-2 w-full">
            @if ($paginator->onFirstPage())
                <span class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-400 bg-slate-50 rounded-xl border border-slate-200 cursor-not-allowed">
                    <i class="fas fa-chevron-left text-xs"></i> Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white rounded-xl border border-slate-200 hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all shadow-sm">
                    <i class="fas fa-chevron-left text-xs"></i> Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-700 bg-white rounded-xl border border-slate-200 hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all shadow-sm">
                    Selanjutnya <i class="fas fa-chevron-right text-xs"></i>
                </a>
            @else
                <span class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold text-slate-400 bg-slate-50 rounded-xl border border-slate-200 cursor-not-allowed">
                    Selanjutnya <i class="fas fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            <div>
                <p class="text-sm text-slate-500 font-medium">
                    Menampilkan
                    <span class="font-semibold text-slate-700">{{ $paginator->firstItem() }}</span>
                    -
                    <span class="font-semibold text-slate-700">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-slate-700">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            <div class="flex items-center gap-1.5">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-300 bg-slate-50 border border-slate-200 cursor-not-allowed">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 bg-white border border-slate-200 hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all shadow-sm">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>
                @endif

                {{-- Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-400 text-sm font-semibold bg-transparent">
                            {{ $element }}
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-sm font-bold text-white bg-gradient-to-br from-blue-600 to-blue-700 shadow-lg shadow-blue-200">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-sm font-semibold text-slate-600 bg-white border border-slate-200 hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all shadow-sm" aria-label="Ke halaman {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 bg-white border border-slate-200 hover:border-blue-200 hover:text-blue-700 hover:bg-blue-50 transition-all shadow-sm">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                @else
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-300 bg-slate-50 border border-slate-200 cursor-not-allowed">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
