@section('title', config('app.name') . ' | Masuk')
<x-guest-layout>
    <div class="w-full max-w-4xl">
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

        {{-- Login Card --}}
        <div class="bg-surface border-4 border-on-background guest-card-shadow p-6 md:p-8">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-primary border-3 border-on-background flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    <span class="material-symbols-outlined text-on-primary">login</span>
                </div>
                <h1 class="font-headline-lg text-2xl uppercase tracking-tight">Masuk</h1>
            </div>

            {{-- Session Status --}}
            @if(session('status'))
                <div class="mb-6 p-4 bg-secondary-fixed border-3 border-on-background shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    <p class="font-body-md text-sm">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">email</span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
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

                {{-- Password --}}
                <div class="mb-6" x-data="{ show: false }">
                    <label for="password" class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">lock</span>
                        <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                            class="w-full bg-surface border-3 border-on-background pl-12 pr-12 py-3 font-body-md focus:border-primary transition-colors"
                            placeholder="Masukkan kata sandi...">
                        <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 font-label-mono text-xs text-error flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between mb-8">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-5 h-5 border-3 border-on-background bg-surface text-primary focus:ring-0 focus:outline-none rounded-none
                                   checked:bg-primary checked:border-on-background transition-colors">
                        <span class="font-label-mono text-xs uppercase group-hover:text-primary transition-colors">Ingat saya</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-label-mono text-xs text-primary hover:underline uppercase">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-primary text-on-primary font-headline-lg text-xl uppercase py-4 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-3 btn-press">
                    <span class="material-symbols-outlined">login</span>
                    MASUK
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center mt-8 font-label-mono text-xs text-on-surface-variant">
            &copy; {{ date('Y') }} SMK Merdeka. All rights reserved.
        </p>
    </div>
</x-guest-layout>
