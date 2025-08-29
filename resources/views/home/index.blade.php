@extends('layouts.app')

@section('content')
<div class="bg-white text-slate-900">

{{-- ============== HERO (lowered a bit) ============== --}}
<section class="relative h-[90vh] min-h-[560px] overflow-hidden">
  <div class="absolute inset-0">
    <img
      src="{{ asset('background/background.jpeg') }}"
      alt="Ellen Wedding Studio Background"
      class="w-full h-full object-cover"
      loading="lazy" decoding="async">
    <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 via-slate-900/40 to-white/0"></div>
    <div class="absolute inset-0 bg-black/35"></div>
  </div>

  <!-- dekorasi blur -->
  <div class="pointer-events-none absolute -top-20 -left-20 h-72 w-72 rounded-full bg-blue-500/30 blur-[90px]"></div>
  <div class="pointer-events-none absolute -bottom-24 -right-16 h-80 w-80 rounded-full bg-indigo-400/30 blur-[90px]"></div>

  <!-- konten: diturunkan sedikit + tetap rata kiri -->
  <div class="relative z-10 h-full flex items-center">
    <div class="container mx-auto px-4 md:px-6">
      <div class="max-w-4xl md:translate-y-6 lg:translate-y-10">
        <p class="inline-flex items-center gap-2 text-sm md:text-base font-semibold px-4 py-1.5 rounded-full bg-white/20 text-white ring-1 ring-white/40 backdrop-blur">
          ✨ Premium Bridal · Makeup · Cinematic
        </p>

        <h1 class="mt-4 text-5xl md:text-7xl font-extrabold leading-[1.05] text-white">
          Selamat Datang di
          <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-300 to-indigo-200">
            Ellen Wedding Studio
          </span>
        </h1>

        <p class="mt-4 text-lg md:text-xl text-slate-200/90 max-w-3xl">
          Rayakan momen terindahmu dengan sentuhan profesional dan penuh cinta. Kami hadir untuk
          menyiapkan semuanya—dari makeup, gaun, hingga dokumentasi cinematic.
        </p>

        <div class="mt-9 flex flex-wrap items-center gap-4">
          <a href="#booking"
             class="inline-flex items-center justify-center px-8 py-3.5 rounded-2xl font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-600/30 transition">
            Booking Sekarang
          </a>
          <a href="{{ route('portofolio') }}"
             class="inline-flex items-center justify-center px-8 py-3.5 rounded-2xl font-semibold text-blue-700 bg-white/90 hover:bg-white shadow-lg transition">
            Lihat Portofolio
          </a>
        </div>

        <!-- indikator scroll -->
        <div class="mt-10 hidden md:flex items-center gap-3 text-white/85">
          <span class="text-base">Scroll untuk lihat layanan</span>
          <span class="text-2xl animate-bounce">▿</span>
        </div>
      </div>
    </div>
  </div>
</section>


  {{-- gelombang pemisah --}}
  <div class="-mt-16">
    <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0 80L60 72C120 64 240 48 360 40C480 32 600 32 720 42.7C840 53 960 75 1080 80C1200 85 1320 75 1380 69.3L1440 64V120H0V80Z" fill="#ffffff"/>
    </svg>
  </div>

  {{-- ============== LAYANAN ============== --}}
  <section class="py-16">
    <div class="container mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Layanan Unggulan</h2>
        <p class="mt-3 text-slate-600">Paket lengkap dan fleksibel untuk semua konsep pernikahan.</p>
      </div>

      @php
        $services = [
          ['title' => 'Makeup & Hairdo', 'desc' => 'Natural sampai glam sesuai karakter & tema.', 'icon' => '💄'],
          ['title' => 'Paket Bridal', 'desc' => 'Rias, gaun, prewedding, dokumentasi lengkap.', 'icon' => '👰'],
          ['title' => 'Perawatan Kulit', 'desc' => 'Skin prep sebelum hari H agar hasil maksimal.', 'icon' => '🧖‍♀️'],
        ];
      @endphp

      <div class="mt-10 grid gap-6 md:grid-cols-3">
        @foreach ($services as $service)
          <article class="group relative rounded-2xl bg-white ring-1 ring-slate-200 hover:ring-blue-200 shadow-sm hover:shadow-xl transition overflow-hidden">
            <div class="absolute inset-x-0 -top-16 h-28 bg-gradient-to-b from-blue-100/70 to-transparent blur-2xl opacity-0 group-hover:opacity-100 transition"></div>
            <div class="p-7">
              <div class="h-12 w-12 rounded-xl flex items-center justify-center text-2xl bg-blue-50 ring-1 ring-blue-100">
                {{ $service['icon'] }}
              </div>
              <h3 class="mt-5 text-xl font-semibold text-slate-800">{{ $service['title'] }}</h3>
              <p class="mt-2 text-slate-600">{{ $service['desc'] }}</p>
              <div class="mt-5 inline-flex items-center text-sm font-semibold text-blue-700">
                Pelajari lebih lanjut
                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </div>
            </div>
            <div class="absolute right-4 bottom-4 -z-10 text-8xl text-blue-50 select-none">•</div>
          </article>
        @endforeach
      </div>

      {{-- stats --}}
      <div class="mt-12 grid gap-6 sm:grid-cols-3 text-center">
        <div class="rounded-2xl bg-slate-50 p-6">
          <div class="text-3xl font-extrabold text-slate-900">500+</div>
          <div class="mt-1 text-slate-600">Pasangan Bahagia</div>
        </div>
        <div class="rounded-2xl bg-slate-50 p-6">
          <div class="text-3xl font-extrabold text-slate-900">8+</div>
          <div class="mt-1 text-slate-600">Tahun Pengalaman</div>
        </div>
        <div class="rounded-2xl bg-slate-50 p-6">
          <div class="text-3xl font-extrabold text-slate-900">4.9/5</div>
          <div class="mt-1 text-slate-600">Rata-rata Ulasan</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============== TESTIMONI ============== --}}
  <section class="py-16 bg-gradient-to-b from-slate-50 to-white">
    <div class="container mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Apa Kata Klien</h2>
        <p class="mt-3 text-slate-600">Cerita singkat dari hari bahagia mereka.</p>
      </div>

      <div
        x-data='{
          i: 0,
          slides: [
            {"text": "Makeup flawless & dokumentasi menyentuh. Hari kami jadi sangat berkesan!", "name": "Arina & Dimas"},
            {"text": "Tim sangat profesional, foto & videonya benar-benar mengabadikan momen.", "name": "Rina & Bagas"},
            {"text": "Pelayanan ramah, hasil rias bikin percaya diri di hari spesial. Recommended!", "name": "Maya & Budi"}
          ],
          next(){ this.i = (this.i + 1) % this.slides.length },
          set(n){ this.i = n }
        }'
        x-init="setInterval(()=>next(), 5000)"
        class="mt-10 max-w-3xl mx-auto"
      >
        <div class="relative">
          <div class="rounded-2xl bg-white shadow-xl ring-1 ring-slate-200 p-8">
            <div class="flex justify-center mb-3">
              <div class="flex text-yellow-400 text-xl">★ ★ ★ ★ ★</div>
            </div>
            <p class="text-lg text-slate-700 italic min-h-[88px]" x-text="slides[i].text"></p>
            <p class="mt-4 font-semibold text-blue-700" x-text="'— ' + slides[i].name"></p>
          </div>

          {{-- navigasi --}}
          <div class="mt-6 flex items-center justify-center gap-2">
            <template x-for="(s, idx) in slides" :key="idx">
              <button @click="set(idx)"
                class="h-2.5 w-2.5 rounded-full transition"
                :class="i===idx ? 'bg-blue-600 w-6' : 'bg-slate-300 hover:bg-slate-400'">
              </button>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ============== MINI PORTOFOLIO ============== --}}
  <section class="py-16">
    <div class="container mx-auto px-6">
      <div class="text-center max-w-2xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Portofolio Pernikahan</h2>
        <p class="mt-3 text-slate-600">Beberapa cuplikan karya favorit kami.</p>
      </div>

      @php
        $portfolios = ['portofolio1.jpg', 'portofolio2.jpg', 'portofolio3.jpg'];
      @endphp

      <div class="mt-10 grid gap-6 md:grid-cols-3">
        @foreach ($portfolios as $index => $file)
          <a href="{{ route('portofolio') }}"
             class="group relative block overflow-hidden rounded-2xl shadow-lg ring-1 ring-slate-200 hover:ring-blue-200 transition">
            <div class="aspect-[4/3]">
              <img
                src="{{ asset('portofoliol/' . $file) }}"
                alt="Portfolio {{ $index + 1 }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                loading="lazy" decoding="async">
            </div>
            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
            <div class="absolute left-4 bottom-4 text-white opacity-0 group-hover:opacity-100 transition">
              <div class="text-sm font-semibold tracking-wide text-white/90">Lihat Detail</div>
              <div class="text-lg font-bold">Portfolio {{ $index + 1 }}</div>
            </div>
          </a>
        @endforeach
      </div>

      <div class="text-center mt-10">
        <a href="{{ route('portofolio') }}"
           class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 shadow-lg shadow-blue-600/30 transition">
          Lihat Portofolio Lengkap
        </a>
      </div>
    </div>
  </section>

  {{-- ============== CTA BOOKING ============== --}}
  <section id="booking" class="relative py-16">
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-blue-50 via-indigo-50 to-white"></div>
    <div class="container mx-auto px-6">
      <div class="mx-auto max-w-4xl rounded-3xl bg-white/80 backdrop-blur ring-1 ring-slate-200 shadow-xl p-8 md:p-10 text-center">
        <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900">
          Siap Wujudkan Pernikahan Impianmu?
        </h2>
        <p class="mt-3 text-slate-600">
          Booking jadwalmu sekarang atau konsultasi gratis dengan tim kami.
        </p>

        <div class="mt-8 flex flex-wrap justify-center gap-4">
          <a href="https://wa.me/6281234567890"
             class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold bg-emerald-500 text-white hover:bg-emerald-600 shadow-lg shadow-emerald-500/30 transition">
            WhatsApp Kami
          </a>
          <a href="{{ route('booking.create') }}"
             class="inline-flex items-center justify-center px-6 py-3 rounded-xl font-semibold bg-blue-700 text-white hover:bg-blue-800 shadow-lg shadow-blue-700/30 transition">
            Form Booking
          </a>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection
