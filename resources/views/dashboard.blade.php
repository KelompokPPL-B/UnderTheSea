@extends('layouts.app')

@section('content')

<div class="py-10 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

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

</div>

</div>

@endsection
