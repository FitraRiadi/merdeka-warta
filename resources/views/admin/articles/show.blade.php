@extends('admin.layouts.admin')

@section('title', $article->title . ' - Panel Admin')
@section('page_title', 'Detail Artikel')
@section('breadcrumb')
    <a href="{{ route('admin.articles.index') }}" class="hover:text-primary transition-colors">Artikel</a>
    <span class="material-symbols-outlined text-sm">chevron_right</span>
    <span class="text-on-surface truncate max-w-[200px]">{{ $article->title }}</span>
@endsection

@section('content')
    <div class="max-w-4xl">
        <div class="admin-card overflow-hidden">
            @if($article->image)
                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-64 md:h-80 object-cover border-b-3 border-on-background">
            @endif

            <div class="p-6 md:p-8">
                {{-- Meta --}}
                <div class="flex flex-wrap items-center gap-3 mb-4 font-label-mono text-xs uppercase text-on-surface-variant">
                    @if($article->category)
                        <span class="admin-badge bg-primary-fixed-dim text-primary">{{ $article->category }}</span>
                    @endif
                    @if($article->is_published)
                        <span class="admin-badge bg-secondary-fixed text-secondary">Terbit</span>
                    @else
                        <span class="admin-badge bg-surface-variant text-on-surface-variant">Draft</span>
                    @endif
                    <span>{{ $article->published_at?->format('d M Y') ?? 'Belum terbit' }}</span>
                    <span>Oleh: {{ $article->author?->name ?? 'Tanpa Penulis' }}</span>
                </div>

                {{-- Title --}}
                <h1 class="font-headline-lg text-2xl md:text-4xl uppercase tracking-tight mb-6">{{ $article->title }}</h1>

                {{-- Content --}}
                <div class="prose prose-sm max-w-none">
                    {!! $article->renderContent() !!}
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 mt-6">
            <a href="{{ route('admin.articles.edit', $article) }}" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">edit</span>
                Edit Artikel
            </a>
            <a href="{{ route('public.article.show', $article->slug) }}" target="_blank" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">visibility</span>
                Lihat di Website
            </a>
            <a href="{{ route('admin.articles.index') }}" class="admin-btn-secondary">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali
            </a>
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="ml-auto">
                @csrf @method('DELETE')
                <button type="submit" data-confirm-delete data-message='Artikel {{ $article->title }} akan dihapus!' class="admin-btn-danger admin-btn-sm">
                    <span class="material-symbols-outlined text-sm">delete</span>
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endsection
