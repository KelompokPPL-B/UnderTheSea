@extends('layouts.app')

@section('content')
<!-- PBI-Profile -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-4xl mx-auto px-6 py-6">
        <h1 class="text-4xl font-bold text-ocean-900 mb-10">{{ auth()->user()->name }}'s Profile</h1>

        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Information -->
                <div>
                    <h3 class="text-xl font-bold text-ocean-900 mb-6">Information</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">NAME</p>
                            <p class="text-lg text-ocean-900 font-medium">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">EMAIL</p>
                            <p class="text-lg text-ocean-900 font-medium">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">ROLE</p>
                            <p class="text-lg text-ocean-900 font-medium">
                                <span class="badge badge-{{ auth()->user()->isAdmin() ? 'error' : 'info' }}">{{ ucfirst(auth()->user()->role) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div>
                    <h3 class="text-xl font-bold text-ocean-900 mb-6">Statistics</h3>
                    <div class="space-y-4">
                        <div class="p-6 bg-gradient-to-br from-ocean-50 to-ocean-100 rounded-xl border border-ocean-200">
                            <p class="text-sm text-ocean-700 font-semibold mb-2">POINTS</p>
                            <p class="text-3xl font-bold text-ocean-600">{{ auth()->user()->points }}</p>
                        </div>
                        <div class="p-6 bg-gradient-to-br from-eco-100 to-eco-50 rounded-xl border border-eco-300">
                            <p class="text-sm text-eco-700 font-semibold mb-2">BADGE</p>
                            <p class="text-2xl font-bold text-eco-700">{{ auth()->user()->badge }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-10 pt-8 border-t border-gray-200 flex gap-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
