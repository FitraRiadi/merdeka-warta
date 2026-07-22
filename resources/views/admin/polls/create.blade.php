@extends('admin.layouts.admin')

@section('title', 'Buat Polling')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.polls.index') }}" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="font-headline-lg text-2xl md:text-3xl uppercase">Buat Polling</h1>
    </div>

    <form method="POST" action="{{ route('admin.polls.store') }}" x-data="pollForm()" class="bg-white dark:bg-surface-container rounded-xl bento-shadow p-6 md:p-8 border-2 border-black dark:border-gray-700">
        @csrf

        {{-- Question --}}
        <div class="mb-6">
            <label class="block font-label-mono text-[10px] uppercase tracking-wider mb-2">Pertanyaan</label>
            <input type="text" name="question" value="{{ old('question') }}"
                   class="w-full bg-surface-container-low rounded-xl px-4 py-3 font-bold text-sm border-2 border-black dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30"
                   placeholder="Tulis pertanyaan polling..." required>
            @error('question')
            <p class="text-error font-label-mono text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Type & Mode --}}
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-label-mono text-[10px] uppercase tracking-wider mb-2">Tipe Jawaban</label>
                <select name="type" x-model="form.type" class="w-full bg-surface-container-low rounded-xl px-4 py-3 font-bold text-sm border-2 border-black dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30">
                    <option value="single">Single Choice</option>
                    <option value="multiple">Multiple Choice</option>
                </select>
            </div>
            <div>
                <label class="block font-label-mono text-[10px] uppercase tracking-wider mb-2">Mode</label>
                <select name="mode" x-model="form.mode" class="w-full bg-surface-container-low rounded-xl px-4 py-3 font-bold text-sm border-2 border-black dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30">
                    <option value="biasa">Biasa</option>
                    <option value="quiz">Quiz</option>
                </select>
            </div>
        </div>

        {{-- Close date --}}
        <div class="mb-6">
            <label class="block font-label-mono text-[10px] uppercase tracking-wider mb-2">Tutup Otomatis (opsional)</label>
            <input type="datetime-local" name="closes_at" value="{{ old('closes_at') }}"
                   min="{{ now()->format('Y-m-d\TH:i') }}"
                   class="w-full bg-surface-container-low rounded-xl px-4 py-3 font-bold text-sm border-2 border-black dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30">
        </div>

        {{-- Options --}}
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <label class="block font-label-mono text-[10px] uppercase tracking-wider">Opsi Jawaban</label>
                <button type="button" @click="addOption()" class="text-primary hover:text-primary/80 font-label-mono text-[10px] uppercase flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">add_circle</span> Tambah Opsi
                </button>
            </div>
            <template x-for="(option, index) in form.options" :key="index">
                <div class="flex items-center gap-3 mb-2">
                    <span class="font-label-mono text-[10px] text-on-surface-variant w-6" x-text="'ABCDEFGHIJ'[index] + '.'"></span>
                    <input type="text" :name="'options[' + index + '][text]'" x-model="option.text"
                           class="flex-1 bg-surface-container-low rounded-xl px-4 py-2.5 font-bold text-sm border-2 border-black dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary/30"
                           placeholder="Opsi jawaban..." required>
                    <label class="flex items-center gap-1.5 cursor-pointer" x-show="form.mode === 'quiz'">
                        <input type="checkbox" :name="'options[' + index + '][is_correct]'" x-model="option.is_correct" value="1" class="w-4 h-4">
                        <span class="font-label-mono text-[10px] text-tertiary">Bener</span>
                    </label>
                    <button type="button" @click="removeOption(index)" x-show="form.options.length > 2" class="p-1.5 hover:bg-error-container hover:text-error rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">remove_circle</span>
                    </button>
                </div>
            </template>
            @error('options')
            <p class="text-error font-label-mono text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-primary text-on-primary rounded-xl px-8 py-3 font-label-mono text-xs uppercase hover:bg-primary/90 transition-all bento-shadow">
                SIMPAN POLLING
            </button>
            <a href="{{ route('admin.polls.index') }}" class="font-label-mono text-[10px] uppercase text-on-surface-variant hover:text-primary transition-colors">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function pollForm() {
        return {
            form: {
                type: 'single',
                mode: 'biasa',
                options: [{ text: '', is_correct: false }, { text: '', is_correct: false }],
            },
            addOption() {
                if (this.form.options.length < 10) {
                    this.form.options.push({ text: '', is_correct: false });
                }
            },
            removeOption(index) {
                if (this.form.options.length > 2) {
                    this.form.options.splice(index, 1);
                }
            }
        }
    }
</script>
@endpush
@endsection
