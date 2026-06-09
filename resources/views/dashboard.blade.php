@extends('layouts.app')

@section('content')

<div class="py-10 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

    @if(auth()->check() && auth()->user()->isAdmin())
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
        <!-- User Dashboard Custom Layout -->
        
        <!-- User Dashboard Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-ocean-900 tracking-tight">Dashboard</h1>
                @auth
                    <p class="text-gray-600 mt-1">Selamat datang kembali, <span class="font-semibold text-ocean-700">{{ $user->name }}</span>! Kelola aktivitas dan pelajari biota laut hari ini.</p>
                @else
                    <p class="text-gray-600 mt-1">Selamat datang di <span class="font-semibold text-ocean-700">Under The Sea</span>! Silakan masuk untuk berkontribusi menjaga kelestarian laut.</p>
                @endauth
            </div>
            
            @auth
            <!-- Quick Badge info -->
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-soft border border-ocean-100/60 shrink-0">
                <span class="text-2xl">🏆</span>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider leading-none">Pangkat Anda</p>
                    <p class="text-sm font-bold text-ocean-900 mt-1.5">{{ $user->badge }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $user->points }} Poin</p>
                </div>
            </div>
            @else
            <!-- Call to Action login -->
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-soft border border-ocean-100/60 shrink-0">
                <span class="text-2xl">🔑</span>
                <div>
                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider leading-none">Akses Akun</p>
                    <a href="{{ route('login') }}" class="text-sm font-bold text-ocean-600 hover:text-ocean-700 hover:underline mt-1 block">Log In / Register →</a>
                </div>
            </div>
            @endauth
        </div>

        <!-- User Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <!-- Bookmarks -->
            <a href="{{ route('favorites.index') }}" class="bg-white p-6 rounded-2xl shadow-card border-l-4 border-amber-500 hover:shadow-hover transition duration-300 group hover:scale-[1.01] flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-gray-400 tracking-wider">Bookmark Saya</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1 group-hover:text-ocean-600 transition">{{ $bookmarkCount }}</p>
                    <p class="text-xs text-gray-500 mt-2">Daftar biota dan aksi yang Anda simpan →</p>
                </div>
                <div class="p-4 bg-amber-50 text-amber-500 rounded-2xl text-2xl group-hover:bg-amber-100 transition">
                    🔖
                </div>
            </a>

            <!-- Likes -->
            <a href="{{ route('aksi.index') }}?sort=popular" class="bg-white p-6 rounded-2xl shadow-card border-l-4 border-rose-500 hover:shadow-hover transition duration-300 group hover:scale-[1.01] flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-gray-400 tracking-wider">Suka Saya</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1 group-hover:text-ocean-600 transition">{{ $likeCount }}</p>
                    <p class="text-xs text-gray-500 mt-2">Jumlah aksi pelestarian yang Anda sukai →</p>
                </div>
                <div class="p-4 bg-rose-50 text-rose-500 rounded-2xl text-2xl group-hover:bg-rose-100 transition">
                    ❤️
                </div>
            </a>

            <!-- Leaderboard Rank -->
            <a href="#leaderboard-section" class="bg-white p-6 rounded-2xl shadow-card border-l-4 border-ocean-500 hover:shadow-hover transition duration-300 group hover:scale-[1.01] flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-gray-400 tracking-wider">Total Skor</p>
                    <p class="text-3xl font-extrabold text-gray-800 mt-1 group-hover:text-ocean-600 transition">{{ auth()->check() ? $user->points : 0 }} <span class="text-xs font-normal text-gray-500">Poin</span></p>
                    <p class="text-xs text-gray-500 mt-2">Tingkatkan kontribusi Anda di leaderboard →</p>
                </div>
                <div class="p-4 bg-ocean-50 text-ocean-500 rounded-2xl text-2xl group-hover:bg-ocean-100 transition">
                    🏆
                </div>
            </a>
        </div>

        <!-- Hero Banner Section -->
        <div class="bg-gradient-to-br from-ocean-800 via-ocean-900 to-ocean-950 text-white rounded-3xl p-8 md:p-12 shadow-card mb-10 text-center relative overflow-hidden animate-fade border border-ocean-700/40">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-ocean-500/20 via-transparent to-transparent pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight drop-shadow-sm">🌊 Under The Sea</h2>
                <p class="text-ocean-200 mb-8 text-base md:text-lg font-medium leading-relaxed">
                    Jelajahi keindahan biota laut, temukan keajaiban ekosistem bawah air, dan berkontribusi langsung dalam aksi nyata menjaga kelestarian laut kita.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <a href="{{ route('ikan.index') }}" class="btn bg-white hover:bg-ocean-100 text-ocean-900 font-bold border-none shadow-md px-6 py-2.5 transition rounded-xl">
                        Mulai Jelajah
                    </a>
                    <a href="{{ route('aksi.index') }}" class="btn btn-outline border-white text-white hover:bg-white hover:text-ocean-900 font-bold shadow-md px-6 py-2.5 transition rounded-xl">
                        Lihat Aksi
                    </a>
                </div>
                <div class="flex justify-center items-center flex-wrap gap-x-6 gap-y-2 text-sm text-ocean-300 border-t border-white/10 pt-6">
                    <a href="{{ route('ikan.index') }}" class="hover:text-white transition font-semibold hover:underline">🐟 Katalog Ikan</a>
                    <span class="text-white/20 hidden sm:inline">|</span>
                    <a href="{{ route('ekosistem.index') }}" class="hover:text-white transition font-semibold hover:underline">🌊 Ekosistem Laut</a>
                    <span class="text-white/20 hidden sm:inline">|</span>
                    <a href="{{ route('aksi.index') }}" class="hover:text-white transition font-semibold hover:underline">🌱 Pelestarian Laut</a>
                </div>
            </div>
            <div class="absolute inset-0 bg-ocean-950/20 mix-blend-overlay"></div>
        </div>

        <!-- Insight Section -->
        <div class="mb-14 animate-fade">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-ocean-900">Featured Content</h2>
                <p class="text-gray-600 mt-2">Temukan informasi menarik seputar biota dan ekosistem laut yang kami rekomendasikan.</p>
                <div class="mt-4 flex justify-center gap-3">
                    <a href="{{ route('ikan.index') }}" class="btn btn-sm btn-primary bg-ocean-600 hover:bg-ocean-700 text-white border-none shadow-sm font-semibold px-4 rounded-lg">
                        Semua Ikan
                    </a>
                    <a href="{{ route('ekosistem.index') }}" class="btn btn-sm btn-outline text-ocean-600 border-ocean-200 hover:bg-ocean-50 font-semibold px-4 rounded-lg">
                        Semua Ekosistem
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredContent as $item)
                    @php
                        $isFish = ($item->type === 'fish');
                        $title = $isFish ? $item->nama : $item->nama_ekosistem;
                        $subtitle = $isFish ? "🌊 " . ($item->habitat ?? 'Tidak ada habitat') : "📍 " . ($item->lokasi ?? 'Tidak ada lokasi');
                        $description = $item->deskripsi;
                        $image = $item->gambar;
                        $type = $isFish ? 'ikan' : 'ekosistem';
                        $itemId = $isFish ? $item->id_ikan : $item->id_ekosistem;
                        $detailRoute = $isFish ? route('ikan.show', $item->id_ikan) : route('ekosistem.show', $item->id_ekosistem);
                        $badgeText = $isFish ? 'Ikan' : 'Ekosistem';
                        $badgeColor = $isFish ? 'bg-sky-500' : 'bg-emerald-500';
                    @endphp
                    <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition duration-300 group hover:scale-[1.02] flex flex-col justify-between overflow-hidden border border-ocean-100/40">
                        <div>
                            <!-- Image -->
                            <div class="relative overflow-hidden h-48">
                                @if($image)
                                    <img src="/storage/{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300" loading="lazy">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-ocean-100 to-ocean-50 flex items-center justify-center text-ocean-400">
                                        <span>Tidak ada gambar</span>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 {{ $badgeColor }} text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                                    {{ $badgeText }}
                                </span>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <a href="{{ $detailRoute }}" class="block group-hover:text-ocean-600 transition">
                                    <h3 class="font-bold text-ocean-900 text-base line-clamp-1 group-hover:text-ocean-600 transition duration-150 mb-1" title="{{ $title }}">{{ $title }}</h3>
                                </a>
                                <p class="text-xs text-gray-500 font-semibold mb-2">{{ $subtitle }}</p>
                                <p class="text-gray-600 text-sm line-clamp-2 leading-relaxed">{{ $description ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="p-6 pt-0">
                            <div class="flex gap-2">
                                <a href="{{ $detailRoute }}" class="btn btn-primary btn-sm flex-1 font-semibold transition">
                                    Detail
                                </a>
                                <button class="bookmark-btn-card btn btn-outline btn-sm px-3" data-type="{{ $type }}" data-item-id="{{ $itemId }}">
                                    <span class="bookmark-text">Bookmark</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Aksi Pelestarian Laut Section -->
        <div class="bg-white rounded-2xl shadow-card p-8 border border-ocean-100 mb-10 animate-fade">
            <div class="grid md:grid-cols-3 gap-8 items-center">
                
                <!-- Left Side -->
                <div class="md:col-span-1 space-y-4">
                    <h2 class="text-2xl font-bold text-ocean-900 leading-tight">Aksi Pelestarian Laut</h2>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Mari bersama kita berkontribusi nyata menjaga kebersihan dan keberlanjutan ekosistem laut kita melalui aksi sukarela.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('aksi.index') }}" class="btn btn-primary bg-ocean-600 hover:bg-ocean-700 text-white border-none shadow-md font-semibold px-6">
                            Ikuti Aksi
                        </a>
                    </div>
                </div>

                <!-- Right Side (Dynamic List of Conservation Actions) -->
                <div class="md:col-span-2 space-y-4">
                    @forelse($actions as $act)
                        <div class="flex items-center justify-between p-5 bg-ocean-50/40 rounded-2xl hover:bg-ocean-50/80 transition duration-300 border border-ocean-100/60 group hover:scale-[1.01]">
                            <a href="{{ route('aksi.show', $act->id_aksi) }}" class="flex items-center space-x-4 flex-1">
                                <div class="w-14 h-14 bg-white rounded-xl overflow-hidden shrink-0 flex items-center justify-center shadow-sm border border-ocean-100">
                                    @if($act->gambar)
                                        <img src="/storage/{{ $act->gambar }}" alt="{{ $act->judul_aksi }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-2xl text-ocean-500">🌱</span>
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <h4 class="font-bold text-ocean-900 text-base group-hover:text-ocean-600 transition duration-150">{{ $act->judul_aksi }}</h4>
                                    <p class="text-xs text-gray-500 font-medium">
                                        Oleh <span class="text-ocean-700 font-semibold">{{ $act->createdBy->name }}</span>
                                        <span class="ml-1 inline-block px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-100 text-[10px]">{{ $act->createdBy->badge }}</span>
                                    </p>
                                    <p class="text-xs text-gray-600 line-clamp-1 pr-4 leading-relaxed">{{ Str::limit($act->deskripsi, 100) }}</p>
                                </div>
                            </a>
                            <div class="text-right shrink-0">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                    ❤️ {{ $act->likes_count }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm italic text-center py-6">Belum ada aksi pelestarian yang terdaftar.</p>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- Leaderboard Section -->
        <div id="leaderboard-section" class="bg-white rounded-2xl shadow-card p-8 border border-ocean-100 mb-10 animate-fade">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-ocean-900">Leaderboard Kontributor</h2>
                    <p class="text-gray-600 text-sm mt-1">Daftar kontributor teratas dalam aksi pelestarian laut.</p>
                </div>
                <div>
                    <a href="{{ route('home') }}#leaderboard" class="btn btn-outline btn-sm text-ocean-600 border-ocean-200 hover:bg-ocean-50">
                        Lihat Selengkapnya
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl border border-ocean-100">
                <table class="w-full text-sm text-left">
                    <thead class="bg-ocean-50 text-ocean-900 font-bold border-b border-ocean-100">
                        <tr>
                            <th class="p-4 text-center w-16">Peringkat</th>
                            <th class="p-4">Nama Kontributor</th>
                            <th class="p-4 text-center">Total Poin</th>
                            <th class="p-4 text-center">Gelar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaderboard as $index => $u)
                        @php
                            $isCurrentUser = $u->id === auth()->id();
                            $rowBg = $isCurrentUser ? 'bg-ocean-50/60 font-semibold' : 'hover:bg-gray-50/50';
                            $rankColor = match($index) {
                                0 => 'text-amber-500 font-extrabold text-lg',
                                1 => 'text-slate-400 font-extrabold text-lg',
                                2 => 'text-amber-700 font-extrabold text-lg',
                                default => 'text-gray-500 font-semibold'
                            };
                            $badgeEmoji = match($index) {
                                0 => '🥇',
                                1 => '🥈',
                                2 => '🥉',
                                default => ''
                            };
                        @endphp
                        <tr class="border-b border-ocean-100/50 last:border-b-0 {{ $rowBg }} transition duration-150">
                            <td class="p-4 text-center {{ $rankColor }}">
                                @if($index < 3)
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white shadow-soft border border-ocean-100">{{ $badgeEmoji }}</span>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </td>
                            <td class="p-4 text-ocean-950 font-medium">
                                <div class="flex items-center gap-2">
                                    <span>{{ $u->name }}</span>
                                    @if($isCurrentUser)
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-ocean-600 text-white shadow-sm border border-ocean-700">Anda</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4 text-center font-bold text-ocean-700">{{ $u->points }} Poin</td>
                            <td class="p-4 text-center">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $u->badge }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

</div>

@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        initializeBookmarkButtonsCard();
        loadBookmarkStatesCard();
    });

    function initializeBookmarkButtonsCard() {
        document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
            btn.addEventListener('click', toggleBookmarkCard);
        });
    }

    function toggleBookmarkCard(e) {
        e.preventDefault();
        const btn = e.currentTarget;
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;
        const isBookmarked = btn.classList.contains('bookmarked');

        const method = isBookmarked ? 'DELETE' : 'POST';

        fetch('/favorites', {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({ type: type, item_id: parseInt(itemId) })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                btn.classList.toggle('bookmarked');
                btn.classList.toggle('bg-blue-600');
                btn.classList.toggle('text-white');
                btn.classList.toggle('border-blue-600');
                btn.classList.toggle('text-blue-600');
                btn.classList.toggle('hover:bg-blue-50');
                const text = btn.querySelector('.bookmark-text');
                text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error('Error:', err));
    }

    function loadBookmarkStatesCard() {
        fetch('/favorites', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.data)) {
                document.querySelectorAll('.bookmark-btn-card').forEach(btn => {
                    const type = btn.dataset.type;
                    const itemId = parseInt(btn.dataset.itemId);
                    const isBookmarked = data.data.some(fav => fav.type === type && fav.item_id === itemId);
                    if (isBookmarked) {
                        btn.classList.add('bookmarked', 'bg-blue-600', 'text-white', 'border-blue-600');
                        btn.classList.remove('text-blue-600', 'hover:bg-blue-50');
                        const text = btn.querySelector('.bookmark-text');
                        if (text) text.textContent = 'Bookmarked';
                    }
                });
            }
        })
        .catch(err => console.error('Error loading bookmark state:', err));
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content || '';
    }
</script>
@endpush

@endsection
