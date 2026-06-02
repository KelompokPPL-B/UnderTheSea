@extends('layouts.app')

@section('content')
<!-- PBI-IkanIndex -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-3">Marine Fish</h1>
                <p class="text-gray-600">Discover various fish species and learn about their habitat, food, and characteristics.</p>
            </div>
        </div>

        <!-- Search + Sort Controls -->
        <div class="mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Search bar (glassmorphism / ocean style) -->
            <div class="w-full sm:max-w-xl">
                <!--
                    ADD: Search input here. This search bar follows Pinterest-like glassmorphism.
                    Place this block above the card grid and beside the sort dropdown.
                -->
                <div class="search-pill relative mx-auto">
                    <input id="fish-search" type="search" placeholder="Search fish by name..." aria-label="Search fish" class="search-input w-full px-6 py-3 bg-transparent placeholder-ocean-200 text-ocean-900" />
                    <button id="fish-search-btn" class="search-icon" aria-hidden="true">
                        <!-- simple magnifier icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ocean-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 16.65z" />
                        </svg>
                    </button>

                    <!-- Decorative bubbles / liquid shapes (non-interactive) -->
                    <span class="search-bubble bubble-1" aria-hidden="true"></span>
                    <span class="search-bubble bubble-2" aria-hidden="true"></span>
                    <span class="search-bubble bubble-3" aria-hidden="true"></span>
                </div>
            </div>

            <!-- Sort dropdown (kept as-is) -->
            <div class="flex-shrink-0">
                <select onchange="window.location.href='{{ route('ikan.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                </select>
            </div>
        </div>

        @if($ikans->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No fish species found yet.</p>
            </div>
        @else
            <!-- Fish Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="fish-grid">
                @foreach($ikans as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden" data-name="{{ strtolower($item->nama) }}">
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
                            <!-- Title -->
                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->nama }}</h3>
                            </a>

                            <!-- Habitat -->
                            @if($item->habitat)
                                <p class="text-xs text-gray-500 font-semibold">🌊 {{ $item->habitat }}</p>
                            @endif

                            <!-- Description -->
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            <!-- Conservation Status -->
                            @if($item->status_konservasi)
                                <div class="pt-2 border-t border-ocean-100">
                                    <p class="text-xs"><span class="font-semibold text-ocean-900">Status:</span> <span class="text-gray-600">{{ $item->status_konservasi }}</span></p>
                                </div>
                            @endif

                            <!-- Bookmark Section -->
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

                            <!-- Action Buttons -->
                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('ikan.edit', $item->id_ikan) }}" class="btn btn-outline btn-sm">Edit</a>
                                    <button class="delete-btn-card btn btn-error btn-sm" data-ikan-id="{{ $item->id_ikan }}">Delete</button>
                                @endif
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

@endsection

@push('scripts')
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('.delete-btn-card')) {
        const btn = e.target.closest('.delete-btn-card');
        const id = btn.dataset.id;
        if (!confirm('Delete this fish?')) return;

        fetch(`/ikan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            }
        }).then(r => r.json()).then(data => {
            if (data.status === 'success') {
                window.location.reload();
            } else {
                alert(data.message || 'Delete failed');
            }
        }).catch(() => alert('Delete failed'));
    }
});

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
            'Accept': 'application/json'
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
            if (text) text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
        } else {
            alert(data.message || 'Failed to update bookmark');
        }
    })
    .catch(err => console.error('Error:', err));
}

function loadBookmarkStatesCard() {
    fetch('/favorites', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
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

    /* Live search: filter fish cards by data-name attribute as user types */
    (function setupLiveSearch(){
        const input = document.getElementById('fish-search');
        const button = document.getElementById('fish-search-btn');
        const grid = document.getElementById('fish-grid');
        if (!input || !grid) return;

        const cards = Array.from(grid.children);

        // simple debounce
        function debounce(fn, wait){
            let t;
            return function(...args){
                clearTimeout(t);
                t = setTimeout(()=>fn.apply(this,args), wait);
            };
        }

        function filterCards() {
            const q = input.value.trim().toLowerCase();
            if (q === '') {
                // show all
                cards.forEach(c => c.style.display = '');
                return;
            }
            cards.forEach(c => {
                const name = (c.dataset.name || '').toLowerCase();
                if (name.includes(q)) {
                    c.style.display = '';
                } else {
                    c.style.display = 'none';
                }
            });
        }

        const debouncedFilter = debounce(filterCards, 180);
        input.addEventListener('input', debouncedFilter);

        // make search button focus the input (mobile friendly)
        if (button) {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                input.focus();
            });
        }
    })();
</script>
@endpush
