<x-app-layout>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay text-center">
            <div>
                <h1 class="display-3 fw-bold text-white mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.6);">
                    Liburan Impian di Bulukumba
                </h1>
                <p class="lead text-white fs-4 mb-4" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.6);">
                    Surga Tersembunyi di Sulawesi Selatan
                </p>
            </div>
        </div>
    </div>

    <!-- Search Box (Visual Only) -->
    <div class="container" style="margin-top: -40px; position: relative; z-index: 10;">
        <div class="card shadow border-0 p-4 rounded-3">
            <div class="row g-2">
                <div class="col-md-10">
                    <input type="text" class="form-control form-control-lg border-0 bg-light" placeholder="Cari Destinasi...">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-lg w-100 fw-bold">Cari</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. BAGIAN DESTINASI POPULER -->
    <div class="container my-5 pt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Destinasi Populer</h2>
        </div>
        
        <div class="row">
            @foreach($destinations as $dest)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow text-white overflow-hidden">
                    {{-- Gambar Destinasi --}}
                    <img src="{{ $dest->image_url ? asset('storage/'.$dest->image_url) : 'https://placehold.co/600x400?text='.urlencode($dest->name) }}" 
                         class="card-img w-100 h-100" 
                         style="object-fit: cover; height: 300px;" 
                         alt="{{ $dest->name }}">

                    {{-- Overlay Teks --}}
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-4" 
                         style="background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        
                        <h4 class="card-title fw-bold mb-0">{{ $dest->name }}</h4>
                        <p class="small text-warning mb-3"><i class="fas fa-map-marker-alt me-1"></i> {{ $dest->location }}</p>
                        
                        <div>
                            <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-sm btn-light fw-bold text-primary">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 2. BAGIAN PENGINAPAN PILIHAN -->
    <div class="container my-5 pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Penginapan Pilihan</h2>
            <a href="{{ route('hotels.index') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua</a>
        </div>
        
        <div class="row">
            @foreach($hotels as $hotel)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    {{-- Gambar Hotel --}}
                    <div class="position-relative" style="height: 250px;">
                        <img src="{{ $hotel->image_url ? asset('storage/'.$hotel->image_url) : 'https://placehold.co/600x400?text='.urlencode($hotel->name) }}" 
                             class="w-100 h-100" 
                             style="object-fit: cover;" 
                             alt="{{ $hotel->name }}">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white px-3 py-1 rounded-end mb-3">
                            Rp {{ number_format($hotel->price_per_night, 0, ',', '.') }} /malam
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $hotel->name }}</h5>
                        <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $hotel->location }}</p>
                        <p class="card-text text-secondary small">{{ Str::limit($hotel->description, 80) }}</p>
                        
                        <div class="d-grid mt-3">
                            <a href="https://wa.me/6285792881853?text=Halo%20Admin,%20info%20kamar%20{{ urlencode($hotel->name) }}" 
                               target="_blank" 
                               class="btn btn-outline-success btn-sm rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-1"></i> Pesan via WA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>