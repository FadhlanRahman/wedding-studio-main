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
    <div class="max-w-6xl mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6 justify-items-center">
      @foreach ($services as $service)
        <article class="service-card group relative w-full max-w-sm rounded-2xl p-7 fade-in-up overflow-hidden">
          <div class="price-badge">
            <span>Rp {{ number_format($service->price, 0, ',', '.') }}</span>
          </div>

          <div class="flex flex-col items-center text-center relative z-10">
            <div class="icon-bubble">
              <span class="text-4xl">{{ $service->icon }}</span>
            </div>
            <h3 class="mt-4 text-xl font-bold text-slate-800">{{ $service->title }}</h3>
            <p class="mt-2 text-slate-600 text-sm">{{ $service->description }}</p>
          </div>
        </article>
      @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center mt-16 fade-in-up">
      <a href="{{ route('booking.create') }}"
         class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-800 text-white font-semibold px-10 py-4 rounded-full shadow-lg transition-all text-lg">
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
    width: 500px; height: 500px;
    background: radial-gradient(circle at 30% 30%, rgba(59,130,246,.35), transparent 70%);
    filter: blur(90px);
    top: -100px; left: -100px;
  }

  /* === Card transparan (glassmorphism) === */
  .service-card {
    background: rgba(255, 255, 255, 0.25);
    border-radius: 20px;
    padding: 24px;
    backdrop-filter: blur(12px);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(33, 150, 243, 0.5);
  }

  /* Icon bubble */
  .icon-bubble {
    width: 70px; height: 70px;
    border-radius: 50%;
    display: grid; place-items: center;
    background: rgba(255,255,255,.5);
    backdrop-filter: blur(10px);
    box-shadow: inset 0 1px 2px rgba(255,255,255,.6), 0 6px 16px rgba(0,0,0,.15);
    animation: floatIcon 3s ease-in-out infinite;
  }
  @keyframes floatIcon { 0%,100% { transform: translateY(0);} 50% { transform: translateY(-6px);} }

  /* Price badge */
  .price-badge {
    position: absolute; top: 12px; right: 12px;
    background-color: #1976d2;
    color: #fff;
    font-weight: 700;
    padding: .4rem .8rem;
    border-radius: .5rem;
    font-size: .85rem;
    box-shadow: 0 8px 20px rgba(37,99,235,.35);
  }

  /* Buttons */
  .btn-primary {
    background-color: #1976d2;
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
  }
  .btn-primary:hover {
    background-color: #0d47a1;
    box-shadow: 0 0 15px rgba(33, 150, 243, 0.7);
  }

  /* Fade-in animation */
  .fade-in-up { opacity:0; transform: translateY(18px); transition: all .8s ease; }
  .fade-in-up.show { opacity:1; transform: translateY(0); }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
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
});
</script>
@endsection
