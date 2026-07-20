@extends('admin.layouts.admin')

@section('title', 'Kategori - Panel Admin')
@section('page_title', 'Kategori')
@section('page_description', 'Kelola kategori artikel dan pengumuman')

@section('content')
    {{-- ============================================================ --}}
    {{-- ARTIKEL CATEGORIES                                          --}}
    {{-- ============================================================ --}}
    <div class="admin-card p-5 mb-6">
        <h3 class="font-headline-lg text-sm uppercase mb-1">Kategori Artikel</h3>
        <p class="font-label-mono text-[10px] text-on-surface-variant mb-4">Digunakan saat membuat artikel</p>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex items-end gap-3">
            @csrf
            <div class="flex-1">
                <label for="name" class="font-label-mono text-xs uppercase text-on-surface-variant block mb-1">Nama Kategori</label>
                <input type="text" name="name" id="name" class="admin-input w-full" placeholder="Misal: Olahraga" value="{{ old('name') }}" required>
                @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="admin-btn-primary admin-btn-sm">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah
            </button>
        </form>
    </div>

    <div class="admin-card overflow-hidden mb-8">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Nama</th>
                        <th class="text-center">Artikel</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articleCategories as $cat)
                    <tr x-data="{ editing: false }">
                        <td x-show="!editing">
                            <span class="font-body-md text-sm font-bold">{{ $cat->name }}</span>
                        </td>
                        <td x-show="!editing" class="text-center">
                            <span class="font-body-md text-sm">{{ $cat->articles_count }}</span>
                        </td>
                        <td x-show="!editing" class="text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" @click="editing = true" class="action-btn action-btn-edit" title="Edit">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </button>
                                @if($cat->articles_count === 0)
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" data-confirm-delete data-message="Kategori '{{ $cat->name }}' akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="action-btn action-btn-delete opacity-30 cursor-not-allowed" title="Masih memiliki {{ $cat->articles_count }} artikel" disabled>
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                                @endif
                            </div>
                        </td>
                        <td x-show="editing" colspan="3" class="bg-surface-container p-3">
                            <form action="{{ route('admin.categories.update', $cat) }}" method="POST" class="flex items-end gap-3 max-w-md mx-auto">
                                @csrf @method('PUT')
                                <div class="flex-1">
                                    <label class="font-label-mono text-[10px] uppercase text-on-surface-variant block mb-1">Edit Nama</label>
                                    <input type="text" name="name" value="{{ $cat->name }}" class="admin-input w-full text-sm" required>
                                </div>
                                <div class="flex gap-1.5">
                                    <button type="submit" class="admin-btn-primary admin-btn-sm">
                                        <span class="material-symbols-outlined text-sm">check</span>
                                        Simpan
                                    </button>
                                    <button type="button" @click="editing = false" class="admin-btn-ghost admin-btn-sm">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">category</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada kategori artikel.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articleCategories->hasPages())
            <div class="p-3 border-t-3 border-on-background pagination">
                {{ $articleCategories->links() }}
            </div>
        @endif
    </div>

    {{-- ============================================================ --}}
    {{-- ANNOUNCEMENT CATEGORIES                                      --}}
    {{-- ============================================================ --}}
    <div class="admin-card p-5 mb-6">
        <div class="flex items-center gap-3 mb-1">
            <span class="w-6 h-6 border-2 border-on-background flex items-center justify-center bg-primary">
                <span class="material-symbols-outlined text-on-primary text-xs">campaign</span>
            </span>
            <h3 class="font-headline-lg text-sm uppercase">Kategori Pengumuman</h3>
        </div>
        <p class="font-label-mono text-[10px] text-on-surface-variant mb-4">Setiap kategori punya tipe (info / peringatan / penting) yang menentukan ikon dan warna</p>
        <form action="{{ route('admin.announcement-categories.store') }}" method="POST" class="flex items-end gap-3">
            @csrf
            <div class="flex-[2]">
                <label for="ann_name" class="font-label-mono text-xs uppercase text-on-surface-variant block mb-1">Nama Kategori</label>
                <input type="text" name="name" id="ann_name" class="admin-input w-full" placeholder="Misal: Acara" value="{{ old('name') }}" required>
                @error('name') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
            <div class="flex-1" x-data="{ selected: '{{ old('type', 'info') }}' }">
                <label class="font-label-mono text-xs uppercase text-on-surface-variant block mb-1">Tipe</label>
                <input type="hidden" name="type" x-model="selected">
                <div class="flex gap-1.5">
                    <template x-for="(item, key) in { info: { icon: 'campaign', color: 'text-primary' }, warning: { icon: 'warning_amber', color: 'text-tertiary' }, important: { icon: 'error', color: 'text-error' } }" :key="key">
                        <button type="button" @click="selected = key"
                            class="w-10 h-10 flex items-center justify-center border-2 border-on-background transition-all"
                            :class="selected === key ? 'bg-primary-fixed border-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]' : 'bg-surface hover:bg-surface-container'">
                            <span class="material-symbols-outlined text-sm" :class="item.color" x-text="item.icon"></span>
                        </button>
                    </template>
                </div>
                @error('type') <p class="mt-1 font-label-mono text-xs text-error">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="admin-btn-primary admin-btn-sm">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah
            </button>
        </form>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Nama</th>
                        <th class="text-center">Tipe</th>
                        <th class="text-center">Pengumuman</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($announcementCategories as $cat)
                    @php
                        $typeStyles = [
                            'info' => ['icon' => 'campaign', 'color' => 'text-primary'],
                            'warning' => ['icon' => 'warning_amber', 'color' => 'text-tertiary'],
                            'important' => ['icon' => 'error', 'color' => 'text-error'],
                        ];
                        $ts = $typeStyles[$cat->type] ?? $typeStyles['info'];
                    @endphp
                    <tr x-data="{ editing: false }">
                        <td x-show="!editing">
                            <span class="font-body-md text-sm font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm {{ $ts['color'] }}">{{ $ts['icon'] }}</span>
                                {{ $cat->name }}
                            </span>
                        </td>
                        <td x-show="!editing" class="text-center">
                            <span class="material-symbols-outlined text-sm {{ $ts['color'] }}">{{ $ts['icon'] }}</span>
                        </td>
                        <td x-show="!editing" class="text-center">
                            <span class="font-body-md text-sm">{{ $cat->announcements_count }}</span>
                        </td>
                        <td x-show="!editing" class="text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button type="button" @click="editing = true" class="action-btn action-btn-edit" title="Edit">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </button>
                                @if($cat->announcements_count === 0)
                                <form action="{{ route('admin.announcement-categories.destroy', $cat) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" data-confirm-delete data-message="Kategori '{{ $cat->name }}' akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                </form>
                                @else
                                <button type="button" class="action-btn action-btn-delete opacity-30 cursor-not-allowed" title="Masih memiliki {{ $cat->announcements_count }} pengumuman" disabled>
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                                @endif
                            </div>
                        </td>
                        <td x-show="editing" colspan="4" class="bg-surface-container p-3">
                            <form action="{{ route('admin.announcement-categories.update', $cat) }}" method="POST" class="flex items-end gap-3 max-w-lg mx-auto">
                                @csrf @method('PUT')
                                <div class="flex-[2]">
                                    <label class="font-label-mono text-[10px] uppercase text-on-surface-variant block mb-1">Edit Nama</label>
                                    <input type="text" name="name" value="{{ $cat->name }}" class="admin-input w-full text-sm" required>
                                </div>
                                <div class="flex-1" x-data="{ selected: '{{ $cat->type }}' }">
                                    <label class="font-label-mono text-[10px] uppercase text-on-surface-variant block mb-1">Tipe</label>
                                    <input type="hidden" name="type" x-model="selected">
                                    <div class="flex gap-1">
                                        <template x-for="(item, key) in { info: { icon: 'campaign', color: 'text-primary' }, warning: { icon: 'warning_amber', color: 'text-tertiary' }, important: { icon: 'error', color: 'text-error' } }" :key="key">
                                            <button type="button" @click="selected = key"
                                                class="w-9 h-9 flex items-center justify-center border-2 border-on-background transition-all"
                                                :class="selected === key ? 'bg-primary-fixed border-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]' : 'bg-surface hover:bg-surface-container'">
                                                <span class="material-symbols-outlined text-sm" :class="item.color" x-text="item.icon"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                <div class="flex gap-1.5">
                                    <button type="submit" class="admin-btn-primary admin-btn-sm">
                                        <span class="material-symbols-outlined text-sm">check</span>
                                        Simpan
                                    </button>
                                    <button type="button" @click="editing = false" class="admin-btn-ghost admin-btn-sm">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">campaign</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada kategori pengumuman.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($announcementCategories->hasPages())
            <div class="p-3 border-t-3 border-on-background pagination">
                {{ $announcementCategories->links() }}
            </div>
        @endif
    </div>
@endsection
