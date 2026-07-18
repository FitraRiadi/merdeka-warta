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

                <div x-data="editorModal()">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konten <span class="text-error">*</span></label>

                    <input type="hidden" name="content" x-model="contentJson">

                    <button type="button" @click="openEditor()"
                        class="admin-input flex items-center gap-2 cursor-pointer hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-sm text-secondary">edit_note</span>
                        <span class="font-body-md text-sm" x-text="contentJson && contentJson !== '{\"blocks\":[]}' ? 'Konten sudah diisi (' + blockCount + ' blok)' : 'Klik untuk buka Editor WYSIWYG'"></span>
                        <span class="material-symbols-outlined text-sm ml-auto text-on-surface-variant">open_in_new</span>
                    </button>

                    @error('content') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

                    {{-- MODAL EDITOR --}}
                    <div x-show="editorOpen" x-cloak x-transition.opacity
                        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-on-background/60"
                        @click.self="closeEditor()">
                        <div class="w-full max-w-4xl max-h-[calc(100vh-3rem)] bg-surface border-3 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                            <div class="flex items-center justify-between px-5 py-3 border-b-3 border-on-background bg-surface-container">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="material-symbols-outlined text-on-secondary text-sm">campaign</span>
                                    </span>
                                    <span class="font-headline-lg text-base uppercase tracking-tight">Editor Konten</span>
                                </div>
                                <button type="button" @click="closeEditor()" class="p-1 border-2 border-on-background hover:bg-surface-container-highest">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                            <div class="flex-1 overflow-y-auto p-5 bg-surface">
                                <div id="editorjs-content" class="min-h-[400px]"></div>
                            </div>
                            <div class="flex items-center justify-end gap-3 px-5 py-3 border-t-3 border-on-background bg-surface-container">
                                <button type="button" @click="closeEditor()" class="admin-btn-secondary admin-btn-sm">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                    Batal
                                </button>
                                <button type="button" @click="saveEditor()" class="admin-btn-primary admin-btn-sm">
                                    <span class="material-symbols-outlined text-sm">save</span>
                                    Simpan Konten
                                </button>
                            </div>
                        </div>
                    </div>
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

@push('scripts')
<script>
    function editorModal() {
        return {
            editorOpen: false,
            contentJson: {!! json_encode(old('content') ?: ($announcement->content ?? '{"blocks":[]}')) !!},
            editorInstance: null,
            isDirty: false,
            get blockCount() {
                try {
                    const data = JSON.parse(this.contentJson);
                    return data.blocks ? data.blocks.length : 0;
                } catch { return 0; }
            },
            async openEditor() {
                this.isDirty = false;
                this.editorOpen = true;
                await this.$nextTick();
                this.initEditor();
            },
            closeEditor() {
                if (this.isDirty) {
                    Swal.fire({
                        title: 'Perubahan belum disimpan',
                        text: 'Ada perubahan yang belum disimpan. Yakin ingin menutup editor?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#006b4f',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, tutup',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            popup: 'brutalist-border shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] rounded-none',
                            confirmButton: 'admin-btn-primary admin-btn-sm',
                            cancelButton: 'admin-btn-secondary admin-btn-sm',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.editorOpen = false;
                            this.destroyEditor();
                        }
                    });
                    return;
                }
                this.editorOpen = false;
                this.destroyEditor();
            },
            saveEditor() {
                if (!this.editorInstance) return;
                this.editorInstance.save().then((output) => {
                    this.contentJson = JSON.stringify(output);
                    this.isDirty = false;
                    this.closeEditor();
                }).catch((err) => {
                    console.error('Editor.js save error:', err);
                });
            },
            async initEditor() {
                if (this.editorInstance) return;
                let initialData;
                try {
                    initialData = JSON.parse(this.contentJson);
                } catch {
                    initialData = { blocks: [] };
                }
                this.editorInstance = new EditorJS({
                    holder: 'editorjs-content',
                    data: initialData,
                    onChange: () => { this.isDirty = true; },
                    onReady: () => { this.editorInstance?.focus(); },
                    tools: {
                        header: {
                            class: Header,
                            config: { defaultLevel: 2, levels: [1,2,3,4,5,6] }
                        },
                        list: {
                            class: EditorjsList,
                            inlineToolbar: true,
                        },
                        checklist: {
                            class: Checklist,
                            inlineToolbar: true,
                        },
                    quote: {
                        class: CustomQuote,
                        inlineToolbar: true,
                        config: { quotePlaceholder: 'Tulis kutipan...', captionPlaceholder: 'Sumber kutipan' }
                    },
                        delimiter: Delimiter,
                        image: {
                            class: ImageTool,
                            config: {
                                endpoints: {
                                    byFile: '{{ route('admin.editor.upload-image') }}',
                                    byUrl: '{{ route('admin.editor.upload-by-url') }}',
                                },
                                field: 'image',
                                captionPlaceholder: 'Tulis keterangan gambar...',
                                buttonText: 'Pilih gambar',
                            }
                        },
                        embed: {
                            class: Embed,
                            config: {
                                services: {
                                    youtube: true,
                                    vimeo: true,
                                }
                            }
                        },
                    },
                    placeholder: 'Mulai tulis konten pengumuman...',
                });
            },
            destroyEditor() {
                if (this.editorInstance) {
                    this.editorInstance.destroy();
                    this.editorInstance = null;
                    const holder = document.getElementById('editorjs-content');
                    if (holder) holder.innerHTML = '';
                }
            },
        };
    }
</script>
@endpush
