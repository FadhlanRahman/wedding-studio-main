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
        Schema::table('pinjaman_aksesoris', function (Blueprint $table) {
            $table->integer('stok')->default(0)->after('nama_barang');
            $table->decimal('harga', 12, 2)->default(0)->after('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjaman_aksesoris', function (Blueprint $table) {
            $table->dropColumn(['stok', 'harga']);
        });
    }
};