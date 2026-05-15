@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-40 h-40 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="max-w-7xl mx-auto px-6 py-6 relative z-10">

        <div class="mb-12 text-center">
            <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-blue-500 mb-4 tracking-tight">
                🌊 Marine Ecosystems
            </h1>
            <p class="text-lg text-ocean-600/80 font-medium">Discover the diverse ecosystems that make up our oceans and learn about their importance.</p>
        </div>

        <div class="relative mb-16 flex flex-col md:flex-row items-center justify-center gap-4 z-20">

            <form method="GET" action="{{ route('ekosistem.index') }}" class="w-full max-w-2xl relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                    <span class="pl-5 pr-2 text-2xl">🫧</span>
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari ekosistem, lokasi, atau deskripsi..." 
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

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mb-8 flex justify-end">
                    <a href="{{ route('ekosistem.create') }}" class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-emerald-500/40 transform hover:-translate-y-1 transition-all duration-300">
                        + Tambah Ekosistem
                    </a>
                </div>
            @endif
        @endauth

        @if($ekosistem->isEmpty())
            <div class="bg-white/60 backdrop-blur-lg border border-white rounded-3xl shadow-2xl p-16 text-center max-w-2xl mx-auto transform hover:scale-105 transition-transform duration-500">
                <div class="text-6xl mb-4">🪸</div>
                <h3 class="text-2xl font-bold text-ocean-800 mb-2">Data Kosong</h3>
                <p class="text-ocean-600 font-medium">
                    {{ request('search') ? 'Tidak ada ekosistem yang cocok dengan pencarian Anda.' : 'Belum ada data ekosistem yang tercatat.' }}
                </p>
            </div>
        @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ekosistem as $item)
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:shadow-ocean-500/20 border border-ocean-50/50 transform hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col relative">

                <div class="relative h-56 overflow-hidden bg-ocean-100">
                    @if($item->gambar)
                        <img src="/storage/{{ $item->gambar }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-4xl">🌊</div>
                    @endif
                    @if($item->lokasi)
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur text-ocean-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                            📍 {{ $item->lokasi }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between bg-gradient-to-b from-white to-ocean-50/30">
                    <div>
                        <h3 class="text-2xl font-extrabold text-ocean-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $item->nama_ekosistem }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                            {{ $item->deskripsi ?? 'No description' }}
                        </p>
                        @if($item->peran)
                            <div class="mb-4 pt-2 border-t border-ocean-100">
                                <p class="text-xs text-gray-600"><span class="font-semibold">Role:</span> <span class="line-clamp-1">{{ $item->peran }}</span></p>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-3">
                        @auth
                            <button class="bookmark-btn-card w-full btn btn-outline btn-sm rounded-xl" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}">
                                <span class="bookmark-text">Bookmark</span>
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-600 hover:underline font-semibold">Sign in to bookmark</a>
                        @endauth
                        
                        <div class="flex gap-2">
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="flex-1 bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-2 rounded-xl text-center transition-all duration-300 text-sm">
                                Lihat Detail
                            </a>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="bg-amber-100 hover:bg-amber-500 text-amber-700 hover:text-white font-bold py-2 px-4 rounded-xl text-center transition-all duration-300 text-sm">
                                    Edit
                                </a>
                                <button class="delete-btn-card bg-red-100 hover:bg-red-500 text-red-700 hover:text-white font-bold py-2 px-4 rounded-xl text-center transition-all duration-300 text-sm" data-ekosistem-id="{{ $item->id_ekosistem }}">
                                    Hapus
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $ekosistem->appends(request()->query())->links() }}
        </div>

        @endif
    </div>
</div>

@push('scripts')
<script>
// Global helper - harus di luar module
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

<script type="module">
document.addEventListener('DOMContentLoaded', function() {
    initializeBookmarkButtonsCard();
    loadBookmarkStatesCard();
});

function initializeBookmarkButtonsCard() {
    document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
        btn.addEventListener('click', toggleBookmarkCard);
    });
}

function toggleBookmarkCard(e) {
    e.preventDefault();
    const btn = e.currentTarget;
    const type = btn.dataset.type;
    const itemId = btn.dataset.itemId;
    const isBookmarked = btn.classList.contains('bookmarked');
    const method = isBookmarked ? 'DELETE' : 'POST';

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
            btn.classList.toggle('bookmarked');
            btn.classList.toggle('bg-blue-600');
            btn.classList.toggle('text-white');
            btn.classList.toggle('border-blue-600');
            btn.classList.toggle('text-blue-600');
            btn.classList.toggle('hover:bg-blue-50');
            const text = btn.querySelector('.bookmark-text');
            if (text) text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error('Error:', err));
}

function loadBookmarkStatesCard() {
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
                    btn.classList.add('bookmarked', 'bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.remove('text-blue-600', 'hover:bg-blue-50');
                    const text = btn.querySelector('.bookmark-text');
                    if (text) text.textContent = 'Bookmarked';
                }
            });
        }
    })
    .catch(err => console.error('Error loading bookmark state:', err));
}
</script>
@endpush
@endsection
