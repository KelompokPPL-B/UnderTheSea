@extends('layouts.app')

@section('content')

<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">

```
    <!-- Title -->
    <h1 class="text-4xl font-bold text-ocean-900 mb-10">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <!-- Points -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <div class="text-eco-500 text-sm font-semibold mb-2">POINTS</div>
            <div class="text-4xl font-bold text-ocean-600">
                {{ auth()->user()->points ?? 0 }}
            </div>
            <p class="text-sm text-gray-500 mt-2">Earned from activities</p>
        </div>

        <!-- Badge -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <div class="text-eco-500 text-sm font-semibold mb-2">BADGE</div>
            <div class="text-2xl font-bold text-ocean-700">
                {{ auth()->user()->badge ?? '-' }}
            </div>
            <p class="text-sm text-gray-500 mt-2">Your achievement</p>
        </div>

        <!-- Bookmarks -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <div class="text-eco-500 text-sm font-semibold mb-2">BOOKMARKS</div>
            <div class="text-4xl font-bold text-ocean-600">
                {{ $bookmarkCount ?? 0 }}
            </div>
            <p class="text-sm text-gray-500 mt-2">Saved items</p>
        </div>

        <!-- Likes -->
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-6">
            <div class="text-eco-500 text-sm font-semibold mb-2">LIKES</div>
            <div class="text-4xl font-bold text-ocean-600">
                {{ $likeCount ?? 0 }}
            </div>
            <p class="text-sm text-gray-500 mt-2">Contributions</p>
        </div>

    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-8 max-w-2xl">
        <h2 class="text-2xl font-bold text-ocean-900 mb-6">Profile Information</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-500 mb-1">Name</p>
                <p class="text-lg font-semibold text-ocean-900">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 mb-1">Email</p>
                <p class="text-lg font-semibold text-ocean-900">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-8 flex gap-3">

            <!-- View Profile -->
            <a href="{{ route('profile.show') }}"
               class="px-4 py-2 rounded-lg border border-ocean-500 text-ocean-600 font-semibold 
                      hover:bg-ocean-50 transition duration-300">
                View Profile
            </a>

            <!-- Edit Profile (FIXED - Ocean Theme) -->
            <a href="{{ route('profile.edit') }}"
               class="px-4 py-2 rounded-lg text-white font-semibold 
                      bg-gradient-to-r from-blue-500 to-blue-700 
                      hover:from-blue-600 hover:to-blue-800 
                      transition duration-300 shadow-md">
                Edit Profile
            </a>

        </div>
    </div>

</div>
```

</div>
@endsection
