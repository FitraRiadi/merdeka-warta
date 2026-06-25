@extends('admin.layouts.admin')

@section('title', 'Tambah Kontributor - Panel Admin')
@section('page_title', 'Tambah Kontributor')
@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Kontributor</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface">Tambah Baru</span>
@endsection

@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST" class="max-w-2xl">
        @csrf

        <div class="admin-card p-6">
            <div class="space-y-6">
                {{-- Name --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama Lengkap <span class="text-error">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="admin-input" placeholder="Masukkan nama lengkap...">
                    @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email <span class="text-error">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="admin-input" placeholder="Masukkan email...">
                    @error('email') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Password <span class="text-error">*</span></label>
                    <input type="password" name="password" required
                        class="admin-input" placeholder="Minimal 8 karakter...">
                    @error('password') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konfirmasi Password <span class="text-error">*</span></label>
                    <input type="password" name="password_confirmation" required
                        class="admin-input" placeholder="Ulangi password...">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Kontributor
            </button>
            <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>
@endsection
