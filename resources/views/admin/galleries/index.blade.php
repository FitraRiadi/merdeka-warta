@extends('layouts.admin')

@section('title', 'Galeri')
@section('subtitle', 'Atur galeri foto di halaman utama')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-primary-container border-[3px] border-on-background flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary">imagesmode</span>
            </div>
            <div>
                <h2 class="font-headline-lg text-2xl uppercase">Galeri</h2>
                <p class="font-label-mono text-[10px] uppercase opacity-60">Total {{ $galleries->total() }} gambar</p>
            </div>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">+ Tambah Gambar</a>
    </div>

    @if($galleries->isNotEmpty())
        <div class="bg-surface border-[3px] border-on-background brutalist-shadow overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-surface-container-low border-b-[3px] border-on-background">
                        <th class="table-th">Gambar</th>
                        <th class="table-th hidden md:table-cell">Keterangan</th>
                        <th class="table-th hidden sm:table-cell">Urutan</th>
                        <th class="table-th hidden sm:table-cell">Status</th>
                        <th class="table-th text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-[3px] divide-on-background/10">
                    @foreach($galleries as $g)
                        <tr class="table-tr">
                            <td class="table-td">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 border-[3px] border-on-background overflow-hidden shrink-0">
                                        <img src="{{ $g->image_url }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            </td>
                            <td class="table-td hidden md:table-cell text-sm font-bold">{{ $g->caption ?? '—' }}</td>
                            <td class="table-td hidden sm:table-cell font-label-mono text-sm">{{ $g->sort_order }}</td>
                            <td class="table-td hidden sm:table-cell">
                                @if($g->is_active)
                                    <span class="badge bg-primary-container text-on-primary-container">Aktif</span>
                                @else
                                    <span class="badge bg-surface-container text-on-surface">Nonaktif</span>
                                @endif
                            </td>
                            <td class="table-td text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.galleries.edit', $g) }}" class="p-2 hover:bg-surface-container transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.galleries.destroy', $g) }}" method="POST" onsubmit="return confirm('Hapus gambar ini?')" class="inline">
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
            @if($galleries->hasPages())
                <div class="p-4 border-t-[3px] border-on-background">{{ $galleries->onEachSide(1)->links('vendor.pagination.tailwind') }}</div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-surface border-[3px] border-on-background brutalist-shadow">
            <div class="w-16 h-16 bg-surface-container border-[3px] border-on-background flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">imagesmode</span>
            </div>
            <p class="font-label-mono text-sm uppercase mb-1">Belum ada gambar</p>
            <p class="font-body-md text-sm opacity-60 mb-6">Tambah gambar untuk galeri halaman utama.</p>
            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">+ Tambah Gambar</a>
        </div>
    @endif

@endsection
