<x-app-layout>
    @push('meta')
        <meta name="description" content="{{ Str::limit($destination->description, 150) }}">
        <meta name="keywords" content="{{ $destination->name }}, wisata bulukumba, tiket {{ $destination->name }}">
    @endpush
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image gallery -->
                <div class="flex flex-col">
                    <div class="w-full aspect-w-1 aspect-h-1">
                        <img src="{{ $destination->image_url ? Storage::url($destination->image_url) : 'https://via.placeholder.com/600x400' }}" alt="{{ $destination->name }}" class="w-full h-full object-center object-cover sm:rounded-lg">
                    </div>
                    <!-- Gallery thumbnails (if any) -->
                    @if($destination->gallery)
                        <div class="mt-4 grid grid-cols-4 gap-2">
                             <!-- Implement loop for gallery images here -->
                        </div>
                    @endif
                </div>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $destination->name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl text-gray-900">Rp {{ number_format($destination->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Reviews -->
                    <div class="mt-3">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                @php
                                    $rating = $destination->reviews->avg('rating') ?? 0;
                                @endphp
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="{{ $rating > $i ? 'text-yellow-400' : 'text-gray-300' }} h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="sr-only">{{ $rating }} out of 5 stars</p>
                            <span class="ml-3 text-sm font-medium text-blue-600 hover:text-blue-500">{{ $destination->reviews->count() }} reviews</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 space-y-6">
                            <p>{{ $destination->description }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Lokasi</h3>
                        <p class="mt-2 text-sm text-gray-500">{{ $destination->location }}</p>
                        @if($destination->map_url)
                            <div class="mt-2">
                                <a href="{{ $destination->map_url }}" target="_blank" class="text-blue-600 hover:underline">Lihat di Google Maps</a>
                            </div>
                        @endif
                    </div>

                    <div class="mt-10 flex sm:flex-col1">
                        <form action="{{ route('booking.create', $destination->slug) }}" method="GET">
                            <button type="submit" class="max-w-xs flex-1 bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500 sm:w-full">
                                Pesan Tiket Sekarang
                            </button>
                        </form>
                        
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="ml-4 flex items-center justify-center py-3 px-3 rounded-md flex-shrink-0 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                            <button type="submit" class="flex items-center justify-center w-full h-full">
                                <svg class="h-6 w-6 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="sr-only">Add to wishlist</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="mt-16 border-t border-gray-200 pt-10">
                <h3 class="text-2xl font-bold text-gray-900">Ulasan Pengunjung</h3>
                
                @auth
                    <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                        <h4 class="text-lg font-medium text-gray-900">Tulis Ulasan Anda</h4>
                        
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Rating</label>
                                <select name="rating" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="5">5 Bintang - Luar Biasa</option>
                                    <option value="4">4 Bintang - Sangat Bagus</option>
                                    <option value="3">3 Bintang - Bagus</option>
                                    <option value="2">2 Bintang - Cukup</option>
                                    <option value="1">1 Bintang - Buruk</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Komentar</label>
                                <textarea name="comment" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Bagikan pengalaman Anda..."></textarea>
                            </div>
                            
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @endauth
                
                <div class="mt-8 space-y-8">
                    @foreach($destination->reviews as $review)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900">{{ $review->user->name }}</h4>
                                <div class="mt-1 flex items-center">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="{{ $review->rating > $i ? 'text-yellow-400' : 'text-gray-300' }} h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                                
                                @if(Auth::id() === $review->user_id)
                                    <div class="mt-2 flex space-x-2">
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>