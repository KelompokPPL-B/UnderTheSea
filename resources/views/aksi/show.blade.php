@extends('layouts.app')

@section('content')
<!-- PBI-AksiShow -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
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
                <!-- Header Section -->
                <div class="border-b border-ocean-100 pb-6">
                    <div class="flex justify-between items-start gap-6 mb-4">
                        <div class="flex-1 animate-fade">
                            <h1 class="text-4xl font-bold text-ocean-900 mb-3">{{ $aksi->judul_aksi }}</h1>
                            <p class="text-gray-700">Created by <span class="font-semibold text-ocean-900">{{ $aksi->createdBy->name }}</span> <span class="badge badge-success text-xs ml-2">{{ $aksi->createdBy->badge }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="prose prose-sm max-w-none space-y-8">
                    <div class="animate-fade">
                        <h2 class="text-2xl font-bold text-ocean-900 mb-4">Overview</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->deskripsi ?? 'No description available' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h2 class="text-2xl font-bold text-ocean-900 mb-4">Benefits</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->manfaat ?? 'No benefits specified' }}</p>
                    </div>

                    <div class="animate-fade">
                        <h2 class="text-2xl font-bold text-ocean-900 mb-4">How to Participate</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $aksi->cara_melakukan ?? 'No instructions available' }}</p>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-ocean-100">
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline btn-sm">Back to Actions</a>
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $aksi->created_by))
                        <a href="{{ route('aksi.edit', $aksi->id_aksi) }}" class="btn btn-outline btn-sm">Edit</a>
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
        }
</script>
@endpush
@endsection
