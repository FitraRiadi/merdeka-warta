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
                <span class="w-8 h-8 bg-gradient-to-br from-secondary to-secondary-fixed-dim border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">campaign</span>
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

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Tipe <span class="text-error">*</span></label>
                    <select name="type" class="admin-input" required>
                        <option value="info" {{ old('type', $announcement->type) === 'info' ? 'selected' : '' }}>Info</option>
                        <option value="warning" {{ old('type', $announcement->type) === 'warning' ? 'selected' : '' }}>Peringatan</option>
                        <option value="important" {{ old('type', $announcement->type) === 'important' ? 'selected' : '' }}>Penting</option>
                    </select>
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
                        class="admin-input">
                    @error('expired_at') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer group p-3 border-2 border-on-background hover:bg-gradient-to-r hover:from-pink-50 hover:to-transparent transition-colors">
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
