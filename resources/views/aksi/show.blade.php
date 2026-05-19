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

            {{-- ===== Hero Image ===== --}}
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

                {{-- ===== Header: Title + Bookmark ===== --}}
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
                        <button class="bookmark-btn btn btn-outline btn-sm shrink-0" data-type="aksi" data-item-id="{{ $aksi->id_aksi }}">
                            <span class="bookmark-text">🔖 Bookmark</span>
                        </button>
                    @endauth
                </div>

                {{-- ===== Quick Info Cards ===== --}}
                @php
                    $hasQuickInfo = $aksi->lokasi || $aksi->tanggal_kegiatan || $aksi->volunteer_dibutuhkan;
                @endphp
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

                {{-- ===== Prose Sections ===== --}}
                <div class="space-y-7">

                    {{-- Description / Overview --}}
                    @if($aksi->deskripsi)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-ocean-500 rounded-full inline-block"></span>
                            Overview
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->deskripsi }}</p>
                    </div>
                    @endif

                    {{-- Benefits --}}
                    @if($aksi->manfaat)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-eco-500 rounded-full inline-block"></span>
                            Benefits
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->manfaat }}</p>
                    </div>
                    @endif

                    {{-- Environmental Issue --}}
                    @if($aksi->isu_lingkungan)
                    <div class="animate-fade bg-red-50 border-l-4 border-red-400 rounded-r-xl p-4">
                        <h3 class="text-base font-bold text-red-700 mb-2 flex items-center gap-2">
                            ⚠️ Environmental Issue
                        </h3>
                        <p class="text-gray-700 leading-relaxed text-sm">{{ $aksi->isu_lingkungan }}</p>
                    </div>
                    @endif

                    {{-- Conservation Goals --}}
                    @if($aksi->tujuan_konservasi)
                    <div class="animate-fade bg-eco-50 border-l-4 border-eco-500 rounded-r-xl p-4">
                        <h3 class="text-base font-bold text-eco-700 mb-2 flex items-center gap-2">
                            🎯 Conservation Goals
                        </h3>
                        <p class="text-gray-700 leading-relaxed text-sm">{{ $aksi->tujuan_konservasi }}</p>
                    </div>
                    @endif

                    {{-- How to Participate --}}
                    @if($aksi->cara_melakukan)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-blue-400 rounded-full inline-block"></span>
                            How to Participate
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->cara_melakukan }}</p>
                    </div>
                    @endif

                    {{-- Action Impact --}}
                    @if($aksi->dampak_aksi)
                    <div class="animate-fade">
                        <h3 class="text-xl font-bold text-ocean-900 mb-3 flex items-center gap-2">
                            <span class="w-1 h-6 bg-amber-400 rounded-full inline-block"></span>
                            Action Impact
                        </h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->dampak_aksi }}</p>
                    </div>
                    @endif

                </div>

                {{-- ===================================================== --}}
                {{-- ===== MARK ACTION SECTION (PBI-XX) ===== --}}
                {{-- ===================================================== --}}
                @php
                    $sudahTandai = session()->has("tandai_aksi_{$aksi->id_aksi}");
                    $namaTandai  = session()->get("tandai_aksi_{$aksi->id_aksi}_nama", '');
                    // Sync dari DB kalau session kosong
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
                @endphp

                <div class="animate-fade rounded-2xl overflow-hidden border border-gray-200 shadow-sm">

                    {{-- Header --}}
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

                    <div class="p-6 bg-white">

                        {{-- Flash: success --}}
                        @if(session('tandai_success'))
                            <div class="mb-5 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                                        bg-green-50 border border-green-200 text-green-800">
                                <span class="shrink-0 text-base">✅</span>
                                {{ session('tandai_success') }}
                            </div>
                        @endif

                        {{-- Flash: info --}}
                        @if(session('tandai_info'))
                            <div class="mb-5 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                                        bg-blue-50 border border-blue-200 text-blue-800">
                                <span class="shrink-0 text-base">ℹ️</span>
                                {{ session('tandai_info') }}
                            </div>
                        @endif

                        {{-- Validation error --}}
                        @if($errors->has('nama_peserta'))
                            <div class="mb-5 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium
                                        bg-red-50 border border-red-200 text-red-800">
                                <span class="shrink-0 text-base">⚠️</span>
                                {{ $errors->first('nama_peserta') }}
                            </div>
                        @endif

                        @if($sudahTandai)
                            {{-- ===== STATE: Sudah ditandai ===== --}}
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-full bg-green-100 border-2 border-green-300
                                            flex items-center justify-center text-xl shrink-0">
                                    ✅
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">You've marked this action!</p>
                                    @if($namaTandai)
                                        <p class="text-gray-600 text-xs mt-0.5">
                                            Recorded as
                                            <span class="font-semibold text-ocean-700">{{ $namaTandai }}</span>
                                        </p>
                                    @endif
                                    <p class="text-gray-500 text-xs mt-0.5">Your contribution has been saved 🌊</p>
                                </div>
                            </div>

                        @else
                            {{-- ===== STATE: Belum ditandai ===== --}}
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
                                                   placeholder-gray-400 bg-white transition
                                                   {{ $errors->has('nama_peserta')
                                                       ? 'border-red-400 focus:ring-2 focus:ring-red-200'
                                                       : 'border-gray-300 focus:ring-2 focus:ring-ocean-200 focus:border-ocean-400' }}
                                                   focus:outline-none"
                                        >
                                    </div>
                                    <button type="submit"
                                        class="w-full py-3 rounded-xl text-sm font-bold
                                               bg-blue-600 hover:bg-blue-700
                                               text-white shadow-md hover:shadow-lg
                                               transition-all active:scale-95
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
                {{-- ===== END MARK ACTION SECTION ===== --}}


                {{-- ===== Like Section ===== --}}
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

                {{-- ===== Action Buttons ===== --}}
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline btn-sm">← Back to Actions</a>

                    <button class="share-btn btn btn-outline btn-sm gap-2" data-url="{{ request()->url() }}" title="Share">
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

            </div>{{-- end p-8 --}}
        </div>{{-- end card --}}
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

        // ----- Share -----
        document.querySelector('.share-btn')?.addEventListener('click', function () {
            navigator.clipboard.writeText(this.dataset.url)
                .then(() => showNotification('Link copied to clipboard!', 'success'))
                .catch(() => showNotification('Failed to copy link.', 'error'));
        });

        // ----- Delete -----
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
                    setTimeout(() => window.location.href = '{{ route('aksi.index') }}', 1500);
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

        // ----- Like -----
        const likeBtn = document.querySelector('.like-btn');
        if (likeBtn) {
            const actionId = likeBtn.dataset.actionId;
            const countEl  = document.querySelector('.count');

            // Load count
            fetch(`/likes/${actionId}/count`)
                .then(r => r.json())
                .then(d => { if (d.status === 'success') countEl.textContent = d.data.like_count; });

            // Load state
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

            // Toggle like
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