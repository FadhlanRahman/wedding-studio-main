@extends('layouts.app')

@section('content')
<section class="relative bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('background/background.jpg') }}')">
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative z-10 py-20">
        {{-- Header --}}
        <div class="text-center mb-12 fade-in-up">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg mb-4">Our Wedding Services</h1>
            <p class="text-gray-200 max-w-2xl mx-auto text-lg md:text-xl">
                Layanan profesional kami siap membantu mewujudkan pernikahan impian Anda.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="max-w-6xl mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-6">
            @php
                $services = [
                    ['title'=>'Makeup & Hairdo','desc'=>'Tampilan natural hingga glam sesuai karakter dan tema pernikahan Anda.','price'=>'Rp 1.500.000','icon'=>'💄'],
                    ['title'=>'Wedding Photography','desc'=>'Dokumentasi prewedding dan hari H dengan hasil profesional.','price'=>'Rp 3.000.000','icon'=>'📸'],
                    ['title'=>'Bridal Gown & Suit','desc'=>'Sewa gaun pengantin dan jas terbaik sesuai tema Anda.','price'=>'Rp 2.500.000','icon'=>'👗'],
                    ['title'=>'Venue Decoration','desc'=>'Dekorasi tempat pernikahan elegan dan sesuai tema.','price'=>'Rp 5.000.000','icon'=>'🎀'],
                    ['title'=>'Catering & Cake','desc'=>'Menu lezat dan cake cantik untuk tamu undangan.','price'=>'Rp 7.500.000','icon'=>'🎂'],
                    ['title'=>'Wedding Planner','desc'=>'Koordinasi acara supaya berjalan lancar tanpa stress.','price'=>'Rp 4.000.000','icon'=>'📋'],
                ];
            @endphp

            @foreach ($services as $service)
            <div class="service-card bg-white rounded-2xl shadow-lg p-8 text-center flex flex-col justify-between transform transition duration-500">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 flex items-center justify-center mb-4 rounded-full bg-gradient-to-tr from-pink-400 to-pink-600 text-white text-4xl shadow-md float-icon">
                        {{ $service['icon'] }}
                    </div>
                    <h3 class="text-xl font-bold text-blue-800 mb-2">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service['desc'] }}</p>
                </div>
                <div class="mt-4">
                    <span class="text-blue-600 font-bold text-lg">{{ $service['price'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Call to Action --}}
        <div class="text-center mt-16">
            <a href="#booking" 
               class="inline-block bg-gradient-to-r from-blue-600 to-pink-500 hover:from-pink-500 hover:to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition transform hover:scale-105 animate-bounce">
               Book Your Service
            </a>
        </div>
    </div>
</section>

{{-- Animations & JS --}}
<style>
@keyframes floatIcon {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}
.float-icon {
    animation: floatIcon 2s ease-in-out infinite;
}

.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease-out;
}

.service-card:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll animation
    const fadeElems = document.querySelectorAll('.fade-in-up, .service-card');
    const options = { threshold: 0.2 };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, options);

    fadeElems.forEach(el => observer.observe(el));
});
</script>
@endsection
