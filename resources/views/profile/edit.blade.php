@extends('layouts.app')

@section('content')
<!-- PBI-ProfileEdit -->
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand">
    <div class="max-w-2xl mx-auto px-6 py-6">
        <h1 class="text-4xl font-bold text-ocean-900 mb-10">Edit Profile</h1>

        <div class="bg-white rounded-2xl shadow-card hover:shadow-hover transition p-8">
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-bold text-ocean-900 mb-3">NAME</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="input input-bordered w-full" required>
                    @error('name')
                        <p class="text-error text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-ocean-900 mb-3">EMAIL</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="input input-bordered w-full" required>
                    @error('email')
                        <p class="text-error text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 border-t border-gray-200 flex gap-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('profile.show') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
