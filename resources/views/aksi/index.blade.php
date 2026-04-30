@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-2">Conservation Actions</h1>
                <p class="text-gray-500">Join the movement for ocean conservation.</p>
            </div>
            @auth
                <a href="{{ route('aksi.create') }}" class="btn btn-primary btn-sm whitespace-nowrap">+ Create Action</a>
            @endauth
        </div>

        <!-- Sort Controls -->
        <div class="mb-6 flex justify-end">
            <select onchange="window.location.href='{{ route('aksi.index') }}?sort=' + this.value" class="select select-bordered select-sm">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Most Popular</option>
            </select>
        </div>

        @if($aksi->isEmpty())
            <div class="bg-white rounded-2xl shadow-card p-12 text-center">
                <p class="text-ocean-600 text-lg font-semibold">No conservation actions yet. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($aksi as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden flex flex-col">

                        <!-- Image -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48 shrink-0">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center shrink-0">
                                <span class="text-ocean-300 text-sm">No image</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-5 flex flex-col flex-1">

                            <!-- Title -->
                            <a href="{{ route('aksi.show', $item->id_aksi) }}"
                                class="text-base font-bold text-ocean-900 line-clamp-2 mb-1 group-hover:text-ocean-600 transition">
                                {{ $item->judul_aksi }}
                            </a>

                            <!-- Description -->
                            <p class="text-gray-400 text-sm line-clamp-2 mb-4">
                                {{ $item->deskripsi ?? 'No description available.' }}
                            </p>

                            <div class="flex-1"></div>

                            <!-- Creator -->
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 rounded-full bg-ocean-200 flex items-center justify-center text-ocean-700 text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($item->createdBy->name, 0, 1)) }}
                                </div>
                                <span class="text-xs font-semibold text-ocean-900">{{ $item->createdBy->name }}</span>
                                <span class="badge badge-success badge-xs">{{ $item->createdBy->badge }}</span>
                            </div>

                            <!-- Likes -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-1 text-sm text-gray-500">
                                    <span class="text-red-400">❤️</span>
                                    <span class="font-semibold text-ocean-900 like-count-{{ $item->id_aksi }}">0</span>
                                    <span>likes</span>
                                </div>
                                @auth
                                    <button class="like-btn-card text-xs text-gray-400 hover:text-red-500 transition border border-gray-200 rounded-lg px-3 py-1 hover:border-red-300 hover:bg-red-50"
                                        data-action-id="{{ $item->id_aksi }}">
                                        ❤️ Like
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="text-xs text-ocean-500 hover:underline">Sign in to like</a>
                                @endauth
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-2 pt-3 border-t border-ocean-100">
                                <a href="{{ route('aksi.show', $item->id_aksi) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $item->created_by))
                                    <a href="{{ route('aksi.edit', $item->id_aksi) }}" class="btn btn-outline btn-sm">Edit</a>
                                    <button class="delete-btn-card btn btn-sm bg-white border border-red-300 hover:bg-red-50 text-red-500 hover:text-red-600 px-3"
                                        data-action-id="{{ $item->id_aksi }}" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $aksi->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        loadLikeCountsCard();
        initializeLikeButtonsCard();
        loadLikeStatesCard();
        initializeDeleteButtons();
    });

    function initializeDeleteButtons() {
        document.querySelectorAll('.delete-btn-card').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Are you sure you want to delete this action?')) return;
                const actionId = this.dataset.actionId;
                const card = this.closest('.bg-white');
                this.disabled = true;

                fetch(`/aksi/${actionId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        card.style.opacity = '0';
                        card.style.transition = 'opacity 0.3s';
                        setTimeout(() => card.remove(), 300);
                    }
                })
                .catch(() => { this.disabled = false; });
            });
        });
    }

    function initializeLikeButtonsCard() {
        document.querySelectorAll('.like-btn-card').forEach(btn => {
            btn.addEventListener('click', function() {
                const actionId = this.dataset.actionId;
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
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const isNowLiked = !isLiked;
                        this.dataset.liked = isNowLiked;
                        this.textContent = isNowLiked ? '❤️ Unlike' : '❤️ Like';
                        if (isNowLiked) {
                            this.style.color = '#ef4444';
                            this.style.borderColor = '#fca5a5';
                            this.style.backgroundColor = '#fef2f2';
                        } else {
                            this.style.color = '';
                            this.style.borderColor = '';
                            this.style.backgroundColor = '';
                        }
                        const counter = document.querySelector(`.like-count-${actionId}`);
                        if (counter) counter.textContent = data.data.like_count;
                    }
                })
                .finally(() => { this.disabled = false; });
            });
        });
    }

    function loadLikeCountsCard() {
        document.querySelectorAll('.like-btn-card').forEach(btn => {
            fetch(`/likes/${btn.dataset.actionId}/count`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        const counter = document.querySelector(`.like-count-${btn.dataset.actionId}`);
                        if (counter) counter.textContent = data.data.like_count;
                    }
                });
        });
    }

    function loadLikeStatesCard() {
        fetch('/likes', { headers: { 'X-CSRF-TOKEN': getCsrfToken() } })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                document.querySelectorAll('.like-btn-card').forEach(btn => {
                    const isLiked = data.data.some(like => like.action_id === parseInt(btn.dataset.actionId));
                    if (isLiked) {
                        btn.dataset.liked = 'true';
                        btn.textContent = '❤️ Unlike';
                        btn.style.color = '#ef4444';
                        btn.style.borderColor = '#fca5a5';
                        btn.style.backgroundColor = '#fef2f2';
                    }
                });
            }
        });
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection