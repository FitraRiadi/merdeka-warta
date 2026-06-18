@extends('layouts.admin')

@section('title', 'Buat Pengumuman')
@section('subtitle', 'Buat pengumuman baru')

@section('content')

    <form action="{{ route('admin.announcements.store') }}" method="POST" class="max-w-2xl">
        @csrf

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-input" required>
                @error('title') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Tipe</label>
                <select name="type" class="form-select" required>
                    <option value="info" @selected(old('type') === 'info')>Info</option>
                    <option value="warning" @selected(old('type') === 'warning')>Peringatan</option>
                    <option value="important" @selected(old('type') === 'important')>Penting</option>
                </select>
                @error('type') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Konten</label>
                <textarea name="content" rows="6" class="form-input" required>{{ old('content') }}</textarea>
                @error('content') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Kadaluarsa <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <input type="date" name="expired_at" value="{{ old('expired_at') }}" class="form-input">
                    @error('expired_at') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
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
                <a href="{{ route('admin.announcements.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>

@endsection
