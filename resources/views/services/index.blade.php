@extends('layouts.app')

@section('content')

<section class="relative min-h-screen bg-wallpaper">
  {{-- Soft blob --}}
  <div aria-hidden class="pointer-events-none absolute inset-0 overflow-hidden">
    <span class="blob blob-1"></span>
  </div>

  <div class="relative z-10 py-20">
    {{-- Header --}}
    <header class="text-center mb-14 fade-in-up">
      <h1 class="mt-4 text-4xl md:text-5xl font-bold text-white drop-shadow-xl">
        Our Wedding Services
      </h1>
      <p class="mt-3 text-gray-200 max-w-2xl mx-auto text-lg drop-shadow-md">
        Layanan profesional kami siap membantu mewujudkan pernikahan impian Anda.
      </p>
    </header>

    {{-- Services Grid --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6 md:px-10 justify-items-center">
      @foreach ($services as $service)
        <article class="service-card group relative w-full max-w-sm rounded-3xl p-10 fade-in-up overflow-hidden transition-transform duration-300">
          {{-- Price Badge --}}
          <div class="price-badge">
            <span>Rp {{ number_format($service->price, 0, ',', '.') }}</span>
          </div>

          <div class="flex flex-col items-center text-center relative z-10">
            <div class="icon-bubble mb-6">
              <span class="text-6xl">{{ $service->icon }}</span>
            </div>

            <h3 class="mt-3 text-2xl font-bold text-slate-800">{{ $service->title }}</h3>

            {{-- Deskripsi dengan fitur expand --}}
            <p class="service-desc mt-5 text-slate-700 text-base leading-relaxed font-medium text-justify px-2 line-clamp-5 transition-all duration-500 ease-in-out">
              {{ $service->description }}
            </p>

            {{-- Tombol Lihat Selengkapnya --}}
            <button class="toggle-btn mt-3 flex items-center gap-1 group">
              <span class="underline-offset-2 transition-all duration-300">Lihat Selengkapnya</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 arrow-icon transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            {{-- Tombol Deskripsi Paket --}}
            <div class="mt-8">
              @if ($service->pdf_path)
                <a href="{{ asset('storage/' . $service->pdf_path) }}" target="_blank" class="btn-primary">
                   📄 Deskripsi Paket
                </a>
              @else
                <button disabled class="btn-disabled">
                  Deskripsi Tidak Tersedia
                </button>
              @endif
            </div>
          </div>
        </article>
      @endforeach
    </div>

    {{-- CTA di bawah semua card --}}
    <div class="text-center mt-16 fade-in-up">
      <a href="{{ route('booking.create') }}" class="btn-primary inline-flex items-center gap-2 text-lg">
        📅 Book Your Service
      </a>
    </div>
  </div>
</section>

{{-- Styles --}}
<style>
  .bg-wallpaper {
    background-image:
      linear-gradient(rgba(15,23,42,.65), rgba(15,23,42,.65)),
      url('{{ asset('wallpapers/wedding-wallpaper.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
  }

  .blob-1 {
    position: absolute;
    width: 600px; height: 600px;
    background: radial-gradient(circle at 30% 30%, rgba(59,130,246,.35), transparent 70%);
    filter: blur(100px);
    top: -120px; left: -120px;
  }

  /* === Card Transparan (Glassmorphism) === */
  .service-card {
    background: rgba(255, 255, 255, 0.35);
    border-radius: 28px;
    padding: 40px;
    backdrop-filter: blur(18px);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    min-height: 480px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .service-card:hover {
    transform: scale(1.03);
    box-shadow: 0 0 30px rgba(37, 99, 235, 0.35);
  }

  .icon-bubble {
    width: 100px; height: 100px;
    border-radius: 50%;
    display: grid; place-items: center;
    background: rgba(255,255,255,.7);
    backdrop-filter: blur(12px);
    box-shadow: inset 0 1px 2px rgba(255,255,255,.6),
                0 8px 20px rgba(0,0,0,.15);
    animation: floatIcon 3s ease-in-out infinite;
  }

  @keyframes floatIcon {
    0%,100% { transform: translateY(0);}
    50% { transform: translateY(-6px);}
  }

  .price-badge {
    position: absolute; top: 14px; right: 14px;
    background-color: #1d4ed8;
    color: #fff;
    font-weight: 700;
    padding: .7rem 1.1rem;
    border-radius: .8rem;
    font-size: 1rem;
    box-shadow: 0 8px 25px rgba(37,99,235,.4);
  }

  /* Tombol utama */
  .btn-primary {
    display: inline-block;
    background-color: #2563eb;
    color: #fff;
    font-weight: 600;
    padding: 0.9rem 2.2rem;
    border-radius: 9999px;
    box-shadow: 0 4px 12px rgba(37,99,235,0.35);
    transition: all 0.3s ease;
    text-decoration: none;
  }
  .btn-primary:hover {
    background-color: #1d4ed8;
    box-shadow: 0 6px 20px rgba(37,99,235,0.5);
    transform: translateY(-2px);
  }

  .btn-disabled {
    display: inline-block;
    background-color: #9ca3af;
    color: #fff;
    font-weight: 600;
    padding: 0.9rem 2.2rem;
    border-radius: 9999px;
    opacity: 0.8;
    cursor: not-allowed;
  }

  /* === Tombol "Lihat Selengkapnya" === */
  .toggle-btn {
    position: relative;
    color: #2563eb;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  .toggle-btn:hover {
    color: #1e40af;
    text-shadow: 0 0 6px rgba(37, 99, 235, 0.4);
    transform: translateY(-1px);
  }
  .toggle-btn .arrow-icon {
    transition: transform 0.3s ease, filter 0.3s ease;
  }
  .toggle-btn:hover .arrow-icon {
    filter: drop-shadow(0 0 6px rgba(37, 99, 235, 0.5));
  }

  /* Fade-in Animation */
  .fade-in-up {
    opacity: 0;
    transform: translateY(18px);
    transition: all .8s ease;
  }
  .fade-in-up.show {
    opacity: 1;
    transform: translateY(0);
  }

  /* Clamp text untuk deskripsi panjang */
  .line-clamp-5 {
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Transisi fade-slide untuk deskripsi */
  .service-desc {
    max-height: 9rem;
    overflow: hidden;
    color: #1e293b;
  }
  .service-desc.expanded {
    max-height: 100vh;
    opacity: 0;
    animation: fadeSlide 0.5s ease forwards;
  }
  @keyframes fadeSlide {
    from {
      opacity: 0;
      transform: translateY(-8px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
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
  }, { threshold: .15 });
  items.forEach(el => io.observe(el));

  // Expand / Collapse deskripsi + animasi panah
  document.querySelectorAll('.toggle-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const desc = btn.parentElement.querySelector('.service-desc');
      const icon = btn.querySelector('.arrow-icon');
      const text = btn.querySelector('span');

      if (desc.classList.contains('expanded')) {
        desc.classList.remove('expanded');
        desc.classList.add('line-clamp-5');
        text.textContent = 'Lihat Selengkapnya';
        icon.style.transform = 'rotate(0deg)';
      } else {
        desc.classList.add('expanded');
        desc.classList.remove('line-clamp-5');
        text.textContent = 'Sembunyikan';
        icon.style.transform = 'rotate(180deg)';
      }
    });
  });
});
</script>

@endsection
