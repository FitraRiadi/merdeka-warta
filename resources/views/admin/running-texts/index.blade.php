@extends('layouts.admin')

@section('title', 'Running Text')
@section('subtitle', 'Kelola teks berjalan')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center"><i class="fas fa-ticker text-rose-600"></i></div>
            <div>
                <h2 class="font-black text-lg text-slate-900">Running Text</h2>
                <p class="text-xs text-slate-400 font-medium">Total {{ $runningTexts->total() }} teks</p>
            </div>
        </div>
        <a href="{{ route('admin.running-texts.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Tambah Teks</a>
    </div>

    @if($runningTexts->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="table-th">Teks</th>
                        <th class="table-th hidden sm:table-cell">Urutan</th>
                        <th class="table-th hidden md:table-cell">Warna</th>
                        <th class="table-th hidden sm:table-cell">Status</th>
                        <th class="table-th text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($runningTexts as $rt)
                        <tr class="table-tr">
                            <td class="table-td">
                                <span class="text-sm font-bold text-slate-900">{{ $rt->text }}</span>
                            </td>
                            <td class="table-td hidden sm:table-cell text-sm text-slate-500 font-medium">{{ $rt->display_order }}</td>
                            <td class="table-td hidden md:table-cell">
                                <div class="flex items-center gap-2">
                                    <span class="w-5 h-5 rounded border border-slate-200" style="background: {{ $rt->background_color ?? '#000' }}"></span>
                                    <span class="text-xs font-medium text-slate-500">{{ $rt->background_color ?? 'default' }}</span>
                                </div>
                            </td>
                            <td class="table-td hidden sm:table-cell">
                                @if($rt->is_active)
                                    <span class="badge bg-emerald-100 text-emerald-700">Aktif</span>
                                @else
                                    <span class="badge bg-slate-100 text-slate-500">Nonaktif</span>
                                @endif
                            </td>
                            <td class="table-td text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.running-texts.edit', $rt) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-amber-600"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.running-texts.destroy', $rt) }}" method="POST" onsubmit="return confirm('Hapus teks ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($runningTexts->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $runningTexts->onEachSide(1)->links('vendor.pagination.tailwind') }}</div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4"><i class="fas fa-ticker text-2xl text-slate-300"></i></div>
            <p class="font-bold text-slate-600 mb-1">Belum ada running text</p>
            <p class="text-sm text-slate-400 mb-6">Tambah running text baru.</p>
            <a href="{{ route('admin.running-texts.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Tambah Teks</a>
        </div>
    @endif

@endsection
