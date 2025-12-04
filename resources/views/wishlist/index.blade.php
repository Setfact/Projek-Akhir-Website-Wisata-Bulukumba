<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Wishlist Saya</h2>
                <p class="mt-4 text-lg text-gray-500">Destinasi impian yang ingin Anda kunjungi.</p>
            </div>

            @if($wishlists->count() > 0)
                <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                    @foreach($wishlists as $item)
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                            <div class="flex-shrink-0">
                                <img class="h-48 w-full object-cover" src="{{ $item->destination->image_url ? Storage::url($item->destination->image_url) : 'https://via.placeholder.com/400x300' }}" alt="{{ $item->destination->name }}">
                            </div>
                            <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <a href="{{ route('destinations.show', $item->destination->slug) }}" class="block mt-2">
                                        <p class="text-xl font-semibold text-gray-900">{{ $item->destination->name }}</p>
                                        <p class="mt-3 text-base text-gray-500">{{ Str::limit($item->destination->description, 100) }}</p>
                                    </a>
                                </div>
                                <div class="mt-6 flex items-center justify-between">
                                    <p class="text-lg font-bold text-blue-600">Rp {{ number_format($item->destination->price, 0, ',', '.') }}</p>
                                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="destination_id" value="{{ $item->destination->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $wishlists->links() }}
                </div>
            @else
                <div class="mt-12 text-center">
                    <p class="text-gray-500">Belum ada destinasi di wishlist Anda.</p>
                    <a href="{{ route('destinations.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Jelajahi Destinasi
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
