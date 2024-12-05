<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('product_name'); // Nama produk (misalnya "Kedelai", "Kedelai Tahu", etc.)
            $table->integer('quantity'); // Jumlah produk yang dipesan
            $table->decimal('total_price', 10, 2); // Total harga pesanan
            $table->string('category'); // Kategori produk (misalnya "Kedelai Mentah", "Kedelai Olahan", dll.)
            $table->text('shipping_address'); // Alamat pengiriman
            $table->string('payment_method'); // Metode pembayaran (misalnya "Transfer Bank", "Credit Card", dll.)
            $table->string('status')->default('pending'); // Status pesanan (pending, completed, canceled, etc.)
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
