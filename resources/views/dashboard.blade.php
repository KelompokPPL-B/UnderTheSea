@extends('layouts.app')

@section('content')

<div class="py-10 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

    @if(auth()->user()->isAdmin())
    <h1 class="text-3xl font-bold text-ocean-900 mb-8">Dashboard</h1>

    <!-- Stats Overview -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        @if(auth()->user()->isAdmin())
            <!-- Registered Users -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">Registered Users</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $usersCount }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-500 rounded-full text-xl">
                        👥
                    </div>
                </div>
            </div>

            <!-- Total Fish -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-teal-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">Total Fish</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalFishCount }}</p>
                    </div>
                    <div class="p-3 bg-teal-50 text-teal-500 rounded-full text-xl">
                        🐟
                    </div>
                </div>
            </div>

            <!-- Total Ecosystems -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-indigo-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">Total Ecosystems</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalEcosystemsCount }}</p>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-500 rounded-full text-xl">
                        🌊
                    </div>
                </div>
            </div>

            <!-- Total Actions -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-emerald-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">Total Actions</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalActionsCount }}</p>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-500 rounded-full text-xl">
                        🌱
                    </div>
                </div>
            </div>
        @else
            <!-- My Bookmarks -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-amber-500 col-span-2 md:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">My Bookmarks</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $bookmarkCount }}</p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-500 rounded-full text-xl">
                        🔖
                    </div>
                </div>
            </div>

            <!-- My Likes -->
            <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-rose-500 col-span-2 md:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase text-gray-400">My Likes</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $likeCount }}</p>
                    </div>
                    <div class="p-3 bg-rose-50 text-rose-500 rounded-full text-xl">
                        ❤️
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(auth()->user()->isAdmin())
    <!-- Data Distribution Dashboard -->
    <h2 class="text-xl font-semibold text-ocean-800 mb-4">Data Distribution Monitoring</h2>
    <div class="grid md:grid-cols-3 gap-6 mb-10">
        <!-- Conservation Status Distribution -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <h3 class="font-semibold text-ocean-700 mb-4">📊 Fish by Conservation Status</h3>
            @php $totalFish = $totalFishCount ?: 1; @endphp
            @if($fishStatusDistribution->count())
                @foreach($fishStatusDistribution as $dist)
                    @php
                        $percentage = round(($dist->count / $totalFish) * 100);
                        $color = match(strtolower($dist->status_konservasi)) {
                            'endangered' => 'bg-red-500',
                            'vulnerable' => 'bg-amber-500',
                            'least concern' => 'bg-green-500',
                            default => 'bg-blue-500'
                        };
                    @endphp
                    <div class="mb-4 last:mb-0">
                        <div class="flex justify-between text-xs font-semibold text-gray-600 mb-1">
                            <span>{{ $dist->status_konservasi }}</span>
                            <span>{{ $dist->count }} items ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="{{ $color }} h-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-400 text-sm italic">No data available</p>
            @endif
        </div>

        <!-- Habitat Distribution -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <h3 class="font-semibold text-ocean-700 mb-4">🏠 Top Fish Habitats</h3>
            @if($fishHabitatDistribution->count())
                @foreach($fishHabitatDistribution as $dist)
                    @php
                        $percentage = round(($dist->count / $totalFish) * 100);
                    @endphp
                    <div class="mb-4 last:mb-0">
                        <div class="flex justify-between text-xs font-semibold text-gray-600 mb-1">
                            <span>{{ $dist->habitat }}</span>
                            <span>{{ $dist->count }} items ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-teal-500 h-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-400 text-sm italic">No data available</p>
            @endif
        </div>

        <!-- Action Origin Distribution -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <h3 class="font-semibold text-ocean-700 mb-4">🌱 Conservation Actions Origin</h3>
            @php $totalActions = $totalActionsCount ?: 1; @endphp
            @if(count($actionTypeDistribution))
                @foreach($actionTypeDistribution as $dist)
                    @php
                        $percentage = round(($dist['count'] / $totalActions) * 100);
                        $color = $dist['label'] === 'Official Action' ? 'bg-indigo-600' : 'bg-emerald-500';
                    @endphp
                    <div class="mb-4 last:mb-0">
                        <div class="flex justify-between text-xs font-semibold text-gray-600 mb-1">
                            <span>{{ $dist['label'] }}</span>
                            <span>{{ $dist['count'] }} items ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="{{ $color }} h-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-400 text-sm italic">No data available</p>
            @endif
        </div>
    </div>
    @endif

    @if(auth()->user()->isAdmin())
    <!-- User Activity Charts -->
    <h2 class="text-xl font-semibold text-ocean-800 mb-4">User Activity & Engagement Charts</h2>
    <div class="grid md:grid-cols-2 gap-6 mb-10">
        <!-- Doughnut Chart: Engagement Breakdown -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between">
            <h3 class="font-semibold text-ocean-700 mb-4">📈 User Engagement Breakdown</h3>
            <div class="relative flex-1 flex justify-center items-center h-64">
                <canvas id="engagementChart"></canvas>
            </div>
        </div>

        <!-- Bar Chart: Views by Category -->
        <div class="bg-white p-6 rounded-xl shadow-md flex flex-col justify-between">
            <h3 class="font-semibold text-ocean-700 mb-4">👁️ Content Views by Category</h3>
            <div class="relative flex-1 flex justify-center items-center h-64">
                <canvas id="viewsChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Engagement Chart
            const engagementCtx = document.getElementById('engagementChart').getContext('2d');
            new Chart(engagementCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Bookmarks', 'Likes', 'Content Views'],
                    datasets: [{
                        data: [{{ $totalBookmarks }}, {{ $totalLikes }}, {{ $totalViews }}],
                        backgroundColor: [
                            'rgba(245, 158, 11, 0.8)', // Amber
                            'rgba(244, 63, 94, 0.8)',  // Rose
                            'rgba(14, 165, 233, 0.8)'  // Sky Blue
                        ],
                        borderColor: [
                            'rgb(245, 158, 11)',
                            'rgb(244, 63, 94)',
                            'rgb(14, 165, 233)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Views Chart
            const viewsCtx = document.getElementById('viewsChart').getContext('2d');
            const viewsLabels = {!! json_encode($viewsByContentType->pluck('label')) !!};
            const viewsData = {!! json_encode($viewsByContentType->pluck('count')) !!};

            new Chart(viewsCtx, {
                type: 'bar',
                data: {
                    labels: viewsLabels,
                    datasets: [{
                        label: 'Total Views',
                        data: viewsData,
                        backgroundColor: 'rgba(20, 184, 166, 0.8)', // Teal
                        borderColor: 'rgb(20, 184, 166)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif

    <!-- Recommended Content -->
    <h2 class="text-xl font-semibold text-ocean-800 mb-4">Recommended Content</h2>

    <div class="grid md:grid-cols-3 gap-6 mb-10">

        <!-- Fish -->
        <div class="bg-white p-5 rounded-xl shadow-md flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-ocean-700">🐟 Fish</h3>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('ikan.create') }}" class="text-xs bg-ocean-600 hover:bg-ocean-700 text-white px-2 py-1 rounded transition">+ Add Fish</a>
                    @endif
                </div>

                @if($fish->count())
                    <div class="space-y-2">
                        @foreach($fish as $item)
                            <div class="flex justify-between items-center border-b pb-2 last:border-b-0">
                                <span class="text-sm text-gray-700 font-medium">{{ $item->nama }}</span>
                                <div class="flex space-x-1">
                                    <a href="{{ route('ikan.show', $item->id_ikan) }}" class="text-xs text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-0.5 rounded transition">View</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('ikan.edit', $item->id_ikan) }}" class="text-xs text-amber-600 hover:text-amber-800 bg-amber-50 px-2 py-0.5 rounded transition">Edit</a>
                                        <form action="{{ route('ikan.destroy', $item->id_ikan) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this fish?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 bg-red-50 px-2 py-0.5 rounded transition">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">No fish available</p>
                @endif
            </div>
            <div class="mt-4 pt-2 border-t text-center">
                <a href="{{ route('ikan.index') }}" class="text-xs text-ocean-600 hover:text-ocean-700 font-medium">View All Fish →</a>
            </div>
        </div>

        <!-- Ecosystem -->
        <div class="bg-white p-5 rounded-xl shadow-md flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-ocean-700">🌊 Ecosystems</h3>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('ekosistem.create') }}" class="text-xs bg-ocean-600 hover:bg-ocean-700 text-white px-2 py-1 rounded transition">+ Add Eco</a>
                    @endif
                </div>

                @if($ecosystems->count())
                    <div class="space-y-2">
                        @foreach($ecosystems as $eco)
                            <div class="flex justify-between items-center border-b pb-2 last:border-b-0">
                                <span class="text-sm text-gray-700 font-medium">{{ $eco->nama_ekosistem }}</span>
                                <div class="flex space-x-1">
                                    <a href="{{ route('ekosistem.show', $eco->id_ekosistem) }}" class="text-xs text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-0.5 rounded transition">View</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('ekosistem.edit', $eco->id_ekosistem) }}" class="text-xs text-amber-600 hover:text-amber-800 bg-amber-50 px-2 py-0.5 rounded transition">Edit</a>
                                        <form action="{{ route('ekosistem.destroy', $eco->id_ekosistem) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ecosystem?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 bg-red-50 px-2 py-0.5 rounded transition">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">No ecosystems available</p>
                @endif
            </div>
            <div class="mt-4 pt-2 border-t text-center">
                <a href="{{ route('ekosistem.index') }}" class="text-xs text-ocean-600 hover:text-ocean-700 font-medium">View All Ecosystems →</a>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white p-5 rounded-xl shadow-md flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-ocean-700">🌱 Actions</h3>
                    <a href="{{ route('aksi.create') }}" class="text-xs bg-ocean-600 hover:bg-ocean-700 text-white px-2 py-1 rounded transition">+ Add Action</a>
                </div>

                @if($actions->count())
                    <div class="space-y-2">
                        @foreach($actions as $act)
                            <div class="flex justify-between items-center border-b pb-2 last:border-b-0">
                                <span class="text-sm text-gray-700 font-medium">{{ $act->judul_aksi }}</span>
                                <div class="flex space-x-1">
                                    <a href="{{ route('aksi.show', $act->id_aksi) }}" class="text-xs text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-0.5 rounded transition">View</a>
                                    @if(auth()->user()->isAdmin() || auth()->id() === $act->created_by)
                                        <a href="{{ route('aksi.edit', $act->id_aksi) }}" class="text-xs text-amber-600 hover:text-amber-800 bg-amber-50 px-2 py-0.5 rounded transition">Edit</a>
                                        <form action="{{ route('aksi.destroy', $act->id_aksi) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this action?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800 bg-red-50 px-2 py-0.5 rounded transition">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400 text-sm italic">No actions available</p>
                @endif
            </div>
            <div class="mt-4 pt-2 border-t text-center">
                <a href="{{ route('aksi.index') }}" class="text-xs text-ocean-600 hover:text-ocean-700 font-medium">View All Actions →</a>
            </div>
        </div>

    </div>

    <!-- Popular Actions -->
    <h2 class="text-xl font-semibold text-ocean-800 mb-4">Popular Actions</h2>

    <div class="bg-white rounded-xl shadow-md p-5 mb-10">
        @if($popularActions->count())
            @foreach($popularActions as $action)
                <div class="flex justify-between items-center border-b py-2 last:border-b-0 text-sm">
                    <a href="{{ route('aksi.show', $action->id_aksi) }}" class="text-ocean-600 hover:text-ocean-800 font-medium">{{ $action->judul_aksi }}</a>
                    <span class="text-ocean-600 font-semibold bg-ocean-50 px-2 py-0.5 rounded">{{ $action->likes_count }} likes</span>
                </div>
            @endforeach
        @else
            <p class="text-gray-400 italic text-sm">No popular actions yet</p>
        @endif
    </div>

    <!-- Leaderboard -->
    <h2 class="text-xl font-semibold text-ocean-800 mb-4">Leaderboard</h2>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-ocean-100 text-ocean-800">
                <tr>
                    <th class="p-3 text-left">Rank</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Points</th>
                    <th class="p-3 text-left">Badge</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboard as $index => $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3 font-semibold text-ocean-600">{{ $user->points }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                            {{ $user->badge }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <!-- User Dashboard Mockup Layout -->
        
        <!-- Hero Banner Section -->
        <div class="bg-gradient-to-r from-ocean-900 via-ocean-800 to-blue-900 text-white rounded-2xl p-8 md:p-12 shadow-lg mb-10 text-center relative overflow-hidden">
            <div class="relative z-10 max-w-2xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">🌊 Under The Sea</h1>
                <p class="text-ocean-100 mb-8 text-base md:text-lg">
                    Jelajahi keindahan biota laut dan pelajari pentingnya menjaga kelestarian ekosistem laut kita.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    <a href="{{ route('ikan.index') }}" class="px-6 py-3 bg-white text-ocean-900 font-semibold rounded-lg shadow hover:bg-ocean-50 transition duration-150">
                        Mulai Jelajah
                    </a>
                    <a href="{{ route('aksi.index') }}" class="px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition duration-150">
                        Lihat Aksi
                    </a>
                </div>
                <div class="flex justify-center items-center space-x-6 text-sm text-ocean-200 border-t border-white/10 pt-6">
                    <a href="{{ route('ikan.index') }}" class="hover:text-white transition">Katalog Ikan</a>
                    <span class="text-white/20">|</span>
                    <a href="{{ route('ekosistem.index') }}" class="hover:text-white transition">Ekosistem Laut</a>
                    <span class="text-white/20">|</span>
                    <a href="{{ route('aksi.index') }}" class="hover:text-white transition">Pelestarian Laut</a>
                </div>
            </div>
            <div class="absolute inset-0 bg-ocean-950/20 mix-blend-overlay"></div>
        </div>

        <!-- Insight Section -->
        <div class="mb-14">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-ocean-900">Insight</h2>
                <p class="text-gray-600 mt-2">Temukan informasi menarik dan edukatif seputar kehidupan laut.</p>
                <div class="mt-4">
                    <a href="{{ route('ikan.index') }}" class="inline-block px-5 py-2.5 bg-ocean-900 text-white font-semibold rounded-lg hover:bg-ocean-800 transition duration-150 shadow">
                        Lihat Semua Ikan
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredContent as $item)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-200 flex flex-col justify-between border border-gray-100">
                        <div>
                            <div class="relative">
                                @if($item->gambar)
                                    <img src="/storage/{{ $item->gambar }}" alt="{{ $item->nama }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 bg-ocean-600 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full">
                                    Fish
                                </span>
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-gray-900 text-base mb-1">{{ $item->nama }}</h4>
                                <p class="text-xs text-ocean-700 font-semibold mb-2">📍 {{ $item->habitat }}</p>
                                <p class="text-gray-600 text-xs line-clamp-3">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="p-4 pt-0">
                            <a href="{{ route('ikan.show', $item->id_ikan) }}" class="block text-center text-xs bg-ocean-50 text-ocean-700 font-semibold py-2 rounded-lg hover:bg-ocean-100 transition duration-150">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Aksi Pelestarian Laut Section -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 mb-10">
            <div class="grid md:grid-cols-3 gap-8 items-center">
                
                <!-- Left Side -->
                <div class="md:col-span-1 space-y-4">
                    <h2 class="text-2xl font-bold text-gray-900 leading-tight">Aksi Pelestarian Laut</h2>
                    <p class="text-gray-600 text-sm">
                        Mari bersama kita menjaga kebersihan dan keberlanjutan laut.
                    </p>
                    <div>
                        <a href="{{ route('aksi.index') }}" class="inline-block px-5 py-2.5 bg-black text-white font-semibold rounded-lg hover:bg-gray-900 transition duration-150 shadow">
                            Ikuti Aksi
                        </a>
                    </div>
                </div>
                <!-- Right Side (Dynamic List of Conservation Actions) -->
                <div class="md:col-span-2 space-y-4">
                    @forelse($actions as $act)
                        <a href="{{ route('aksi.show', $act->id_aksi) }}" class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-ocean-50/50 transition duration-150 border border-gray-100 block">
                            <div class="w-14 h-14 bg-gray-200 rounded-lg overflow-hidden shrink-0 flex items-center justify-center">
                                @if($act->gambar)
                                    <img src="/storage/{{ $act->gambar }}" alt="{{ $act->judul_aksi }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-2xl text-ocean-600">🌱</span>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">{{ $act->judul_aksi }}</h4>
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($act->deskripsi, 120) }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-400 text-sm italic text-center py-6">No actions available</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

</div>

</div>

@endsection
