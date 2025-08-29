<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PortofolioController extends Controller
{
    public function index()
    {
        // =================== DATA UNTUK GALERI FOTO (tetap seperti punyamu) ===================
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

        // =================== DATA UNTUK VIDEO EXTERNAL (YouTube/Vimeo) ===================
        $video_projects = collect([
            ['title' => 'Cinematic Wedding of Sarah & David', 'video_url' => 'https://www.youtube.com/embed/ScMzIvxBSi4'],
            ['title' => 'Our Story: Pre-wedding Highlight',     'video_url' => 'https://www.youtube.com/embed/2Bv-I222f5U'],
            ['title' => 'A Day to Remember',                     'video_url' => 'https://www.youtube.com/embed/LXb3EKWsInQ'],
        ]);

        // =================== DATA UNTUK VIDEO LOKAL (MP4) ===================
        // Opsi A (langsung tulis manual – cepat untuk demo):
        $local_videos = collect([
            // Pastikan file ini ada di public/portofolio/videos/
            ['title' => 'BTS: Bridal Prep',     'path' => 'portofolio/videos/bridal_prep.mp4',     'poster' => 'portofolio/videos/bridal_prep.jpg'],
            ['title' => 'Makeup Timelapse',     'path' => 'portofolio/videos/makeup_timelapse.mp4','poster' => null],
            ['title' => 'Studio Tour',          'path' => 'portofolio/videos/studio_tour.mp4',     'poster' => 'portofolio/videos/studio_tour.png'],
        ]);

        // Opsi B (auto-scan folder public/portofolio/videos untuk semua .mp4)
        // Jika ingin otomatis, biarkan blok ini menggantikan data di atas saat file ditemukan.
        $videosDir = public_path('portofolio/videos');
        if (File::isDirectory($videosDir)) {
            $discovered = collect(File::files($videosDir))
                ->filter(fn($f) => strtolower($f->getExtension()) === 'mp4')
                ->map(function ($file) {
                    $filename = $file->getFilename(); // ex: makeup_timelapse.mp4
                    $basename = pathinfo($filename, PATHINFO_FILENAME); // ex: makeup_timelapse
                    $posterJpg = public_path("portofolio/videos/{$basename}.jpg");
                    $posterPng = public_path("portofolio/videos/{$basename}.png");
                    $posterRel = File::exists($posterJpg)
                        ? "portofolio/videos/{$basename}.jpg"
                        : (File::exists($posterPng) ? "portofolio/videos/{$basename}.png" : null);

                    return [
                        'title'  => ucwords(str_replace(['_', '-'], ' ', $basename)),
                        'path'   => "portofolio/videos/{$filename}",
                        'poster' => $posterRel,
                    ];
                });

            if ($discovered->isNotEmpty()) {
                $local_videos = $discovered->values();
            }
        }

        return view('portofolio.index', compact(
            'photo_projects',
            'video_projects',
            'local_videos'
        ));
    }
}
