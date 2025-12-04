<x-admin-layout>
    <x-slot name="header">
        Edit Penginapan
    </x-slot>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <form action="{{ route('admin.penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Penginapan</label>
                    <input type="text" name="name" value="{{ $penginapan->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ $penginapan->description }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" value="{{ $penginapan->location }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga per Malam</label>
                    <input type="number" name="price_per_night" value="{{ $penginapan->price_per_night }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <textarea name="facilities" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $penginapan->facilities }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Link Google Maps</label>
                    <input type="url" name="map_url" value="{{ $penginapan->map_url }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Utama (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="image" class="mt-1 block w-full">
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
