<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Pendapatan</h3>
            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Pesanan</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Pengguna</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Destinasi</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalDestinations }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Grafik Penjualan (Placeholder)</h3>
        <div class="h-64 bg-gray-100 flex items-center justify-center text-gray-400">
            [Grafik Penjualan akan ditampilkan di sini]
        </div>
    </div>
</x-admin-layout>
