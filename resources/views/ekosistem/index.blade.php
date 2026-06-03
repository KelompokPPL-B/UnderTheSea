@extends('layouts.app')

@section('content')
@php
    $ecosystems = $ekosistem ?? collect();
    $currentSort = $sort ?? request('sort', 'newest');
    $currentLokasi = $filterLokasi ?? request('lokasi', '');
    $lokasiOptions = $lokasiList ?? collect();
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
                    Ekosistem
                </span>
            </h1>

            <p class="text-lg text-gray-600 font-medium mb-6">
                Temukan keanekaragaman hayati dan pelajari pentingnya menjaga keseimbangan ekosistem laut kita.
            </p>

            <!-- Search + Sort Header -->
            <div class="flex flex-col md:flex-row justify-center items-center gap-4 w-full mt-6 max-w-4xl mx-auto px-4 z-30 relative">
                <form method="GET" action="{{ route('ekosistem.index') }}" class="w-full md:flex-1 max-w-2xl relative group search-form animate-fade-in" novalidate>
                    <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>

                    <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                        <span class="pl-5 pr-2 text-2xl">🫧</span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari ekosistem, lokasi, atau deskripsi..."
                            class="w-full bg-transparent border-none focus:ring-0 px-2 py-3 text-ocean-900 placeholder-ocean-400 font-medium outline-none search-input"
                        >

                        <input type="hidden" name="sort" value="{{ $currentSort }}">
                        <input type="hidden" name="lokasi" value="{{ $currentLokasi }}">

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

                <div class="relative w-full md:w-auto min-w-[160px] animate-fade-in">
                    <select
                        onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value + '&search={{ request('search') }}'"
                        class="appearance-none w-full bg-white/80 backdrop-blur-md border border-white/50 text-ocean-700 font-semibold py-3.5 pl-6 pr-10 rounded-full shadow-lg hover:bg-white transition-all cursor-pointer outline-none focus:ring-2 focus:ring-ocean-300"
                    >
                        <option value="newest" {{ $currentSort === 'newest' ? 'selected' : '' }}>✨ Terbaru</option>
                        <option value="oldest" {{ $currentSort === 'oldest' ? 'selected' : '' }}>⏳ Terlama</option>
                        <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Name A–Z</option>
                        <option value="name_desc" {{ $currentSort === 'name_desc' ? 'selected' : '' }}>Name Z–A</option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-ocean-500">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        @if(!$ecosystems->isEmpty() || !request('search'))
            <!-- Dynamic & Interactive Statistics Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-14 relative z-20">

                <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(20,184,166,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                    <div class="absolute -right-6 -top-6 w-28 h-28 bg-gradient-to-br from-teal-100/50 to-cyan-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-teal-50 rounded-xl border border-teal-100/50 shadow-sm group-hover:rotate-6 transition-transform duration-300">
                        🌿
                    </div>
                    <div class="relative z-10 text-left">
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-teal-700 transition-colors">
                            {{ method_exists($ecosystems, 'total') ? $ecosystems->total() : $ecosystems->count() }}
                        </h3>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ekosistem Laut</p>
                    </div>
                </div>

                <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(6,182,212,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                    <div class="absolute -bottom-6 -right-6 w-28 h-28 bg-gradient-to-tl from-cyan-100/50 to-blue-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-cyan-50 rounded-xl border border-cyan-100/50 shadow-sm group-hover:-rotate-6 transition-transform duration-300">
                        🐟
                    </div>
                    <div class="relative z-10 text-left">
                        <div class="flex items-baseline">
                            <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-cyan-700 transition-colors">120</h3>
                            <span class="text-2xl font-bold text-cyan-500 ml-0.5">+</span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Spesies Laut</p>
                    </div>
                </div>

                <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(59,130,246,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                    <div class="absolute -top-6 -left-6 w-28 h-28 bg-gradient-to-br from-blue-100/50 to-indigo-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-blue-50 rounded-xl border border-blue-100/50 shadow-sm group-hover:scale-110 transition-transform duration-300">
                        📍
                    </div>
                    <div class="relative z-10 text-left">
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-blue-700 transition-colors">
                            {{ $lokasiOptions->count() ?: 15 }}
                        </h3>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Lokasi Laut</p>
                    </div>
                </div>

                <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(16,185,129,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-emerald-100/40 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-emerald-50 rounded-xl border border-emerald-100/50 shadow-sm group-hover:rotate-6 transition-transform duration-300">
                        ✅
                    </div>
                    <div class="relative z-10 text-left">
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">8</h3>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Aksi Konservasi</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen rounded-[2rem]">
            <div class="max-w-7xl mx-auto px-6 py-6">

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

                <!-- Filter & Sort -->
                <form method="GET" action="{{ route('ekosistem.index') }}" class="mb-8">
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
                                    <option value="name_asc" {{ $currentSort === 'name_asc' ? 'selected' : '' }}>Name A–Z</option>
                                    <option value="name_desc" {{ $currentSort === 'name_desc' ? 'selected' : '' }}>Name Z–A</option>
                                </select>
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Location</label>

                                <select name="lokasi" class="select select-bordered w-80">
                                    <option value="">All Locations</option>
                                    @foreach($lokasiOptions as $l)
                                        <option value="{{ $l }}" {{ $currentLokasi === $l ? 'selected' : '' }}>
                                            {{ $l }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="search" value="{{ request('search') }}">

                            <div class="ml-10 flex items-end gap-4">
                                <button type="submit" class="btn h-12 min-h-12 px-6 text-sm font-semibold text-white" style="background:#0e7490;border:none;border-radius:10px;">
                                    Apply
                                </button>

                                <a href="{{ route('ekosistem.index') }}" class="btn btn-ghost h-12 min-h-12 px-6 text-sm font-semibold text-gray-500">
                                    Reset
                                </a>
                            </div>
                        </div>

                        @if($currentLokasi || $currentSort !== 'newest')
                            <div class="mt-6 flex flex-wrap items-center gap-2">
                                <span class="text-xs text-gray-400 font-medium">Active Filters:</span>

                                @if($currentSort !== 'newest')
                                    <span class="badge badge-sm" style="background:#f0f9ff;color:#0369a1;border:none;">
                                        Sort:
                                        {{ [
                                            'oldest' => 'Oldest First',
                                            'name_asc' => 'Name A–Z',
                                            'name_desc' => 'Name Z–A',
                                            'newest' => 'Newest First',
                                        ][$currentSort] ?? 'Newest First' }}
                                    </span>
                                @endif

                                @if($currentLokasi)
                                    <span class="badge badge-sm" style="background:#e0f2fe;color:#0369a1;border:none;">
                                        📍 {{ $currentLokasi }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </form>

                <!-- Conservation Spotlight Section -->
                <div class="mb-16 relative w-full z-20">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-96 bg-gradient-to-r from-blue-400/20 to-emerald-400/20 rounded-[3rem] blur-3xl pointer-events-none"></div>

                    <div class="text-center mb-10 relative z-10">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                            Conservation
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-600 to-emerald-500">Spotlight</span>
                        </h2>
                        <p class="text-lg text-gray-600 font-medium max-w-2xl mx-auto">
                            Monitor marine ecosystems and critical environmental issues that need our attention.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                        <div class="group relative rounded-[2rem] overflow-hidden shadow-xl hover:shadow-2xl md:col-span-2 lg:col-span-2 lg:row-span-2 aspect-[4/3] lg:aspect-auto flex flex-col justify-end p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                            <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&q=80" alt="Coral Reefs at Critical Risk" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/50 to-transparent z-0"></div>

                            <div class="relative z-10 mb-auto">
                                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-red-500/90 to-rose-500/90 text-white text-sm font-bold rounded-full shadow-lg backdrop-blur-md border border-red-400/50">
                                    <span class="relative flex h-2.5 w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
                                    </span>
                                    Critical
                                </span>
                            </div>

                            <div class="relative z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <h3 class="text-3xl lg:text-4xl font-black text-white mb-3 leading-tight drop-shadow-md">Coral Reefs at Critical Risk</h3>
                                <p class="text-gray-200 text-base lg:text-lg mb-6 line-clamp-3 font-medium opacity-90 group-hover:opacity-100 transition-opacity">
                                    Coral bleaching caused by rising ocean temperatures threatens coral reef ecosystems and the marine species that depend on them.
                                </p>
                            </div>
                        </div>

                        @php
                            $spotlights = [
                                ['img' => asset('images/conservation/mangrove.png'), 'status' => 'Threatened', 'color' => 'from-orange-500/90 to-amber-500/90', 'title' => 'Declining Mangrove Forests', 'desc' => 'Land conversion and illegal logging continue to reduce mangrove coverage, increasing coastal vulnerability.'],
                                ['img' => asset('images/conservation/seagrass.png'), 'status' => 'Vulnerable', 'color' => 'from-yellow-500/90 to-amber-400/90', 'title' => 'Degraded Seagrass Meadows', 'desc' => 'Pollution and human activities are damaging seagrass habitats that support dugongs and sea turtles.'],
                                ['img' => asset('images/conservation/turtle.png'), 'status' => 'Threatened', 'color' => 'from-orange-500/90 to-amber-500/90', 'title' => 'Declining Sea Turtle Population', 'desc' => 'Habitat destruction, plastic waste, and egg poaching contribute to decreasing sea turtle populations.'],
                                ['img' => asset('images/conservation/plastic.png'), 'status' => 'Critical', 'color' => 'from-red-500/90 to-rose-500/90', 'title' => 'Ocean Plastic Pollution', 'desc' => 'Plastic waste threatens marine life and disrupts ecosystem balance across the oceans.'],
                            ];
                        @endphp

                        @foreach($spotlights as $spotlight)
                            <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-square md:aspect-auto md:min-h-[260px] flex flex-col justify-end p-6 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                                <img src="{{ $spotlight['img'] }}" alt="{{ $spotlight['title'] }}" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>

                                <div class="relative z-10 mb-auto">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r {{ $spotlight['color'] }} text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-white/30">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                        </span>
                                        {{ $spotlight['status'] }}
                                    </span>
                                </div>

                                <div class="relative z-10">
                                    <h4 class="text-xl font-bold text-white mb-2 leading-snug drop-shadow-md">{{ $spotlight['title'] }}</h4>
                                    <p class="text-gray-300 text-sm line-clamp-3 font-medium opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto group-hover:mt-2 transition-all duration-500 overflow-hidden">
                                        {{ $spotlight['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-[2/1] md:aspect-auto md:col-span-2 lg:col-span-2 md:min-h-[260px] flex flex-col justify-end p-6 md:p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                            <img src="https://images.unsplash.com/photo-1582967788606-a171c1080cb0?auto=format&fit=crop&q=80" alt="Global Ocean Warming" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                            <div class="relative z-10 mb-auto">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-red-500/90 to-rose-500/90 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-red-400/50">
                                    Critical
                                </span>
                            </div>
                            <div class="relative z-10">
                                <h4 class="text-2xl font-bold text-white mb-2 leading-snug drop-shadow-md">Global Ocean Warming</h4>
                                <p class="text-gray-300 text-sm md:text-base font-medium line-clamp-2 opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                                    Rising sea temperatures affect marine biodiversity, migration patterns, and food chains.
                                </p>
                            </div>
                        </div>

                        <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-[2/1] md:aspect-auto md:col-span-2 lg:col-span-2 md:min-h-[260px] flex flex-col justify-end p-6 md:p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                            <img src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&q=80" alt="Raja Ampat Conservation Area" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                            <div class="relative z-10 mb-auto">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-blue-500/90 to-cyan-500/90 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-blue-400/50">
                                    Recovering
                                </span>
                            </div>
                            <div class="relative z-10">
                                <h4 class="text-2xl font-bold text-white mb-2 leading-snug drop-shadow-md">Raja Ampat Conservation Area</h4>
                                <p class="text-gray-300 text-sm md:text-base font-medium line-clamp-2 opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                                    Conservation efforts have helped restore coral reef health and marine biodiversity in several areas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="mb-8 flex justify-end z-20 relative">
                            <a href="{{ route('ekosistem.create') }}" class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-emerald-500/40 transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Ekosistem
                            </a>
                        </div>
                    @endif
                @endauth

                <!-- Search Result Info -->
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

                        <a href="{{ route('ekosistem.index') }}" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 transition-all flex items-center gap-1.5 hover:scale-105 active:scale-95">
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
                </style>

                @if($ecosystems->isEmpty())
                    <div class="bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-2xl p-12 md:p-16 text-center max-w-2xl mx-auto animate-fade-in">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner animate-bounce">
                            🐠
                        </div>

                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Data Tidak Ditemukan</h3>

                        <p class="text-slate-600 font-medium max-w-md mx-auto mb-8">
                            {{ request('search') ? 'Pencarian Anda tidak menghasilkan data yang sesuai. Coba gunakan kata kunci lain.' : 'Belum ada data ekosistem yang terdaftar di sistem.' }}
                        </p>

                        @if(request('search'))
                            <a href="{{ route('ekosistem.index') }}" class="shimmer-btn relative group overflow-hidden inline-flex items-center gap-2.5 bg-gradient-to-r from-teal-500 via-ocean-600 to-blue-600 text-white font-black text-sm uppercase tracking-wider py-4 px-10 rounded-full shadow-[0_10px_30px_-10px_rgba(8,145,178,0.5)] hover:shadow-[0_20px_40px_-10px_rgba(8,145,178,0.7)] hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300">
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
                        @foreach($ecosystems as $item)
                            <div class="group bg-white rounded-[1.5rem] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_40px_-8px_rgba(0,0,0,0.15)] border border-gray-100/80 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1.5">

                                <!-- Card Image -->
                                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_ekosistem }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110" loading="lazy">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ocean-50 text-6xl">
                                            🌊
                                        </div>
                                    @endif

                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300 pointer-events-none"></div>

                                    <!-- Location Tag -->
                                    @if($item->lokasi)
                                        <div class="absolute bottom-5 left-5 z-10">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/30 search-highlightable">
                                                <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $item->lokasi }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Card Body -->
                                <div class="p-6 flex flex-col flex-grow bg-white relative">
                                    <div class="flex-grow">
                                        <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="block group-hover:text-ocean-600 transition">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-ocean-600 transition-colors search-highlightable">
                                                {{ $item->nama_ekosistem }}
                                            </h3>
                                        </a>

                                        @if($item->peran)
                                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-md text-xs font-bold mb-4">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                {{ $item->peran }}
                                            </div>
                                        @endif

                                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6 search-highlightable">
                                            {{ $item->deskripsi ?? 'Tidak ada deskripsi yang tersedia.' }}
                                        </p>

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
                                    </div>

                                    <!-- Card Actions -->
                                    <div class="pt-5 border-t border-gray-100/80 mt-auto">
                                        <div class="flex gap-2.5">
                                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="flex-1 bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-2.5 rounded-xl text-center transition-all duration-300 text-sm border border-ocean-200 hover:border-transparent">
                                                Lihat Detail
                                            </a>

                                            @auth
                                                @if(auth()->user()->isAdmin())
                                                    <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-amber-100 hover:border-amber-500" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>

                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-14 flex justify-center">
                        {{ $ecosystems->appends(request()->query())->links() }}
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
    // Search validation logic
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        const searchInput = searchForm.querySelector('.search-input');
        const errorMsg = searchForm.querySelector('.search-error-msg');

        if (searchInput && errorMsg) {
            function validateSearch(value) {
                const trimmed = value.trim();

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

            function showError(message) {
                errorMsg.textContent = message;
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

        const escaped = query.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
        const regex = new RegExp(`(${escaped})`, 'gi');

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
});
</script>
@endpush
