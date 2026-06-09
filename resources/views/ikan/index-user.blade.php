@php
    $fishList = $ikans ?? $ikan ?? collect();

    $currentSort = $sort ?? request('sort', 'newest');

    $sortLabels = [
        'newest' => 'Newest First',
        'oldest' => 'Oldest First',
        'name_asc' => 'Name A–Z',
        'name_desc' => 'Name Z–A',
    ];

    $sortIcons = [
        'newest' => '✨',
        'oldest' => '⏳',
        'name_asc' => '🔤',
        'name_desc' => '🔡',
    ];
@endphp

<style>
    #ikan-page.uts-page-fish {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        background-image:
            linear-gradient(rgba(7, 178, 222, 0.04), rgba(0, 116, 184, 0.08)),
            url('{{ asset("images/ocean-bg.jpg") }}');
        background-size: cover;
        background-position: center top;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: inherit;
    }

    #ikan-page .uts-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(255, 255, 255, 0.08) 0%,
            rgba(0, 177, 219, 0.02) 35%,
            rgba(0, 85, 150, 0.06) 100%
        );
        pointer-events: none;
    }

    #ikan-page .uts-content {
        position: relative;
        z-index: 2;
        max-width: 1050px;
        margin: 0 auto;
        padding: 62px 24px 70px;
    }

    #ikan-page .uts-hero {
        margin-bottom: 20px;
    }

    #ikan-page .uts-title {
        font-size: 40px;
        line-height: 1.1;
        font-weight: 900;
        color: #004b83;
        text-shadow: 0 2px 12px rgba(255,255,255,0.35);
        margin-bottom: 10px;
    }

    #ikan-page .uts-sub {
        color: #075985;
        font-size: 15px;
        font-weight: 500;
    }

    /* SEARCH + SORT */
    #ikan-page .uts-search-row {
        display: flex;
        align-items: center;
        gap: 90px;
        margin: 26px 0 34px;
    }

    #ikan-page .uts-sort-wrap {
        flex: 0 0 190px;
        position: relative;
        z-index: 50;
    }

    #ikan-page .uts-search {
        flex: 1;
        display: flex;
        justify-content: center;
    }

    /* CUSTOM DROPDOWN SORT GEMES */
    #ikan-page .uts-custom-sort {
        position: relative;
        width: 190px;
        z-index: 60;
    }

    #ikan-page .uts-sort-btn {
        width: 100%;
        height: 48px;
        border-radius: 999px;
        border: 2px solid rgba(255, 255, 255, 0.88);
        background: rgba(255, 255, 255, 0.60);
        color: #075985;
        font-weight: 900;
        font-size: 14px;
        padding: 0 15px;
        box-shadow: 0 12px 28px rgba(0, 73, 124, 0.14);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: 0.2s ease;
        outline: none;
    }

    #ikan-page .uts-sort-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 32px rgba(0, 73, 124, 0.20);
        background: rgba(255, 255, 255, 0.75);
    }

    #ikan-page .uts-sort-btn:focus,
    #ikan-page .uts-sort-btn:focus-visible {
        outline: none;
        box-shadow:
            0 12px 28px rgba(0, 73, 124, 0.16),
            0 0 0 3px rgba(255, 255, 255, 0.42);
    }

    #ikan-page .sort-left {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    #ikan-page .sort-icon {
        width: 27px;
        height: 27px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.70);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
    }

    #ikan-page .sort-arrow {
        width: 24px;
        height: 24px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.55);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        line-height: 1;
        transition: 0.2s ease;
    }

    #ikan-page .uts-custom-sort.open .sort-arrow {
        transform: rotate(180deg);
        background: rgba(14, 165, 233, 0.15);
    }

    #ikan-page .uts-sort-menu {
        position: absolute;
        top: calc(100% + 10px);
        left: 0;
        width: 220px;
        padding: 10px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.86);
        border: 1px solid rgba(255, 255, 255, 0.92);
        box-shadow: 0 18px 42px rgba(0, 73, 124, 0.24);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px) scale(0.97);
        transition: 0.2s ease;
        overflow: hidden;
    }

    #ikan-page .uts-custom-sort.open .uts-sort-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
    }

    #ikan-page .uts-sort-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 12px;
        border-radius: 15px;
        color: #075985;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: 0.18s ease;
    }

    #ikan-page .uts-sort-item span:first-child {
        width: 25px;
        height: 25px;
        border-radius: 999px;
        background: rgba(14, 165, 233, 0.10);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    #ikan-page .uts-sort-item:hover {
        background: rgba(14, 165, 233, 0.12);
        transform: translateX(3px);
    }

    #ikan-page .uts-sort-item.active {
        background: linear-gradient(90deg, #008ce3, #0065c9);
        color: white;
        box-shadow: 0 8px 18px rgba(0, 101, 201, 0.22);
    }

    #ikan-page .uts-sort-item.active span:first-child {
        background: rgba(255, 255, 255, 0.25);
    }

    #ikan-page .uts-search-pill {
        width: min(520px, 100%);
        height: 48px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        position: relative;
        background: rgba(255, 255, 255, 0.55);
        border: 2px solid rgba(255, 255, 255, 0.82);
        box-shadow: 0 12px 28px rgba(0, 73, 124, 0.13);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        overflow: hidden;
        transition: 0.2s ease;
    }

    #ikan-page .uts-search-pill:focus-within {
        border-color: rgba(255, 255, 255, 0.98);
        box-shadow:
            0 12px 28px rgba(0, 73, 124, 0.16),
            0 0 0 3px rgba(255, 255, 255, 0.38);
    }

    #ikan-page .uts-search-btn {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f86c8;
        border: none;
        background: transparent;
        cursor: pointer;
        flex-shrink: 0;
        outline: none;
        box-shadow: none;
    }

    #ikan-page .uts-search-btn:focus,
    #ikan-page .uts-search-btn:focus-visible,
    #ikan-page .uts-search-btn:active {
        outline: none;
        border: none;
        box-shadow: none;
    }

    #ikan-page .search-input {
        width: 100%;
        height: 100%;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        color: #075985;
        font-weight: 700;
        background: transparent !important;
        padding: 0 18px 0 0;
        font-size: 14px;
        appearance: none;
        -webkit-appearance: none;
    }

    #ikan-page .search-input:focus,
    #ikan-page .search-input:focus-visible,
    #ikan-page .search-input:active {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }

    #ikan-page .search-input::-webkit-search-decoration,
    #ikan-page .search-input::-webkit-search-cancel-button,
    #ikan-page .search-input::-webkit-search-results-button,
    #ikan-page .search-input::-webkit-search-results-decoration {
        display: none;
    }

    #ikan-page .search-input::placeholder {
        color: rgba(7, 89, 133, 0.52);
        font-weight: 700;
    }

    /* CARD GRID */
    #ikan-page .uts-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    #ikan-page .fish-card {
        min-height: 315px;
        border-radius: 20px;
        overflow: hidden;
        background: rgba(241, 253, 255, 0.88);
        border: 1px solid rgba(255, 255, 255, 0.78);
        box-shadow: 0 16px 30px rgba(0, 61, 110, 0.15);
        display: flex;
        flex-direction: column;
        transition: 0.25s ease;
    }

    #ikan-page .fish-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 24px 42px rgba(0, 61, 110, 0.24);
    }

    #ikan-page .fish-card-media {
        height: 145px;
        background: rgba(225, 248, 255, 0.85);
        position: relative;
        overflow: hidden;
    }

    #ikan-page .fish-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    #ikan-page .fish-placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #0b6fa4;
        font-weight: 800;
    }

    #ikan-page .fish-placeholder-icon {
        font-size: 42px;
        margin-bottom: 6px;
    }

    #ikan-page .fish-placeholder-text {
        font-size: 14px;
    }

    #ikan-page .fish-card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    #ikan-page .fish-name {
        color: #004b83;
        font-size: 17px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    #ikan-page .fish-meta {
        font-size: 12px;
        color: #075985;
        font-weight: 700;
        margin-bottom: 8px;
    }

    #ikan-page .fish-desc {
        font-size: 12px;
        line-height: 1.45;
        color: #0f3f5f;
        margin-bottom: 10px;
        min-height: 36px;
    }

    #ikan-page .fish-status {
        font-size: 12px;
        color: #0f3f5f;
        margin-bottom: 12px;
    }

    #ikan-page .fish-status strong {
        color: #004b83;
    }

    #ikan-page .fish-bookmark {
        color: #0077c8;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 12px;
        display: inline-block;
        text-decoration: none;
        background: transparent;
        border: none;
        text-align: left;
        cursor: pointer;
        padding: 0;
    }

    #ikan-page .view-btn {
        margin-top: auto;
        display: block;
        width: 100%;
        text-align: center;
        background: linear-gradient(90deg, #008ce3, #0065c9);
        color: white;
        font-weight: 900;
        font-size: 13px;
        padding: 11px 14px;
        border-radius: 15px;
        text-decoration: none;
        box-shadow: 0 10px 18px rgba(0, 101, 201, 0.25);
    }

    #ikan-page .view-btn:hover {
        filter: brightness(1.08);
        transform: translateY(-1px);
    }

    #ikan-page .uts-pagination {
        margin-top: 28px;
        display: flex;
        justify-content: center;
    }

    #ikan-page .fish-empty-state {
        margin-top: 22px;
        background: rgba(255,255,255,0.75);
        border-radius: 18px;
        padding: 22px;
        text-align: center;
        color: #075985;
        font-weight: 800;
        box-shadow: 0 12px 24px rgba(0, 73, 124, 0.12);
    }

    @media (max-width: 900px) {
        #ikan-page .uts-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        #ikan-page .uts-search-row {
            flex-direction: column;
            align-items: stretch;
            gap: 16px;
        }

        #ikan-page .uts-sort-wrap {
            flex: unset;
            width: 100%;
        }

        #ikan-page .uts-custom-sort {
            width: 100%;
        }

        #ikan-page .uts-sort-menu {
            width: 100%;
        }

        #ikan-page .uts-search {
            justify-content: stretch;
        }

        #ikan-page .uts-search-pill {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        #ikan-page .uts-content {
            padding: 40px 16px 60px;
        }

        #ikan-page .uts-title {
            font-size: 32px;
        }
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.18); }
        28% { transform: scale(1); }
        42% { transform: scale(1.18); }
        70% { transform: scale(1); }
    }
    .animate-heart-beat {
        animation: heartBeat 0.45s ease-in-out;
    }
    #ikan-page .filter-pills-wrap {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: center;
        gap: 12px;
        margin-bottom: 40px;
        position: relative;
        z-index: 30;
    }
</style>

<div id="ikan-page" class="ocean-page uts-page-fish">
    <div class="uts-overlay" aria-hidden="true"></div>

    <div class="uts-content">
        <div class="uts-hero">
            <div>
                <div class="uts-title">Fish Species</div>
                <div class="uts-sub">Explore marine biodiversity — habitats, traits, and conservation status.</div>
            </div>
        </div>

        <div class="uts-search-row">
            <div class="uts-sort-wrap">
                <div class="uts-custom-sort" id="fishSortBox">
                    <button type="button" class="uts-sort-btn" id="fishSortBtn">
                        <span class="sort-left">
                            <span class="sort-icon">{{ $sortIcons[$currentSort] ?? '✨' }}</span>
                            <span>{{ $sortLabels[$currentSort] ?? 'Newest First' }}</span>
                        </span>

                        <span class="sort-arrow">⌄</span>
                    </button>

                    <div class="uts-sort-menu" id="fishSortMenu">
                        <a href="{{ route('ikan.index', array_merge(request()->query(), ['sort' => 'newest'])) }}"
                           class="uts-sort-item {{ $currentSort === 'newest' ? 'active' : '' }}">
                            <span>✨</span>
                            <strong>Newest First</strong>
                        </a>

                        <a href="{{ route('ikan.index', array_merge(request()->query(), ['sort' => 'oldest'])) }}"
                           class="uts-sort-item {{ $currentSort === 'oldest' ? 'active' : '' }}">
                            <span>⏳</span>
                            <strong>Oldest First</strong>
                        </a>

                        <a href="{{ route('ikan.index', array_merge(request()->query(), ['sort' => 'name_asc'])) }}"
                           class="uts-sort-item {{ $currentSort === 'name_asc' ? 'active' : '' }}">
                            <span>🔤</span>
                            <strong>Name A–Z</strong>
                        </a>

                        <a href="{{ route('ikan.index', array_merge(request()->query(), ['sort' => 'name_desc'])) }}"
                           class="uts-sort-item {{ $currentSort === 'name_desc' ? 'active' : '' }}">
                            <span>🔡</span>
                            <strong>Name Z–A</strong>
                        </a>
                    </div>
                </div>
            </div>

            <div class="uts-search">
                <div class="uts-search-pill">
                    <button id="fish-search-btn" class="uts-search-btn" aria-label="Search fish" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 11116.65 16.65z" />
                        </svg>
                    </button>

                    <input
                        id="fish-search"
                        type="search"
                        placeholder="Search fish by name..."
                        aria-label="Search fish"
                        class="search-input"
                    />
                </div>
            </div>
        </div>

        <!-- Likes & Bookmarks Filter Pills -->
        <div class="filter-pills-wrap">
            <!-- Likes Filter Button -->
            @if(request('filter_likes') !== null)
                <a href="{{ request()->fullUrlWithQuery(['filter_likes' => null]) }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#009ee2] hover:bg-[#0089c4] text-white font-bold text-sm shadow-md transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-white" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>Like Saya</span>
                </a>
            @else
                <button type="button" id="btn-filter-likes"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-700 font-bold text-sm shadow-sm hover:bg-gray-50 transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>Like Saya</span>
                </button>
            @endif

            <!-- Bookmarks Filter Button -->
            @if(request('filter_bookmarks') !== null)
                <a href="{{ request()->fullUrlWithQuery(['filter_bookmarks' => null]) }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#009ee2] hover:bg-[#0089c4] text-white font-bold text-sm shadow-md transform hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-white" viewBox="0 0 24 24">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                    </svg>
                    <span>Bookmark Saya</span>
                </a>
            @else
                <button type="button" id="btn-filter-bookmarks"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-gray-200 text-gray-700 font-bold text-sm shadow-sm hover:bg-gray-50 transform hover:-translate-y-0.5 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span>Bookmark Saya</span>
                </button>
            @endif
        </div>

        @if($fishList->isEmpty())
            <div class="fish-empty-state">
                No fish species found yet.
            </div>
        @else
            <div class="uts-grid fish-grid" id="fish-grid">
                @foreach($fishList as $item)
                    <div class="fish-card" data-fish-name="{{ strtolower($item->nama) }}">
                        <div class="fish-card-media relative">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="fish-image" loading="lazy">
                            @else
                                <div class="fish-placeholder">
                                    <div class="fish-placeholder-icon">🐠</div>
                                    <div class="fish-placeholder-text">{{ $item->nama }}</div>
                                </div>
                            @endif

                            <!-- Floating Like & Bookmark Buttons -->
                            <div class="absolute top-3 right-3 z-20 flex gap-1.5">
                                <!-- Like Button -->
                                <button type="button" 
                                    class="w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 btn-like focus:outline-none" 
                                    data-id="{{ $item->id_ikan }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>

                                <!-- Bookmark Button -->
                                <button type="button" 
                                    class="w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 btn-bookmark focus:outline-none" 
                                    data-id="{{ $item->id_ikan }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="fish-card-body">
                            <a href="{{ route('ikan.show', $item->id_ikan) }}">
                                <h3 class="fish-name">{{ $item->nama }}</h3>
                            </a>

                            @if($item->habitat)
                                <div class="fish-meta">🌊 {{ $item->habitat }}</div>
                            @endif

                            <div class="fish-desc">
                                {{ $item->deskripsi ?? 'No description' }}
                            </div>

                            @if($item->status_konservasi)
                                <div class="fish-status">
                                    <strong>Status:</strong> {{ $item->status_konservasi }}
                                </div>
                            @endif

                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="view-btn">
                                View <span>›</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="uts-pagination">
                {{ $fishList->appends(request()->query())->links() }}
            </div>

            <div id="fish-empty-state" class="fish-empty-state" style="display:none;">
                No fish found
            </div>
        @endif
    </div>
</div>

<script>
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

document.addEventListener('DOMContentLoaded', function() {
    try {
        document.body.classList.add('page-ikan');
    } catch(e) {}

    initializeFishSortDropdown();
    initializeLikesAndBookmarks();
    initializeBookmarkButtonsCard();
    loadBookmarkStatesCard();
    setupLiveSearch();
});

function initializeFishSortDropdown() {
    const sortBox = document.getElementById('fishSortBox');
    const sortBtn = document.getElementById('fishSortBtn');

    if (!sortBox || !sortBtn) return;

    sortBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        sortBox.classList.toggle('open');
    });

    document.addEventListener('click', function(e) {
        if (!sortBox.contains(e.target)) {
            sortBox.classList.remove('open');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            sortBox.classList.remove('open');
        }
    });
}

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
        body: JSON.stringify({
            type: type,
            item_id: parseInt(itemId)
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            btn.classList.toggle('bookmarked');

            const text = btn.querySelector('.bookmark-text');
            if (text) {
                text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
            }
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
                    btn.classList.add('bookmarked');

                    const text = btn.querySelector('.bookmark-text');
                    if (text) text.textContent = 'Bookmarked';
                }
            });
        }
    })
    .catch(err => console.error('Error loading bookmark state:', err));
}

function initializeLikesAndBookmarks() {
    const SVG_HEART_EMPTY = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>`;
    const SVG_HEART_FILLED = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#ef4444] fill-current animate-heart-beat" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;

    const SVG_BOOKMARK_EMPTY = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>`;
    const SVG_BOOKMARK_FILLED = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#009ee2] fill-current" viewBox="0 0 24 24"><path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z"/></svg>`;

    function getLikedIkans() {
        try {
            return JSON.parse(localStorage.getItem('liked_ikans')) || [];
        } catch (e) {
            return [];
        }
    }

    function setLikedIkans(ids) {
        localStorage.setItem('liked_ikans', JSON.stringify(ids));
    }

    function getBookmarkedIkans() {
        try {
            return JSON.parse(localStorage.getItem('bookmarked_ikans')) || [];
        } catch (e) {
            return [];
        }
    }

    function setBookmarkedIkans(ids) {
        localStorage.setItem('bookmarked_ikans', JSON.stringify(ids));
    }

    const likedIds = getLikedIkans();
    document.querySelectorAll('.btn-like').forEach(btn => {
        const id = parseInt(btn.dataset.id);
        if (likedIds.includes(id)) {
            btn.classList.add('liked');
            btn.innerHTML = SVG_HEART_FILLED;
        } else {
            btn.innerHTML = SVG_HEART_EMPTY;
        }
    });

    const bookmarkedIds = getBookmarkedIkans();
    document.querySelectorAll('.btn-bookmark').forEach(btn => {
        const id = parseInt(btn.dataset.id);
        if (bookmarkedIds.includes(id)) {
            btn.classList.add('bookmarked');
            btn.innerHTML = SVG_BOOKMARK_FILLED;
        } else {
            btn.innerHTML = SVG_BOOKMARK_EMPTY;
        }
    });

    document.querySelectorAll('.btn-like').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            let currentLikes = getLikedIkans();
            
            if (currentLikes.includes(id)) {
                currentLikes = currentLikes.filter(item => item !== id);
                this.classList.remove('liked');
                this.innerHTML = SVG_HEART_EMPTY;
            } else {
                currentLikes.push(id);
                this.classList.add('liked');
                this.innerHTML = SVG_HEART_FILLED;
            }
            setLikedIkans(currentLikes);
        });
    });

    document.querySelectorAll('.btn-bookmark').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            let currentBookmarks = getBookmarkedIkans();
            
            if (currentBookmarks.includes(id)) {
                currentBookmarks = currentBookmarks.filter(item => item !== id);
                this.classList.remove('bookmarked');
                this.innerHTML = SVG_BOOKMARK_EMPTY;
            } else {
                currentBookmarks.push(id);
                this.classList.add('bookmarked');
                this.innerHTML = SVG_BOOKMARK_FILLED;
            }
            setBookmarkedIkans(currentBookmarks);
        });
    });

    const btnFilterLikes = document.getElementById('btn-filter-likes');
    if (btnFilterLikes) {
        btnFilterLikes.addEventListener('click', function() {
            const liked = getLikedIkans();
            const likedQuery = liked.join(',');
            
            const url = new URL(window.location.href);
            url.searchParams.set('filter_likes', likedQuery);
            url.searchParams.delete('filter_bookmarks');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }

    const btnFilterBookmarks = document.getElementById('btn-filter-bookmarks');
    if (btnFilterBookmarks) {
        btnFilterBookmarks.addEventListener('click', function() {
            const bookmarked = getBookmarkedIkans();
            const bookmarkedQuery = bookmarked.join(',');
            
            const url = new URL(window.location.href);
            url.searchParams.set('filter_bookmarks', bookmarkedQuery);
            url.searchParams.delete('filter_likes');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }
}
</script>