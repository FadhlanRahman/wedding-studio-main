<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = [
            ['title'=>'Makeup & Hairdo', 'desc'=>'Tampilan natural hingga glam sesuai karakter dan tema pernikahan Anda.', 'price'=>'Rp 1.500.000', 'icon'=>'💄'],
            ['title'=>'Wedding Photography', 'desc'=>'Dokumentasi prewedding dan hari H dengan hasil profesional.', 'price'=>'Rp 3.000.000', 'icon'=>'📸'],
            ['title'=>'Bridal Gown & Suit', 'desc'=>'Sewa gaun pengantin dan jas terbaik sesuai tema Anda.', 'price'=>'Rp 2.500.000', 'icon'=>'👗'],
            ['title'=>'Venue Decoration', 'desc'=>'Dekorasi tempat pernikahan elegan dan sesuai tema.', 'price'=>'Rp 5.000.000', 'icon'=>'🎀'],
            ['title'=>'Catering & Cake', 'desc'=>'Menu lezat dan cake cantik untuk tamu undangan.', 'price'=>'Rp 7.500.000', 'icon'=>'🎂'],
            ['title'=>'Wedding Planner', 'desc'=>'Koordinasi acara supaya berjalan lancar tanpa stress.', 'price'=>'Rp 4.000.000', 'icon'=>'📋'],
        ];

        return view('services.index', compact('services'));
    }
}
