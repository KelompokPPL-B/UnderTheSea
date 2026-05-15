@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen pb-20">
    
    <!-- Hero Section -->
    <div class="relative w-full h-[60vh] min-h-[450px] bg-ocean-900">
        @if($ekosistem->gambar)
            <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="w-full h-full object-cover opacity-80" loading="lazy">
        @else
            <!-- Abstract background if no image -->
            <div class="absolute inset-0 bg-gradient-to-br from-ocean-800 via-blue-900 to-emerald-900">
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-9xl opacity-20">🌊</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-slate-50/10 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-ocean-900/70 to-transparent"></div>

        <div class="absolute bottom-0 left-0 w-full px-4 sm:px-6 lg:px-8 pb-14 sm:pb-20 max-w-7xl mx-auto z-10 flex flex-col justify-end h-full">
            <div class="mb-6">
                <a href="{{ route('ekosistem.index') }}" class="inline-flex items-center text-sm font-bold text-white/80 hover:text-white transition-colors bg-black/20 hover:bg-black/40 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/10 hover:border-white/30 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="inline-block px-3 py-1 bg-emerald-500/20 backdrop-blur-md text-emerald-300 border border-emerald-400/30 text-xs font-black tracking-widest uppercase rounded-md mb-4 shadow-sm">Ekosistem Laut</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-3 drop-shadow-lg tracking-tight">{{ $ekosistem->nama_ekosistem }}</h1>
                </div>
                
                <div class="flex gap-3 mb-2">
                    <button class="share-btn flex items-center justify-center gap-2 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-900 font-bold px-6 py-3 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-lg" data-url="{{ request()->url() }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-5.368m0 5.368a3 3 0 000-5.368M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Bagikan
                    </button>
                    @auth
                        <button class="bookmark-btn flex items-center justify-center w-12 h-12 bg-white/10 hover:bg-white backdrop-blur-md text-white hover:text-ocean-600 rounded-full transition-all duration-300 border border-white/30 hover:border-white shadow-lg" data-type="ekosistem" data-item-id="{{ $ekosistem->id_ekosistem }}" title="Bookmark">
                            <svg class="w-5 h-5 bookmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-ocean-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-ocean-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Tentang Ekosistem</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-lg whitespace-pre-line">{{ $ekosistem->deskripsi ?? 'Belum ada deskripsi yang tersedia untuk ekosistem ini.' }}</p>
                </div>

                <!-- Threats Card -->
                <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Ancaman yang Dihadapi</h2>
                    </div>
                    <div class="bg-red-50/50 rounded-2xl p-6 border border-red-100">
                        <p class="text-red-900 leading-relaxed text-lg font-medium whitespace-pre-line">{{ $ekosistem->ancaman ?? 'Tidak ada data ancaman tercatat.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                
                <!-- Quick Info Cards -->
                <div class="bg-white rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Informasi Singkat</h3>
                    
                    <div class="space-y-8">
                        <div>
                            <span class="block text-xs font-bold text-ocean-600 uppercase tracking-widest mb-2">Lokasi Geografis</span>
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                <p class="text-gray-800 font-bold text-lg">{{ $ekosistem->lokasi ?? 'Tidak ada data lokasi' }}</p>
                            </div>
                        </div>

                        <div>
                            <span class="block text-xs font-bold text-ocean-600 uppercase tracking-widest mb-2">Peran Penting</span>
                            <div class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-ocean-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <p class="text-gray-800 font-bold text-lg">{{ $ekosistem->peran ?? 'Tidak tercatat' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin Actions -->
                @if(auth()->check() && auth()->user()->isAdmin())
                <div class="bg-white rounded-[2rem] p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100/50">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Admin Controls</h3>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('ekosistem.edit', $ekosistem->id_ekosistem) }}" class="flex items-center justify-center gap-2 bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 text-center w-full border border-amber-200 hover:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit Data Ekosistem
                        </a>
                        <button class="delete-btn flex items-center justify-center gap-2 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white font-bold py-3.5 px-4 rounded-xl transition-all duration-300 text-center w-full border border-red-200 hover:border-transparent" data-ekosistem-id="{{ $ekosistem->id_ekosistem }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus Ekosistem
                        </button>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
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
