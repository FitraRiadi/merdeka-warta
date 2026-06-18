@extends('layouts.admin')

@section('title', 'Edit Sorotan')
@section('subtitle', 'Perbarui sorotan artikel')

@section('content')

    <form action="{{ route('admin.spotlights.update', $spotlight) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="bg-surface border-[3px] border-on-background brutalist-shadow p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">Artikel</label>
                <select name="article_id" class="form-input" required>
                    <option value="">Pilih artikel...</option>
                    @foreach($articles as $article)
                        <option value="{{ $article->id }}" @selected(old('article_id', $spotlight->article_id) == $article->id)>{{ $article->title }}</option>
                    @endforeach
                </select>
                @error('article_id') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Label Badge</label>
                    <input type="text" name="badge_label" value="{{ old('badge_label', $spotlight->badge_label) }}" class="form-input" placeholder="HIGHLIGHT">
                    @error('badge_label') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $spotlight->sort_order) }}" class="form-input" min="0">
                    @error('sort_order') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $spotlight->is_active)) class="w-5 h-5 border-[3px] border-on-background">
                    <span class="font-label-mono text-xs uppercase">Aktif</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t-[3px] border-on-background">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.spotlights.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>

@endsection
