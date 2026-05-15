@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <!-- Animated Blobs Background -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-32 left-1/3 w-80 h-80 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">

        <!-- Header -->
        <div class="mb-14 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-ocean-500 to-emerald-400 shadow-xl shadow-ocean-500/30 mb-6 border-4 border-white transform hover:scale-110 transition-transform duration-300">
                <span class="text-4xl text-white">🌊</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-ocean-900 via-blue-700 to-emerald-600 mb-4 tracking-tight drop-shadow-sm">
                Katalog Ekosistem
            </h1>
            <p class="text-lg md:text-xl text-ocean-700 font-medium max-w-2xl mx-auto bg-white/50 inline-block px-8 py-2.5 rounded-full backdrop-blur-sm border border-white shadow-sm">
                Jelajahi dan pelajari beragam ekosistem menakjubkan di lautan kita.
            </p>
        </div>

        <!-- Search & Filter Controls -->
        <div class="relative mb-16 flex flex-col md:flex-row items-center justify-center gap-5 z-20">

            <form method="GET" action="{{ route('ekosistem.index') }}" class="w-full max-w-2xl relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-400 via-blue-400 to-emerald-400 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative bg-white/90 backdrop-blur-xl rounded-full p-2 flex items-center shadow-lg border border-white/60">
                    <span class="pl-5 pr-2 text-2xl">🫧</span>
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Eksplorasi nama, lokasi, atau deskripsi..." 
                        class="w-full bg-transparent border-none focus:ring-0 px-3 py-3 text-ocean-900 placeholder-ocean-400 font-semibold outline-none text-base"
                    >

                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white px-8 py-3.5 rounded-full font-bold tracking-wide shadow-md transform hover:scale-[1.02] transition-all duration-300 flex items-center gap-2"
                    >
                        <span>Cari</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="relative w-full md:w-auto group">
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-200 to-blue-200 rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <select 
                    onchange="window.location.href='{{ route('ekosistem.index') }}?sort=' + this.value + '&search={{ request('search') }}'" 
                    class="relative appearance-none bg-white/90 backdrop-blur-xl border border-white/60 text-ocean-800 font-bold py-4 pl-6 pr-12 rounded-full shadow-lg hover:bg-white transition-all cursor-pointer outline-none focus:ring-4 focus:ring-ocean-500/10">
                    
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>✨ Terbaru</option>
                    <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>⏳ Terlama</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-ocean-600">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

        </div>

        @auth
            @if(auth()->user()->isAdmin())
                <div class="mb-8 flex justify-end">
                    <a href="{{ route('ekosistem.create') }}" class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-extrabold py-3 px-8 rounded-full shadow-xl shadow-ocean-500/20 transform hover:-translate-y-1 hover:shadow-emerald-500/30 transition-all duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Ekosistem
                    </a>
                </div>
            @endif
        @endauth

        @if($ekosistem->isEmpty())
            <div class="bg-white/80 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-2xl p-16 text-center max-w-2xl mx-auto transform hover:scale-105 transition-transform duration-500">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-ocean-50 text-6xl mb-6 shadow-inner">
                    🪸
                </div>
                <h3 class="text-3xl font-black text-ocean-900 mb-3 drop-shadow-sm">Belum Ada Catatan</h3>
                <p class="text-ocean-600 font-medium text-lg">
                    {{ request('search') ? 'Tidak ada ekosistem yang cocok dengan pencarian Anda.' : 'Perairan ini masih belum dipetakan. Belum ada data ekosistem yang tercatat.' }}
                </p>
            </div>
        @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ekosistem as $item)
            <div class="group bg-white/90 backdrop-blur-lg rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-2xl hover:shadow-ocean-500/15 border border-white/60 transform hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col relative">

                <div class="relative h-60 overflow-hidden bg-gradient-to-br from-ocean-100 to-cyan-50">
                    @if($item->gambar)
                        <img src="/storage/{{ $item->gambar }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        <!-- Dark overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-ocean-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-6xl opacity-50">🌊</div>
                    @endif
                    
                    @if($item->lokasi)
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-md text-ocean-800 text-xs font-bold px-3.5 py-2 rounded-full shadow-md">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $item->lokasi }}
                        </span>
                    </div>
                    @endif

                    @auth
                    <div class="absolute top-4 right-4 z-10">
                        <button class="bookmark-btn-card flex items-center justify-center w-10 h-10 bg-white/95 backdrop-blur-md rounded-full shadow-md hover:scale-110 transition-transform" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}" title="Bookmark this ecosystem">
                            <svg class="w-5 h-5 text-ocean-400 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                    </div>
                    @endauth
                </div>

                <div class="p-7 flex-grow flex flex-col justify-between bg-gradient-to-b from-white/40 to-white/90">
                    <div>
                        <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-ocean-900 to-blue-700 mb-3 group-hover:from-ocean-700 group-hover:to-cyan-600 transition-all">{{ $item->nama_ekosistem }}</h3>
                        
                        @if($item->peran)
                            <div class="mb-4 inline-flex items-center gap-1.5 bg-ocean-50 border border-ocean-100 text-ocean-700 text-xs font-bold px-3 py-1.5 rounded-lg">
                                <svg class="w-3.5 h-3.5 text-ocean-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span class="line-clamp-1">{{ $item->peran }}</span>
                            </div>
                        @endif

                        <p class="text-sm text-ocean-800/70 font-medium leading-relaxed line-clamp-2 mb-6">
                            {{ $item->deskripsi ?? 'Belum ada deskripsi yang tersedia.' }}
                        </p>
                    </div>

                    <div class="space-y-4 pt-5 border-t border-ocean-100/60">
                        @guest
                            <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-500 hover:text-ocean-700 font-semibold mb-2">Masuk untuk bookmark</a>
                        @endguest
                        
                        <div class="flex gap-2.5">
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="flex-1 bg-gradient-to-r from-ocean-50 to-white hover:from-ocean-600 hover:to-blue-500 text-ocean-800 hover:text-white border border-ocean-100 hover:border-transparent font-bold py-3 rounded-xl text-center transition-all duration-300 text-sm shadow-sm hover:shadow-lg">
                                Lihat Detail
                            </a>
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white border border-amber-100 hover:border-transparent font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 text-sm shadow-sm">
                                    Edit
                                </a>
                                <button class="delete-btn-card bg-red-50 hover:bg-red-500 text-red-700 hover:text-white border border-red-100 hover:border-transparent font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 text-sm shadow-sm" data-ekosistem-id="{{ $item->id_ekosistem }}">
                                    Hapus
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="mt-14 flex justify-center">
            {{ $ekosistem->appends(request()->query())->links() }}
        </div>

        @endif
    </div>
</div>

@push('scripts')
<script>
// Global helper
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
            const icon = btn.querySelector('.bookmark-icon');
            if (icon) {
                if (btn.classList.contains('bookmarked')) {
                    icon.setAttribute('fill', 'currentColor');
                    icon.classList.remove('text-ocean-400');
                    icon.classList.add('text-blue-500');
                } else {
                    icon.setAttribute('fill', 'none');
                    icon.classList.add('text-ocean-400');
                    icon.classList.remove('text-blue-500');
                }
            }
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
                    btn.classList.add('bookmarked');
                    const icon = btn.querySelector('.bookmark-icon');
                    if (icon) {
                        icon.setAttribute('fill', 'currentColor');
                        icon.classList.remove('text-ocean-400');
                        icon.classList.add('text-blue-500');
                    }
                }
            });
        }
    })
    .catch(err => console.error('Error loading bookmark state:', err));
}
</script>
@endpush
@endsection
