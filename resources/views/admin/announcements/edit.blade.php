@extends('admin.layouts.admin')

@section('title', 'Edit Pengumuman - Panel Admin')
@section('page_title', 'Edit Pengumuman')
@section('breadcrumb')
    <a href="{{ route('admin.announcements.index') }}" class="hover:text-primary transition-colors">Pengumuman</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $announcement->title }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="max-w-3xl">
        @csrf @method('PATCH')

        <div class="admin-card p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-8 h-8 bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-secondary text-sm">campaign</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Edit Pengumuman</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Perbarui detail pengumuman</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Judul Pengumuman <span class="text-error">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required
                        class="admin-input" placeholder="Masukkan judul pengumuman...">
                    @error('title') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ open: false, selected: '{{ old('type', $announcement->type) }}', options: { info: { label: 'Info', icon: 'campaign', color: 'text-primary' }, warning: { label: 'Peringatan', icon: 'warning_amber', color: 'text-tertiary' }, important: { label: 'Penting', icon: 'error', color: 'text-error' } }, select(val) { this.selected = val; this.open = false; } }" class="relative">
                    <input type="hidden" name="type" x-model="selected">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Tipe <span class="text-error">*</span></label>
                    <button type="button" @click="open = !open" class="admin-input flex items-center justify-between w-full cursor-pointer">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm" :class="options[selected]?.color || 'text-on-surface-variant'" x-text="options[selected]?.icon || 'campaign'"></span>
                            <span x-text="options[selected]?.label || 'Pilih tipe...'" class="font-body-md text-sm text-on-surface"></span>
                        </div>
                        <span class="material-symbols-outlined text-sm transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute z-50 mt-1 w-full bg-white dark:bg-surface-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <template x-for="(val, key) in options" :key="key">
                            <button type="button" @click="select(key)" class="w-full flex items-center gap-2 px-3 py-2.5 font-body-md text-sm hover:bg-primary-fixed transition-colors border-b-2 border-on-background/10 last:border-b-0" :class="selected === key ? 'bg-primary-fixed font-bold' : 'text-on-surface'">
                                <span class="material-symbols-outlined text-sm" :class="val.color" x-text="val.icon"></span>
                                <span x-text="val.label"></span>
                                <span x-show="selected === key" class="material-symbols-outlined text-sm text-primary ml-auto">check</span>
                            </button>
                        </template>
                    </div>
                    @error('type') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konten <span class="text-error">*</span></label>
                    <textarea name="content" rows="12" required
                        class="admin-input font-mono text-sm" placeholder="Tulis konten pengumuman di sini...">{{ old('content', $announcement->content) }}</textarea>
                    @error('content') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kedaluwarsa Pada</label>
                    <input type="date" name="expired_at"
                        value="{{ old('expired_at', $announcement->expired_at?->format('Y-m-d')) }}"
                        class="admin-input" min="{{ date('Y-m-d') }}">
                    @error('expired_at') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-pink-50 dark:hover:bg-pink-900/20 transition-colors">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Aktifkan pengumuman</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Perbarui Pengumuman
            </button>
            <a href="{{ route('admin.announcements.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>

    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" data-confirm-delete data-message='Pengumuman {{ $announcement->title }} akan dihapus!' class="admin-btn-danger admin-btn-sm">
            <span class="material-symbols-outlined text-sm">delete</span>
            Hapus
        </button>
    </form>
@endsection
