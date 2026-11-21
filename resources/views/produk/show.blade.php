@extends('layouts.master')

@section('title', 'PoolPlay - Detail ' . $data->nama_produk)

@section('content')
<div class="container py-5">
    
    <a href="{{ route('produk.semua') }}" class="btn btn-outline-secondary mb-4">&larr; Kembali ke Katalog</a>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-4">
        <div class="row g-4 align-items-center">
            
            <!-- GAMBAR PRODUK -->
            <div class="col-md-5">
                <div class="product-img-wrapper rounded-3" style="height: 350px;">
                    @if($data->gambar && file_exists(public_path('uploads/' . $data->gambar)))
                        <img src="{{ asset('uploads/' . $data->gambar) }}" alt="{{ $data->nama_produk }}">
                    @elseif($data->gambar && file_exists(public_path($data->gambar)))
                        <img src="{{ asset($data->gambar) }}" alt="{{ $data->nama_produk }}">
                    @else
                        <span class="emoji-icon" style="font-size: 120px;">🥽</span>
                    @endif
                </div>
            </div>

            <!-- INFORMASI PRODUK & AKSI EDIT/HAPUS -->
            <div class="col-md-7">
                <span class="badge bg-primary mb-2 px-3 py-2">{{ $data->kategori }}</span>
                <h2 class="fw-bold text-dark">{{ $data->nama_produk }}</h2>
                <h3 class="fw-bold my-3" style="color: #0077B6;">
                    Rp{{ number_format($data->harga, 0, ',', '.') }}
                </h3>
                
                <p class="mb-2"><strong>Stok Tersedia:</strong> <span class="badge bg-light text-dark border fs-6">{{ $data->stok }} pcs</span></p>
                
                <div class="my-4">
                    <h6 class="fw-bold text-muted">Deskripsi Produk:</h6>
                    <p class="text-secondary">{{ $data->deskripsi ?? 'Belum ada deskripsi untuk produk ini.' }}</p>
                </div>

                <hr>

            </div>

        </div>
    </div>

</div>
@endsection