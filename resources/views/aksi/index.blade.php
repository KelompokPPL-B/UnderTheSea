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

            <form method="GET" action="{{ route('aksi.index') }}" class="w-full max-w-2xl relative group search-form" novalidate>
                <div class="absolute -inset-1 bg-gradient-to-r from-ocean-300 to-cyan-300 rounded-full blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative bg-white/80 backdrop-blur-md rounded-full p-1.5 flex items-center shadow-xl border border-white/50">
                    <span class="pl-5 pr-2 text-2xl">🙌</span>
                    
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari aksi, gerakan, atau kampanye..." 
                        class="w-full bg-transparent border-none focus:ring-0 px-2 py-3 text-ocean-900 placeholder-ocean-400 font-medium outline-none search-input"
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
                <!-- Validation message container -->
                <div class="search-error-msg text-red-500 text-sm font-semibold mt-2 pl-6 @error('search') @else hidden @enderror">
                    @error('search') {{ $message }} @enderror
                </div>
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

        <!-- Search Result Info -->
        @if(request('search'))
            <div class="mb-8 flex items-center justify-between bg-white/60 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/50 shadow-sm animate-fade-in">
                <div class="flex items-center gap-3">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                    </span>
                    <span class="text-sm font-semibold text-slate-700">
                        Menampilkan hasil untuk: <span class="text-cyan-600 font-bold">"{{ request('search') }}"</span>
                    </span>
                </div>
                <a href="{{ route('aksi.index') }}" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 transition-all flex items-center gap-1.5 hover:scale-105 active:scale-95">
                    Reset Pencarian 🔄
                </a>
            </div>
        @endif

        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(16px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
            @keyframes shimmer {
                100% { transform: translateX(350%) skewX(-12deg); }
            }
            .shimmer-btn:hover .shimmer-bar {
                animation: shimmer 1s ease-out;
            }
        </style>

        @if($aksi->isEmpty())
            <div class="bg-white/70 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-2xl p-12 md:p-16 text-center max-w-2xl mx-auto animate-fade-in">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 text-5xl shadow-inner animate-bounce">
                    🐠
                </div>
                <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight mb-3">Data Tidak Ditemukan</h3>
                <p class="text-slate-600 font-medium max-w-md mx-auto mb-8">
                    {{ request('search') ? 'Pencarian Anda tidak menghasilkan data yang sesuai. Coba gunakan kata kunci lain.' : 'Jadilah yang pertama untuk memulai aksi pelestarian laut!' }}
                </p>
                @if(request('search'))
                    <a href="{{ route('aksi.index') }}" class="shimmer-btn relative group overflow-hidden inline-flex items-center gap-2.5 bg-gradient-to-r from-teal-500 via-ocean-600 to-blue-600 text-white font-black text-sm uppercase tracking-wider py-4 px-10 rounded-full shadow-[0_10px_30px_-10px_rgba(8,145,178,0.5)] hover:shadow-[0_20px_40px_-10px_rgba(8,145,178,0.7)] hover:-translate-y-1 hover:scale-105 active:scale-95 transition-all duration-300">
                        <!-- Shimmer bar -->
                        <div class="absolute inset-y-0 left-0 w-1/3 h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -skew-x-12 -translate-x-full shimmer-bar pointer-events-none"></div>
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-180 transition-transform duration-700 ease-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18" />
                        </svg>
                        <span>Reset Pencarian</span>
                    </a>
                @endif
            </div>
        @else

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
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
                            <h3 class="text-2xl font-extrabold text-ocean-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2 search-highlightable">
                                {{ $item->judul_aksi }}
                            </h3>
                        </a>
                        
                        <p class="text-sm text-gray-500 line-clamp-3 mb-3 search-highlightable">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // === SEARCH VALIDATION LOGIC ===
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        const searchInput = searchForm.querySelector('.search-input');
        const errorMsg = searchForm.querySelector('.search-error-msg');

        if (searchInput && errorMsg) {
            function validateSearch(val) {
                const trimmed = val.trim();
                if (trimmed === '') {
                    return 'Silakan masukkan kata kunci pencarian.';
                }
                if (trimmed.length > 100) {
                    return 'Kata kunci pencarian tidak boleh melebihi 100 karakter.';
                }
                // Hanya izinkan huruf, angka, dan spasi
                const regex = /^[a-zA-Z0-9\s]+$/;
                if (!regex.test(trimmed)) {
                    return 'Kata kunci pencarian tidak boleh mengandung karakter spesial.';
                }
                return null;
            }

            function showError(msg) {
                errorMsg.textContent = msg;
                errorMsg.classList.remove('hidden');
            }

            function clearError() {
                errorMsg.textContent = '';
                errorMsg.classList.add('hidden');
            }

            searchForm.addEventListener('submit', function(e) {
                const error = validateSearch(searchInput.value);
                if (error) {
                    e.preventDefault();
                    showError(error);
                }
            });

            searchInput.addEventListener('input', function() {
                const error = validateSearch(this.value);
                if (!error) {
                    clearError();
                } else if (!errorMsg.classList.contains('hidden')) {
                    showError(error);
                }
            });
        }
    }

    // Highlight search keywords
    function highlightText(element, query) {
        if (!query) return;
        const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
        const nodes = [];
        let node;
        while (node = walker.nextNode()) {
            nodes.push(node);
        }
        
        const regex = new RegExp(`(${query.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')})`, 'gi');
        
        nodes.forEach(textNode => {
            const text = textNode.nodeValue;
            if (regex.test(text)) {
                const fragment = document.createDocumentFragment();
                let lastIndex = 0;
                text.replace(regex, (match, p1, index) => {
                    if (index > lastIndex) {
                        fragment.appendChild(document.createTextNode(text.substring(lastIndex, index)));
                    }
                    const mark = document.createElement('mark');
                    mark.className = 'bg-cyan-100 text-cyan-900 rounded px-0.5 font-bold';
                    mark.textContent = match;
                    fragment.appendChild(mark);
                    lastIndex = index + match.length;
                });
                if (lastIndex < text.length) {
                    fragment.appendChild(document.createTextNode(text.substring(lastIndex)));
                }
                textNode.parentNode.replaceChild(fragment, textNode);
            }
        });
    }

    const searchQuery = new URLSearchParams(window.location.search).get('search');
    if (searchQuery) {
        document.querySelectorAll('.search-highlightable').forEach(el => {
            highlightText(el, searchQuery);
        });
    }
});
</script>
@endpush
@endsection