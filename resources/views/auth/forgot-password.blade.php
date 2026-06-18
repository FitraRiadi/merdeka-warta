@section('title', config('app.name') . ' | Lupa Kata Sandi')
<x-guest-layout>
    <div class="w-full max-w-xl">
        {{-- Branding --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img width="40" height="40" src="https://cdn.ryzahen.web.id/GQApe.png" alt="smkmerdeka-logo">
                    <span class="font-headline-lg text-4xl uppercase tracking-tighter text-on-surface">MERDEKA WARTA</span>
                </div>
            </a>
            <div class="h-2 w-24 bg-primary mx-auto border-2 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]"></div>
        </div>

        {{-- Card --}}
        <div class="bg-surface border-4 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] p-6 md:p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-primary border-3 border-on-background flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary">lock_reset</span>
                </div>
                <h1 class="font-headline-lg text-2xl uppercase tracking-tight">Lupa Kata Sandi</h1>
            </div>

            <p class="font-body-md text-sm text-on-surface-variant mb-8 p-4 bg-surface-variant border-3 border-on-background">
                Lupa kata sandi? Tidak masalah. Masukkan email Anda dan kami akan mengirimkan tautan reset kata sandi.
            </p>

            {{-- Session Status --}}
            @if(session('status'))
                <div class="mb-6 p-4 bg-secondary-fixed border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    <p class="font-body-md text-sm">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-8">
                    <label for="email" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">email</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-surface border-3 border-on-background pl-12 pr-4 py-3 font-body-md focus:border-primary transition-colors"
                            placeholder="Masukkan email...">
                    </div>
                    @error('email')
                        <p class="mt-2 font-label-mono text-xs text-error flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-primary text-on-primary font-headline-lg text-lg uppercase py-4 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-3 btn-press">
                    <span class="material-symbols-outlined">send</span>
                    Kirim Tautan Reset
                </button>

                {{-- Back to login --}}
                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="font-label-mono text-xs text-primary hover:underline uppercase inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Kembali ke halaman masuk
                    </a>
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center mt-8 font-label-mono text-xs text-on-surface-variant">
            &copy; {{ date('Y') }} SMK Merdeka. All rights reserved.
        </p>
    </div>
</x-guest-layout>
