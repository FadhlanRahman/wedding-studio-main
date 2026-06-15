<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinjamanAksesoris extends Model
{
    protected $table = 'pinjaman_aksesoris';

    protected $fillable = [
        'nama_barang',
        'stok',
        'harga',
        'tanggal_barang',
        'tanggal_pengembalian',
        'foto_barang'
    ];
}