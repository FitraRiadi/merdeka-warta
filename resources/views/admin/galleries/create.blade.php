@extends('admin.layouts.admin')

@section('title', 'Tambah Galeri - Panel Admin')
@section('page_title', 'Tambah Galeri')
@section('breadcrumb')
    <a href="{{ route('admin.galleries.index') }}" class="hover:text-primary transition-colors">Galeri</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Tambah Baru</span>
@endsection

@section('content')
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
        @csrf

        <div class="admin-card p-6">
            <div class="space-y-6">
                <div x-data="{ source: 'upload', previewUrl: '{{ old('image_url') }}', previewFile: null, imageError: false }">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Gambar <span class="text-error">*</span></label>

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
                            @change="const f = $event.target.files[0]; if (f && f.size > 5*1024*1024) { alert('Gambar maksimal 5MB.'); $event.target.value = ''; previewFile = null; imageError = false; return; } previewFile = f || null; imageError = false"
                            class="admin-input custom-file-input py-2">
                        <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Maks. 5MB. Format: JPG, PNG, WebP</p>
                    </div>

                    <div x-show="source==='url'" x-cloak
                         class="p-3 border-2 border-dashed border-on-background/20 rounded">
                        <p class="font-label-mono text-[10px] text-on-surface-variant mb-1">URL gambar eksternal</p>
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

                {{-- Caption --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Keterangan</label>
                    <input type="text" name="caption" value="{{ old('caption') }}"
                        class="admin-input" placeholder="Keterangan singkat..." maxlength="200">
                    @error('caption') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan
            </button>
            <a href="{{ route('admin.galleries.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>
@endsection
