@extends('layouts.app')

@section('content')
<!-- PBI-Bookmarks -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-ocean-900 mb-3">My Bookmarks</h1>
            <p class="text-gray-600 text-lg">All your saved fish, ecosystems, and conservation actions.</p>
        </div>

        @if($favorites->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-16 text-center">
                <p class="text-ocean-600 text-xl font-semibold mb-4">No bookmarks yet</p>
                <p class="text-gray-600 mb-8">Start bookmarking fish, ecosystems, and actions you want to save.</p>
                <a href="{{ route('ikan.index') }}" class="btn btn-primary">Explore Content</a>
            </div>
        @else
            <!-- Bookmarks Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade">
                @foreach($favorites as $fav)
                    @php $item = $fav->getItem(); @endphp
                    @if($item)
                        <div class="bookmark-card bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade">
                            <!-- Image -->
                            @if($item->gambar ?? false)
                                <div class="overflow-hidden h-48">
                                    <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama ?? $item->nama_ekosistem ?? $item->judul_aksi }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                    <span class="text-ocean-400">No image</span>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6 space-y-4">
                                <!-- Badge -->
                                <span class="badge {{ $fav->type === 'ikan' ? 'badge-info' : ($fav->type === 'ekosistem' ? 'badge-success' : 'badge-warning') }}">
                                    {{ ucfirst($fav->type) }}
                                </span>

                                <!-- Title -->
                                @if($fav->type === 'ikan')
                                    <a href="{{ route('ikan.show', $item->id_ikan) }}" class="block group-hover:text-ocean-600 transition">
                                        <h3 class="text-lg font-bold text-ocean-900">{{ $item->nama }}</h3>
                                    </a>
                                @elseif($fav->type === 'ekosistem')
                                    <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="block group-hover:text-ocean-600 transition">
                                        <h3 class="text-lg font-bold text-ocean-900">{{ $item->nama_ekosistem }}</h3>
                                    </a>
                                @else
                                    <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block group-hover:text-ocean-600 transition">
                                        <h3 class="text-lg font-bold text-ocean-900">{{ $item->judul_aksi }}</h3>
                                    </a>
                                @endif

                                <!-- Description -->
                                <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                                <!-- View Detail Link -->
                                <div class="pt-2">
                                    @if($fav->type === 'ikan')
                                        <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-primary btn-sm w-full">
                                            View Details
                                        </a>
                                    @elseif($fav->type === 'ekosistem')
                                        <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="btn btn-primary btn-sm w-full">
                                            View Details
                                        </a>
                                    @else
                                        <a href="{{ route('aksi.show', $item->id_aksi) }}" class="btn btn-primary btn-sm w-full">
                                            View Details
                                        </a>
                                    @endif
                                </div>

                                <!-- Remove Bookmark -->
                                <div class="pt-2">
                                    <button class="remove-bookmark-btn btn btn-error btn-outline btn-sm w-full" data-type="{{ $fav->type }}" data-id="{{ $fav->item_id }}">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
