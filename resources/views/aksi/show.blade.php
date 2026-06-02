@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">

    {{-- Breadcrumb --}}
    <div class="max-w-4xl mx-auto px-6 pb-4">
        @include('layouts.breadcrumb', ['breadcrumbs' => [
            ['label' => 'Conservation Actions', 'url' => route('aksi.index')],
            ['label' => $aksi->judul_aksi]
        ]])
    </div>

    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card overflow-hidden">

            {{-- Hero Image --}}
            @if($aksi->gambar)
                <img src="/storage/{{ $aksi->gambar }}"
                     alt="{{ $aksi->judul_aksi }}"
                     class="w-full h-80 object-cover"
                     loading="lazy">
            @else
                <div class="w-full h-80 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl mb-3">🌊</div>
                        <span class="text-ocean-400 text-sm font-medium">No image available</span>
                    </div>
                </div>
            @endif

            <div class="p-8 space-y-8">

                {{-- Header: Title + Bookmark --}}
                <div class="flex justify-between items-start gap-4 pb-6 border-b border-ocean-100 animate-fade">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="badge badge-primary badge-sm text-xs font-semibold">Conservation Action</span>
                            @if($aksi->tanggal_kegiatan)
                                @if($aksi->tanggal_kegiatan->isFuture())
                                    <span class="badge badge-success badge-sm text-xs">Upcoming</span>
                                @else
                                    <span class="badge badge-ghost badge-sm text-xs">Completed</span>
                                @endif
                            @endif
                        </div>
                        <h1 class="text-3xl font-bold text-ocean-900 leading-tight mb-3">{{ $aksi->judul_aksi }}</h1>
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-ocean-200 flex items-center justify-center text-ocean-700 text-xs font-bold shrink-0">
                                {{ strtoupper(substr($aksi->createdBy->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-semibold text-ocean-900">{{ $aksi->createdBy->name }}</span>
                            <span class="badge badge-success text-xs">{{ $aksi->createdBy->badge }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-xs text-gray-400">{{ $aksi->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    @auth
                        <button class="bookmark-btn btn btn-outline btn-sm shrink-0"
                                data-type="aksi" data-item-id="{{ $aksi->id_aksi }}">
                            <span class="bookmark-text">🔖 Bookmark</span>
                        </button>
                    @endauth
                </div>

                {{-- Quick Info Cards --}}
                @php $hasQuickInfo = $aksi->lokasi || $aksi->tanggal_kegiatan || $aksi->volunteer_dibutuhkan; @endphp
                @if($hasQuickInfo)
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 animate-fade">
                    @if($aksi->lokasi)
                    <div class="bg-ocean-50 rounded-xl p-4 flex items-start gap-3">
                        <span class="text-2xl shrink-0">📍</span>
                        <div>
                            <p class="text-xs font-bold text-ocean-500 uppercase tracking-wide mb-1">Location</p>
                            <p class="text-sm font-semibold text-ocean-900">{{ $aksi->lokasi }}</p>
                        </div>
                    </div>
                    @endif
                    @if($aksi->tanggal_kegiatan)
                    <div class="bg-eco-50 rounded-xl p-4 flex items-start gap-3">
                        <span class="text-2xl shrink-0">📅</span>
                        <div>
                            <p class="text-xs font-bold text-eco-600 uppercase tracking-wide mb-1">Event Date</p>
                            <p class="text-sm font-semibold text-ocean-900">{{ $aksi->tanggal_kegiatan->format('d F Y') }}</p>
                        </div>
                    </div>
                    @endif
                    @if($aksi->volunteer_dibutuhkan)
                    <div class="bg-sand rounded-xl p-4 flex items-start gap-3">
                        <span class="text-2xl shrink-0">🙋</span>
                        <div>
                            <p class="text-xs font-bold text-amber-600 uppercase tracking-wide mb-1">Volunteer Needed</p>
                            <p class="text-sm font-semibold text-ocean-900">{{ number_format($aksi->volunteer_dibutuhkan) }} people</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Prose Sections --}}
                <div class="space-y-7">
                    @if($aksi->deskripsi)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-ocean-500 rounded-full inline-block"></span>Overview
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->deskripsi }}</p>
                    </div>
                    @endif

                    @if($aksi->manfaat)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-eco-500 rounded-full inline-block"></span>Benefits
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->manfaat }}</p>
                    </div>
                    @endif

                    @if($aksi->isu_lingkungan)
                    <div class="animate-fade bg-red-50 border-l-4 border-red-400 rounded-r-xl p-4">
                        <h3 class="text-base font-bold text-red-700 mb-2">⚠️ Environmental Issue</h3>
                        <p class="text-gray-700 leading-relaxed text-sm">{{ $aksi->isu_lingkungan }}</p>
                    </div>
                    @endif

                    @if($aksi->tujuan_konservasi)
                    <div class="animate-fade bg-eco-50 border-l-4 border-eco-500 rounded-r-xl p-4">
                        <h3 class="text-base font-bold text-eco-700 mb-2">🎯 Conservation Goals</h3>
                        <p class="text-gray-700 leading-relaxed text-sm">{{ $aksi->tujuan_konservasi }}</p>
                    </div>
                    @endif

                    @if($aksi->cara_melakukan)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-blue-400 rounded-full inline-block"></span>How to Participate
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->cara_melakukan }}</p>
                    </div>
                    @endif

                    @if($aksi->dampak_aksi)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-amber-400 rounded-full inline-block"></span>Action Impact
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->dampak_aksi }}</p>
                    </div>
                    @endif
                </div>

                {{-- ============================================================ --}}
                {{-- DYNAMIC MARK AS DONE & FEEDBACK FORM SECTION (Grace - PBI-26)--}}
                {{-- ============================================================ --}}
                @guest
                @php
                    $sudahTandai = session()->has("tandai_aksi_{$aksi->id_aksi}");
                    $namaTandai  = session()->get("tandai_aksi_{$aksi->id_aksi}_nama", '');

                    if (!$sudahTandai) {
                        $dbRecord = $aksi->tandai()->where('session_id', session()->getId())->first();
                        if ($dbRecord) {
                            $sudahTandai = true;
                            $namaTandai  = $dbRecord->nama_peserta;
                            session()->put("tandai_aksi_{$aksi->id_aksi}", true);
                            session()->put("tandai_aksi_{$aksi->id_aksi}_nama", $namaTandai);
                        }
                    }
                    $totalTandai = $aksi->tandai()->count();
                    $sudahFeedback = $aksi->feedback()->where('session_id', session()->getId())->exists();
                @endphp

                <div class="animate-fade rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🌿</span>
                            <span class="font-bold text-gray-800 text-sm">Track Your Progress</span>
                        </div>
                        <div class="flex items-center gap-1.5 bg-white border border-gray-200 rounded-full px-3 py-1">
                            <span class="text-xs font-bold text-gray-700">{{ $totalTandai }}</span>
                            <span class="text-xs text-gray-500">joined</span>
                        </div>
                    </div>

                    <div class="p-6 bg-white space-y-6">
                        @if($errors->any())
                            <div class="flex flex-col gap-1 rounded-xl px-4 py-3 text-sm font-medium bg-red-50 border border-red-200 text-red-800">
                                @foreach($errors->all() as $error)
                                    <p>⚠️ {{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        @if($sudahTandai)
                            {{-- Teks Status Sukses Penandaan Awal --}}
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl">
                                <p class="text-sm font-semibold text-blue-900 flex items-center gap-1.5">
                                    ✅ You've marked this action!
                                </p>
                                <p class="text-xs text-blue-700 mt-1 font-medium">
                                    Recorded as <span class="font-bold">{{ $namaTandai }}</span>
                                </p>
                            </div>

                            {{-- FORM INPUT ULASAN / FEEDBACK --}}
                            @if(!$sudahFeedback)
                                <div class="animate-fade pt-2">
                                    <form action="{{ route('aksi.feedback.store', $aksi->id_aksi) }}" method="POST" class="space-y-4">
                                        @csrf
                                        
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-1">Name</label>
                                            <input type="text" name="nama_peserta" value="{{ $namaTandai }}" readonly
                                                   class="w-full px-4 py-2 rounded-xl border border-gray-200 bg-gray-100 text-sm text-gray-500 font-medium cursor-not-allowed outline-none">
                                        </div>

                                        <div>
                                            <div class="flex justify-between items-center mb-1">
                                                <label for="komentar" class="block text-xs font-semibold text-gray-700">
                                                    Your Feedback
                                                </label>
                                                {{-- Live Character Counter Indicator --}}
                                                <span id="charCount" class="text-[11px] text-gray-400 font-mono">0 / 2000</span>
                                            </div>
                                            <textarea id="komentar" name="komentar" rows="3" required maxlength="2000"
                                                      placeholder="Write your review or share tips here..."
                                                      class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-sm text-gray-800 transition focus:outline-none focus:ring-2 focus:ring-ocean-200 focus:border-ocean-400"></textarea>
                                        </div>

                                        <button type="submit" class="w-full btn btn-primary btn-sm rounded-xl py-2.5 text-xs font-bold shadow-md">
                                            Submit Feedback
                                        </button>
                                    </form>
                                </div>
                            @endif

                        @else
                            {{-- Fitur Awal Menandai Selesai --}}
                            <p class="text-gray-600 text-sm mb-4">
                                Already done this action? Mark it to record your contribution!
                            </p>
                            <form action="{{ route('aksi.tandai', $aksi->id_aksi) }}" method="POST">
                                @csrf
                                <div class="flex flex-col gap-3">
                                    <div class="w-full">
                                        <label for="nama_peserta" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                            Your Name <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="nama_peserta"
                                            name="nama_peserta"
                                            value="{{ old('nama_peserta') }}"
                                            placeholder="Enter your name..."
                                            maxlength="100"
                                            class="w-full px-4 py-2.5 rounded-xl border text-sm text-gray-800
                                                   placeholder-gray-400 bg-white transition focus:outline-none
                                                   {{ $errors->has('nama_peserta')
                                                       ? 'border-red-400 focus:ring-2 focus:ring-red-200'
                                                       : 'border-gray-300 focus:ring-2 focus:ring-ocean-200 focus:border-ocean-400' }}"
                                        >
                                    </div>
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl text-sm font-bold
                                               bg-blue-600 hover:bg-blue-700 text-white
                                               shadow-md hover:shadow-lg transition-all active:scale-95
                                               flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Mark as Done</span>
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
                @endguest


                {{-- Like Module Support --}}
                @auth
                    <div class="bg-gradient-to-r from-ocean-50 to-eco-50 p-6 rounded-xl border border-ocean-200 animate-fade">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-ocean-700 mb-1">Enjoyed this action?</p>
                                <p class="text-xs text-gray-500">Show your support by liking it</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-ocean-600">
                                        <span class="count">0</span>
                                    </div>
                                    <p class="text-xs text-gray-500">Likes</p>
                                </div>
                                <button class="like-btn btn btn-primary btn-sm gap-2" data-action-id="{{ $aksi->id_aksi }}">
                                    <span class="like-icon text-base">❤️</span>
                                    <span class="like-text">Like</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-ocean-50 p-6 rounded-xl border border-ocean-200 text-center animate-fade">
                        <p class="text-ocean-900 text-sm">
                            <a href="{{ route('login') }}" class="text-ocean-600 hover:underline font-semibold">Sign in</a>
                            to like and bookmark this action
                        </p>
                    </div>
                @endauth


                {{-- ======================================================================= --}}
                {{-- SECTION KOMENTAR MEDIA SOSIAL (Perfect Circle Avatar & Center Aligned)   --}}
                {{-- ======================================================================= --}}
                <div class="border-t border-ocean-100 pt-8 animate-fade">
                    
                    {{-- Judul Utama Komentar --}}
                    <h3 class="text-lg font-bold text-ocean-900 flex items-center gap-2 mb-6">
                        💬 What People Say
                    </h3>

                    @if($aksi->feedback->isEmpty())
                        <div class="bg-gray-50 rounded-xl p-8 text-center border border-dashed border-gray-200">
                            <span class="text-2xl mb-2 inline-block">🌊</span>
                            <p class="text-gray-400 text-xs font-medium">No feedback from participants yet.</p>
                        </div>
                    @else
                        {{-- Container Kolom List Komentar --}}
                        <div class="space-y-5 max-h-[500px] overflow-y-auto pr-2">
                            @foreach($aksi->feedback as $review)
                                {{-- items-center: Menghandle avatar berada tepat di tengah-tengah tinggi kolom komentar --}}
                                <div class="flex items-center gap-4 text-sm animate-fade">
                                    
                                    {{-- FIX AVATAR: Diperbesar (w-12 h-12), Lingkaran Sempurna (rounded-full aspect-square), dan teks membesar --}}
                                    <div class="w-12 h-12 rounded-full aspect-square bg-blue-100 flex items-center justify-center text-blue-700 text-base font-bold shrink-0 shadow-sm border border-gray-100">
                                        {{ strtoupper(substr($review->nama_peserta, 0, 1)) }}
                                    </div>
                                    
                                    {{-- Box Bubble Chat Utama --}}
                                    <div class="flex-1 bg-gray-50 rounded-2xl px-5 py-4 border border-gray-100 shadow-sm">
                                        
                                        {{-- Header di dalam Bubble: Nama User + (Waktu & Total Feedback Sejajar Horizontal) --}}
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 pb-2 mb-2 border-b border-gray-200/60">
                                            
                                            {{-- Nama Pembuat Feedback --}}
                                            <span class="font-bold text-gray-900 text-sm">
                                                {{ $review->nama_peserta }}
                                            </span>
                                            
                                            {{-- Kontainer Waktu Lama & Jumlah Feedback Sejajar Horizontal --}}
                                            <div class="flex items-center gap-2 text-xs">
                                                <span class="text-gray-400 font-medium">
                                                    {{ $review->created_at->diffForHumans() }}
                                                </span>
                                                <span class="text-gray-300">•</span>
                                                <span class="px-2 py-0.5 bg-gray-200 text-gray-600 rounded text-[11px] font-semibold tracking-wide shadow-sm">
                                                    {{ $aksi->feedback->count() }} feedback
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Isi Konten Chat --}}
                                        <p class="text-gray-700 leading-relaxed text-sm">
                                            {{ $review->komentar }}
                                        </p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>


                {{-- Action Panel Footer --}}
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline btn-sm">← Back to Actions</a>

                    <button class="share-btn btn btn-outline btn-sm gap-2"
                            data-url="{{ request()->url() }}" title="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Share
                    </button>

                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $aksi->created_by))
                        <a href="{{ route('aksi.edit', $aksi->id_aksi) }}" class="btn btn-outline btn-sm">✏️ Edit</a>
                        <button class="delete-btn btn btn-sm bg-white border border-red-300 hover:bg-red-50 text-red-500 hover:text-red-600 gap-2"
                            data-action-id="{{ $aksi->id_aksi }}" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module" src="{{ asset('js/interactions.js') }}"></script>
<script type="module">
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-100 text-green-800',
            error:   'bg-red-100 text-red-800',
            info:    'bg-blue-100 text-blue-800'
        };
        const el = document.createElement('div');
        el.className = `fixed top-4 right-4 px-6 py-3 rounded-lg ${colors[type]} shadow-lg z-50`;
        el.textContent = message;
        document.body.appendChild(el);
        setTimeout(() => el.remove(), 4000);
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }

    document.addEventListener('DOMContentLoaded', function () {

        // Live Character Counter & Strictly Limit 2000 keystrokes
        const textarea = document.getElementById('komentar');
        const counter  = document.getElementById('charCount');
        
        if (textarea && counter) {
            textarea.addEventListener('input', function () {
                let currentLength = this.value.length;
                
                if (currentLength > 2000) {
                    this.value = this.value.substring(0, 2000);
                    currentLength = 2000;
                }
                
                counter.textContent = `${currentLength} / 2000`;
                
                if (currentLength >= 1950) {
                    counter.classList.add('text-red-500');
                } else {
                    counter.classList.remove('text-red-500');
                }
            });
        }

        // Handle Share URL Link
        document.querySelector('.share-btn')?.addEventListener('click', function () {
            navigator.clipboard.writeText(this.dataset.url)
                .then(() => showNotification('Link copied to clipboard!', 'success'))
                .catch(() => showNotification('Failed to copy link.', 'error'));
        });

        // Handle Action Destruction
        document.querySelector('.delete-btn')?.addEventListener('click', function () {
            if (!confirm('Are you sure you want to delete this action? This cannot be undone.')) return;
            const actionId = this.dataset.actionId;
            this.disabled = true;

            fetch(`/aksi/${actionId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': getCsrfToken() }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    showNotification('Action deleted successfully.', 'success');
                    setTimeout(() => window.location.href = '{{ route("aksi.index") }}', 1500);
                } else {
                    showNotification(data.message || 'Delete failed.', 'error');
                    this.disabled = false;
                }
            })
            .catch(() => {
                showNotification('An error occurred.', 'error');
                this.disabled = false;
            });
        });

        // Like Integration System
        const likeBtn = document.querySelector('.like-btn');
        if (likeBtn) {
            const actionId = likeBtn.dataset.actionId;
            const countEl  = document.querySelector('.count');

            fetch(`/likes/${actionId}/count`)
                .then(r => r.json())
                .then(d => { if (d.status === 'success') countEl.textContent = d.data.like_count; });

            fetch('/likes', { headers: { 'X-CSRF-TOKEN': getCsrfToken() } })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success' && d.data) {
                        const liked = d.data.some(l => l.action_id === parseInt(actionId));
                        if (liked) {
                            likeBtn.dataset.liked = 'true';
                            likeBtn.querySelector('.like-text').textContent = 'Unlike';
                        }
                    }
                });

            likeBtn.addEventListener('click', function () {
                const isLiked = this.dataset.liked === 'true';
                this.disabled = true;

                fetch('/likes', {
                    method: isLiked ? 'DELETE' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                    },
                    body: JSON.stringify({ action_id: parseInt(actionId) })
                })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        const isNowLiked = !isLiked;
                        this.dataset.liked = isNowLiked;
                        this.querySelector('.like-text').textContent = isNowLiked ? 'Unlike' : 'Like';
                        countEl.textContent = d.data.like_count;
                    }
                })
                .finally(() => { this.disabled = false; });
            });
        }
    });
</script>
@endpush
@endsection