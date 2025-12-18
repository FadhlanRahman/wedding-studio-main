@extends('layouts.app')

@section('content')
<section class="relative min-h-screen py-20 bg-[var(--color-primary-bg)]">
    {{-- Background Pattern/Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-b from-[var(--color-secondary-bg)] to-[var(--color-primary-bg)] opacity-50"></div>
    
    {{-- Main Content --}}
    <div class="relative z-10 container mx-auto px-6">
        <div class="max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-[var(--color-secondary-bg)]/50 backdrop-blur-sm border border-[var(--color-gold)]/20 animate-fadeIn">

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- About Column --}}
                <div class="p-8 sm:p-12 border-b md:border-b-0 md:border-r border-[var(--color-gold)]/20 flex flex-col justify-center">
                    <span class="text-[var(--color-gold)] font-serif italic text-lg mb-2">Our Story</span>
                    <h2 class="text-4xl sm:text-5xl font-serif font-bold text-white mb-6">Tentang Kami</h2>
                    <p class="text-[var(--color-text-muted)] mb-8 leading-relaxed text-lg text-justify font-light">
                        <span class="text-[var(--color-gold)] font-bold">Ellen Wedding Studio</span> adalah penyedia layanan pernikahan profesional yang berkomitmen
                        menghadirkan momen indah dan tak terlupakan. Dengan sentuhan budaya yang elegan dan modern, kami siap
                        membantu Anda dari perencanaan hingga pelaksanaan acara yang sakral.
                    </p>

                    <div class="bg-[var(--color-primary-bg)] p-6 rounded-xl border border-[var(--color-gold)]/30 shadow-inner">
                        <h3 class="text-xl font-serif font-semibold text-[var(--color-gold)] mb-4 flex items-center gap-2">
                            <span>🏆</span> Pengalaman & Sertifikasi
                        </h3>
                        <ul class="text-[var(--color-text-light)] space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-gold)]"></span>
                                10+ Tahun pengalaman industri
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-gold)]"></span>
                                Sertifikasi MUA Profesional
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-gold)]"></span>
                                Tim Fotografi & Videografi Artistik
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-gold)]"></span>
                                Layanan Busana Adat Lengkap
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Team Column --}}
                <div class="p-8 sm:p-12 flex flex-col justify-center bg-[var(--color-primary-bg)]/30">
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white mb-10 text-center">
                        Meet The Team
                        <div class="w-16 h-1 bg-[var(--color-gold)] mx-auto mt-4 rounded-full"></div>
                    </h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                        @forelse($teams as $team)
                            <div class="group flex flex-col items-center text-center">
                                {{-- Photo --}}
                                <div class="relative mb-4">
                                    <div class="absolute inset-0 bg-[var(--color-gold)] rounded-full blur opacity-20 group-hover:opacity-40 transition"></div>
                                    @if($team->photo)
                                        <img src="{{ asset('storage/'.$team->photo) }}" class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-2 border-[var(--color-gold)] shadow-lg group-hover:scale-105 transition duration-300">
                                    @else
                                        <img src="{{ asset('team/default.jpg') }}" class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover border-2 border-[var(--color-gold)] shadow-lg group-hover:scale-105 transition duration-300">
                                    @endif
                                </div>

                                {{-- Name & Role --}}
                                <h4 class="font-serif font-semibold text-[var(--color-gold)] text-base sm:text-lg">{{ $team->name }}</h4>
                                <p class="text-[var(--color-text-muted)] text-sm tracking-wide">{{ $team->role }}</p>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-[var(--color-text-muted)] italic py-10">
                                Belum ada anggota tim yang ditambahkan.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- FadeIn Animation --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
@endsection
