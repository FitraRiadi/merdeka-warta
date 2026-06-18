@extends('layouts.admin')

@section('title', 'Pengguna')
@section('subtitle', 'Kelola penulis')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center"><i class="fas fa-users text-purple-600"></i></div>
            <div>
                <h2 class="font-black text-lg text-slate-900">Pengguna</h2>
                <p class="text-xs text-slate-400 font-medium">Total {{ $authors->total() }} penulis</p>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Tambah Penulis</a>
    </div>

    @if($authors->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="table-th">Nama</th>
                        <th class="table-th hidden sm:table-cell">Email</th>
                        <th class="table-th hidden md:table-cell">Role</th>
                        <th class="table-th hidden sm:table-cell">Bergabung</th>
                        <th class="table-th text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr class="table-tr">
                            <td class="table-td">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow">
                                        {{ substr($author->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="text-sm font-bold text-slate-900">{{ $author->name }}</span>
                                        <span class="text-[11px] text-slate-400 block sm:hidden">{{ $author->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="table-td hidden sm:table-cell text-sm text-slate-600 font-medium">{{ $author->email }}</td>
                            <td class="table-td hidden md:table-cell">
                                <span class="badge @if($author->isSuperAdmin()) bg-purple-100 text-purple-700 @else bg-blue-100 text-blue-700 @endif">
                                    {{ $author->isSuperAdmin() ? 'Super Admin' : 'Author' }}
                                </span>
                            </td>
                            <td class="table-td hidden sm:table-cell text-sm text-slate-500 font-medium">{{ $author->created_at->format('d M Y') }}</td>
                            <td class="table-td text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.users.edit', $author) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-amber-600"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.users.destroy', $author) }}" method="POST" onsubmit="return confirm('Hapus penulis ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-red-600"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($authors->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">{{ $authors->onEachSide(1)->links('vendor.pagination.tailwind') }}</div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4"><i class="fas fa-users text-2xl text-slate-300"></i></div>
            <p class="font-bold text-slate-600 mb-1">Belum ada penulis</p>
            <p class="text-sm text-slate-400 mb-6">Tambah penulis baru.</p>
            <a href="{{ route('admin.users.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Tambah Penulis</a>
        </div>
    @endif

@endsection
