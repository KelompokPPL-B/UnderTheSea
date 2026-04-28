@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-ocean-50 to-sand min-h-screen">
	<div class="max-w-2xl mx-auto px-6">
		<div class="bg-white rounded-2xl shadow-card p-8">
			<!-- Header -->
			<div class="mb-8">
				<h1 class="text-3xl font-bold text-ocean-900 mb-2">Edit Fish</h1>
				<p class="text-ocean-600">Update the fish information</p>
			</div>

			<form action="{{ route('ikan.update', $ikan->id_ikan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
				@csrf
				@method('PUT')

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Fish Name *</label>
					<input type="text" name="name" value="{{ old('name', $ikan->name) }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Enter fish name">
					@error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
				</div>

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Scientific Name</label>
					<input type="text" name="scientific_name" value="{{ old('scientific_name', $ikan->scientific_name) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter scientific name">
				</div>

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Habitat *</label>
					<input type="text" name="habitat" value="{{ old('habitat', $ikan->habitat) }}" required class="w-full px-4 py-2 border-2 {{ $errors->has('habitat') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Enter fish habitat">
				</div>

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Description *</label>
					<textarea name="description" rows="4" required class="w-full px-4 py-2 border-2 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-200' }} rounded-lg" placeholder="Describe the fish characteristics">{{ old('description', $ikan->description) }}</textarea>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label class="block text-sm font-semibold text-ocean-900 mb-2">Diet</label>
						<input type="text" name="diet" value="{{ old('diet', $ikan->diet) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter fish food or diet">
					</div>
					<div>
						<label class="block text-sm font-semibold text-ocean-900 mb-2">Size</label>
						<input type="text" name="size" value="{{ old('size', $ikan->size) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter fish size">
					</div>
				</div>

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Conservation Status</label>
					<input type="text" name="conservation_status" value="{{ old('conservation_status', $ikan->conservation_status) }}" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg" placeholder="Enter conservation status">
				</div>

				<div>
					<label class="block text-sm font-semibold text-ocean-900 mb-2">Image</label>
					@if($ikan->image)
						<img src="{{ asset('storage/' . $ikan->image) }}" alt="{{ $ikan->name }}" class="w-48 h-32 object-cover mb-3">
					@endif
					<input type="file" name="image" accept="image/jpeg,image/png,image/jpg" class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg">
					<p class="text-sm text-gray-500 mt-1">Upload to replace existing image (JPG, PNG, Max 2MB)</p>
				</div>

				<div class="flex gap-3 pt-6 border-t border-ocean-100">
					<button type="submit" class="flex-1 px-6 py-3 bg-[#42A5F5] hover:bg-[#1E88E5] text-white rounded-lg text-sm font-medium transition duration-200">Update Fish</button>
					<a href="{{ route('ikan.show', $ikan->id_ikan) }}" class="flex-1 text-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
*** End Patch
