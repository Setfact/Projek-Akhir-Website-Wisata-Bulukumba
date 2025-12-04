<x-app-layout>
    @push('meta')
        <meta name="description" content="{{ Str::limit(strip_tags($article->content), 150) }}">
        <meta name="keywords" content="{{ $article->title }}, blog wisata bulukumba, {{ $article->category }}">
    @endpush
    <div class="bg-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center">
                <p class="text-base font-semibold tracking-wide text-blue-600 uppercase">{{ $article->category }}</p>
                <h1 class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">{{ $article->title }}</h1>
                <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Ditulis oleh {{ $article->user->name }} pada {{ $article->created_at->format('d M Y') }}</p>
            </div>
            
            <div class="mt-10">
                <img class="w-full rounded-lg shadow-lg object-cover h-96" src="{{ $article->image_url ? Storage::url($article->image_url) : 'https://via.placeholder.com/800x400' }}" alt="{{ $article->title }}">
            </div>

            <div class="mt-10 prose prose-blue prose-lg text-gray-500 mx-auto">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
</x-app-layout>
