@extends('layouts.app')

@section('content')
<!-- PBI-Dashboard: Admin Upload Image -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-bold text-ocean-900 mb-8">Dashboard</h1>

        {{-- Success/Error Flash Message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- ADMIN SECTION: Upload Konten (dipindah ke atas biar langsung keliatan) --}}
        @if(auth()->user()->isAdmin())
        <div class="bg-white rounded-2xl shadow-card p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-ocean-900 mb-1">Upload Konten</h2>
            <p class="text-sm text-gray-500 mb-2">Tambah konten baru dengan gambar ke dalam kategori yang tersedia.</p>
            <p class="text-xs text-gray-400 mb-6">Format gambar yang diterima: <span class="font-medium">JPG, JPEG, PNG</span> — Maks. <span class="font-medium">2MB</span></p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Upload Ikan -->
                <a href="{{ route('ikan.create') }}"
                   class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-ocean-200 hover:border-ocean-400 hover:bg-ocean-50 rounded-xl p-6 transition group">
                    <div class="text-4xl">🐟</div>
                    <div class="text-center">
                        <p class="font-semibold text-ocean-800 group-hover:text-ocean-600">Tambah Ikan</p>
                        <p class="text-xs text-gray-400 mt-1">Upload data & gambar ikan baru</p>
                    </div>
                </a>

                <!-- Upload Ekosistem -->
                <a href="{{ route('ekosistem.create') }}"
                   class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-ocean-200 hover:border-ocean-400 hover:bg-ocean-50 rounded-xl p-6 transition group">
                    <div class="text-4xl">🌊</div>
                    <div class="text-center">
                        <p class="font-semibold text-ocean-800 group-hover:text-ocean-600">Tambah Ekosistem</p>
                        <p class="text-xs text-gray-400 mt-1">Upload data & gambar ekosistem</p>
                    </div>
                </a>

                <!-- Upload Aksi -->
                <a href="{{ route('aksi.create') }}"
                   class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-ocean-200 hover:border-ocean-400 hover:bg-ocean-50 rounded-xl p-6 transition group">
                    <div class="text-4xl">🌿</div>
                    <div class="text-center">
                        <p class="font-semibold text-ocean-800 group-hover:text-ocean-600">Tambah Aksi</p>
                        <p class="text-xs text-gray-400 mt-1">Upload data & gambar aksi pelestarian</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Recent Uploads --}}
        @if($recentUploads)
        <div class="bg-white rounded-2xl shadow-card p-6 md:p-8 mb-8">
            <h2 class="text-xl font-bold text-ocean-900 mb-5">Upload Terbaru</h2>

            {{-- Ikan --}}
            @if($recentUploads['ikan']->count())
            <div class="mb-5">
                <p class="text-sm font-semibold text-gray-500 mb-3">🐟 Ikan</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($recentUploads['ikan'] as $item)
                    <a href="{{ route('ikan.show', $item->id_ikan) }}"
                       class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-ocean-50 transition">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0"
                                 alt="{{ $item->nama }}">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-ocean-100 flex items-center justify-center flex-shrink-0 text-xl">🐟</div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-ocean-900 truncate">{{ $item->nama }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Ekosistem --}}
            @if($recentUploads['ekosistem']->count())
            <div class="mb-5">
                <p class="text-sm font-semibold text-gray-500 mb-3">🌊 Ekosistem</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($recentUploads['ekosistem'] as $item)
                    <a href="{{ route('ekosistem.show', $item->id_ekosistem) }}"
                       class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-ocean-50 transition">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0"
                                 alt="{{ $item->nama_ekosistem }}">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-ocean-100 flex items-center justify-center flex-shrink-0 text-xl">🌊</div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-ocean-900 truncate">{{ $item->nama_ekosistem }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Aksi --}}
            @if($recentUploads['aksi']->count())
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-3">🌿 Aksi Pelestarian</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach($recentUploads['aksi'] as $item)
                    <a href="{{ route('aksi.show', $item->id_aksi) }}"
                       class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-ocean-50 transition">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}"
                                 class="w-12 h-12 rounded-lg object-cover flex-shrink-0"
                                 alt="{{ $item->judul_aksi }}">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-ocean-100 flex items-center justify-center flex-shrink-0 text-xl">🌿</div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-ocean-900 truncate">{{ $item->judul_aksi }}</p>
                            <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif
        @endif
        {{-- END ADMIN SECTION --}}

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Points Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-5">
                <div class="text-eco-500 text-xs font-semibold mb-1">POINTS</div>
                <div class="text-3xl font-bold text-ocean-600">{{ auth()->user()->points }}</div>
                <p class="text-xs text-gray-500 mt-1">Earned from activities</p>
            </div>

            <!-- Badge Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-5">
                <div class="text-eco-500 text-xs font-semibold mb-1">BADGE</div>
                <div class="text-xl font-bold text-ocean-700">{{ auth()->user()->badge }}</div>
                <p class="text-xs text-gray-500 mt-1">Your achievement</p>
            </div>

            <!-- Bookmarks Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-5">
                <div class="text-eco-500 text-xs font-semibold mb-1">BOOKMARKS</div>
                <div class="text-3xl font-bold text-ocean-600">{{ $bookmarkCount ?? 0 }}</div>
                <p class="text-xs text-gray-500 mt-1">Saved items</p>
            </div>

            <!-- Likes Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-5">
                <div class="text-eco-500 text-xs font-semibold mb-1">LIKES</div>
                <div class="text-3xl font-bold text-ocean-600">{{ $likeCount ?? 0 }}</div>
                <p class="text-xs text-gray-500 mt-1">Contributions</p>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-6 md:p-8 max-w-3xl">
            <h2 class="text-xl md:text-2xl font-bold text-ocean-900 mb-5">Profile Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Name</p>
                    <p class="text-base font-semibold text-ocean-900">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 mb-1">Email</p>
                    <p class="text-base font-semibold text-ocean-900">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-2">
                <a href="{{ route('profile.show') }}" class="btn btn-outline btn-sm">View Profile</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
            </div>
        </div>

    </div>
</div>
@endsection