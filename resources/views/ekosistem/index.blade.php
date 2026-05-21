@extends('layouts.app')

@section('content')
<!-- PBI-EkosistemIndex -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-3">Marine Ecosystems</h1>
                <p class="text-gray-600">Discover the diverse ecosystems that make up our oceans and learn about their importance.</p>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('ekosistem.create') }}" class="btn btn-primary btn-sm">+ Add New Ecosystem</a>
                @endif
            @endauth
        </div>

        <!-- Sort Controls -->
        <div class="mb-6 flex justify-end">
            <select onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
            </select>
        </div>

        @if($ekosistem->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No ecosystems found yet.</p>
            </div>
        @else
            <!-- Ecosystems Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ekosistem as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden">
                        <!-- Image -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <!-- Title -->
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->nama_ekosistem }}</h3>
                            </a>

                            <!-- Location -->
                            @if($item->lokasi)
                                <p class="text-xs text-gray-500 font-semibold">📍 {{ $item->lokasi }}</p>
                            @endif

                            <!-- Description -->
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            <!-- Role -->
                            @if($item->peran)
                                <div class="pt-2 border-t border-ocean-100">
                                    <p class="text-xs text-gray-600"><span class="font-semibold">Role:</span> <span class="line-clamp-1">{{ $item->peran }}</span></p>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="btn btn-outline btn-sm">Edit</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $ekosistem->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Global helper - harus di luar module
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-btn-card').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.ekosistemId;
            if (!confirm("Yakin mau hapus data ini?")) return;

            fetch(`/ekosistem/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if (res.ok) {
                    location.reload();
                } else {
                    alert("Gagal menghapus data");
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>

@endpush
@endsection
