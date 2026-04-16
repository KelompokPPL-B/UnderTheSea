@extends('layouts.app')

@section('content')
<!-- PBI-Dashboard -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <h1 class="text-4xl font-bold text-ocean-900 mb-10">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <!-- Points Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-6 animate-fade">
                <div class="text-eco-500 text-sm font-semibold mb-2">POINTS</div>
                <div class="text-4xl font-bold text-ocean-600">{{ auth()->user()->points }}</div>
                <p class="text-sm text-gray-600 mt-2">Earned from activities</p>
            </div>

            <!-- Badge Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-6 animate-fade">
                <div class="text-eco-500 text-sm font-semibold mb-2">BADGE</div>
                <div class="text-2xl font-bold text-ocean-700">{{ auth()->user()->badge }}</div>
                <p class="text-sm text-gray-600 mt-2">Your achievement</p>
            </div>

            <!-- Bookmarks Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-6 animate-fade">
                <div class="text-eco-500 text-sm font-semibold mb-2">BOOKMARKS</div>
                <div class="text-4xl font-bold text-ocean-600">{{ $bookmarkCount ?? 0 }}</div>
                <p class="text-sm text-gray-600 mt-2">Saved items</p>
            </div>

            <!-- Likes Card -->
            <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-6 animate-fade">
                <div class="text-eco-500 text-sm font-semibold mb-2">LIKES</div>
                <div class="text-4xl font-bold text-ocean-600">{{ $likeCount ?? 0 }}</div>
                <p class="text-sm text-gray-600 mt-2">Contributions</p>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-8 max-w-2xl">
            <h2 class="text-2xl font-bold text-ocean-900 mb-6">Profile Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Name</p>
                    <p class="text-lg font-semibold text-ocean-900">{{ auth()->user()->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-2">Email</p>
                    <p class="text-lg font-semibold text-ocean-900">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('profile.show') }}" class="btn btn-outline btn-sm">View Profile</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
