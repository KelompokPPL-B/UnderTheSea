@extends('layouts.app')

@section('content')
@php
    $fishList = $ikan ?? $ikans ?? collect();
@endphp

<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">

    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-40 h-40 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-6 py-6 relative z-10">

        <div class="flex justify-between items-start mb-10">
            <div>
                <h2 class="text-4xl font-bold text-ocean-900 mb-3">Fish Species</h2>
                <p class="text-gray-600">Explore the diverse and fascinating fish species in our oceans.</p>
            </div>

            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('ikan.create') }}" class="btn btn-success btn-sm">
                        + Add New Fish
                    </a>
                @endif
            @endauth
        </div>

        <form method="GET" action="{{ route('ikan.index') }}" class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-ocean-100 p-5">
                <p class="text-xs font-bold text-ocean-500 uppercase tracking-widest mb-4">🔍 Filter & Sort</p>

                <div class="flex flex-wrap gap-4 items-end">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sort By</label>
                        <select name="sort" class="select select-bordered select-sm text-sm min-w-[160px]">
                            <option value="newest" {{ ($sort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ ($sort ?? '') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="name_asc" {{ ($sort ?? '') === 'name_asc' ? 'selected' : '' }}>Name A–Z</option>
                            <option value="name_desc" {{ ($sort ?? '') === 'name_desc' ? 'selected' : '' }}>Name Z–A</option>
                        </select>
                    </div>

                    @isset($habitatList)
                        <div class="flex flex-col gap-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Habitat</label>
                            <select name="habitat" class="select select-bordered select-sm text-sm min-w-[150px]">
                                <option value="">All Habitats</option>
                                @foreach($habitatList as $h)
                                    <option value="{{ $h }}" {{ ($filterHabitat ?? '') === $h ? 'selected' : '' }}>
                                        {{ $h }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endisset

                    @isset($statusList)
                        <div class="flex flex-col gap-1">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Conservation Status</label>
                            <select name="status" class="select select-bordered select-sm text-sm min-w-[190px]">
                                <option value="">All Statuses</option>
                                @foreach($statusList as $s)
                                    <option value="{{ $s }}" {{ ($filterStatus ?? '') === $s ? 'selected' : '' }}>
                                        {{ $s }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endisset

                    <div class="flex gap-2 items-end" style="padding-bottom:1px;">
                        <button type="submit" class="btn btn-sm text-sm font-semibold px-5" style="background:#0e7490;color:#fff;border:none;">
                            Apply
                        </button>

                        <a href="{{ route('ikan.index') }}" class="btn btn-sm btn-ghost text-sm font-semibold px-4 text-gray-500">
                            Reset
                        </a>
                    </div>
                </div>

                @if(($filterHabitat ?? '') || ($filterStatus ?? ''))
                    <div class="mt-3 flex flex-wrap gap-2 items-center">
                        <span class="text-xs text-gray-400 font-medium">Active filters:</span>

                        @if($filterHabitat ?? '')
                            <span class="badge badge-sm" style="background:#e0f2fe;color:#0369a1;border:none;">
                                Habitat: {{ $filterHabitat }}
                            </span>
                        @endif

                        @if($filterStatus ?? '')
                            <span class="badge badge-sm" style="background:#dcfce7;color:#166534;border:none;">
                                Status: {{ $filterStatus }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </form>

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(16px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .animate-fade-in {
                animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
        </style>

        @if($fishList->isEmpty())
            <div class="bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-2xl p-12 md:p-16 text-center max-w-2xl mx-auto animate-fade-in">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner animate-bounce">
                    🐠
                </div>

                <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Data Tidak Ditemukan</h3>

                <p class="text-slate-600 font-medium max-w-md mx-auto mb-8">
                    Belum ada data ikan di perairan ini.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                @foreach($fishList as $item)
                    <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-ocean-500/20 border border-ocean-50/50 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="relative h-56 overflow-hidden bg-ocean-100">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-4xl">🐟</div>
                            @endif

                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 backdrop-blur text-ocean-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                    🌊 {{ $item->habitat ?? 'Laut Lepas' }}
                                </span>
                            </div>

                            @if($item->status_konservasi)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                        {{ $item->status_konservasi }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between bg-gradient-to-b from-white to-ocean-50/30">
                            <div>
                                <h3 class="text-2xl font-extrabold text-ocean-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $item->nama }}
                                </h3>

                                <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                                    {{ $item->deskripsi ?? 'Spesies menakjubkan dari kedalaman laut.' }}
                                </p>

                                @if($item->status_konservasi)
                                    <div class="pt-2 border-t border-ocean-100 mb-4">
                                        <p class="text-xs">
                                            <span class="font-semibold text-ocean-900">Status:</span>
                                            <span class="text-gray-600">{{ $item->status_konservasi }}</span>
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="flex gap-2 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-sm flex-1 text-sm font-semibold" style="background:#0e7490;color:#fff;border:none;">
                                    Lihat Detail
                                </a>

                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('ikan.edit', $item->id_ikan) }}" class="btn btn-sm text-sm font-semibold" style="background:#f59e0b;color:#fff;border:none;">
                                            Edit
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                {{ $fishList->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</div>
@endsection