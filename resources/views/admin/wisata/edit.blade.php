<x-admin-layout>
    <x-slot name="header">
        Edit Destinasi
    </x-slot>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <form action="{{ route('admin.wisata.update', $wisatum->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Destinasi</label>
                    <input type="text" name="name" value="{{ $wisatum->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ $wisatum->description }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" value="{{ $wisatum->location }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                    <input type="number" name="price" value="{{ $wisatum->price }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                    <input type="url" name="map_url" value="{{ $wisatum->map_url }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Utama (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="image" class="mt-1 block w-full">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="promoted" id="promoted" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ $wisatum->promoted ? 'checked' : '' }}>
                    <label for="promoted" class="ml-2 block text-sm text-gray-900">Promosikan di Beranda</label>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
