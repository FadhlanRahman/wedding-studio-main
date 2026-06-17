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
        Schema::create('transaksi_pinjaman', function (Blueprint $table) {

    $table->id();

    $table->foreignId('pinjaman_aksesoris_id')
          ->constrained('pinjaman_aksesoris')
          ->onDelete('cascade');

    $table->string('nama');
    $table->string('email');
    $table->string('telepon');
    $table->text('alamat');

    $table->integer('jumlah_pinjam');

    $table->date('tanggal_ambil');
    $table->date('tanggal_kembali');

    $table->integer('lama_hari');

    $table->decimal('total_biaya',12,2);

    $table->string('ktp')->nullable();
    $table->string('bukti_pembayaran')->nullable();

    $table->enum('status',[
        'pending',
        'approved',
        'rejected',
        'returned'
    ])->default('pending');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pinjaman');
    }
};
