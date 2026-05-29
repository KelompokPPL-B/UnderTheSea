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
                <img src="{{ asset('storage/' . $ikan->gambar) }}" alt="{{ $ikan->nama }}" class="w-full h-96 object-cover" loading="lazy">
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
                    <!-- Back to Fish -->
                    <a href="{{ route('ikan.index') }}" class="btn btn-sm font-semibold flex items-center gap-2" style="background:#f1f5f9;color:#475569;border:1px solid #cbd5e1;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                        Back to Fish
                    </a>

                    @if(auth()->check() && auth()->user()->isAdmin())
                    <!-- Edit -->
                    <a href="{{ route('ikan.edit', $ikan->id_ikan) }}" class="btn btn-sm font-semibold flex items-center gap-2" style="background:#f59e0b;color:#fff;border:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </a>
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
    });

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush
@endsection
