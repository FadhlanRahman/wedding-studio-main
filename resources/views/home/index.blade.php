@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] text-[var(--color-text-light)] overflow-hidden">

{{-- ============== HERO SECTION ============== --}}
<section class="relative min-h-screen flex items-center pt-28 pb-20 overflow-hidden">
  {{-- Background Image with Gradient Overlay --}}
  <div class="absolute inset-0 z-0">
    <img
      src="{{ asset('background/background.jpeg') }}"
      alt="Ellen Wedding Studio Background"
      class="w-full h-full object-cover opacity-50 mix-blend-overlay scale-105 animate-slow-zoom"
      loading="lazy">
    <div class="absolute inset-0 bg-gradient-to-r from-[var(--color-primary-bg)] via-[var(--color-primary-bg)]/90 to-[var(--color-secondary-bg)]/30"></div>
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
  </div>

  <div class="container mx-auto px-6 relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    {{-- Left Content --}}
    <div class="space-y-8" data-aos="fade-right" data-aos-duration="1000">
      <div class="inline-block relative">
        <div class="absolute -left-6 top-0 w-1 h-full bg-[var(--color-gold)]/50 rounded-full"></div>
        <span class="text-[var(--color-gold)] font-serif italic text-2xl tracking-widest pl-2 mb-2 block">Ellen Wedding Studio</span>
        <h1 class="font-serif text-6xl md:text-8xl leading-none text-white drop-shadow-lg">
            BEAUTY OF <br>
            <span class="text-[var(--color-gold)] italic font-light">elegance</span>
        </h1>
        <p class="mt-6 text-xl text-[var(--color-text-muted)] max-w-lg leading-relaxed border-l-2 border-[var(--color-gold)]/20 pl-6">
            Mewujudkan pernikahan impian dengan sentuhan makeup flawless dan busana pengantin eksklusif yang memikat hati.
        </p>
      </div>

      <div class="pt-4 flex flex-wrap gap-5">
          <a href="#booking" class="group relative px-8 py-4 bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold uppercase tracking-widest rounded-full overflow-hidden shadow-lg shadow-[var(--color-gold)]/20 transition-all hover:scale-105 hover:shadow-[var(--color-gold)]/40">
              <span class="relative z-10 flex items-center gap-2">
                  Booking Now <span class="group-hover:translate-x-1 transition-transform">→</span>
              </span>
              <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          </a>
          <a href="{{ route('portofolio') }}" class="group relative px-8 py-4 border border-[var(--color-gold)] text-[var(--color-gold)] font-bold uppercase tracking-widest rounded-full overflow-hidden transition-all hover:text-[var(--color-primary-bg)]">
              <span class="relative z-10">View Gallery</span>
              <div class="absolute inset-0 bg-[var(--color-gold)] translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
          </a>
      </div>

      {{-- Stats Row --}}
      <div class="grid grid-cols-3 gap-6 pt-8 border-t border-[var(--color-gold)]/10" x-data="{ shown: false }" x-intersect="shown = true">
          <div class="text-center lg:text-left">
              <h4 class="text-3xl font-serif font-bold text-white"><span x-show="shown" x-transition.duration.1000ms class="count-up" data-value="10">10</span>+</h4>
              <p class="text-xs uppercase tracking-widest text-[var(--color-text-muted)]">Years Exp</p>
          </div>
          <div class="text-center lg:text-left">
              <h4 class="text-3xl font-serif font-bold text-white"><span x-show="shown" x-transition.duration.1000ms class="count-up" data-value="500">500</span>+</h4>
              <p class="text-xs uppercase tracking-widest text-[var(--color-text-muted)]">Happy Brides</p>
          </div>
          <div class="text-center lg:text-left">
              <h4 class="text-3xl font-serif font-bold text-white"><span x-show="shown" x-transition.duration.1000ms class="count-up" data-value="50">50</span>+</h4>
              <p class="text-xs uppercase tracking-widest text-[var(--color-text-muted)]">Awards</p>
          </div>
      </div>
    </div>

    {{-- Right Content (Image Composition) --}}
    <div class="hidden lg:block relative perspective-1000" data-aos="fade-left" data-aos-duration="1200">
        <div class="relative z-10 w-full max-w-lg ml-auto transform rotate-y-6 hover:rotate-y-0 transition duration-700 ease-out">
            <div class="absolute -inset-4 border border-[var(--color-gold)]/30 rounded-t-[150px] rounded-b-3xl scale-105"></div>
            <img src="{{ asset('portofoliol/portofolio1.jpg') }}" 
                 alt="Bride Portrait" 
                 class="w-full h-[600px] object-cover rounded-t-[150px] rounded-b-3xl shadow-2xl border border-[var(--color-gold)]/20 shadow-[var(--color-gold)]/10">
            
            {{-- Floating Card --}}
            <div class="absolute bottom-10 -left-12 bg-[var(--color-secondary-bg)]/90 backdrop-blur-md p-5 rounded-2xl border border-[var(--color-gold)]/40 shadow-xl max-w-xs animate-float">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-10 h-10 rounded-full bg-[var(--color-gold)] flex items-center justify-center text-[var(--color-primary-bg)] font-bold text-lg">✨</div>
                    <div>
                        <h5 class="text-white font-serif font-bold">Premium Service</h5>
                        <p class="text-[var(--color-text-muted)] text-xs">All-in-one Wedding Solution</p>
                    </div>
                </div>
                <div class="flex -space-x-2 overflow-hidden">
                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[var(--color-primary-bg)]" src="https://i.pravatar.cc/100?img=1" alt=""/>
                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[var(--color-primary-bg)]" src="https://i.pravatar.cc/100?img=5" alt=""/>
                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-[var(--color-primary-bg)]" src="https://i.pravatar.cc/100?img=9" alt=""/>
                    <div class="h-8 w-8 rounded-full bg-[var(--color-secondary-bg)] ring-2 ring-[var(--color-gold)] flex items-center justify-center text-[var(--color-gold)] text-xs font-bold">+2k</div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>

{{-- ============== SERVICES ============== --}}
<section class="py-24 bg-[var(--color-secondary-bg)] relative">
    {{-- Decorative Background --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-[var(--color-gold)]/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-[var(--color-gold)]/5 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <span class="text-[var(--color-gold)] font-serif italic text-xl tracking-wider">Our Services</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 leading-tight">Exclusive Wedding <br> Solutions</h2>
            </div>
            <a href="{{ route('services') }}" class="group flex items-center gap-2 text-[var(--color-gold)] font-bold uppercase tracking-widest text-sm hover:text-white transition pb-1 border-b border-[var(--color-gold)] hover:border-white">
                View All Services <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Service Card 1 --}}
            <div class="group relative bg-[var(--color-primary-bg)] rounded-3xl p-1 overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-gold)]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="bg-[var(--color-primary-bg)] h-full p-8 rounded-[20px] relative z-10 border border-[var(--color-gold)]/10 group-hover:border-[var(--color-gold)]/30 transition duration-300 flex flex-col">
                    <div class="w-16 h-16 bg-[var(--color-secondary-bg)] rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-500 shadow-lg">✨</div>
                    <h3 class="text-2xl font-serif font-bold text-white mb-4">Makeup & Hairdo</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 flex-grow">
                        Tampil memukau di hari spesial dengan sentuhan makeup natural hingga bold, disesuaikan dengan karakter wajah Anda.
                    </p>
                    <ul class="space-y-2 mb-8 text-sm text-[var(--color-text-light)]">
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Flawless Complexion</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Long-lasting Products</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Modern Hair Styling</li>
                    </ul>
                </div>
            </div>

            {{-- Service Card 2 --}}
            <div class="group relative bg-[var(--color-primary-bg)] rounded-3xl p-1 overflow-hidden transform md:-translate-y-6" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-gold)]/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="bg-[var(--color-primary-bg)] h-full p-8 rounded-[20px] relative z-10 border border-[var(--color-gold)]/10 group-hover:border-[var(--color-gold)]/30 transition duration-300 flex flex-col">
                     <div class="absolute top-0 right-0 bg-[var(--color-gold)] text-[var(--color-primary-bg)] text-xs font-bold px-3 py-1 rounded-bl-xl uppercase tracking-wider">Best Seller</div>
                    <div class="w-16 h-16 bg-[var(--color-secondary-bg)] rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-500 shadow-lg">👑</div>
                    <h3 class="text-2xl font-serif font-bold text-white mb-4">Bridal Package</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 flex-grow">
                        Paket lengkap untuk kenyamanan maksimal. Gaun pengantin eksklusif, makeup, hingga aksesoris premium.
                    </p>
                    <ul class="space-y-2 mb-8 text-sm text-[var(--color-text-light)]">
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Premium Gown Rental</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Full Accessories</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Touch-up Included</li>
                    </ul>
                </div>
            </div>

            {{-- Service Card 3 --}}
            <div class="group relative bg-[var(--color-primary-bg)] rounded-3xl p-1 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-gold)]/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                <div class="bg-[var(--color-primary-bg)] h-full p-8 rounded-[20px] relative z-10 border border-[var(--color-gold)]/10 group-hover:border-[var(--color-gold)]/30 transition duration-300 flex flex-col">
                    <div class="w-16 h-16 bg-[var(--color-secondary-bg)] rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-500 shadow-lg">📸</div>
                    <h3 class="text-2xl font-serif font-bold text-white mb-4">Prewedding</h3>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 flex-grow">
                        Abadikan kisah cintamu dalam bingkai visual yang artistik dan tak terlupakan sebelum hari bahagia.
                    </p>
                    <ul class="space-y-2 mb-8 text-sm text-[var(--color-text-light)]">
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Indoor / Outdoor Concept</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> Stylist Directed</li>
                        <li class="flex items-center gap-2"><span class="text-[var(--color-gold)]">✓</span> High Res Photos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============== PORTFOLIO SHOWCASE (NEW) ============== --}}
<section class="py-24 bg-[var(--color-primary-bg)] overflow-hidden">
    <div class="container mx-auto px-6 mb-12">
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="text-[var(--color-gold)] font-serif italic text-xl">Our Masterpieces</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 mb-8">Captured Moments</h2>
            <a href="{{ route('portofolio') }}" class="inline-block border border-[var(--color-gold)] text-[var(--color-gold)] px-8 py-3 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition text-sm">
                View Full Gallery
            </a>
        </div>
    </div>
    
    <!-- Swiper -->
    <div class="swiper mySwiper w-full px-4 md:px-12 pb-12" data-aos="fade-up" data-aos-delay="200">
        <div class="swiper-wrapper">
             {{-- Loop dummy or real images --}}
             @foreach(['portofoliol/portofolio1.jpg', 'portofoliol/portofolio2.jpg', 'portofoliol/portofolio3.jpg', 'portofoliol/portofolio4.jpeg', 'portofoliol/Sunset_wedding.jpg', 'portofoliol/White_themes.jpg'] as $img)
             <div class="swiper-slide w-80 md:w-96 grayscale hover:grayscale-0 transition duration-500 cursor-pointer group">
                 <div class="relative h-[500px] rounded-2xl overflow-hidden border border-[var(--color-gold)]/20">
                     <img src="{{ asset($img) }}" alt="Portfolio" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                     <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-primary-bg)] via-transparent to-transparent opacity-0 group-hover:opacity-90 transition duration-300"></div>
                     <div class="absolute bottom-6 left-6 translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-500 delay-100">
                         <span class="text-[var(--color-gold)] text-sm uppercase tracking-widest font-bold">Wedding Day</span>
                         <h4 class="text-white text-xl font-serif">The Beautiful Bride</h4>
                     </div>
                 </div>
             </div>
             @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

{{-- ============== TESTIMONIALS (IMPROVED) ============== --}}
<section class="py-24 relative bg-[var(--color-secondary-bg)] overflow-hidden">
    {{-- Decorative --}}
    <div class="absolute top-0 right-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/black-felt.png')] opacity-10"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative" data-aos="fade-right">
                <div class="absolute -inset-4 border-2 border-[var(--color-gold)]/20 rounded-tl-[100px] rounded-br-[100px] z-0"></div>
                <img src="{{ asset('portofoliol/portofolio3.jpg') }}" alt="Happy Couple" class="rounded-tl-[100px] rounded-br-[100px] shadow-2xl relative z-10 w-full object-cover h-[600px] brightness-90">
                <div class="absolute bottom-10 right-10 z-20 bg-white p-6 rounded-xl shadow-xl max-w-xs transform rotate-3 hover:rotate-0 transition duration-300">
                    <p class="text-[var(--color-primary-bg)] font-serif italic text-lg leading-relaxed">
                        "Thank you for making our special day absolutely perfect!"
                    </p>
                </div>
            </div>

            <div data-aos="fade-left">
                <span class="text-[var(--color-gold)] font-serif italic text-xl">Love Notes</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 mb-10">Stories from the Heart</h2>
                
                <div x-data="{ i: 0, slides: {{ $testimonials->map(fn($t) => ['text' => $t->message, 'name' => $t->name, 'rating' => $t->rating])->toJson() }} }"
                     x-init="setInterval(() => { i = (i + 1) % slides.length }, 6000)"
                     class="relative">
                    
                     <div class="text-[var(--color-gold)] text-8xl font-serif absolute -top-10 -left-6 opacity-20">“</div>
                     
                     <div class="min-h-[250px] relative">
                        <template x-for="(slide, index) in slides" :key="index">
                           <div x-show="i === index" 
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 translate-x-10"
                                x-transition:enter-end="opacity-100 translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 translate-x-0"
                                x-transition:leave-end="opacity-0 -translate-x-10"
                                class="absolute top-0 left-0 w-full">
                                <p class="text-2xl text-white font-serif italic leading-relaxed mb-6" x-text="slide.text"></p>
                                <div class="flex items-center gap-4 border-t border-[var(--color-gold)]/20 pt-6">
                                    <div class="w-12 h-12 bg-[var(--color-gold)] rounded-full flex items-center justify-center text-[var(--color-primary-bg)] font-bold text-xl uppercase" x-text="slide.name.charAt(0)"></div>
                                    <div>
                                        <h5 class="text-[var(--color-gold)] font-bold text-lg" x-text="slide.name"></h5>
                                        <div class="flex text-[var(--color-gold)] text-sm">
                                            <template x-for="n in 5">
                                                <span x-show="n <= slide.rating">★</span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </template>
                     </div>

                     <div class="flex gap-3 mt-8">
                        <template x-for="(s, idx) in slides" :key="idx">
                            <button @click="i = idx" class="transition-all duration-300 rounded-full h-2" 
                                :class="i === idx ? 'w-10 bg-[var(--color-gold)]' : 'w-2 bg-[var(--color-gold)]/20 hover:bg-[var(--color-gold)]/50'"></button>
                        </template>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============== FAQ (NEW) ============== --}}
<section class="py-24 bg-[var(--color-primary-bg)]">
    <div class="container mx-auto px-6 max-w-4xl">
         <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-serif font-bold text-white mb-4">Frequently Asked Questions</h2>
            <p class="text-[var(--color-text-muted)]">Informasi umum yang sering ditanyakan oleh calon pengantin.</p>
        </div>

        <div class="space-y-4" x-data="{ selected: null }">
            @php
            $faqs = [
                ['q' => 'Berapa lama sebaiknya booking dilakukan sebelum hari H?', 'a' => 'Kami menyarankan untuk melakukan booking minimal 3-6 bulan sebelum acara untuk memastikan ketersediaan tanggal, terutama di musim ramai pernikahan.'],
                ['q' => 'Apakah menyediakan layanan retouch makeup di lokasi?', 'a' => 'Ya, paket wedding kami sudah termasuk standby MUA untuk retouch agar penampilan Anda tetap sempurna sepanjang acara.'],
                ['q' => 'Bisakah request custom gaun pengantin?', 'a' => 'Tentu! Kami memiliki tim desainer dan penjahit in-house yang siap mewujudkan gaun impian Anda. Konsultasikan ide Anda bersama kami.'],
                ['q' => 'Apakah harga sudah termasuk transport ke luar kota?', 'a' => 'Harga di website berlaku untuk area dalam kota. Untuk luar kota, akan ada penyesuaian biaya transport dan akomodasi sesuai lokasi.'],
            ];
            @endphp

            @foreach($faqs as $index => $faq)
            <div class="border border-[var(--color-gold)]/20 rounded-xl overflow-hidden bg-[var(--color-secondary-bg)]/30 backdrop-blur-sm transition-all duration-300 hover:border-[var(--color-gold)]/50" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <button @click="selected !== {{ $index }} ? selected = {{ $index }} : selected = null" class="w-full px-6 py-5 flex items-center justify-between text-left focus:outline-none">
                    <span class="font-bold text-lg text-white font-serif">{{ $faq['q'] }}</span>
                    <span class="text-[var(--color-gold)] text-2xl transform transition-transform duration-300" :class="selected === {{ $index }} ? 'rotate-45' : 'rotate-0'">+</span>
                </button>
                <div x-ref="container{{ $index }}" x-show="selected === {{ $index }}" x-collapse class="px-6 pb-5 text-[var(--color-text-muted)] leading-relaxed border-t border-[var(--color-gold)]/10 pt-4">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============== CTA / BOOKING ============== --}}
<section id="booking" class="py-32 relative overflow-hidden flex items-center justify-center">
    <div class="absolute inset-0">
         <img src="{{ asset('background/background.jpeg') }}" class="w-full h-full object-cover opacity-20 filter blur-sm">
         <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-primary-bg)] via-[var(--color-primary-bg)]/80 to-[var(--color-primary-bg)]/90"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-6 text-center">
        <h2 class="text-5xl md:text-7xl font-serif font-bold text-[var(--color-gold)] mb-8" data-aos="zoom-in">Ready to say "I Do"?</h2>
        <p class="text-xl md:text-2xl text-[var(--color-text-light)] max-w-3xl mx-auto mb-12 font-light leading-relaxed">
            Tanggal cantik cepat terisi. Jangan biarkan tanggal impianmu diambil orang lain. <br>
            <span class="text-white font-medium">Konsultasikan pernikahanmu sekarang, Gratis!</span>
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center" data-aos="fade-up">
             <a href="https://wa.me/6281234567890" class="group bg-green-600 text-white px-10 py-5 rounded-full font-bold uppercase tracking-widest hover:bg-green-700 transition shadow-xl shadow-green-900/50 flex items-center justify-center gap-3 transform hover:-translate-y-1">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>WhatsApp Us</span>
             </a>
             <a href="{{ route('booking.create') }}" class="group bg-[var(--color-gold)] text-[var(--color-primary-bg)] border-2 border-[var(--color-gold)] px-10 py-5 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-xl shadow-[var(--color-gold)]/30 flex items-center justify-center gap-3 transform hover:-translate-y-1">
                <span>Book Via Website</span>
             </a>
        </div>
    </div>
</section>

{{-- ============== FOOTER (NEW) ============== --}}
<footer class="bg-[var(--color-secondary-bg)] border-t border-[var(--color-gold)]/20 pt-20 pb-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="md:col-span-2">
                <a href="{{ route('home') }}" class="inline-block mb-6">
                     <span class="text-[var(--color-gold)] font-serif italic text-2xl tracking-widest">Ellen Wedding Studio</span>
                </a>
                <p class="text-[var(--color-text-muted)] leading-relaxed max-w-sm mb-8">
                    Partner terpercaya untuk momen sekali seumur hidup. Kami menghadirkan keanggunan dan kesempurnaan dalam setiap detail pernikahan Anda.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">IG</a>
                    <a href="#" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">FB</a>
                    <a href="#" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">TK</a>
                </div>
            </div>
            
            <div>
                <h4 class="text-white font-serif font-bold text-xl mb-6">Quick Links</h4>
                <ul class="space-y-4 text-[var(--color-text-muted)]">
                    <li><a href="{{ route('home') }}" class="hover:text-[var(--color-gold)] transition">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[var(--color-gold)] transition">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-[var(--color-gold)] transition">Services</a></li>
                    <li><a href="{{ route('portofolio') }}" class="hover:text-[var(--color-gold)] transition">Portfolio</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[var(--color-gold)] transition">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-serif font-bold text-xl mb-6">Contact</h4>
                <ul class="space-y-4 text-[var(--color-text-muted)]">
                    <li class="flex items-start gap-3">
                        <span class="text-[var(--color-gold)]">📍</span>
                        <span>Jl. Mawar No. 123, Kota Indah, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-[var(--color-gold)]">📞</span>
                        <span>+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-[var(--color-gold)]">✉️</span>
                        <span>hello@ellenstudio.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-[var(--color-gold)]/10 pt-8 text-center text-[var(--color-text-muted)] text-sm">
            &copy; {{ date('Y') }} Ellen Wedding Studio. All Rights Reserved. Designed with <span class="text-red-500">❤</span>
        </div>
    </div>
</footer>

</div>

{{-- External Scripts for Swiper --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                centeredSlides: false,
            },
            1024: {
                slidesPerView: 3,
                centeredSlides: false,
            }
        }
    });

    // Custom Counter Animation
    document.addEventListener('alpine:init', () => {
        Alpine.directive('intersect', (el, { expression }, { evaluateLater }) => {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        evaluateLater(expression)()
                        observer.disconnect()
                    }
                })
            })
            observer.observe(el)
        })
    })
</script>

<style>
    .count-up { animation: fadeInUp 1s ease-out; }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-slow-zoom { animation: slowZoom 20s infinite alternate; }
    @keyframes slowZoom { from { transform: scale(1); } to { transform: scale(1.1); } }
</style>
@endsection
