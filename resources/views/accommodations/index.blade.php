<x-app-layout>
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Daftar Penginapan</h2>
                <p class="mt-4 text-lg text-gray-500">Temukan tempat istirahat terbaik di sekitar destinasi wisata.</p>
            </div>

            <div class="mt-10 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($hotels as $hotel)
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ $hotel->image_url ? Storage::url($hotel->image_url) : 'https://via.placeholder.com/400x300' }}" alt="{{ $hotel->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900">{{ $hotel->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $hotel->location }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-blue-600 font-bold">Rp {{ number_format($hotel->price_per_night, 0, ',', '.') }} / malam</span>
                                <a href="{{ route('accommodations.show', $hotel->slug) }}" class="text-sm text-blue-500 hover:underline">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $hotels->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
