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

                <div x-data='{
                    open: false,
                    selectedId: "{{ old('category_id') }}",
                    options: @json($categories->map(fn($c) => ["id" => (string)$c->id, "name" => $c->name])->values()),
                    select(opt) { this.selectedId = opt.id; this.open = false; },
                    get selectedName() { let o = this.options.find(x => x.id === this.selectedId); return o ? o.name : "Pilih kategori..."; }
                }' class="relative">
                    <input type="hidden" name="category_id" x-model="selectedId">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kategori <span class="text-error">*</span></label>
                    <button type="button" @click="open = !open" class="admin-input flex items-center justify-between w-full cursor-pointer">
                        <span x-text="selectedName" :class="selectedId ? 'text-on-surface' : 'text-on-surface-variant'" class="font-body-md text-sm"></span>
                        <span class="material-symbols-outlined text-sm transition-transform" :class="open ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-cloak class="absolute z-50 mt-1 w-full bg-white dark:bg-surface-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] max-h-48 overflow-y-auto">
                        <template x-for="opt in options" :key="opt.id">
                            <button type="button" @click="select(opt)" class="w-full text-left px-3 py-2.5 font-body-md text-sm hover:bg-primary-fixed transition-colors border-b-2 border-on-background/10 last:border-b-0" :class="selectedId === opt.id ? 'bg-primary-fixed font-bold text-primary' : 'text-on-surface'">
                                <div class="flex items-center gap-2">
                                    <span x-show="selectedId === opt.id" class="material-symbols-outlined text-sm text-primary">check</span>
                                    <span x-text="opt.name"></span>
                                </div>
                            </button>
                        </template>
                    </div>
                    @error('category_id') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2" x-data="{ previewFile: null, imageError: false }">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Gambar Sampul</label>

                    <div class="p-3 border-2 border-dashed border-on-background/20 rounded">
                        <p class="font-label-mono text-[10px] text-on-surface-variant mb-1">Upload dari perangkat</p>
                        <input type="file" name="image" accept="image/*"
                            @change="const f = $event.target.files[0]; if (f && f.size > 5*1024*1024) { alert('Gambar maksimal 5MB.'); $event.target.value = ''; previewFile = null; imageError = false; return; } previewFile = f || null; imageError = false"
                            class="admin-input custom-file-input py-2">
                        <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Maks. 5MB. Format: JPG, PNG, WebP</p>
                    </div>

                    @error('image') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

                    <div class="mt-3 border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,0.1)] overflow-hidden">
                        <template x-if="previewFile && !imageError">
                            <img :src="URL.createObjectURL(previewFile)"
                                @@error="imageError = true"
                                class="w-full h-48 object-cover">
                        </template>
                        <div x-show="!previewFile || imageError"
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
                             {{-- Toolbar --}}
                            <div x-show="editorInstance" class="editor-toolbar" x-cloak>
                                {{-- Block picker (outside scroll) --}}
                                <div class="editor-toolbar__group" style="position:relative;flex-shrink:0">
                                    <button type="button" @click="blockPickerOpen = !blockPickerOpen" class="editor-toolbar__btn" title="Tambah blok"><span class="material-symbols-outlined" style="font-size:14px">add</span></button>
                                    <div x-show="blockPickerOpen" @click.outside="blockPickerOpen = false" x-cloak class="editor-block-picker">
                                        <button type="button" @click="insertBlock('paragraph'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">text_fields</span> Paragraf</button>
                                        <button type="button" @click="insertBlock('header'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">title</span> Heading</button>
                                        <button type="button" @click="insertBlock('list', 'ordered'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">format_list_numbered</span> List Number</button>
                                        <button type="button" @click="insertBlock('list', 'unordered'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">format_list_bulleted</span> List Symbol</button>
                                        <button type="button" @click="insertBlock('list', 'checklist'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">checklist</span> List Check</button>
                                        <button type="button" @click="insertBlock('quote'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">format_quote</span> Kutipan</button>
                                        <button type="button" @click="insertBlock('image'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">image</span> Gambar</button>
                                        <button type="button" @click="insertBlock('delimiter'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">horizontal_rule</span> Pembatas</button>
                                        <button type="button" @click="insertBlock('button'); blockPickerOpen = false"><span class="material-symbols-outlined" style="font-size:14px">smart_button</span> Tombol</button>
                                    </div>
                                </div>
                                {{-- Scrollable toolbar content --}}
                                <div class="editor-toolbar__scroll">
                                    <div class="editor-toolbar__group">
                                        <span class="editor-toolbar__line-badge">
                                            Line <span x-text="currentBlock + 1">1</span>
                                        </span>
                                    </div>
                                    <div class="editor-toolbar__group">
                                        <button type="button" @click="undo()" :disabled="!canUndo" class="editor-toolbar__btn" title="Undo"><span class="material-symbols-outlined" style="font-size:14px">undo</span></button>
                                        <button type="button" @click="redo()" :disabled="!canRedo" class="editor-toolbar__btn" title="Redo"><span class="material-symbols-outlined" style="font-size:14px">redo</span></button>
                                    </div>
                                    <div class="editor-toolbar__group">
                                        <button type="button" @mousedown.prevent="format('bold')" :class="{ active: hasBold }" class="editor-toolbar__btn" title="Tebal"><b>B</b></button>
                                        <button type="button" @mousedown.prevent="format('italic')" :class="{ active: hasItalic }" class="editor-toolbar__btn" title="Miring"><i>I</i></button>
                                        <button type="button" @mousedown.prevent="formatLink()" :class="{ active: hasLink }" class="editor-toolbar__btn" title="Tautan"><span class="material-symbols-outlined" style="font-size:14px">link</span></button>
                                    </div>
                                    <div class="editor-toolbar__group">
                                        <button type="button" @click="moveUp()" class="editor-toolbar__btn" title="Pindah ke atas"><span class="material-symbols-outlined" style="font-size:14px">keyboard_arrow_up</span></button>
                                        <button type="button" @click="moveDown()" class="editor-toolbar__btn" title="Pindah ke bawah"><span class="material-symbols-outlined" style="font-size:14px">keyboard_arrow_down</span></button>
                                        <button type="button" @click="deleteBlock()" class="editor-toolbar__btn" title="Hapus blok" style="color:var(--error)"><span class="material-symbols-outlined" style="font-size:14px">delete</span></button>
                                    </div>
                                </div>
                            </div>
                            {{-- Editor body --}}
                            <div class="flex-1 overflow-y-auto p-5 bg-surface">
                                <div id="editorjs-content" class="min-h-[400px] h-full"></div>
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

                @if(Auth::user()->isSuperAdmin())
                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Terbitkan langsung</span>
                    </label>
                </div>
                @endif
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
            previousBlockIds: new Set(),
            isAutoInserting: false,
            currentBlock: 0,
            currentBlockType: 'paragraph',
            headerLevel: 2,
            listStyle: 'unordered',
            hasBold: false,
            hasItalic: false,
            hasLink: false,
            blockPickerOpen: false,


            history: [],
            historyIndex: -1,
            canUndo: false,
            canRedo: false,
            _historyTimer: null,
            _isRestoring: false,
            get blockCount() {
                try {
                    const data = JSON.parse(this.contentJson);
                    return data.blocks ? data.blocks.length : 0;
                } catch { return 0; }
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
                    onChange: async () => {
                        this.isDirty = true;
                        if (this.isAutoInserting) return;
                        try {
                            const api = this.editorInstance;
                            if (!api) return;
                            const blocks = api.blocks;
                            const count = blocks.getBlocksCount();
                            const currentIds = new Set();
                            const imageIndices = [];
                            for (let i = 0; i < count; i++) {
                                const block = blocks.getBlockByIndex(i);
                                currentIds.add(block.id);
                                if (!this.previousBlockIds.has(block.id) && (block.type === 'image' || block.name === 'image')) {
                                    imageIndices.push(i);
                                }
                            }
                            if (imageIndices.length > 0) {
                                this.isAutoInserting = true;
                                await new Promise(r => setTimeout(r, 100));
                                imageIndices.sort((a, b) => b - a);
                                for (const imgIdx of imageIndices) {
                                    blocks.insert('paragraph', { text: '' }, undefined, imgIdx + 1, true);
                                }
                                this.syncBlockIds();
                                this.isAutoInserting = false;
                            } else {
                                this.previousBlockIds = currentIds;
                            }
                            // Save undo snapshot (debounced)
                            if (!this._isRestoring) {
                                clearTimeout(this._historyTimer);
                                this._historyTimer = setTimeout(() => {
                                    if (!this.editorInstance) return;
                                    this.editorInstance.save().then(data => {
                                        const str = JSON.stringify(data);
                                        if (this.history[this.historyIndex] !== str) {
                                            this.history = this.history.slice(0, this.historyIndex + 1);
                                            this.history.push(str);
                                            this.historyIndex = this.history.length - 1;
                                            this.canUndo = this.historyIndex > 0;
                                            this.canRedo = false;
                                        }
                                    });
                                }, 800);
                            }
                        } catch (e) {
                            console.error('Auto-paragraph error:', e);
                            this.isAutoInserting = false;
                        }
                    },
                    onReady: () => {
                        this.syncBlockIds();
                        this.editorInstance?.focus();
                        // Save initial undo snapshot
                        if (this.editorInstance) {
                            this.editorInstance.save().then(data => {
                                this.history = [JSON.stringify(data)];
                                this.historyIndex = 0;
                                this.canUndo = false;
                                this.canRedo = false;
                            });
                        }
                        // Track current block & format state
                        const holder = document.getElementById('editorjs-content');
                        if (holder) {
                            holder.addEventListener('click', () => {
                                this._updateBlockInfo();
                                this._updateFormatState();
                            });
                            holder.addEventListener('keyup', () => {
                                this._updateBlockInfo();
                                this._updateFormatState();
                            });
                            holder.addEventListener('keydown', (e) => {
                                if (e.key === 'Enter') {
                                    const captionEl = e.target.closest('.image-tool__caption');
                                    if (captionEl) {
                                        e.preventDefault();
                                        e.stopImmediatePropagation();
                                        const blockEl = captionEl.closest('.ce-block');
                                        if (blockEl) {
                                            const blockId = blockEl.getAttribute('data-block-id');
                                            const editor = this.editorInstance;
                                            if (editor) {
                                                const blocks = editor.blocks;
                                                const count = blocks.getBlocksCount();
                                                for (let i = 0; i < count; i++) {
                                                    if (blocks.getBlockByIndex(i).id === blockId) {
                                                        blocks.insert('paragraph', { text: '' }, undefined, i + 1, true);
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        return;
                                    }
                                    if (e.shiftKey) return;
                                    if (e.target.closest('.cdx-list')) return;
                                    const sel = window.getSelection();
                                    if (!sel || !sel.rangeCount) return;
                                    const range = sel.getRangeAt(0);
                                    const node = range.startContainer;
                                    let emptyLine = false;
                                    if (node.nodeType === 3) {
                                        const b = node.textContent.substring(0, range.startOffset).trim();
                                        const a = node.textContent.substring(range.endOffset).trim();
                                        emptyLine = (b === '' && a === '');
                                    } else {
                                        emptyLine = true;
                                    }
                                    if (emptyLine) return;
                                    e.preventDefault();
                                    e.stopImmediatePropagation();
                                    document.execCommand('insertLineBreak', false, null);
                                }
                            }, true);
                        }
                    },
                    tools: {
                        header: {
                            class: Header,
                            config: { defaultLevel: 2, levels: [1,2,3,4,5,6], placeholder: 'Tulis judul bagian...' }
                        },
                        list: {
                            class: EditorjsList,
                            inlineToolbar: true,
                            config: { placeholder: 'Tulis daftar...' }
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
            _onSelectionChange: null,
            async openEditor() {
                this.isDirty = false;
                this.editorOpen = true;
                await this.$nextTick();
                // Listen for selection changes to update format state
                this._onSelectionChange = () => this._updateFormatState();
                document.addEventListener('selectionchange', this._onSelectionChange);
                this.initEditor();
            },
            destroyEditor() {
                if (this._onSelectionChange) {
                    document.removeEventListener('selectionchange', this._onSelectionChange);
                    this._onSelectionChange = null;
                }
                if (this.editorInstance) {
                    this.editorInstance.destroy();
                    this.editorInstance = null;
                    const holder = document.getElementById('editorjs-content');
                    if (holder) holder.innerHTML = '';
                }
            },
            // ── Toolbar methods ──
            async addBlock() {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                this.editorInstance.blocks.insert('paragraph', { text: '' }, undefined, idx + 1, true);
            },
            async undo() {
                if (this.historyIndex <= 0) return;
                this.historyIndex--;
                this._isRestoring = true;
                await this.editorInstance.render(JSON.parse(this.history[this.historyIndex]));
                this._isRestoring = false;
                this.canUndo = this.historyIndex > 0;
                this.canRedo = true;
            },
            async redo() {
                if (this.historyIndex >= this.history.length - 1) return;
                this.historyIndex++;
                this._isRestoring = true;
                await this.editorInstance.render(JSON.parse(this.history[this.historyIndex]));
                this._isRestoring = false;
                this.canUndo = this.historyIndex > 0;
                this.canRedo = this.historyIndex < this.history.length - 1;
            },
            format(type) {
                const sel = window.getSelection();
                if (!sel || !sel.rangeCount) return;
                const editor = document.getElementById('editorjs-content');
                if (!editor || !editor.contains(sel.anchorNode)) return;
                if (type === 'bold') document.execCommand('bold');
                else if (type === 'italic') document.execCommand('italic');
                this._updateFormatState();
            },
            formatLink() {
                const sel = window.getSelection();
                if (!sel || !sel.rangeCount) return;
                const editor = document.getElementById('editorjs-content');
                if (!editor || !editor.contains(sel.anchorNode)) return;
                if (this.hasLink) {
                    document.execCommand('unlink');
                } else {
                    const url = prompt('Masukkan URL:');
                    if (url) document.execCommand('createLink', false, url);
                }
                this._updateFormatState();
            },
            async moveUp() {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                if (idx <= 0) return;
                this.editorInstance.blocks.move(idx, idx - 1);
            },
            async moveDown() {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                const total = this.editorInstance.blocks.getBlocksCount();
                if (idx >= total - 1) return;
                this.editorInstance.blocks.move(idx, idx + 1);
            },
            async duplicateBlock() {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                const block = this.editorInstance.blocks.getBlockByIndex(idx);
                if (!block) return;
                this.editorInstance.blocks.insert(block.name, JSON.parse(JSON.stringify(block.data)), undefined, idx + 1, true);
            },
            async deleteBlock() {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                if (idx < 0) return;
                this.editorInstance.blocks.delete(idx);
            },
            insertBlock(type, listStyle) {
                if (!this.editorInstance) return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                if (type === 'image') {
                    this.editorInstance.blocks.insert('image', { file: {} }, undefined, idx + 1, true);
                    return;
                }
                let data;
                if (type === 'list') {
                    const style = listStyle || 'unordered';
                    data = style === 'checklist'
                        ? { style, items: [{ content: '', meta: { checked: false }, items: [] }] }
                        : { style, items: [''] };
                } else {
                    const defaultData = {
                        paragraph: { text: '' },
                        header: { text: '', level: 2 },
                        quote: { text: '', caption: '', alignment: 'left' },
                        delimiter: {},
                        button: { text: '', url: '', style: 'primary', linkType: 'link' }
                    };
                    data = defaultData[type] || {};
                }
                this.editorInstance.blocks.insert(type, data, undefined, idx + 1, true);
            },
            _updateBlockInfo() {
                try {
                    const api = this.editorInstance;
                    if (!api) return;
                    const index = api.blocks.getCurrentBlockIndex();
                    if (index === undefined || index === null) return;
                    this.currentBlock = index;
                    const block = api.blocks.getBlockByIndex(index);
                    if (block) {
                        this.currentBlockType = block.name;
                        if (block.name === 'header') {
                            this.headerLevel = block.data.level || 2;
                        }
                        if (block.name === 'list') {
                            this.listStyle = block.data.style || 'unordered';
                        }
                    }
                } catch (e) {}
            },
            async setHeaderLevel(level) {
                if (!this.editorInstance || this.currentBlockType !== 'header') return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                const block = this.editorInstance.blocks.getBlockByIndex(idx);
                if (!block) return;
                await this.editorInstance.blocks.update(idx, { text: block.data.text, level });
                this.headerLevel = level;
            },
            async setListStyle(style) {
                if (!this.editorInstance || this.currentBlockType !== 'list') return;
                const idx = this.editorInstance.blocks.getCurrentBlockIndex();
                const block = this.editorInstance.blocks.getBlockByIndex(idx);
                if (!block) return;
                await this.editorInstance.blocks.update(idx, { style, items: block.data.items });
                this.listStyle = style;
            },

            _updateFormatState() {
                const sel = window.getSelection();
                if (!sel || !sel.rangeCount) {
                    this.hasBold = false; this.hasItalic = false; this.hasLink = false;
                    return;
                }
                const editor = document.getElementById('editorjs-content');
                if (!editor || !editor.contains(sel.anchorNode)) {
                    this.hasBold = false; this.hasItalic = false; this.hasLink = false;
                    return;
                }
                this.hasBold = document.queryCommandState('bold');
                this.hasItalic = document.queryCommandState('italic');
                let linkFound = false;
                let node = sel.anchorNode;
                if (node) {
                    if (node.nodeType === 3) node = node.parentNode;
                    while (node && node !== editor) {
                        if (node.tagName === 'A') { linkFound = true; break; }
                        node = node.parentNode;
                    }
                }
                this.hasLink = linkFound;
            },
            syncBlockIds() {
                try {
                    const blocks = this.editorInstance?.blocks;
                    if (!blocks) return;
                    const count = blocks.getBlocksCount();
                    const ids = new Set();
                    for (let i = 0; i < count; i++) {
                        ids.add(blocks.getBlockByIndex(i).id);
                    }
                    this.previousBlockIds = ids;
                } catch (e) {}
            },
        };
    }
</script>
@endpush
