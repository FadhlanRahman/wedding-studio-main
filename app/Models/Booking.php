<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_place',
        'birth_date',
        'booking_date',
        'phone',
        'service_id',    // 🔥 diganti dari 'service' ke 'service_id'
        'total_price',
        'payment_method',
        'payment_status',
        'payment_proof', // ✅ ditambahkan
    ];

    // 🔗 Relasi: Booking milik satu Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
