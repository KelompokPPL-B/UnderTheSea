{{--
#PBI-18
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Edit Marine Ecosystem</h1>
            </div>

            <!-- Form -->
            <form action="{{ route('ekosistem.update', $ekosistem->id_ekosistem) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="nama_ekosistem" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Ecosystem Name
                    </label>
                    <input
                        type="text"
                        id="nama_ekosistem"
                        name="nama_ekosistem"
                        value="{{ old('nama_ekosistem', $ekosistem->nama_ekosistem) }}"
                        class="input input-bordered w-full @error('nama_ekosistem') input-error @enderror"
                        placeholder="Ecosystem name"
                        required
                    >
                    @error('nama_ekosistem')
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
                        placeholder="Describe the ecosystem"
                    >{{ old('deskripsi', $ekosistem->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="lokasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Location
                    </label>
                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        value="{{ old('lokasi', $ekosistem->lokasi) }}"
                        class="input input-bordered w-full @error('lokasi') input-error @enderror"
                        placeholder="Geographic location"
                    >
                    @error('lokasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role in Marine Life -->
                <div>
                    <label for="peran" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Role in Marine Life
                    </label>
                    <textarea
                        id="peran"
                        name="peran"
                        rows="3"
                        class="textarea textarea-bordered w-full @error('peran') textarea-error @enderror"
                        placeholder="Role in marine life"
                    >{{ old('peran', $ekosistem->peran) }}</textarea>
                    @error('peran')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Threats -->
                <div>
                    <label for="ancaman" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Threats
                    </label>
                    <textarea
                        id="ancaman"
                        name="ancaman"
                        rows="3"
                        class="textarea textarea-bordered w-full @error('ancaman') textarea-error @enderror"
                        placeholder="Threats to this ecosystem"
                    >{{ old('ancaman', $ekosistem->ancaman) }}</textarea>
                    @error('ancaman')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Conservation Information -->
                <div class="border-t border-ocean-100 pt-6">
                    <p class="text-sm font-bold text-ocean-700 mb-4 uppercase tracking-wide">Conservation Information</p>

                    <!-- Protection Tips -->
                    <div class="mb-6">
                        <label for="cara_menjaga" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Protection Tips
                        </label>
                        <textarea
                            id="cara_menjaga"
                            name="cara_menjaga"
                            rows="4"
                            class="textarea textarea-bordered w-full @error('cara_menjaga') textarea-error @enderror"
                            placeholder="How to protect this ecosystem"
                        >{{ old('cara_menjaga', $ekosistem->cara_menjaga) }}</textarea>
                        @error('cara_menjaga')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Warnings -->
                    <div class="mb-6">
                        <label for="larangan" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Warnings
                        </label>
                        <textarea
                            id="larangan"
                            name="larangan"
                            rows="4"
                            class="textarea textarea-bordered w-full @error('larangan') textarea-error @enderror"
                            placeholder="Activities that can damage this ecosystem"
                        >{{ old('larangan', $ekosistem->larangan) }}</textarea>
                        @error('larangan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Impact -->
                    <div>
                        <label for="dampak_kerusakan" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Impact
                        </label>
                        <textarea
                            id="dampak_kerusakan"
                            name="dampak_kerusakan"
                            rows="4"
                            class="textarea textarea-bordered w-full @error('dampak_kerusakan') textarea-error @enderror"
                            placeholder="Consequences if this ecosystem is not protected"
                        >{{ old('dampak_kerusakan', $ekosistem->dampak_kerusakan) }}</textarea>
                        @error('dampak_kerusakan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Image -->
                @if($ekosistem->gambar)
                    <div class="border-t border-ocean-100 pt-6">
                        <p class="text-sm font-semibold text-ocean-900 mb-2">Current Image</p>
                        <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="h-40 rounded-lg object-cover">
                    </div>
                @endif

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
                    >
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit" class="btn btn-primary flex-1">Save Changes</button>
                    <a href="{{ route('ekosistem.show', $ekosistem->id_ekosistem) }}" class="btn btn-outline flex-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection