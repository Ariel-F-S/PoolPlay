<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use Illuminate\Support\Facades\File;

class TokoController extends Controller
{
    // 1. Halaman Utama / Beranda (Home)
    public function index()
    {
        $dataProduk = Toko::latest()->take(4)->get();
        return view('produk.index', compact('dataProduk'));
    }

    // 2. Halaman Katalog Semua Produk
    public function semuaProduk()
    {
        $dataProduk = Toko::all();
        return view('produk.produk', compact('dataProduk'));
    }

    // 3. Detail Produk Berdasarkan ID
    public function show($id)
    {
        $data = Toko::findOrFail($id);
        return view('produk.show', compact('data'));
    }

    // 4. Form Tambah Produk
    public function create()
    {
        return view('produk.create');
    }

    // 5. Simpan Produk Baru (Termasuk Upload Gambar)
    public function store(Request $request)
    {
        $data = new Toko();
        $data->nama_produk = $request->nama_produk;
        $data->kategori    = $request->kategori;
        $data->harga       = $request->harga;
        $data->stok        = $request->stok;
        $data->deskripsi   = $request->deskripsi;

        // Proses Upload File Gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan file ke folder public/uploads
            $file->move(public_path('uploads'), $namaFile);
            
            // Simpan nama file ke database
            $data->gambar = $namaFile;
        }

        $data->save();

        return redirect()->route('produk.semua');
    }

    // 6. Form Edit Produk
    public function edit($id)
    {
        $data = Toko::findOrFail($id);
        return view('produk.edit', compact('data'));
    }

    // 7. Update Data Produk (Termasuk Ganti Gambar)
    public function update(Request $request, $id)
    {
        $data = Toko::findOrFail($id);
        $data->nama_produk = $request->nama_produk;
        $data->kategori    = $request->kategori;
        $data->harga       = $request->harga;
        $data->stok        = $request->stok;
        $data->deskripsi   = $request->deskripsi;

        // Jika Pengguna Mengunggah Foto Baru
        if ($request->hasFile('gambar')) {
            // Hapus foto lama di public/uploads jika ada
            if ($data->gambar && File::exists(public_path('uploads/' . $data->gambar))) {
                File::delete(public_path('uploads/' . $data->gambar));
            }

            // Upload foto baru
            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);

            // Simpan nama file baru ke database
            $data->gambar = $namaFile;
        }

        $data->save();

        return redirect()->route('produk.semua');
    }

    // 8. Hapus Produk (Beserta File Gambar Fisiknya)
    public function destroy($id)
    {
        $data = Toko::findOrFail($id);

        // Hapus file gambar fisik dari folder public/uploads jika file ada
        if ($data->gambar && File::exists(public_path('uploads/' . $data->gambar))) {
            File::delete(public_path('uploads/' . $data->gambar));
        }

        $data->delete();

        return redirect()->route('produk.semua');
    }

    // 9. Pencarian Produk
    public function cari(Request $request)
    {
        $keyword = $request->keyword;

        $dataProduk = Toko::where('nama_produk', 'like', "%$keyword%")
            ->orWhere('kategori', 'like', "%$keyword%")
            ->get();

        return view('produk.produk', compact('dataProduk'));
    }
    
    public function inventaris()
    {
        // Mengambil seluruh data produk untuk halaman admin inventaris
        $dataProduk = Toko::all(); 
        return view('produk.inventaris', compact('dataProduk'));
    }

    public function about()
    {
        return view('about.index');
    }
}