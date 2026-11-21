@extends('layouts.master')

@section('title', 'PoolPlay - Kelola Inventaris')

@section('content')
<div class="container py-5">

    <!-- HEADER INVENTARIS & TOMBOL TAMBAH -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #023E8A;">Kelola Inventaris Produk</h3>
            <p class="text-muted mb-0">Halaman manajemen internal untuk tambah, edit, dan hapus stok barang.</p>
        </div>
        <a href="{{ route('produk.create') }}" class="btn btn-primary px-3 fw-semibold" style="background-color: #0077B6; border: none;">
            + Tambah Produk Baru
        </a>
    </div>

    <hr class="mb-5" style="color: #00B4D8; opacity: 0.2;">

    <!-- GRID CARD PRODUK (ADA TOMBOL EDIT & HAPUS) -->
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

                        <!-- TOMBOL AKSI ADMIN (DETAIL, EDIT, DELETE) -->
                        <div class="pt-2 border-top d-flex justify-content-between align-items-center">
                            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                Detail
                            </a>
                            
                            <div class="d-flex gap-1">
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">
                                    Edit
                                </a>
                                
                                <form action="{{ route('produk.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="fw-bold text-secondary">Belum ada barang di inventaris</h5>
                <p class="text-muted">Klik tombol "+ Tambah Produk Baru" di atas untuk menambahkan barang pertama.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection