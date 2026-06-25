@extends('admin.layouts.admin')

@section('title', 'Edit Kontributor - Panel Admin')
@section('page_title', 'Edit Kontributor')
@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" class="hover:text-primary transition-colors">Kontributor</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $user->name }}</span>
@endsection

@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-2xl">
        @csrf @method('PATCH')

        <div class="admin-card p-6">
            <div class="space-y-6">
                {{-- Name --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama Lengkap <span class="text-error">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="admin-input" placeholder="Masukkan nama lengkap...">
                    @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email <span class="text-error">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="admin-input" placeholder="Masukkan email...">
                    @error('email') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Password Baru</label>
                    <input type="password" name="password"
                        class="admin-input" placeholder="Kosongkan jika tidak ingin mengubah...">
                    @error('password') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                    <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Kosongkan jika tidak ingin mengubah password.</p>
                </div>

                {{-- Password Confirmation --}}
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                        class="admin-input" placeholder="Ulangi password baru...">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Perbarui Kontributor
            </button>
            <a href="{{ route('admin.users.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Batal
            </a>
        </div>
    </form>

    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="mt-3">
        @csrf @method('DELETE')
        <button type="submit" data-confirm-delete data-message='Kontributor {{ $user->name }} akan dihapus!' class="admin-btn-danger admin-btn-sm">
            <span class="material-symbols-outlined text-sm">delete</span>
            Hapus
        </button>
    </form>
@endsection
