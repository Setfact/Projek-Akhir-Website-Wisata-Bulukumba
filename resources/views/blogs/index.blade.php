<x-app-layout>
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Blog Wisata</h2>
                <p class="mt-4 text-lg text-gray-500">Informasi terbaru seputar event, kuliner, dan tips perjalanan.</p>
            </div>

            <div class="mt-10 grid gap-8 grid-cols-1 md:grid-cols-3">
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

            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
