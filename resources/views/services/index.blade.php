@extends('layouts.app')

@section('content')
<section class="relative min-h-screen bg-wallpaper">
  {{-- Mesh blobs opsional (hiasan halus) --}}
  <div aria-hidden class="pointer-events-none absolute inset-0 overflow-hidden">
    <span class="blob blob-1"></span>
    <span class="blob blob-2"></span>
    <span class="blob blob-3"></span>
  </div>

  <div class="relative z-10 py-20">
    {{-- Header --}}
    <header class="text-center mb-14 fade-in-up">
      <h1 class="mt-4 text-4xl md:text-5xl font-extrabold text-white drop-shadow-[0_6px_24px_rgba(30,58,138,0.45)]">
        Our Wedding Services
      </h1>
      <p class="mt-3 text-gray-200/90 max-w-2xl mx-auto text-lg md:text-xl">
        Layanan profesional kami siap membantu mewujudkan pernikahan impian Anda.
      </p>
    </header>

    {{-- Services Grid --}}
    <div class="services-grid max-w-6xl mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-6">
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
      <article class="service-card group relative rounded-2xl p-7 fade-in-up hover:z-[30]">
        {{-- Outline lembut (tanpa shadow yang lari) --}}
        <div class="absolute inset-0 rounded-2xl ring-1 ring-white/10 pointer-events-none"></div>

        {{-- Price ribbon --}}
        <div class="price-badge">
          <span class="inline-block">{{ $service['price'] }}</span>
        </div>

        {{-- Isi card --}}
        <div class="relative z-10 flex flex-col h-full">
          <div class="flex flex-col items-center text-center">
            <div class="icon-bubble">
              <span class="text-4xl leading-none">{{ $service['icon'] }}</span>
            </div>
            <h3 class="mt-3 text-xl font-extrabold text-slate-800 tracking-tight">{{ $service['title'] }}</h3>
            <p class="mt-2 text-slate-600">{{ $service['desc'] }}</p>
          </div>

          <div class="mt-6 flex items-center justify-center gap-3">
            <a href="{{ route('booking.create') }}" class="btn-primary">Book Now</a>
            <a href="#" class="btn-ghost">Detail</a>
          </div>
        </div>

        {{-- Sheen effect (lebih halus & tetap di dalam card) --}}
        <span class="sheen" aria-hidden="true"></span>
      </article>
      @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center mt-16 px-6 fade-in-up">
      <a href="{{ route('booking.create') }}"
         class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-pink-500 hover:from-pink-500 hover:to-blue-600 text-white font-bold py-3.5 px-8 rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" class="opacity-90"><path d="M6 2a1 1 0 0 0-1 1v2H4a2 2 0 0 0-2 2v1h20V7a2 2 0 0 0-2-2h-1V3a1 1 0 0 0-1-1H6Zm14 7H2v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9ZM7 4h10v1H7V4Zm1 8h3v3H8v-3Zm5 0h3v3h-3v-3Z"/></svg>
        Book Your Service
      </a>
    </div>
  </div>
</section>

{{-- Styles --}}
<style>
  :root{
    --brand:#1d4ed8;        /* blue-700 */
    --brand-2:#f472b6;      /* pink-400 */
    --ink:#0f172a;          /* slate-900 */
  }

  /* === Wallpaper background (ganti file di bawah kalau mau) === */
  .bg-wallpaper{
    position: relative;
    background-image:
      linear-gradient(rgba(2,6,23,.55), rgba(2,6,23,.55)),
      url('{{ asset('wallpapers/wedding-wallpaper.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* parallax halus */
  }

  /* Mesh blobs (hiasan) */
  .blob{ position:absolute; filter: blur(60px); opacity:.45; border-radius:999px; transform: translateZ(0); }
  .blob-1{ width:520px; height:520px; background:radial-gradient(45% 45% at 50% 50%, rgba(29,78,216,.55), transparent 60%); top:-120px; left:-120px; }
  .blob-2{ width:420px; height:420px; background:radial-gradient(45% 45% at 50% 50%, rgba(236,72,153,.45), transparent 60%); right:-120px; top:20%; }
  .blob-3{ width:380px; height:380px; background:radial-gradient(45% 45% at 50% 50%, rgba(96,165,250,.35), transparent 60%); left:10%; bottom:-140px; }

  /* === Grid === */
  .services-grid{ overflow: visible; }

  /* === Glassmorphism Card === */
  .service-card{
    /* kaca transparan */
    background:
      linear-gradient(180deg, rgba(255,255,255,.68), rgba(255,255,255,.45)) padding-box,
      linear-gradient(135deg, rgba(147,197,253,.55), rgba(251,207,232,.55)) border-box;
    border:1.5px solid transparent;
    background-clip: padding-box, border-box;

    /* blur kaca */
    backdrop-filter: blur(12px) saturate(140%);
    -webkit-backdrop-filter: blur(12px) saturate(140%);

    isolation:isolate;
    overflow:hidden; /* tahan sheen di dalam */
    box-shadow: 0 14px 36px rgba(15,23,42,.16);
    will-change: transform, box-shadow;
    transition: transform .45s cubic-bezier(.2,.8,.2,1), box-shadow .45s;
  }
  .service-card:hover{
    transform: translateY(-8px);
    box-shadow: 0 22px 64px rgba(15,23,42,.22);
  }

  /* icon bubble (agak transparan biar nyatu) */
  .icon-bubble{
    width:80px; height:80px; border-radius:999px;
    display:grid; place-items:center;
    background: radial-gradient(120% 120% at 30% 20%, rgba(252,231,243,.85), rgba(219,234,254,.85));
    box-shadow: 0 16px 40px rgba(2,6,23,.18), inset 0 1px 0 rgba(255,255,255,.65);
    transform: translateZ(0);
    animation: floatIcon 3s ease-in-out infinite;
  }
  @keyframes floatIcon{ 0%,100%{transform: translateY(0);} 50%{transform: translateY(-6px);} }

  /* price ribbon */
  .price-badge{
    position:absolute; top:12px; right:12px; z-index:20;
    background: linear-gradient(135deg, rgba(37,99,235,.95), rgba(244,63,94,.95));
    color:#fff; font-weight:800; font-size:.95rem;
    padding:.45rem .7rem; border-radius:.75rem;
    box-shadow: 0 10px 24px rgba(244,63,94,.35);
  }

  /* buttons */
  .btn-primary{
    display:inline-flex; align-items:center; justify-content:center;
    padding:.65rem 1rem; border-radius:.8rem; font-weight:800;
    background: linear-gradient(135deg, #2563eb, #ec4899);
    color:#fff; box-shadow: 0 12px 28px rgba(37,99,235,.35);
    transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
  }
  .btn-primary:hover{ transform: translateY(-2px); filter: saturate(110%); box-shadow: 0 16px 36px rgba(37,99,235,.45); }

  .btn-ghost{
    display:inline-flex; align-items:center; justify-content:center;
    padding:.6rem 1rem; border-radius:.8rem; font-weight:800;
    color:#1e293b; background: rgba(248,250,252,.8);
    border:1px solid rgba(226,232,240,.9);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    transition: background .2s ease, transform .2s ease;
  }
  .btn-ghost:hover{ background:#fff; transform: translateY(-2px); }

  /* sheen (kilau) — soft & bounded */
  .sheen{
    position:absolute; top:-20%; left:-40%;
    width:180%; height:140%;
    border-radius:inherit; pointer-events:none;
    background: linear-gradient(110deg, transparent 0%, rgba(255,255,255,.22) 30%, transparent 60%);
    transform: translateX(-30%) rotate(6deg);
    opacity:0;
    transition: transform .6s ease, opacity .5s ease;
    mix-blend-mode: screen;
  }
  .service-card:hover .sheen{ opacity:.9; transform: translateX(35%) rotate(6deg); }

  /* fade-in */
  .fade-in-up{ opacity:0; transform: translateY(18px); transition: all .8s ease; }
  .fade-in-up.show{ opacity:1; transform: translateY(0); }
</style>

{{-- Animations JS --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const items = document.querySelectorAll('.fade-in-up, .service-card');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('show');
        io.unobserve(e.target);
      }
    });
  }, { threshold: .18 });

  items.forEach(el => io.observe(el));
});
</script>
@endsection
