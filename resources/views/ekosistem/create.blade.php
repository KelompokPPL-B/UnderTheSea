{{--
#PBI-17
#OWNER-Arvia
--}}
@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-ocean-50 via-white to-sand min-h-screen relative overflow-hidden">
    
    <!-- Blobs -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="max-w-3xl mx-auto px-6 relative z-10">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-ocean-500 to-emerald-400 shadow-xl shadow-ocean-500/30 mb-5 border-4 border-white transform hover:scale-110 transition-transform duration-300">
                <span class="text-4xl text-white">🪸</span>
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Add Marine Ecosystem</h1>
                <p class="text-ocean-600">Create a new marine ecosystem entry in the database</p>
            </div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-emerald-600 mb-3 tracking-tight drop-shadow-sm">
                Tambah Ekosistem
            </h1>
            <p class="text-ocean-700 font-medium text-lg bg-white/60 inline-block px-6 py-2 rounded-full backdrop-blur-sm shadow-sm border border-white">
                Perkaya basis data kelautan kita dengan ekosistem baru.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.15)] border border-ocean-100 p-8 md:p-12 relative overflow-hidden transition-all duration-300">
            <!-- Decorative Accent Line -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-ocean-500 via-blue-500 to-emerald-500"></div>

            <!-- Form -->
            <form action="{{ route('ekosistem.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
            <form action="{{ route('ekosistem.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    <!-- Name -->
                    <div class="md:col-span-2 group">
                        <label for="nama_ekosistem" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Nama Ekosistem <span class="text-emerald-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="nama_ekosistem"
                            name="nama_ekosistem"
                            minlength="5"
                            value="{{ old('nama_ekosistem') }}"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('nama_ekosistem') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Contoh: Terumbu Karang Segitiga Emas" required>
                        @error('nama_ekosistem')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="group">
                        <label for="lokasi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Lokasi Geografis <span class="text-emerald-500">*</span>
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('lokasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Contoh: Laut Banda" required>
                        @error('lokasi')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="group">
                        <label for="gambar" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Gambar (Max 2MB) <span class="text-emerald-500">*</span>
                        </label>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/jpg"
                            class="w-full text-sm text-ocean-600 font-medium file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-ocean-600 file:text-white hover:file:bg-ocean-700 bg-ocean-50/50 border-2 border-ocean-100 rounded-2xl transition-all duration-300 cursor-pointer hover:border-ocean-300 focus:outline-none focus:ring-4 focus:ring-ocean-500/10 @error('gambar') border-red-500 @enderror" required>
                        @error('gambar')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2 group">
                        <label for="deskripsi" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Deskripsi Ekosistem <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Ceritakan tentang ekosistem ini secara detail..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role in Marine Life -->
                    <div class="md:col-span-2 group">
                        <label for="peran" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Peran dalam Kehidupan Laut <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="peran" name="peran" rows="2"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('peran') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Apa fungsi penting ekosistem ini bagi spesies laut?" required>{{ old('peran') }}</textarea>
                        @error('peran')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Threats -->
                    <div class="md:col-span-2 group">
                        <label for="ancaman" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Ancaman <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="ancaman" name="ancaman" rows="2"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 resize-none hover:border-ocean-300 @error('ancaman') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Ancaman apa saja yang dihadapi ekosistem ini?" required>{{ old('ancaman') }}</textarea>
                        @error('ancaman')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-5 pt-8 mt-6 border-t border-ocean-100">
                    <a href="{{ route('ekosistem.index') }}" class="sm:w-1/3 bg-ocean-50 hover:bg-ocean-100 text-ocean-800 font-bold py-4 px-6 rounded-2xl text-center transition-all duration-300 transform hover:-translate-y-1">
                        Kembali
                    </a>
                    <button type="submit" class="sm:w-2/3 bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-extrabold text-lg py-4 px-6 rounded-2xl shadow-xl shadow-ocean-500/30 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-500/30 transition-all duration-300 flex justify-center items-center gap-3">
                        <span>Tambah Ekosistem</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </button>
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
            alert("Nama Ekosistem minimal 5 karakter"); 
        }

        const fileInput = document.getElementById("gambar");
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            if (file.size > 2 * 1024 * 1024) {
                e.preventDefault();
                alert("Ukuran gambar maksimal 2MB");
            }
        }
        
        if (deskripsi.length < 10) {
            e.preventDefault();
            alert("Deskripsi minimal 10 karakter");
        }
        if (lokasi.length < 5) {
            e.preventDefault();
            alert("Lokasi minimal 5 karakter");
        }
        if (peran.length < 5) {
            e.preventDefault();
            alert("Peran minimal 5 karakter");
        }
        if (ancaman.length < 10) {
            e.preventDefault();
            alert("Ancaman minimal 10 karakter");
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