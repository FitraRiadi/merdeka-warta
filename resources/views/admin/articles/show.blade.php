@extends('layouts.admin')

@section('title', $article->title)
@section('subtitle', 'Detail artikel')

@section('content')

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            @if($article->image)
                <div class="aspect-[21/9] bg-slate-100">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            <div class="p-6 md:p-8">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    @if($article->category)
                        <span class="badge bg-blue-100 text-blue-700">{{ $article->category }}</span>
                    @endif
                    @if($article->is_published)
                        <span class="badge bg-emerald-100 text-emerald-700"><i class="fas fa-circle text-[6px] mr-1.5"></i>Terbit</span>
                    @else
                        <span class="badge bg-amber-100 text-amber-700"><i class="fas fa-circle text-[6px] mr-1.5"></i>Konsep</span>
                    @endif
                </div>

                <h1 class="text-2xl md:text-3xl font-black text-slate-900 mb-3">{{ $article->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-slate-400 font-medium mb-6">
                    <span><i class="far fa-calendar-alt mr-1.5"></i>{{ $article->published_at->format('d F Y') }}</span>
                    @if($article->author)
                        <span><i class="far fa-user mr-1.5"></i>{{ $article->author->name }}</span>
                    @endif
                    <span><i class="far fa-clock mr-1.5"></i>{{ $article->created_at->diffForHumans() }}</span>
                </div>

                <div class="prose prose-slate max-w-none border-t border-slate-100 pt-6">
                    @php $blocks = $article->content_array['blocks'] ?? []; @endphp
                    @forelse($blocks as $block)
                        @php $type = $block['type'] ?? 'paragraph'; @endphp
                        @if($type === 'header' && isset($block['data']['text']))
                            @php $level = $block['data']['level'] ?? 2; @endphp
                            <h{{ $level }} class="font-bold text-slate-900 mt-6 mb-3">{{ $block['data']['text'] }}</h{{ $level }}>
                        @elseif($type === 'list' && isset($block['data']['items']))
                            @php $style = $block['data']['style'] ?? 'unordered'; @endphp
                            <{{ $style === 'ordered' ? 'ol' : 'ul' }} class="list-inside space-y-1 mb-4">
                                @foreach($block['data']['items'] as $item)
                                    <li class="text-slate-700">{{ $item }}</li>
                                @endforeach
                            </{{ $style === 'ordered' ? 'ol' : 'ul' }}>
                        @elseif(isset($block['data']['text']))
                            <p class="text-slate-700 mb-4 leading-relaxed">{{ $block['data']['text'] }}</p>
                        @endif
                    @empty
                        <p class="text-slate-400 italic">Konten tidak tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6">
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn-primary"><i class="fas fa-edit"></i> Edit</a>
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')" class="ml-auto">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </form>
        </div>
    </div>

@endsection
