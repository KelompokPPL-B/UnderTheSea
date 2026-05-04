@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-3xl mx-auto px-6">

        <a href="{{ route('ikan.index') }}" class="inline-block mb-5 text-ocean-700 font-semibold hover:underline">← Back to Fish</a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="h-72 bg-gray-50 flex items-center justify-center overflow-hidden">
                @if(!empty($ikan->gambar))
                    <img src="{{ asset('storage/' . $ikan->gambar) }}" alt="{{ $ikan->nama }}" class="max-h-72 max-w-full object-contain">
                @elseif(!empty($ikan->image))
                    <img src="{{ asset('storage/' . $ikan->image) }}" alt="{{ $ikan->name }}" class="max-h-72 max-w-full object-contain">
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </div>

            <div class="p-8">
                <h1 class="text-3xl font-bold text-ocean-900 mb-4">{{ $ikan->nama ?? $ikan->name }}</h1>

                <div class="space-y-3 text-gray-700">
                    <p><strong>Scientific Name:</strong> {{ $ikan->scientific_name ?? '-' }}</p>
                    <p><strong>Habitat:</strong> {{ $ikan->habitat ?? '-' }}</p>
                    <p><strong>Description:</strong> {{ $ikan->deskripsi ?? $ikan->description ?? '-' }}</p>
                    <p><strong>Diet:</strong> {{ $ikan->diet ?? '-' }}</p>
                    <p><strong>Size:</strong> {{ $ikan->size ?? '-' }}</p>
                    <p><strong>Conservation Status:</strong> {{ $ikan->status_konservasi ?? $ikan->conservation_status ?? '-' }}</p>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('ikan.edit', $ikan->id_ikan ?? $ikan->id) }}" class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-md text-sm font-medium">Edit</a>

                    <form action="{{ route('ikan.destroy', $ikan->id_ikan ?? $ikan->id) }}" method="POST" onsubmit="return confirm('Delete this fish?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">Delete</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
