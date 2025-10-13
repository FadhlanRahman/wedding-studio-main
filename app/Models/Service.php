<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'price', 'icon', 'pdf_path'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

