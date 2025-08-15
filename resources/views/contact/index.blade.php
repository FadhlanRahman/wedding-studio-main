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
                Kami siap membantu Anda mewujudkan pernikahan impian. Silakan hubungi kami melalui form, WhatsApp, email, media sosial, atau kunjungi langsung lokasi kami.
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
                <p class="text-gray-700"><strong>Telepon:</strong> <a href="tel:+628123456789" class="text-blue-600 hover:underline">+62 812-3456-789</a></p>
                <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:ellenstudio@example.com" class="text-blue-600 hover:underline">ellenstudio@example.com</a></p>
                <p class="text-gray-700"><strong>Alamat:</strong> Grand Sharon, Jalan Oliana No.16, Jakarta, Indonesia</p>

                {{-- Maps Embed --}}
                <div class="mt-4 w-full h-64 rounded-xl overflow-hidden border border-gray-200 shadow-md">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.123456789!2d106.831234!3d-6.2001234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1abcd1234%3A0xabcdef1234567890!2sGrand+Sharon!5e0!3m2!1sen!2sid!4v1691900000000!5m2!1sen!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <h3 class="text-2xl font-bold text-blue-600 mt-6 mb-4">Media Sosial</h3>
                <div class="flex space-x-4">
                <!-- Instagram -->
                <a href="https://instagram.com/ellenstudio" target="_blank" class="text-pink-500 hover:text-pink-400 transition transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.2c3.2 0 3.584.012 4.85.07 1.17.055 1.97.24 2.43.403a4.92 4.92 0 011.76 1.037c.496.496.825 1.065 1.037 1.76.163.462.35 1.26.403 2.43.058 1.266.07 1.65.07 4.85s-.012 3.584-.07 4.85c-.055 1.17-.24 1.97-.403 2.43a4.92 4.92 0 01-1.037 1.76 4.924 4.924 0 01-1.76 1.037c-.462.163-1.26.35-2.43.403-1.266.058-1.65.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.055-1.97-.24-2.43-.403a4.92 4.92 0 01-1.76-1.037 4.924 4.924 0 01-1.037-1.76c-.163-.462-.35-1.26-.403-2.43C2.212 15.584 2.2 15.2 2.2 12s.012-3.584.07-4.85c.055-1.17.24-1.97.403-2.43a4.924 4.924 0 011.037-1.76A4.92 4.92 0 015.47 2.673c.462-.163 1.26-.35 2.43-.403C8.416 2.212 8.8 2.2 12 2.2zm0 1.8c-3.17 0-3.55.012-4.8.07-1.036.046-1.6.21-1.967.35-.5.182-.857.4-1.233.776-.376.376-.594.733-.776 1.233-.14.366-.304.932-.35 1.967-.058 1.25-.07 1.63-.07 4.8s.012 3.55.07 4.8c.046 1.036.21 1.6.35 1.967.182.5.4.857.776 1.233.376.376.733.594 1.233.776.366.14.932.304 1.967.35 1.25.058 1.63.07 4.8.07s3.55-.012 4.8-.07c1.036-.046 1.6-.21 1.967-.35.5-.182.857-.4 1.233-.776.376-.376.594-.733.776-1.233.14-.366.304-.932.35-1.967.058-1.25.07-1.63.07-4.8s-.012-3.55-.07-4.8c-.046-1.036-.21-1.6-.35-1.967a3.31 3.31 0 00-.776-1.233 3.312 3.312 0 00-1.233-.776c-.366-.14-.932-.304-1.967-.35-1.25-.058-1.63-.07-4.8-.07zm0 3a6 6 0 110 12 6 6 0 010-12zm0 1.8a4.2 4.2 0 100 8.4 4.2 4.2 0 000-8.4zm5.4-1.8a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                    </svg>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/628123456789" target="_blank" class="text-green-500 hover:text-green-400 transition transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.52 3.48a11.91 11.91 0 00-16.84 0A11.9 11.9 0 002 12c0 2.13.56 4.12 1.64 5.87L2 22l4.36-1.64A11.92 11.92 0 0012 24c6.63 0 12-5.37 12-12 0-3.17-1.23-6.17-3.48-8.52zM12 21c-1.88 0-3.64-.5-5.16-1.36l-.37-.22-2.58.97.96-2.58-.22-.37A9.002 9.002 0 013 12c0-4.97 4.03-9 9-9s9 4.03 9 9-4.03 9-9 9zm4.6-6.7c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.01-.37-1.92-1.18-.71-.63-1.19-1.41-1.33-1.64-.14-.24-.01-.37.11-.49.12-.12.26-.28.38-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.48-.4-.41-.54-.42l-.46-.01c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2 .01 1.18.86 2.32.98 2.48.12.16 1.68 2.56 4.06 3.59.57.25 1.01.4 1.36.51.57.18 1.09.16 1.5.1.46-.07 1.42-.58 1.62-1.14.2-.56.2-1.04.14-1.14-.06-.1-.24-.16-.48-.28z"/>
                    </svg>
                </a>

                <!-- Email -->
                <a href="mailto:ellenstudio@example.com" target="_blank" class="text-blue-600 hover:text-blue-500 transition transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12.713l11.985-8.713H.015L12 12.713zm0 2.574l-12-8.999V20h24V5.288l-12 10z"/>
                    </svg>
                </a>
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
