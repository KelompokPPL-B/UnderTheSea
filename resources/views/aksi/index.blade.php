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
                <a href="{{ route('aksi.create') }}" class="btn btn-primary btn-sm whitespace-nowrap">+ Create Action</a>
            @endauth
        </div>

        <!-- Sort Controls -->
        <div class="mb-6 flex justify-end">
            <select onchange="window.location.href='{{ route('aksi.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Most Popular</option>
            </select>
        </div>

        @if($aksi->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No conservation actions yet. Check back soon!</p>
            </div>
        @else
            <!-- Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($aksi as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden">
                        <!-- Image -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <!-- Title -->
                            <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->judul_aksi }}</h3>
                            </a>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            <!-- Creator Info -->
                            <div class="pt-2 border-t border-ocean-100">
                                <p class="text-xs text-gray-600">
                                    Created by <span class="font-semibold text-ocean-900">{{ $item->createdBy->name }}</span>
                                    <span class="badge badge-success text-xs ml-1">{{ $item->createdBy->badge }}</span>
                                </p>
                            </div>

                            <!-- Like Count and Button -->
                            <div class="pt-2 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $aksi->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection