@extends('layouts.admin')

@section('title', 'Edit Penulis')
@section('subtitle', $user->name)

@section('content')

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-xl">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
            <div>
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required>
                @error('name') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required>
                @error('email') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Password Baru <span class="text-slate-400 font-normal">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="form-input" min="8">
                @error('password') <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-input">
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Perbarui</button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary"><i class="fas fa-times"></i> Batal</a>
            </div>
        </div>
    </form>

@endsection
