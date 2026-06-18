@extends('layouts.admin')

@section('title', 'Testimoni')
@section('subtitle', 'Atur testimoni/tanggapan di halaman utama')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-primary-container border-[3px] border-on-background flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary">format_quote</span>
            </div>
            <div>
                <h2 class="font-headline-lg text-2xl uppercase">Testimoni</h2>
                <p class="font-label-mono text-[10px] uppercase opacity-60">Total {{ $testimonials->total() }} testimoni</p>
            </div>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Tambah Testimoni</a>
    </div>

    @if($testimonials->isNotEmpty())
        <div class="bg-surface border-[3px] border-on-background brutalist-shadow overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-surface-container-low border-b-[3px] border-on-background">
                        <th class="table-th">Kutipan</th>
                        <th class="table-th hidden sm:table-cell">Nama</th>
                        <th class="table-th hidden md:table-cell">Peran</th>
                        <th class="table-th hidden sm:table-cell">Urutan</th>
                        <th class="table-th hidden sm:table-cell">Status</th>
                        <th class="table-th text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-[3px] divide-on-background/10">
                    @foreach($testimonials as $t)
                        <tr class="table-tr">
                            <td class="table-td text-sm font-bold max-w-xs truncate">{{ $t->quote }}</td>
                            <td class="table-td hidden sm:table-cell font-label-mono text-sm">{{ $t->author_name }}</td>
                            <td class="table-td hidden md:table-cell text-sm">{{ $t->author_role ?? '—' }}</td>
                            <td class="table-td hidden sm:table-cell font-label-mono text-sm">{{ $t->sort_order }}</td>
                            <td class="table-td hidden sm:table-cell">
                                @if($t->is_active)
                                    <span class="badge bg-primary-container text-on-primary-container">Aktif</span>
                                @else
                                    <span class="badge bg-surface-container text-on-surface">Nonaktif</span>
                                @endif
                            </td>
                            <td class="table-td text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="p-2 hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-error-container transition-colors cursor-pointer">
                                            <span class="material-symbols-outlined text-sm text-error">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($testimonials->hasPages())
                <div class="p-4 border-t-[3px] border-on-background">{{ $testimonials->onEachSide(1)->links('vendor.pagination.tailwind') }}</div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-surface border-[3px] border-on-background brutalist-shadow">
            <div class="w-16 h-16 bg-surface-container border-[3px] border-on-background flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">format_quote</span>
            </div>
            <p class="font-label-mono text-sm uppercase mb-1">Belum ada testimoni</p>
            <p class="font-body-md text-sm opacity-60 mb-6">Tambahkan testimoni/tanggapan untuk halaman utama.</p>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ Tambah Testimoni</a>
        </div>
    @endif

@endsection
