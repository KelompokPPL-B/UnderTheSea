@extends('layouts.app')

@section('content')
<div class="py-8 sm:py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Create Fish</h1>
                    <p class="text-sm sm:text-base text-gray-600">Add fish species information to the collection</p>
                </div>

                <form method="POST" action="{{ route('ikan.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Fish Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Enter fish name">
                        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Scientific Name</label>
                        <input type="text" name="scientific_name" value="{{ old('scientific_name') }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter scientific name">
                        @error('scientific_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Habitat *</label>
                        <input type="text" name="habitat" value="{{ old('habitat') }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('habitat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Enter fish habitat">
                        @error('habitat')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Description *</label>
                        <textarea name="description" rows="4" required class="w-full px-4 py-2 border-2 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Describe the fish characteristics">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Food / Diet</label>
                        <input type="text" name="diet" value="{{ old('diet') }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter fish food or diet">
                        @error('diet')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Size</label>
                        <input type="text" name="size" value="{{ old('size') }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter fish size">
                        @error('size')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Conservation Status</label>
                        <input type="text" name="conservation_status" value="{{ old('conservation_status') }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter conservation status">
                        @error('conservation_status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Image</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">JPG, PNG (Max 2MB)</p>
                        @error('image')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-medium disabled:opacity-50 disabled:cursor-not-allowed">Create Fish</button>
                        <a href="{{ route('ikan.index') }}" class="flex-1 text-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
