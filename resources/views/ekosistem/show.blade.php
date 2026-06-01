@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    
    <!-- Hero Section -->
    <div class="relative w-full h-[70vh] min-h-[500px] bg-ocean-900 overflow-hidden">
        @if($ekosistem->gambar)
            <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="absolute inset-0 w-full h-full object-cover opacity-70 scale-105 transform hover:scale-110 transition-transform duration-[20s]" loading="lazy">
        @else
            <!-- Abstract background if no image -->
            <div class="absolute inset-0 bg-gradient-to-br from-ocean-800 via-blue-900 to-emerald-900">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-9xl opacity-20">🌊</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-ocean-900/40 to-ocean-900/10"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-ocean-900/80 via-ocean-900/40 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full px-4 sm:px-6 lg:px-8 pb-16 max-w-7xl mx-auto z-10 flex flex-col justify-end h-full">
            <div class="mb-8">
                <a href="{{ route('ekosistem.index') }}" class="inline-flex items-center text-sm font-bold text-white hover:text-white transition-all duration-300 bg-white/10 hover:bg-white/20 backdrop-blur-md px-6 py-2.5 rounded-full border border-white/20 hover:border-white/40 shadow-lg hover:-translate-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-3xl">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-md text-emerald-300 border border-emerald-400/30 text-sm font-bold tracking-wider uppercase rounded-full mb-4 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $ekosistem->lokasi ?? 'Lokasi Lautan' }}
                    </span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-4 drop-shadow-2xl tracking-tight leading-tight">{{ $ekosistem->nama_ekosistem }}</h1>
                </div>
                
                <div class="flex gap-3 mb-2 shrink-0">
                    <button class="share-btn flex items-center justify-center gap-2 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-900 font-bold px-6 py-3.5 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-xl hover:-translate-y-1" data-url="{{ request()->url() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368a3 3 0 000-5.368M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Bagikan
                    </button>
                    @auth
                        <button class="bookmark-btn flex items-center justify-center w-14 h-14 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-600 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-xl hover:-translate-y-1" data-type="ekosistem" data-item-id="{{ $ekosistem->id_ekosistem }}" title="Bookmark">
                            <svg class="w-6 h-6 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-8">
        
        <!-- Quick Information Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-lg border border-white flex flex-col gap-2 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Lokasi Geografis</span>
                <p class="text-gray-900 font-bold text-lg leading-tight">{{ $ekosistem->lokasi }}</p>
            </div>
            <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-lg border border-white flex flex-col gap-2 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Peran Utama</span>
                <p class="text-gray-900 font-bold text-lg leading-tight line-clamp-2">{{ Str::limit($ekosistem->peran, 60) }}</p>
            </div>
            <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-lg border border-white flex flex-col gap-2 hover:-translate-y-1 transition-transform duration-300">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center mb-1">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Ancaman Kritis</span>
                <p class="text-gray-900 font-bold text-lg leading-tight line-clamp-2">{{ Str::limit($ekosistem->ancaman, 60) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-xl border border-gray-100">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-full bg-ocean-50 flex items-center justify-center">
                            <svg class="w-7 h-7 text-ocean-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tentang Ekosistem</h2>
                    </div>
                    <div class="prose prose-lg text-gray-600 max-w-none">
                        <p class="leading-relaxed whitespace-pre-line">{{ $ekosistem->deskripsi }}</p>
                    </div>
                </div>

                <!-- Ecological Importance -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-[2rem] p-8 md:p-10 shadow-lg border border-blue-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
                        <svg class="w-32 h-32 text-blue-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-md">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <h2 class="text-3xl font-extrabold text-blue-900 tracking-tight">Peran Ekologis</h2>
                        </div>
                        <p class="text-blue-900/80 leading-relaxed text-lg whitespace-pre-line font-medium">{{ $ekosistem->peran }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Threats Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(239,68,68,0.1)] hover:shadow-[0_20px_40px_rgb(239,68,68,0.2)] border border-red-100 overflow-hidden relative group transform hover:-translate-y-2 transition-all duration-500">
                    <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-red-500 via-rose-500 to-orange-500"></div>
                    <div class="flex flex-col xl:flex-row xl:items-center gap-5 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-red-50 flex items-center justify-center text-red-500 group-hover:scale-110 group-hover:bg-red-500 group-hover:text-white transition-all duration-500 shadow-sm shrink-0">
                            <svg class="w-9 h-9 animate-[pulse_3s_ease-in-out_infinite]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight group-hover:text-red-700 transition-colors">Ancaman & Tantangan</h2>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-orange-50/50 rounded-2xl p-6 md:p-8 border border-red-100/60 shadow-inner">
                        <p class="text-red-900/90 leading-relaxed text-lg font-medium whitespace-pre-line">{{ $ekosistem->ancaman }}</p>
                    </div>
                </div>

                <!-- Admin Actions -->
                @if(auth()->check() && auth()->user()->isAdmin())
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Admin Controls
                    </h3>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('ekosistem.edit', $ekosistem->id_ekosistem) }}" class="flex items-center justify-center gap-2 bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 text-center w-full border border-amber-200 hover:border-transparent shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit Data
                        </a>
                        <button class="delete-btn flex items-center justify-center gap-2 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 text-center w-full border border-red-200 hover:border-transparent shadow-sm" data-ekosistem-id="{{ $ekosistem->id_ekosistem }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Related Ecosystems Section -->
        @if($relatedEkosistems->count() > 0)
        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Ekosistem Terkait</h3>
                    <p class="text-gray-500 mt-2 text-lg">Jelajahi ekosistem laut lainnya yang saling terhubung.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedEkosistems as $related)
                <a href="{{ route('ekosistem.show', $related->id_ekosistem) }}" class="group block bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="relative h-48 overflow-hidden bg-ocean-100">
                        @if($related->gambar)
                            <img src="/storage/{{ $related->gambar }}" alt="{{ $related->nama_ekosistem }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-ocean-800 flex items-center justify-center">
                                <span class="text-4xl">🌊</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $related->lokasi }}
                        </span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-ocean-600 transition-colors">{{ $related->nama_ekosistem }}</h4>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4 leading-relaxed">{{ $related->deskripsi }}</p>
                        <span class="text-ocean-600 font-bold text-sm inline-flex items-center group-hover:translate-x-1 transition-transform">
                            Jelajahi 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<style>
@keyframes slide-up {
    0% { transform: translateY(100%); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}
.toast-enter { animation: slide-up 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
<script>
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-emerald-500',
            error: 'bg-red-500',
            info: 'bg-ocean-600'
        };

        const notification = document.createElement('div');
        notification.className = `fixed bottom-6 right-6 px-6 py-4 rounded-2xl ${colors[type]} text-white shadow-2xl z-50 flex items-center gap-3 font-medium toast-enter`;
        
        const icon = type === 'success' ? '✅' : (type === 'error' ? '⚠️' : 'ℹ️');
        notification.innerHTML = `<span>${icon}</span> <span>${message}</span>`;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(100%)';
            notification.style.transition = 'all 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Share button
        const shareBtn = document.querySelector('.share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url;
                navigator.clipboard.writeText(url).then(() => {
                    showNotification('Link berhasil disalin ke clipboard!', 'success');
                }).catch(() => {
                    showNotification('Gagal menyalin link', 'error');
                });
            });
        }

        // Delete button
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus ekosistem ini secara permanen?')) {
                    const id = this.dataset.ekosistemId;
                    const btn = this;
                    
                    btn.disabled = true;
                    btn.classList.add('opacity-50', 'cursor-not-allowed');
                    btn.innerHTML = '<span class="animate-spin text-xl">⏳</span> Menghapus...';

                    fetch(`/ekosistem/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showNotification('Data ekosistem berhasil dihapus', 'success');
                            setTimeout(() => window.location.href = '{{ route("ekosistem.index") }}', 1000);
                        } else {
                            showNotification(data.message || 'Gagal menghapus data', 'error');
                            resetBtn(btn);
                        }
                    })
                    .catch(err => {
                        showNotification('Terjadi kesalahan jaringan', 'error');
                        resetBtn(btn);
                    });
                }
            });
        }
    });

    function resetBtn(btn) {
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg> Hapus Ekosistem';
    }
</script>

<script type="module">
document.addEventListener('DOMContentLoaded', function() {
    const bookmarkBtn = document.querySelector('.bookmark-btn');
    if (!bookmarkBtn) return;

    fetch('/favorites', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success' && Array.isArray(data.data)) {
            const type = bookmarkBtn.dataset.type;
            const itemId = parseInt(bookmarkBtn.dataset.itemId);
            const isBookmarked = data.data.some(fav => fav.type === type && fav.item_id === itemId);
            if (isBookmarked) {
                setBookmarkActive(bookmarkBtn);
            }
        }
    });

    bookmarkBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const btn = this;
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
                if (isBookmarked) {
                    setBookmarkInactive(btn);
                    showNotification('Dihapus dari bookmark', 'info');
                } else {
                    setBookmarkActive(btn);
                    showNotification('Berhasil disimpan ke bookmark', 'success');
                }
            } else {
                showNotification(data.message, 'error');
            }
        });
    });

    function setBookmarkActive(btn) {
        btn.classList.add('bookmarked', 'bg-white', 'text-ocean-900');
        btn.classList.remove('bg-white/10', 'text-white', 'hover:text-ocean-600');
        const icon = btn.querySelector('.bookmark-icon');
        if (icon) icon.setAttribute('fill', 'currentColor');
    }

    function setBookmarkInactive(btn) {
        btn.classList.remove('bookmarked', 'bg-white', 'text-ocean-900');
        btn.classList.add('bg-white/10', 'text-white', 'hover:text-ocean-600');
        const icon = btn.querySelector('.bookmark-icon');
        if (icon) icon.setAttribute('fill', 'none');
    }
});
</script>
@endpush
@endsection
