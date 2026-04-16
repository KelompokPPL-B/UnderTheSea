<footer class="bg-gray-800 text-gray-300 py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white font-semibold mb-4">About</h3>
                <p class="text-sm">Under The Sea is an educational platform dedicated to marine biodiversity and ocean conservation.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-400">Home</a></li>
                    <li><a href="{{ route('ikan.index') }}" class="hover:text-blue-400">Fish Species</a></li>
                    <li><a href="{{ route('ekosistem.index') }}" class="hover:text-blue-400">Ecosystems</a></li>
                    <li><a href="{{ route('aksi.index') }}" class="hover:text-blue-400">Conservation Actions</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="mailto:info@underthesea.com" class="hover:text-blue-400">Email: info@underthesea.com</a></li>
                    <li class="text-gray-400">© 2026 Under The Sea</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
