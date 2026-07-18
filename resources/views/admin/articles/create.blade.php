@extends('admin.layouts.admin')

@section('title', 'Tulis Artikel - Panel Admin')
@section('page_title', 'Tulis Artikel')
@section('breadcrumb')
    <a href="{{ route('admin.articles.index') }}" class="hover:text-primary transition-colors">Artikel</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Tulis Baru</span>
@endsection

@section('content')
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf

        <div class="admin-card p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-8 h-8 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary text-sm">edit_note</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Informasi Artikel</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Lengkapi detail artikel di bawah ini</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Judul Artikel <span class="text-error">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="admin-input" placeholder="Masukkan judul artikel...">
                    @error('title') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Penulis</label>
                    <div class="admin-input bg-surface-container-highest flex items-center gap-2 cursor-default">
                        <span class="material-symbols-outlined text-sm text-on-surface-variant">person</span>
                        <span class="font-body-md text-sm">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                <div x-data="{ open: false, selected: '{{ old('category') }}', options: ['Prestasi', 'Kegiatan', 'Akademik', 'Kesiswaan', 'Alumni', 'Informasi', 'Pengumuman', 'Olahraga', 'Seni Budaya', 'Teknologi', 'Ekstrakurikuler', 'Liputan'], select(val) { this.selected = val; this.open = false; } }" class="relative">
                    <input type="hidden" name="category" x-model="selected">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kategori</label>
                    <button type="button" @click="open = !open" class="admin-input flex items-center justify-between w-full cursor-pointer">
                        <span x-text="selected || 'Pilih kategori...'" :class="selected ? 'text-on-surface' : 'text-on-surface-variant'" class="font-body-md text-sm"></span>
                        <span class="material-symbols-outlined text-sm transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute z-50 mt-1 w-full bg-white dark:bg-surface-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] max-h-48 overflow-y-auto">
                        <template x-for="opt in options" :key="opt">
                            <button type="button" @click="select(opt)" class="w-full text-left px-3 py-2.5 font-body-md text-sm hover:bg-primary-fixed transition-colors border-b-2 border-on-background/10 last:border-b-0" :class="selected === opt ? 'bg-primary-fixed font-bold text-primary' : 'text-on-surface'">
                                <div class="flex items-center gap-2">
                                    <span x-show="selected === opt" class="material-symbols-outlined text-sm text-primary">check</span>
                                    <span x-text="opt"></span>
                                </div>
                            </button>
                        </template>
                    </div>
                    @error('category') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2" x-data="{ source: 'upload', previewUrl: '{{ old('image_url') }}', previewFile: null, imageError: false }">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Gambar Sampul</label>

                    <div class="flex gap-2 mb-3">
                        <button type="button" @click="source='upload'"
                            :class="source==='upload' ? 'admin-btn-primary admin-btn-sm' : 'admin-btn-secondary admin-btn-sm'">
                            <span class="material-symbols-outlined text-sm">upload</span> Upload
                        </button>
                        <button type="button" @click="source='url'"
                            :class="source==='url' ? 'admin-btn-primary admin-btn-sm' : 'admin-btn-secondary admin-btn-sm'">
                            <span class="material-symbols-outlined text-sm">link</span> URL
                        </button>
                    </div>

                    <div x-show="source==='upload'" x-cloak
                         class="p-3 border-2 border-dashed border-on-background/20 rounded">
                        <p class="font-label-mono text-[10px] text-on-surface-variant mb-1">Upload dari perangkat</p>
                        <input type="file" name="image" accept="image/*"
                            @change="previewFile = $event.target.files[0] || null; imageError = false"
                            class="admin-input custom-file-input py-2">
                        <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Maks. 5MB. Format: JPG, PNG, WebP</p>
                    </div>

                    <div x-show="source==='url'" x-cloak
                         class="p-3 border-2 border-dashed border-on-background/20 rounded">
                        <p class="font-label-mono text-[10px] text-on-surface-variant mb-1">URL gambar eksternal</p>
                        <input type="url" name="image_url" x-model="previewUrl"
                            x-bind:disabled="source !== 'url'"
                            @input="imageError = false"
                            class="admin-input" placeholder="https://contoh.com/gambar.jpg">
                    </div>

                    @error('image') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    @error('image_url') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

                    <div class="mt-3 border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,0.1)] overflow-hidden">
                        <template x-if="(previewFile || previewUrl) && !imageError">
                            <img :src="previewFile ? URL.createObjectURL(previewFile) : previewUrl"
                                @@error="imageError = true"
                                class="w-full h-48 object-cover">
                        </template>
                        <div x-show="(!previewFile && !previewUrl) || imageError"
                            class="w-full h-48 flex items-center justify-center bg-surface-container-highest">
                            <div class="text-center">
                                <span class="material-symbols-outlined text-5xl text-on-surface-variant">image</span>
                                <p class="font-label-mono text-xs text-on-surface-variant mt-2">Tidak ada gambar</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2" x-data="editorModal()">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konten <span class="text-error">*</span></label>

                    <input type="hidden" name="content" x-model="contentJson">

                    <button type="button" @click="openEditor()"
                        class="admin-input flex items-center gap-2 cursor-pointer hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-sm text-primary">edit_note</span>
                        <span class="font-body-md text-sm" x-text="contentJson && contentJson !== '{\"blocks\":[]}' ? 'Konten sudah diisi (' + blockCount + ' blok)' : 'Ketuk untuk membuka konten'"></span>
                        <span class="material-symbols-outlined text-sm ml-auto text-on-surface-variant">open_in_new</span>
                    </button>

                    @error('content') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

                    {{-- MODAL EDITOR --}}
                    <div x-show="editorOpen" x-cloak x-transition.opacity
                        class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-on-background/60"
                        @click.self="closeEditor()">
                        <div class="w-full max-w-4xl max-h-[calc(100vh-3rem)] bg-surface border-3 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] flex flex-col">
                            {{-- Modal header --}}
                            <div class="flex items-center justify-between px-5 py-3 border-b-3 border-on-background bg-surface-container">
                                <div class="flex items-center gap-2">
                                    <span class="w-7 h-7 bg-primary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="material-symbols-outlined text-on-primary text-sm">edit_note</span>
                                    </span>
                                    <span class="font-headline-lg text-base uppercase tracking-tight">Editor Konten</span>
                                </div>
                                <button type="button" @click="closeEditor()" class="p-1 border-2 border-on-background hover:bg-surface-container-highest">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>
                            {{-- Editor body --}}
                            <div class="flex-1 overflow-y-auto p-5 bg-surface">
                                <div id="editorjs-content" class="min-h-[400px]"></div>
                            </div>
                            {{-- Modal footer --}}
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

                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Terbitkan langsung</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Artikel
            </button>
            <a href="{{ route('admin.articles.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    function editorModal() {
        return {
            editorOpen: false,
            contentJson: {!! json_encode(old('content', '{"blocks":[]}')) !!},
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
                        button: {
                            class: CustomButton,
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
                    placeholder: 'Mulai tulis konten artikel...',
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
