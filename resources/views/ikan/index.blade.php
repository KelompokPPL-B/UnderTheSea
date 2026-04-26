@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-3">Fish Species</h1>
                <p class="text-gray-600">Explore the diverse and fascinating fish species in our oceans.</p>
            </div>
            @auth
                <a href="{{ route('ikan.create') }}" class="btn btn-primary btn-sm">+ Add New Fish</a>
            @endauth
        </div>

        <!-- Sort Controls -->
        <div class="mb-6 flex justify-end">
            <select onchange="window.location.href='{{ route('ikan.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
            </select>
        </div>

        @if($ikan->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No fish species found yet.</p>
            </div>
        @else
            <!-- Fish Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ikan as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden">
                        <!-- Image -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->nama }}</h3>
                            </a>

                            @if($item->habitat)
                                <p class="text-xs text-gray-500 font-semibold">🌊 {{ $item->habitat }}</p>
                            @endif

                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            @if($item->status_konservasi)
                                <div class="pt-2 border-t border-ocean-100">
                                    <p class="text-xs"><span class="font-semibold text-ocean-900">Status:</span> <span class="text-gray-600">{{ $item->status_konservasi }}</span></p>
                                </div>
                            @endif

                            @auth
                                <div class="pt-2">
                                    <button class="bookmark-btn-card w-full btn btn-outline btn-sm" data-type="ikan" data-item-id="{{ $item->id_ikan }}">
                                        <span class="bookmark-text">Bookmark</span>
                                    </button>
                                </div>
                            @else
                                <div class="pt-2">
                                    <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-600 hover:underline font-semibold">Sign in to bookmark</a>
                                </div>
                            @endauth

                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('ikan.edit', $item->id_ikan) }}" class="btn btn-outline btn-sm">Edit</a>
                                        <button class="delete-btn-card btn btn-error btn-sm" data-ikan-id="{{ $item->id_ikan }}">Delete</button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $ikan->appends(request()->query())->links() }}
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
            headers: { 'X-CSRF-TOKEN': getCsrfToken() }
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