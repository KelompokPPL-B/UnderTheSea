@extends('layouts.app')

@section('content')
<div class="py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== SEARCH BAR ===== --}}
        <div class="mb-10">
            <div class="text-center mb-6">
                <h1 class="text-3xl sm:text-4xl font-bold text-ocean-700 mb-2">🌊 Under The Sea</h1>
                <p class="text-gray-500 text-sm">Temukan informasi ikan, ekosistem, dan aksi pelestarian laut</p>
            </div>
            <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="flex items-center gap-3">
                    <input
                        type="text"
                        name="q"
                        value="{{ $rawQuery }}"
                        placeholder="Cari ikan, ekosistem, atau aksi pelestarian..."
                        class="w-full rounded-xl border border-ocean-200 bg-white px-5 py-3 text-sm text-gray-700 shadow-soft focus:outline-none focus:ring-2 focus:ring-ocean-400 transition"
                    />
                    <button type="submit"
                        class="px-6 py-3 bg-ocean-500 hover:bg-ocean-600 text-white text-sm font-semibold rounded-xl shadow-soft transition whitespace-nowrap">
                        🔍 Cari
                    </button>
                </div>
                @if($rawQuery !== '' && $query === '')
                    <p class="text-xs text-yellow-600 mt-2 text-center">
                        ⚠️ Masukkan kata kunci untuk melakukan pencarian.
                    </p>
                @endif
            </form>
        </div>

        {{-- ===== PBI-29: CATEGORY CARDS ===== --}}
        @if(!$isSearching)
        <div class="mb-12">
            <h2 class="text-xl font-bold text-gray-800 mb-5 text-center">Jelajahi Kategori</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">

                <a href="{{ route('ikan.index') }}"
                   class="group relative overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #7DD3FC, #0369A1); box-shadow: 0 10px 25px rgba(3,105,161,0.3);">
                    <div class="p-8 flex flex-col items-center text-center text-white">
                        <span class="text-6xl mb-4 block" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">🐠</span>
                        <h3 class="text-xl font-bold mb-2">Ikan</h3>
                        <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.85);">
                            Temukan berbagai jenis ikan laut, habitatnya, dan status konservasi mereka.
                        </p>
                        <span class="mt-5 inline-block text-sm font-semibold px-4 py-2 rounded-xl"
                              style="background: rgba(255,255,255,0.2);">Jelajahi →</span>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                </a>

                <a href="{{ route('ekosistem.index') }}"
                   class="group relative overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #38BDF8, #075985); box-shadow: 0 10px 25px rgba(7,89,133,0.3);">
                    <div class="p-8 flex flex-col items-center text-center text-white">
                        <span class="text-6xl mb-4 block" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">🪸</span>
                        <h3 class="text-xl font-bold mb-2">Ekosistem</h3>
                        <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.85);">
                            Pelajari ekosistem laut seperti terumbu karang, mangrove, dan padang lamun.
                        </p>
                        <span class="mt-5 inline-block text-sm font-semibold px-4 py-2 rounded-xl"
                              style="background: rgba(255,255,255,0.2);">Jelajahi →</span>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                </a>

                <a href="{{ route('aksi.index') }}"
                   class="group relative overflow-hidden rounded-2xl transition-all duration-300 hover:-translate-y-1"
                   style="background: linear-gradient(135deg, #0EA5E9, #0C4A6E); box-shadow: 0 10px 25px rgba(12,74,110,0.3);">
                    <div class="p-8 flex flex-col items-center text-center text-white">
                        <span class="text-6xl mb-4 block" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">🌊</span>
                        <h3 class="text-xl font-bold mb-2">Aksi Pelestarian</h3>
                        <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.85);">
                            Bergabung dalam aksi nyata untuk menjaga kelestarian laut Indonesia.
                        </p>
                        <span class="mt-5 inline-block text-sm font-semibold px-4 py-2 rounded-xl"
                              style="background: rgba(255,255,255,0.2);">Jelajahi →</span>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 rounded-full" style="background: rgba(255,255,255,0.08);"></div>
                </a>

            </div>
        </div>

        {{-- ===== PBI-37: POPULAR CONTENT ===== --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">🔥</span>
                <h2 class="text-2xl font-bold text-gray-900">Konten Populer</h2>
                <span class="text-xs px-2 py-1 rounded-full font-medium text-white"
                      style="background: linear-gradient(135deg, #0EA5E9, #0369A1);">
                    Berdasarkan views & bookmark
                </span>
            </div>

            {{-- Popular Ikan --}}
            @if($popularContent['ikan']->count() > 0)
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🐠</span>
                        <h3 class="text-lg font-semibold text-gray-800">Ikan Terpopuler</h3>
                    </div>
                    <a href="{{ route('ikan.index') }}" class="text-sm font-medium text-ocean-500 hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($popularContent['ikan'] as $index => $item)
                    <a href="{{ route('ikan.show', $item->id_ikan) }}"
                       class="group relative bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300 hover:-translate-y-1"
                       style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                        {{-- Rank badge --}}
                        <div class="absolute top-3 left-3 z-10 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white"
                             style="background: {{ $index === 0 ? '#F59E0B' : ($index === 1 ? '#9CA3AF' : '#CD7C4B') }};">
                            {{ $index + 1 }}
                        </div>
                        @if($item->gambar)
                            <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}"
                                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full h-40 flex items-center justify-center text-4xl"
                                 style="background: linear-gradient(135deg, #E0F2FE, #BAE6FD);">🐠</div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->nama }}</h4>
                            @if($item->habitat)
                                <p class="text-xs text-gray-400 mt-1">📍 {{ $item->habitat }}</p>
                            @endif
                            @if($item->status_konservasi)
                                <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full"
                                      style="background:#E0F2FE; color:#0369A1;">{{ $item->status_konservasi }}</span>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Popular Ekosistem --}}
            @if($popularContent['ekosistem']->count() > 0)
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🪸</span>
                        <h3 class="text-lg font-semibold text-gray-800">Ekosistem Terpopuler</h3>
                    </div>
                    <a href="{{ route('ekosistem.index') }}" class="text-sm font-medium text-ocean-500 hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($popularContent['ekosistem'] as $index => $item)
                    <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}"
                       class="group relative bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300 hover:-translate-y-1"
                       style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                        <div class="absolute top-3 left-3 z-10 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white"
                             style="background: {{ $index === 0 ? '#F59E0B' : ($index === 1 ? '#9CA3AF' : '#CD7C4B') }};">
                            {{ $index + 1 }}
                        </div>
                        @if($item->gambar)
                            <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}"
                                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full h-40 flex items-center justify-center text-4xl"
                                 style="background: linear-gradient(135deg, #BAE6FD, #7DD3FC);">🪸</div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->nama_ekosistem }}</h4>
                            @if($item->lokasi)
                                <p class="text-xs text-gray-400 mt-1">📍 {{ $item->lokasi }}</p>
                            @endif
                            @if($item->deskripsi)
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Popular Aksi --}}
            @if($popularContent['aksi']->count() > 0)
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">🌊</span>
                        <h3 class="text-lg font-semibold text-gray-800">Aksi Terpopuler</h3>
                    </div>
                    <a href="{{ route('aksi.index') }}" class="text-sm font-medium text-ocean-500 hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    @foreach($popularContent['aksi'] as $index => $item)
                    <a href="{{ route('aksi.show', $item->id_aksi) }}"
                       class="group relative bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300 hover:-translate-y-1"
                       style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                        <div class="absolute top-3 left-3 z-10 w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white"
                             style="background: {{ $index === 0 ? '#F59E0B' : ($index === 1 ? '#9CA3AF' : '#CD7C4B') }};">
                            {{ $index + 1 }}
                        </div>
                        @if($item->gambar)
                            <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}"
                                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full h-40 flex items-center justify-center text-4xl"
                                 style="background: linear-gradient(135deg, #E0F2FE, #7DD3FC);">🌊</div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->judul_aksi }}</h4>
                            @if($item->manfaat)
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ Str::limit($item->manfaat, 80) }}</p>
                            @endif
                            @if($item->is_user_generated)
                                <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full"
                                      style="background:#BAE6FD; color:#0C4A6E;">Kontribusi Komunitas</span>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Empty state jika belum ada data populer --}}
            @if($popularContent['ikan']->count() === 0 && $popularContent['ekosistem']->count() === 0 && $popularContent['aksi']->count() === 0)
            <div class="text-center py-12 bg-white rounded-2xl border border-ocean-100"
                 style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                <div class="text-4xl mb-3">🌊</div>
                <p class="text-gray-500 text-sm">Belum ada data populer. Mulai eksplorasi konten!</p>
            </div>
            @endif
        </div>
        @endif

        {{-- ===== HASIL SEARCH ===== --}}
        @if($isSearching)
            <div class="mb-12">
                <p class="text-sm text-gray-500 text-center mb-6">
                    @if($totalResults > 0)
                        Menampilkan <span class="font-semibold text-ocean-600">{{ $totalResults }}</span> hasil untuk
                        "<span class="font-semibold text-gray-700">{{ $query }}</span>"
                    @else
                        Pencarian untuk "<span class="font-semibold text-gray-700">{{ $query }}</span>"
                    @endif
                    &mdash; <a href="{{ route('home') }}" class="text-ocean-500 hover:underline">Hapus pencarian</a>
                </p>

                @if($totalResults === 0)
                    <div class="text-center py-16 bg-white rounded-2xl border border-ocean-100"
                         style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                        <div class="text-5xl mb-4">🔍</div>
                        <p class="text-gray-700 text-lg font-semibold">Hasil tidak ditemukan</p>
                        <p class="text-gray-400 text-sm mt-2">
                            Tidak ada data untuk "<span class="font-medium">{{ $query }}</span>".
                        </p>
                        <p class="text-gray-400 text-sm mt-1">Coba periksa ejaan atau gunakan kata kunci lain.</p>
                        <div class="flex justify-center gap-3 mt-6 flex-wrap">
                            <a href="{{ route('ikan.index') }}" class="px-4 py-2 bg-ocean-50 hover:bg-ocean-100 text-ocean-600 text-sm rounded-xl font-medium transition">🐠 Lihat semua ikan</a>
                            <a href="{{ route('ekosistem.index') }}" class="px-4 py-2 text-sm rounded-xl font-medium transition" style="background:#E0F2FE; color:#0369A1;">🪸 Lihat semua ekosistem</a>
                            <a href="{{ route('aksi.index') }}" class="px-4 py-2 bg-ocean-50 hover:bg-ocean-100 text-ocean-600 text-sm rounded-xl font-medium transition">🌊 Lihat semua aksi</a>
                        </div>
                    </div>
                @endif

                @if($searchIkan->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl">🐠</span>
                        <h2 class="text-lg font-bold text-ocean-700">Ikan</h2>
                        <span class="text-xs bg-ocean-100 text-ocean-600 px-2 py-0.5 rounded-full font-medium">{{ $searchIkan->count() }} hasil</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($searchIkan as $item)
                        <a href="{{ route('ikan.show', $item->id_ikan) }}"
                           class="group bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300"
                           style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            @else
                                <div class="w-full h-40 bg-ocean-50 flex items-center justify-center text-4xl">🐠</div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->nama }}</h3>
                                @if($item->habitat)
                                    <p class="text-xs text-gray-400 mt-1">📍 {{ $item->habitat }}</p>
                                @endif
                                @if($item->status_konservasi)
                                    <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full" style="background:#E0F2FE; color:#0369A1;">{{ $item->status_konservasi }}</span>
                                @endif
                                @if($item->deskripsi)
                                    <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($searchEkosistem->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl">🪸</span>
                        <h2 class="text-lg font-bold text-ocean-700">Ekosistem</h2>
                        <span class="text-xs bg-ocean-100 text-ocean-600 px-2 py-0.5 rounded-full font-medium">{{ $searchEkosistem->count() }} hasil</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($searchEkosistem as $item)
                        <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}"
                           class="group bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300"
                           style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            @else
                                <div class="w-full h-40 flex items-center justify-center text-4xl" style="background:#E0F2FE;">🪸</div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->nama_ekosistem }}</h3>
                                @if($item->lokasi)
                                    <p class="text-xs text-gray-400 mt-1">📍 {{ $item->lokasi }}</p>
                                @endif
                                @if($item->deskripsi)
                                    <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($searchAksi->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-xl">🌊</span>
                        <h2 class="text-lg font-bold text-ocean-700">Aksi Pelestarian</h2>
                        <span class="text-xs bg-ocean-100 text-ocean-600 px-2 py-0.5 rounded-full font-medium">{{ $searchAksi->count() }} hasil</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @foreach($searchAksi as $item)
                        <a href="{{ route('aksi.show', $item->id_aksi) }}"
                           class="group bg-white rounded-2xl border border-ocean-100 overflow-hidden transition-all duration-300"
                           style="box-shadow: 0 4px 14px rgba(0,0,0,0.05);">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}"
                                     class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                            @else
                                <div class="w-full h-40 bg-ocean-50 flex items-center justify-center text-4xl">🌊</div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 group-hover:text-ocean-600 transition text-sm">{{ $item->judul_aksi }}</h3>
                                @if($item->manfaat)
                                    <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ Str::limit($item->manfaat, 80) }}</p>
                                @endif
                                @if($item->is_user_generated)
                                    <span class="inline-block mt-2 text-xs px-2 py-0.5 rounded-full" style="background:#BAE6FD; color:#0C4A6E;">Kontribusi Komunitas</span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

        @else
        {{-- ===== KONTEN NORMAL ===== --}}
        <div class="mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-8">Recommended Content</h2>

            <div class="mb-8">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Fish</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($randomContent['ikan'] as $item)
                        <a href="{{ route('ikan.show', $item->id_ikan) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}" class="w-full h-48 object-cover" loading="lazy">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center"><span class="text-gray-400">No image</span></div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-900">{{ $item->nama }}</h4>
                                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500">No fish available</p>
                    @endforelse
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Ecosystems</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($randomContent['ekosistem'] as $item)
                        <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama_ekosistem }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center"><span class="text-gray-400">No image</span></div>
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

            <div class="mb-8">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4">Conservation Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($randomContent['aksi'] as $item)
                        <a href="{{ route('aksi.show', $item->id_aksi) }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            @if($item->gambar)
                                <img src="/storage/{{ $item->gambar }}" alt="{{ $item->judul_aksi }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center"><span class="text-gray-400">No image</span></div>
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
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">{{ $user['badge'] }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No leaderboard data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @endif

    </div>
</div>
@endsection