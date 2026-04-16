<nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
    <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
    @foreach($breadcrumbs as $breadcrumb)
        <span class="text-gray-400">/</span>
        @if(isset($breadcrumb['url']))
            <a href="{{ $breadcrumb['url'] }}" class="hover:text-blue-600">{{ $breadcrumb['label'] }}</a>
        @else
            <span class="text-gray-900 font-medium">{{ $breadcrumb['label'] }}</span>
        @endif
    @endforeach
</nav>
