<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('testimonials')) {
            // Buat tabel baru kalau belum ada
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('name');       // Nama user
                $table->string('email');      // Email user
                $table->text('message');      // Pesan/testimoni
                $table->integer('rating')->default(5); // Rating bintang (1-5)
                $table->boolean('is_published')->default(false); // Status tampil / tidak
                $table->timestamps();
            });
        } else {
            // Kalau tabel sudah ada, cek apakah kolom rating sudah ada
            if (!Schema::hasColumn('testimonials', 'rating')) {
                Schema::table('testimonials', function (Blueprint $table) {
                    $table->integer('rating')->default(5)->after('message');
                });
            }

            // Tambah kolom is_published kalau belum ada
            if (!Schema::hasColumn('testimonials', 'is_published')) {
                Schema::table('testimonials', function (Blueprint $table) {
                    $table->boolean('is_published')->default(false)->after('rating');
                });
            }
        }
    }

    public function down(): void
    {
        // Drop kolom kalau tabel masih ada
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                if (Schema::hasColumn('testimonials', 'rating')) {
                    $table->dropColumn('rating');
                }
                if (Schema::hasColumn('testimonials', 'is_published')) {
                    $table->dropColumn('is_published');
                }
            });
        }

        // Kalau mau drop full tabel, uncomment:
        // Schema::dropIfExists('testimonials');
    }
};
