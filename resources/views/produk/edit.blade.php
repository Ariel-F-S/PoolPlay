@extends('layouts.master')

@section('title', 'PoolPlay - Edit Produk')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-4 p-4">
                
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="fw-bold mb-0" style="color: #023E8A;">Edit Data Produk</h4>
                    <a href="{{ route('produk.semua') }}" class="btn btn-outline-secondary btn-sm">
                        &larr; Kembali
                    </a>
                </div>

                <!-- Form Edit Produk -->
                <form action="{{ route('produk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" 
                               class="form-control" 
                               id="nama_produk" 
                               name="nama_produk" 
                               value="{{ $data->nama_produk }}" 
                               required>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="Kaca Mata Renang" {{ $data->kategori == 'Kaca Mata Renang' ? 'selected' : '' }}>Kaca Mata Renang</option>
                            <option value="Baju Renang" {{ $data->kategori == 'Baju Renang' ? 'selected' : '' }}>Baju Renang</option>
                            <option value="Swim Cap" {{ $data->kategori == 'Swim Cap' ? 'selected' : '' }}>Swim Cap</option>
                            <option value="Ear Plug" {{ $data->kategori == 'Ear Plug' ? 'selected' : '' }}>Ear Plug</option>
                            <option value="Aksesoris Lainnya" {{ $data->kategori == 'Aksesoris Lainnya' ? 'selected' : '' }}>Aksesoris Lainnya</option>
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
                                   value="{{ $data->harga }}" 
                                   min="0" 
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label for="stok" class="form-label fw-semibold">Stok Produk</label>
                            <input type="number" 
                                   class="form-control" 
                                   id="stok" 
                                   name="stok" 
                                   value="{{ $data->stok }}" 
                                   min="0" 
                                   required>
                        </div>
                    </div>

                    <!-- Preview & Upload Foto Baru -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Produk Saat Ini</label>
                        <div class="mb-2">
                            @if($data->gambar && file_exists(public_path('uploads/' . $data->gambar)))
                                <img src="{{ asset('uploads/' . $data->gambar) }}" alt="Foto Produk" class="img-thumbnail" style="max-height: 120px;">
                            @elseif($data->gambar && file_exists(public_path($data->gambar)))
                                <img src="{{ asset($data->gambar) }}" alt="Foto Produk" class="img-thumbnail" style="max-height: 120px;">
                            @else
                                <span class="badge bg-secondary p-2">Belum ada foto</span>
                            @endif
                        </div>
                        
                        <label for="gambar" class="form-label fw-semibold">Ganti Foto (Opsional)</label>
                        <input type="file" 
                               class="form-control" 
                               id="gambar" 
                               name="gambar" 
                               accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto produk.</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Produk</label>
                        <textarea class="form-control" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="3">{{ $data->deskripsi }}</textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-white py-2 fw-semibold" style="background-color: #f77f00; border: none;">
                            Update Produk
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
@endsection