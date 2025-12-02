<x-app-layout>
    <div class="container py-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="fw-bold mb-4 text-primary"><i class="fas fa-ticket-alt me-2"></i>Tiket Saya</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Destinasi</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th class="text-end">pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="fw-bold">#{{ $order->id }}</td>
                                <td>
                                    @if($order->destination)
                                        <span class="fw-bold text-dark">{{ $order->destination->name }}</span><br>
                                        <small class="text-muted">{{ $order->quantity }} orang</small>
                                    @else
                                        <span class="text-danger">Destinasi dihapus</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 'paid')
                                        <span class="badge bg-success rounded-pill px-3 py-2">Lunas</span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Menunggu Bayar</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger rounded-pill px-3 py-2">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    {{-- TOMBOL WHATSAPP --}}
                                    @if($order->status == 'pending')
                                        @php
                                            $phone = '6285792881853'; 
                                            $destinasi = $order->destination ? $order->destination->name : 'Wisata';
                                            $total = number_format($order->total_price, 0, ',', '.');
                                            
                                            $message = "Halo Admin, saya ingin konfirmasi pembayaran untuk:\n\n";
                                            $message .= "No Order: #{$order->id}\n";
                                            $message .= "Wisata: {$destinasi}\n";
                                            $message .= "Total: Rp {$total}\n\n";
                                            $message .= "Mohon info nomor rekeningnya. Terima kasih.";
                                            
                                            $wa_link = "https://wa.me/{$phone}?text=" . urlencode($message);
                                        @endphp

                                        <a href="{{ $wa_link }}" target="_blank" class="btn btn-success fw-bold btn-sm">
                                            <i class="fab fa-whatsapp me-1"></i> Bayar Sekarang
                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Selesai</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted">Belum ada tiket yang dipesan.</p>
                                    <a href="{{ route('home') }}" class="btn btn-primary fw-bold px-4 rounded-pill">Mulai Cari Wisata</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>