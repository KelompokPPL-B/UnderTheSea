{{--
#PBI-04
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Edit Conservation Action</h1>
                <p class="text-ocean-600">Update the conservation action information</p>
            </div>

            <!-- Form -->
            <form action="{{ route('aksi.update', $aksi->id_aksi) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="judul_aksi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Title *
                    </label>
                    <input
                        type="text"
                        id="judul_aksi"
                        name="judul_aksi"
                        value="{{ old('judul_aksi', $aksi->judul_aksi) }}"
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
                    >{{ old('deskripsi', $aksi->deskripsi) }}</textarea>
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
                    >{{ old('manfaat', $aksi->manfaat) }}</textarea>
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
                    >{{ old('cara_melakukan', $aksi->cara_melakukan) }}</textarea>
                    @error('cara_melakukan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($aksi->gambar)
                    <div>
                        <p class="text-sm font-semibold text-ocean-900 mb-2">Current Image</p>
                        <img src="/storage/{{ $aksi->gambar }}" alt="{{ $aksi->judul_aksi }}" class="h-40 rounded-lg object-cover">
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
                    <a href="{{ route('aksi.show', $aksi->id_aksi) }}" class="btn btn-outline flex-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
