@extends('layouts.app')

@section('content')
<div class="bg-white">

    {{-- HERO Section --}}
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('background/background.jpg') }}')">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
            Selamat Datang di <span class="text-blue-400">Ellen Wedding Studio</span>
        </h1>
        <p class="text-lg text-gray-200 mb-6">
            Rayakan momen terindahmu dengan sentuhan profesional dan penuh cinta 💖
        </p>
        <a href="#booking" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition">
            Booking Sekarang
        </a>
    </div>
    </section>


    {{-- Layanan Unggulan --}}
    <section class="py-16 px-6">
        <h2 class="text-3xl font-semibold text-blue-500 text-center mb-12">Layanan Unggulan Kami</h2>
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @php
                $services = [
                    ['title' => 'Makeup & Hairdo', 'desc' => 'Tampilan natural hingga glam sesuai karakter dan tema pernikahan Anda.', 'icon' => '💄'],
                    ['title' => 'Paket Bridal', 'desc' => 'Termasuk rias, gaun, prewedding, dokumentasi hari H, dan lainnya.', 'icon' => '👰'],
                    ['title' => 'Perawatan Kulit', 'desc' => 'Rangkaian perawatan sebelum hari spesial untuk hasil makeup terbaik.', 'icon' => '🧖‍♀️'],
                ];
            @endphp

            @foreach ($services as $service)
            <div class="bg-blue-50 p-8 rounded-xl shadow hover:shadow-lg transition text-center">
                <div class="text-5xl mb-4">{{ $service['icon'] }}</div>
                <h3 class="text-xl font-bold text-gray-800">{{ $service['title'] }}</h3>
                <p class="text-gray-600 mt-2">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Testimoni Singkat --}}
    <section class="py-16 bg-gray-50 px-6">
        <h2 class="text-3xl font-semibold text-center text-blue-500 mb-8">Apa Kata Klien Kami</h2>
        <div class="bg-white shadow-lg rounded-lg p-8 text-center max-w-3xl mx-auto">
            <p class="text-gray-700 italic text-lg">
                "Luar biasa! Makeup nya flawless dan dokumentasinya sangat menyentuh. Terima kasih Ellen Studio sudah buat hari kami jadi sangat berkesan!"
            </p>
            <p class="text-blue-600 mt-4 font-semibold">— Arina & Dimas</p>
        </div>
    </section>

    {{-- Mini Portofolio --}}
    <section class="py-16 px-6">
        <h2 class="text-3xl font-semibold text-center text-blue-500 mb-10">
            Portofolio Pernikahan
        </h2>

        <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @php
                $portfolios = [
                    'portofolio1.jpg',
                    'portofolio2.jpg',
                    'portofolio3.jpg',
                ];
            @endphp

            @foreach ($portfolios as $index => $file)
                <div class="overflow-hidden rounded-lg shadow-lg">
                    <img src="{{ asset('portofoliol/' . $file) }}" 
                         alt="Portfolio {{ $index + 1 }}" 
                         class="hover:scale-105 transition-transform duration-300 w-full h-auto">
                </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
        <a href="{{ route('portofolio') }}" 
       class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-md hover:from-blue-700 hover:to-blue-900 transition">
       Lihat Portofolio
        </a>
        </div>



    </section>

    {{-- Call to Action --}}
    <section id="booking" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-16 text-center px-6">
        <h2 class="text-2xl md:text-3xl font-semibold mb-4">Siap Wujudkan Pernikahan Impianmu?</h2>
        <p class="mb-6 text-lg">Booking sekarang atau konsultasi gratis dengan tim kami!</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="https://wa.me/6281234567890" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-100 transition">
                WhatsApp Kami
            </a>
            <a href="{{ route('booking.create') }}" class="bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-900 transition">
                Form Booking
            </a>
        </div>
    </section>

</div>
@endsection
