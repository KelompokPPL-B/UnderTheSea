@extends('layouts.app')

@section('content')
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

        <!-- Conservation Spotlight Section -->
        <div class="mb-16 relative w-full z-20">
            <!-- Decorative background glow for spotlight -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-96 bg-gradient-to-r from-blue-400/20 to-emerald-400/20 rounded-[3rem] blur-3xl pointer-events-none"></div>
        
            <div class="text-center mb-10 relative z-10">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Conservation <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-600 to-emerald-500">Spotlight</span></h2>
                <p class="text-lg text-gray-600 font-medium max-w-2xl mx-auto">Monitor marine ecosystems and critical environmental issues that need our attention.</p>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                
                <!-- Featured Card: Coral Reefs (col-span-2, row-span-2) -->
                <div class="group relative rounded-[2rem] overflow-hidden shadow-xl hover:shadow-2xl md:col-span-2 lg:col-span-2 lg:row-span-2 aspect-[4/3] lg:aspect-auto flex flex-col justify-end p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&q=80" alt="Coral Reefs at Critical Risk" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/95 via-gray-900/50 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto flex justify-between items-start">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-2 px-4 py-1.5 bg-gradient-to-r from-red-500/90 to-rose-500/90 hover:from-red-500 hover:to-rose-500 text-white text-sm font-bold rounded-full shadow-lg backdrop-blur-md border border-red-400/50 hover:shadow-red-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-400">
                                <span class="relative flex h-2.5 w-2.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
                                </span>
                                Critical
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is facing severe threats and requires immediate action.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative z-10 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="text-3xl lg:text-4xl font-black text-white mb-3 leading-tight drop-shadow-md">Coral Reefs at Critical Risk</h3>
                        <p class="text-gray-200 text-base lg:text-lg mb-6 line-clamp-3 font-medium text-shadow-sm opacity-90 group-hover:opacity-100 transition-opacity">
                            Coral bleaching caused by rising ocean temperatures threatens coral reef ecosystems and the marine species that depend on them.
                        </p>
                    </div>
                </div>
        
                <!-- Card 2: Mangrove Forests -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-square md:aspect-auto md:min-h-[260px] flex flex-col justify-end p-6 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="{{ asset('images/conservation/mangrove.png') }}" alt="Declining Mangrove Forests" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-orange-500/90 to-amber-500/90 hover:from-orange-500 hover:to-amber-500 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-orange-400/50 hover:shadow-orange-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Threatened
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is at risk of becoming critical if no action is taken.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-orange-300 transition-colors">Declining Mangrove Forests</h4>
                        <p class="text-gray-300 text-sm line-clamp-3 font-medium opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto group-hover:mt-2 transition-all duration-500 overflow-hidden">
                            Land conversion and illegal logging continue to reduce mangrove coverage, increasing coastal vulnerability.
                        </p>
                    </div>
                </div>
        
                <!-- Card 3: Seagrass Degradation -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-square md:aspect-auto md:min-h-[260px] flex flex-col justify-end p-6 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="{{ asset('images/conservation/seagrass.png') }}" alt="Degraded Seagrass Meadows" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-yellow-500/90 to-amber-400/90 hover:from-yellow-500 hover:to-amber-400 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-yellow-400/50 hover:shadow-yellow-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Vulnerable
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem shows signs of decline and needs continuous monitoring.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-yellow-300 transition-colors">Degraded Seagrass Meadows</h4>
                        <p class="text-gray-300 text-sm line-clamp-3 font-medium opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto group-hover:mt-2 transition-all duration-500 overflow-hidden">
                            Pollution and human activities are damaging seagrass habitats that support dugongs and sea turtles.
                        </p>
                    </div>
                </div>
        
                <!-- Card 4: Sea Turtle -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-square md:aspect-auto md:min-h-[260px] flex flex-col justify-end p-6 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="{{ asset('images/conservation/turtle.png') }}" alt="Declining Sea Turtle Population" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-orange-500/90 to-amber-500/90 hover:from-orange-500 hover:to-amber-500 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-orange-400/50 hover:shadow-orange-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-orange-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Threatened
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is at risk of becoming critical if no action is taken.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-orange-300 transition-colors">Declining Sea Turtle Population</h4>
                        <p class="text-gray-300 text-sm line-clamp-3 font-medium opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto group-hover:mt-2 transition-all duration-500 overflow-hidden">
                            Habitat destruction, plastic waste, and egg poaching contribute to decreasing sea turtle populations.
                        </p>
                    </div>
                </div>
        
                <!-- Card 5: Ocean Plastic Pollution -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-square md:aspect-auto md:min-h-[260px] flex flex-col justify-end p-6 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="{{ asset('images/conservation/plastic.png') }}" alt="Ocean Plastic Pollution" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-red-500/90 to-rose-500/90 hover:from-red-500 hover:to-rose-500 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-red-400/50 hover:shadow-red-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Critical
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is facing severe threats and requires immediate action.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-red-300 transition-colors">Ocean Plastic Pollution</h4>
                        <p class="text-gray-300 text-sm line-clamp-3 font-medium opacity-0 group-hover:opacity-100 h-0 group-hover:h-auto group-hover:mt-2 transition-all duration-500 overflow-hidden">
                            Plastic waste threatens marine life and disrupts ecosystem balance across the oceans.
                        </p>
                    </div>
                </div>
        
                <!-- Card 6: Global Ocean Warming (col-span-2) -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-[2/1] md:aspect-auto md:col-span-2 lg:col-span-2 md:min-h-[260px] flex flex-col justify-end p-6 md:p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="https://images.unsplash.com/photo-1582967788606-a171c1080cb0?auto=format&fit=crop&q=80" alt="Global Ocean Warming" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto flex justify-between items-start">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-red-500/90 to-rose-500/90 hover:from-red-500 hover:to-rose-500 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-red-400/50 hover:shadow-red-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Critical
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is facing severe threats and requires immediate action.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h4 class="text-2xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-red-300 transition-colors">Global Ocean Warming</h4>
                        <p class="text-gray-300 text-sm md:text-base font-medium line-clamp-2 opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                            Rising sea temperatures affect marine biodiversity, migration patterns, and food chains.
                        </p>
                    </div>
                </div>
        
                <!-- Card 7: Raja Ampat Conservation Area (col-span-2) -->
                <div class="group relative rounded-[1.5rem] overflow-hidden shadow-lg hover:shadow-xl aspect-[2/1] md:aspect-auto md:col-span-2 lg:col-span-2 md:min-h-[260px] flex flex-col justify-end p-6 md:p-8 border border-white/40 bg-gray-900 transition-all duration-500 hover:-translate-y-2 cursor-default">
                    <img src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&q=80" alt="Raja Ampat Conservation Area" class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:scale-105 group-hover:opacity-60 transition-all duration-700 z-0">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-0"></div>
                    
                    <div class="relative z-10 mb-auto flex justify-between items-start">
                        <div class="group/badge relative inline-block z-30">
                            <span tabindex="0" class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-blue-500/90 to-cyan-500/90 hover:from-blue-500 hover:to-cyan-500 text-white text-xs font-bold rounded-full shadow-sm backdrop-blur-md border border-blue-400/50 hover:shadow-blue-500/40 transition-all duration-300 cursor-help transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>
                                Recovering
                            </span>
                            <div class="pointer-events-none absolute left-0 top-full mt-2 w-48 md:w-56 opacity-0 translate-y-1 group-hover/badge:opacity-100 group-hover/badge:translate-y-0 group-focus-within/badge:opacity-100 group-focus-within/badge:translate-y-0 transition-all duration-300 z-50">
                                <div class="bg-gray-900/95 backdrop-blur-xl text-white text-xs p-3 rounded-xl shadow-xl border border-gray-700/50 leading-relaxed font-medium">
                                    Ecosystem is improving due to conservation and restoration efforts.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h4 class="text-2xl font-bold text-white mb-2 leading-snug drop-shadow-md group-hover:text-blue-300 transition-colors">Raja Ampat Conservation Area</h4>
                        <p class="text-gray-300 text-sm md:text-base font-medium line-clamp-2 opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                            Conservation efforts have helped restore coral reef health and marine biodiversity in several areas.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Search & Filter Controls -->
        <div class="flex flex-col gap-4 mb-12 relative z-20">
            <!-- Top Row: Search and Sort -->
            <div class="relative flex flex-col md:flex-row items-center justify-center gap-4">
                <form method="GET" action="{{ route('ekosistem.index') }}" class="w-full max-w-2xl relative group search-form" novalidate>
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
                    <!-- Validation message container -->
                    <div class="search-error-msg text-red-500 text-sm font-semibold mt-2 pl-6 hidden"></div>
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

            <!-- Bottom Row: Favorites Filters -->
            <div class="flex flex-wrap items-center justify-center gap-3">
                <button id="filter-likes-btn" class="px-5 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 transition-all duration-300 {{ request()->has('filter_likes') ? 'bg-red-500 text-white shadow-lg shadow-red-500/30 border-red-500' : 'bg-white/80 text-gray-600 hover:bg-white hover:text-red-500 border-gray-200 border shadow-sm' }}">
                    <svg class="w-4 h-4 {{ request()->has('filter_likes') ? 'fill-current text-white' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Likes Saya
                </button>

                <button id="filter-bookmarks-btn" class="px-5 py-2.5 rounded-full font-bold text-sm flex items-center gap-2 transition-all duration-300 {{ request()->has('filter_bookmarks') ? 'bg-ocean-500 text-white shadow-lg shadow-ocean-500/30 border-ocean-500' : 'bg-white/80 text-gray-600 hover:bg-white hover:text-ocean-500 border-gray-200 border shadow-sm' }}">
                    <svg class="w-4 h-4 {{ request()->has('filter_bookmarks') ? 'fill-current text-white' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Bookmarks Saya
                </button>
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
            <style>
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(16px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .animate-fade-in {
                    animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
                }
            </style>
            <div class="bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-2xl p-12 md:p-16 text-center max-w-2xl mx-auto animate-fade-in">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner animate-bounce">
                    🐠
                </div>
                <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Data Tidak Ditemukan</h3>
                <p class="text-slate-600 font-medium max-w-md mx-auto mb-8">
                    {{ request('search') ? 'Pencarian Anda tidak menghasilkan data yang sesuai. Coba gunakan kata kunci lain.' : 'Belum ada data ekosistem yang terdaftar di sistem.' }}
                </p>
                @if(request('search'))
                    <a href="{{ route('ekosistem.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-ocean-600 to-blue-500 hover:from-ocean-700 hover:to-blue-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-ocean-500/30 hover:scale-105 active:scale-95 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18" />
                        </svg>
                        Reset Pencarian
                    </a>
                @endif
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

    // === FILTER BUTTON LOGIC ===
    const filterLikesBtn = document.getElementById('filter-likes-btn');
    if (filterLikesBtn) {
        filterLikesBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentUrl = new URL(window.location.href);
            if (currentUrl.searchParams.has('filter_likes')) {
                currentUrl.searchParams.delete('filter_likes');
                window.location.href = currentUrl.toString();
            } else {
                currentUrl.searchParams.delete('filter_bookmarks');
                const likes = safeParseJSON(localStorage.getItem('likes_ekosistem'));
                currentUrl.searchParams.set('filter_likes', likes.join(','));
                window.location.href = currentUrl.toString();
            }
        });
    }

    const filterBookmarksBtn = document.getElementById('filter-bookmarks-btn');
    if (filterBookmarksBtn) {
        filterBookmarksBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const currentUrl = new URL(window.location.href);
            if (currentUrl.searchParams.has('filter_bookmarks')) {
                currentUrl.searchParams.delete('filter_bookmarks');
                window.location.href = currentUrl.toString();
            } else {
                currentUrl.searchParams.delete('filter_likes');
                const bookmarks = safeParseJSON(localStorage.getItem('bookmarks_ekosistem'));
                currentUrl.searchParams.set('filter_bookmarks', bookmarks.join(','));
                window.location.href = currentUrl.toString();
            }
        });
    }

    // === SEARCH VALIDATION LOGIC ===
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
                // Hanya izinkan huruf, angka, dan spasi
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
});
</script>
@endpush
@endsection
