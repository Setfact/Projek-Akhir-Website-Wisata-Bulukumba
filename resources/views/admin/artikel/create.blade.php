<x-admin-layout>
    <x-slot name="header">
        Tambah Artikel
    </x-slot>

    <div class="bg-white shadow sm:rounded-lg p-6">
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Artikel</label>
                    <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="Event">Event</option>
                        <option value="Kuliner">Kuliner</option>
                        <option value="Sejarah">Sejarah</option>
                        <option value="Tips">Tips</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Konten</label>
                    <textarea name="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar Utama</label>
                    <input type="file" name="image" class="mt-1 block w-full" required>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
