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
                <span class="text-4xl text-white">✏️</span>
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-2xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-card p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-2">Edit Marine Ecosystem</h1>
            </div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-emerald-600 mb-3 tracking-tight drop-shadow-sm">
                Edit Ekosistem
            </h1>
            <p class="text-ocean-700 font-medium text-lg bg-white/60 inline-block px-6 py-2 rounded-full backdrop-blur-sm shadow-sm border border-white">
                Perbarui informasi ekosistem kelautan ini.
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.15)] border border-ocean-100 p-8 md:p-12 relative overflow-hidden transition-all duration-300">
            <!-- Decorative Accent Line -->
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-ocean-500 via-blue-500 to-emerald-500"></div>

            <!-- Form -->
            <form action="{{ route('ekosistem.update', $ekosistem->id_ekosistem) }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                @csrf
                @method('PUT')
                
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
                            value="{{ old('nama_ekosistem', $ekosistem->nama_ekosistem) }}"
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
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $ekosistem->lokasi) }}"
                            class="w-full bg-ocean-50/50 border-2 border-ocean-100 text-ocean-900 font-medium text-sm rounded-2xl focus:bg-white focus:ring-4 focus:ring-ocean-500/10 focus:border-ocean-500 block px-5 py-4 transition-all duration-300 hover:border-ocean-300 @error('lokasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 bg-red-50 @enderror"
                            placeholder="Contoh: Laut Banda" required>
                        @error('lokasi')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image (Optional for Edit) -->
                    <div class="group">
                        <label for="gambar" class="block text-sm font-extrabold text-ocean-900 mb-2 ml-1 group-hover:text-ocean-600 transition-colors">
                            Gambar Baru (Maks 2MB)
                        </label>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/jpg"
                            class="w-full text-sm text-ocean-600 font-medium file:mr-4 file:py-4 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-ocean-600 file:text-white hover:file:bg-ocean-700 bg-ocean-50/50 border-2 border-ocean-100 rounded-2xl transition-all duration-300 cursor-pointer hover:border-ocean-300 focus:outline-none focus:ring-4 focus:ring-ocean-500/10 @error('gambar') border-red-500 @enderror">
                        <p class="text-ocean-500 text-xs font-medium mt-2 ml-1">Kosongkan jika tidak ingin mengubah gambar.</p>
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
                            placeholder="Ceritakan tentang ekosistem ini secara detail..." required>{{ old('deskripsi', $ekosistem->deskripsi) }}</textarea>
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
                            placeholder="Apa fungsi penting ekosistem ini bagi spesies laut?" required>{{ old('peran', $ekosistem->peran) }}</textarea>
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
                            placeholder="Ancaman apa saja yang dihadapi ekosistem ini?" required>{{ old('ancaman', $ekosistem->ancaman) }}</textarea>
                        @error('ancaman')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
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

                    <!-- Current Image Preview -->
                    @if($ekosistem->gambar)
                        <div class="md:col-span-2 group p-5 bg-ocean-50/50 border-2 border-ocean-100 rounded-2xl">
                            <p class="text-sm font-extrabold text-ocean-900 mb-3">Gambar Saat Ini</p>
                            <img src="/storage/{{ $ekosistem->gambar }}" alt="{{ $ekosistem->nama_ekosistem }}" class="h-48 w-full md:w-auto rounded-xl object-cover shadow-sm border border-ocean-200">
                        </div>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-5 pt-8 mt-6 border-t border-ocean-100">
                    <a href="{{ route('ekosistem.show', $ekosistem->id_ekosistem) }}" class="sm:w-1/3 bg-ocean-50 hover:bg-ocean-100 text-ocean-800 font-bold py-4 px-6 rounded-2xl text-center transition-all duration-300 transform hover:-translate-y-1">
                        Batal
                    </a>
                    <button type="submit" class="sm:w-2/3 bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-extrabold text-lg py-4 px-6 rounded-2xl shadow-xl shadow-ocean-500/30 transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-emerald-500/30 transition-all duration-300 flex justify-center items-center gap-3">
                        <span>Simpan Perubahan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
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
        }
    });
});
</script>
@endsection