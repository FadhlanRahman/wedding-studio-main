@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] text-[var(--color-text-light)] overflow-hidden">

    {{-- ============== HERO SECTION ============== --}}
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('background/background.jpeg') }}" class="w-full h-full object-cover opacity-40 animate-slow-zoom">
             <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-primary-bg)] to-transparent"></div>
        </div>
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <span class="text-[var(--color-gold)] font-serif italic text-2xl tracking-widest mb-4 block">Behind the Elegance</span>
            <h1 class="text-5xl md:text-7xl font-serif font-bold text-white mb-6">Our Journey</h1>
            <p class="max-w-2xl mx-auto text-lg text-[var(--color-text-muted)] font-light leading-relaxed">
                Mengenal lebih dekat dedikasi dan cinta yang kami tuangkan dalam setiap pernikahan yang kami sempurnakan.
            </p>
        </div>
    </section>

    {{-- ============== STORY / TIMELINE ============== --}}
    <section class="py-24 relative">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-serif font-bold text-[var(--color-gold)] mb-8">A Decade of Love</h2>
                    <p class="text-[var(--color-text-light)] leading-relaxed mb-6 text-lg">
                        <span class="font-bold text-white">Ellen Wedding Studio</span> bermula dari sebuah impian sederhana: membuat setiap pengantin wanita merasa seperti Ratu di hari bahagianya.
                    </p>
                    <p class="text-[var(--color-text-muted)] leading-relaxed mb-8">
                        Berdiri sejak 2013, kami telah melayani lebih dari 500 pasangan dengan sentuhan personal, busana eksklusif, dan makeup yang menonjolkan kecantikan alami. Kami percaya bahwa pernikahan bukan sekadar acara, tetapi sebuah masterpiece cinta.
                    </p>
                    
                    {{-- Timeline Items --}}
                    <div class="space-y-8 pl-8 border-l border-[var(--color-gold)]/30 relative">
                        <div class="relative">
                            <span class="absolute -left-[39px] top-1 w-5 h-5 rounded-full bg-[var(--color-gold)] border-4 border-[var(--color-primary-bg)]"></span>
                            <h4 class="text-white font-bold text-lg">2013</h4>
                            <p class="text-sm text-[var(--color-text-muted)]">Didirikan dengan studio kecil di garasi rumah.</p>
                        </div>
                        <div class="relative">
                             <span class="absolute -left-[39px] top-1 w-5 h-5 rounded-full bg-[var(--color-gold)] border-4 border-[var(--color-primary-bg)]"></span>
                            <h4 class="text-white font-bold text-lg">2016</h4>
                            <p class="text-sm text-[var(--color-text-muted)]">Membuka galeri resmi pertama dan meluncurkan koleksi gaun eksklusif.</p>
                        </div>
                        <div class="relative">
                             <span class="absolute -left-[39px] top-1 w-5 h-5 rounded-full bg-[var(--color-gold)] border-4 border-[var(--color-primary-bg)]"></span>
                            <h4 class="text-white font-bold text-lg">2023</h4>
                            <p class="text-sm text-[var(--color-text-muted)]">Dianugerahi "Best Wedding Vendor" kota dan melayani 500+ pengantin.</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                     <div class="absolute -inset-4 border-2 border-[var(--color-gold)]/20 rounded-full z-0 animate-spin-slow"></div>
                     <img src="{{ asset('portofoliol/portofolio2.jpg') }}" class="rounded-full shadow-2xl relative z-10 w-full max-w-md mx-auto aspect-square object-cover border-8 border-[var(--color-secondary-bg)]">
                </div>
            </div>
        </div>
    </section>

    {{-- ============== CORE VALUES ============== --}}
    <section class="py-24 bg-[var(--color-secondary-bg)] relative overflow-hidden">
        {{-- Decor --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-[var(--color-gold)]/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[var(--color-gold)] font-serif italic text-xl">Our Principles</span>
                <h2 class="text-4xl font-serif font-bold text-white mt-2">Why We Are Different</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-[var(--color-primary-bg)]/50 backdrop-blur-md p-8 rounded-2xl border border-[var(--color-gold)]/10 hover:border-[var(--color-gold)] transition duration-500 group" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-[var(--color-gold)]/10 text-[var(--color-gold)] rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition">💎</div>
                    <h3 class="text-xl font-bold text-white mb-4">Premium Elegance</h3>
                    <p class="text-[var(--color-text-muted)]">Kami hanya menggunakan material terbaik untuk gaun dan kosmetik high-end untuk hasil yang sempurna.</p>
                </div>
                <!-- Value 2 -->
                <div class="bg-[var(--color-primary-bg)]/50 backdrop-blur-md p-8 rounded-2xl border border-[var(--color-gold)]/10 hover:border-[var(--color-gold)] transition duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-[var(--color-gold)]/10 text-[var(--color-gold)] rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition">🤝</div>
                    <h3 class="text-xl font-bold text-white mb-4">Personal Touch</h3>
                    <p class="text-[var(--color-text-muted)]">Setiap pengantin unik. Kami mendengarkan cerita Anda dan mewujudkannya dalam detail pernikahan.</p>
                </div>
                <!-- Value 3 -->
                <div class="bg-[var(--color-primary-bg)]/50 backdrop-blur-md p-8 rounded-2xl border border-[var(--color-gold)]/10 hover:border-[var(--color-gold)] transition duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-[var(--color-gold)]/10 text-[var(--color-gold)] rounded-xl flex items-center justify-center text-3xl mb-6 group-hover:bg-[var(--color-gold)] group-hover:text-[var(--color-primary-bg)] transition">⏱</div>
                    <h3 class="text-xl font-bold text-white mb-4">Timely Perfection</h3>
                    <p class="text-[var(--color-text-muted)]">Profesionalisme adalah kunci. Kami memastikan setiap jadwal berjalan tepat waktu dan tanpa stres.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============== TEAM SECTION ============== --}}
    <section class="py-24">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-[var(--color-gold)] font-serif italic text-xl">The Artists</span>
                <h2 class="text-4xl font-serif font-bold text-white mt-2">Meet Our Experts</h2>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($teams as $team)
                <div class="group relative" data-aos="fade-up">
                    <div class="relative overflow-hidden rounded-2xl aspect-[3/4]">
                        @if($team->photo)
                            <img src="{{ asset('storage/'.$team->photo) }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0">
                        @else
                            <img src="{{ asset('team/default.jpg') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[var(--color-primary-bg)] via-transparent to-transparent opacity-80"></div>
                        
                        <div class="absolute bottom-0 left-0 w-full p-6 translate-y-4 group-hover:translate-y-0 transition duration-500">
                            <h4 class="text-xl font-bold text-white mb-1">{{ $team->name }}</h4>
                            <p class="text-[var(--color-gold)] text-sm uppercase tracking-wider mb-3">{{ $team->role }}</p>
                            <div class="flex gap-3 text-white opacity-0 group-hover:opacity-100 transition duration-500 delay-100">
                                <a href="#" class="hover:text-[var(--color-gold)]">IG</a>
                                <a href="#" class="hover:text-[var(--color-gold)]">FB</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center text-[var(--color-text-muted)]">
                    <p>Team members are being updated.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

</div>

<style>
    .animate-slow-zoom { animation: slowZoom 20s infinite alternate; }
    .animate-spin-slow { animation: spin 15s linear infinite; }
    @keyframes slowZoom { from { transform: scale(1); } to { transform: scale(1.1); } }
    @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
@endsection
