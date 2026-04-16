@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-8 text-center">
                <div class="mb-6">
                    <div class="text-6xl font-bold text-red-600 mb-4">500</div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Server Error</h1>
                    <p class="text-gray-600 text-lg">Something went wrong on our end. We're working to fix it.</p>
                </div>

                <div class="space-y-4">
                    <p class="text-gray-500">Please try again or go back to:</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Go to Home
                        </a>
                        <a href="javascript:history.back()" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">
                            Go Back
                        </a>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-500">If this problem persists, please contact support.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
