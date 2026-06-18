@extends('layouts.admin')

@section('title', 'Artikel')
@section('subtitle', 'Kelola artikel berita')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center"><i class="fas fa-newspaper text-blue-600"></i></div>
            <div>
                <h2 class="font-black text-lg text-slate-900">Artikel</h2>
                <p class="text-xs text-slate-400 font-medium">Total {{ $articles->total() }} artikel</p>
            </div>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Artikel Baru</a>
    </div>

    @if($articles->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="table-th">Judul</th>
                            <th class="table-th hidden md:table-cell">Penulis</th>
                            <th class="table-th hidden md:table-cell">Kategori</th>
                            <th class="table-th hidden sm:table-cell">Status</th>
                            <th class="table-th hidden sm:table-cell">Tanggal</th>
                            <th class="table-th text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="table-tr">
                                <td class="table-td">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center shrink-0 overflow-hidden">
                                            @if($article->image)
                                                <img src="{{ $article->image }}" alt="" class="w-full h-full object-cover">
                                            @else
                                                <i class="fas fa-newspaper text-slate-400 text-xs"></i>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('admin.articles.show', $article) }}" class="text-sm font-bold text-slate-900 hover:text-blue-600 transition-colors truncate block max-w-[200px] lg:max-w-[300px]">
                                                {{ $article->title }}
                                            </a>
                                            <span class="text-[11px] text-slate-400 md:hidden">{{ $article->published_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="table-td hidden md:table-cell text-sm text-slate-600 font-medium">{{ $article->author->name ?? '-' }}</td>
                                <td class="table-td hidden md:table-cell">
                                    @if($article->category)
                                        <span class="badge bg-blue-100 text-blue-700">{{ $article->category }}</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="table-td hidden sm:table-cell">
                                    @if($article->is_published)
                                        <span class="badge bg-emerald-100 text-emerald-700"><i class="fas fa-circle text-[6px] mr-1.5"></i>Terbit</span>
                                    @else
                                        <span class="badge bg-amber-100 text-amber-700"><i class="fas fa-circle text-[6px] mr-1.5"></i>Konsep</span>
                                    @endif
                                </td>
                                <td class="table-td hidden sm:table-cell text-sm text-slate-500 font-medium">{{ $article->published_at->format('d M Y') }}</td>
                                <td class="table-td text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.articles.show', $article) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-blue-600 transition-colors" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-amber-600 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-red-600 transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($articles->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $articles->onEachSide(1)->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-newspaper text-2xl text-slate-300"></i>
            </div>
            <p class="font-bold text-slate-600 mb-1">Belum ada artikel</p>
            <p class="text-sm text-slate-400 mb-6">Buat artikel pertama Anda sekarang.</p>
            <a href="{{ route('admin.articles.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Buat Artikel</a>
        </div>
    @endif

@endsection
