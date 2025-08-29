<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortofolioController extends Controller
{
    public function index()
    {
        // =================== FOTO ===================
        $photo_projects = collect([
            [
                'title' => 'Elegant Make Up Transformation',
                'description' => 'Transformasi makeup yang fresh dan menawan.',
                'before_image' => 'portofolio/makeup_before.jpg',
                'after_image'  => 'portofolio/makeup_after.jpg',
            ],
            [
                'title' => 'Romantic Garden Ceremony',
                'description' => 'Pernikahan di taman bunga dengan suasana romantis.',
                'image' => 'https://images.unsplash.com/photo-1603006905003-c10fa3b52f60?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Classic White Theme',
                'description' => 'Tema putih klasik untuk suasana elegan dan timeless.',
                'image' => 'https://images.unsplash.com/photo-1624204745952-07b5a4e23995?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Rustic Bohemian Wedding',
                'description' => 'Tema bohemian dengan dekorasi kayu dan bunga kering.',
                'image' => 'https://images.unsplash.com/photo-1605348532760-6753d2c43329?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Intimate Vows Exchange',
                'description' => 'Momen sakral saat kedua mempelai mengucap janji suci.',
                'image' => 'https://images.unsplash.com/photo-1597158269299-09163f354c4a?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Detailed Wedding Rings',
                'description' => 'Detail cincin pernikahan yang melambangkan ikatan abadi.',
                'image' => 'https://images.unsplash.com/photo-1598433823773-1343d3a95c66?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Venue Transformation',
                'description' => 'Dekorasi menakjubkan yang mengubah lokasi biasa menjadi luar biasa.',
                'before_image' => 'portofolio/venue_before.jpg',
                'after_image'  => 'portofolio/venue_after.jpg',
            ],
            [
                'title' => 'Joyful Celebration',
                'description' => 'Keceriaan tamu dan keluarga yang turut merayakan hari bahagia.',
                'image' => 'https://images.unsplash.com/photo-1550005863-d39b835948f2?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Elegant Bridal Gown',
                'description' => 'Gaun pengantin yang anggun dan mempesona.',
                'image' => 'https://images.unsplash.com/photo-1604193315743-30d418a0e8a7?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'First Dance Moment',
                'description' => 'Dansa pertama sebagai suami istri yang penuh kehangatan.',
                'image' => 'https://images.unsplash.com/photo-1593213543166-260a2f43a05e?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Sunset Pre-wedding',
                'description' => 'Sesi foto pre-wedding dengan latar senja yang romantis.',
                'image' => 'https://images.unsplash.com/photo-1515934751635-481eff6241b7?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Gourmet Wedding Cake',
                'description' => 'Kue pernikahan lezat dengan desain yang artistik.',
                'image' => 'https://images.unsplash.com/photo-1616690397500-48805364b633?auto=format&fit=crop&w=800&q=80'
            ],
        ]);

        // =================== VIDEO EXTERNAL ===================
        $video_projects = collect([
            ['title' => 'Cinematic Wedding of Sarah & David', 'video_url' => 'https://www.youtube.com/embed/ScMzIvxBSi4'],
            ['title' => 'Our Story: Pre-wedding Highlight',   'video_url' => 'https://www.youtube.com/embed/2Bv-I222f5U'],
            ['title' => 'A Day to Remember',                   'video_url' => 'https://www.youtube.com/embed/LXb3EKWsInQ'],
        ]);

        // =================== VIDEO LOKAL (auto-scan) ===================
        // Taruh file videomu di salah satu folder ini:
        // - public/portofolio/videos
        // - public/portofolio_videos
        // Poster opsional: nama sama dengan video (.jpg/.png)
        $searchDirs = ['portofolio/videos', 'portofolio_videos'];
        $allowedExt = ['mp4', 'webm', 'ogg'];

        $local_videos = collect();

        foreach ($searchDirs as $relDir) {
            $absDir = public_path($relDir);
            if (!File::isDirectory($absDir)) {
                continue;
            }

            $found = collect(File::files($absDir))
                ->filter(function ($f) use ($allowedExt) {
                    return in_array(strtolower($f->getExtension()), $allowedExt, true);
                })
                ->map(function ($f) use ($relDir) {
                    $filename = $f->getFilename();                          // e.g. my_clip.mp4
                    $basename = pathinfo($filename, PATHINFO_FILENAME);      // e.g. my_clip

                    $posterRel = null;
                    foreach (['jpg', 'png', 'jpeg'] as $imgExt) {
                        $candidate = public_path("$relDir/{$basename}.{$imgExt}");
                        if (File::exists($candidate)) {
                            $posterRel = "$relDir/{$basename}.{$imgExt}";
                            break;
                        }
                    }

                    // Format judul dari nama file
                    $title = ucwords(str_replace(['_', '-'], ' ', $basename));

                    return [
                        'title'  => $title,
                        'path'   => "$relDir/{$filename}",
                        'poster' => $posterRel, // boleh null
                    ];
                });

            $local_videos = $local_videos->merge($found);
        }

        // Hapus duplikat (berdasarkan path) & urutkan
        $local_videos = $local_videos
            ->unique('path')
            ->sortBy('title')
            ->values();

        return view('portofolio.index', compact(
            'photo_projects',
            'video_projects',
            'local_videos'
        ));
    }
}
