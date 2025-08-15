<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index()
    {
        $projects = [
            [
                'title' => 'Luxury Ballroom Wedding',
                'description' => 'Pernikahan megah di ballroom hotel bintang lima dengan dekorasi mewah dan lighting elegan.',
                'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Romantic Garden Ceremony',
                'description' => 'Pernikahan di taman bunga terbuka dengan suasana romantis dan alami.',
                'image' => 'https://images.unsplash.com/photo-1603006905003-c10fa3b52f60?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Classic White Theme',
                'description' => 'Tema putih klasik dengan sentuhan emas untuk suasana elegan dan timeless.',
                'image' => 'https://images.unsplash.com/photo-1624204745952-07b5a4e23995?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Rustic Bohemian Wedding',
                'description' => 'Tema bohemian dengan dekorasi kayu, bunga kering, dan suasana hangat.',
                'image' => 'https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Beachfront Wedding',
                'description' => 'Pernikahan di tepi pantai dengan sunset yang indah dan dekorasi minimalis.',
                'image' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Vintage Glamour',
                'description' => 'Pernikahan dengan sentuhan vintage dan glamor di gedung bersejarah.',
                'image' => 'https://images.unsplash.com/photo-1591604466107-ec97de577aff?auto=format&fit=crop&w=800&q=80'
            ],
        ];

        return view('portofolio.index', compact('projects'));
    }
}
