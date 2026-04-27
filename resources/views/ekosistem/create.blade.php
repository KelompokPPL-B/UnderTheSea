{{--
#PBI-17
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white rounded-2xl shadow-card p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-ocean-900 mb-2">Add Marine Ecosystem</h1>
                    <p class="text-ocean-600">Create a new marine ecosystem entry in the database</p>
                </div>

                <!-- Form -->
                <form action="{{ route('ekosistem.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="nama_ekosistem" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Ecosystem Name *
                        </label>
                        <input
                        type="text"
                        id="nama_ekosistem"
                        name="nama_ekosistem"
                        value="{{ old('nama_ekosistem') }}"
                        class="input input-bordered w-full rounded-x1 @error('nama_ekosistem') input-error @enderror"
                        placeholder="Enter ecosystem name" required>
                        @error('nama_ekosistem')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Description
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="textarea textarea-bordered w-full rounded-x1 @error('deskripsi') textarea-error @enderror"
                            placeholder="Describe the ecosystem">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="lokasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Location
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="input input-bordered w-full @error('lokasi') input-error @enderror"
                            placeholder="Enter geographic location">
                        @error('lokasi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role in Marine Life -->
                    <div>
                        <label for="peran" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Role in Marine Life
                        </label>
                        <textarea id="peran" name="peran" rows="3"
                            class="textarea textarea-bordered w-full @error('peran') textarea-error @enderror"
                            placeholder="Describe the ecosystem's role in marine life">{{ old('peran') }}</textarea>
                        @error('peran')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Threats -->
                    <div>
                        <label for="ancaman" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Threats
                        </label>
                        <textarea id="ancaman" name="ancaman" rows="3"
                            class="textarea textarea-bordered w-full @error('ancaman') textarea-error @enderror"
                            placeholder="Describe threats to this ecosystem">{{ old('ancaman') }}</textarea>
                        @error('ancaman')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                            Image (JPG, PNG - Max 2MB)
                        </label>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/jpg"
                            class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror">
                        @error('gambar')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-6 border-t border-ocean-100">
                        <button type="submit" class="btn btn-primary flex-1">Create Ecosystem</button>
                        <a href="{{ route('ekosistem.index') }}" class="btn btn-outline flex-1">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection