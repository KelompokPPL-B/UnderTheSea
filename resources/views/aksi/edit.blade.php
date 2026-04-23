{{--
#PBI-04
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-8 sm:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Edit Conservation Action</h1>
                    <p class="text-sm sm:text-base text-gray-600">Update the conservation action information</p>
                </div>

                <!-- Form -->
                <form action="{{ route('aksi.update', $aksi->id_aksi) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="judul_aksi" class="block text-sm font-semibold text-gray-900">
                                Title *
                            </label>
                        </div>
                        <input
                            type="text"
                            id="judul_aksi"
                            name="judul_aksi"
                            value="{{ old('judul_aksi', $aksi->judul_aksi) }}"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('judul_aksi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('judul_aksi') bg-red-50 @enderror"
                            placeholder="Enter action title"
                            required
                        >
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
                        </div>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('deskripsi') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('deskripsi') bg-red-50 @enderror"
                            placeholder="Describe the conservation action"
                        >{{ old('deskripsi', $aksi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Benefits -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="manfaat" class="block text-sm font-semibold text-gray-900">
                                Benefits
                            </label>
                        </div>
                        <textarea
                            id="manfaat"
                            name="manfaat"
                            rows="3"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('manfaat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('manfaat') bg-red-50 @enderror"
                            placeholder="What are the benefits of this action?"
                        >{{ old('manfaat', $aksi->manfaat) }}</textarea>
                        @error('manfaat')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- How to Participate -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="cara_melakukan" class="block text-sm font-semibold text-gray-900">
                                How to Participate
                            </label>
                        </div>
                        <textarea
                            id="cara_melakukan"
                            name="cara_melakukan"
                            rows="3"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('cara_melakukan') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('cara_melakukan') bg-red-50 @enderror"
                            placeholder="Explain how people can participate"
                        >{{ old('cara_melakukan', $aksi->cara_melakukan) }}</textarea>
                        @error('cara_melakukan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if($aksi->gambar)
                        <div>
                            <p class="text-sm font-semibold text-gray-900 mb-2">Current Image</p>
                            <img src="/storage/{{ $aksi->gambar }}" alt="{{ $aksi->judul_aksi }}" class="h-40 rounded-lg object-cover">
                        </div>
                    @endif

                    <!-- Image -->
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <label for="gambar" class="block text-sm font-semibold text-gray-900">
                                New Image (JPG, PNG - Max 2MB)
                            </label>
                        </div>
                        <input
                            type="file"
                            id="gambar"
                            name="gambar"
                            accept="image/jpeg,image/png,image/jpg"
                            class="w-full px-4 py-2 border-2 {{ $errors->has('gambar') ? 'border-red-500' : 'border-gray-200' }} rounded-lg focus:outline-none focus:border-blue-600 @error('gambar') bg-red-50 @enderror"
                        >
                        @error('gambar')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                        <button
                            type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium"
                        >
                            Save Changes
                        </button>
                        <a
                            href="{{ route('aksi.show', $aksi->id_aksi) }}"
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
@endsection
