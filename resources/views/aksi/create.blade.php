@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Create Conservation Action</h1>
                <p class="text-ocean-600">Share your conservation idea with the community</p>
            </div>

            <!-- Form -->
            <form id="actionForm" method="POST" action="{{ route('aksi.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="judul_aksi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Title *
                    </label>
                    <input
                        type="text"
                        id="judul_aksi"
                        name="judul_aksi"
                        value="{{ old('judul_aksi') }}"
                        class="input input-bordered w-full @error('judul_aksi') input-error @enderror"
                        placeholder="Enter action title"
                        required
                    >
                    @error('judul_aksi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Description
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror"
                        placeholder="Describe the conservation action"
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Benefits -->
                <div>
                    <label for="manfaat" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Benefits
                    </label>
                    <textarea
                        id="manfaat"
                        name="manfaat"
                        rows="3"
                        class="textarea textarea-bordered w-full @error('manfaat') textarea-error @enderror"
                        placeholder="What are the benefits of this action?"
                    >{{ old('manfaat') }}</textarea>
                    @error('manfaat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- How to Participate -->
                <div>
                    <label for="cara_melakukan" class="block text-sm font-semibold text-ocean-900 mb-2">
                        How to Participate
                    </label>
                    <textarea
                        id="cara_melakukan"
                        name="cara_melakukan"
                        rows="3"
                        class="textarea textarea-bordered w-full @error('cara_melakukan') textarea-error @enderror"
                        placeholder="Explain how people can participate"
                    >{{ old('cara_melakukan') }}</textarea>
                    @error('cara_melakukan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Image (JPG, PNG - Max 2MB)
                    </label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/jpeg,image/png,image/jpg"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                    >
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit" class="btn btn-primary flex-1" id="submitBtn">
                        Create Action
                    </button>
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline flex-1">Cancel</a>
                </div>
            </form>
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
</script>
@endpush
@endsection