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

            <!-- Server-side errors summary -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                    <p class="text-red-700 font-semibold text-sm mb-2">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-600 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form id="actionForm" method="POST" action="{{ route('aksi.store') }}" enctype="multipart/form-data" class="space-y-6" novalidate>
                @csrf

                <!-- Title -->
                <div>
                    <label for="judul_aksi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Title
                    </label>
                    <input
                        type="text"
                        id="judul_aksi"
                        name="judul_aksi"
                        value="{{ old('judul_aksi') }}"
                        maxlength="200"
                        class="input input-bordered w-full @error('judul_aksi') input-error @enderror"
                        placeholder="Title"
                        required
                    >
                    <div class="flex justify-between mt-1">
                        @error('judul_aksi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="judul-counter">0 / 200</span>
                    </div>
                </div>

                <!-- Description (max 5000 chars) -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Description
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        maxlength="5000"
                        class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror"
                        placeholder="Description"
                    >{{ old('deskripsi') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('deskripsi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="deskripsi-counter">0 / 5000</span>
                    </div>
                </div>

                <!-- Benefits (max 3000 chars) -->
                <div>
                    <label for="manfaat" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Benefits
                    </label>
                    <textarea
                        id="manfaat"
                        name="manfaat"
                        rows="3"
                        maxlength="3000"
                        class="textarea textarea-bordered w-full @error('manfaat') textarea-error @enderror"
                        placeholder="Benefits"
                    >{{ old('manfaat') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('manfaat')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="manfaat-counter">0 / 3000</span>
                    </div>
                </div>

                <!-- How to Participate (max 3000 chars) -->
                <div>
                    <label for="cara_melakukan" class="block text-sm font-semibold text-ocean-900 mb-2">
                        How to Participate
                    </label>
                    <textarea
                        id="cara_melakukan"
                        name="cara_melakukan"
                        rows="3"
                        maxlength="3000"
                        class="textarea textarea-bordered w-full @error('cara_melakukan') textarea-error @enderror"
                        placeholder="How to Participate"
                    >{{ old('cara_melakukan') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('cara_melakukan')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="cara-counter">0 / 3000</span>
                    </div>
                </div>

                {{-- ===== SECTION: Event Details ===== --}}
                <div class="border-b border-ocean-100 pb-2 mb-2 pt-4">
                    <h2 class="text-sm font-bold text-ocean-500 uppercase tracking-widest">Event Details</h2>
                </div>

                <!-- Location (max 255 chars) -->
                <div>
                    <label for="lokasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Location
                    </label>
                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        value="{{ old('lokasi') }}"
                        maxlength="255"
                        class="input input-bordered w-full @error('lokasi') input-error @enderror"
                        placeholder="Location"
                    >
                    <div class="flex justify-between mt-1">
                        @error('lokasi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="lokasi-counter">0 / 255</span>
                    </div>
                </div>

                <!-- Event Date -->
                <div>
                    <label for="tanggal_kegiatan" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Event Date
                    </label>
                    <input
                        type="date"
                        id="tanggal_kegiatan"
                        name="tanggal_kegiatan"
                        value="{{ old('tanggal_kegiatan') }}"
                        min="{{ date('Y-m-d') }}"
                        class="input input-bordered w-full @error('tanggal_kegiatan') input-error @enderror"
                    >
                    @error('tanggal_kegiatan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Volunteer Needed (1 - 10000) -->
                <div>
                    <label for="volunteer_dibutuhkan" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Volunteer Needed
                    </label>
                    <input
                        type="number"
                        id="volunteer_dibutuhkan"
                        name="volunteer_dibutuhkan"
                        value="{{ old('volunteer_dibutuhkan') }}"
                        min="1"
                        max="10000"
                        class="input input-bordered w-full @error('volunteer_dibutuhkan') input-error @enderror"
                        placeholder="Volunteer Needed"
                    >
                    @error('volunteer_dibutuhkan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ===== SECTION: Conservation Details ===== --}}
                <div class="border-b border-ocean-100 pb-2 mb-2 pt-4">
                    <h2 class="text-sm font-bold text-ocean-500 uppercase tracking-widest">Conservation Details</h2>
                </div>

                <!-- Conservation Goals (max 500 chars) -->
                <div>
                    <label for="tujuan_konservasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Conservation Goals
                    </label>
                    <textarea
                        id="tujuan_konservasi"
                        name="tujuan_konservasi"
                        rows="2"
                        maxlength="500"
                        class="textarea textarea-bordered w-full @error('tujuan_konservasi') textarea-error @enderror"
                        placeholder="Conservation Goals"
                    >{{ old('tujuan_konservasi') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('tujuan_konservasi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="tujuan-counter">0 / 500</span>
                    </div>
                </div>

                <!-- Environmental Issue (max 500 chars) -->
                <div>
                    <label for="isu_lingkungan" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Environmental Issue
                    </label>
                    <textarea
                        id="isu_lingkungan"
                        name="isu_lingkungan"
                        rows="2"
                        maxlength="500"
                        class="textarea textarea-bordered w-full @error('isu_lingkungan') textarea-error @enderror"
                        placeholder="Environmental Issue"
                    >{{ old('isu_lingkungan') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('isu_lingkungan')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="isu-counter">0 / 500</span>
                    </div>
                </div>

                <!-- Action Impact (max 3000 chars) -->
                <div>
                    <label for="dampak_aksi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Action Impact
                    </label>
                    <textarea
                        id="dampak_aksi"
                        name="dampak_aksi"
                        rows="3"
                        maxlength="3000"
                        class="textarea textarea-bordered w-full @error('dampak_aksi') textarea-error @enderror"
                        placeholder="Action Impact"
                    >{{ old('dampak_aksi') }}</textarea>
                    <div class="flex justify-between mt-1">
                        @error('dampak_aksi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @else
                            <span></span>
                        @enderror
                        <span class="text-xs text-gray-400 ml-auto" id="dampak-counter">0 / 3000</span>
                    </div>
                </div>

                {{-- ===== SECTION: Image ===== --}}

                <!-- Image Upload -->
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
                    <!-- Client-side image error -->
                    <p class="text-red-600 text-sm mt-1 hidden" id="gambar-error"></p>
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <!-- Image preview -->
                    <div id="image-preview-wrap" class="mt-3 hidden">
                        <img id="image-preview" src="" alt="Preview" class="rounded-xl max-h-48 object-cover border border-ocean-100">
                        <p class="text-xs text-gray-400 mt-1" id="image-size-info"></p>
                    </div>
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
// ===== Character counters =====
const counters = [
    { input: 'judul_aksi',          counter: 'judul-counter',   max: 200  },
    { input: 'deskripsi',           counter: 'deskripsi-counter', max: 5000 },
    { input: 'manfaat',             counter: 'manfaat-counter', max: 3000 },
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
        errEl.textContent = 'Only JPG and PNG images are allowed.';
        errEl.classList.remove('hidden');
        this.value = '';
        return;
    }

    const maxBytes = 2 * 1024 * 1024; // 2MB
    if (file.size > maxBytes) {
        const sizeMB = (file.size / 1024 / 1024).toFixed(2);
        errEl.textContent = `File size is ${sizeMB}MB. Maximum allowed is 2MB.`;
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
document.getElementById('volunteer_dibutuhkan').addEventListener('input', function () {
    const val = parseInt(this.value);
    if (this.value && (val < 1 || val > 10000)) {
        this.setCustomValidity('Volunteer Needed must be between 1 and 10,000.');
    } else {
        this.setCustomValidity('');
    }
});

// ===== Submit with loading state =====
document.getElementById('actionForm').addEventListener('submit', function (e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating...';

    // Re-enable on error (form will reload page on server validation fail)
    setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Create Action';
    }, 8000);
});
</script>
@endpush
@endsection