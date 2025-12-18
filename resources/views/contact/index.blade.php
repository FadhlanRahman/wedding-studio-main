@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] min-h-screen py-20 relative overflow-hidden">
     {{-- Background Decor --}}
     <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 mix-blend-overlay"></div>
     <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-[var(--color-secondary-bg)] to-transparent"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">

        {{-- Header --}}
        <section class="text-center mb-16">
            <span class="text-[var(--color-gold)] font-serif italic text-xl">Get in Touch</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6 animate-fadeInUp">
                Contact Us
            </h2>
            <div class="w-16 h-1 bg-[var(--color-gold)] mx-auto mb-6 rounded-full"></div>
            <p class="text-[var(--color-text-muted)] text-lg md:text-xl max-w-3xl mx-auto animate-fadeInUp font-light" style="animation-delay:100ms;">
                Kami siap membantu Anda mewujudkan pernikahan impian dimanapun.
                Hubungi kami untuk konsultasi gratis atau kunjungi studio kami.
            </p>
        </section>

        {{-- Grid Form + Info --}}
        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Form Kontak --}}
            <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-sm p-8 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20 animate-fadeInUp" style="animation-delay:200ms;">
                <h3 class="text-2xl font-serif font-bold text-white mb-6 border-b border-[var(--color-gold)]/10 pb-4">Kirim Pesan</h3>
                <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-[var(--color-gold)] font-medium mb-2 uppercase text-xs tracking-widest" for="name">Nama</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 text-white rounded-xl focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/20"
                            placeholder="Nama lengkap">
                    </div>
                    <div>
                        <label class="block text-[var(--color-gold)] font-medium mb-2 uppercase text-xs tracking-widest" for="email">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 text-white rounded-xl focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/20"
                            placeholder="email@example.com">
                    </div>
                    <div>
                        <label class="block text-[var(--color-gold)] font-medium mb-2 uppercase text-xs tracking-widest" for="message">Pesan</label>
                        <textarea id="message" name="message" rows="4" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 text-white rounded-xl focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition placeholder-white/20"
                            placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>

                    {{-- Rating Bintang --}}
                    <div>
                        <label class="block text-[var(--color-gold)] font-medium mb-2 uppercase text-xs tracking-widest">Rating</label>
                        <div class="flex space-x-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer/star{{ $i }}">
                                <label for="star{{ $i }}" class="cursor-pointer text-2xl text-[var(--color-secondary-bg)] stroke-current stroke-2 peer-checked/star{{ $i }}:text-[var(--color-gold)] transition transform hover:scale-110">
                                    ★
                                </label>
                            @endfor
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-[var(--color-gold)] hover:bg-[var(--color-gold-light)] text-[var(--color-primary-bg)] font-bold py-4 px-6 rounded-xl shadow-lg transition transform hover:translate-y-px uppercase tracking-widest text-sm">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            {{-- Info Kontak & Sosial Media --}}
            <div class="space-y-8 animate-fadeInUp" style="animation-delay:300ms;">
                 <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-sm p-8 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20">
                    <h3 class="text-2xl font-serif font-bold text-white mb-6 border-b border-[var(--color-gold)]/10 pb-4">Info Kontak</h3>

                    <div class="space-y-6">
                        {{-- Telepon --}}
                        <div class="flex items-start gap-4">
                            <span class="bg-[var(--color-gold)]/20 p-3 rounded-lg text-[var(--color-gold)]">📞</span>
                            <div>
                                <strong class="block text-[var(--color-gold)] uppercase text-xs tracking-widest mb-1">Telepon</strong>
                                @if(!empty($contact->phone))
                                    <a href="tel:{{ $contact->phone }}" class="text-white hover:text-[var(--color-gold)] transition">
                                        {{ $contact->phone }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Belum tersedia</span>
                                @endif
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                             <span class="bg-[var(--color-gold)]/20 p-3 rounded-lg text-[var(--color-gold)]">✉️</span>
                             <div>
                                <strong class="block text-[var(--color-gold)] uppercase text-xs tracking-widest mb-1">Email</strong>
                                @if(!empty($contact->email))
                                    <a href="mailto:{{ $contact->email }}" class="text-white hover:text-[var(--color-gold)] transition">
                                        {{ $contact->email }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Belum tersedia</span>
                                @endif
                             </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                             <span class="bg-[var(--color-gold)]/20 p-3 rounded-lg text-[var(--color-gold)]">📍</span>
                             <div>
                                <strong class="block text-[var(--color-gold)] uppercase text-xs tracking-widest mb-1">Alamat</strong>
                                <span class="text-white leading-relaxed">{{ $contact->address ?? '-' }}</span>
                             </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                 <div class="bg-[var(--color-secondary-bg)]/80 backdrop-blur-sm p-8 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20 text-center">
                    <h3 class="text-lg font-serif font-bold text-white mb-6">Follow Our Journey</h3>
                    <div class="flex justify-center space-x-6">
                        @if(!empty($contact->instagram))
                            <a href="https://instagram.com/{{ ltrim($contact->instagram, '@') }}" target="_blank" 
                            class="w-12 h-12 rounded-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)] flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition duration-300">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        @endif
                         @if(!empty($contact->whatsapp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank" 
                            class="w-12 h-12 rounded-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)] flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition duration-300">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                        @endif
                         @if(!empty($contact->email))
                            <a href="mailto:{{ $contact->email }}"
                            class="w-12 h-12 rounded-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)] flex items-center justify-center text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition duration-300">
                                <i class="fas fa-envelope text-xl"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeInUp {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeInUp { 
    animation: fadeInUp 0.8s ease-out forwards; 
    opacity: 0; 
}
/* Custom radio star color trick if direct svg/unicode not enough */
input[type="radio"]:checked + label {
    color: var(--color-gold);
}
</style>
@endsection
