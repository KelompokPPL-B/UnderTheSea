@extends('layouts.app')

@section('content')
<!-- PBI-EkosistemShow -->
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

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('ekosistem.index') }}" class="btn btn-outline btn-sm">Back to Ecosystems</a>
                    <button class="share-btn btn btn-success btn-sm" data-url="{{ request()->url() }}">
                        Share
                    </button>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="{{ route('ekosistem.edit', $ekosistem->id_ekosistem) }}" class="btn btn-outline btn-sm">Edit</a>
                        <button class="delete-btn btn btn-error btn-sm" data-ekosistem-id="{{ $ekosistem->id_ekosistem }}">
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
                if (confirm('Are you sure you want to delete this ecosystem? This cannot be undone.')) {
                    deleteEkosistem(this);
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

    function deleteEkosistem(btn) {
        const ekosistemId = btn.dataset.ekosistemId;
        btn.disabled = true;
        btn.classList.add('opacity-60');
        const originalText = btn.textContent;
        btn.textContent = 'Deleting...';

        fetch(`/ekosistem/${ekosistemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification('Ecosystem deleted successfully', 'success');
                setTimeout(() => window.location.href = '{{ route('ekosistem.index') }}', 1500);
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
