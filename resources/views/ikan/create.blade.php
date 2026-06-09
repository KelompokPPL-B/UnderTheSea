{{--
#PBI-15
#OWNER-Faiz
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <!-- Decorative Blobs -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-ocean-500 to-emerald-400 shadow-xl shadow-ocean-500/30 mb-5 border-4 border-white transform hover:scale-110 transition-transform duration-300">
                <span class="text-4xl text-white">🐠</span>
            </div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-emerald-600 mb-3 tracking-tight drop-shadow-sm">
                Tambah Spesies Ikan
            </h1>
            <p class="text-ocean-700 font-medium text-lg bg-white/60 inline-block px-6 py-2 rounded-full backdrop-blur-sm shadow-sm border border-white">
                Perkaya basis data kelautan kita dengan spesies ikan baru.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.15)] border border-ocean-100 p-8 md:p-12 relative overflow-hidden transition-all duration-300">
            <!-- Decorative Accent Line -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-ocean-500 via-blue-500 to-emerald-500"></div>

            <!-- Form -->
            <form action="{{ route('ikan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10" novalidate id="create-ikan-form">
                @csrf
                
                <!-- Section 1: Informasi Dasar -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-ocean-950 border-b border-ocean-100 pb-3 flex items-center gap-2">
                        <span class="text-emerald-500">1.</span> Informasi Dasar
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Ikan -->
                        <div class="group">
                            <label for="nama" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Nama Ikan <span class="text-emerald-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('nama') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Masukkan nama spesies ikan"
                                maxlength="100"
                                required>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="nama" data-max="100">100 karakter tersisa</span>
                            </div>
                            @error('nama')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Habitat -->
                        <div class="group">
                            <label for="habitat" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Habitat <span class="text-emerald-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="habitat"
                                name="habitat"
                                value="{{ old('habitat') }}"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('habitat') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Masukkan informasi habitat"
                                maxlength="255"
                                required>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="habitat" data-max="255">255 karakter tersisa</span>
                            </div>
                            @error('habitat')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="group md:col-span-2">
                            <!-- Preview box (muncul setelah pilih foto) -->
                            <div id="preview-container" class="hidden mb-3">
                                <p class="text-sm font-semibold text-ocean-900 mb-2">Pratinjau Gambar</p>
                                <img id="image-preview" src="" alt="Preview" class="h-40 rounded-lg object-cover">
                            </div>

                            <label for="gambar" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Gambar (JPG, PNG - Maks 2MB) <span class="text-emerald-500">*</span>
                            </label>
                            <input
                                type="file"
                                id="gambar"
                                name="gambar"
                                accept="image/jpeg,image/png,image/jpg"
                                class="w-full text-sm text-ocean-600 font-medium file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-ocean-600 file:text-white hover:file:bg-ocean-700 bg-ocean-50/50 border-2 border-ocean-100 rounded-2xl transition-all duration-300 cursor-pointer hover:border-ocean-300 focus:outline-none focus:ring-4 focus:ring-ocean-500/10 @error('gambar') border-red-500 @enderror"
                                required>
                            <p class="field-error text-xs mt-1 hidden ml-1" style="color: #ef4444;">Gambar wajib diunggah.</p>
                            <p id="size-error" class="text-xs mt-1 hidden ml-1 font-semibold" style="color: #ef4444;">Maksimal 2MB. Silakan pilih file yang lebih kecil.</p>
                            @error('gambar')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Spesies -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-ocean-950 border-b border-ocean-100 pb-3 flex items-center gap-2">
                        <span class="text-emerald-500">2.</span> Detail Spesies
                    </h2>

                    <div class="space-y-6">
                        <!-- Deskripsi -->
                        <div class="group">
                            <label for="deskripsi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Deskripsi <span class="text-emerald-500">*</span>
                            </label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Deskripsikan spesies ikan"
                                maxlength="1000"
                                required>{{ old('deskripsi') }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="deskripsi" data-max="1000">1000 karakter tersisa</span>
                            </div>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Karakteristik -->
                        <div class="group">
                            <label for="karakteristik" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Karakteristik <span class="text-emerald-500">*</span>
                            </label>
                            <textarea
                                id="karakteristik"
                                name="karakteristik"
                                rows="3"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('karakteristik') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Deskripsikan karakteristik fisik"
                                maxlength="1000"
                                required>{{ old('karakteristik') }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="karakteristik" data-max="1000">1000 karakter tersisa</span>
                            </div>
                            @error('karakteristik')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Conservation Status -->
                        <div class="group">
                            <label for="status_konservasi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Status Konservasi <span class="text-emerald-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="status_konservasi"
                                name="status_konservasi"
                                value="{{ old('status_konservasi') }}"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('status_konservasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Contoh: Terancam Punah, Rentan, Kurang Diperhatikan"
                                maxlength="100"
                                required>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="status_konservasi" data-max="100">100 karakter tersisa</span>
                            </div>
                            @error('status_konservasi')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unique Facts -->
                        <div class="group">
                            <label for="fakta_unik" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Fakta Unik <span class="text-emerald-500">*</span>
                            </label>
                            <textarea
                                id="fakta_unik"
                                name="fakta_unik"
                                rows="3"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('fakta_unik') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Bagikan fakta menarik tentang spesies ini"
                                maxlength="1000"
                                required>{{ old('fakta_unik') }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                <p class="field-error text-xs hidden mt-1 ml-1" style="color: #ef4444;">Kolom ini wajib diisi.</p>
                                <span class="text-xs text-gray-400 ml-auto char-counter" data-target="fakta_unik" data-max="1000">1000 karakter tersisa</span>
                            </div>
                            @error('fakta_unik')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-ocean-100">
                    <a href="{{ route('ikan.index') }}" class="sm:w-1/3 bg-ocean-50 hover:bg-ocean-100 text-ocean-800 font-bold py-4 px-6 rounded-2xl text-center transition-all duration-300 transform hover:-translate-y-1 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="sm:w-2/3 bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-extrabold text-lg py-4 px-6 rounded-2xl shadow-xl shadow-ocean-500/30 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-500/30 transition-all duration-300 flex justify-center items-center gap-3">
                        <span>Tambah Ikan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gambarInput = document.getElementById('gambar');

        gambarInput.addEventListener('change', function (event) {
            const file      = event.target.files[0];
            const sizeError = document.getElementById('size-error');
            const container = document.getElementById('preview-container');
            const preview   = document.getElementById('image-preview');

            sizeError.classList.add('hidden');
            container.classList.add('hidden');
            preview.src = '';
            gambarInput.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10');
            const fieldErr = gambarInput.closest('div').querySelector('.field-error');
            if (fieldErr) fieldErr.classList.add('hidden');

            if (!file) return;

            const maxSize = 2 * 1024 * 1024; // 2 MB
            if (file.size > maxSize) {
                sizeError.classList.remove('hidden');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        const form = document.getElementById('create-ikan-form');

        form.addEventListener('submit', function (e) {
            let firstErrorEl = null;

            form.querySelectorAll('.field-error').forEach(el => el.classList.add('hidden'));
            document.getElementById('size-error').classList.add('hidden');
            form.querySelectorAll('input, textarea').forEach(el => {
                el.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10', 'bg-red-50');
            });

            form.querySelectorAll('input[required]:not([type="file"]), textarea[required]').forEach(function (field) {
                if (field.value.trim() === '') {
                    markError(field);
                    if (!firstErrorEl) firstErrorEl = field;
                }
            });

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
            field.classList.add('border-red-500', 'ring-4', 'ring-red-500/10', 'bg-red-50');
            const errorEl = field.closest('div').querySelector('.field-error');
            if (errorEl) errorEl.classList.remove('hidden');
        }

        form.querySelectorAll('input:not([type="file"]), textarea').forEach(function (field) {
            field.addEventListener('input', function () {
                field.classList.remove('border-red-500', 'ring-4', 'ring-red-500/10', 'bg-red-50');
                const errorEl = field.closest('div').querySelector('.field-error');
                if (errorEl) errorEl.classList.add('hidden');
            });
        });

        document.querySelectorAll('.char-counter').forEach(function (counter) {
            const targetId = counter.getAttribute('data-target');
            const maxLen   = parseInt(counter.getAttribute('data-max'));
            const field    = document.getElementById(targetId);
            if (!field) return;

            function updateCounter() {
                const remaining = maxLen - field.value.length;
                counter.textContent = remaining + ' karakter tersisa';
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
