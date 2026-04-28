{{--
#PBI-15
#OWNER-Faiz
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Add Fish Species</h1>
                <p class="text-ocean-600">Create a new fish species entry in the database</p>
                <p class="text-xs text-red-500 mt-2"><span class="font-bold">*</span> Semua field wajib diisi</p>
            </div>

            <!-- Form -->
            <form action="{{ route('ikan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate id="create-ikan-form">
                @csrf

                <!-- Name -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Fish Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        class="input input-bordered w-full rounded-xl @error('nama') input-error @enderror"
                        placeholder="Enter fish species name"
                        required
                    >
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('nama')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        class="textarea textarea-bordered w-full rounded-xl @error('deskripsi') textarea-error @enderror"
                        placeholder="Describe the fish species"
                        required
                    >{{ old('deskripsi') }}</textarea>
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Habitat -->
                <div>
                    <label for="habitat" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Habitat <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="habitat"
                        name="habitat"
                        value="{{ old('habitat') }}"
                        class="input input-bordered w-full rounded-xl @error('habitat') input-error @enderror"
                        placeholder="Enter habitat information"
                        required
                    >
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('habitat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label for="karakteristik" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Characteristics <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="karakteristik"
                        name="karakteristik"
                        rows="3"
                        class="textarea textarea-bordered w-full rounded-xl @error('karakteristik') textarea-error @enderror"
                        placeholder="Describe physical characteristics"
                        required
                    >{{ old('karakteristik') }}</textarea>
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('karakteristik')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Conservation Status -->
                <div>
                    <label for="status_konservasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Conservation Status <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="status_konservasi"
                        name="status_konservasi"
                        value="{{ old('status_konservasi') }}"
                        class="input input-bordered w-full @error('status_konservasi') input-error @enderror"
                        placeholder="e.g., Endangered, Vulnerable, Least Concern"
                        required
                    >
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('status_konservasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unique Facts -->
                <div>
                    <label for="fakta_unik" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Unique Facts <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="fakta_unik"
                        name="fakta_unik"
                        rows="3"
                        class="textarea textarea-bordered w-full @error('fakta_unik') textarea-error @enderror"
                        placeholder="Share interesting facts about this species"
                        required
                    >{{ old('fakta_unik') }}</textarea>
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Field ini wajib diisi.</p>
                    @error('fakta_unik')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Image (JPG, PNG - Max 2MB) <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/jpeg,image/png,image/jpg"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                        onchange="previewImage(event)"
                        required
                    >
                    <p class="field-error text-red-500 text-xs mt-1 hidden">Gambar wajib diupload.</p>
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Preview container -->
                    <div id="preview-container" class="hidden mt-3">
                        <p class="text-xs text-ocean-600 mb-1 font-semibold">Preview:</p>
                        <img id="image-preview" src="" alt="Preview" class="h-40 rounded-lg object-cover border border-ocean-200">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit" class="btn btn-primary flex-1">Create Fish</button>
                    <a href="{{ route('ikan.index') }}" class="btn btn-outline flex-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;
        const container = document.getElementById('preview-container');
        const preview   = document.getElementById('image-preview');
        const reader    = new FileReader();
        reader.onload   = function(e) {
            preview.src = e.target.result;
            container.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    const form = document.getElementById('create-ikan-form');

    form.addEventListener('submit', function(e) {
        let firstErrorEl = null;

        // Reset semua tampilan error sebelumnya
        form.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
        form.querySelectorAll('input, textarea').forEach(el => {
            el.classList.remove('border-red-500', 'ring-2', 'ring-red-300');
        });

        // Validasi semua field teks / textarea yang required
        form.querySelectorAll('input[required]:not([type="file"]), textarea[required]').forEach(function(field) {
            if (field.value.trim() === '') {
                markError(field);
                if (!firstErrorEl) firstErrorEl = field;
            }
        });

        // Validasi file input gambar
        const fileInput = document.getElementById('gambar');
        if (fileInput.files.length === 0) {
            markError(fileInput);
            if (!firstErrorEl) firstErrorEl = fileInput;
        }

        if (firstErrorEl) {
            e.preventDefault();
            firstErrorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });

    function markError(field) {
        field.classList.add('border-red-500', 'ring-2', 'ring-red-300');
        const errorEl = field.closest('div').querySelector('.field-error');
        if (errorEl) errorEl.classList.remove('hidden');
    }

    // Hilangkan error saat user mulai mengisi
    form.querySelectorAll('input, textarea').forEach(function(field) {
        const evtType = field.type === 'file' ? 'change' : 'input';
        field.addEventListener(evtType, function() {
            field.classList.remove('border-red-500', 'ring-2', 'ring-red-300');
            const errorEl = field.closest('div').querySelector('.field-error');
            if (errorEl) errorEl.classList.add('hidden');
        });
    });
</script>
@endpush
@endsection
