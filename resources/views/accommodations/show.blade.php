<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image -->
                <div class="flex flex-col">
                    <div class="w-full aspect-w-1 aspect-h-1">
                        <img src="{{ $hotel->image_url ? Storage::url($hotel->image_url) : 'https://via.placeholder.com/600x400' }}" alt="{{ $hotel->name }}" class="w-full h-full object-center object-cover sm:rounded-lg">
                    </div>
                </div>

                <!-- Info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $hotel->name }}</h1>

                    <div class="mt-3">
                        <p class="text-3xl text-gray-900">Rp {{ number_format($hotel->price_per_night, 0, ',', '.') }} <span class="text-lg text-gray-500 font-normal">/ malam</span></p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 space-y-6">
                            <p>{{ $hotel->description }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Fasilitas</h3>
                        <div class="mt-2 text-sm text-gray-500">
                            {{ $hotel->facilities ?? 'Tidak ada informasi fasilitas.' }}
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Lokasi</h3>
                        <p class="mt-2 text-sm text-gray-500">{{ $hotel->location }}</p>
                        @if($hotel->map_url)
                            <div class="mt-2">
                                <a href="{{ $hotel->map_url }}" target="_blank" class="text-blue-600 hover:underline">Lihat di Google Maps</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
