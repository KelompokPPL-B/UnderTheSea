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
                        Description *
                    </label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="4"
                        required
                        class="textarea textarea-bordered w-full @error('deskripsi') textarea-error @enderror"
                        placeholder="Describe the ecosystem"
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="lokasi" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Location *
                    </label>
                    <input
                        type="text"
                        id="lokasi"
                        name="lokasi"
                        value="{{ old('lokasi') }}"
                        required
                        class="input input-bordered w-full @error('lokasi') input-error @enderror"
                        placeholder="Enter geographic location"
                    >
                    @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
                    >{{ old('peran') }}</textarea>
                    @error('peran')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Characteristics -->
                <div>
                    <label for="karakteristik" class="block text-sm font-semibold text-ocean-900 mb-2">Karakteristik</label>
                    <textarea id="karakteristik" name="karakteristik" rows="3" class="textarea textarea-bordered w-full @error('karakteristik') textarea-error @enderror" placeholder="Key characteristics">{{ old('karakteristik') }}</textarea>
                    @error('karakteristik')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Benefits -->
                <div>
                    <label for="manfaat" class="block text-sm font-semibold text-ocean-900 mb-2">Manfaat Ekosistem</label>
                    <textarea id="manfaat" name="manfaat" rows="3" class="textarea textarea-bordered w-full @error('manfaat') textarea-error @enderror" placeholder="Benefits">{{ old('manfaat') }}</textarea>
                    @error('manfaat')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
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
                    >{{ old('ancaman') }}</textarea>
                    @error('ancaman')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="gambar" class="block text-sm font-semibold text-ocean-900 mb-2">
                        Image (JPG, JPEG, PNG, JFIF - Max 2MB)
                    </label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept=".jpg,.jpeg,.png,.jfif,image/jpeg,image/png"
                        class="file-input file-input-bordered w-full @error('gambar') file-input-error @enderror"
                    >
                    <p class="text-sm text-ocean-600 mt-1">Format: JPG, JPEG, PNG, JFIF | Maksimal: 2MB</p>
                    @error('gambar')
                        <small style="color:red">{{ $message }}</small>
                    @enderror
                </div>
                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-ocean-100">
                    <button type="submit" id="submitBtn" class="flex-1 px-6 py-3 bg-[#1e3a8a] text-white rounded-md hover:bg-[#2746b0] shadow-md transition-colors duration-200 font-medium">Create Ecosystem</button>
                    <a href="{{ route('ekosistem.index') }}" class="flex-1 text-center px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition font-medium">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Optional: keep submit button UX simple for standard form submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="{{ route('ekosistem.store') }}"]');
    const submitBtn = document.getElementById('submitBtn');
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating...';
        });
    }
});
</script>
@endpush
@endsection
