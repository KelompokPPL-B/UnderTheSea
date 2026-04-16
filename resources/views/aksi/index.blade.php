@extends('layouts.app')

@section('content')
<!-- PBI-AksiIndex -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-4xl font-bold text-ocean-900 mb-3">Conservation Actions</h1>
                <p class="text-gray-600">Join the movement for ocean conservation. Explore actions you can take today.</p>
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
            <!-- Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($aksi as $item)
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition group hover:scale-[1.02] animate-fade overflow-hidden">
                        <!-- Image -->
                        @if($item->gambar)
                            <div class="overflow-hidden h-48">
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}" class="w-full h-48 object-cover group-hover:scale-105 transition" loading="lazy">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                                <span class="text-ocean-400">No image</span>
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <!-- Title -->
                            <a href="{{ route('aksi.show', $item->id_aksi) }}" class="block group-hover:text-ocean-600 transition">
                                <h3 class="text-lg font-bold text-ocean-900 line-clamp-2">{{ $item->judul_aksi }}</h3>
                            </a>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->deskripsi ?? 'No description' }}</p>

                            <!-- Creator Info -->
                            <div class="pt-2 border-t border-ocean-100">
                                <p class="text-xs text-gray-600">
                                    Created by <span class="font-semibold text-ocean-900">{{ $item->createdBy->name }}</span>
                                    <span class="badge badge-success text-xs ml-1">{{ $item->createdBy->badge }}</span>
                                </p>
                            </div>

                            <!-- Like Count and Button -->
                            <div class="pt-2 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-ocean-900 like-count-{{ $item->id_aksi }}">0</span>
                                    <span class="text-xs text-gray-600">likes</span>
                                </div>
                                @auth
                                    <button class="like-btn-card btn btn-sm btn-ghost" data-action-id="{{ $item->id_aksi }}">
                                        ❤️ Like
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="text-xs text-ocean-600 hover:underline font-semibold">Sign in</a>
                                @endauth
                            </div>

                            <!-- View Detail Link, Copy, and Admin Actions -->
                            <div class="flex gap-2 mt-3 pt-3 border-t border-ocean-100">
                                <a href="{{ route('aksi.show', $item->id_aksi) }}" class="btn btn-primary btn-sm flex-1">View</a>
                                <button class="copy-link-btn btn btn-outline btn-sm" data-url="{{ route('aksi.show', $item->id_aksi) }}" title="Copy link">
                                    📋
                                </button>
                                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $item->created_by))
                                    <a href="{{ route('aksi.edit', $item->id_aksi) }}" class="btn btn-outline btn-sm">Edit</a>
                                    <button class="delete-btn-card btn btn-error btn-sm" data-action-id="{{ $item->id_aksi }}">Delete</button>
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
        initializeCopyButtons();
        initializeLikeCountsCard();
        initializeLikeButtonsCard();
        loadLikeStatesCard();
    });

    function initializeCopyButtons() {
        document.querySelectorAll('.copy-link-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                copyToClipboard(this);
            });
        });
    }

    function copyToClipboard(btn) {
        const url = btn.dataset.url;
        navigator.clipboard.writeText(url).then(() => {
            const originalText = btn.textContent;
            btn.textContent = '✓';
            btn.style.color = '#22c55e';
            btn.style.borderColor = '#22c55e';
            setTimeout(() => {
                btn.textContent = originalText;
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 2000);
        }).catch(() => {
            btn.textContent = '✗';
            btn.style.color = '#ef4444';
            btn.style.borderColor = '#ef4444';
            setTimeout(() => {
                btn.textContent = '📋';
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 2000);
        });
    }

    function initializeLikeButtonsCard() {
        document.querySelectorAll('.like-btn-card').forEach(btn => {
            btn.addEventListener('click', toggleLikeCard);
        });
    }

    function toggleLikeCard(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        const actionId = btn.dataset.actionId;
        const isLiked = btn.dataset.liked === 'true';

        btn.disabled = true;
        btn.style.opacity = '0.6';
        const originalText = btn.textContent;
        btn.textContent = 'Loading...';

        const method = isLiked ? 'DELETE' : 'POST';

        fetch('/likes', {
            method: method,
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
                btn.dataset.liked = isNowLiked;
                btn.style.borderColor = isNowLiked ? '#2563eb' : '#ddd';
                btn.style.color = isNowLiked ? '#2563eb' : '#666';
                btn.style.backgroundColor = isNowLiked ? '#eff6ff' : 'transparent';
                updateLikeCountCard(actionId, data.data.like_count);
                btn.textContent = isNowLiked ? '❤️ Unlike' : '❤️ Like';
            } else {
                btn.textContent = originalText;
            }
        })
        .catch(err => {
            console.error('Error:', err);
            btn.textContent = originalText;
        })
        .finally(() => {
            btn.disabled = false;
            btn.style.opacity = '1';
        });
    }

    function loadLikeCountsCard() {
        document.querySelectorAll('.like-btn-card').forEach(btn => {
            const actionId = btn.dataset.actionId;
            fetch(`/likes/${actionId}/count`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        updateLikeCountCard(actionId, data.data.like_count);
                    }
                })
                .catch(err => console.error('Error:', err));
        });
    }

    function initializeLikeCountsCard() {
        // Initialize all like counts to 0 (will be updated by loadLikeCountsCard)
    }

    function updateLikeCountCard(actionId, count) {
        const countElement = document.querySelector(`.like-count-${actionId}`);
        if (countElement) {
            countElement.textContent = count;
        }
    }

    function loadLikeStatesCard() {
        fetch('/likes', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                document.querySelectorAll('.like-btn-card').forEach(btn => {
                    const actionId = parseInt(btn.dataset.actionId);
                    const isLiked = data.data.some(like => like.action_id === actionId);
                    if (isLiked) {
                        btn.dataset.liked = 'true';
                        btn.style.borderColor = '#2563eb';
                        btn.style.color = '#2563eb';
                        btn.style.backgroundColor = '#eff6ff';
                    }
                });
            }
        })
        .catch(err => console.error('Error loading like state:', err));
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection
