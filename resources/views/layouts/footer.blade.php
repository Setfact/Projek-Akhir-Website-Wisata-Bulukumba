<footer class="bg-gray-800 text-white py-8 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-bold mb-4">Phinisi Point</h3>
                <p class="text-gray-400">
                    Platform pariwisata digital terbaik untuk mengeksplorasi keindahan Kabupaten Bulukumba.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="text-gray-400 hover:text-white">Destinasi</a></li>
                    <li><a href="{{ route('accommodations.index') }}" class="text-gray-400 hover:text-white">Penginapan</a></li>
                    <li><a href="{{ route('blogs.index') }}" class="text-gray-400 hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-4">Kontak</h3>
                <p class="text-gray-400">Jl. Phinisi No. 1, Bulukumba</p>
                <p class="text-gray-400">info@phinisipoint.com</p>
                <p class="text-gray-400">+62 812 3456 7890</p>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            &copy; {{ date('Y') }} Phinisi Point. All rights reserved.
        </div>
    </div>
</footer>
