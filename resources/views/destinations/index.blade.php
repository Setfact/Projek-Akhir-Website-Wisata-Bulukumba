<x-app-layout>
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Semua Destinasi Wisata</h2>
                <p class="mt-4 text-lg text-gray-500">Jelajahi setiap sudut keindahan Bulukumba.</p>
            </div>

            <div class="mt-10 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($destinations as $destination)
                    <div class="group relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="aspect-w-3 aspect-h-2 bg-gray-200 group-hover:opacity-75">
                            <img src="{{ $destination->image_url ? Storage::url($destination->image_url) : 'https://via.placeholder.com/400x300' }}" alt="{{ $destination->name }}" class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900">
                                <a href="{{ route('destinations.show', $destination->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $destination->name }}
                                </a>
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">{{ $destination->location }}</p>
                            <p class="mt-2 text-base font-semibold text-blue-600">Rp {{ number_format($destination->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $destinations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
