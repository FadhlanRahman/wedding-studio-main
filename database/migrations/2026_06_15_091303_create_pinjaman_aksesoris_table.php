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
    Schema::create('pinjaman_aksesoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 12, 2)->default(0);
            $table->decimal('harga_per_hari', 12, 2)->default(0);
            $table->string('foto_barang')->nullable();
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman_aksesoris');
    }
};
