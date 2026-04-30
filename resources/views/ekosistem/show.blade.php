@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-4xl mx-auto px-6 py-6 mb-6">
        @include('layouts.breadcrumb', ['breadcrumbs' => [
            ['label' => 'Marine Ecosystems', 'url' => route('ekosistem.index')],
            ['label' => $ekosistem->nama_ekosistem]
        ]])
    </div>
    <div class="max-w-4xl mx-auto px-6 py-6">
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">
            <!-- Hero Image -->
            @if($ekosistem->gambar)
                <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="w-full h-96 object-cover" loading="lazy">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                    <span class="text-ocean-400">No image</span>
                </div>
            @endif

            <div class="p-8 space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-start pb-6 border-b border-ocean-100 animate-fade">
                    <div>
                        <h1 class="text-4xl font-bold text-ocean-900">{{ $ekosistem->nama_ekosistem }}</h1>
                        <p class="text-ocean-600 text-lg mt-2 font-semibold">Marine Ecosystem</p>
                    </div>
                    @auth
                        <button class="bookmark-btn btn btn-outline" data-type="ekosistem" data-item-id="{{ $ekosistem->id_ekosistem }}">
                            <span class="bookmark-text">Bookmark</span>
                        </button>
                    @endauth
                </div>

                <!-- Location Card -->
                <div class="p-4 bg-ocean-50 rounded-xl border border-ocean-200 animate-fade">
                    <h3 class="text-sm font-bold text-ocean-700 mb-2 uppercase">Location</h3>
                    <p class="text-gray-700">{{ $ekosistem->lokasi ?? 'Not specified' }}</p>
                </div>

                <!-- Prose Content -->
                <div class="prose prose-sm max-w-none space-y-6">
                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Description</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ekosistem->deskripsi ?? 'No description available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Role in Marine Life</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ekosistem->peran ?? 'No information available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Threats</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ekosistem->ancaman ?? 'No threats specified' }}</p>
                    </div>
                </div>

                <!-- Conservation Section -->
                @if($ekosistem->cara_menjaga || $ekosistem->larangan || $ekosistem->dampak_kerusakan)
                    <div class="border-t border-ocean-100 pt-8 space-y-6">
                        <h2 class="text-2xl font-bold text-ocean-900">Conservation Guide</h2>

                        <!-- Protection Tips -->
                        @if($ekosistem->cara_menjaga)
                            <div class="p-5 bg-green-50 rounded-xl border border-green-200 animate-fade">
                                <h3 class="text-lg font-bold text-green-800 mb-3">Protection Tips</h3>
                                <p class="text-green-900 leading-relaxed whitespace-pre-line">{{ $ekosistem->cara_menjaga }}</p>
                            </div>
                        @endif

                        <!-- Warnings -->
                        @if($ekosistem->larangan)
                            <div class="p-5 bg-red-50 rounded-xl border border-red-200 animate-fade">
                                <h3 class="text-lg font-bold text-red-800 mb-3">Warnings</h3>
                                <p class="text-red-900 leading-relaxed whitespace-pre-line">{{ $ekosistem->larangan }}</p>
                            </div>
                        @endif

                        <!-- Impact -->
                        @if($ekosistem->dampak_kerusakan)
                            <div class="p-5 bg-yellow-50 rounded-xl border border-yellow-200 animate-fade">
                                <h3 class="text-lg font-bold text-yellow-800 mb-3">Impact</h3>
                                <p class="text-yellow-900 leading-relaxed whitespace-pre-line">{{ $ekosistem->dampak_kerusakan }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('ekosistem.index') }}" class="btn btn-outline btn-sm">Back to Ecosystems</a>

                    <button class="share-btn btn btn-outline btn-sm px-3" data-url="{{ request()->url() }}" title="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('ekosistem.edit', $ekosistem->id_ekosistem) }}" class="btn btn-outline btn-sm">Edit</a>
                            <button class="delete-btn btn btn-sm bg-white border border-red-300 hover:bg-red-50 text-red-500 hover:text-red-600 px-3"
                                data-ekosistem-id="{{ $ekosistem->id_ekosistem }}" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        @endif
                    @endauth
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

        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this ecosystem? This cannot be undone.')) return;

                const ekosistemId = this.dataset.ekosistemId;
                this.disabled = true;

                fetch(`/ekosistem/${ekosistemId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showNotification('Ecosystem deleted successfully', 'success');
                        setTimeout(() => window.location.href = '{{ route('ekosistem.index') }}', 1500);
                    } else {
                        showNotification(data.message, 'error');
                        this.disabled = false;
                    }
                })
                .catch(() => {
                    showNotification('An error occurred. Please try again.', 'error');
                    this.disabled = false;
                });
            });
        }
    });

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection