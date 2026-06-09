@extends('layouts.app')

@section('content')
@php
    $currentSort = $sort ?? request('sort', 'newest');
    $currentTahun = $filterTahun ?? request('tahun', '');
    $tahunOptions = $tahunList ?? collect();
@endphp

<div class="py-16 bg-gradient-to-br from-slate-50 via-blue-50 to-emerald-50 min-h-screen relative overflow-x-hidden">

    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-ocean-600/5 to-transparent pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>
    <div class="absolute top-48 -left-24 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>

    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 xl:px-12 2xl:px-16 relative z-10">

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-block py-1 px-3 rounded-full bg-ocean-100 text-ocean-700 font-bold tracking-wider uppercase text-xs mb-4">
                Eksplorasi Kelautan
            </span>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-5 leading-tight tracking-tight">
                Katalog
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-600 to-emerald-500">
                    Aksi
                </span>
            </h1>

            <p class="text-lg text-gray-600 font-medium mb-6">
                Bergabunglah dalam aksi pelestarian laut untuk melindungi keanekaragaman hayati dan ekosistem kita.
            </p>

            <!-- Search + Sort Header -->
            <div class="flex flex-col md:flex-row justify-center items-center gap-4 w-full mt-6 max-w-4xl mx-auto px-4 z-30 relative">
                <form method="GET" action="{{ route('aksi.index') }}" class="w-full md:flex-1 max-w-2xl relative group search-form animate-fade-in" novalidate>
                    <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>

                    <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                        <span class="pl-5 pr-2 text-2xl">🙌</span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari aksi, gerakan, atau kampanye..."
                            class="w-full bg-transparent border-none focus:ring-0 px-2 py-3 text-ocean-900 placeholder-ocean-400 font-medium outline-none search-input"
                        >

                        <input type="hidden" name="sort" value="{{ $currentSort }}">
                        <input type="hidden" name="tahun" value="{{ $currentTahun }}">

                        <button
                            type="submit"
                            class="bg-gradient-to-r from-ocean-600 to-blue-500 hover:from-ocean-700 hover:to-blue-600 text-white px-8 py-3 rounded-full font-bold tracking-wide shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center gap-2 animate-shimmer"
                        >
                            <span>Search</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>

                    <div class="search-error-msg text-red-500 text-sm font-semibold mt-2 pl-6 hidden text-left"></div>
                </form>
            </div>

            <!-- Likes & Bookmarks Filter Pills -->
            <div class="flex flex-wrap justify-center items-center gap-3 mt-6 relative z-30">
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
        </div>


        <div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen rounded-[2rem]">
            <div class="max-w-7xl mx-auto px-6 py-6">

                <div class="flex justify-between items-start mb-10">
                    <div>
                        <h1 class="text-4xl font-bold text-ocean-900 mb-3">Conservation Actions</h1>
                        <p class="text-gray-600">Join the movement for ocean conservation. Explore actions you can take today.</p>
                    </div>

                    <div class="flex items-center gap-2.5">
                        @guest
                            <a href="{{ route('aksi.riwayat') }}"
                               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-ocean-300 bg-white hover:bg-ocean-50 text-ocean-700 text-sm font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300 whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-ocean-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <span>My History</span>
                            </a>
                        @endguest

                        @auth
                            <a href="{{ route('aksi.create') }}" class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-bold py-2.5 px-5 rounded-xl shadow-md hover:shadow-emerald-500/20 transform hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 text-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Aksi
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Filter & Sort -->
                <form method="GET" action="{{ route('aksi.index') }}" class="mb-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-ocean-100 p-8">
                        <p class="text-xs font-bold text-ocean-500 uppercase tracking-widest mb-8">
                            🔍 Filter & Sort
                        </p>

                        <div class="flex flex-wrap items-end gap-8">
                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sort By</label>
                                <select name="sort" class="select select-bordered w-52">
                                    <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="oldest" {{ $currentSort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                    <option value="popular" {{ $currentSort === 'popular' ? 'selected' : '' }}>Most Popular</option>
                                    <option value="title_asc" {{ $currentSort === 'title_asc' ? 'selected' : '' }}>Title A–Z</option>
                                    <option value="title_desc" {{ $currentSort === 'title_desc' ? 'selected' : '' }}>Title Z–A</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Year</label>
                                <select name="tahun" class="select select-bordered w-52">
                                    <option value="">All Years</option>
                                    @foreach($tahunOptions as $tahun)
                                        <option value="{{ $tahun }}" {{ $currentTahun == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="search" value="{{ request('search') }}">

                            <div class="ml-10 flex items-end gap-4">
                                <button type="submit" class="btn h-12 min-h-12 px-6 text-sm font-semibold text-white" style="background:#0e7490;border:none;border-radius:10px;">
                                    Apply
                                </button>

                                <a href="{{ route('aksi.index') }}" class="btn btn-ghost h-12 min-h-12 px-6 text-sm font-semibold text-gray-500">
                                    Reset
                                </a>
                            </div>
                        </div>

                        @if($currentTahun || $currentSort !== 'newest')
                            <div class="mt-6 flex flex-wrap items-center gap-2">
                                <span class="text-xs text-gray-400 font-medium">Active Filters:</span>

                                @if($currentSort !== 'newest')
                                    <span class="badge badge-sm" style="background:#f0f9ff;color:#0369a1;border:none;">
                                        Sort:
                                        {{ match($currentSort) {
                                            'oldest'     => 'Oldest First',
                                            'popular'    => 'Most Popular',
                                            'title_asc'  => 'Title A–Z',
                                            'title_desc' => 'Title Z–A',
                                            default      => 'Newest First'
                                        } }}
                                    </span>
                                @endif

                                @if($currentTahun)
                                    <span class="badge badge-sm" style="background:#e0f2fe;color:#0369a1;border:none;">
                                        🗓️ Tahun: {{ $currentTahun }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </form>

                {{-- Search Result Info --}}
                @if(request('search'))
                    <div class="mb-8 flex items-center justify-between bg-white/60 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/50 shadow-sm animate-fade-in">
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                            </span>
                            <span class="text-sm font-semibold text-slate-700">
                                Menampilkan hasil untuk:
                                <span class="text-cyan-600 font-bold">"{{ request('search') }}"</span>
                            </span>
                        </div>

                        <a href="{{ route('aksi.index') }}" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 transition-all flex items-center gap-1.5 hover:scale-105 active:scale-95">
                            Reset Pencarian 🔄
                        </a>
                    </div>
                @endif

                <style>
                    @keyframes fadeIn {
                        from { opacity: 0; transform: translateY(16px); }
                        to { opacity: 1; transform: translateY(0); }
                    }
                    .animate-fade-in {
                        animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                    }
                    @keyframes shimmer {
                        100% { transform: translateX(350%) skewX(-12deg); }
                    }
                    .shimmer-btn:hover .shimmer-bar {
                        animation: shimmer 1s ease-out;
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
                </style>

                @if($aksi->isEmpty())
                    <div class="bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-2xl p-12 md:p-16 text-center max-w-2xl mx-auto animate-fade-in">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner animate-bounce">
                            🐠
                        </div>

                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Data Tidak Ditemukan</h3>

                        <p class="text-slate-600 font-medium max-w-md mx-auto mb-8">
                            {{ request('search') ? 'Pencarian Anda tidak menghasilkan data yang sesuai. Coba gunakan kata kunci lain.' : 'Belum ada data aksi pelestarian laut yang terdaftar di sistem.' }}
                        </p>

                        @if(request('search'))
                            <a href="{{ route('aksi.index') }}" class="shimmer-btn relative group overflow-hidden inline-flex items-center gap-2.5 bg-gradient-to-r from-teal-500 via-ocean-600 to-blue-600 text-white font-black text-sm uppercase tracking-wider py-4 px-10 rounded-full shadow-[0_10px_30px_-10px_rgba(8,145,178,0.5)] hover:shadow-[0_20px_40px_-10px_rgba(8,145,178,0.7)] hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 w-1/3 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -skew-x-12 -translate-x-full shimmer-bar pointer-events-none"></div>

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-180 transition-transform duration-700 ease-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18" />
                                </svg>

                                <span>Reset Pencarian</span>
                            </a>
                        @endif
                    </div>
                @else
                    <!-- Grid Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                        @foreach($aksi as $item)
                            <div class="group bg-white rounded-[1.5rem] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_40px_-8px_rgba(0,0,0,0.15)] border border-gray-100/80 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1.5">

                                <!-- Card Image -->
                                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul_aksi }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110" loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ocean-50 text-6xl">
                                            🌊
                                        </div>
                                    @endif

                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300 pointer-events-none"></div>

                                    <!-- Floating Like & Bookmark Buttons -->
                                    <div class="absolute top-5 right-5 z-20 flex gap-2">
                                        <!-- Like Button -->
                                        <button type="button" 
                                            class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 btn-like focus:outline-none" 
                                            data-id="{{ $item->id_aksi }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>

                                        <!-- Bookmark Button -->
                                        <button type="button" 
                                            class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 active:scale-95 transition-all duration-300 btn-bookmark focus:outline-none" 
                                            data-id="{{ $item->id_aksi }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-6 flex flex-col flex-grow bg-white relative">
                                    <div class="flex-grow">
                                        <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block group-hover:text-ocean-600 transition">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-ocean-600 transition-colors search-highlightable">
                                                {{ $item->judul_aksi }}
                                            </h3>
                                        </a>

                                        @if($item->manfaat)
                                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-md text-xs font-bold mb-4">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                {{ $item->manfaat }}
                                            </div>
                                        @endif

                                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6 search-highlightable">
                                            {{ $item->deskripsi ?? 'No description available.' }}
                                        </p>

                                        @if(isset($item->createdBy) && $item->createdBy)
                                            <div class="pt-2 border-t border-ocean-100 mb-4">
                                                <p class="text-xs text-gray-600">
                                                    Created by
                                                    <span class="font-semibold text-ocean-900">
                                                        {{ $item->createdBy->name ?? 'Unknown' }}
                                                    </span>
                                                    @if(isset($item->createdBy->badge))
                                                        <span class="badge badge-success text-xs ml-1">{{ $item->createdBy->badge }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Card Actions -->
                                    <div class="pt-5 border-t border-gray-100/80 mt-auto">
                                        <div class="flex gap-2.5">
                                            <a href="{{ route('aksi.show', $item->id_aksi) }}" class="flex-1 bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-2.5 rounded-xl text-center transition-all duration-300 text-sm border border-ocean-200 hover:border-transparent">
                                                Lihat Detail
                                            </a>

                                            @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $item->created_by))
                                                <a href="{{ route('aksi.edit', $item->id_aksi) }}" class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-amber-100 hover:border-amber-500" title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-14 flex justify-center">
                        {{ $aksi->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

document.addEventListener('DOMContentLoaded', function() {
    // Search validation
    const searchForm = document.querySelector('.search-form');

    if (searchForm) {
        const searchInput = searchForm.querySelector('.search-input');
        const errorMsg = searchForm.querySelector('.search-error-msg');

        if (searchInput && errorMsg) {
            function validateSearch(val) {
                const trimmed = val.trim();

                if (trimmed === '') {
                    return 'Silakan masukkan kata kunci pencarian.';
                }

                if (trimmed.length > 100) {
                    return 'Kata kunci pencarian tidak boleh melebihi 100 karakter.';
                }

                const regex = /^[a-zA-Z0-9\s]+$/;

                if (!regex.test(trimmed)) {
                    return 'Kata kunci pencarian tidak boleh mengandung karakter spesial.';
                }

                return null;
            }

            function showError(msg) {
                errorMsg.textContent = msg;
                errorMsg.classList.remove('hidden');
            }

            function clearError() {
                errorMsg.textContent = '';
                errorMsg.classList.add('hidden');
            }

            searchForm.addEventListener('submit', function(e) {
                const error = validateSearch(searchInput.value);

                if (error) {
                    e.preventDefault();
                    showError(error);
                }
            });

            searchInput.addEventListener('input', function() {
                const error = validateSearch(this.value);

                if (!error) {
                    clearError();
                } else if (!errorMsg.classList.contains('hidden')) {
                    showError(error);
                }
            });
        }
    }

    // Highlight search keywords
    function highlightText(element, query) {
        if (!query) return;

        const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
        const nodes = [];
        let node;

        while ((node = walker.nextNode())) {
            nodes.push(node);
        }

        const regex = new RegExp(`(${query.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')})`, 'gi');

        nodes.forEach(textNode => {
            const text = textNode.nodeValue;

            if (regex.test(text)) {
                const fragment = document.createDocumentFragment();
                let lastIndex = 0;

                text.replace(regex, (match, p1, index) => {
                    if (index > lastIndex) {
                        fragment.appendChild(document.createTextNode(text.substring(lastIndex, index)));
                    }

                    const mark = document.createElement('mark');
                    mark.className = 'bg-cyan-100 text-cyan-900 rounded px-0.5 font-bold';
                    mark.textContent = match;
                    fragment.appendChild(mark);

                    lastIndex = index + match.length;
                });

                if (lastIndex < text.length) {
                    fragment.appendChild(document.createTextNode(text.substring(lastIndex)));
                }

                if (textNode.parentNode) {
                    textNode.parentNode.replaceChild(fragment, textNode);
                }
            }
        });
    }

    const searchQuery = new URLSearchParams(window.location.search).get('search');

    if (searchQuery) {
        document.querySelectorAll('.search-highlightable').forEach(el => {
            highlightText(el, searchQuery);
        });
    }

    // --- LIKES & BOOKMARKS LOGIC ---

    const SVG_HEART_EMPTY = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-red-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>`;
    const SVG_HEART_FILLED = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#ef4444] fill-current animate-heart-beat" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;

    const SVG_BOOKMARK_EMPTY = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>`;
    const SVG_BOOKMARK_FILLED = `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#009ee2] fill-current" viewBox="0 0 24 24"><path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2z"/></svg>`;

    function getLikedActions() {
        try {
            return JSON.parse(localStorage.getItem('liked_actions')) || [];
        } catch (e) {
            return [];
        }
    }

    function setLikedActions(ids) {
        localStorage.setItem('liked_actions', JSON.stringify(ids));
    }

    function getBookmarkedActions() {
        try {
            return JSON.parse(localStorage.getItem('bookmarked_actions')) || [];
        } catch (e) {
            return [];
        }
    }

    function setBookmarkedActions(ids) {
        localStorage.setItem('bookmarked_actions', JSON.stringify(ids));
    }

    // Initialize Like button states from localStorage
    const likedIds = getLikedActions();
    document.querySelectorAll('.btn-like').forEach(btn => {
        const id = parseInt(btn.dataset.id);
        if (likedIds.includes(id)) {
            btn.classList.add('liked');
            btn.innerHTML = SVG_HEART_FILLED;
        } else {
            btn.innerHTML = SVG_HEART_EMPTY;
        }
    });

    // Handle Like button clicks
    document.querySelectorAll('.btn-like').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            let currentLikes = getLikedActions();
            
            if (currentLikes.includes(id)) {
                currentLikes = currentLikes.filter(item => item !== id);
                this.classList.remove('liked');
                this.innerHTML = SVG_HEART_EMPTY;
            } else {
                currentLikes.push(id);
                this.classList.add('liked');
                this.innerHTML = SVG_HEART_FILLED;
            }
            setLikedActions(currentLikes);
        });
    });

    // Filter by Likes button
    const btnFilterLikes = document.getElementById('btn-filter-likes');
    if (btnFilterLikes) {
        btnFilterLikes.addEventListener('click', function() {
            const liked = getLikedActions();
            const likedQuery = liked.join(',');
            
            const url = new URL(window.location.href);
            url.searchParams.set('filter_likes', likedQuery);
            url.searchParams.delete('filter_bookmarks');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }

    // Initialize Bookmark button states from localStorage
    const bookmarkedIds = getBookmarkedActions();
    document.querySelectorAll('.btn-bookmark').forEach(btn => {
        const id = parseInt(btn.dataset.id);
        if (bookmarkedIds.includes(id)) {
            btn.classList.add('bookmarked');
            btn.innerHTML = SVG_BOOKMARK_FILLED;
        } else {
            btn.innerHTML = SVG_BOOKMARK_EMPTY;
        }
    });

    // Handle Bookmark button clicks client-side
    document.querySelectorAll('.btn-bookmark').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(this.dataset.id);
            let currentBookmarks = getBookmarkedActions();
            
            if (currentBookmarks.includes(id)) {
                currentBookmarks = currentBookmarks.filter(item => item !== id);
                this.classList.remove('bookmarked');
                this.innerHTML = SVG_BOOKMARK_EMPTY;
            } else {
                currentBookmarks.push(id);
                this.classList.add('bookmarked');
                this.innerHTML = SVG_BOOKMARK_FILLED;
            }
            setBookmarkedActions(currentBookmarks);
        });
    });

    // Filter by Bookmarks button
    const btnFilterBookmarks = document.getElementById('btn-filter-bookmarks');
    if (btnFilterBookmarks) {
        btnFilterBookmarks.addEventListener('click', function() {
            const bookmarked = getBookmarkedActions();
            const bookmarkedQuery = bookmarked.join(',');
            
            const url = new URL(window.location.href);
            url.searchParams.set('filter_bookmarks', bookmarkedQuery);
            url.searchParams.delete('filter_likes');
            url.searchParams.delete('page');
            window.location.href = url.toString();
        });
    }
});
// Delete buttons initialization removed
</script>
@endpush
