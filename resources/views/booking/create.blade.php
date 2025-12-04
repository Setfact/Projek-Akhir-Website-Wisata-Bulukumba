<x-app-layout>
    <div class="bg-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Form Pemesanan Tiket
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        {{ $destination->name }}
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900" id="price" data-price="{{ $destination->price }}">
                                Rp {{ number_format($destination->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Tiket</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                            <p class="mt-1 text-2xl font-bold text-blue-600" id="total">
                                Rp {{ number_format($destination->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                            <div class="mt-2 p-4 bg-gray-50 rounded-md">
                                <p class="text-sm text-gray-600">Silakan transfer ke rekening berikut:</p>
                                <p class="font-bold text-gray-900 mt-1">Bank BRI: 1234-5678-9012-3456 (a.n Phinisi Point)</p>
                            </div>
                        </div>

                        <div>
                            <label for="payment_proof" class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        </div>

                        <div class="pt-5">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Konfirmasi Pemesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const price = {{ $destination->price }};
        const quantityInput = document.getElementById('quantity');
        const totalElement = document.getElementById('total');

        quantityInput.addEventListener('input', function() {
            const quantity = this.value;
            const total = price * quantity;
            totalElement.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        });
    </script>
</x-app-layout>
