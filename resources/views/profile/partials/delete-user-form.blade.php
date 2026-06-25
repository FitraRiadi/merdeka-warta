<div class="admin-card p-6 border-error">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
        <span class="w-8 h-8 bg-gradient-to-br from-error to-error-container border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-white text-sm">delete_forever</span>
        </span>
        <div>
            <h2 class="font-headline-lg text-lg uppercase tracking-tight">Hapus Akun</h2>
            <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Tindakan ini tidak dapat dibatalkan</p>
        </div>
    </div>

    <p class="font-body-md text-sm text-on-surface-variant mb-6">
        Setelah akun anda dihapus, seluruh data dan sumber daya akan terhapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi yang ingin anda simpan.
    </p>

    <button type="button" x-data x-on:click="$dispatch('open-modal', 'confirm-user-deletion')" class="admin-btn-danger">
        <span class="material-symbols-outlined text-sm">delete</span>
        Hapus Akun
    </button>

    <div x-data="{ show: false }" x-on:open-modal.window="if ($event.detail === 'confirm-user-deletion') show = true" x-on:keydown.escape.window="show = false" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
        <div x-show="show" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/60" x-on:click="show = false"></div>

        <div x-show="show" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" class="relative bg-white border-3 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] w-full max-w-lg mx-4">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <div class="flex items-center gap-3 mb-4">
                    <span class="w-10 h-10 bg-gradient-to-br from-error to-error-container border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <span class="material-symbols-outlined text-white">warning</span>
                    </span>
                    <h2 class="font-headline-lg text-xl uppercase tracking-tight">Apakah Anda Yakin?</h2>
                </div>

                <p class="font-body-md text-sm text-on-surface-variant mb-6">
                    Setelah akun anda dihapus, seluruh data dan sumber daya akan terhapus secara permanen. Harap masukkan kata sandi anda untuk mengonfirmasi penghapusan akun.
                </p>

                <div class="mb-6">
                    <label for="password" class="sr-only">Kata Sandi</label>
                    <input id="password" name="password" type="password" class="admin-input" placeholder="Masukkan kata sandi">
                    @error('password', 'userDeletion') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" x-on:click="show = false" class="admin-btn-secondary">
                        <span class="material-symbols-outlined text-sm">close</span>
                        Batal
                    </button>
                    <button type="submit" class="admin-btn-danger">
                        <span class="material-symbols-outlined text-sm">delete</span>
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
