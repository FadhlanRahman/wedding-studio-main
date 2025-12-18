@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] text-[var(--color-text-light)] overflow-hidden">

{{-- ============== HERO SECTION ============== --}}
<section class="relative min-h-screen flex items-center pt-20 pb-20">
  {{-- Background Image with Gradient Overlay --}}
  <div class="absolute inset-0 z-0">
    <img
      src="{{ asset('background/background.jpeg') }}"
      alt="Ellen Wedding Studio Background"
      class="w-full h-full object-cover opacity-60 mix-blend-overlay"
      loading="lazy">
    <div class="absolute inset-0 bg-gradient-to-r from-[var(--color-primary-bg)] via-[var(--color-primary-bg)]/80 to-[var(--color-secondary-bg)]/40"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
    {{-- Left Content --}}
    <div class="space-y-6" data-aos="fade-right">
      <div class="inline-block">
        <span class="text-[var(--color-text-muted)] font-serif italic text-xl tracking-widest pl-1">Ellen Studio</span>
        <h1 class="font-serif text-6xl md:text-8xl leading-tight text-[var(--color-gold)]">
            MAKEUP <br>
            <span class="text-4xl md:text-5xl font-light text-white italic tracking-wide lowercase">sanggul</span>
        </h1>
      </div>

      {{-- "Include" Box from Reference --}}
      <div class="bg-[var(--color-secondary-bg)]/90 backdrop-blur-sm border border-[var(--color-gold)] rounded-xl p-6 md:p-8 max-w-xl shadow-2xl shadow-black/50 mt-8">
        <h3 class="text-[var(--color-secondary-bg)] bg-[var(--color-text-muted)] inline-block px-4 py-1 rounded-sm font-serif font-bold text-lg mb-6 shadow-md">
            include:
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-[var(--color-text-light)]">
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Alat-alat Jahit</span>
                </li>
                 <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Terima Jahitan, Obras, Neci, Bordir</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Ulos, Tandok, Sortali</span>
                </li>
            </ul>
             <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Dekorasi</span>
                </li>
                 <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Foto Prewedding</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="text-[var(--color-gold)] mt-1">•</span>
                    <span class="font-medium">Musik & Penari Pesta</span>
                </li>
            </ul>
        </div>
      </div>

      <div class="pt-6 flex flex-wrap gap-4">
          <a href="#booking" class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-8 py-3 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/20">
              Booking Now
          </a>
          <a href="{{ route('portofolio') }}" class="border border-[var(--color-gold)] text-[var(--color-gold)] px-8 py-3 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">
              View Gallery
          </a>
      </div>
    </div>

    {{-- Right Content (Image) --}}
    <div class="hidden lg:block relative" data-aos="fade-left">
        <div class="relative z-10 w-full max-w-lg ml-auto">
            {{-- Frame Gold --}}
            <div class="absolute -inset-4 border-2 border-[var(--color-gold)]/40 rounded-full scale-105 animate-pulse"></div>
            {{-- Image Mask (Oval/Arch shape mostly) --}}
            <img src="{{ asset('portofoliol/portofolio1.jpg') }}" 
                 alt="Bride Portrait" 
                 class="w-full h-auto object-cover rounded-[100px_0_100px_0] shadow-2xl border-4 border-[var(--color-secondary-bg)] shadow-[var(--color-gold)]/20 grayscale-[20%] hover:grayscale-0 transition duration-700">
        </div>
        {{-- Floating Element --}}
        <div class="absolute -bottom-10 -left-10 z-20 bg-[var(--color-secondary-bg)] p-4 rounded-full border border-[var(--color-gold)] shadow-xl">
             <div class="text-[var(--color-gold)] font-serif font-bold text-center leading-none">
                 <span class="text-3xl block">10+</span>
                 <span class="text-xs uppercase tracking-widest text-[var(--color-text-muted)]">Years Exp</span>
             </div>
        </div>
    </div>
  </div>
</section>

{{-- ============== DECORATIVE DIVIDER ============== --}}
<div class="relative h-24 overflow-hidden">
    <svg class="absolute bottom-0 w-full h-full text-[var(--color-secondary-bg)]" viewBox="0 0 1440 100" preserveAspectRatio="none">
        <path fill="currentColor" d="M0,0 C240,100 480,100 720,50 C960,0 1200,0 1440,50 L1440,100 L0,100 Z"></path>
    </svg>
</div>

{{-- ============== SERVICES ============== --}}
<section class="py-20 bg-[var(--color-secondary-bg)]">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <span class="text-[var(--color-gold)] font-serif italic text-xl">Our Expertise</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2">Layanan Eksklusif</h2>
            <div class="w-24 h-1 bg-[var(--color-gold)] mx-auto mt-6 rounded-full"></div>
        </div>

        @php
        $services = [
          ['title' => 'Makeup & Hairdo', 'desc' => 'Tampil memukau dengan sentuhan makeup natural hingga bold.', 'icon' => '✨'],
          ['title' => 'Bridal Package', 'desc' => 'Solusi lengkap gaun, makeup, dan aksesoris pernikahan.', 'icon' => '👑'],
          ['title' => 'Prewedding', 'desc' => 'Abadikan kisah cintamu dalam bingkai visual yang artistik.', 'icon' => '📸'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($services as $service)
            <div class="group bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 p-8 rounded-2xl hover:border-[var(--color-gold)] transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--color-gold)]/10" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="text-5xl mb-6 group-hover:scale-110 transition duration-300">{{ $service['icon'] }}</div>
                <h3 class="text-2xl font-serif font-bold text-white mb-4 group-hover:text-[var(--color-gold)] transition">{{ $service['title'] }}</h3>
                <p class="text-[var(--color-text-muted)] leading-relaxed mb-6">{{ $service['desc'] }}</p>
                <a href="{{ route('services') }}" class="inline-block text-[var(--color-gold)] font-bold uppercase tracking-widest text-sm border-b border-[var(--color-gold)] pb-1 hover:text-white hover:border-white transition">Details &rarr;</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============== TESTIMONIALS ============== --}}
<section class="py-20 relative bg-[var(--color-primary-bg)]">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <img src="{{ asset('portofoliol/portofolio2.jpg') }}" alt="Happy Couple" class="rounded-3xl shadow-2xl border-2 border-[var(--color-gold)]/30 w-full object-cover h-[500px]">
            </div>
            <div data-aos="fade-left">
                <span class="text-[var(--color-gold)] font-serif italic text-xl">Testimonials</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 mb-8">Love Stories</h2>
                
                <div x-data="{ i: 0, slides: {{ $testimonials->map(fn($t) => ['text' => $t->message, 'name' => $t->name, 'rating' => $t->rating])->toJson() }} }"
                     x-init="setInterval(() => { i = (i + 1) % slides.length }, 6000)"
                     class="relative bg-[var(--color-secondary-bg)] p-10 rounded-2xl border border-[var(--color-gold)]/20 shadow-xl">
                    
                     <div class="text-[var(--color-gold)] text-6xl font-serif absolute top-4 left-6 opacity-30">“</div>
                     
                     <div class="min-h-[160px] flex flex-col justify-center">
                        <p class="text-xl text-[var(--color-text-light)] font-light italic leading-relaxed" x-text="slides[i].text"></p>
                        <div class="flex items-center gap-1 mt-6 text-[var(--color-gold)]">
                            <template x-for="n in 5">
                                <span x-show="n <= slides[i].rating">★</span>
                            </template>
                        </div>
                        <p class="mt-2 font-bold text-white uppercase tracking-wider" x-text="'- ' + slides[i].name"></p>
                     </div>

                     <div class="flex gap-2 mt-8">
                        <template x-for="(s, idx) in slides" :key="idx">
                            <button @click="i = idx" class="h-1.5 rounded-full transition-all duration-300" 
                                :class="i === idx ? 'w-8 bg-[var(--color-gold)]' : 'w-2 bg-gray-600 hover:bg-gray-500'"></button>
                        </template>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============== CTA / BOOKING ============== --}}
<section id="booking" class="py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-[var(--color-gold)]/10"></div>
    <div class="relative z-10 container mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-6xl font-serif font-bold text-[var(--color-gold)] mb-6" data-aos="zoom-in">Ready to make it happen?</h2>
        <p class="text-xl text-[var(--color-text-light)] max-w-2xl mx-auto mb-10 font-light">
            Segera amankan tanggal pernikahanmu. Konsultasikan kebutuhanmu bersama tim profesional kami.
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center" data-aos="fade-up">
             <a href="https://wa.me/6281234567890" class="group bg-white text-[var(--color-primary-bg)] px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold)] hover:text-white transition shadow-xl flex items-center justify-center gap-3">
                <span>WhatsApp Us</span>
             </a>
             <a href="{{ route('booking.create') }}" class="group border-2 border-[var(--color-gold)] text-[var(--color-gold)] px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition flex items-center justify-center gap-3">
                <span>Book Online</span>
             </a>
        </div>
    </div>
</section>
</div>
@endsection
