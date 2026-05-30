@extends('layouts.app')

@section('content')
<!-- PBI-AksiIndex -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-3">Conservation Actions</h1>
                <p class="text-gray-600">Join the movement for ocean conservation. Explore actions you can take today.</p>
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('aksi.create') }}" class="btn btn-primary btn-sm whitespace-nowrap">+ Create Action</a>
                @endif
            @endauth
        </div>

        <!-- Filter & Sort Controls -->
        <form method="GET" action="{{ route('aksi.index') }}" class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-ocean-100 p-8">
                <p class="text-xs font-bold text-ocean-500 uppercase tracking-widest mb-8">🔍 Filter & Sort</p>
                <div class="flex flex-wrap items-end gap-8">
                    <!-- Sort By -->
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sort By</label>
                        <select name="sort" class="select select-bordered w-52">
                            <option value="newest" {{ ($sort ?? 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ ($sort ?? '') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="title_asc" {{ ($sort ?? '') === 'title_asc' ? 'selected' : '' }}>Title A–Z</option>
                            <option value="title_desc" {{ ($sort ?? '') === 'title_desc' ? 'selected' : '' }}>Title Z–A</option>
                        </select>
                    </div>
                    <!-- Filter Tahun -->
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Year</label>
                        <select name="tahun" class="select select-bordered w-52">
                            <option value="">All Years</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ ($filterTahun ?? '') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Buttons -->
                    <div class="ml-10 flex items-end gap-4">
                        <button type="submit" class="btn h-12 min-h-12 px-6 text-sm font-semibold text-white" style="background:#0e7490;border:none;border-radius:10px;">Apply</button>
                        <a href="{{ route('aksi.index') }}" class="btn btn-ghost h-12 min-h-12 px-6 text-sm font-semibold text-gray-500">Reset</a>
                    </div>
                </div>

                @if(($filterTahun ?? '') || ($sort ?? 'newest') !== 'newest')
                    <div class="mt-6 flex flex-wrap items-center gap-2">
                        <span class="text-xs text-gray-400 font-medium">Active Filters:</span>
                        @if(($sort ?? 'newest') !== 'newest')
                            <span class="badge badge-sm" style="background:#f0f9ff;color:#0369a1;border:none;">
                                Sort: {{ match($sort) {
                                    'oldest'     => 'Oldest First',
                                    'title_asc'  => 'Title A–Z',
                                    'title_desc' => 'Title Z–A',
                                    default      => 'Newest First'
                                } }}
                            </span>
                        @endif
                        @if($filterTahun ?? '')
                            <span class="badge badge-sm" style="background:#e0f2fe;color:#0369a1;border:none;">
                                Year: {{ $filterTahun }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </form>

        @if($aksi->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No conservation actions yet. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($aksi as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden">
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <div class="p-6 space-y-4">
                            <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->judul_aksi }}</h3>
                            </a>

                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            <div class="pt-2 border-t border-ocean-100">
                                <p class="text-xs text-gray-600">
                                    Created by <span class="font-semibold text-ocean-900">{{ $item->createdBy->name }}</span>
                                </p>
                            </div>

                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('aksi.show', $item->id_aksi) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('aksi.edit', $item->id_aksi) }}" class="btn btn-outline btn-sm">Edit</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $aksi->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection