{{--
#PBI-04
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <!-- Decorative Blobs -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
        
        <!-- Header -->
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-ocean-500 to-emerald-400 shadow-xl shadow-ocean-500/30 mb-5 border-4 border-white transform hover:scale-110 transition-transform duration-300">
                <span class="text-4xl text-white">🌱</span>
            </div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-emerald-600 mb-3 tracking-tight drop-shadow-sm">
                Tambah Aksi Pelestarian
            </h1>
            <p class="text-ocean-700 font-medium text-lg bg-white/60 inline-block px-6 py-2 rounded-full backdrop-blur-sm shadow-sm border border-white">
                Bagikan ide dan gerakan konservasi Anda kepada komunitas.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.15)] border border-ocean-100 p-8 md:p-12 relative overflow-hidden transition-all duration-300">
            <!-- Decorative Accent Line -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-ocean-500 via-blue-500 to-emerald-500"></div>

            <!-- Server-side errors summary -->
            @if($errors->any())
                <div class="mb-8 bg-red-50 border-2 border-red-200 rounded-2xl p-5">
                    <p class="text-red-700 font-bold text-sm mb-3">Mohon perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-600 text-sm font-semibold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form id="actionForm" method="POST" action="{{ route('aksi.store') }}" enctype="multipart/form-data" class="space-y-8 relative z-10" novalidate>
                @csrf

                <!-- Section 1: Informasi Dasar -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-ocean-950 border-b border-ocean-100 pb-3 flex items-center gap-2">
                        <span class="text-emerald-500">1.</span> Informasi Dasar
                    </h2>

                    <!-- Title / Judul Aksi -->
                    <div class="group">
                        <label for="judul_aksi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Judul Aksi *
                        </label>
                        <input
                            type="text"
                            id="judul_aksi"
                            name="judul_aksi"
                            value="{{ old('judul_aksi') }}"
                            minlength="5"
                            maxlength="200"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('judul_aksi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Masukkan judul aksi pelestarian"
                            required
                        >
                        <div class="flex justify-between mt-2 px-1">
                            @error('judul_aksi')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="judul-counter">0 / 200</span>
                        </div>
                    </div>

                    <!-- Description / Deskripsi -->
                    <div class="group">
                        <label for="deskripsi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Deskripsi Aksi
                        </label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            minlength="10"
                            maxlength="5000"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Jelaskan mengenai aksi konservasi ini secara detail..."
                        >{{ old('deskripsi') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('deskripsi')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="deskripsi-counter">0 / 5000</span>
                        </div>
                    </div>

                    <!-- Image / Gambar -->
                    <div class="group">
                        <label for="gambar" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Gambar (JPG, PNG - Max 2MB)
                        </label>
                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept="image/jpeg,image/png,image/jpg"
                            class="w-full text-sm text-ocean-600 font-medium file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-ocean-600 file:text-white hover:file:bg-ocean-700 bg-ocean-50/50 border-2 border-ocean-100 rounded-2xl transition-all duration-300 cursor-pointer hover:border-ocean-300 focus:outline-none focus:ring-4 focus:ring-ocean-500/10 @error('gambar') border-red-500 @enderror"
                        >
                        <!-- Client-side image error -->
                        <p class="text-red-500 text-xs font-semibold mt-2 ml-1 hidden" id="gambar-error"></p>
                        @error('gambar')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                        <!-- Image preview -->
                        <div id="image-preview-wrap" class="mt-4 hidden p-2 bg-ocean-50/50 rounded-2xl border-2 border-dashed border-ocean-100 inline-block">
                            <img id="image-preview" src="" alt="Preview" class="rounded-xl max-h-48 object-cover">
                            <p class="text-[10px] text-gray-500 font-bold mt-2 text-center" id="image-size-info"></p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Detail Kegiatan -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-ocean-950 border-b border-ocean-100 pb-3 flex items-center gap-2">
                        <span class="text-emerald-500">2.</span> Detail Kegiatan
                    </h2>

                    <!-- Benefits / Manfaat -->
                    <div class="group">
                        <label for="manfaat" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Manfaat
                        </label>
                        <textarea
                            id="manfaat"
                            name="manfaat"
                            rows="3"
                            minlength="10"
                            maxlength="3000"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('manfaat') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Apa saja manfaat dari aksi nyata ini?"
                        >{{ old('manfaat') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('manfaat')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="manfaat-counter">0 / 3000</span>
                        </div>
                    </div>

                    <!-- How to Participate / Cara Melakukan -->
                    <div class="group">
                        <label for="cara_melakukan" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Cara Berpartisipasi
                        </label>
                        <textarea
                            id="cara_melakukan"
                            name="cara_melakukan"
                            rows="3"
                            minlength="10"
                            maxlength="3000"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('cara_melakukan') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Jelaskan langkah-langkah bagaimana orang lain bisa bergabung..."
                        >{{ old('cara_melakukan') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('cara_melakukan')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="cara-counter">0 / 3000</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Location / Lokasi -->
                        <div class="md:col-span-2 group">
                            <label for="lokasi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Lokasi
                            </label>
                            <input
                                type="text"
                                id="lokasi"
                                name="lokasi"
                                value="{{ old('lokasi') }}"
                                maxlength="255"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('lokasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Lokasi kegiatan dilaksanakan"
                            >
                            <div class="flex justify-between mt-2 px-1">
                                @error('lokasi')
                                    <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                                @else
                                    <span></span>
                                @enderror
                                <span class="text-xs text-gray-400 font-medium ml-auto" id="lokasi-counter">0 / 255</span>
                            </div>
                        </div>

                        <!-- Event Date / Tanggal Kegiatan -->
                        <div class="group">
                            <label for="tanggal_kegiatan" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Tanggal Kegiatan
                            </label>
                            <input
                                type="date"
                                id="tanggal_kegiatan"
                                name="tanggal_kegiatan"
                                value="{{ old('tanggal_kegiatan') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('tanggal_kegiatan') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            >
                            @error('tanggal_kegiatan')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Volunteer Needed / Volunteer Dibutuhkan -->
                        <div class="group">
                            <label for="volunteer_dibutuhkan" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                                Relawan yang Dibutuhkan
                            </label>
                            <input
                                type="number"
                                id="volunteer_dibutuhkan"
                                name="volunteer_dibutuhkan"
                                value="{{ old('volunteer_dibutuhkan') }}"
                                min="1"
                                max="10000"
                                class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('volunteer_dibutuhkan') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                                placeholder="Jumlah relawan"
                            >
                            @error('volunteer_dibutuhkan')
                                <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Section 3: Informasi Konservasi -->
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-ocean-950 border-b border-ocean-100 pb-3 flex items-center gap-2">
                        <span class="text-emerald-500">3.</span> Informasi Konservasi
                    </h2>

                    <!-- Conservation Goals / Tujuan Konservasi -->
                    <div class="group">
                        <label for="tujuan_konservasi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Tujuan Konservasi
                        </label>
                        <textarea
                            id="tujuan_konservasi"
                            name="tujuan_konservasi"
                            rows="2"
                            maxlength="500"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('tujuan_konservasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Apa tujuan utama konservasi dari gerakan ini?"
                        >{{ old('tujuan_konservasi') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('tujuan_konservasi')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="tujuan-counter">0 / 500</span>
                        </div>
                    </div>

                    <!-- Environmental Issue / Isu Lingkungan -->
                    <div class="group">
                        <label for="isu_lingkungan" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Isu Lingkungan yang Dihadapi
                        </label>
                        <textarea
                            id="isu_lingkungan"
                            name="isu_lingkungan"
                            rows="2"
                            maxlength="500"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('isu_lingkungan') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Isu lingkungan laut apa yang ingin Anda selesaikan?"
                        >{{ old('isu_lingkungan') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('isu_lingkungan')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="isu-counter">0 / 500</span>
                        </div>
                    </div>

                    <!-- Action Impact / Dampak Aksi -->
                    <div class="group">
                        <label for="dampak_aksi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Dampak Aksi
                        </label>
                        <textarea
                            id="dampak_aksi"
                            name="dampak_aksi"
                            rows="3"
                            maxlength="3000"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('dampak_aksi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Dampak positif jangka panjang apa yang diharapkan dari aksi ini?"
                        >{{ old('dampak_aksi') }}</textarea>
                        <div class="flex justify-between mt-2 px-1">
                            @error('dampak_aksi')
                                <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @else
                                <span></span>
                            @enderror
                            <span class="text-xs text-gray-400 font-medium ml-auto" id="dampak-counter">0 / 3000</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-ocean-100">
                    <a href="{{ route('aksi.index') }}" class="sm:w-1/3 bg-ocean-50 hover:bg-ocean-100 text-ocean-800 font-bold py-4 px-6 rounded-2xl text-center transition-all duration-300 transform hover:-translate-y-1 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn" class="sm:w-2/3 bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-extrabold text-lg py-4 px-6 rounded-2xl shadow-xl shadow-ocean-500/30 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-500/30 transition-all duration-300 flex justify-center items-center gap-3">
                        <span>Tambah Aksi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // ===== Character counters =====
    const counters = [
        { input: 'judul_aksi',        counter: 'judul-counter',   max: 200  },
        { input: 'deskripsi',         counter: 'deskripsi-counter', max: 5000 },
        { input: 'manfaat',           counter: 'manfaat-counter', max: 3000 },
        { input: 'cara_melakukan',      counter: 'cara-counter',    max: 3000 },
        { input: 'lokasi',              counter: 'lokasi-counter',  max: 255  },
        { input: 'tujuan_konservasi',   counter: 'tujuan-counter',  max: 500  },
        { input: 'isu_lingkungan',      counter: 'isu-counter',     max: 500  },
        { input: 'dampak_aksi',         counter: 'dampak-counter',  max: 3000 },
    ];

    counters.forEach(({ input, counter, max }) => {
        const el = document.getElementById(input);
        const ct = document.getElementById(counter);
        if (!el || !ct) return;
        const update = () => {
            const len = el.value.length;
            ct.textContent = `${len} / ${max}`;
            ct.classList.toggle('text-red-500', len >= max * 0.9);
        };
        el.addEventListener('input', update);
        update();
    });

    // ===== Image client-side validation & preview =====
    document.getElementById('gambar').addEventListener('change', function () {
        const file = this.files[0];
        const errEl  = document.getElementById('gambar-error');
        const previewWrap = document.getElementById('image-preview-wrap');
        const previewImg  = document.getElementById('image-preview');
        const sizeInfo    = document.getElementById('image-size-info');

        errEl.classList.add('hidden');
        errEl.textContent = '';
        previewWrap.classList.add('hidden');

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            errEl.textContent = 'Hanya file gambar JPG, JPEG, dan PNG yang diperbolehkan.';
            errEl.classList.remove('hidden');
            this.value = '';
            return;
        }

        const maxBytes = 2 * 1024 * 1024; // 2MB
        if (file.size > maxBytes) {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            errEl.textContent = `Ukuran file adalah ${sizeMB}MB. Ukuran maksimal yang diperbolehkan adalah 2MB.`;
            errEl.classList.remove('hidden');
            this.value = '';
            return;
        }

        // Preview
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            sizeInfo.textContent = `${file.name} — ${sizeMB} MB`;
            previewWrap.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    // ===== Volunteer number validation =====
    const volInput = document.getElementById('volunteer_dibutuhkan');
    if (volInput) {
        volInput.addEventListener('input', function () {
            const val = parseInt(this.value);
            if (this.value && (val < 1 || val > 10000)) {
                this.setCustomValidity('Relawan yang dibutuhkan harus antara 1 dan 10.000.');
            } else {
                this.setCustomValidity('');
            }
        });
    }

    // ===== Submit with loading state =====
    document.getElementById('actionForm').addEventListener('submit', function (e) {
        const judul = document.getElementById("judul_aksi").value.trim();
        if (judul.length < 5) {
            e.preventDefault();
            alert("Judul Aksi minimal 5 karakter");
            return;
        }
        if (judul.length > 200) {
            e.preventDefault();
            alert("Judul Aksi maksimal 200 karakter");
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Membuat Aksi...';

        // Re-enable on error or fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Tambah Aksi';
        }, 8000);
    });
});
</script>
@endpush
@endsection