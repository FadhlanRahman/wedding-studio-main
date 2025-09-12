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
                Kami siap membantu Anda mewujudkan pernikahan impian dimanapun. Silakan hubungi kami melalui form, WhatsApp, email, media sosial, atau kunjungi langsung lokasi kami.
            </p>
        </section>

        {{-- Grid Form + Info --}}
        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Form Kontak --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-blue-100 animate-fadeInUp" style="animation-delay:200ms;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="name">Nama</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2" for="message">Pesan</label>
                        <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition transform hover:scale-105">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            {{-- Info Kontak & Sosial Media --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-blue-100 space-y-6 animate-fadeInUp" style="animation-delay:300ms;">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">Info Kontak</h3>
                <p class="text-gray-700"><strong>Telepon:</strong> 
                    <a href="tel:{{ $contact->phone ?? '' }}" class="text-blue-600 hover:underline">
                        {{ $contact->phone ?? '-' }}
                    </a>
                </p>
                <p class="text-gray-700"><strong>Email:</strong> 
                    <a href="mailto:{{ $contact->email ?? '' }}" class="text-blue-600 hover:underline">
                        {{ $contact->email ?? '-' }}
                    </a>
                </p>
                <p class="text-gray-700"><strong>Alamat:</strong> {{ $contact->address ?? '-' }}</p>

                {{-- Maps Embed --}}
                <div class="mt-4 w-full h-64 rounded-xl overflow-hidden border border-gray-200 shadow-md">
                    @if(!empty($contact->map_url))
                        <iframe 
                            src="{{ $contact->map_url }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <p class="text-gray-500 text-center py-10">Map belum tersedia</p>
                    @endif
                </div>

                <h3 class="text-2xl font-bold text-blue-600 mt-6 mb-4">Media Sosial</h3>
                <div class="flex space-x-4">
                    {{-- Instagram --}}
                    @if(!empty($contact->instagram))
                    <a href="{{ $contact->instagram }}" target="_blank" class="text-pink-500 hover:text-pink-400 transition transform hover:scale-110">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    @endif

                    {{-- WhatsApp --}}
                    @if(!empty($contact->whatsapp))
                    <a href="https://wa.me/{{ $contact->whatsapp }}" target="_blank" class="text-green-500 hover:text-green-400 transition transform hover:scale-110">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                    @endif

                    {{-- Email --}}
                    @if(!empty($contact->email))
                    <a href="mailto:{{ $contact->email }}" target="_blank" class="text-blue-600 hover:text-blue-500 transition transform hover:scale-110">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                    @endif
                </div>
            </div>

        </div>
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
    opacity:0; 
}
</style>
@endsection
