<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <!-- Kolom Kiri: Gambar, Info, DAN REVIEW -->
            <div class="col-md-8">
                {{-- Gambar Utama --}}
                <div class="card border-0 shadow-sm p-2 mb-4">
                     <img src="{{ $destination->image_url ? asset('storage/'.$destination->image_url) : 'https://placehold.co/800x500?text='.urlencode($destination->name) }}" 
                          class="img-fluid rounded" alt="{{ $destination->name }}">
                </div>
                
                {{-- Judul & Lokasi --}}
                <h1 class="fw-bold text-primary">{{ $destination->name }}</h1>
                <p class="text-muted fs-5"><i class="fas fa-map-marker-alt text-danger"></i> {{ $destination->location }}</p>
                
                {{-- Deskripsi --}}
                <div class="mt-4 bg-white p-4 rounded shadow-sm mb-5">
                    <h5 class="fw-bold mb-3">Tentang Destinasi</h5>
                    <p class="text-secondary" style="line-height: 1.8;">{{ $destination->description }}</p>
                </div>

                {{-- === BAGIAN BARU: REVIEW / TESTIMONI === --}}
                <div class="mt-5">
                    <h3 class="fw-bold mb-4"><i class="fas fa-star text-warning me-2"></i>Ulasan Pengunjung</h3>

                    {{-- 1. Form Input (Hanya jika Login) --}}
                    @auth
                        <div class="card border-0 shadow-sm mb-4 bg-light">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">Tulis Pengalamanmu</h5>
                                <form action="{{ route('reviews.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <select name="rating" class="form-select w-auto" required>
                                            <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                            <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                            <option value="3">⭐⭐⭐ (Cukup)</option>
                                            <option value="2">⭐⭐ (Kurang)</option>
                                            <option value="1">⭐ (Buruk)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="comment" class="form-control" rows="3" placeholder="Ceritakan pengalaman serumu di sini..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill">Kirim Ulasan</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Silakan <a href="{{ route('login') }}" class="fw-bold text-decoration-underline">Login</a> untuk menulis ulasan.
                        </div>
                    @endauth

                    {{-- 2. Daftar Review --}}
                    <div class="review-list">
                        @forelse($destination->reviews as $review)
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        {{-- Bagian Kiri: Nama & Rating --}}
                                        <div>
                                            <h6 class="fw-bold mb-1">
                                                {{ $review->user->name }}
                                                @if(Auth::id() === $review->user_id)
                                                    <span class="badge bg-light text-primary border ms-2">Saya</span>
                                                @endif
                                            </h6>
                                            <div class="text-warning small mb-2">
                                                @for($i=0; $i < $review->rating; $i++) <i class="fas fa-star"></i> @endfor
                                                <span class="text-muted ms-2 text-secondary" style="font-size: 0.8rem;">
                                                    {{ $review->created_at->diffForHumans() }}
                                                    @if($review->created_at != $review->updated_at) (diedit) @endif
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Bagian Kanan: Tombol Aksi (Hanya muncul jika ini review milik user yang login) --}}
                                        @if(Auth::id() === $review->user_id)
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v text-secondary"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    {{-- Tombol Edit (Trigger Modal) --}}
                                                    <li>
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editReviewModal-{{ $review->id }}">
                                                            <i class="fas fa-edit text-warning me-2"></i> Edit
                                                        </button>
                                                    </li>
                                                    {{-- Tombol Hapus --}}
                                                    <li>
                                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    {{-- Isi Komentar --}}
                                    <p class="text-secondary mb-0">{{ $review->comment }}</p>
                                </div>
                            </div>

                            {{-- === MODAL EDIT (POPUP) KHUSUS REVIEW INI === --}}
                            @if(Auth::id() === $review->user_id)
                            <div class="modal fade" id="editReviewModal-{{ $review->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Edit Ulasan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                            @csrf
                                            @method('PUT') {{-- Metode Update --}}
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label>
                                                    <select name="rating" class="form-select">
                                                        <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                                        <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                                        <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                                                        <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐</option>
                                                        <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Komentar</label>
                                                    <textarea name="comment" class="form-control" rows="3" required>{{ $review->comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- === BATAS MODAL === --}}

                        @empty
                            <p class="text-muted text-center py-4">Belum ada ulasan untuk wisata ini. Jadilah yang pertama!</p>
                        @endforelse
                    </div>
                </div>
                {{-- === BATAS AKHIR REVIEW === --}}

            </div>

            <!-- Kolom Kanan: Form Pesan -->
            <div class="col-md-4">
                <div class="card shadow border-0 sticky-top" style="top: 100px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-bold">Pesan Tiket</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center fw-bold text-dark mb-3">
                            Rp {{ number_format($destination->price, 0, ',', '.') }}
                        </h2>
                        <hr>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Orang</label>
                                <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                            </div>

                            @auth
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg fw-bold">
                                        <i class="fas fa-shopping-cart me-2"></i>Beli Tiket
                                    </button>
                                </div>
                            @else
                                <div class="d-grid">
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary fw-bold">Login untuk Memesan</a>
                                </div>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>