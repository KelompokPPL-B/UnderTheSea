@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- HEADER -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-ocean-900 mb-2">Conservation Actions</h1>
            <p class="text-gray-600">Join the movement for ocean conservation. Explore actions you can take today.</p>
        </div>

        <!-- SEARCH + SORT -->
        <div class="relative mb-10">

            <!-- SEARCH CENTER -->
            <form method="GET" action="{{ route('aksi.index') }}" class="flex justify-center">
                <div class="relative w-full max-w-md">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ocean-400">🔍</span>

                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search actions..." 
                        class="w-full input input-bordered pl-10 pr-4 py-2 
                               rounded-full shadow-md border-ocean-200
                               focus:ring-2 focus:ring-ocean-400 focus:border-ocean-400 
                               transition"
                    >
                </div>
            </form>

            <!-- SORT RIGHT -->
            <div class="absolute right-0 top-0">
                <select 
                    onchange="window.location.href='{{ route('aksi.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="select select-bordered select-sm rounded-full border-ocean-200 shadow-sm">

                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Popular</option>

                </select>
            </div>

        </div>

        @auth
            <div class="mb-6 flex justify-end">
                <a href="{{ route('aksi.create') }}" class="btn btn-primary btn-sm rounded-full shadow-md">
                    + Create Action
                </a>
            </div>
        @endauth

        @if($aksi->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">
                    {{ request('search') ? 'No results found for "' . request('search') . '"' : 'No actions yet.' }}
                </p>
            </div>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($aksi as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] overflow-hidden">

                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" class="w-full h-48 object-cover">
                            </div>
                        @endif

                        <div class="p-6 space-y-4">

                            <a href="{{ route('aksi.show', $item->id_aksi) }}">
                                <h3 class="text-lg font-bold text-ocean-900">{{ $item->judul_aksi }}</h3>
                            </a>

                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>

                            <div class="flex gap-2 mt-3 pt-3 border-t">
                                <a href="{{ route('aksi.show', $item->id_aksi) }}" class="btn btn-primary btn-sm flex-1 rounded-full">
                                    View
                                </a>
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