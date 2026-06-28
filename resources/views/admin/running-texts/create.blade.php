@extends('admin.layouts.admin')

@section('title', 'Tambah Running Text - Panel Admin')
@section('page_title', 'Tambah Running Text')
@section('breadcrumb')
    <a href="{{ route('admin.running-texts.index') }}" class="hover:text-primary transition-colors">Running Text</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Tambah Baru</span>
@endsection

@section('content')
    <form action="{{ route('admin.running-texts.store') }}" method="POST" class="max-w-2xl">
        @csrf

        <div class="admin-card p-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
                <span class="w-8 h-8 bg-purple-700 dark:bg-purple-800 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">format_list_bulleted</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Informasi Running Text</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Tambah teks berjalan baru</p>
                </div>
            </div>

            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Teks <span class="text-error">*</span></label>
                <textarea name="text" rows="3" required
                    class="admin-input" placeholder="Masukkan teks running...">{{ old('text') }}</textarea>
                @error('text') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan
            </button>
            <a href="{{ route('admin.running-texts.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>


@endsection
