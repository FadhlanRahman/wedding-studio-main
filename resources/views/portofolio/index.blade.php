@extends('layouts.app')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

<div class="bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="container mx-auto px-4">

        <!-- Carousel Portofolio -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($projects as $project)
                    <div class="swiper-slide">
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-72 object-cover transform hover:scale-105 duration-500">
                            <div class="p-4 text-center">
                                <h2 class="text-lg font-semibold text-blue-700">{{ $project['title'] }}</h2>
                                <p class="text-gray-600 text-sm">{{ $project['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="container mx-auto px-4">
        
        <!-- Carousel Portofolio -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($projects as $project)
                    <div class="swiper-slide">
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-72 object-cover transform hover:scale-105 duration-500">
                            <div class="p-4 text-center">
                                <h2 class="text-lg font-semibold text-blue-700">{{ $project['title'] }}</h2>
                                <p class="text-gray-600 text-sm">{{ $project['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="container mx-auto px-4">
        
        <!-- Carousel Portofolio -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($projects as $project)
                    <div class="swiper-slide">
                        <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:shadow-2xl transition duration-300">
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-72 object-cover transform hover:scale-105 duration-500">
                            <div class="p-4 text-center">
                                <h2 class="text-lg font-semibold text-blue-700">{{ $project['title'] }}</h2>
                                <p class="text-gray-600 text-sm">{{ $project['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2000, // ganti waktu geser otomatis (ms)
            disableOnInteraction: false,
        },
        speed: 1000, // kecepatan transisi geser
        breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        }
    });
</script>
@endsection
