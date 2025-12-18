@extends('layouts.app')

@section('content')

<section class="relative min-h-screen py-20 bg-[var(--color-primary-bg)]">
   {{-- Background Accents --}}
   <div class="absolute top-0 right-0 w-96 h-96 bg-[var(--color-gold)]/10 rounded-full blur-[100px] pointer-events-none"></div>
   <div class="absolute bottom-0 left-0 w-64 h-64 bg-[var(--color-secondary-bg)] rounded-full blur-[80px] pointer-events-none"></div>

  <div class="relative z-10 container mx-auto px-6">
    {{-- Header --}}
    <header class="text-center mb-16 fade-in-up">
      <span class="text-[var(--color-gold)] font-serif italic text-xl">Exclusive Offerings</span>
      <h1 class="mt-2 text-4xl md:text-5xl font-serif font-bold text-white">
        Our Wedding Services
      </h1>
      <div class="w-24 h-1 bg-[var(--color-gold)] mx-auto mt-6 rounded-full"></div>
      <p class="mt-6 text-[var(--color-text-muted)] max-w-2xl mx-auto text-lg font-light leading-relaxed">
        Rangkaian layanan eksklusif yang dirancang untuk menyempurnakan hari istimewa Anda dengan sentuhan kemewahan dan tradisi.
      </p>
    </header>

    {{-- Services Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
      @foreach ($services as $service)
        <article class="service-card group relative w-full rounded-2xl p-8 border border-[var(--color-gold)]/20 bg-[var(--color-primary-bg)]/50 backdrop-blur-md hover:border-[var(--color-gold)] hover:bg-[var(--color-secondary-bg)] hover:-translate-y-2 transition-all duration-500 shadow-xl">
          {{-- Price Badge --}}
          <div class="absolute top-0 right-0 bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold px-4 py-2 rounded-bl-2xl rounded-tr-2xl text-sm shadow-lg">
            Rp {{ number_format($service->price, 0, ',', '.') }}
          </div>

          <div class="flex flex-col items-center text-center relative z-10 pt-6">
            <div class="w-20 h-20 rounded-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/40 flex items-center justify-center mb-6 shadow-inner group-hover:scale-110 transition duration-500">
              <span class="text-4xl filter drop-shadow-md">{{ $service->icon }}</span>
            </div>

            <h3 class="text-2xl font-serif font-bold text-white mb-2 group-hover:text-[var(--color-gold)] transition">{{ $service->title }}</h3>

            {{-- Deskripsi dengan fitur expand --}}
            <div class="relative w-full">
                 <p class="service-desc mt-4 text-[var(--color-text-muted)] text-base leading-relaxed font-light px-2 line-clamp-4 transition-all duration-500 ease-in-out">
                  {{ $service->description }}
                </p>
            </div>

            {{-- Tombol Lihat Selengkapnya --}}
            <button class="toggle-btn mt-4 text-[var(--color-gold)] text-sm uppercase tracking-widest font-bold hover:text-white transition flex items-center gap-1 group/btn">
              <span>Read More</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 arrow-icon transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            {{-- Tombol Deskripsi Paket --}}
            <div class="mt-8 w-full">
              @if ($service->pdf_path)
                <a href="{{ asset('storage/' . $service->pdf_path) }}" target="_blank" class="block w-full text-center border border-[var(--color-gold)] text-[var(--color-gold)] px-6 py-3 rounded-full hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition font-bold uppercase text-sm tracking-wider">
                   📄 Download PDF
                </a>
              @else
                <button disabled class="block w-full text-center border border-gray-600 text-gray-500 px-6 py-3 rounded-full cursor-not-allowed font-medium text-sm tracking-wider">
                  Unavailable
                </button>
              @endif
            </div>
          </div>
        </article>
      @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center mt-20 fade-in-up">
      <h3 class="text-2xl font-serif font-bold text-white mb-6">Sudah menemukan layanan yang cocok?</h3>
      <a href="{{ route('booking.create') }}" class="inline-block bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/30 transform hover:scale-105">
        📅 Book Appointment
      </a>
    </div>
  </div>
</section>

{{-- Styles --}}
<style>
  /* Fade-in Animation */
  .fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: all .8s ease;
  }
  .fade-in-up.show {
    opacity: 1;
    transform: translateY(0);
  }

  /* Clamp text */
  .line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Expand Animation */
  .service-desc.expanded {
    -webkit-line-clamp: unset;
    overflow: visible;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Fade-in animation
  const items = document.querySelectorAll('.fade-in-up');
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('show');
        io.unobserve(e.target);
      }
    });
  }, { threshold: .1 });
  items.forEach(el => io.observe(el));

  // Expand / Collapse
  document.querySelectorAll('.toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const desc = btn.parentElement.querySelector('.service-desc');
      const icon = btn.querySelector('.arrow-icon');
      const text = btn.querySelector('span');

      if (desc.classList.contains('line-clamp-4')) {
        desc.classList.remove('line-clamp-4');
        desc.classList.add('expanded');
        text.textContent = 'Show Less';
        icon.style.transform = 'rotate(180deg)';
      } else {
        desc.classList.add('line-clamp-4');
        desc.classList.remove('expanded');
        text.textContent = 'Read More';
        icon.style.transform = 'rotate(0deg)';
      }
    });
  });
});
</script>

@endsection
