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
            <div class="space-y-6">
                {{-- Text --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Teks <span class="text-error">*</span></label>
                    <textarea name="text" rows="3" required
                        class="admin-input" placeholder="Masukkan teks running...">{{ old('text', $runningText->text) }}</textarea>
                    @error('text') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Display Order --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $runningText->display_order) }}" min="0"
                        class="admin-input w-32">
                    @error('display_order') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Colors --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Warna Latar</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="background_color" value="{{ old('background_color', $runningText->background_color ?? '#000000') }}"
                                class="w-10 h-10 border-3 border-on-background p-0.5 cursor-pointer">
                            <input type="text" name="background_color_text"
                                value="{{ old('background_color', $runningText->background_color ?? '#000000') }}"
                                class="admin-input flex-1 font-mono text-xs">
                        </div>
                        @error('background_color') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Warna Teks</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="text_color" value="{{ old('text_color', $runningText->text_color ?? '#ffffff') }}"
                                class="w-10 h-10 border-3 border-on-background p-0.5 cursor-pointer">
                            <input type="text" name="text_color_text"
                                value="{{ old('text_color', $runningText->text_color ?? '#ffffff') }}"
                                class="admin-input flex-1 font-mono text-xs">
                        </div>
                        @error('text_color') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

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

    @push('scripts')
    <script>
        document.querySelectorAll('input[type="color"]').forEach(colorInput => {
            const textInput = colorInput.parentElement.querySelector('input[type="text"]');
            if (textInput) {
                colorInput.addEventListener('input', () => { textInput.value = colorInput.value; });
                textInput.addEventListener('input', () => { colorInput.value = textInput.value; });
            }
        });
    </script>
    @endpush
@endsection
