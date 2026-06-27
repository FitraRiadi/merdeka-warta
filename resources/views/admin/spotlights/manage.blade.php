@extends('admin.layouts.admin')

@section('title', 'Kelola Sorotan - Panel Admin')
@section('page_title', 'Kelola Sorotan')
@section('page_description', 'Atur sorotan artikel (maks. 3) dan sorotan pemberitahuan (maks. 1)')
@section('breadcrumb')
    <a href="{{ route('admin.spotlights.index') }}" class="hover:text-primary transition-colors">Sorotan</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Kelola</span>
@endsection

@section('content')
    <form action="{{ route('admin.spotlights.store') }}" method="POST">
        @csrf

        {{-- Sorotan Artikel --}}
        <div class="admin-card overflow-hidden mb-8">
            <div class="px-6 py-4 bg-primary-fixed-dim/20 border-b-3 border-on-background">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">stars</span>
                    <h3 class="font-label-mono text-sm uppercase font-bold">Sorotan Artikel</h3>
                </div>
            </div>

            <div x-data="{
                selected: {{ $currentArticleSpotlights->pluck('article_id') }},
                articleTitles: {{ $articles->pluck('title')->map(fn($t) => strtolower($t))->values()->toJson() }},
                max: 3,
                search: '',
                limit: 5,
                get filteredCount() {
                    if (!this.search) return this.articleTitles.length;
                    const q = this.search.toLowerCase();
                    return this.articleTitles.filter(t => t.includes(q)).length;
                },
                toggle(id) {
                    if (this.selected.includes(id)) {
                        this.selected = this.selected.filter(s => s !== id);
                    } else if (this.selected.length < this.max) {
                        this.selected = [...this.selected, id];
                    }
                }
            }" class="p-6">
                {{-- Selected Summary Bar --}}
                <div class="mb-5 p-4 transition-all duration-200"
                    :class="selected.length > 0
                        ? 'bg-blue-50 border-2 border-[#004ac6]'
                        : 'bg-gray-50 border-2 border-dashed border-gray-300'">

                    <div class="flex items-center justify-between mb-2">
                        <p class="font-label-mono text-xs uppercase font-bold"
                            :class="selected.length > 0 ? 'text-[#004ac6]' : 'text-gray-500'">
                            <span x-text="selected.length"></span>/<span x-text="max"></span> Artikel Terpilih
                        </p>
                        <span class="font-label-mono text-[10px]"
                            :class="selected.length >= max ? 'text-error font-bold' : 'text-on-surface-variant'"
                            x-text="selected.length >= max ? 'Maksimal 3 artikel' : 'Klik artikel untuk memilih'">
                        </span>
                    </div>

                    <template x-if="selected.length === 0">
                        <p class="font-body-md text-sm text-gray-400">Belum ada artikel yang dipilih sebagai sorotan.</p>
                    </template>

                    <div class="space-y-1.5">
                        <template x-for="(id, index) in selected" :key="id">
                            <div class="flex items-center gap-2 py-1 px-2 bg-white border border-[#004ac6]/30"
                                x-data="{ art: {{ $articles->map(fn($a) => ['id' => $a->id, 'title' => $a->title, 'image' => $a->image])->values()->toJson() }}.find(a => a.id === id) }">
                                <span class="font-label-mono text-[10px] text-[#004ac6] bg-[#004ac6]/10 w-5 h-5 flex items-center justify-center flex-shrink-0 font-bold" x-text="index + 1"></span>
                                <template x-if="art && art.image">
                                    <img :src="art.image" class="w-10 h-7 object-cover border border-[#004ac6]/30 flex-shrink-0">
                                </template>
                                <span class="font-body-md text-sm font-bold text-[#004ac6] truncate flex-1" x-text="art ? art.title : 'Artikel #' + id"></span>
                                <button type="button" @click="selected = selected.filter(s => s !== id)"
                                    class="text-error hover:text-red-700 p-0.5 hover:bg-red-50 transition-colors flex-shrink-0"
                                    title="Hapus dari sorotan">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Search --}}
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Cari artikel..."
                            class="admin-input w-full pl-10">
                        <span class="material-symbols-outlined text-on-surface-variant absolute left-3 top-1/2 -translate-y-1/2 text-sm">search</span>
                        <button type="button" x-show="search" @click="search = ''"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>

                {{-- Article List --}}
                <p class="font-label-mono text-xs uppercase text-on-surface-variant mb-3">
                    Daftar Artikel
                    <span class="text-[10px] text-on-surface-variant font-normal normal-case" x-text="search ? '(' + filteredCount + ' ditemukan)' : ''"></span>
                </p>
                <div class="grid grid-cols-1 gap-2 max-h-[500px] overflow-y-auto border-2 border-on-background p-2 bg-surface-container-low">
                    @foreach($articles as $i => $article)
                        <div x-show="!search ? ({{ $i }} < limit || selected.includes({{ $article->id }})) : '{{ str_replace("'", "\\'", $article->title) }}'.toLowerCase().includes(search.toLowerCase())"
                            x-cloak>
                            <label @click.prevent="toggle({{ $article->id }})"
                                :class="selected.includes({{ $article->id }})
                                    ? 'border-[#004ac6] bg-blue-50 shadow-[2px_2px_0px_0px_rgba(0,74,198,0.3)]'
                                    : 'border-[#191c1d] hover:border-[#004ac6] hover:bg-blue-50/50'"
                                class="flex items-center gap-3 p-3 border-2 bg-white cursor-pointer transition-all select-none">
                                <div class="relative flex-shrink-0">
                                    @if($article->image)
                                        <img src="{{ $article->image }}" alt=""
                                            class="w-16 h-12 object-cover border-2 border-on-background">
                                    @else
                                        <div class="w-16 h-12 bg-primary border-2 border-on-background flex items-center justify-center">
                                            <span class="material-symbols-outlined text-white">image</span>
                                        </div>
                                    @endif
                                    <div x-show="selected.includes({{ $article->id }})" x-cloak
                                        class="absolute -top-2.5 -right-2.5 bg-[#004ac6] rounded-full w-6 h-6 flex items-center justify-center shadow-md">
                                        <span class="material-symbols-outlined text-white text-sm">check</span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-body-md text-sm font-bold truncate"
                                        :class="selected.includes({{ $article->id }}) ? 'text-[#004ac6]' : ''">
                                        {{ $article->title }}
                                    </p>
                                    <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">
                                        {{ $article->category ?? 'Tanpa kategori' }}
                                        &middot;
                                        {{ $article->published_at?->format('d M Y') ?? 'Draft' }}
                                    </p>
                                </div>
                                <input type="checkbox" name="article_ids[]" value="{{ $article->id }}"
                                    :checked="selected.includes({{ $article->id }})"
                                    class="sr-only">
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Show More / Show Less --}}
                <div x-show="!search && {{ count($articles) }} > limit" class="mt-3 text-center">
                    <button type="button" @click="limit = limit < {{ count($articles) }} ? {{ count($articles) }} : 5"
                        class="font-label-mono text-xs text-primary hover:underline focus:outline-none">
                        <span x-text="limit < {{ count($articles) }} ? 'Tampilkan semua ({{ count($articles) }})' : 'Tampilkan lebih sedikit'"></span>
                    </button>
                </div>

                @error('article_ids') <p class="mt-2 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

                <p class="mt-3 font-label-mono text-[10px] text-on-surface-variant">
                    Urutan tampil sesuai urutan pemilihan.
                </p>
            </div>
        </div>

        {{-- Sorotan Pemberitahuan --}}
        <div class="admin-card overflow-hidden mb-8">
            <div class="px-6 py-4 bg-secondary-fixed/20 border-b-3 border-on-background">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">campaign</span>
                    <h3 class="font-label-mono text-sm uppercase font-bold">Sorotan Pemberitahuan</h3>
                    <span class="font-label-mono text-[10px] text-on-surface-variant">(maks. 1)</span>
                </div>
            </div>

            <div x-data="{
                selected: '{{ $currentAnnouncementSpotlight?->announcement_id ?? '' }}',
                announcements: {{ $announcements->map(fn($a) => ['id' => (string)$a->id, 'title' => $a->title])->values()->toJson() }},
                search: '',
                limit: 5,
                get selectedAnn() {
                    return this.selected ? this.announcements.find(a => a.id === this.selected) : null;
                },
                get filteredCount() {
                    if (!this.search) return this.announcements.length;
                    const q = this.search.toLowerCase();
                    return this.announcements.filter(a => a.title.toLowerCase().includes(q)).length;
                }
            }" class="p-6">
                {{-- Selected Summary Bar --}}
                <div class="mb-5 p-4 transition-all duration-200"
                    :class="selected
                        ? 'bg-pink-50 border-2 border-[#a43073]'
                        : 'bg-gray-50 border-2 border-dashed border-gray-300'">

                    <div class="flex items-center justify-between mb-2">
                        <p class="font-label-mono text-xs uppercase font-bold"
                            :class="selected ? 'text-[#a43073]' : 'text-gray-500'">
                            <span x-text="selected ? '1' : '0'"></span>/1 Pemberitahuan Terpilih
                        </p>
                    </div>

                    <template x-if="!selected">
                        <p class="font-body-md text-sm text-gray-400">Belum ada pemberitahuan yang dipilih sebagai sorotan.</p>
                    </template>

                    <template x-if="selected">
                        <div class="flex items-center gap-2 py-1 px-2 bg-white border border-[#a43073]/30">
                            <span class="material-symbols-outlined text-[#a43073]">campaign</span>
                            <span class="font-body-md text-sm font-bold text-[#a43073] truncate flex-1" x-text="selectedAnn?.title ?? ''"></span>
                            <button type="button" @click="selected = ''"
                                class="text-error hover:text-red-700 p-0.5 hover:bg-red-50 transition-colors flex-shrink-0"
                                title="Hapus dari sorotan">
                                <span class="material-symbols-outlined text-sm">close</span>
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Search --}}
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="Cari pemberitahuan..."
                            class="admin-input w-full pl-10">
                        <span class="material-symbols-outlined text-on-surface-variant absolute left-3 top-1/2 -translate-y-1/2 text-sm">search</span>
                        <button type="button" x-show="search" @click="search = ''"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-error transition-colors">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>

                {{-- Announcement List --}}
                <p class="font-label-mono text-xs uppercase text-on-surface-variant mb-3">
                    Daftar Pemberitahuan
                    <span class="text-[10px] text-on-surface-variant font-normal normal-case" x-text="search ? '(' + filteredCount + ' ditemukan)' : ''"></span>
                </p>
                <div class="grid grid-cols-1 gap-2 max-h-[300px] overflow-y-auto border-2 border-on-background p-2 bg-surface-container-low">
                    @foreach($announcements as $i => $announcement)
                        <div x-show="!search ? ({{ $i }} < limit || selected == '{{ $announcement->id }}') : '{{ str_replace("'", "\\'", $announcement->title) }}'.toLowerCase().includes(search.toLowerCase())"
                            x-cloak>
                            <label @click.prevent="selected = (selected == '{{ $announcement->id }}') ? '' : '{{ $announcement->id }}'"
                                :class="selected == '{{ $announcement->id }}'
                                    ? 'border-[#a43073] bg-pink-50 shadow-[2px_2px_0px_0px_rgba(164,48,115,0.3)]'
                                    : 'border-[#191c1d] hover:border-[#a43073] hover:bg-pink-50/50'"
                                class="flex items-center gap-3 p-3 border-2 bg-white cursor-pointer transition-all select-none">
                                <div class="relative flex-shrink-0">
                                    <div class="w-12 h-12 bg-secondary-fixed border-2 border-on-background flex items-center justify-center">
                                        <span class="material-symbols-outlined text-secondary">campaign</span>
                                    </div>
                                    <div x-show="selected == '{{ $announcement->id }}'" x-cloak
                                        class="absolute -top-2.5 -right-2.5 bg-[#a43073] rounded-full w-6 h-6 flex items-center justify-center shadow-md">
                                        <span class="material-symbols-outlined text-white text-sm">check</span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-body-md text-sm font-bold truncate"
                                        :class="selected == '{{ $announcement->id }}' ? 'text-[#a43073]' : ''">
                                        {{ $announcement->title }}
                                    </p>
                                    <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">
                                        {{ $announcement->created_at?->format('d M Y') ?? '-' }}
                                        &middot;
                                        <span class="admin-badge {{ $announcement->type === 'important' ? 'bg-red-100 text-red-700' : ($announcement->type === 'warning' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }} border-transparent text-[9px] px-1.5 py-0">{{ ucfirst($announcement->type) }}</span>
                                    </p>
                                </div>
                                <input type="radio" name="announcement_id" value="{{ $announcement->id }}"
                                    :checked="selected == '{{ $announcement->id }}'"
                                    class="sr-only">
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Show More / Show Less --}}
                <div x-show="!search && {{ count($announcements) }} > limit" class="mt-3 text-center">
                    <button type="button" @click="limit = limit < {{ count($announcements) }} ? {{ count($announcements) }} : 5"
                        class="font-label-mono text-xs text-primary hover:underline focus:outline-none">
                        <span x-text="limit < {{ count($announcements) }} ? 'Tampilkan semua ({{ count($announcements) }})' : 'Tampilkan lebih sedikit'"></span>
                    </button>
                </div>

                @error('announcement_id') <p class="mt-2 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.spotlights.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali
            </a>
        </div>
    </form>
@endsection
