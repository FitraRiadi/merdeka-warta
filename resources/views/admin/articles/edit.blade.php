@extends('layouts.admin')

@section('title', 'Edit Artikel')
@section('subtitle', $article->title)

@section('content')

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">

            <div>
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-input" required>
                @error('title') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Slug <span class="text-slate-400 font-normal">(kosongkan untuk generate otomatis)</span></label>
                <input type="text" name="slug" value="{{ old('slug', $article->slug) }}" class="form-input">
                @error('slug') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $article->category) }}" class="form-input">
                </div>
                @if(Auth::user()->isSuperAdmin())
                    <div>
                        <label class="form-label">Penulis</label>
                        <select name="user_id" class="form-select">
                            <option value="">Pilih penulis</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @selected((old('user_id') ?? $article->user_id) == $author->id)>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div>
                <label class="form-label">Konten (JSON Editor.js)</label>
                <textarea name="content" rows="12" class="form-input font-mono text-sm" required>{{ old('content', $article->content) }}</textarea>
                @error('content') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Gambar Sampul</label>
                @if($article->image)
                    <div class="mb-3">
                        <img src="{{ $article->image }}" alt="" class="h-32 rounded-xl object-cover border border-slate-200">
                        <p class="text-xs text-slate-400 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="form-input file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('image') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Tanggal Terbit</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d')) }}" class="form-input">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $article->is_published)) class="w-5 h-5 rounded-lg border-2 border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="font-semibold text-sm text-slate-700">Publikasikan</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Perbarui</button>
                <a href="{{ route('admin.articles.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>

@endsection
