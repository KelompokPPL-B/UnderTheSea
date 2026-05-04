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
                     @auth
                         {{-- 
                         <a href="{{ route('ekosistem.create') }}">
                             + Create Ecosystem
                         </a>
                         --}}
                     @endauth
            </div>
        </div>

        <!-- Sort Controls -->
        <div class="mb-6 flex justify-end">
            <select onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
            </select>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

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

                            <!-- Bookmark Section -->
                            @auth
                                <div class="pt-2">
                                    <button class="bookmark-btn-card w-full btn btn-outline btn-sm" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}">
                                        <span class="bookmark-text">Bookmark</span>
                                    </button>
                                </div>
                            @else
                                <div class="pt-2">
                                    <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-600 hover:underline font-semibold">Sign in to bookmark</a>
                                </div>
                            @endauth

                            <!-- Action Buttons (View | Edit | Delete) -->
                            <div class="flex items-center gap-3 mt-3 border-t border-ocean-100 pt-3">
                                <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}"
                                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded-lg shadow-md text-sm font-semibold transition">
                                    View
                                </a>

                                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $item->created_by))
                                    <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600">Edit</a>

                                    <form action="{{ route('ekosistem.destroy', $item->id_ekosistem) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ekosistem ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete</button>
                                    </form>
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
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        initializeBookmarkButtonsCard();
        loadBookmarkStatesCard();
    });

    function initializeBookmarkButtonsCard() {
        document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
            btn.addEventListener('click', toggleBookmarkCard);
        });
    }

    function toggleBookmarkCard(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;
        const isBookmarked = btn.classList.contains('bookmarked');

        const method = isBookmarked ? 'DELETE' : 'POST';

        fetch('/favorites', {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({ type: type, item_id: parseInt(itemId) })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                btn.classList.toggle('bookmarked');
                btn.classList.toggle('bg-blue-600');
                btn.classList.toggle('text-white');
                btn.classList.toggle('border-blue-600');
                btn.classList.toggle('text-blue-600');
                btn.classList.toggle('hover:bg-blue-50');
                const text = btn.querySelector('.bookmark-text');
                text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error('Error:', err));
    }

    function loadBookmarkStatesCard() {
        fetch('/favorites', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.data)) {
                document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
                    const type = btn.dataset.type;
                    const itemId = parseInt(btn.dataset.itemId);
                    const isBookmarked = data.data.some(fav => fav.type === type && fav.item_id === itemId);
                    if (isBookmarked) {
                        btn.classList.add('bookmarked', 'bg-blue-600', 'text-white', 'border-blue-600');
                        btn.classList.remove('text-blue-600', 'hover:bg-blue-50');
                        const text = btn.querySelector('.bookmark-text');
                        if (text) text.textContent = 'Bookmarked';
                    }
                });
            }
        })
        .catch(err => console.error('Error loading bookmark state:', err));
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection
