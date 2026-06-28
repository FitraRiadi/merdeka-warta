@extends('admin.layouts.admin')

@section('title', 'Buat Pengumuman - Panel Admin')
@section('page_title', 'Buat Pengumuman')
@section('breadcrumb')
    <a href="{{ route('admin.announcements.index') }}" class="hover:text-primary transition-colors">Pengumuman</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Buat Baru</span>
@endsection

@section('content')
    <form action="{{ route('admin.announcements.store') }}" method="POST" class="max-w-3xl">
        @csrf

        <div class="admin-card p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-8 h-8 bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-secondary text-sm">campaign</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Informasi Pengumuman</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Lengkapi detail pengumuman</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Judul Pengumuman <span class="text-error">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="admin-input" placeholder="Masukkan judul pengumuman...">
                    @error('title') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ open: false, selected: '{{ old('type', 'info') }}', options: { info: { label: 'Info', icon: 'campaign', color: 'text-primary' }, warning: { label: 'Peringatan', icon: 'warning_amber', color: 'text-tertiary' }, important: { label: 'Penting', icon: 'error', color: 'text-error' } }, select(val) { this.selected = val; this.open = false; } }" class="relative">
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
                        class="admin-input font-mono text-sm" placeholder="Tulis konten pengumuman di sini... (JSON Editor.js atau teks biasa)">{{ old('content') }}</textarea>
                    @error('content') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">
                        Gunakan format JSON Editor.js atau teks biasa.
                    </p>
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kedaluwarsa Pada</label>
                    <input type="date" name="expired_at" value="{{ old('expired_at') }}"
                        class="admin-input" min="{{ date('Y-m-d') }}">
                    @error('expired_at') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Biarkan kosong jika tidak ada batas waktu.</p>
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-pink-50 dark:hover:bg-pink-900/20 transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
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
                Simpan Pengumuman
            </button>
            <a href="{{ route('admin.announcements.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>
@endsection
