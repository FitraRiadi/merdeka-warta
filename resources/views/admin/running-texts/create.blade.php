@extends('layouts.admin')

@section('title', 'Tambah Running Text')
@section('subtitle', 'Tambah teks berjalan baru')

@section('content')

    <form action="{{ route('admin.running-texts.store') }}" method="POST" class="max-w-2xl">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">Teks</label>
                <textarea name="text" rows="3" class="form-input" required>{{ old('text') }}</textarea>
                @error('text') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="form-input" min="0">
                    @error('display_order') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Warna Latar</label>
                    <input type="text" name="background_color" value="{{ old('background_color') }}" class="form-input" placeholder="#000000">
                    @error('background_color') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="form-label">Warna Teks</label>
                    <input type="text" name="text_color" value="{{ old('text_color') }}" class="form-input" placeholder="#ffffff">
                    @error('text_color') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) class="w-5 h-5 rounded-lg border-2 border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="font-semibold text-sm text-slate-700">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('admin.running-texts.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>

@endsection
