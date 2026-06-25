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
                <span class="w-8 h-8 bg-gradient-to-br from-purple-600 to-purple-300 border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-white text-sm">format_list_bulleted</span>
                </span>
                <div>
                    <h2 class="font-headline-lg text-lg uppercase tracking-tight">Informasi Running Text</h2>
                    <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Tambah teks berjalan baru</p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Teks <span class="text-error">*</span></label>
                    <textarea name="text" rows="3" required
                        class="admin-input" placeholder="Masukkan teks running...">{{ old('text') }}</textarea>
                    @error('text') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0"
                        class="admin-input w-32">
                    @error('display_order') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Warna Latar</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="background_color" value="{{ old('background_color', '#000000') }}"
                                class="w-10 h-10 border-3 border-on-background p-0.5 cursor-pointer">
                            <input type="text" name="background_color_text"
                                value="{{ old('background_color', '#000000') }}"
                                class="admin-input flex-1 font-mono text-xs">
                        </div>
                        @error('background_color') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Warna Teks</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="text_color" value="{{ old('text_color', '#ffffff') }}"
                                class="w-10 h-10 border-3 border-on-background p-0.5 cursor-pointer">
                            <input type="text" name="text_color_text"
                                value="{{ old('text_color', '#ffffff') }}"
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
                Simpan
            </button>
            <a href="{{ route('admin.running-texts.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
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
