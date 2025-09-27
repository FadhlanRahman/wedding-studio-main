<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // Tambahkan field yang boleh diisi (mass assignment)
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
