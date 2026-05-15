{{--
#PBI-16
#OWNER-Faiz
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Edit Fish Species</h1>
                <p class="text-ocean-600">Update the fish species information</p>
                <p class="text-xs text-red-500 mt-2"><span class="font-bold">*</span> Please fill out this field.</p>
            </div>

            <!-- Form -->
            <form id="edit-ikan-form" action="{{ route('ikan.update', $ikan->id_ikan) }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Fish Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama', $ikan->nama) }}"
                        class="input input-bordered w-full rounded-xl @error('nama') input-error @enderror"
                        placeholder="Enter fish species name"
                        maxlength="255"
                        required
                    >
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="nama" data-max="255">255 characters remaining</span>
                    </div>
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
                        maxlength="1000"
                        required
                    >{{ old('deskripsi', $ikan->deskripsi) }}</textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="deskripsi" data-max="1000">1000 characters remaining</span>
                    </div>
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
                        value="{{ old('habitat', $ikan->habitat) }}"
                        class="input input-bordered w-full rounded-xl @error('habitat') input-error @enderror"
                        placeholder="Enter habitat information"
                        maxlength="255"
                        required
                    >
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="habitat" data-max="255">255 characters remaining</span>
                    </div>
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
                        maxlength="1000"
                        required
                    >{{ old('karakteristik', $ikan->karakteristik) }}</textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="karakteristik" data-max="1000">1000 characters remaining</span>
                    </div>
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
                        value="{{ old('status_konservasi', $ikan->status_konservasi) }}"
                        class="input input-bordered w-full rounded-xl @error('status_konservasi') input-error @enderror"
                        placeholder="e.g., Endangered, Vulnerable, Least Concern"
                        maxlength="100"
                        required
                    >
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="status_konservasi" data-max="100">100 characters remaining</span>
                    </div>
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
                        class="textarea textarea-bordered w-full rounded-xl @error('fakta_unik') textarea-error @enderror"
                        placeholder="Share interesting facts about this species"
                        maxlength="1000"
                        required
                    >{{ old('fakta_unik', $ikan->fakta_unik) }}</textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                        <span class="text-xs text-gray-400 ml-auto char-counter" data-target="fakta_unik" data-max="1000">1000 characters remaining</span>
                    </div>
                    @error('fakta_unik')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                <div>
                    <p class="text-sm font-semibold text-ocean-900 mb-2">Current Image</p>
                    @if($ikan->gambar)
                        <img id="image-preview" src="{{ asset('storage/' . $ikan->gambar) }}" alt="{{ $ikan->nama }}" class="h-40 rounded-lg object-cover">
                    @else
                        <img id="image-preview" src="" alt="" class="h-40 rounded-lg object-cover hidden">
                        <p id="no-image-text" class="text-sm text-gray-400 italic">No image yet</p>
                    @endif
                </div>

                <!-- New Image -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        New Image (JPG, PNG — Max 2MB)
                    </label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/jpeg,image/png,image/jpg"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                    >
                    <p id="size-error" class="text-xs mt-1 hidden font-semibold" style="color: #ef4444;">Max 2MB. Please choose a smaller file.</p>
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit"
                        class="btn flex-1"
                        style="background-color: #22c55e; color: white; border: none; font-size: 15px; font-weight: 600; border-radius: 0.75rem; box-shadow: 0 2px 8px rgba(34,197,94,0.3);"
                        onmouseover="this.style.backgroundColor='#16a34a'"
                        onmouseout="this.style.backgroundColor='#22c55e'"
                    >Save Changes</button>
                    <a href="{{ route('ikan.show', $ikan->id_ikan) }}"
                        class="btn flex-1"
                        style="background-color: #ef4444; color: white; border: none; font-size: 15px; font-weight: 600; border-radius: 0.75rem; box-shadow: 0 2px 8px rgba(239,68,68,0.3);"
                        onmouseover="this.style.backgroundColor='#dc2626'"
                        onmouseout="this.style.backgroundColor='#ef4444'"
                    >Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gambarInput = document.getElementById('gambar');

        // File input handler — preview & size check
        gambarInput.addEventListener('change', function (event) {
            const file      = event.target.files[0];
            const sizeError = document.getElementById('size-error');
            const preview   = document.getElementById('image-preview');
            const noText    = document.getElementById('no-image-text');

            // Reset
            sizeError.classList.add('hidden');
            gambarInput.classList.remove('border-red-500', 'ring-2', 'ring-red-300');

            if (!file) return;

            const maxSize = 2 * 1024 * 1024; // 2 MB
            if (file.size > maxSize) {
                sizeError.classList.remove('hidden');
                gambarInput.classList.add('border-red-500', 'ring-2', 'ring-red-300');
                event.target.value = '';
                return;
            }

            // Valid — update preview
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (noText) noText.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });

        const form = document.getElementById('edit-ikan-form');

        form.addEventListener('submit', function (e) {
            let firstErrorEl = null;

            // Reset semua error sebelumnya
            form.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
            document.getElementById('size-error').classList.add('hidden');
            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-red-500', 'ring-2', 'ring-red-300');
            });

            // Validasi semua field required (bukan file)
            form.querySelectorAll('input[required]:not([type="file"]), textarea[required]').forEach(function (field) {
                if (field.value.trim() === '') {
                    markError(field);
                    if (!firstErrorEl) firstErrorEl = field;
                }
            });

            // Validasi gambar — hanya cek size jika file dipilih
            const fileInput = document.getElementById('gambar');
            if (fileInput.files.length > 0 && fileInput.files[0].size > 2 * 1024 * 1024) {
                document.getElementById('size-error').classList.remove('hidden');
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

        // Hilangkan error saat user mengetik
        form.querySelectorAll('input:not([type="file"]), textarea').forEach(function (field) {
            field.addEventListener('input', function () {
                field.classList.remove('border-red-500', 'ring-2', 'ring-red-300');
                const errorEl = field.closest('div').querySelector('.field-error');
                if (errorEl) errorEl.classList.add('hidden');
            });
        });

        // Real-time character counter
        document.querySelectorAll('.char-counter').forEach(function (counter) {
            const targetId = counter.getAttribute('data-target');
            const maxLen   = parseInt(counter.getAttribute('data-max'));
            const field    = document.getElementById(targetId);
            if (!field) return;

            function updateCounter() {
                const remaining = maxLen - field.value.length;
                counter.textContent = remaining + ' characters remaining';
                if (remaining === 0) {
                    counter.style.color = '#ef4444';       // merah — habis
                } else if (remaining <= Math.floor(maxLen * 0.1)) {
                    counter.style.color = '#f97316';       // oranye — hampir habis (≤10%)
                } else {
                    counter.style.color = '#9ca3af';       // abu-abu normal
                }
            }

            field.addEventListener('input', updateCounter);
            updateCounter(); // inisialisasi langsung dengan data yang sudah ada
        });
    });
</script>
@endsection
