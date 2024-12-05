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
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // ID unik untuk setiap produk
        $table->string('name'); // Nama produk (contoh: "Kedelai Organik")
        $table->text('description')->nullable(); // Deskripsi produk
        $table->decimal('price', 10, 2); // Harga produk
        $table->integer('stock'); // Jumlah stok yang tersedia
        $table->string('category')->nullable(); // Kategori produk (contoh: "Kedelai Hitam", "Kedelai Putih")
        $table->timestamps(); // Timestamps (created_at dan updated_at)
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
