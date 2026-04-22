@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-ocean-900 mb-2">Fish Species</h1>
            <p class="text-gray-600">Explore the diverse and fascinating fish species in our oceans.</p>
        </div>

        <!-- SEARCH CENTER + SORT RIGHT -->
        <div class="relative mb-10">

            <!-- SEARCH -->
            <form method="GET" action="{{ route('ikan.index') }}" class="flex justify-center">
                <div class="relative w-full max-w-md">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ocean-400">🔍</span>

                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search fish..." 
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
                    onchange="window.location.href='{{ route('ikan.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="select select-bordered select-sm rounded-full border-ocean-200 shadow-sm">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                
                </select>
            </div>

        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('ikan.create') }}" class="btn btn-primary btn-sm rounded-full shadow-md">
                        + Add New Fish
                    </a>
                </div>
            @endif
        @endauth

        @if($ikan->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">
                    {{ request('search') ? 'No results found for "' . request('search') . '"' : 'No fish species found yet.' }}
                </p>
            </div>
        @else

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ikan as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] overflow-hidden">

                        <!-- IMAGE -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}" 
                                    class="w-full h-48 object-cover group-hover:scale-105 transition">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- CONTENT -->
                        <div class="p-6 space-y-4">

                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->nama }}</h3>
                            </a>

                            @if($item->habitat)
                                <p class="text-xs text-gray-500 font-semibold">🌊 {{ $item->habitat }}</p>
                            @endif

                            <p class="text-gray-600 text-sm line-clamp-2">
                                {{ $item->deskripsi ?? 'No description' }}
                            </p>

                            @if($item->status_konservasi)
                                <div class="pt-2 border-t border-ocean-100">
                                    <p class="text-xs">
                                        <span class="font-semibold text-ocean-900">Status:</span> 
                                        <span class="text-gray-600">{{ $item->status_konservasi }}</span>
                                    </p>
                                </div>
                            @endif

                            <!-- BOOKMARK -->
                            @auth
                                <button class="bookmark-btn-card w-full btn btn-outline btn-sm rounded-full" 
                                        data-type="ikan" data-item-id="{{ $item->id_ikan }}">
                                    <span class="bookmark-text">Bookmark</span>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-600 hover:underline font-semibold">
                                    Sign in to bookmark
                                </a>
                            @endauth

                            <!-- ACTION -->
                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-primary btn-sm flex-1 rounded-full">
                                    View
                                </a>

                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <a href="{{ route('ikan.edit', $item->id_ikan) }}" class="btn btn-outline btn-sm rounded-full">
                                        Edit
                                    </a>
                                    <button class="delete-btn-card btn btn-error btn-sm rounded-full" 
                                            data-ikan-id="{{ $item->id_ikan }}">
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
                {{ $ikan->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
</div>
@endsection