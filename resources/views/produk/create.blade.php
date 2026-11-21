@extends('layouts.master')

@section('title', 'PoolPlay - Tambah Produk Baru')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-4 p-4">
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="fw-bold mb-0" style="color: #023E8A;">Tambah Produk Baru</h4>
                    <a href="{{ route('produk.semua') }}" class="btn btn-outline-secondary btn-sm">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Tambah Produk -->
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" 
                               class="form-control" 
                               id="nama_produk" 
                               name="nama_produk" 
                               placeholder="Contoh: Swimming Goggles Pro" 
                               required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" selected disabled>-- Pilih Kategori --</option>
                            <option value="Kaca Mata Renang">Kaca Mata Renang</option>
                            <option value="Baju Renang">Baju Renang</option>
                            <option value="Swim Cap">Swim Cap</option>
                            <option value="Ear Plug">Ear Plug</option>
                            <option value="Aksesoris Lainnya">Aksesoris Lainnya</option>
                        </select>
                    </div>

                    <!-- Harga & Stok -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="harga" 
                                   name="harga" 
                                   placeholder="150000" 
                                   min="0" 
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label for="stok" class="form-label fw-semibold">Stok Produk</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stok" 
                                   name="stok" 
                                   placeholder="10" 
                                   min="0" 
                                   required>
                        </div>
                    </div>

                    <!-- Upload Foto Gambar -->
                    <div class="mb-3">
                        <label for="gambar" class="form-label fw-semibold">Foto Produk</label>
                        <input type="file" 
                               class="form-control" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/*">
                        <small class="text-muted">Pilih gambar fisik (JPG, PNG, WebP) untuk diunggah.</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Produk</label>
                        <textarea class="form-control" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="3" 
                                  placeholder="Tuliskan deskripsi lengkap produk di sini..."></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-2 fw-semibold" style="background-color: #0077B6; border: none;">
                            Simpan Produk
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection