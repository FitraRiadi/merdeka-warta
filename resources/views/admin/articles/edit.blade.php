@extends('admin.layouts.admin')

@section('title', 'Edit Artikel - Panel Admin')
@section('page_title', 'Edit Artikel')
@section('breadcrumb')
    <a href="{{ route('admin.articles.index') }}" class="hover:text-primary transition-colors">Artikel</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $article->title }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf @method('PATCH')

        <div class="admin-card p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-8 h-8 bg-gradient-to-br from-primary to-primary-fixed-dim border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary text-sm">edit</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Edit Artikel</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Perbarui detail artikel</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Judul Artikel <span class="text-error">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                        class="admin-input" placeholder="Masukkan judul artikel...">
                    @error('title') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                        class="admin-input" placeholder="judul-artikel">
                    @error('slug') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kategori</label>
                    <input type="text" name="category" list="category-list" value="{{ old('category', $article->category) }}"
                        class="admin-input" placeholder="Pilih atau ketik kategori baru...">
                    <datalist id="category-list">
                        <option value="Prestasi">
                        <option value="Kegiatan">
                        <option value="Akademik">
                        <option value="Kesiswaan">
                        <option value="Alumni">
                        <option value="Informasi">
                        <option value="Pengumuman">
                        <option value="Olahraga">
                        <option value="Seni Budaya">
                        <option value="Teknologi">
                        <option value="Ekstrakurikuler">
                        <option value="Liputan">
                    </datalist>
                    @error('category') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                @if(Auth::user()->isSuperAdmin())
                    <div>
                        <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Penulis</label>
                        <select name="user_id" class="admin-input">
                            <option value="">Pilih Penulis...</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('user_id', $article->user_id) == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }} ({{ $author->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                @endif

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Tanggal Terbit</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                        class="admin-input">
                    @error('published_at') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2" x-data="{ source: 'upload', previewUrl: '{{ old('image_url', $article->image ?? '') }}', previewFile: null, imageError: false }">
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

                    <div x-show="source==='upload'" x-cloak>
                        <input type="file" name="image" accept="image/*"
                            @change="previewFile = $event.target.files[0] || null; imageError = false"
                            class="admin-input custom-file-input py-2">
                        <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Maks. 5MB. Format: JPG, PNG, WebP. Biarkan kosong jika tidak ingin mengubah.</p>
                    </div>

                    <div x-show="source==='url'" x-cloak>
                        <input type="url" name="image_url" x-model="previewUrl"
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

                <div class="md:col-span-2">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konten <span class="text-error">*</span></label>
                    <textarea name="content" rows="15" required
                        class="admin-input font-mono text-sm" placeholder="Tulis konten artikel di sini...">{{ old('content', $article->content) }}</textarea>
                    @error('content') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-colors">
                        <input type="checkbox" name="is_published" value="1"
                            {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Publikasikan</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Perbarui Artikel
            </button>
            <a href="{{ route('admin.articles.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>

    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" data-confirm-delete data-message='Artikel {{ $article->title }} akan dihapus!' class="admin-btn-danger admin-btn-sm">
            <span class="material-symbols-outlined text-sm">delete</span>
            Hapus
        </button>
    </form>
@endsection
