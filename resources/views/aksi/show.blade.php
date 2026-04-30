@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-4xl mx-auto px-6 py-6 mb-6">
        @include('layouts.breadcrumb', ['breadcrumbs' => [
            ['label' => 'Conservation Actions', 'url' => route('aksi.index')],
            ['label' => $aksi->judul_aksi]
        ]])
    </div>
    <div class="max-w-4xl mx-auto px-6 py-6">
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">
            <!-- Hero Image -->
            @if($aksi->gambar)
                <img src="/storage/{{ $aksi->gambar }}" alt="{{ $aksi->judul_aksi }}" class="w-full h-96 object-cover" loading="lazy">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                    <span class="text-ocean-400 text-lg">No image available</span>
                </div>
            @endif

            <div class="p-8 space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-start pb-6 border-b border-ocean-100 animate-fade">
                    <div>
                        <h1 class="text-4xl font-bold text-ocean-900">{{ $aksi->judul_aksi }}</h1>
                        <p class="text-ocean-600 text-lg mt-2 font-semibold">Conservation Action</p>
                        <p class="text-gray-500 text-sm mt-1">
                            Created by
                            <span class="font-semibold text-ocean-900">{{ $aksi->createdBy->name }}</span>
                            <span class="badge badge-success text-xs ml-1">{{ $aksi->createdBy->badge }}</span>
                        </p>
                    </div>
                    @auth
                        <button class="bookmark-btn btn btn-outline shrink-0" data-type="aksi" data-item-id="{{ $aksi->id_aksi }}">
                            <span class="bookmark-text">Bookmark</span>
                        </button>
                    @endauth
                </div>

                <!-- Prose Content -->
                <div class="prose prose-sm max-w-none space-y-6">
                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Overview</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->deskripsi ?? 'No description available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Benefits</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->manfaat ?? 'No benefits specified' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">How to Participate</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->cara_melakukan ?? 'No instructions available' }}</p>
                    </div>
                </div>

                <!-- Like Section -->
                @auth
                    <div class="bg-gradient-to-r from-ocean-50 to-eco-50 p-6 rounded-xl border border-ocean-200 animate-fade">
                        <div class="flex items-center justify-between">
                            <button class="like-btn btn btn-primary btn-sm" data-action-id="{{ $aksi->id_aksi }}">
                                <span class="like-icon text-lg">❤️</span>
                                <span class="like-text ml-1">Like</span>
                            </button>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-ocean-600">
                                    <span class="count">0</span>
                                </div>
                                <p class="text-sm text-gray-600">Likes</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-ocean-50 p-6 rounded-xl border border-ocean-200 text-center">
                        <p class="text-ocean-900">
                            <a href="{{ route('login') }}" class="text-ocean-600 hover:underline font-semibold">Sign in</a>
                            to like and bookmark this action
                        </p>
                    </div>
                @endauth

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <!-- Back -->
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline btn-sm">Back to Actions</a>

                    <!-- Share (ikon) -->
                    <button class="share-btn btn btn-outline btn-sm px-3" data-url="{{ request()->url() }}" title="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>

                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $aksi->created_by))
                        <!-- Edit -->
                        <a href="{{ route('aksi.edit', $aksi->id_aksi) }}" class="btn btn-outline btn-sm">Edit</a>

                        <!-- Delete (ikon tempat sampah) -->
                        <button class="delete-btn btn btn-sm bg-white border border-red-300 hover:bg-red-50 text-red-500 hover:text-red-600 px-3"
                            data-action-id="{{ $aksi->id_aksi }}" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
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
            error: 'bg-red-100 text-red-800',
            info: 'bg-blue-100 text-blue-800'
        };
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg ${colors[type]} shadow-lg z-50 animate-fade-in`;
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 4000);
    }

    document.addEventListener('DOMContentLoaded', function() {

        // Share
        const shareBtn = document.querySelector('.share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', function(e) {
                e.preventDefault();
                navigator.clipboard.writeText(this.dataset.url).then(() => {
                    showNotification('Link copied to clipboard!', 'success');
                }).catch(() => {
                    showNotification('Failed to copy link', 'error');
                });
            });
        }

        // Delete
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
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
                        showNotification('Action deleted successfully', 'success');
                        setTimeout(() => window.location.href = '{{ route('aksi.index') }}', 1500);
                    } else {
                        showNotification(data.message, 'error');
                        this.disabled = false;
                    }
                })
                .catch(() => {
                    showNotification('An error occurred.', 'error');
                    this.disabled = false;
                });
            });
        }

        // Like
        const likeBtn = document.querySelector('.like-btn');
        if (likeBtn) {
            const actionId = likeBtn.dataset.actionId;

            // Load count
            fetch(`/likes/${actionId}/count`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.querySelector('.count').textContent = data.data.like_count;
                    }
                });

            // Load state
            fetch('/likes', { headers: { 'X-CSRF-TOKEN': getCsrfToken() } })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success' && data.data) {
                        const isLiked = data.data.some(like => like.action_id === parseInt(actionId));
                        if (isLiked) {
                            likeBtn.dataset.liked = 'true';
                            likeBtn.querySelector('.like-text').textContent = 'Unlike';
                        }
                    }
                });

            likeBtn.addEventListener('click', function() {
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
                        this.querySelector('.like-text').textContent = isNowLiked ? 'Unlike' : 'Like';
                        document.querySelector('.count').textContent = data.data.like_count;
                    }
                })
                .finally(() => { this.disabled = false; });
            });
        }
    });

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection