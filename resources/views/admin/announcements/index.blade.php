@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('subtitle', 'Kelola pengumuman')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center"><i class="fas fa-bullhorn text-amber-600"></i></div>
            <div>
                <h2 class="font-black text-lg text-slate-900">Pengumuman</h2>
                <p class="text-xs text-slate-400 font-medium">Total {{ $announcements->total() }} pengumuman</p>
            </div>
        </div>
        <a href="{{ route('admin.announcements.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Pengumuman Baru</a>
    </div>

    @if($announcements->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="table-th">Judul</th>
                            <th class="table-th hidden md:table-cell">Tipe</th>
                            <th class="table-th hidden sm:table-cell">Status</th>
                            <th class="table-th hidden sm:table-cell">Tanggal</th>
                            <th class="table-th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $ann)
                            <tr class="table-tr">
                                <td class="table-td">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
                                            <i class="fas fa-info-circle text-amber-500"></i>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.announcements.show', $ann) }}" class="text-sm font-bold text-slate-900 hover:text-amber-600 transition-colors">{{ $ann->title }}</a>
                                            <span class="text-[11px] text-slate-400 block md:hidden">{{ $ann->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-td hidden md:table-cell">
                                    <span class="badge
                                        @if($ann->type === 'important') bg-red-100 text-red-700
                                        @elseif($ann->type === 'warning') bg-amber-100 text-amber-700
                                        @else bg-blue-100 text-blue-700 @endif">
                                        {{ ucfirst($ann->type) }}
                                    </span>
                                </td>
                                <td class="table-td hidden sm:table-cell">
                                    @if($ann->is_active)
                                        <span class="badge bg-emerald-100 text-emerald-700">Aktif</span>
                                    @else
                                        <span class="badge bg-slate-100 text-slate-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="table-td hidden sm:table-cell text-sm text-slate-500 font-medium">{{ $ann->created_at->format('d M Y') }}</td>
                                <td class="table-td text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.announcements.show', $ann) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-blue-600" title="Lihat"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.announcements.edit', $ann) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-amber-600" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.announcements.destroy', $ann) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($announcements->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $announcements->onEachSide(1)->links('vendor.pagination.tailwind') }}</div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4"><i class="fas fa-bullhorn text-2xl text-slate-300"></i></div>
            <p class="font-bold text-slate-600 mb-1">Belum ada pengumuman</p>
            <p class="text-sm text-slate-400 mb-6">Buat pengumuman baru.</p>
            <a href="{{ route('admin.announcements.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Pengumuman Baru</a>
        </div>
    @endif

@endsection
