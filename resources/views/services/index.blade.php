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
      <h1 class="mt-4 text-4xl md:text-5xl font-bold text-white drop-shadow-lg">
        Our Wedding Services
      </h1>
      <p class="mt-3 text-gray-200/90 max-w-2xl mx-auto text-lg">
        Layanan profesional kami siap membantu mewujudkan pernikahan impian Anda.
      </p>
    </header>

    {{-- Services Grid --}}
    <div class="max-w-6xl mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
      @php
        $services = [
          ['title'=>'Makeup & Hairdo','desc'=>'Tampilan natural hingga glam sesuai karakter dan tema pernikahan Anda.','price'=>'Rp 1.500.000','icon'=>'💄'],
          ['title'=>'Wedding Photography','desc'=>'Dokumentasi prewedding dan hari H dengan hasil profesional.','price'=>'Rp 3.000.000','icon'=>'📸'],
          ['title'=>'Bridal Gown & Suit','desc'=>'Sewa gaun pengantin dan jas terbaik sesuai tema Anda.','price'=>'Rp 2.500.000','icon'=>'👗'],
          ['title'=>'Venue Decoration','desc'=>'Dekorasi tempat pernikahan elegan dan sesuai tema.','price'=>'Rp 5.000.000','icon'=>'🎀'],
          ['title'=>'Catering & Cake','desc'=>'Menu lezat dan cake cantik untuk tamu undangan.','price'=>'Rp 7.500.000','icon'=>'🎂'],
          ['title'=>'Wedding Planner','desc'=>'Koordinasi acara supaya berjalan lancar tanpa stress.','price'=>'Rp 4.000.000','icon'=>'📋'],
        ];
      @endphp

      @foreach ($services as $service)
      <article class="service-card group relative rounded-2xl p-7 fade-in-up overflow-hidden">
        {{-- Price --}}
        <div class="price-badge">
          <span>{{ $service['price'] }}</span>
        </div>

        {{-- Isi card --}}
        <div class="flex flex-col items-center text-center relative z-10">
          <div class="icon-bubble">
            <span class="text-4xl">{{ $service['icon'] }}</span>
          </div>
          <h3 class="mt-4 text-xl font-bold text-slate-800">{{ $service['title'] }}</h3>
          <p class="mt-2 text-slate-600 text-sm">{{ $service['desc'] }}</p>
        </div>

        <div class="mt-6 flex items-center justify-center gap-3 relative z-10">
          <a href="{{ route('booking.create') }}" class="btn-primary">Book Now</a>
          <a href="#" class="btn-ghost">Detail</a>
        </div>

        {{-- Sheen effect --}}
        <span class="sheen"></span>
      </article>
      @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center mt-16 fade-in-up">
      <a href="{{ route('booking.create') }}"
         class="inline-flex items-center gap-2 btn-primary px-8 py-3 text-lg">
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

/* Background utama */
body {
  background: linear-gradient(to right, #0d47a1, #1976d2, #42a5f5); /* gradasi biru */
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  color: white;
}

  /* === Card transparan (glassmorphism) === */
  .service-card {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 20px;
  padding: 20px;
  backdrop-filter: blur(10px);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .service-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 30px rgba(33, 150, 243, 0.5); /* efek hover biru */
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
  .btn-primary:hover {  background-color: #0d47a1;
  box-shadow: 0 0 15px rgba(33, 150, 243, 0.7); }

  .btn-ghost {
    border: 1px solid #e2e8f0;
    background: rgba(255,255,255,.8);
    color: #1e293b;
    border-radius: .75rem;
    padding: .55rem 1rem;
    font-weight: 600;
    backdrop-filter: blur(6px);
    transition: transform .25s, background .25s;
  }
  .btn-ghost:hover { background: #fff; transform: translateY(-2px); }

  /* Sheen effect */
  .sheen {
    position: absolute;
    top: -50%; left: -150%;
    width: 300%; height: 200%;
    background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,.25) 50%, transparent 70%);
    transform: rotate(20deg);
    transition: transform 1s ease;
    pointer-events: none;
  }
  .service-card:hover .sheen {
    transform: translateX(80%) rotate(20deg);
  }

  /* Fade-in animation */
  .fade-in-up { opacity:0; transform: translateY(18px); transition: all .8s ease; }
  .fade-in-up.show { opacity:1; transform: translateY(0); }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const items = document.querySelectorAll('.fade-in-up');
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('show'); io.unobserve(e.target); } });
  }, { threshold: .15 });
  items.forEach(el => io.observe(el));
});
</script>
@endsection
