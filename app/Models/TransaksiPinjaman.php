<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PinjamanAksesoris;

class TransaksiPinjaman extends Model
{
    protected $table = 'transaksi_pinjaman'; // sesuaikan dengan nama tabel

    protected $fillable = [
        'pinjaman_aksesoris_id',
        'nama',
        'email',
        'telepon',
        'alamat',
        'jumlah_pinjam',
        'tanggal_ambil',
        'tanggal_kembali',
        'lama_hari',
        'total_biaya',
        'ktp',
        'bukti_pembayaran',
        'status'
    ];

    // Relasi ke barang yang dipinjam
    public function barang()
    {
        return $this->belongsTo(
            PinjamanAksesoris::class,
            'pinjaman_aksesoris_id'
        );
    }
}