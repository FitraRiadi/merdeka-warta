@extends('layouts.admin')

@section('title', 'Edit Gambar')
@section('subtitle', 'Perbarui gambar galeri')

@section('content')

    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="bg-surface border-[3px] border-on-background brutalist-shadow p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">URL Gambar</label>
                <input type="url" name="image_url" value="{{ old('image_url', $gallery->image_url) }}" class="form-input" placeholder="https://..." required>
                @error('image_url') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Keterangan</label>
                <input type="text" name="caption" value="{{ old('caption', $gallery->caption) }}" class="form-input" placeholder="Momen kegiatan...">
                @error('caption') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" class="form-input" min="0">
                    @error('sort_order') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $gallery->is_active)) class="w-5 h-5 border-[3px] border-on-background">
                        <span class="font-label-mono text-xs uppercase">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t-[3px] border-on-background">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>

@endsection
