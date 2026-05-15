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
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/80 backdrop-blur-md shadow-lg mb-4">
                <span class="text-3xl">🪸</span>
            </div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-ocean-800 to-emerald-600 mb-2 tracking-tight">
                Tambah Ekosistem
            </h1>
            <p class="text-ocean-600/80 font-medium text-lg">Perkaya basis data kelautan kita dengan ekosistem baru.</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-8 md:p-12 transition-all duration-300 hover:shadow-ocean-500/10">

            <!-- Form -->
            <form action="{{ route('ekosistem.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label for="nama_ekosistem" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Nama Ekosistem <span class="text-emerald-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="nama_ekosistem"
                            name="nama_ekosistem"
                            minlength="5"
                            value="{{ old('nama_ekosistem') }}"
                            class="w-full bg-white/50 border border-ocean-200 text-ocean-900 text-sm rounded-2xl focus:ring-4 focus:ring-ocean-500/20 focus:border-ocean-500 block px-4 py-3 transition-all duration-300 @error('nama_ekosistem') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Contoh: Terumbu Karang Segitiga Emas" required>
                        @error('nama_ekosistem')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="lokasi" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Lokasi Geografis <span class="text-emerald-500">*</span>
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full bg-white/50 border border-ocean-200 text-ocean-900 text-sm rounded-2xl focus:ring-4 focus:ring-ocean-500/20 focus:border-ocean-500 block px-4 py-3 transition-all duration-300 @error('lokasi') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Contoh: Laut Banda" required>
                        @error('lokasi')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="gambar" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Gambar (Max 2MB) <span class="text-emerald-500">*</span>
                        </label>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/jpg"
                            class="w-full text-sm text-ocean-500 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-ocean-50 file:text-ocean-700 hover:file:bg-ocean-100 bg-white/50 border border-ocean-200 rounded-2xl transition-all duration-300 cursor-pointer @error('gambar') border-red-500 @enderror" required>
                        @error('gambar')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Deskripsi Ekosistem <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="w-full bg-white/50 border border-ocean-200 text-ocean-900 text-sm rounded-2xl focus:ring-4 focus:ring-ocean-500/20 focus:border-ocean-500 block px-4 py-3 transition-all duration-300 resize-none @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Ceritakan tentang ekosistem ini secara detail..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role in Marine Life -->
                    <div class="md:col-span-2">
                        <label for="peran" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Peran dalam Kehidupan Laut <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="peran" name="peran" rows="2"
                            class="w-full bg-white/50 border border-ocean-200 text-ocean-900 text-sm rounded-2xl focus:ring-4 focus:ring-ocean-500/20 focus:border-ocean-500 block px-4 py-3 transition-all duration-300 resize-none @error('peran') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Apa fungsi penting ekosistem ini bagi spesies laut?" required>{{ old('peran') }}</textarea>
                        @error('peran')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Threats -->
                    <div class="md:col-span-2">
                        <label for="ancaman" class="block text-sm font-bold text-ocean-900 mb-2 ml-1">
                            Ancaman <span class="text-emerald-500">*</span>
                        </label>
                        <textarea id="ancaman" name="ancaman" rows="2"
                            class="w-full bg-white/50 border border-ocean-200 text-ocean-900 text-sm rounded-2xl focus:ring-4 focus:ring-ocean-500/20 focus:border-ocean-500 block px-4 py-3 transition-all duration-300 resize-none @error('ancaman') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Ancaman apa saja yang dihadapi ekosistem ini?" required>{{ old('ancaman') }}</textarea>
                        @error('ancaman')
                            <p class="text-red-500 text-xs font-semibold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-8 mt-4 border-t border-ocean-100">
                    <a href="{{ route('ekosistem.index') }}" class="sm:w-1/3 bg-white hover:bg-ocean-50 text-ocean-700 font-bold py-3 px-6 rounded-2xl border-2 border-ocean-200 hover:border-ocean-300 text-center transition-all duration-300">
                        Batal
                    </a>
                    <button type="submit" class="sm:w-2/3 bg-gradient-to-r from-ocean-600 to-emerald-500 hover:from-ocean-700 hover:to-emerald-600 text-white font-bold py-3 px-6 rounded-2xl shadow-lg hover:shadow-emerald-500/40 transform hover:-translate-y-1 transition-all duration-300 flex justify-center items-center gap-2">
                        <span>Tambah Ekosistem</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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