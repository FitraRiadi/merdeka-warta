@extends('admin.layouts.admin')

@section('title', 'Polling')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-headline-lg text-2xl md:text-3xl uppercase">Polling</h1>
            <p class="text-on-surface-variant text-sm mt-1">Kelola polling dan voting</p>
            <div class="flex items-center gap-2 mt-2">
                <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">{{ $pollCount ?? 0 }}/8</span>
                <div class="w-32 h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300 {{ ($pollCount ?? 0) >= 8 ? 'bg-error' : 'bg-primary' }}" style="width: {{ min(($pollCount ?? 0) / 8 * 100, 100) }}%"></div>
                </div>
            </div>
        </div>
        @php $full = ($pollCount ?? 0) >= 8; @endphp
        <a href="{{ $full ? '#' : route('admin.polls.create') }}" class="bg-primary text-on-primary rounded-xl px-5 py-2.5 font-label-mono text-xs uppercase hover:bg-primary/90 transition-all bento-shadow inline-flex items-center gap-1.5 {{ $full ? 'opacity-50 cursor-not-allowed' : '' }}" @if($full) onclick="return false;" @endif>
            <span class="material-symbols-outlined text-sm">add</span> BUAT POLLING
        </a>
    </div>

    @if(session('success'))
    <div class="bg-secondary-fixed text-on-secondary-fixed rounded-xl px-5 py-3 mb-6 font-label-mono text-xs bento-shadow">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-error-container text-on-error-container rounded-xl px-5 py-3 mb-6 font-label-mono text-xs bento-shadow">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white dark:bg-surface-container rounded-xl bento-shadow overflow-hidden border-2 border-black dark:border-gray-700">
        @if($polls->isEmpty())
        <div class="text-center py-16">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">poll</span>
            <p class="font-headline-lg text-xl uppercase text-on-surface-variant">Belum ada polling</p>
            <a href="{{ route('admin.polls.create') }}" class="inline-block mt-4 bg-primary text-on-primary rounded-xl px-6 py-3 font-label-mono text-sm bento-shadow hover:bg-primary/90 transition-all">BUAT POLLING PERTAMA</a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b-2 border-black dark:border-gray-700 bg-surface-container-high">
                        <th class="text-left px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Pertanyaan</th>
                        <th class="text-left px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Tipe</th>
                        <th class="text-left px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Mode</th>
                        <th class="text-center px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Suara</th>
                        <th class="text-center px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-3 font-label-mono text-[10px] uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/10 dark:divide-gray-700">
                    @foreach($polls as $poll)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-5 py-4">
                            <div class="font-bold text-sm max-w-xs truncate">{{ $poll->question }}</div>
                            <div class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">{{ $poll->created_at->format('d M Y H:i') }}</div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-label-mono text-[10px] uppercase {{ $poll->type === 'multiple' ? 'text-secondary' : 'text-primary' }}">
                                {{ $poll->type === 'multiple' ? 'Multiple' : 'Single' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-label-mono text-[10px] uppercase {{ $poll->mode === 'quiz' ? 'text-tertiary' : 'text-on-surface-variant' }}">
                                {{ $poll->mode === 'quiz' ? 'Quiz' : 'Biasa' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center font-label-mono text-sm">{{ $poll->votes_count ?? $poll->votes()->count() }}</td>
                        <td class="px-5 py-4 text-center">
                            @if($poll->is_active && (!$poll->closes_at || !$poll->closes_at->isPast()))
                            <span class="bg-success-container text-on-success-container px-2.5 py-1 font-label-mono text-[10px] rounded">Aktif</span>
                            @else
                            <span class="bg-error-container text-on-error-container px-2.5 py-1 font-label-mono text-[10px] rounded">Tutup</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.polls.show', $poll) }}" class="p-2 hover:bg-surface-container-high rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-sm">bar_chart</span>
                                </a>
                                <form method="POST" action="{{ route('admin.polls.destroy', $poll) }}" class="inline delete-confirm">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 hover:bg-error-container hover:text-error rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($polls->hasPages())
        <div class="px-5 py-4 border-t-2 border-black dark:border-gray-700">
            {{ $polls->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection

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
