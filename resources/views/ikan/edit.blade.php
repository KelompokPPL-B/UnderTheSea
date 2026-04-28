@extends('layouts.app')

@section('content')
<div class="py-8 sm:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Edit Fish</h1>
                </div>

                <form method="POST" action="{{ route('ikan.update', $ikan->id_ikan) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Fish Name *</label>
                        <input type="text" name="name" value="{{ old('name', $ikan->name) }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-lg">
                        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Scientific Name</label>
                        <input type="text" name="scientific_name" value="{{ old('scientific_name', $ikan->scientific_name) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Habitat *</label>
                        <input type="text" name="habitat" value="{{ old('habitat', $ikan->habitat) }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('habitat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Description *</label>
                        <textarea name="description" rows="4" required class="w-full px-4 py-2 border-2 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-200' }} rounded-lg">{{ old('description', $ikan->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Diet</label>
                        <input type="text" name="diet" value="{{ old('diet', $ikan->diet) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Size</label>
                        <input type="text" name="size" value="{{ old('size', $ikan->size) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Conservation Status</label>
                        <input type="text" name="conservation_status" value="{{ old('conservation_status', $ikan->conservation_status) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Image</label>
                        @if($ikan->image)
                            <img src="{{ asset('storage/' . $ikan->image) }}" alt="{{ $ikan->name }}" class="w-48 h-32 object-cover mb-3">
                        @endif
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">Upload to replace existing image (JPG, PNG, Max 2MB)</p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-medium">Update Fish</button>
                        <a href="{{ route('ikan.index') }}" class="flex-1 text-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
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
                        class="input input-bordered w-full @error('nama') input-error @enderror"
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
                        class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror"
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
                        class="input input-bordered w-full @error('habitat') input-error @enderror"
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
                        class="textarea textarea-bordered w-full @error('karakteristik') textarea-error @enderror"
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
                        class="input input-bordered w-full @error('status_konservasi') input-error @enderror"
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
                        class="textarea textarea-bordered w-full @error('fakta_unik') textarea-error @enderror"
                        placeholder="Share interesting facts about this species"
                    >{{ old('fakta_unik', $ikan->fakta_unik) }}</textarea>
                    @error('fakta_unik')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($ikan->gambar)
                    <div>
                        <p class="text-sm font-semibold text-ocean-900 mb-2">Current Image</p>
                        <img src="/storage/{{ $ikan->gambar }}" alt="{{ $ikan->nama }}" class="h-40 rounded-lg object-cover">
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
                    <a href="{{ route('ikan.show', $ikan->id_ikan) }}" class="btn btn-outline flex-1">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
