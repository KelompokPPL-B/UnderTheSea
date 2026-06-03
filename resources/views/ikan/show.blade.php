@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-6xl mx-auto px-6 py-6 mb-6">
        @include('layouts.breadcrumb', ['breadcrumbs' => [
            ['label' => 'Fish Species', 'url' => route('ikan.index')],
            ['label' => $ikan->nama]
        ]])
    </div>
    <div class="max-w-6xl mx-auto px-6 py-6">
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">
            @if($ikan->gambar)
                <img src="{{ asset('storage/' . $ikan->gambar) }}" alt="{{ $ikan->nama }}" class="w-full h-96 object-cover" loading="lazy">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                    <span class="text-ocean-400">No image</span>
                </div>
            @endif

            <div class="p-8 space-y-8">
                <div class="flex justify-between items-start pb-6 border-b border-ocean-100 animate-fade">
                    <div>
                        <h1 class="text-4xl font-bold text-ocean-900">{{ $ikan->nama }}</h1>
                        <p class="text-ocean-600 text-lg mt-2 font-semibold">Fish Species</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8 animate-fade">
                    <div class="p-4 bg-ocean-50 rounded-xl border border-ocean-200">
                        <h3 class="text-sm font-bold text-ocean-700 mb-2 uppercase">Habitat</h3>
                        <p class="text-gray-700">{{ $ikan->habitat ?? 'Not specified' }}</p>
                    </div>
                    <div class="p-4 bg-eco-100 rounded-xl border border-eco-300">
                        <h3 class="text-sm font-bold text-eco-700 mb-2 uppercase">Conservation Status</h3>
                        <p class="text-gray-700">{{ $ikan->status_konservasi ?? 'Not specified' }}</p>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none space-y-6">
                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Description</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ikan->deskripsi ?? 'No description available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Characteristics</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ikan->karakteristik ?? 'No characteristics available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h3 class="text-2xl font-bold text-ocean-900 mb-3">Unique Facts</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $ikan->fakta_unik ?? 'No unique facts available' }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('ikan.index') }}" class="btn btn-sm font-semibold flex items-center gap-2" style="background:#f1f5f9;color:#475569;border:1px solid #cbd5e1;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Back to Fish
                    </a>

                    <button class="share-btn btn btn-outline btn-sm px-3" data-url="{{ request()->url() }}" title="Share">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </button>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('ikan.edit', $ikan->id_ikan) }}" class="btn btn-sm font-semibold flex items-center gap-2" style="background:#f59e0b;color:#fff;border:none;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>

                            <button class="delete-btn btn btn-sm bg-white border border-red-300 hover:bg-red-50 text-red-500 hover:text-red-600 px-3 flex items-center gap-2"
                                data-ikan-id="{{ $ikan->id_ikan }}" title="Delete">
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
                if (!confirm('Are you sure you want to delete this fish species? This cannot be undone.')) return;

                const ikanId = this.dataset.ikanId;
                this.disabled = true;

                fetch(`/ikan/${ikanId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': getCsrfToken() }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showNotification('Fish species deleted successfully', 'success');
                        setTimeout(() => window.location.href = '{{ route('ikan.index') }}', 1500);
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