@extends('layouts.admin')

@section('title', $announcement->title)
@section('subtitle', 'Detail pengumuman')

@section('content')

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="badge
                    @if($announcement->type === 'important') bg-red-100 text-red-700
                    @elseif($announcement->type === 'warning') bg-amber-100 text-amber-700
                    @else bg-blue-100 text-blue-700 @endif">
                    {{ ucfirst($announcement->type) }}
                </span>
                @if($announcement->is_active)
                    <span class="badge bg-emerald-100 text-emerald-700">Aktif</span>
                @else
                    <span class="badge bg-slate-100 text-slate-500">Nonaktif</span>
                @endif
            </div>

            <h1 class="text-2xl font-black text-slate-900 mb-3">{{ $announcement->title }}</h1>

            <div class="flex items-center gap-4 text-sm text-slate-400 font-medium mb-6">
                <span><i class="far fa-calendar-alt mr-1.5"></i>{{ $announcement->created_at->format('d F Y') }}</span>
                @if($announcement->expired_at)
                    <span><i class="far fa-clock mr-1.5"></i>Kadaluarsa: {{ $announcement->expired_at->format('d M Y') }}</span>
                @endif
            </div>

            <div class="border-t border-slate-100 pt-6">
                <p class="text-slate-700 leading-relaxed">{{ $announcement->content }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn-primary"><i class="fas fa-edit"></i> Edit</a>
            <a href="{{ route('admin.announcements.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')" class="ml-auto">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </form>
        </div>
    </div>

@endsection
