@extends('layouts.app')

@section('content')
<div class="py-8 sm:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Create Conservation Action</h1>
                    <p class="text-sm sm:text-base text-gray-600">Share your conservation idea with the community</p>
                </div>

                <!-- Form -->
                <form id="actionForm" method="POST" action="{{ route('aksi.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="judul_aksi" class="block text-sm font-semibold text-gray-900">
                                Title *
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Give your action a clear, descriptive title
                                </div>
                            </span>
                        </div>
                        <input
                            type="text"
                            id="judul_aksi"
                            name="judul_aksi"
                            value="{{ old('judul_aksi') }}"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('judul_aksi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('judul_aksi') bg-red-50 @enderror"
                            placeholder="Enter action title"
                            required
                        >
                        @error('judul_aksi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-900">
                                Description
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Explain what this conservation action is about
                                </div>
                            </span>
                        </div>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('deskripsi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('deskripsi') bg-red-50 @enderror"
                            placeholder="Describe the conservation action"
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Benefits -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="manfaat" class="block text-sm font-semibold text-gray-900">
                                Benefits
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Describe the positive impact of this action
                                </div>
                            </span>
                        </div>
                        <textarea
                            id="manfaat"
                            name="manfaat"
                            rows="3"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('manfaat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('manfaat') bg-red-50 @enderror"
                            placeholder="What are the benefits of this action?"
                        >{{ old('manfaat') }}</textarea>
                        @error('manfaat')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- How to Participate -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="cara_melakukan" class="block text-sm font-semibold text-gray-900">
                                How to Participate
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Provide step-by-step instructions for participation
                                </div>
                            </span>
                        </div>
                        <textarea
                            id="cara_melakukan"
                            name="cara_melakukan"
                            rows="3"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('cara_melakukan') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('cara_melakukan') bg-red-50 @enderror"
                            placeholder="Explain how people can participate"
                        >{{ old('cara_melakukan') }}</textarea>
                        @error('cara_melakukan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="gambar" class="block text-sm font-semibold text-gray-900">
                                Image
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Upload a JPG or PNG image (max 2MB)
                                </div>
                            </span>
                        </div>
                        <div class="flex items-center gap-4">
                            <input
                                type="file"
                                id="gambar"
                                name="gambar"
                                accept="image/jpeg,image/png,image/jpg"
                                class="flex-1 px-4 py-2 border-2 {{ $errors->has('gambar') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('gambar') bg-red-50 @enderror"
                            >
                            <span class="text-sm text-gray-500">JPG, PNG (Max 2MB)</span>
                        </div>
                        @error('gambar')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submitBtn"
                        >
                            Create Action
                        </button>
                        <a
                            href="{{ route('aksi.index') }}"
                            class="flex-1 text-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>    
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

document.getElementById('actionForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    const form = this;

    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating...';

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification(data.message, 'success');
            setTimeout(() => {
                window.location.href = '/aksi/' + data.data.id_aksi;
            }, 1500);
        } else {
            showNotification(data.message || 'An error occurred', 'error');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Create Action';
        }
    })
    .catch(err => {
        showNotification('An error occurred. Please try again.', 'error');
        console.error('Error:', err);
        submitBtn.disabled = false;
        submitBtn.textContent = 'Create Action';
    });
});

document.querySelectorAll('input, textarea').forEach(field => {
    field.addEventListener('change', function() {
        if (this.classList.contains('border-red-500')) {
            this.classList.remove('border-red-500', 'bg-red-50');
            this.classList.add('border-gray-200');
        }
    });
});
</script>
@endpush
@endsection