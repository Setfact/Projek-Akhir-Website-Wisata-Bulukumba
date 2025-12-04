<x-app-layout>
    @push('meta')
        <meta name="description" content="Phinisi Point - Portal Wisata Terbaik di Bulukumba. Temukan destinasi indah, penginapan nyaman, dan event menarik.">
        <meta name="keywords" content="wisata bulukumba, phinisi point, pantai bira, tanjung bira, hotel bulukumba">
    @endpush
    <!-- Hero Section -->
    <!-- Hero Section -->
    <div class="relative h-[600px]">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="{{ asset('images/hero-bg.jpg') }}" alt="Keindahan Bulukumba">
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 flex flex-col items-center text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Jelajahi Keindahan Bulukumba
            </h1>
            <p class="mt-6 text-xl text-blue-100 max-w-3xl">
                Temukan surga tersembunyi, pantai pasir putih, dan budaya maritim yang memukau di Phinisi Point.
            </p>
            <div class="mt-10">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10">
                    Mulai Petualangan
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Destinations -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Destinasi Populer
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Kunjungi tempat-tempat wisata terbaik yang wajib masuk dalam daftar perjalanan Anda.
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
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
                            <p class="mt-2 text-sm text-gray-500 truncate">{{ $destination->location }}</p>
                            <p class="mt-2 text-base font-semibold text-blue-600">Rp {{ number_format($destination->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-10 text-center">
                <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                    Lihat Semua Destinasi &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Accommodations Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Penginapan Nyaman
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Istirahat dengan tenang di hotel dan homestay terbaik sekitar lokasi wisata.
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($hotels as $hotel)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
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
             <div class="mt-10 text-center">
                <a href="{{ route('accommodations.index') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                    Lihat Semua Penginapan &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Blog Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Artikel & Tips Wisata
                </h2>
            </div>
            <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-3">
                @foreach($articles as $article)
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="{{ $article->image_url ? Storage::url($article->image_url) : 'https://via.placeholder.com/400x300' }}" alt="{{ $article->title }}">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-blue-600">
                                    {{ $article->category }}
                                </p>
                                <a href="{{ route('blogs.show', $article->slug) }}" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">{{ $article->title }}</p>
                                    <p class="mt-3 text-base text-gray-500 line-clamp-3">
                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
             <div class="mt-10 text-center">
                <a href="{{ route('blogs.index') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                    Baca Artikel Lainnya &rarr;
                </a>
            </div>
        </div>
    </div>
</x-app-layout>