@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    
    <!-- Hero Section -->
    <div class="relative w-full h-[70vh] min-h-[500px] bg-ocean-900 overflow-hidden">
        @if($ekosistem->gambar)
            <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="absolute inset-0 w-full h-full object-cover opacity-70 scale-105 transform hover:scale-110 transition-transform duration-[20s]" loading="lazy">
        @else
            <!-- Abstract background if no image -->
            <div class="absolute inset-0 bg-gradient-to-br from-ocean-800 via-blue-900 to-emerald-900">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-9xl opacity-20">🌊</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-ocean-900/40 to-ocean-900/10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-ocean-900/80 via-ocean-900/40 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto z-10 flex flex-col justify-end h-full">
            <div class="mb-8">
                <a href="{{ route('ekosistem.index') }}" class="inline-flex items-center text-sm font-bold text-white hover:text-white transition-all duration-300 bg-white/10 hover:bg-white/20 backdrop-blur-md px-6 py-2.5 rounded-full border border-white/20 hover:border-white/40 shadow-lg hover:-translate-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-md text-emerald-300 border border-emerald-400/30 text-sm font-bold tracking-wider uppercase rounded-full mb-4 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $ekosistem->lokasi ?? 'Lokasi Lautan' }}
                    </span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-4 drop-shadow-2xl tracking-tight leading-tight">{{ $ekosistem->nama_ekosistem }}</h1>
                </div>
                
                <div class="flex gap-3 mb-2 shrink-0">
                    <button class="share-btn flex items-center justify-center gap-2 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-900 font-bold px-6 py-3.5 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-xl hover:-translate-y-1" data-url="{{ request()->url() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368a3 3 0 000-5.368M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Bagikan
                    </button>
                    @auth
                        <button class="bookmark-btn flex items-center justify-center w-14 h-14 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-600 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-xl hover:-translate-y-1" data-type="ekosistem" data-item-id="{{ $ekosistem->id_ekosistem }}" title="Bookmark">
                            <svg class="w-6 h-6 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-8">
        
        <!-- Quick Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Location (Green) -->
            <div class="bg-gradient-to-br from-emerald-50 to-green-50/50 p-6 rounded-[2rem] shadow-[0_8px_30px_rgb(16,185,129,0.1)] hover:shadow-[0_20px_40px_rgb(16,185,129,0.15)] border border-emerald-100/60 flex flex-col gap-3 group transform hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-400/5 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100/80 flex items-center justify-center mb-1 text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition-colors shadow-sm relative z-10">
                    <svg class="w-6 h-6 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div class="relative z-10">
                    <span class="text-xs font-black text-emerald-600/80 uppercase tracking-widest mb-1 block">Lokasi Geografis</span>
                    <p class="text-gray-900 font-bold text-xl leading-tight group-hover:text-emerald-900 transition-colors">{{ $ekosistem->lokasi }}</p>
                </div>
            </div>

            <!-- Role (Blue) -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 p-6 rounded-[2rem] shadow-[0_8px_30px_rgb(59,130,246,0.1)] hover:shadow-[0_20px_40px_rgb(59,130,246,0.15)] border border-blue-100/60 flex flex-col gap-3 group transform hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-400/5 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                <div class="w-12 h-12 rounded-2xl bg-blue-100/80 flex items-center justify-center mb-1 text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-colors shadow-sm relative z-10">
                    <svg class="w-6 h-6 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="relative z-10">
                    <span class="text-xs font-black text-blue-600/80 uppercase tracking-widest mb-1 block">Peran Utama</span>
                    <p class="text-gray-900 font-bold text-xl leading-tight line-clamp-2 group-hover:text-blue-900 transition-colors">{{ Str::limit($ekosistem->peran, 60) }}</p>
                </div>
            </div>

            <!-- Threat (Red/Orange) -->
            <div class="bg-gradient-to-br from-red-50 to-orange-50/50 p-6 rounded-[2rem] shadow-[0_8px_30px_rgb(239,68,68,0.1)] hover:shadow-[0_20px_40px_rgb(239,68,68,0.15)] border border-red-100/60 flex flex-col gap-3 group transform hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-400/5 rounded-full blur-2xl -mr-10 -mt-10 transition-transform group-hover:scale-150 duration-700"></div>
                <div class="w-12 h-12 rounded-2xl bg-red-100/80 flex items-center justify-center mb-1 text-red-600 group-hover:bg-red-500 group-hover:text-white transition-colors shadow-sm relative z-10">
                    <svg class="w-6 h-6 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="relative z-10">
                    <span class="text-xs font-black text-red-600/80 uppercase tracking-widest mb-1 block">Ancaman Kritis</span>
                    <p class="text-gray-900 font-bold text-xl leading-tight line-clamp-2 group-hover:text-red-900 transition-colors">{{ Str::limit($ekosistem->ancaman, 60) }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(8,145,178,0.1)] hover:shadow-[0_20px_40px_rgb(8,145,178,0.15)] border border-cyan-100 overflow-hidden relative group transform hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-cyan-500 via-teal-500 to-emerald-500"></div>
                    <div class="flex flex-col xl:flex-row xl:items-center gap-5 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-600 group-hover:scale-110 group-hover:bg-cyan-500 group-hover:text-white transition-all duration-500 shadow-sm shrink-0">
                            <svg class="w-9 h-9 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight group-hover:text-cyan-700 transition-colors">Tentang Ekosistem</h2>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-cyan-50/50 to-teal-50/30 rounded-2xl p-6 md:p-8 border border-cyan-100/50 shadow-inner prose prose-lg text-gray-700 max-w-none">
                        <p class="leading-relaxed whitespace-pre-line">{{ $ekosistem->deskripsi }}</p>
                    </div>
                </div>

                <!-- Ecological Importance -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(59,130,246,0.1)] hover:shadow-[0_20px_40px_rgb(59,130,246,0.15)] border border-blue-100 overflow-hidden relative group transform hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-blue-500 via-indigo-500 to-violet-500"></div>
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 pointer-events-none transition-opacity duration-500">
                        <svg class="w-32 h-32 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="flex flex-col xl:flex-row xl:items-center gap-5 mb-8">
                            <div class="w-16 h-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-white transition-all duration-500 shadow-sm shrink-0">
                                <svg class="w-9 h-9 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight group-hover:text-blue-700 transition-colors">Peran Ekologis</h2>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 rounded-2xl p-6 md:p-8 border border-blue-100/60 shadow-inner">
                            <p class="text-blue-900/90 leading-relaxed text-lg font-medium whitespace-pre-line">{{ $ekosistem->peran }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Threats Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(239,68,68,0.1)] hover:shadow-[0_20px_40px_rgb(239,68,68,0.2)] border border-red-100 overflow-hidden relative group transform hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-red-500 via-rose-500 to-orange-500"></div>
                    <div class="flex flex-col xl:flex-row xl:items-center gap-5 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center text-red-500 group-hover:scale-110 group-hover:bg-red-500 group-hover:text-white transition-all duration-500 shadow-sm shrink-0">
                            <svg class="w-9 h-9 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight group-hover:text-red-700 transition-colors">Ancaman & Tantangan</h2>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-orange-50/50 rounded-2xl p-6 md:p-8 border border-red-100/60 shadow-inner">
                        <p class="text-red-900/90 leading-relaxed text-lg font-medium whitespace-pre-line">{{ $ekosistem->ancaman }}</p>
                    </div>
                </div>

                <!-- Admin Actions -->
                @if(auth()->check() && auth()->user()->isAdmin())
                <div class="bg-white rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.1)] border border-gray-200 overflow-hidden relative group transform hover:-translate-y-1 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-gray-400 to-gray-600"></div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Admin Controls
                    </h3>
                    <div class="flex flex-col gap-4">
                        <a href="{{ route('ekosistem.edit', $ekosistem->id_ekosistem) }}" class="flex items-center justify-center gap-2 bg-gradient-to-r from-amber-50 to-orange-50 hover:from-amber-400 hover:to-orange-500 text-amber-700 hover:text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 text-center w-full border border-amber-200 hover:border-transparent shadow-sm hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit Data
                        </a>
                        <button class="delete-btn flex items-center justify-center gap-2 bg-gradient-to-r from-red-50 to-rose-50 hover:from-red-500 hover:to-rose-600 text-red-600 hover:text-white font-bold py-4 px-6 rounded-2xl transition-all duration-300 text-center w-full border border-red-200 hover:border-transparent shadow-sm hover:shadow-md" data-ekosistem-id="{{ $ekosistem->id_ekosistem }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Related Ecosystems Section -->
    @if($relatedEkosistems->count() > 0)
    <div class="w-full bg-gradient-to-b from-slate-50 to-white pt-24 pb-28 mt-12 relative overflow-hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <!-- Header -->
            <div class="text-center mb-14 max-w-3xl mx-auto flex flex-col items-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-[1.5rem] bg-gradient-to-br from-ocean-500 to-blue-600 text-white mb-6 shadow-xl shadow-ocean-500/20 transform hover:scale-105 transition-transform duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Ekosistem <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-500 to-emerald-500">Terkait</span></h2>
                <p class="text-slate-500 text-lg md:text-xl font-medium">Jelajahi ekosistem laut lainnya yang saling terhubung.</p>
                <div class="w-24 h-1.5 bg-gradient-to-r from-ocean-400 to-emerald-400 mx-auto mt-7 rounded-full opacity-80"></div>
            </div>
            
            <!-- Carousel Container -->
            <style>
                .ecosystem-carousel-container {
                    position: relative;
                    width: 100%;
                }
                .ecosystem-carousel-viewport {
                    overflow: hidden;
                    width: 100%;
                    padding: 1rem 0.25rem 2rem 0.25rem;
                }
                .ecosystem-carousel-track {
                    display: flex;
                    gap: 2rem;
                    transition: transform 500ms cubic-bezier(0.4, 0, 0.2, 1);
                    will-change: transform;
                }
                .ecosystem-carousel-item {
                    flex-shrink: 0;
                    width: 100%;
                }
                @media (min-width: 768px) {
                    .ecosystem-carousel-item {
                        width: calc(50% - 1rem);
                    }
                }
                @media (min-width: 1024px) {
                    .ecosystem-carousel-item {
                        width: calc(33.333% - 1.333rem);
                    }
                }
            </style>

            <div class="ecosystem-carousel-container">
                <!-- Navigation Buttons -->
                <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between pointer-events-none z-20">
                    <button id="carousel-prev" class="w-14 h-14 rounded-full bg-white shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),_0_8px_16px_-6px_rgba(0,0,0,0.05)] border border-gray-100/80 flex items-center justify-center text-teal-600 hover:text-teal-700 hover:scale-105 active:scale-95 transition-all duration-300 pointer-events-auto disabled:opacity-0 disabled:pointer-events-none -ml-4 md:-ml-8 lg:-ml-12" aria-label="Previous Ecosystem">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="carousel-next" class="w-14 h-14 rounded-full bg-white shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1),_0_8px_16px_-6px_rgba(0,0,0,0.05)] border border-gray-100/80 flex items-center justify-center text-teal-600 hover:text-teal-700 hover:scale-105 active:scale-95 transition-all duration-300 pointer-events-auto disabled:opacity-0 disabled:pointer-events-none -mr-4 md:-mr-8 lg:-mr-12" aria-label="Next Ecosystem">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <!-- Viewport -->
                <div class="ecosystem-carousel-viewport">
                    <div id="carousel-track" class="ecosystem-carousel-track">
                        @foreach($relatedEkosistems as $related)
                        <div class="ecosystem-carousel-item">
                            <a href="{{ route('ekosistem.show', $related->id_ekosistem) }}" class="group bg-white rounded-[1.5rem] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_40px_-8px_rgba(0,0,0,0.15)] border border-gray-100/80 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1.5 cursor-pointer h-full">
                                
                                <!-- Image Area -->
                                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                                    @if($related->gambar)
                                        <img src="/storage/{{ $related->gambar }}" alt="{{ $related->nama_ekosistem }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ocean-50 text-6xl">🌊</div>
                                    @endif
                                    
                                    <!-- Dark Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300 pointer-events-none"></div>

                                    <!-- Location Badge -->
                                    @if($related->lokasi)
                                    <div class="absolute top-5 left-5 z-10">
                                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-ocean-500/35 backdrop-blur-md text-sky-100 text-[11px] font-bold uppercase tracking-wider rounded-full border border-sky-400/30 shadow-md">
                                            <svg class="w-3.5 h-3.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $related->lokasi }}
                                        </span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Card Body -->
                                <div class="p-6 md:p-7 flex flex-col flex-grow bg-white relative">
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1 group-hover:text-ocean-600 transition-colors">{{ $related->nama_ekosistem }}</h3>
                                        
                                        <p class="text-gray-500 text-sm font-medium leading-relaxed mb-6" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $related->deskripsi ?? 'Tidak ada deskripsi yang tersedia.' }}
                                        </p>
                                    </div>

                                    <!-- Divider Line and Footer Button -->
                                    <div class="pt-5 border-t border-gray-100/80 mt-auto flex items-center justify-between">
                                        <span class="text-ocean-600 font-bold text-xs uppercase tracking-wider group-hover:text-ocean-700 transition-colors">
                                            LIHAT DETAIL
                                        </span>
                                        <div class="w-8 h-8 rounded-full bg-ocean-50 text-ocean-600 flex items-center justify-center group-hover:bg-ocean-500 group-hover:text-white transition-all duration-300 transform group-hover:translate-x-1 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<style>
@keyframes slide-up {
    0% { transform: translateY(100%); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}
.toast-enter { animation: slide-up 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
<script>
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-emerald-500',
            error: 'bg-red-500',
            info: 'bg-ocean-600'
        };

        const notification = document.createElement('div');
        notification.className = `fixed bottom-6 right-6 px-6 py-4 rounded-2xl ${colors[type]} text-white shadow-2xl z-50 flex items-center gap-3 font-medium toast-enter`;
        
        const icon = type === 'success' ? '✅' : (type === 'error' ? '⚠️' : 'ℹ️');
        notification.innerHTML = `<span>${icon}</span> <span>${message}</span>`;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(100%)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Carousel Slider
        const track = document.getElementById('carousel-track');
        const prevBtn = document.getElementById('carousel-prev');
        const nextBtn = document.getElementById('carousel-next');

        if (track && prevBtn && nextBtn) {
            const items = track.querySelectorAll('.ecosystem-carousel-item');
            const totalItems = items.length;
            let currentIndex = 0;

            function getVisibleItemsCount() {
                if (window.innerWidth >= 1024) return 3;
                if (window.innerWidth >= 768) return 2;
                return 1;
            }

            function updateCarousel() {
                const visibleItems = getVisibleItemsCount();
                const maxIndex = Math.max(0, totalItems - visibleItems);

                if (currentIndex > maxIndex) {
                    currentIndex = maxIndex;
                }

                if (totalItems > 0) {
                    const firstItem = items[0];
                    const itemWidth = firstItem.getBoundingClientRect().width;

                    // Calculate the gap dynamically from computed layout
                    let gap = 32;
                    if (items.length > 1) {
                        const secondItem = items[1];
                        gap = secondItem.getBoundingClientRect().left - firstItem.getBoundingClientRect().right;
                    }

                    const offset = currentIndex * (itemWidth + gap);
                    track.style.transform = `translateX(-${offset}px)`;
                }

                // Enable/disable buttons based on limits
                prevBtn.disabled = currentIndex === 0;
                nextBtn.disabled = currentIndex >= maxIndex;
            }

            prevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentIndex > 0) {
                    currentIndex--;
                    updateCarousel();
                }
            });

            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const visibleItems = getVisibleItemsCount();
                const maxIndex = totalItems - visibleItems;
                if (currentIndex < maxIndex) {
                    currentIndex++;
                    updateCarousel();
                }
            });

            // Update on resize
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(updateCarousel, 100);
            });

            // Initial calculation
            setTimeout(updateCarousel, 100);
        }

        // Share button
        const shareBtn = document.querySelector('.share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url;
                navigator.clipboard.writeText(url).then(() => {
                    showNotification('Link berhasil disalin ke clipboard!', 'success');
                }).catch(() => {
                    showNotification('Gagal menyalin link', 'error');
                });
            });
        }

        // Delete button
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus ekosistem ini secara permanen?')) {
                    const id = this.dataset.ekosistemId;
                    const btn = this;
                    
                    btn.disabled = true;
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    btn.innerHTML = '<span class="animate-spin text-xl">⏳</span> Menghapus...';

                    fetch(`/ekosistem/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showNotification('Data ekosistem berhasil dihapus', 'success');
                            setTimeout(() => window.location.href = '{{ route("ekosistem.index") }}', 1000);
                        } else {
                            showNotification(data.message || 'Gagal menghapus data', 'error');
                            resetBtn(btn);
                        }
                    })
                    .catch(err => {
                        showNotification('Terjadi kesalahan jaringan', 'error');
                        resetBtn(btn);
                    });
                }
            });
        }
    });

    function resetBtn(btn) {
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg> Hapus Ekosistem';
    }
</script>

<script type="module">
document.addEventListener('DOMContentLoaded', function() {
    const bookmarkBtn = document.querySelector('.bookmark-btn');
    if (!bookmarkBtn) return;

    fetch('/favorites', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success' && Array.isArray(data.data)) {
            const type = bookmarkBtn.dataset.type;
            const itemId = parseInt(bookmarkBtn.dataset.itemId);
            const isBookmarked = data.data.some(fav => fav.type === type && fav.item_id === itemId);
            if (isBookmarked) {
                setBookmarkActive(bookmarkBtn);
            }
        }
    });

    bookmarkBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const btn = this;
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;
        const isBookmarked = btn.classList.contains('bookmarked');
        const method = isBookmarked ? 'DELETE' : 'POST';

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
                if (isBookmarked) {
                    setBookmarkInactive(btn);
                    showNotification('Dihapus dari bookmark', 'info');
                } else {
                    setBookmarkActive(btn);
                    showNotification('Berhasil disimpan ke bookmark', 'success');
                }
            } else {
                showNotification(data.message, 'error');
            }
        });
    });

    function setBookmarkActive(btn) {
        btn.classList.add('bookmarked', 'bg-white', 'text-ocean-900');
        btn.classList.remove('bg-white/10', 'text-white', 'hover:text-ocean-600');
        const icon = btn.querySelector('.bookmark-icon');
        if (icon) icon.setAttribute('fill', 'currentColor');
    }

    function setBookmarkInactive(btn) {
        btn.classList.remove('bookmarked', 'bg-white', 'text-ocean-900');
        btn.classList.add('bg-white/10', 'text-white', 'hover:text-ocean-600');
        const icon = btn.querySelector('.bookmark-icon');
        if (icon) icon.setAttribute('fill', 'none');
    }
