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
        'harga_per_hari',
        'foto_barang'
    ];
     // Relasi ke transaksi pinjaman
    public function transaksi()
    {
        return $this->hasMany(
            TransaksiPinjaman::class,
            'pinjaman_aksesoris_id'
        );
    }
}
