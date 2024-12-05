<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = [
        'name',       // Nama produk (contoh: "Kedelai Hitam")
        'description',// Deskripsi produk
        'price',      // Harga produk
        'stock',      // Jumlah stok
        'category',   // Kategori produk
    ];
}
