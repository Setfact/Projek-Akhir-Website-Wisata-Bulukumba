<x-app-layout>
    <div class="bg-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto text-center">
            <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">Pemesanan Berhasil!</h2>
            <p class="mt-2 text-lg text-gray-500">
                Terima kasih telah memesan tiket. Admin kami akan memverifikasi pembayaran Anda secepatnya.
            </p>
            <div class="mt-8">
                <a href="{{ route('history.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Lihat Riwayat Pemesanan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
