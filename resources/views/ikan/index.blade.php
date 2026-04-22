@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-ocean-900 mb-2">Fish Species</h1>
            <p class="text-gray-600">Explore the diverse and fascinating fish species in our oceans.</p>
        </div>

        <!-- SEARCH CENTER + SORT -->
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
                               focus:ring-2 focus:ring-ocean-400 focus:border-ocean-400"
                    >
                </div>
            </form>

            <!-- SORT -->
            <div class="absolute right-0 top-0">
                <select 
                    onchange="window.location.href='{{ route('ikan.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="select select-bordered select-sm rounded-full border-ocean-200 shadow-sm">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>

        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mb-6 flex justify-end">
                    <a href="{{ route('ikan.create') }}" class="btn btn-primary btn-sm rounded-full shadow-md">
                        + Add Fish
                    </a>
                </div>
            @endif
        @endauth

        @if($ikan->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 font-semibold">
                    {{ request('search') ? 'No results found' : 'No fish data yet' }}
                </p>
            </div>
        @else

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($ikan as $item)
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">

                @if($item->gambar)
                <img src="/storage/{{ $item->gambar }}" class="w-full h-48 object-cover">
                @endif

                <div class="p-6 space-y-3">
                    <h3 class="font-bold text-ocean-900">{{ $item->nama }}</h3>
                    <p class="text-sm text-gray-600">{{ $item->habitat }}</p>

                    <a href="{{ route('ikan.show', $item->id_ikan) }}" class="btn btn-primary btn-sm w-full rounded-full">
                        View
                    </a>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $ikan->appends(request()->query())->links() }}
        </div>

        @endif
    </div>
</div>
@endsection