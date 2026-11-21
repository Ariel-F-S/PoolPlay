@extends('layouts.master')

@section('title', 'PoolPlay - Katalog Produk')

@section('content')
<div class="container py-5">

    <!-- HEADER & PENCARIAN -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h3 class="fw-bold mb-1" style="color: #023E8A;">Katalog Perlengkapan Renang</h3>
            <p class="text-muted mb-0">Temukan perlengkapan renang terbaik untuk kebutuhanmu.</p>
        </div>
        
        <div class="col-md-6">
            <form action="{{ route('produk.cari') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="keyword" class="form-control" placeholder="Cari nama atau kategori..." value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-primary px-4" style="background-color: #0077B6; border: none;">Cari</button>
                @if(request('keyword'))
                    <a href="{{ route('produk.semua') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>
    </div>

    <hr class="mb-5" style="color: #00B4D8; opacity: 0.2;">

    <!-- GRID CARD PRODUK -->
    <div class="row g-4">
        @forelse($dataProduk as $item)
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    
                    <div class="product-img-wrapper">
                        @if($item->gambar && file_exists(public_path('uploads/' . $item->gambar)))
                            <img src="{{ asset('uploads/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                        @elseif($item->gambar && file_exists(public_path($item->gambar)))
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_produk }}">
                        @else
                            <span class="emoji-icon">🥽</span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="text-muted fw-semibold">{{ $item->kategori }}</small>
                                <span class="badge bg-light text-dark border">Stok: {{ $item->stok }}</span>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $item->nama_produk }}</h5>
                            <p class="fw-bold mb-3" style="color: #0077B6; font-size: 1.1rem;">
                                Rp{{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- HANYA TOMBOL DETAIL -->
                        <div class="pt-2 border-top d-grid">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-outline-info btn-sm fw-semibold">
                                Lihat Detail Produk
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                
                <h5 class="fw-bold mt-3 text-secondary">Produk Tidak Ditemukan</h5>
                <p class="text-muted">Coba kata kunci pencarian lainnya.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection