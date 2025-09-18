<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service; // pastikan model Service ada

class HomeController extends Controller
{
    public function index()
    {
        // arahkan ke view home/index.blade.php
        return view('home.index');
    }

    public function about()
    {
        // arahkan ke view about/index.blade.php
        return view('about.index');
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
