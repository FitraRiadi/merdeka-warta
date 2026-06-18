@extends('layouts.admin')

@section('title', 'Edit Testimoni')
@section('subtitle', 'Perbarui testimoni/tanggapan')

@section('content')

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="bg-surface border-[3px] border-on-background brutalist-shadow p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">Kutipan</label>
                <textarea name="quote" rows="3" class="form-input" required>{{ old('quote', $testimonial->quote) }}</textarea>
                @error('quote') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nama</label>
                    <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" class="form-input" required>
                    @error('author_name') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Peran</label>
                    <input type="text" name="author_role" value="{{ old('author_role', $testimonial->author_role) }}" class="form-input" placeholder="Siswa Kelas XI">
                    @error('author_role') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Warna Latar</label>
                    <select name="bg_color" class="form-input">
                        <option value="bg-secondary-fixed" @selected(old('bg_color', $testimonial->bg_color) == 'bg-secondary-fixed')>Pink</option>
                        <option value="bg-tertiary-fixed" @selected(old('bg_color', $testimonial->bg_color) == 'bg-tertiary-fixed')>Orange</option>
                        <option value="bg-primary-fixed" @selected(old('bg_color', $testimonial->bg_color) == 'bg-primary-fixed')>Blue</option>
                        <option value="bg-surface-container" @selected(old('bg_color', $testimonial->bg_color) == 'bg-surface-container')>Gray</option>
                    </select>
                    @error('bg_color') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order) }}" class="form-input" min="0">
                    @error('sort_order') <p class="font-label-mono text-[10px] text-error mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $testimonial->is_active)) class="w-5 h-5 border-[3px] border-on-background">
                    <span class="font-label-mono text-xs uppercase">Aktif</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t-[3px] border-on-background">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>

@endsection
