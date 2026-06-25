<div class="admin-card p-6">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
        <span class="w-8 h-8 bg-gradient-to-br from-primary to-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-white text-sm">person</span>
        </span>
        <div>
            <h2 class="font-headline-lg text-lg uppercase tracking-tight">Informasi Profil</h2>
            <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Perbarui informasi akun dan alamat email anda</p>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama <span class="text-error">*</span></label>
            <input id="name" name="name" type="text" class="admin-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email <span class="text-error">*</span></label>
            <input id="email" name="email" type="email" class="admin-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 border-2 border-on-background bg-amber-50">
                    <p class="font-label-mono text-xs text-amber-800">
                        Alamat email anda belum diverifikasi.

                        <button form="send-verification" class="underline font-bold hover:text-primary transition-colors">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-green-700">
                            Tautan verifikasi baru telah dikirim ke alamat email anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="font-label-mono text-xs text-green-700">
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</div>
