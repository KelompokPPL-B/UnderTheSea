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
            </div>

            <!-- Form -->
            <form action="{{ route('ikan.update', $ikan->id_ikan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="nama" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Fish Name *
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama', $ikan->nama) }}"
                        class="input input-bordered w-full rounded-xl @error('nama') input-error @enderror"
                        placeholder="Enter fish species name"
                        required
                    >
                    @error('nama')
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
                        class="textarea textarea-bordered w-full rounded-xl @error('deskripsi') textarea-error @enderror"
                        placeholder="Describe the fish species"
                    >{{ old('deskripsi', $ikan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Habitat -->
                <div>
                    <label for="habitat" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Habitat
                    </label>
                    <input
                        type="text"
                        id="habitat"
                        name="habitat"
                        value="{{ old('habitat', $ikan->habitat) }}"
                        class="input input-bordered w-full rounded-xl @error('habitat') input-error @enderror"
                        placeholder="Enter habitat information"
                    >
                    @error('habitat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label for="karakteristik" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Characteristics
                    </label>
                    <textarea
                        id="karakteristik"
                        name="karakteristik"
                        rows="3"
                        class="textarea textarea-bordered w-full rounded-xl @error('karakteristik') textarea-error @enderror"
                        placeholder="Describe physical characteristics"
                    >{{ old('karakteristik', $ikan->karakteristik) }}</textarea>
                    @error('karakteristik')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Conservation Status -->
                <div>
                    <label for="status_konservasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Conservation Status
                    </label>
                    <input
                        type="text"
                        id="status_konservasi"
                        name="status_konservasi"
                        value="{{ old('status_konservasi', $ikan->status_konservasi) }}"
                        class="input input-bordered w-full rounded-xl @error('status_konservasi') input-error @enderror"
                        placeholder="e.g., Endangered, Vulnerable, Least Concern"
                    >
                    @error('status_konservasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unique Facts -->
                <div>
                    <label for="fakta_unik" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Unique Facts
                    </label>
                    <textarea
                        id="fakta_unik"
                        name="fakta_unik"
                        rows="3"
                        class="textarea textarea-bordered w-full rounded-xl @error('fakta_unik') textarea-error @enderror"
                        placeholder="Share interesting facts about this species"
                    >{{ old('fakta_unik', $ikan->fakta_unik) }}</textarea>
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
                        <p id="no-image-text" class="text-sm text-gray-400 italic">Belum ada gambar</p>
                    @endif
                </div>

                <!-- Image -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        New Image (JPG, PNG - Max 2MB)
                    </label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/jpeg,image/png,image/jpg"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                        onchange="previewImage(event)"
                    >
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <script>
                    function previewImage(event) {
                        const file = event.target.files[0];
                        if (!file) return;
                        const preview = document.getElementById('image-preview');
                        const noText = document.getElementById('no-image-text');
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            if (noText) noText.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                </script>

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
@endsection
