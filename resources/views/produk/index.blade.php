@extends('layouts.master')

@section('title', 'PoolPlay - Toko Perlengkapan Renang')

@section('content')

<!-- HERO / CAROUSEL BANNER -->
<br>
<div id="carouselExample" class="carousel carousel-dark slide" data-bs-ride="true" data-bs-interval="3000">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('1.jpg') }}" class="d-block w-100 carousel-img" alt="poolplay">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('2.jpg') }}" class="d-block w-100 carousel-img" alt="poolplay">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('3.jpg') }}" class="d-block w-100 carousel-img" alt="poolplay">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- PRODUK TERBARU (DINAMIS DARI DATABASE) -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <p class="fw-semibold mb-1" style="color: #00B4D8;">
                PoolPlay
            </p>
            <h2 class="fw-bold">
                Produk Terbaru
            </h2>
            <p class="text-muted">
                Temukan perlengkapan renang yang sesuai dengan kebutuhanmu.
            </p>
        </div>

        <div class="row g-4">
            @forelse($dataProduk as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        
                        <!-- WADAH GAMBAR PRODUK -->
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
                                <small class="text-muted fw-semibold">{{ $item->kategori }}</small>
                                <h5 class="fw-bold mt-1 text-dark">{{ $item->nama_produk }}</h5>
                            </div>
                            <div class="pt-2 border-top mt-2 d-flex justify-content-between align-items-center">
                                <p class="fw-bold mb-0" style="color: #0077B6;">
                                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                    Detail
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Belum ada produk yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

        <!-- TOMBOL "LIHAT SEMUA PRODUK" -->
        <div class="text-center mt-5">
            <a href="{{ route('produk.semua') }}" class="btn btn-outline-primary px-4 py-2">
                Lihat Semua Produk
            </a>
        </div>

    </div>
</section>


<!-- SECTION KATEGORI (KLIK LANGSUNG FILTER BARANG) -->
<section class="py-5" style="background-color: #F1FAFC;">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">
                Pilih Berdasarkan Kategori
            </h2>
            <p class="text-muted">
                Temukan perlengkapan renang sesuai kebutuhanmu.
            </p>
        </div>

        <div class="row g-4 justify-content-center text-center">

            <!-- Kaca Mata Renang -->
            <div class="col-6 col-md-3">
                <a href="{{ route('produk.cari', ['keyword' => 'Kaca Mata Renang']) }}" class="text-decoration-none">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 card-kategori">
                        <div style="font-size: 50px;">🥽</div>
                        <h6 class="fw-bold mt-3 mb-0 text-dark">Kaca Mata Renang</h6>
                    </div>
                </a>
            </div>

            <!-- Baju Renang -->
            <div class="col-6 col-md-3">
                <a href="{{ route('produk.cari', ['keyword' => 'Baju Renang']) }}" class="text-decoration-none">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 card-kategori">
                        <div style="font-size: 50px;">🩱</div>
                        <h6 class="fw-bold mt-3 mb-0 text-dark">Baju Renang</h6>
                    </div>
                </a>
            </div>

            <!-- Swim Cap -->
            <div class="col-6 col-md-3">
                <a href="{{ route('produk.cari', ['keyword' => 'Swim Cap']) }}" class="text-decoration-none">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 card-kategori">
                        <div style="font-size: 50px;">🧢</div>
                        <h6 class="fw-bold mt-3 mb-0 text-dark">Swim Cap</h6>
                    </div>
                </a>
            </div>

            <!-- Ear Plug -->
            <div class="col-6 col-md-3">
                <a href="{{ route('produk.cari', ['keyword' => 'Ear Plug']) }}" class="text-decoration-none">
                    <div class="bg-white rounded-4 shadow-sm p-4 h-100 card-kategori">
                        <div style="font-size: 50px;">👂</div>
                        <h6 class="fw-bold mt-3 mb-0 text-dark">Ear Plug</h6>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>


<!-- FOOTER CTA -->
<section class="py-5 text-center text-white" style="background-color: #023E8A;">
    <div class="container">
        <h2 class="fw-bold">
            Siap Melengkapi Perlengkapan Renangmu?
        </h2>
        <p class="mb-4">
            Jelajahi berbagai produk renang yang tersedia di PoolPlay.
        </p>
        <a href="{{ route('produk.semua') }}" class="btn btn-light px-4">
            Lihat Semua Produk
        </a>
    </div>
</section>

@endsection