@extends('admin.layouts.admin')

@section('title', 'Hasil Polling')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.polls.index') }}" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h1 class="font-headline-lg text-2xl md:text-3xl uppercase">Hasil Polling</h1>
    </div>

    <div class="bg-white dark:bg-surface-container rounded-xl bento-shadow p-6 md:p-8 border-2 border-black dark:border-gray-700 mb-6">
        {{-- Question --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 mb-2">
                <span class="font-label-mono text-[10px] uppercase {{ $poll->type === 'multiple' ? 'text-secondary' : 'text-primary' }} px-2 py-0.5 rounded bg-surface-container-high">
                    {{ $poll->type === 'multiple' ? 'Multiple Choice' : 'Single Choice' }}
                </span>
                <span class="font-label-mono text-[10px] uppercase {{ $poll->mode === 'quiz' ? 'text-tertiary' : 'text-on-surface-variant' }} px-2 py-0.5 rounded bg-surface-container-high">
                    {{ $poll->mode === 'quiz' ? 'Quiz' : 'Biasa' }}
                </span>
            </div>
            <h2 class="font-headline-lg text-xl md:text-2xl uppercase leading-tight">{{ $poll->question }}</h2>
            <p class="font-label-mono text-[10px] text-on-surface-variant mt-1">
                Dibuat oleh {{ $poll->creator?->name ?? '-' }} &middot; {{ $poll->created_at->format('d M Y H:i') }}
            </p>
        </div>

        {{-- Stats summary --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-surface-container-low rounded-xl p-4 text-center">
                <p class="font-headline-lg text-3xl">{{ $totalVotes }}</p>
                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Total Suara</p>
            </div>
            <div class="bg-surface-container-low rounded-xl p-4 text-center">
                <p class="font-headline-lg text-3xl">{{ $poll->options->count() }}</p>
                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Opsi</p>
            </div>
            @if($poll->mode === 'quiz')
            <div class="bg-surface-container-low rounded-xl p-4 text-center">
                <p class="font-headline-lg text-3xl text-tertiary">{{ $correctVotes }} / {{ $totalVotes }}</p>
                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Jawaban Bener</p>
            </div>
            @else
            <div class="bg-surface-container-low rounded-xl p-4 text-center">
                <p class="font-headline-lg text-3xl {{ $poll->is_active ? 'text-success' : 'text-error' }}">
                    {{ $poll->is_active ? 'Aktif' : 'Tutup' }}
                </p>
                <p class="font-label-mono text-[10px] uppercase text-on-surface-variant">Status</p>
            </div>
            @endif
        </div>

        {{-- Results per option --}}
        <div class="space-y-4">
            @foreach($stats as $stat)
            <div class="bg-surface-container-low rounded-xl p-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-sm">{{ $stat['option']->option_text }}</span>
                        @if($poll->mode === 'quiz' && $stat['option']->is_correct)
                        <span class="material-symbols-outlined text-tertiary text-sm">check_circle</span>
                        @endif
                    </div>
                    <span class="font-label-mono text-sm">{{ $stat['count'] }} ({{ $stat['percentage'] }}%)</span>
                </div>
                <div class="w-full h-4 bg-surface-container-high rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full transition-all"
                         style="width: {{ $stat['percentage'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <form method="POST" action="{{ route('admin.polls.destroy', $poll) }}" class="inline delete-confirm">
            @csrf @method('DELETE')
            <button type="submit" class="bg-error-container text-error hover:bg-error hover:text-on-error rounded-xl px-5 py-2.5 font-label-mono text-xs uppercase transition-all bento-shadow inline-flex items-center gap-1.5">
                <span class="material-symbols-outlined text-sm">delete</span> HAPUS
            </button>
        </form>
        <a href="{{ route('admin.polls.index') }}" class="font-label-mono text-[10px] uppercase text-on-surface-variant hover:text-primary transition-colors ml-auto">Kembali</a>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.delete-confirm').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus polling?',
                text: 'Semua data voting akan ikut terhapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'HAPUS',
                cancelButtonText: 'BATAL',
                confirmButtonColor: '#DC2626',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-xl bento-shadow',
                    confirmButton: 'bg-error text-on-error px-5 py-2 rounded-xl font-label-mono text-xs',
                    cancelButton: 'bg-surface-container-high text-on-surface px-5 py-2 rounded-xl font-label-mono text-xs ml-2',
                }
            }).then(function(result) {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush
@endsection
