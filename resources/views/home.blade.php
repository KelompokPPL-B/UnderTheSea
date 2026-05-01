@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-ocean-50 to-sand">
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Random Content Section -->
            <div class="mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">Recommended Content</h2>

                <!-- Fish (header kept, cards hidden) -->
                <div class="mb-8">
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Fish</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <p class="text-gray-500">No fish available</p>
                    </div>
                </div>

                <!-- Ecosystems -->
                <div class="mb-8">
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Ecosystems</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($randomContent['ekosistem'] as $item)
                            <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                @if($item->gambar)
                                    <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900">{{ $item->nama_ekosistem }}</h4>
                                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500">No ecosystems available</p>
                        @endforelse
                    </div>
                </div>

                <!-- Actions -->
                <div class="mb-8">
                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Conservation Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @forelse($randomContent['aksi'] as $item)
                            <a href="{{ route('aksi.show', $item->id_aksi) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                                @if($item->gambar)
                                    <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-400">No image</span>
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900">{{ $item->judul_aksi }}</h4>
                                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500">No actions available</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Popular Actions Section -->
            <div class="mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">Popular Actions</h2>
                <div class="bg-white rounded-lg shadow-md">
                    @forelse($popularActions as $action)
                        <a href="{{ route('aksi.show', $action['id']) }}" class="block p-6 border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $action['title'] }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">Created by <span class="font-semibold">{{ $action['creator']['name'] }}</span> ({{ $action['creator']['badge'] }})</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-blue-600">{{ $action['like_count'] }}</p>
                                    <p class="text-gray-600 text-sm">Likes</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="p-6 text-gray-500">No actions available</p>
                    @endforelse
                </div>
            </div>

            <!-- Leaderboard Section -->
            <div class="mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">Leaderboard</h2>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Rank</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Name</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Points</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Badge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($leaderboard as $user)
                                <tr class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50">
                                    <td class="px-6 py-4 text-gray-900 font-bold">{{ $user['rank'] }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ $user['name'] }}</td>
                                    <td class="px-6 py-4 text-gray-900 font-semibold">{{ $user['points'] }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                            {{ $user['badge'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No leaderboard data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
