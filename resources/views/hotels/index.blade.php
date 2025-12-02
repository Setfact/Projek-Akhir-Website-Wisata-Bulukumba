<x-app-layout>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Penginapan Populer</h2>
            <p class="text-muted">Istirahat nyaman di hotel terbaik Bulukumba</p>
        </div>

        <div class="row">
            @forelse($hotels as $hotel)
            <div class="col-12 col-md-4 mb-4">
                {{-- Card dengan style Overlay (Teks di atas gambar) --}}
                <div class="card h-100 border-0 shadow text-white overflow-hidden">
                    
                    {{-- Gambar sebagai background penuh --}}
                    <img src="{{ $hotel->image_url ? asset('storage/'.$hotel->image_url) : 'https://placehold.co/600x800?text='.urlencode($hotel->name) }}" 
                         class="card-img w-100 h-100" 
                         style="object-fit: cover; height: 400px;" 
                         alt="{{ $hotel->name }}">

                    {{-- Lapisan Gelap (Overlay) agar teks terbaca --}}
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-4" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.5), transparent);">
                        
                        {{-- Nama & Lokasi --}}
                        <h4 class="card-title fw-bold mb-0">{{ $hotel->name }}</h4>
                        <p class="mb-3 text-warning"><i class="fas fa-map-marker-alt me-1"></i> {{ $hotel->location }}</p>
                        
                        {{-- Deskripsi Singkat (Opsional, kalau mau dihapus boleh) --}}
                        <p class="card-text small text-white-50 mb-3">{{ Str::limit($hotel->description, 60) }}</p>

                        {{-- Harga & Tombol --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="d-block text-white-50" style="font-size: 0.8rem;">Mulai dari</small>
                                <span class="fw-bold fs-5">Rp {{ number_format($hotel->price_per_night, 0, ',', '.') }}</span>
                            </div>
                            
                            {{-- Tombol Pesan WA --}}
                            <a href="https://wa.me/6285792881853?text=Halo%20Admin,%20saya%20mau%20tanya%20ketersediaan%20kamar%20di%20{{ urlencode($hotel->name) }}" 
                               target="_blank" 
                               class="btn btn-light fw-bold rounded-pill px-3 text-primary">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-hotel fa-3x text-secondary"></i>
                </div>
                <h4 class="text-muted">Belum ada data penginapan.</h4>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>