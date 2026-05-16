@extends('layouts.app')

@section('content')
<div class="py-16 bg-gradient-to-br from-slate-50 via-blue-50 to-emerald-50 min-h-screen relative">
    
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-ocean-600/5 to-transparent pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>
    <div class="absolute top-48 -left-24 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl mix-blend-multiply pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-block py-1 px-3 rounded-full bg-ocean-100 text-ocean-700 font-bold tracking-wider uppercase text-xs mb-4">
                Eksplorasi Kelautan
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-5 leading-tight tracking-tight">
                Katalog <span class="text-transparent bg-clip-text bg-gradient-to-r from-ocean-600 to-emerald-500">Ekosistem</span>
            </h1>
            <p class="text-lg text-gray-600 font-medium">
                Temukan keanekaragaman hayati dan pelajari pentingnya menjaga keseimbangan ekosistem laut kita.
            </p>
        </div>

        <!-- Mini Statistics Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16 relative z-20">
            <!-- Stat 1 -->
            <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] p-6 text-center border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_12px_40px_rgb(0,0,0,0.08)] transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br from-blue-50 to-cyan-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 border border-white">
                    <svg class="w-7 h-7 text-ocean-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight">24</h3>
                <p class="text-xs font-bold text-ocean-600 uppercase tracking-wider">Ekosistem Laut</p>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] p-6 text-center border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_12px_40px_rgb(0,0,0,0.08)] transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br from-cyan-50 to-teal-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 border border-white">
                    <svg class="w-7 h-7 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2.25c-5.385 7.42-8.25 10.706-8.25 13.5a8.25 8.25 0 0016.5 0c0-2.794-2.865-6.08-8.25-13.5z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight">120<span class="text-cyan-500">+</span></h3>
                <p class="text-xs font-bold text-cyan-700 uppercase tracking-wider">Spesies Laut</p>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] p-6 text-center border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_12px_40px_rgb(0,0,0,0.08)] transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 border border-white">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight">15</h3>
                <p class="text-xs font-bold text-blue-700 uppercase tracking-wider">Lokasi Laut</p>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white/70 backdrop-blur-xl rounded-[2rem] p-6 text-center border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_12px_40px_rgb(0,0,0,0.08)] transform hover:-translate-y-2 transition-all duration-300 group">
                <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emerald-50 to-teal-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300 border border-white">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 mb-1 tracking-tight">8</h3>
                <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Aksi Konservasi</p>
            </div>
        </div>

        <!-- Search & Filter Controls -->
        <div class="relative mb-12 flex flex-col md:flex-row items-center justify-center gap-4 z-20">

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
                <div class="mb-8 flex justify-end z-20 relative">
                    <a href="{{ route('ekosistem.create') }}" class="bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-emerald-500/40 transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Ekosistem
                    </a>
                </div>
            @endif
        @endauth

        @if($ekosistem->isEmpty())
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-16 text-center max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-ocean-50 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl">
                    🐠
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Data Tidak Ditemukan</h3>
                <p class="text-gray-500 font-medium">
                    {{ request('search') ? 'Pencarian Anda tidak membuahkan hasil. Coba kata kunci lain.' : 'Belum ada data ekosistem yang terdaftar di sistem.' }}
                </p>
            </div>
        @else

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ekosistem as $item)
            <div class="group bg-white rounded-[1.5rem] shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_12px_40px_-8px_rgba(0,0,0,0.15)] border border-gray-100/80 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1.5">
                
                <!-- Card Image -->
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    @if($item->gambar)
                        <img src="/storage/{{ $item->gambar }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-ocean-50 text-6xl">
                            🌊
                        </div>
                    @endif
                    
                    <!-- Dark Gradient Overlay for better contrast -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>

                    <!-- Bookmark Btn -->
                    @auth
                    <button class="bookmark-btn-card absolute top-4 right-4 z-10 p-2.5 bg-white/20 hover:bg-white backdrop-blur-md rounded-full text-white hover:text-ocean-500 hover:shadow-lg transition-all duration-300 border border-white/30 hover:border-white" data-type="ekosistem" data-item-id="{{ $item->id_ekosistem }}">
                        <svg class="w-5 h-5 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </button>
                    @endauth

                    <!-- Location Tag -->
                    @if($item->lokasi)
                    <div class="absolute bottom-5 left-5 z-10">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/30">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $item->lokasi }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Card Body -->
                <div class="p-6 flex flex-col flex-grow bg-white relative">
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-ocean-600 transition-colors">{{ $item->nama_ekosistem }}</h3>
                        
                        @if($item->peran)
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-md text-xs font-bold mb-4">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                {{ $item->peran }}
                            </div>
                        @endif

                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-6">
                            {{ $item->deskripsi ?? 'Tidak ada deskripsi yang tersedia.' }}
                        </p>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-5 border-t border-gray-100/80 mt-auto">
                        @guest
                            <a href="{{ route('login') }}" class="block text-center text-xs text-ocean-500 hover:text-ocean-700 font-semibold mb-2">Sign in untuk Bookmark</a>
                        @endguest

                        <div class="flex gap-2.5">
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="flex-1 bg-ocean-100 hover:bg-ocean-600 text-ocean-800 hover:text-white font-bold py-2.5 rounded-xl text-center transition-all duration-300 text-sm border border-ocean-200 hover:border-transparent">
                                Lihat Detail
                            </a>
                            
                            @if(auth()->check() && auth()->user()->isAdmin())
                                <a href="{{ route('ekosistem.edit', $item->id_ekosistem) }}" class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-amber-100 hover:border-amber-500" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <button class="delete-btn-card bg-red-50 hover:bg-red-500 text-red-600 hover:text-white font-bold py-2.5 px-3.5 rounded-xl text-center transition-colors text-sm border border-red-100 hover:border-red-500" data-ekosistem-id="{{ $item->id_ekosistem }}" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
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
                    btn.classList.add('bg-white', 'text-blue-600', 'shadow-md');
                    btn.classList.remove('bg-white/20', 'text-white', 'hover:text-ocean-500');
                } else {
                    icon.setAttribute('fill', 'none');
                    btn.classList.remove('bg-white', 'text-blue-600', 'shadow-md');
                    btn.classList.add('bg-white/20', 'text-white', 'hover:text-ocean-500');
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
                        btn.classList.add('bg-white', 'text-blue-600', 'shadow-md');
                        btn.classList.remove('bg-white/20', 'text-white', 'hover:text-ocean-500');
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
