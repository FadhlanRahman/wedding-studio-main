@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Header --}}
        <section class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-600 mb-4 animate-fadeInUp">
                Our Contact
            </h2>
            <p class="text-gray-700 text-lg md:text-xl max-w-3xl mx-auto animate-fadeInUp" style="animation-delay:100ms;">
                Kami siap membantu Anda mewujudkan pernikahan impian dimanapun. 
                Silakan hubungi kami melalui form, WhatsApp, email, media sosial, 
                atau kunjungi langsung lokasi kami.
            </p>
        </section>

        {{-- Grid Form + Info --}}
        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Form Kontak --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-blue-100 animate-fadeInUp" style="animation-delay:200ms;">
                <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="name">Nama</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                            placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                            placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="message">Pesan</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                            placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>

                    {{-- Rating Bintang --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Rating</label>
                        <div class="flex space-x-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer/star{{ $i }}">
                                <label for="star{{ $i }}" class="cursor-pointer text-3xl text-gray-300 peer-checked/star{{ $i }}:text-yellow-400">
                                    ★
                                </label>
                            @endfor
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                        Kirim Pesan
                    </button>
                </form>
            </div>



        {{-- ===================== --}}
        {{-- Info Kontak & Sosial Media --}}
        {{-- ===================== --}}
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-blue-100 space-y-6 animate-fadeInUp" style="animation-delay:300ms;">
            <h3 class="text-2xl font-bold text-blue-600 mb-4">Info Kontak</h3>

            {{-- Telepon --}}
            <p class="text-gray-700">
                <strong>Telepon:</strong>
                @if(!empty($contact->phone))
                    <a href="tel:{{ $contact->phone }}" class="text-blue-600 hover:underline">
                        {{ $contact->phone }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- Email --}}
            <p class="text-gray-700">
                <strong>Email:</strong>
                @if(!empty($contact->email))
                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:underline">
                        {{ $contact->email }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- Alamat --}}
            <p class="text-gray-700">
                <strong>Alamat:</strong>
                {{ $contact->address ?? '-' }}
            </p>

            {{-- Instagram --}}
            <p class="text-gray-700">
                <strong>Instagram:</strong>
                @if(!empty($contact->instagram))
                    <a href="https://instagram.com/{{ ltrim($contact->instagram, '@') }}" target="_blank" 
                    class="text-pink-600 hover:underline">
                        {{ '@' . ltrim($contact->instagram, '@') }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- WhatsApp --}}
            <p class="text-gray-700">
                <strong>WhatsApp:</strong>
                @if(!empty($contact->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" 
                    class="text-green-600 hover:underline">
                        {{ $contact->whatsapp }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- Google Maps --}}
            <p class="text-gray-700">
                <strong>Google Maps:</strong>
                @if(!empty($contact->map_url))
                    <a href="{{ $contact->map_url }}" target="_blank" class="text-blue-600 hover:underline">
                        📍 Lihat Lokasi
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- Sosial Media Icons --}}
            <div class="flex space-x-4 pt-2">
                {{-- Instagram --}}
                @if(!empty($contact->instagram))
                    <a href="https://instagram.com/{{ ltrim($contact->instagram, '@') }}" target="_blank" 
                    class="text-pink-500 hover:text-pink-400 transition transform hover:scale-110">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                @endif

                {{-- WhatsApp --}}
                @if(!empty($contact->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" 
                    class="text-green-500 hover:text-green-400 transition transform hover:scale-110">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                @endif

                {{-- Email --}}
                @if(!empty($contact->email))
                    <a href="mailto:{{ $contact->email }}" target="_blank" 
                    class="text-blue-600 hover:text-blue-500 transition transform hover:scale-110">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                @endif

                {{-- Google Maps --}}
                @if(!empty($contact->map_url))
                    <a href="{{ $contact->map_url }}" target="_blank" 
                    class="text-red-500 hover:text-red-400 transition transform hover:scale-110">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Animasi CSS --}}
        <style>
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { 
            animation: fadeInUp 0.6s ease-out forwards; 
            opacity: 0; 
        }
        </style>
        @endsection

