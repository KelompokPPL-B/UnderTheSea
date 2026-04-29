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
                <p class="text-ocean-600">Update the marine ecosystem information</p>
            </div>

            <!-- Form -->
            <form action="{{ route('ekosistem.update', $ekosistem->id_ekosistem) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                    <ul class="text-sm list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Name -->
                <div>
                    <label for="nama_ekosistem" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Ecosystem Name *
                    </label>
                    <input
                        type="text"
                        id="nama_ekosistem"
                        name="nama_ekosistem"
                        value="{{ old('nama_ekosistem', $ekosistem->nama_ekosistem) }}"
                        class="input input-bordered w-full @error('nama_ekosistem') input-error @enderror"
                        placeholder="Enter ecosystem name"
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
                        placeholder="Enter geographic location"
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
                        placeholder="Describe the ecosystem's role in marine life"
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
                        placeholder="Describe threats to this ecosystem"
                    >{{ old('ancaman', $ekosistem->ancaman) }}</textarea>
                    @error('ancaman')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($ekosistem->gambar)
                    <div>
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
