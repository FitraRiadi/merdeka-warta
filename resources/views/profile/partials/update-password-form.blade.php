<div class="admin-card p-6">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
        <span class="w-8 h-8 bg-gradient-to-br from-tertiary to-tertiary-fixed border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-white text-sm">lock</span>
        </span>
        <div>
            <h2 class="font-headline-lg text-lg uppercase tracking-tight">Perbarui Kata Sandi</h2>
            <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Pastikan akun anda menggunakan kata sandi yang kuat</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kata Sandi Saat Ini <span class="text-error">*</span></label>
            <input id="update_password_current_password" name="current_password" type="password" class="admin-input" autocomplete="current-password">
            @error('current_password', 'updatePassword') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kata Sandi Baru <span class="text-error">*</span></label>
            <input id="update_password_password" name="password" type="password" class="admin-input" autocomplete="new-password">
            @error('password', 'updatePassword') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Konfirmasi Kata Sandi <span class="text-error">*</span></label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="admin-input" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="font-label-mono text-xs text-green-700">
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</div>
