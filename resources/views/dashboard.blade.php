@extends('layouts.app')

@section('content')
<!-- PBI-Dashboard -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-bold text-ocean-900 mb-8">Dashboard</h1>

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