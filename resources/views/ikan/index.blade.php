@extends('layouts.app')

@section('content')
<!-- PBI-IkanIndex -->
<div id="ikan-page" class="ocean-page uts-page-fish">
    <div class="uts-bg" aria-hidden="true"></div>
    <div class="uts-overlay" aria-hidden="true"></div>
    <div class="caustics" aria-hidden="true"></div>
    <div class="uts-bubbles" aria-hidden="true">
        <span class="b1"></span>
        <span class="b2"></span>
        <span class="b3"></span>
        <span class="b4"></span>
        <span class="b5"></span>
    </div>
    <div class="uts-content">
        <!-- Header -->
        <div class="uts-hero">
            <div>
                <div class="uts-title">Fish Species</div>
                <div class="uts-sub">Explore marine biodiversity — habitats, traits, and conservation status.</div>
            </div>

            <div class="uts-controls">
                <!-- search will be inserted below visually but markup kept here for layout control -->
            </div>
        </div>

        <!-- Search + Sort Controls -->
        <div class="uts-search-row">
            <!-- Search bar (glassmorphism / ocean style) -->
            <div class="uts-search">
                <!--
                    ADD: Search input here. This search bar follows Pinterest-like glassmorphism.
                    Place this block above the card grid and beside the sort dropdown.
                -->
                <div class="uts-search-pill search-pill relative mx-auto">
                    <button id="fish-search-btn" class="uts-search-btn search-icon icon-left" aria-hidden="true">
                        <!-- simple magnifier icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 16.65z" />
                        </svg>
                    </button>
                    <input id="fish-search" type="search" placeholder="Search fish by name..." aria-label="Search fish" class="search-input w-full px-6 py-3 bg-transparent placeholder-ocean-200" />

                    <!-- Decorative bubbles / liquid shapes (non-interactive) -->
                    <span class="search-bubble bubble-1" aria-hidden="true"></span>
                    <span class="search-bubble bubble-2" aria-hidden="true"></span>
                    <span class="search-bubble bubble-3" aria-hidden="true"></span>
                </div>
            </div>

            <!-- Sort dropdown (kept as-is) -->
            <div>
                <select onchange="window.location.href='{{ route('ikan.index') }}?sort=' + this.value" class="uts-sort select select-bordered select-sm">
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
            <div class="uts-grid fish-grid" id="fish-grid">
                @foreach($ikans as $item)
                    <div class="fish-card" data-fish-name="{{ strtolower($item->nama) }}">
                        <div class="fish-card-media">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}" class="fish-image" loading="lazy">
                            @else
                                <div class="fish-placeholder">
                                    <div class="fish-placeholder-icon">🐠</div>
                                    <div class="fish-placeholder-text">{{ $item->nama }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="fish-card-body">
                            <a href="{{ route('ikan.show', $item->id_ikan) }}">
                                <h3 class="fish-name">{{ $item->nama }}</h3>
                            </a>

                            @if($item->habitat)
                                <div class="fish-meta">🌊 {{ $item->habitat }}</div>
                            @endif

                            <div class="fish-desc">{{ $item->deskripsi ?? 'No description' }}</div>

                            @if($item->status_konservasi)
                                <div class="fish-status"><strong>Status:</strong> {{ $item->status_konservasi }}</div>
                            @endif

                            @auth
                                <button class="bookmark-btn-card fish-bookmark" data-type="ikan" data-item-id="{{ $item->id_ikan }}">Bookmark</button>
                            @else
                                <a href="{{ route('login') }}" class="fish-bookmark">Sign in to bookmark</a>
                            @endauth

                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="view-btn">View <span>›</span></a>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="uts-pagination">
                {{ $ikans->appends(request()->query())->links() }}
            </div>

            <!-- Empty state for search -->
            <div id="fish-empty-state" class="fish-empty-state" style="display:none;">No fish found</div>
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
    // mark the page so global nav can adapt styling
    try { document.body.classList.add('page-ikan'); } catch(e){}
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

    /* Live search: filter fish cards by data-fish-name attribute as user types */
    (function setupLiveSearch(){
        const input = document.getElementById('fish-search');
        const button = document.getElementById('fish-search-btn');
        const grid = document.getElementById('fish-grid');
        const emptyState = document.getElementById('fish-empty-state');
        if (!input || !grid) return;

        const cards = Array.from(grid.querySelectorAll('.fish-card'));

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
            let visibleCount = 0;

            if (q === '') {
                cards.forEach(c => { c.style.display = ''; visibleCount++; });
                if (emptyState) emptyState.style.display = 'none';
                return;
            }

            cards.forEach(c => {
                const name = (c.dataset.fishName || c.dataset.name || '').toLowerCase();
                if (name.includes(q)) {
                    c.style.display = '';
                    visibleCount++;
                } else {
                    c.style.display = 'none';
                }
            });

            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        const debouncedFilter = debounce(filterCards, 120);
        input.addEventListener('input', debouncedFilter);

        // prevent Enter from submitting the page
        input.addEventListener('keydown', function(e){ if (e.key === 'Enter') { e.preventDefault(); debouncedFilter(); } });

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
