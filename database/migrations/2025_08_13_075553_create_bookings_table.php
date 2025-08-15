<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');      // Nama klien
            $table->string('birth_place');    // Tempat lahir
            $table->date('birth_date');       // Tanggal lahir
            $table->date('booking_date')->unique(); // Tanggal booking (unik)
            $table->string('phone');          // Nomor HP
            $table->string('service');        // Layanan yang dipilih
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
