@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] text-[var(--color-text-light)] overflow-hidden">

     {{-- ============== HERO SECTION ============== --}}
     <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('background/background.jpeg') }}" class="w-full h-full object-cover opacity-30">
             <div class="absolute inset-0 bg-gradient-to-b from-[var(--color-primary-bg)]/80 to-[var(--color-primary-bg)]"></div>
        </div>
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <span class="text-[var(--color-gold)] font-serif italic text-xl tracking-widest mb-4 block">Exclusive Offerings</span>
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6">Our Services</h1>
             <div class="w-24 h-1 bg-[var(--color-gold)] mx-auto rounded-full"></div>
        </div>
    </section>

    {{-- ============== PROCESS STEPS ============== --}}
    <section class="pb-24 relative -mt-20 z-20">
        <div class="container mx-auto px-6">
            <div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-3xl p-10 shadow-2xl" data-aos="fade-up">
                 <div class="text-center mb-12">
                     <h2 class="text-2xl font-bold text-white uppercase tracking-widest">How It Works</h2>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
                     {{-- Connecting Line (Desktop) --}}
                     <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-[var(--color-gold)]/20 -z-0"></div>

                     {{-- Step 1 --}}
                      <div class="text-center relative z-10 group">
                          <div class="w-24 h-24 mx-auto bg-[var(--color-primary-bg)] border-2 border-[var(--color-gold)] rounded-full flex items-center justify-center text-3xl mb-4 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300 shadow-lg">☕</div>
                          <h4 class="text-white font-bold mb-2">1. Consultation</h4>
                          <p class="text-sm text-[var(--color-text-muted)]">Diskusi santai mengenai konsep & impian pernikahan Anda.</p>
                      </div>

                       {{-- Step 2 --}}
                       <div class="text-center relative z-10 group">
                        <div class="w-24 h-24 mx-auto bg-[var(--color-primary-bg)] border-2 border-[var(--color-gold)] rounded-full flex items-center justify-center text-3xl mb-4 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300 shadow-lg">👗</div>
                        <h4 class="text-white font-bold mb-2">2. Fitting</h4>
                        <p class="text-sm text-[var(--color-text-muted)]">Mencoba gaun impian atau test makeup dengan MUA kami.</p>
                    </div>

                     {{-- Step 3 --}}
                     <div class="text-center relative z-10 group">
                        <div class="w-24 h-24 mx-auto bg-[var(--color-primary-bg)] border-2 border-[var(--color-gold)] rounded-full flex items-center justify-center text-3xl mb-4 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300 shadow-lg">📅</div>
                        <h4 class="text-white font-bold mb-2">3. Booking</h4>
                        <p class="text-sm text-[var(--color-text-muted)]">Amankan tanggal dan finalisasi detail paket pilihan.</p>
                    </div>

                     {{-- Step 4 --}}
                     <div class="text-center relative z-10 group">
                        <div class="w-24 h-24 mx-auto bg-[var(--color-primary-bg)] border-2 border-[var(--color-gold)] rounded-full flex items-center justify-center text-3xl mb-4 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300 shadow-lg">💍</div>
                        <h4 class="text-white font-bold mb-2">4. Big Day</h4>
                        <p class="text-sm text-[var(--color-text-muted)]">Nikmati momen bahagia Anda, biarkan kami yang bekerja.</p>
                    </div>
                 </div>
            </div>
        </div>
    </section>

    {{-- ============== SERVICES GRID ============== --}}
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                <div class="group relative bg-[var(--color-secondary-bg)]/50 border border-[var(--color-gold)]/10 rounded-3xl overflow-hidden hover:border-[var(--color-gold)] transition duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[var(--color-gold)]/10 flex flex-col h-full" data-aos="fade-up">
                    
                    {{-- Price Tag --}}
                    <div class="absolute top-0 right-0 bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold px-6 py-2 rounded-bl-2xl text-sm z-20">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </div>

                    <div class="p-8 flex-grow">
                         <div class="w-16 h-16 bg-[var(--color-primary-bg)] rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-inset border border-[var(--color-gold)]/20 text-[var(--color-gold)]">{{ $service->icon }}</div>
                         <h3 class="text-2xl font-serif font-bold text-white mb-4 group-hover:text-[var(--color-gold)] transition">{{ $service->title }}</h3>
                         <p class="text-[var(--color-text-muted)] mb-6 text-sm leading-relaxed border-t border-white/5 pt-4">
                             {{ $service->description }}
                         </p>
                    </div>
                    
                    <div class="p-8 pt-0 mt-auto">
                        @if ($service->pdf_path)
                            <a href="{{ asset('storage/' . $service->pdf_path) }}" target="_blank" class="block w-full text-center border border-[var(--color-gold)] text-[var(--color-gold)] px-4 py-3 rounded-xl hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition font-bold uppercase text-xs tracking-widest flex items-center justify-center gap-2">
                                <span>📄 View Details</span>
                            </a>
                        @else
                           <button disabled class="block w-full text-center border border-gray-700 text-gray-500 px-4 py-3 rounded-xl cursor-not-allowed font-bold uppercase text-xs tracking-widest">
                                Details Unavailable
                            </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============== WHY CHOOSE US (COMPARISON) ============== --}}
    <section class="py-24 bg-[var(--color-secondary-bg)]">
        <div class="container mx-auto px-6 max-w-5xl">
             <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-white">Why Choose Ellen Studio?</h2>
            </div>
            
            <div class="bg-[var(--color-primary-bg)] rounded-3xl border border-[var(--color-gold)]/20 overflow-hidden shadow-2xl" data-aos="zoom-in">
                <div class="grid grid-cols-3 text-center border-b border-[var(--color-gold)]/20 font-bold text-sm md:text-base bg-[var(--color-gold)]/5">
                    <div class="p-6 text-[var(--color-text-muted)]">Feature</div>
                    <div class="p-6 text-[var(--color-gold)] border-x border-[var(--color-gold)]/20">Ellen Studio</div>
                    <div class="p-6 text-gray-500">Others</div>
                </div>
                
                {{-- Row 1 --}}
                 <div class="grid grid-cols-3 text-center border-b border-white/5 text-sm items-center">
                    <div class="p-4 md:p-6 text-[var(--color-text-light)] font-medium text-left md:text-center">Custom Gown Design</div>
                    <div class="p-4 md:p-6 text-[var(--color-gold)] border-x border-[var(--color-gold)]/20 bg-[var(--color-gold)]/5">Included</div>
                    <div class="p-4 md:p-6 text-gray-500">Add-on Cost</div>
                </div>
                
                 {{-- Row 2 --}}
                 <div class="grid grid-cols-3 text-center border-b border-white/5 text-sm items-center">
                    <div class="p-4 md:p-6 text-[var(--color-text-light)] font-medium text-left md:text-center">Makeup Retouch</div>
                    <div class="p-4 md:p-6 text-[var(--color-gold)] border-x border-[var(--color-gold)]/20 bg-[var(--color-gold)]/5">Unlimited</div>
                    <div class="p-4 md:p-6 text-gray-500">1x Only</div>
                </div>

                 {{-- Row 3 --}}
                 <div class="grid grid-cols-3 text-center text-sm items-center">
                    <div class="p-4 md:p-6 text-[var(--color-text-light)] font-medium text-left md:text-center">Consultation</div>
                    <div class="p-4 md:p-6 text-[var(--color-gold)] border-x border-[var(--color-gold)]/20 bg-[var(--color-gold)]/5">Free Lifetime</div>
                    <div class="p-4 md:p-6 text-gray-500">Paid</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============== BOOKING CTA ============== --}}
    <section class="py-24 text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-serif font-bold text-white mb-6">Ready to shine?</h2>
            <a href="{{ route('booking.create') }}" class="inline-block bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-10 py-5 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/30 transform hover:scale-105">
                Book Your Date
            </a>
        </div>
    </section>

</div>
@endsection
