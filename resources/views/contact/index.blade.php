@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] min-h-screen relative overflow-hidden text-[var(--color-text-light)]">

    {{-- ============== HEADER ============== --}}
    <section class="pt-32 pb-12 text-center relative z-10 px-6">
        <span class="text-[var(--color-gold)] font-serif italic text-xl tracking-widest mb-2 block animate-fadeIn">Get in Touch</span>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6 animate-fadeInUp">Contact Us</h1>
        <p class="max-w-xl mx-auto text-[var(--color-text-muted)] font-light text-lg animate-fadeInUp delay-100">
            Kami siap mendengar cerita dan impian pernikahan Anda. Hubungi kami untuk konsultasi atau sekadar menyapa.
        </p>
    </section>

    <div class="container mx-auto px-6 pb-24 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12">
            
            {{-- CONTACT INFO CARDS (Left) --}}
            <div class="lg:col-span-5 space-y-6">
                <!-- Address Card -->
                <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-md p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl group hover:border-[var(--color-gold)]/50 transition duration-500" data-aos="fade-right">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-gold)]/10 flex items-center justify-center text-2xl group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300">📍</div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-2">Visit Studio</h4>
                            <p class="text-[var(--color-text-muted)] leading-relaxed text-sm">
                                {{ $contact->address ?? 'Jl. Mawar No. 123, Kota Indah, Indonesia' }}
                            </p>
                            <a href="https://maps.google.com" target="_blank" class="text-[var(--color-gold)] text-xs font-bold uppercase tracking-widest mt-4 inline-block hover:text-white transition">Get Directions →</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-md p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl group hover:border-[var(--color-gold)]/50 transition duration-500" data-aos="fade-right" data-aos-delay="100">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-gold)]/10 flex items-center justify-center text-2xl group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300">📞</div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-2">Talk to Us</h4>
                            <p class="text-[var(--color-text-muted)] text-sm mb-1">
                                WA: {{ $contact->whatsapp ?? '+62 812 3456 7890' }}
                            </p>
                            <p class="text-[var(--color-text-muted)] text-sm">
                                Phone: {{ $contact->phone ?? '+62 812 3456 7890' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Email/Social Card -->
                <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-md p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl group hover:border-[var(--color-gold)]/50 transition duration-500" data-aos="fade-right" data-aos-delay="200">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-[var(--color-gold)]/10 flex items-center justify-center text-2xl group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition duration-300">💌</div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-4">Connect</h4>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">IG</a>
                                <a href="#" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">FB</a>
                                <a href="mailto:{{ $contact->email ?? 'hello@ellenstudio.com' }}" class="w-10 h-10 rounded-full border border-[var(--color-gold)]/30 flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition">✉️</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM SECTION (Right) --}}
            <div class="lg:col-span-7">
                <div class="bg-[var(--color-primary-bg)] p-8 md:p-12 rounded-[40px] border border-[var(--color-gold)]/20 shadow-2xl relative overflow-hidden" data-aos="fade-left">
                    {{-- Form Decor --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[var(--color-gold)]/10 rounded-full blur-3xl"></div>
                    
                    <h3 class="text-2xl font-serif font-bold text-white mb-8">Send us a Message</h3>

                    <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-widest text-[var(--color-gold)] font-bold pl-2" for="name">Your Name</label>
                                <input type="text" id="name" name="name" required class="w-full bg-[var(--color-secondary-bg)] border border-transparent focus:border-[var(--color-gold)] text-white rounded-xl px-5 py-4 focus:outline-none focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/10" placeholder="John Doe">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs uppercase tracking-widest text-[var(--color-gold)] font-bold pl-2" for="email">Email Address</label>
                                <input type="email" id="email" name="email" required class="w-full bg-[var(--color-secondary-bg)] border border-transparent focus:border-[var(--color-gold)] text-white rounded-xl px-5 py-4 focus:outline-none focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/10" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="space-y-2">
                             <label class="text-xs uppercase tracking-widest text-[var(--color-gold)] font-bold pl-2" for="message">Message / Inquiry</label>
                             <textarea id="message" name="message" rows="5" required class="w-full bg-[var(--color-secondary-bg)] border border-transparent focus:border-[var(--color-gold)] text-white rounded-xl px-5 py-4 focus:outline-none focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/10" placeholder="Tell us about your dream wedding..."></textarea>
                        </div>

                        {{-- Nice Rating Input --}}
                        <div class="space-y-2">
                             <label class="text-xs uppercase tracking-widest text-[var(--color-gold)] font-bold pl-2">Rate Us (Optional)</label>
                             <div class="flex gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="rating" value="{{ $i }}" class="hidden peer">
                                        <svg class="w-8 h-8 text-[var(--color-secondary-bg)] stroke-[var(--color-gold)] stroke-2 peer-checked:fill-[var(--color-gold)] group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    </label>
                                @endfor
                             </div>
                        </div>

                        <button type="submit" class="w-full bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold uppercase tracking-widest py-5 rounded-xl hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/20 hover:-translate-y-1 transform duration-300">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============== MAP ============== --}}
    <section class="h-[400px] w-full grayscale contrast-125 hover:grayscale-0 transition duration-700 relative">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15957.170678258284!2d100.3524675!3d-0.9168944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b942e2b117bb%3A0xb8468cb5dd417161!2sKota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1684423456789!5m2!1sid!2sid" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="absolute inset-0 bg-[var(--color-primary-bg)]/20 pointer-events-none"></div>
    </section>

</div>

<style>
    .delay-100 { animation-delay: 100ms; }
    .animate-fadeInUp { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; opacity: 0; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
@endsection
