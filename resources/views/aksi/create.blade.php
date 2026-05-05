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
                    <p class="text-xs text-red-500 mt-2"><span class="font-bold">*</span> Please fill out this field.</p>
                </div>

                <!-- Form -->
                <form id="create-aksi-form" method="POST" action="{{ route('aksi.store') }}" enctype="multipart/form-data" class="space-y-6" novalidate>
                    @csrf

                    <!-- Title -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="judul_aksi" class="block text-sm font-semibold text-gray-900">
                                Title <span class="text-red-500">*</span>
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
                            class="w-full px-4 py-2 border-2 {{ $errors->has('judul_aksi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600"
                            placeholder="Enter action title"
                            maxlength="255"
                            required
                        >
                        <div class="flex justify-between items-center mt-1">
                            <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                            <span class="text-xs text-gray-400 ml-auto char-counter" data-target="judul_aksi" data-max="255">255 characters remaining</span>
                        </div>
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
                            class="w-full px-4 py-2 border-2 {{ $errors->has('deskripsi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600"
                            placeholder="Describe the conservation action"
                            maxlength="2000"
                            required
                        >{{ old('deskripsi') }}</textarea>
                        <div class="flex justify-between items-center mt-1">
                            <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                            <span class="text-xs text-gray-400 ml-auto char-counter" data-target="deskripsi" data-max="2000">2000 characters remaining</span>
                        </div>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Benefits -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-900">
                                Benefits <span class="text-red-500">*</span>
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
                            class="w-full px-4 py-2 border-2 {{ $errors->has('manfaat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600"
                            placeholder="What are the benefits of this action?"
                            maxlength="2000"
                            required
                        >{{ old('manfaat') }}</textarea>
                        <div class="flex justify-between items-center mt-1">
                            <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                            <span class="text-xs text-gray-400 ml-auto char-counter" data-target="manfaat" data-max="2000">2000 characters remaining</span>
                        </div>
                        @error('manfaat')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- How to Participate -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="cara_melakukan" class="block text-sm font-semibold text-gray-900">
                                How to Participate <span class="text-red-500">*</span>
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
                            class="w-full px-4 py-2 border-2 {{ $errors->has('cara_melakukan') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600"
                            placeholder="Explain how people can participate"
                            maxlength="2000"
                            required
                        >{{ old('cara_melakukan') }}</textarea>
                        <div class="flex justify-between items-center mt-1">
                            <p class="field-error text-xs hidden" style="color: #ef4444;">This field is required.</p>
                            <span class="text-xs text-gray-400 ml-auto char-counter" data-target="cara_melakukan" data-max="2000">2000 characters remaining</span>
                        </div>
                        @error('cara_melakukan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <!-- Preview box -->
                        <div id="preview-container" class="hidden mb-3">
                            <p class="text-sm font-semibold text-gray-900 mb-2">Image Preview</p>
                            <img id="image-preview" src="" alt="Preview" class="h-40 rounded-lg object-cover">
                        </div>

                        <div class="flex items-center gap-2 mb-2">
                            <label for="gambar" class="block text-sm font-semibold text-gray-900">
                                Image (JPG, PNG - Max 2MB) <span class="text-red-500">*</span>
                            </label>
                            <span class="relative group">
                                <span class="text-gray-400 cursor-help">?</span>
                                <div class="absolute bottom-full left-0 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs px-3 py-2 rounded whitespace-nowrap z-10">
                                    Upload a JPG or PNG image (max 2MB)
                                </div>
                            </span>
                        </div>
                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept="image/jpeg,image/png,image/jpg"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('gambar') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600"
                            required
                        >
                        <p class="field-error text-xs mt-1 hidden" style="color: #ef4444;">Image is required.</p>
                        <p id="size-error" class="text-xs mt-1 hidden font-semibold" style="color: #ef4444;">Max 2MB. Please choose a smaller file.</p>
                        @error('gambar')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                        <button
                            type="submit"
                            id="submitBtn"
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium"
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gambarInput = document.getElementById('gambar');

        // File input handler — preview & size check
        gambarInput.addEventListener('change', function (event) {
            const file      = event.target.files[0];
            const sizeError = document.getElementById('size-error');
            const container = document.getElementById('preview-container');
            const preview   = document.getElementById('image-preview');

            // Reset
            sizeError.classList.add('hidden');
            container.classList.add('hidden');
            preview.src = '';
            gambarInput.classList.remove('border-red-500', 'ring-2', 'ring-red-300');

            if (!file) return;

            const maxSize = 2 * 1024 * 1024; // 2 MB
            if (file.size > maxSize) {
                sizeError.classList.remove('hidden');
                gambarInput.classList.add('border-red-500', 'ring-2', 'ring-red-300');
                event.target.value = '';
                return;
            }

            // Valid — show preview
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        const form = document.getElementById('create-aksi-form');

        form.addEventListener('submit', function (e) {
            let firstErrorEl = null;

            // Reset semua error sebelumnya
            form.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
            document.getElementById('size-error').classList.add('hidden');
            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-red-500', 'ring-2', 'ring-red-300');
            });

            // Validasi field required (hanya judul_aksi)
            form.querySelectorAll('input[required]:not([type="file"]), textarea[required]').forEach(function (field) {
                if (field.value.trim() === '') {
                    markError(field);
                    if (!firstErrorEl) firstErrorEl = field;
                }
            });

            // Validasi file input gambar
            const fileInput = document.getElementById('gambar');
            const sizeErr   = document.getElementById('size-error');
            if (fileInput.files.length === 0) {
                markError(fileInput);
                if (!firstErrorEl) firstErrorEl = fileInput;
            } else if (fileInput.files[0].size > 2 * 1024 * 1024) {
                sizeErr.classList.remove('hidden');
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
                    counter.style.color = '#ef4444';
                } else if (remaining <= Math.floor(maxLen * 0.1)) {
                    counter.style.color = '#f97316';
                } else {
                    counter.style.color = '#9ca3af';
                }
            }

            field.addEventListener('input', updateCounter);
            updateCounter();
        });
    });
</script>
@endsection
