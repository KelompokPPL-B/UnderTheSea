@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-ocean-900 mb-2">Marine Ecosystems</h1>
            <p class="text-gray-600">Discover the diverse ecosystems that make up our oceans and learn about their importance.</p>
        </div>

        <!-- SEARCH CENTER + SORT RIGHT -->
        <div class="relative mb-10">

            <!-- SEARCH -->
            <form method="GET" action="{{ route('ekosistem.index') }}" class="flex justify-center">
                <div class="relative w-full max-w-md">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ocean-400">🔍</span>

                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search ecosystems..." 
                        class="w-full input input-bordered pl-10 pr-4 py-2 
                               rounded-full shadow-md border-ocean-200
                               focus:ring-2 focus:ring-ocean-400 focus:border-ocean-400 
                               transition"
                    >
                </div>
            </form>

            <!-- SORT -->
            <div class="absolute right-0 top-0">
                <select 
                    onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="select select-bordered select-sm rounded-full border-ocean-200 shadow-sm">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                
                </select>
            </div>

        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('ekosistem.create') }}" class="btn btn-primary btn-sm rounded-full shadow-md">
                        + Add New Ecosystem
                    </a>
                </div>
            @endif
        @endauth

        @if($ekosistem->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">
                    {{ request('search') ? 'No results found for "' . request('search') . '"' : 'No ecosystems found yet.' }}
                </p>
            </div>
        @else

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ekosistem as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] overflow-hidden">

                        <!-- IMAGE -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}" 
                                    class="w-full h-48 object-cover group-hover:scale-105 transition">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- CONTENT -->
                        <div class="p-6 space-y-4">

                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->nama_ekosistem }}</h3>
                            </a>

                            @if($item->lokasi)
                                <p class="text-xs text-gray-500 font-semibold">📍 {{ $item->lokasi }}</p>
                            @endif

                            <p class="text-gray-600 text-sm line-clamp-2">
                                {{ $item->deskripsi ?? 'No description' }}
                            </p>

                            @if($item->peran)
                                <div class="pt-2 border-t border-ocean-100">
                                    <p class="text-xs text-gray-600">
                                        <span class="font-semibold">Role:</span> 
                                        <span class="line-clamp-1">{{ $item->peran }}</span>
                                    </p>
                                </div>
                            @endif

                            <!-- BOOKMARK -->
                            @auth
                                <button class="bookmark-btn-card w-full btn btn-outline btn-sm rounded-full" 
                                        data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}">
                                    <span class="bookmark-text">Bookmark</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-600 hover:underline font-semibold">
                                    Sign in to bookmark
                                </a>
                            @endauth

                            <!-- ACTION -->
                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="btn btn-primary btn-sm flex-1 rounded-full">
                                    View
                                </a>

                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="btn btn-outline btn-sm rounded-full">
                                        Edit
                                    </a>
                                    <button class="delete-btn-card btn btn-error btn-sm rounded-full" 
                                            data-ekosistem-id="{{ $item->id_ekosistem }}">
                                        Delete
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-8 flex justify-center">
                {{ $ekosistem->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</div>
@endsection