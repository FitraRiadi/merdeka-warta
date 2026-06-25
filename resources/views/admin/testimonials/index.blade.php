@extends('admin.layouts.admin')

@section('title', 'Testimoni - Panel Admin')
@section('page_title', 'Testimoni')
@section('page_description', 'Kelola testimoni dan quotes')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="font-label-mono text-xs uppercase text-on-surface-variant">
            Total: <span class="font-bold text-on-surface">{{ $testimonials->total() }}</span> testimoni
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-primary admin-btn-sm">
            <span class="material-symbols-outlined text-sm">add</span>
            Tambah Testimoni
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th class="text-left">Kutipan</th>
                        <th class="text-left hidden sm:table-cell">Penulis</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td>
                                <div class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-secondary shrink-0 mt-0.5">format_quote</span>
                                    <div class="min-w-0">
                                        <p class="font-body-md text-sm italic truncate">{{ $testimonial->quote }}</p>
                                        <p class="font-label-mono text-[10px] text-on-surface-variant mt-0.5">{{ $testimonial->author_name }} {{ $testimonial->author_role ? '- ' . $testimonial->author_role : '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell">
                                <span class="font-body-md text-sm">{{ $testimonial->author_name }}</span>
                            </td>
                            <td class="text-center">
                                @if($testimonial->is_active)
                                    <span class="admin-badge bg-green-100 text-green-700 border-green-700">Aktif</span>
                                @else
                                    <span class="admin-badge bg-gray-100 text-gray-600 border-gray-400">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="action-btn action-btn-edit" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" data-confirm-delete data-message="Testimoni ini akan dihapus!" class="action-btn action-btn-delete" title="Hapus">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="py-12 text-center">
                                    <div class="empty-state-icon">
                                        <span class="material-symbols-outlined text-2xl text-on-surface-variant">format_quote</span>
                                    </div>
                                    <p class="font-body-md text-sm text-on-surface-variant">Belum ada testimoni.</p>
                                    <a href="{{ route('admin.testimonials.create') }}" class="admin-btn-primary admin-btn-sm mt-4 inline-flex">Tambah Testimoni</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($testimonials->hasPages())
        <div class="mt-6 pagination">
            {{ $testimonials->links() }}
        </div>
    @endif
@endsection
