{{--
#PBI-17
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Add Marine Ecosystem</h1>
                <p class="text-ocean-600">Create a new marine ecosystem entry in the database</p>
            </div>

            <form action="{{ route('ekosistem.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="nama_ekosistem" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Ecosystem Name *
                    </label>
                    <input
                        type="text"
                        id="nama_ekosistem"
                        name="nama_ekosistem"
                        minlength="5"
                        maxlength="50"
                        value="{{ old('nama_ekosistem') }}"
                        class="input input-bordered w-full rounded-xl @error('nama_ekosistem') input-error @enderror"
                        placeholder="Enter ecosystem name"
                        required
                    >
                    @error('nama_ekosistem')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Description
                    </label>
                    <textarea 
                        id="deskripsi" 
                        name="deskripsi" 
                        rows="4" 
                        minlength="10" 
                        maxlength="255"
                        class="textarea textarea-bordered w-full rounded-xl @error('deskripsi') textarea-error @enderror"
                        placeholder="Describe the ecosystem"
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Location
                    </label>
                    <input 
                        type="text" 
                        id="lokasi" 
                        name="lokasi" 
                        value="{{ old('lokasi') }}" 
                        minlength="5" 
                        maxlength="50"
                        class="input input-bordered w-full rounded-2xl @error('lokasi') input-error @enderror"
                        placeholder="Enter geographic location"
                    >
                    @error('lokasi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="peran" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Role in Marine Life
                    </label>
                    <textarea 
                        id="peran" 
                        name="peran" 
                        rows="3" 
                        minlength="5" 
                        maxlength="50"
                        class="textarea textarea-bordered w-full rounded-xl @error('peran') textarea-error @enderror"
                        placeholder="Describe the ecosystem's role in marine life"
                    >{{ old('peran') }}</textarea>
                    @error('peran')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="ancaman" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Threats
                    </label>
                    <textarea 
                        id="ancaman" 
                        name="ancaman" 
                        rows="3" 
                        minlength="10" 
                        maxlength="100"
                        class="textarea textarea-bordered w-full rounded-xl @error('ancaman') textarea-error @enderror"
                        placeholder="Describe threats to this ecosystem"
                    >{{ old('ancaman') }}</textarea>
                    @error('ancaman')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-ocean-100 pt-6">
                    <p class="text-sm font-bold text-ocean-700 mb-4 uppercase tracking-wide">Conservation Information</p>

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
                        >{{ old('cara_menjaga') }}</textarea>
                        @error('cara_menjaga')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                        >{{ old('larangan') }}</textarea>
                        @error('larangan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                        >{{ old('dampak_kerusakan') }}</textarea>
                        @error('dampak_kerusakan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="border-t border-ocean-100 pt-6">
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Image (JPG, PNG - Max 2MB)
                    </label>
                    <input 
                        type="file" 
                        id="gambar" 
                        name="gambar" 
                        accept="image/jpeg,image/png,image/jpg"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                        style="border-radius: 17px; border: 1px solid #b8e3ffff;"
                    >
                    @error('gambar')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit"
                        class="btn btn-primary flex-1"
                        style="border-radius: 20px; border: 1px solid rgba(187, 187, 228, 0.5);">Create Ecosystem</button>
                    <a href="{{ route('ekosistem.index') }}" class="btn btn-outline flex-1" style="border-radius: 20px; border: 1px solid rgba(166, 166, 237, 0.5);">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(e) {
        const nama = document.getElementById("nama_ekosistem").value.trim();
        const deskripsi = document.getElementById("deskripsi").value.trim();
        const lokasi = document.getElementById("lokasi").value.trim();
        const peran = document.getElementById("peran").value.trim();
        const ancaman = document.getElementById("ancaman").value.trim();

        if (nama.length < 5) { 
            e.preventDefault();
            alert("Ecosystem Name must be more than 5 characters"); 
            return;
        }
        if (nama.length > 50) {
            e.preventDefault();
            alert("Ecosystem Name must be less than 50 characters");
            return;
        }

        const file = document.getElementById("gambar").files[0];
        if (file && file.size > 2 * 1024 * 1024) {
            e.preventDefault();
            alert("Image size must be less than 2MB");
            return;
        }

        if (deskripsi.length < 10) {
            e.preventDefault();
            alert("Description must be more than 10 characters");
            return;
        }
        if (deskripsi.length > 255) {
            e.preventDefault();
            alert("Description must be less than 255 characters");
            return;
        }

        if (lokasi.length < 5) {
            e.preventDefault();
            alert("Location must be more than 5 characters");
            return;
        }
        if (lokasi.length > 50) {
            e.preventDefault();
            alert("Location must be less than 50 characters");
            return;
        }

        if (peran.length < 5) {
            e.preventDefault();
            alert("Role must be more than 5 characters");
            return;
        }
        if (peran.length > 50) {
            e.preventDefault();
            alert("Role must be less than 50 characters");
            return;
        }

        if (ancaman.length < 10) {
            e.preventDefault();
            alert("Threats must be more than 10 characters");
            return;
        }
        if (ancaman.length > 100) {
            e.preventDefault();
            alert("Threats must be less than 100 characters");
            return;
        }
    });
});
</script>
@endsection