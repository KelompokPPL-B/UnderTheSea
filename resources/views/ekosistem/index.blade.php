@extends('layouts.app')

@section('content')
<div class="py-16 bg-gradient-to-br from-slate-50 via-blue-50 to-emerald-50 min-h-screen relative">
    
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-ocean-600/5 to-transparent pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>
    <div class="absolute top-48 -left-24 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-block py-1 px-3 rounded-full bg-ocean-100 text-ocean-700 font-bold tracking-wider uppercase text-xs mb-4">
                Eksplorasi Kelautan
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-5 leading-tight tracking-tight">
                Katalog <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-600 to-emerald-500">Ekosistem</span>
            </h1>
            <p class="text-lg text-gray-600 font-medium">
                Temukan keanekaragaman hayati dan pelajari pentingnya menjaga keseimbangan ekosistem laut kita.
            </p>
        </div>

        <!-- Dynamic & Interactive Statistics Section (Compact Horizontal) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-14 relative z-20">
            
            <!-- Card 1: Ecosystems -->
            <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(20,184,166,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                <div class="absolute -right-6 -top-6 w-28 h-28 bg-gradient-to-br from-teal-100/50 to-cyan-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-teal-50 rounded-xl border border-teal-100/50 shadow-sm group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-6 h-6 text-teal-600 drop-shadow-sm" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M12 22V12" />
                        <path d="M12 16a4 4 0 0 0 4-4V8" />
                        <path d="M16 10a3 3 0 0 1 3-3" />
                        <path d="M12 14a4 4 0 0 1-4-4V7" />
                        <path d="M8 9a3 3 0 0 0-3-3" />
                        <path d="M12 12V6" />
                        <circle cx="16" cy="7" r="1" fill="currentColor" />
                        <circle cx="8" cy="6" r="1" fill="currentColor" />
                        <circle cx="12" cy="5" r="1" fill="currentColor" />
                    </svg>
                </div>
                
                <div class="relative z-10 text-left">
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-teal-700 transition-colors">24</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Ekosistem Laut</p>
                </div>
            </div>

            <!-- Card 2: Species -->
            <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(6,182,212,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                <div class="absolute -bottom-6 -right-6 w-28 h-28 bg-gradient-to-tl from-cyan-100/50 to-blue-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-cyan-50 rounded-xl border border-cyan-100/50 shadow-sm group-hover:-rotate-6 transition-transform duration-300">
                    <svg class="w-6 h-6 text-cyan-600 drop-shadow-sm" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M22 12C22 12 19 16 12 16C5 16 2 12 2 12C2 12 5 8 12 8C19 8 22 12 22 12Z" />
                        <circle cx="16" cy="12" r="1.5" fill="currentColor" />
                        <path d="M5 12L2 9V15L5 12Z" fill="currentColor" />
                        <path d="M12 8V5L15 8" />
                        <path d="M12 16V19L15 16" />
                    </svg>
                </div>
                
                <div class="relative z-10 text-left">
                    <div class="flex items-baseline">
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-cyan-700 transition-colors">120</h3>
                        <span class="text-2xl font-bold text-cyan-500 ml-0.5">+</span>
                    </div>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Spesies Laut</p>
                </div>
            </div>

            <!-- Card 3: Locations -->
            <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(59,130,246,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                <div class="absolute -top-6 -left-6 w-28 h-28 bg-gradient-to-br from-blue-100/50 to-indigo-100/50 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-blue-50 rounded-xl border border-blue-100/50 shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-blue-600 drop-shadow-sm" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                
                <div class="relative z-10 text-left">
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-blue-700 transition-colors">15</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Lokasi Laut</p>
                </div>
            </div>

            <!-- Card 4: Actions -->
            <div class="relative bg-white/90 backdrop-blur-xl rounded-[1.25rem] p-5 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_8px_30px_-4px_rgba(16,185,129,0.15)] hover:-translate-y-1 transition-all duration-300 border border-white/80 overflow-hidden group flex items-center gap-4 cursor-default">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-emerald-100/40 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                
                <div class="relative z-10 w-12 h-12 shrink-0 flex items-center justify-center bg-gradient-to-br from-white to-emerald-50 rounded-xl border border-emerald-100/50 shadow-sm group-hover:rotate-6 transition-transform duration-300">
                    <svg class="w-6 h-6 text-emerald-600 drop-shadow-sm" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <div class="relative z-10 text-left">
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">8</h3>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Aksi Konservasi</p>
                </div>
            </div>
        </div>

        <!-- Featured 'Endangered' Carousel Section -->
        <style>
            .hide-scrollbar::-webkit-scrollbar { display: none; }
            .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
        
        <div class="mb-16 relative w-full rounded-[2rem] z-20 group bg-slate-100/50 p-4 border border-white/50 shadow-sm">
            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-6 pb-2">
                
                <!-- Card 1 -->
                <div class="relative snap-start shrink-0 w-full md:w-[85%] aspect-[16/9] md:aspect-[21/9] rounded-[1.5rem] overflow-hidden shadow-lg bg-gray-900 group-hover/card:shadow-2xl transition-all flex flex-col justify-end p-8 md:p-12">
                    <!-- Background Layers (z-0) -->
                    <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&q=80" alt="Vulnerable Coral" class="absolute inset-0 w-full h-full object-cover opacity-80 mix-blend-overlay hover:scale-105 transition-transform duration-1000 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0 pointer-events-none"></div>
                    
                    <!-- Content (z-10) -->
                    <div class="relative z-10 mb-auto">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-500/90 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-red-400/50">
                            ⚠️ Kritis
                        </span>
                    </div>
                    <div class="relative z-10 max-w-2xl transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold text-white mb-3 leading-tight drop-shadow-md">Misteri Terumbu Karang Berisiko Kritis</h2>
                        <p class="text-gray-200 text-sm md:text-base lg:text-lg mb-6 line-clamp-2 md:line-clamp-none font-medium text-shadow-sm">
                            Ekosistem karang di wilayah tropis menghadapi ancaman pemutihan massal. Ketahui faktor penyebabnya dan langkah nyata yang bisa kita lakukan untuk menyelamatkan rumah bagi jutaan spesies laut ini.
                        </p>
                        <button class="bg-teal-500 hover:bg-teal-400 text-white font-bold py-2.5 px-6 rounded-full shadow-lg hover:shadow-teal-500/50 transition-all duration-300 transform hover:-translate-y-1 text-sm md:text-base cursor-pointer focus:outline-none focus:ring-4 focus:ring-teal-500/30">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>

                <!-- Card 2 (Partial hint) -->
                <div class="relative snap-start shrink-0 w-full md:w-[85%] aspect-[16/9] md:aspect-[21/9] rounded-[1.5rem] overflow-hidden shadow-lg bg-gray-900 opacity-90 hover:opacity-100 transition-opacity flex flex-col justify-end p-8 md:p-12">
                    <img src="https://images.unsplash.com/photo-1582967788606-a171c1080cb0?auto=format&fit=crop&q=80" alt="Bleached Coral" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay hover:scale-105 transition-transform duration-1000 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0 pointer-events-none"></div>
                    
                    <div class="relative z-10 mb-auto">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-orange-500/90 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-orange-400/50">
                            📉 Terancam
                        </span>
                    </div>
                    <div class="relative z-10 max-w-2xl transform translate-y-2 hover:translate-y-0 transition-transform duration-500">
                        <h2 class="text-2xl md:text-4xl lg:text-5xl font-extrabold text-white mb-3 leading-tight drop-shadow-md">Pemutihan Karang Global</h2>
                        <p class="text-gray-200 text-sm md:text-base lg:text-lg mb-6 line-clamp-2 md:line-clamp-none font-medium">
                            Suhu laut yang meningkat drastis memicu stres pada alga simbiotik. Dampaknya meluas ke seluruh rantai makanan laut.
                        </p>
                        <button class="bg-teal-500 hover:bg-teal-400 text-white font-bold py-2.5 px-6 rounded-full shadow-lg transition-all duration-300 text-sm md:text-base cursor-pointer focus:outline-none focus:ring-4 focus:ring-teal-500/30">
                            Baca Laporan
                        </button>
                    </div>
                </div>

            </div>

            <!-- Carousel Navigation (Circular Arrows) -->
            <button class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 backdrop-blur-md rounded-full flex items-center justify-center text-white border border-white/30 transition-all z-30 opacity-0 group-hover:opacity-100 hidden md:flex hover:scale-110 cursor-pointer focus:outline-none shadow-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 backdrop-blur-md rounded-full flex items-center justify-center text-white border border-white/30 transition-all z-30 opacity-0 group-hover:opacity-100 hidden md:flex hover:scale-110 cursor-pointer focus:outline-none shadow-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>

            <!-- Pagination Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2.5 z-30">
                <div class="w-2.5 h-2.5 rounded-full bg-white shadow-sm transition-all hover:scale-125 cursor-pointer"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all hover:scale-125 cursor-pointer"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all hover:scale-125 cursor-pointer"></div>
            </div>
        </div>

        <!-- Search & Filter Controls -->
        <div class="relative mb-12 flex flex-col md:flex-row items-center justify-center gap-4 z-20">

            <form method="GET" action="{{ route('ekosistem.index') }}" class="w-full max-w-2xl relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                    <span class="pl-5 pr-2 text-2xl">🫧</span>
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari ekosistem, lokasi, atau deskripsi..." 
                        class="w-full bg-transparent border-none focus:ring-0 px-2 py-3 text-ocean-900 placeholder-ocean-400 font-medium outline-none"
                    >

                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-ocean-600 to-blue-500 hover:from-ocean-700 hover:to-blue-600 text-white px-8 py-3 rounded-full font-bold tracking-wide shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center gap-2"
                    >
                        <span>Search</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="relative w-full md:w-auto">
                <select 
                    onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="appearance-none bg-white/80 backdrop-blur-md border border-white/50 text-ocean-700 font-semibold py-3 pl-6 pr-10 rounded-full shadow-lg hover:bg-white transition-all cursor-pointer outline-none focus:ring-2 focus:ring-ocean-300">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>✨ Terbaru</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>⏳ Terlama</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-ocean-500">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
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

        @if($ekosistem->isEmpty())
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-16 text-center max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-ocean-50 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">
                    🐠
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                <p class="text-gray-500 font-medium">
                    {{ request('search') ? 'Pencarian Anda tidak membuahkan hasil. Coba kata kunci lain.' : 'Belum ada data ekosistem yang terdaftar di sistem.' }}
                </p>
            </div>
        @else

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ekosistem as $item)
            <div class="group bg-white rounded-[1.5rem] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_40px_-8px_rgba(0,0,0,0.15)] border border-gray-100/80 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1.5">
                
                <!-- Card Image -->
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    @if($item->gambar)
                        <img src="/storage/{{ $item->gambar }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-ocean-50 text-6xl">
                            🌊
                        </div>
                    @endif
                    
                    <!-- Dark Gradient Overlay for better contrast -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300 pointer-events-none"></div>

                    <!-- Action Buttons (Like & Bookmark) -->
                    <div class="absolute top-4 right-4 z-10 flex items-center gap-2">
                        <!-- Like Btn -->
                        <button class="like-btn-card p-2.5 bg-white/20 hover:bg-white backdrop-blur-md rounded-full text-white hover:text-red-500 hover:shadow-lg transition-all duration-300 border border-white/30 hover:border-white" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}" title="Like Ekosistem">
                            <svg class="w-5 h-5 like-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </button>

                        <!-- Bookmark Btn -->
                        <button class="bookmark-btn-card p-2.5 bg-white/20 hover:bg-white backdrop-blur-md rounded-full text-white hover:text-ocean-500 hover:shadow-lg transition-all duration-300 border border-white/30 hover:border-white" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}" title="Simpan Bookmark">
                            <svg class="w-5 h-5 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Location Tag -->
                    @if($item->lokasi)
                    <div class="absolute bottom-5 left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/30">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $item->lokasi }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="p-6 flex flex-col flex-grow bg-white relative">
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-ocean-600 transition-colors">{{ $item->nama_ekosistem }}</h3>
                        
                        @if($item->peran)
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-md text-xs font-bold mb-4">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                {{ $item->peran }}
                            </div>
                        @endif

                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi yang tersedia.' }}
                        </p>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-5 border-t border-gray-100/80 mt-auto">
                        <div class="flex gap-2.5">
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="flex-1 bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-2.5 rounded-xl text-center transition-all duration-300 text-sm border border-ocean-200 hover:border-transparent">
                                Lihat Detail
                            </a>
                            
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-amber-100 hover:border-amber-500" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <button class="delete-btn-card bg-red-50 hover:bg-red-500 text-red-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-red-100 hover:border-red-500" data-ekosistem-id="{{ $item->id_ekosistem }}" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-14 flex justify-center">
            {{ $ekosistem->appends(request()->query())->links() }}
        </div>

        @endif
    </div>
</div>

@push('scripts')
<script>
// Global helper
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const isGuest = {{ auth()->guest() ? 'true' : 'false' }};

    function safeParseJSON(str) {
        try {
            const parsed = JSON.parse(str);
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    // === LIKE LOGIC ===
    function updateLikeUI(btn, isLiked) {
        const icon = btn.querySelector('.like-icon');
        if (!icon) return;
        
        if (isLiked) {
            btn.classList.add('liked', 'bg-white', 'text-red-500', 'shadow-md');
            btn.classList.remove('bg-white/20', 'text-white', 'hover:text-red-500');
            icon.setAttribute('fill', 'currentColor');
        } else {
            btn.classList.remove('liked', 'bg-white', 'text-red-500', 'shadow-md');
            btn.classList.add('bg-white/20', 'text-white', 'hover:text-red-500');
            icon.setAttribute('fill', 'none');
        }
    }

    document.querySelectorAll('.like-btn-card').forEach(btn => {
        // Init state from local storage
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;
        const key = `likes_${type}`;
        const likes = safeParseJSON(localStorage.getItem(key));
        
        if (likes.includes(itemId)) {
            updateLikeUI(btn, true);
        }

        // Click handler
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isLiked = !this.classList.contains('liked');
            updateLikeUI(this, isLiked);
            
            let currentLikes = safeParseJSON(localStorage.getItem(key));
            if (isLiked) {
                if (!currentLikes.includes(itemId)) currentLikes.push(itemId);
            } else {
                currentLikes = currentLikes.filter(id => id !== itemId);
            }
            localStorage.setItem(key, JSON.stringify(currentLikes));
        });
    });

    // === BOOKMARK LOGIC ===
    function updateBookmarkUI(btn, isBookmarked) {
        const icon = btn.querySelector('.bookmark-icon');
        if (!icon) return;
        
        if (isBookmarked) {
            btn.classList.add('bookmarked', 'bg-white', 'text-ocean-500', 'shadow-md');
            btn.classList.remove('bg-white/20', 'text-white', 'hover:text-ocean-500');
            icon.setAttribute('fill', 'currentColor');
        } else {
            btn.classList.remove('bookmarked', 'bg-white', 'text-ocean-500', 'shadow-md');
            btn.classList.add('bg-white/20', 'text-white', 'hover:text-ocean-500');
            icon.setAttribute('fill', 'none');
        }
    }

    document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;
        const key = `bookmarks_${type}`;
        
        // Init state
        if (isGuest) {
            const bookmarks = safeParseJSON(localStorage.getItem(key));
            if (bookmarks.includes(itemId)) {
                updateBookmarkUI(btn, true);
            }
        }

        // Click handler
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isBookmarked = !this.classList.contains('bookmarked');
            
            if (isGuest) {
                updateBookmarkUI(this, isBookmarked);
                let currentBookmarks = safeParseJSON(localStorage.getItem(key));
                if (isBookmarked) {
                    if (!currentBookmarks.includes(itemId)) currentBookmarks.push(itemId);
                } else {
                    currentBookmarks = currentBookmarks.filter(id => id !== itemId);
                }
                localStorage.setItem(key, JSON.stringify(currentBookmarks));
                return;
            }

            // Authenticated behavior
            const method = isBookmarked ? 'POST' : 'DELETE';
            const _btn = this;
            
            fetch('/favorites', {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({ type: type, item_id: parseInt(itemId) })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updateBookmarkUI(_btn, isBookmarked);
                } else {
                    alert(data.message);
                }
            })
            .catch(err => console.error('Error:', err));
        });
    });

    // For authenticated users, fetch bookmark state from DB
    if (!isGuest) {
        fetch('/favorites', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
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
                        updateBookmarkUI(btn, true);
                    }
                });
            }
        })
        .catch(err => console.error('Error loading bookmark state:', err));
    }
});
</script>
@endpush
@endsection
