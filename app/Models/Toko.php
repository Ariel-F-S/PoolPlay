<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'gambar',
        'deskripsi'
    ];
}
