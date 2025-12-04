<x-admin-layout>
    <x-slot name="header">
        Detail Transaksi #{{ $order->id }}
    </x-slot>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informasi Pesanan</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detail pesanan dan bukti pembayaran.</p>
            </div>
            <div>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $order->status === 'paid' ? 'bg-green-100 text-green-800' : 
                       ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nama Pemesan</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->user->name }} ({{ $order->user->email }})</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Destinasi</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->destination->name }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Jumlah Tiket</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->quantity }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Total Harga</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Bukti Pembayaran</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($order->payment_proof)
                            <img src="{{ Storage::url($order->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-md rounded-lg shadow-sm">
                        @else
                            <span class="text-red-500">Tidak ada bukti pembayaran</span>
                        @endif
                    </dd>
                </div>
                @if($order->status === 'pending')
                    <div class="bg-white px-4 py-5 sm:px-6 flex space-x-4">
                        <form action="{{ route('admin.transaksi.verify', $order->id) }}" method="POST" onsubmit="return confirm('Verifikasi pembayaran ini?')">
                            @csrf
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Verifikasi Pembayaran
                            </button>
                        </form>
                        
                        <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Tolak Pembayaran
                        </button>
                    </div>
                    
                    <div id="reject-form" class="hidden bg-gray-50 px-4 py-5 sm:px-6 border-t border-gray-200">
                        <form action="{{ route('admin.transaksi.reject', $order->id) }}" method="POST">
                            @csrf
                            <div>
                                <label for="refund_note" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                                <textarea name="refund_note" id="refund_note" rows="3" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Konfirmasi Penolakan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </dl>
        </div>
    </div>
</x-admin-layout>
