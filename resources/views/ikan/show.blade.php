@extends('layouts.app')

@section('content')
<!-- PBI-IkanShow -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-4xl mx-auto px-6 py-6 mb-6">
        @include('layouts.breadcrumb', ['breadcrumbs' => [
            ['label' => 'Fish Species', 'url' => route('ikan.index')],
            ['label' => $ikan->nama]
        ]])
    </div>
    <div class="max-w-4xl mx-auto px-6 py-6">
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition overflow-hidden">
            <!-- Hero Image -->
            @if($ikan->gambar)
                <img src="/storage/{{ $ikan->gambar }}" alt="{{ $ikan->nama }}" class="w-full h-96 object-cover" loading="lazy">
            @else
                <div class="w-full h-96 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center">
                    <span class="text-ocean-400">No image</span>
                </div>
            @endif

            <div class="p-8 space-y-8">
                <!-- Header -->
                <div class="flex justify-between items-start pb-6 border-b border-ocean-100 animate-fade">
                    <div>
                        <h1 class="text-4xl font-bold text-ocean-900">{{ $ikan->nama }}</h1>
                        <p class="text-ocean-600 text-lg mt-2 font-semibold">Fish Species</p>
                    </div>
                    @auth
                        <button class="bookmark-btn btn btn-outline" data-type="ikan" data-item-id="{{ $ikan->id_ikan }}">
                            <span class="bookmark-text">Bookmark</span>
                        </button>
                    @endauth
                </div>

                <!-- Info Grid -->
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

                <!-- Prose Content -->
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

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('ikan.index') }}" class="btn btn-outline btn-sm">Back to Fish</a>
                    <button class="share-btn btn btn-success btn-sm" data-url="{{ request()->url() }}">
                        Share
                    </button>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('ikan.edit', $ikan->id_ikan) }}" class="btn btn-outline btn-sm">Edit</a>
                        <button class="delete-btn btn btn-error btn-sm" data-ikan-id="{{ $ikan->id_ikan }}">
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
                shareContent(this);
            });
        }

        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this fish species? This cannot be undone.')) {
                    deleteIkan(this);
                }
            });
        }
    });

    function shareContent(btn) {
        const url = btn.dataset.url;
        navigator.clipboard.writeText(url).then(() => {
            showNotification('Link copied to clipboard!', 'success');
        }).catch(() => {
            showNotification('Failed to copy link', 'error');
        });
    }

    function deleteIkan(btn) {
        const ikanId = btn.dataset.ikanId;
        btn.disabled = true;
        btn.classList.add('opacity-60');
        const originalText = btn.textContent;
        btn.textContent = 'Deleting...';

        fetch(`/ikan/${ikanId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification('Fish species deleted successfully', 'success');
                setTimeout(() => window.location.href = '{{ route('ikan.index') }}', 1500);
            } else {
                showNotification(data.message, 'error');
                btn.disabled = false;
                btn.classList.remove('opacity-60');
                btn.textContent = originalText;
            }
        })
        .catch(err => {
            showNotification('An error occurred. Please try again.', 'error');
            console.error('Error:', err);
            btn.disabled = false;
            btn.classList.remove('opacity-60');
            btn.textContent = originalText;
        });
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection
