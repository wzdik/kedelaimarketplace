<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Tentukan kolom-kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [ 
        'product_name', 
        'quantity', 
        'total_price', 
        'category', 
        'shipping_address', 
        'payment_method', 
        'status'
    ];

    // Relasi dengan model User (jika menggunakan sistem autentikasi pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
