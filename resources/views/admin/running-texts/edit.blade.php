@extends('admin.layouts.admin')

@section('title', 'Edit Running Text - Panel Admin')
@section('page_title', 'Edit Running Text')
@section('breadcrumb')
    <a href="{{ route('admin.running-texts.index') }}" class="hover:text-primary transition-colors">Running Text</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $runningText->text }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.running-texts.update', $runningText) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="admin-card p-6">
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Teks <span class="text-error">*</span></label>
                <textarea name="text" rows="3" required
                    class="admin-input" placeholder="Masukkan teks running...">{{ old('text', $runningText->text) }}</textarea>
                @error('text') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Perbarui
            </button>
            <a href="{{ route('admin.running-texts.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>

    <form action="{{ route('admin.running-texts.destroy', $runningText) }}" method="POST" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" data-confirm-delete data-message="Running text ini akan dihapus!" class="admin-btn-danger admin-btn-sm">
            <span class="material-symbols-outlined text-sm">delete</span>
            Hapus
        </button>
    </form>


@endsection
