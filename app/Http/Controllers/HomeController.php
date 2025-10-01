<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; 
use App\Models\Testimonial; // ✅ tambahkan model Testimonial

class HomeController extends Controller
{
    public function index()
    {
        // Ambil testimoni yang sudah dipublish
        $testimonials = Testimonial::where('is_published', true)
            ->latest()
            ->get();

        // arahkan ke view home/index.blade.php
        return view('home.index', compact('testimonials'));
    }

    public function about()
    {
        $teams = \App\Models\Team::all();
        return view('about.index', compact('teams'));
    }

    public function services()
    {
        // ambil semua service dari database
        $services = Service::all();
        // arahkan ke view services/index.blade.php
        return view('services.index', compact('services'));
    }

    public function contact()
    {
        // arahkan ke view contact/index.blade.php
        return view('contact.index');
    }
}
