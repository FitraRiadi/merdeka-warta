@extends('admin.layouts.admin')

@section('title', 'Edit Testimoni - Panel Admin')
@section('page_title', 'Edit Testimoni')
@section('breadcrumb')
    <a href="{{ route('admin.testimonials.index') }}" class="hover:text-primary transition-colors">Testimoni</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $testimonial->author_name }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="admin-card p-6">
            <div class="space-y-6">
                {{-- Quote --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kutipan <span class="text-error">*</span></label>
                    <textarea name="quote" rows="4" required
                        class="admin-input" placeholder="Tulis kutipan testimoni...">{{ old('quote', $testimonial->quote) }}</textarea>
                    @error('quote') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Author Name --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama Penulis <span class="text-error">*</span></label>
                    <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required
                        class="admin-input" placeholder="Nama lengkap...">
                    @error('author_name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Author Role --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Jabatan / Peran</label>
                    <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role) }}"
                        class="admin-input" placeholder="cth: Kepala Sekolah, Guru, Siswa">
                    @error('author_role') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Background Color --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Warna Latar (CSS class)</label>
                    <input type="text" name="bg_color" value="{{ old('bg_color', $testimonial->bg_color) }}"
                        class="admin-input" placeholder="bg-secondary-fixed">
                    @error('bg_color') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Is Active --}}
                <div>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Aktifkan</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Perbarui
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>

    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" data-confirm-delete data-message="Testimoni ini akan dihapus!" class="admin-btn-danger admin-btn-sm">
            <span class="material-symbols-outlined text-sm">delete</span>
            Hapus
        </button>
    </form>
@endsection
