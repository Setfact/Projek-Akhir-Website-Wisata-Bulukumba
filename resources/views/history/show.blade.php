<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Detail Tiket #{{ $order->id }}</h2>
                        @if($order->status === 'paid')
                            <a href="{{ route('invoice.download', $order->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Download Invoice
                            </a>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informasi Pemesanan</h3>
                            <dl class="mt-2 text-sm text-gray-600">
                                <div class="flex justify-between py-1">
                                    <dt>Destinasi:</dt>
                                    <dd class="font-medium text-gray-900">{{ $order->destination->name }}</dd>
                                </div>
                                <div class="flex justify-between py-1">
                                    <dt>Tanggal Pesan:</dt>
                                    <dd class="font-medium text-gray-900">{{ $order->created_at->format('d M Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between py-1">
                                    <dt>Jumlah Tiket:</dt>
                                    <dd class="font-medium text-gray-900">{{ $order->quantity }}</dd>
                                </div>
                                <div class="flex justify-between py-1">
                                    <dt>Total Harga:</dt>
                                    <dd class="font-medium text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                                </div>
                                <div class="flex justify-between py-1">
                                    <dt>Status:</dt>
                                    <dd class="font-medium {{ $order->status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ ucfirst($order->status) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        @if($order->status === 'paid')
                            <div class="flex flex-col items-center justify-center border-l border-gray-200 pl-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">QR Code Tiket</h3>
                                <!-- Placeholder for QR Code -->
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('tickets.show', $order->id) }}" alt="QR Code">
                                <p class="mt-2 text-xs text-gray-500">Tunjukkan QR Code ini di loket masuk.</p>
                            </div>
                        @elseif($order->status === 'cancelled')
                            <div class="bg-red-50 p-4 rounded-md">
                                <h3 class="text-lg font-medium text-red-800">Pemesanan Dibatalkan</h3>
                                <p class="mt-1 text-sm text-red-700">Alasan: {{ $order->refund_note }}</p>
                            </div>
                        @else
                            <div class="bg-yellow-50 p-4 rounded-md">
                                <h3 class="text-lg font-medium text-yellow-800">Menunggu Verifikasi</h3>
                                <p class="mt-1 text-sm text-yellow-700">Pembayaran Anda sedang diverifikasi oleh admin.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
