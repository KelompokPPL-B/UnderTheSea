@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-40 h-40 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-6 py-6 relative z-10">

        <div class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-blue-500 mb-4 tracking-tight">
                🌊 Conservation Actions
            </h1>
            <p class="text-lg text-ocean-600/80 font-medium">Join the movement for ocean conservation. Explore actions you can take today.</p>
        </div>

        <div class="relative mb-16 flex flex-col md:flex-row items-center justify-center gap-4 z-20">

            <form method="GET" action="{{ route('aksi.index') }}" class="w-full max-w-2xl relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                    <span class="pl-5 pr-2 text-2xl">🙌</span>
                    
                    <!-- maxlength="50" DIHAPUS agar validasi backend berjalan -->
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari aksi, gerakan, atau kampanye..." 
                        class="w-full bg-transparent border-none focus:ring-0 px-2 py-3 text-ocean-900 placeholder-ocean-400 font-medium outline-none"
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

                <!-- Pesan Error Validasi dari Backend -->
                @error('search')
                    <p class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 text-red-500 text-sm font-semibold bg-white/90 px-4 py-1 rounded-full shadow-md whitespace-nowrap">
                        {{ $message }}
                    </p>
                @enderror
            </form>

            <div class="relative w-full md:w-auto">
                <select 
                    onchange="window.location.href='{{ route('aksi.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="appearance-none bg-white/80 backdrop-blur-md border border-white/50 text-ocean-700 font-semibold py-3 pl-6 pr-10 rounded-full shadow-lg hover:bg-white transition-all cursor-pointer outline-none focus:ring-2 focus:ring-ocean-300">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>✨ Terbaru</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>⏳ Terlama</option>
                    <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>🔥 Terpopuler</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-ocean-500">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

        </div>

        @auth
            <div class="mb-8 flex justify-end">
                <a href="{{ route('aksi.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all duration-300">
                    + Buat Aksi Baru
                </a>
            </div>
        @endauth

        @if($aksi->isEmpty())
            <div class="bg-white/60 backdrop-blur-lg border border-white rounded-3xl shadow-2xl p-16 text-center max-w-2xl mx-auto transform hover:scale-105 transition-transform duration-500">
                <div class="text-6xl mb-4">🤝</div>
                <h3 class="text-2xl font-bold text-ocean-800 mb-2">Belum Ada Gerakan</h3>
                <p class="text-ocean-600 font-medium">
                    {{ request('search') ? 'Aksi yang kamu cari tidak ditemukan di radar kami.' : 'Jadilah yang pertama untuk memulai aksi pelestarian laut!' }}
                </p>
            </div>
        @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($aksi as $item)
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-ocean-500/20 border border-ocean-50/50 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">

                <div class="relative h-56 overflow-hidden bg-ocean-100">
                    @if($item->gambar)
                        <img src="/storage/{{ $item->gambar }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl bg-gradient-to-br from-ocean-200 to-blue-100">🙌</div>
                    @endif
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between bg-gradient-to-b from-white to-ocean-50/30">
                    <div class="mb-6">
                        <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block">
                            <h3 class="text-2xl font-extrabold text-ocean-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                {{ $item->judul_aksi }}
                            </h3>
                        </a>
                        
                        <p class="text-sm text-gray-500 line-clamp-3 mb-3">
                            {{ $item->deskripsi }}
                        </p>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block w-full bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-3 rounded-xl text-center transition-all duration-300">
                            Lihat Detail Aksi
                            
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $aksi->appends(request()->query())->links() }}
        </div>

        @endif
    </div>
</div>
@endsection