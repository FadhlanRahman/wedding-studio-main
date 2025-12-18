{{-- resources/views/portofolio/index.blade.php --}}
@extends('layouts.app')

@section('content')

{{-- minimal inline CSS + improved styles --}}
<style>
  :root{
    --swiper-theme-color: var(--color-gold);
  }

  /* ====== Global polish ====== */
  .section-wrap{ position:relative; overflow:hidden; padding-top:4rem; padding-bottom:4rem; }
  .section-title{ letter-spacing:.2px; font-family: var(--font-serif); }
  .section-sub{ color:var(--color-text-muted); font-weight: 300; }

  /* ====== Cards polish ====== */
  .card{
    border-radius:1.5rem; 
    background: rgba(62, 31, 31, 0.6); /* secondary-bg with opacity */
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.2); /* gold border low opacity */
    box-shadow: 0 10px 30px rgba(0,0,0,.3);
    transition: transform .36s ease, box-shadow .36s ease, border-color 0.3s ease;
    will-change: transform;
    overflow: hidden;
  }
  .card:hover{ 
      transform: translateY(-6px); 
      box-shadow: 0 22px 48px rgba(0,0,0,.5);
      border-color: var(--color-gold);
  }

  /* media */
  .media-wrap{ position:relative; overflow:hidden; }
  .media-wrap img, .media-wrap video, .media-wrap iframe{ transition: transform .8s cubic-bezier(.2,.8,.2,1); }
  .card:hover .media-wrap img, .card:hover .media-wrap video, .card:hover .media-wrap iframe{ transform: scale(1.03); }

  /* Overlay judul di foto */
  .media-overlay{
    position:absolute; left:0; right:0; bottom:0;
    background:linear-gradient(to top, rgba(42, 18, 21, .9), rgba(42, 18, 21, 0));
    color: var(--color-text-light); padding:1.5rem; opacity:0; transform: translateY(8px);
    transition: all .35s ease;
  }
  .card:hover .media-overlay{ opacity:1; transform: translateY(0); }

  /* shimmer for photos */
  .media-overlay .shimmer {
    position:absolute; inset:0; pointer-events:none;
    background: linear-gradient(90deg, rgba(212, 175, 55, 0) 0%, rgba(212, 175, 55, 0.1) 45%, rgba(212, 175, 55, 0) 85%);
    transform: translateX(-40%); opacity:0; transition: all .9s ease;
  }
  .card:hover .media-overlay .shimmer { transform: translateX(120%); opacity:1; }

  /* ====== Swiper theming ====== */
  .swiper-button-next, .swiper-button-prev{
    --swiper-navigation-size: 22px;
    width:44px; height:44px; border-radius:999px;
    background: rgba(42, 18, 21,.85); /* primary-bg */
    box-shadow: 0 8px 24px rgba(0,0,0,.5);
    backdrop-filter: blur(6px) saturate(140%);
    border:1px solid var(--color-gold);
    color: var(--color-gold);
    z-index:60;
    transition: all 0.3s ease;
  }
  .swiper-button-next:hover, .swiper-button-prev:hover{ 
      background: var(--color-gold); 
      color: var(--color-primary-bg);
      transform: translateY(-2px); 
  }

  .swiper-pagination-bullet{
    width:10px; height:10px; opacity:1; background: rgba(255,255,255,0.2); border:2px solid transparent;
    transition: all 0.3s ease;
  }
  .swiper-pagination-bullet:hover{ transform: scale(1.3); background: var(--color-gold); }
  .swiper-pagination-bullet-active{
    background: var(--color-gold); 
    box-shadow: 0 0 10px rgba(212, 175, 55, 0.4);
    transform: scale(1.2);
  }

  /* autoplay progress bar (thin) */
  .swiper-progress {
    position: absolute; left: 0; right: 0; top: 0; height: 3px; z-index:80;
    background: rgba(255,255,255,0.1);
    overflow: hidden;
  }
  .swiper-progress > i {
    display:block; height:100%; width:0%;
    background: var(--color-gold);
    transition: width 0.1s linear;
    box-shadow: 0 0 10px var(--color-gold);
  }

  /* Container video responsif */
  .video-container{ position:relative; padding-bottom:56.25%; height:0; overflow:hidden; }
  .video-container > *{ position:absolute; inset:0; width:100%; height:100%; }

  /* mute toggle */
  .mute-toggle{
    position:absolute; left:.75rem; bottom:.75rem; right:auto;
    z-index:40; width:42px; height:42px; border-radius:999px;
    display:grid; place-items:center;
    background:rgba(42, 18, 21,.75);
    color: var(--color-gold); border:1px solid var(--color-gold);
    box-shadow: 0 8px 24px rgba(0,0,0,.4);
    backdrop-filter: blur(6px);
    font-size:18px; line-height:1;
    opacity:0; transform: translateY(6px);
    transition: opacity .25s ease, transform .25s ease, background .25s ease;
  }
  .media-wrap:hover .mute-toggle, .mute-toggle:focus-visible{ opacity:1; transform: translateY(0); }
  @media (hover: none){ .mute-toggle{ opacity:1; transform:none; } }
  .mute-toggle:hover { background: var(--color-gold); color: var(--color-primary-bg); }

  /* reveal on scroll */
  .reveal{ opacity:0; transform: translateY(20px); transition: all .8s cubic-bezier(.2,.9,.2,1); }
  .reveal.show{ opacity:1; transform: translateY(0); }

  /* small toast */
  .mini-toast{
    position: fixed; right: 1rem; bottom: 1.25rem; z-index: 120;
    background: var(--color-secondary-bg); color: var(--color-gold); 
    padding: .8rem 1.2rem; border-radius: .5rem; border: 1px solid var(--color-gold);
    font-weight:600; box-shadow: 0 12px 40px rgba(0,0,0,.6); opacity:0; transform: translateY(8px);
    transition: all .36s cubic-bezier(.2,.9,.2,1);
  }
  .mini-toast.show{ opacity:1; transform: translateY(0); }

  /* small contact CTA footer */
  .closing-cta{ 
      background: linear-gradient(135deg, var(--color-secondary-bg), var(--color-primary-bg)); 
      padding: 4rem 2rem; border-radius: 1.5rem; 
      border: 1px solid rgba(212, 175, 55, 0.15);
  }

  /* responsive tweaks */
  @media (max-width: 1024px){
    .swiper .swiper-button-next, .swiper .swiper-button-prev { width:40px; height:40px; }
    .media-overlay { padding: 12px; }
  }

  /* twenty twenty container fix */
  .twentytwenty-container { background: var(--color-primary-bg); }
  .photoSwiper .swiper-slide{ padding:.375rem; box-sizing:border-box; }
  .photoSwiper .card{ height:100%; }
</style>

{{-- audio element and UI toggle --}}
<audio id="page-audio" loop preload="metadata">
  {{-- optional: replace src with a gentle ambient audio in /public/audio/ --}}
  <source src="{{ asset('audio/ambient-loop.mp3') }}" type="audio/mpeg">
</audio>

<button id="audio-toggle" aria-pressed="false" title="Toggle ambient sound"
        class="hover:scale-110 transition duration-300"
        style="position:fixed; left:1rem; bottom:1rem; z-index:120; width:48px; height:48px; border-radius:999px;
               background:var(--color-gold); color: var(--color-primary-bg); display:grid; place-items:center; box-shadow:0 0 20px rgba(212,175,55,.4); border: 2px solid #fff;">
  🔊
</button>

{{-- Mini toast (status messages) --}}
<div id="mini-toast" class="mini-toast" role="status" aria-live="polite"></div>

<div class="bg-[var(--color-primary-bg)] min-h-screen text-[var(--color-text-light)]">

    {{-- Header --}}
    <section class="relative py-20 bg-[url('https://www.transparenttextures.com/patterns/black-linen.png')]">
        <div class="absolute inset-0 bg-gradient-to-b from-[var(--color-secondary-bg)] to-[var(--color-primary-bg)] opacity-90"></div>
        <div class="container mx-auto px-4 relative z-10 text-center">
             <span class="text-[var(--color-gold)] font-serif italic text-xl">Our Works</span>
             <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mt-2 mb-4">Portfolio Gallery</h1>
             <div class="w-24 h-1 bg-[var(--color-gold)] mx-auto rounded-full"></div>
             <p class="text-[var(--color-text-muted)] mt-6 text-lg font-light max-w-2xl mx-auto">
                 Koleksi momen indah, transformasi makeup, dan video cinematic yang telah kami abadikan.
             </p>
        </div>
    </section>

    {{-- ==================== PHOTO GALLERY ==================== --}}
    <section class="section-wrap reveal">
      <div class="absolute top-0 right-0 w-64 h-64 bg-[var(--color-gold)]/5 rounded-full blur-[100px] pointer-events-none"></div>
      <div class="container mx-auto px-4 relative">
        <h2 class="text-3xl font-serif font-bold text-[var(--color-gold)] text-center mb-2 section-title">Makeup & Photography</h2>
        <p class="text-center section-sub mb-10 text-[var(--color-text-muted)]">Before–after & cuplikan momen terbaik.</p>

        <div class="swiper photoSwiper relative" aria-roledescription="carousel">
          <div class="swiper-progress"><i></i></div>
          <div class="swiper-wrapper py-4">
            @forelse(($photo_projects ?? []) as $project)
              <div class="swiper-slide" role="group" aria-label="{{ $loop->iteration }} of {{ count($photo_projects) }}">
                <article class="card overflow-hidden h-full flex flex-col">
                  <div class="media-wrap flex-grow relative">
                    @if(!empty($project['before_image']) && !empty($project['after_image']))
                      <div class="twentytwenty-container w-full h-80">
                        <img src="{{ asset($project['before_image']) }}" alt="Before {{ $project['title'] ?? 'Project' }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                        <img src="{{ asset($project['after_image']) }}"  alt="After {{ $project['title'] ?? 'Project' }}"  class="w-full h-full object-cover" loading="lazy" decoding="async">
                      </div>
                    @else
                      <img src="{{ asset($project['image'] ?? 'images/placeholder.jpg') }}" alt="{{ $project['title'] ?? 'Portfolio Image' }}" class="w-full h-80 object-cover" loading="lazy" decoding="async">
                    @endif

                    <div class="media-overlay">
                      <h3 class="text-[var(--color-gold)] text-lg font-serif font-semibold">{{ $project['title'] ?? 'Untitled Project' }}</h3>
                      <div class="shimmer" aria-hidden></div>
                    </div>
                  </div>

                  @if(!empty($project['description']))
                    <div class="p-6 bg-[var(--color-secondary-bg)] border-t border-[var(--color-gold)]/10">
                      <p class="text-[var(--color-text-muted)] text-sm leading-relaxed font-light">{{ $project['description'] }}</p>
                    </div>
                  @endif
                </article>
              </div>
            @empty
              <div class="text-center text-[var(--color-text-muted)] py-8 col-span-3 w-full">Belum ada foto portofolio.</div>
            @endforelse
          </div>

          <div class="swiper-button-next photo-swiper-button-next" aria-label="Next photos"></div>
          <div class="swiper-button-prev photo-swiper-button-prev" aria-label="Previous photos"></div>
          <div class="swiper-pagination photo-swiper-pagination !bottom-0"></div>
        </div>
      </div>
    </section>

    {{-- ==================== LOCAL MP4 VIDEOS ==================== --}}
    <section class="section-wrap reveal bg-[var(--color-secondary-bg)]/30">
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-[var(--color-gold)]/5 rounded-full blur-[100px] pointer-events-none"></div>
      <div class="container mx-auto px-4 relative">
        <h2 class="text-3xl font-serif font-bold text-[var(--color-gold)] text-center mb-2 section-title">Behind the Scenes</h2>
        <p class="text-center section-sub mb-10 text-[var(--color-text-muted)]">Cuplikan proses & vibe studio (video lokal).</p>

        <div class="swiper localVideoSwiper relative" aria-roledescription="carousel">
          <div class="swiper-progress"><i></i></div>
          <div class="swiper-wrapper py-4">
            @forelse(($local_videos ?? []) as $lv)
              <div class="swiper-slide">
                <article class="card overflow-hidden border border-[var(--color-gold)]/20">
                  <div class="media-wrap video-container bg-black">
                    <video
                      class="local-video w-full h-full object-cover opacity-80 hover:opacity-100 transition duration-500"
                      muted autoplay playsinline loop preload="metadata"
                      @if(!empty($lv['poster'])) poster="{{ asset($lv['poster']) }}" @endif
                    >
                      <source src="{{ asset($lv['path'] ?? '') }}" type="video/mp4">
                    </video>

                    <button class="mute-toggle" type="button" aria-label="Toggle mute">
                      <span class="icon">🔇</span>
                    </button>
                  </div>
                  <div class="p-5 bg-[var(--color-secondary-bg)]">
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-text-light)]">{{ $lv['title'] ?? 'Local Clip' }}</h3>
                  </div>
                </article>
              </div>
            @empty
              <div class="text-center text-[var(--color-text-muted)] py-8 w-full">Belum ada video lokal.</div>
            @endforelse
          </div>

          <div class="swiper-button-next local-video-swiper-button-next" aria-label="Next local videos"></div>
          <div class="swiper-button-prev local-video-swiper-button-prev" aria-label="Previous local videos"></div>
          <div class="swiper-pagination local-video-swiper-pagination !bottom-0"></div>
        </div>
      </div>
    </section>

    {{-- ==================== EXTERNAL VIDEOS ==================== --}}
    <section class="section-wrap reveal">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-serif font-bold text-[var(--color-gold)] text-center mb-2 section-title">Cinematic Films</h2>
        <p class="text-center section-sub mb-10 text-[var(--color-text-muted)]">Highlight cinematic dari momen terbaik.</p>

        <div class="swiper videoSwiper relative" aria-roledescription="carousel">
          <div class="swiper-progress"><i></i></div>
          <div class="swiper-wrapper py-4">
            @forelse(($video_projects ?? []) as $video)
              <div class="swiper-slide">
                <article class="card overflow-hidden">
                  <div class="media-wrap video-container bg-black">
                    <iframe
                      src="{{ $video['video_url'] }}"
                      title="{{ $video['title'] ?? 'Cinematic Video' }}"
                      frameborder="0" loading="lazy"
                      class="opacity-90 hover:opacity-100 transition duration-500"
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                      referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                    ></iframe>
                  </div>
                  <div class="p-5 bg-[var(--color-secondary-bg)] border-t border-[var(--color-gold)]/10">
                    <h3 class="text-lg font-serif font-semibold text-[var(--color-text-light)]">{{ $video['title'] ?? 'Untitled Video' }}</h3>
                  </div>
                </article>
              </div>
            @empty
              <div class="text-center text-[var(--color-text-muted)] py-8 w-full">Belum ada video portofolio.</div>
            @endforelse
          </div>

          <div class="swiper-button-next video-swiper-button-next" aria-label="Next videos"></div>
          <div class="swiper-button-prev video-swiper-button-prev" aria-label="Previous videos"></div>
          <div class="swiper-pagination video-swiper-pagination !bottom-0"></div>
        </div>
      </div>
    </section>

    {{-- Closing CTA --}}
    <section class="container mx-auto px-4 py-16 reveal">
      <div class="closing-cta text-center shadow-2xl shadow-[var(--color-gold)]/10">
        <h3 class="text-3xl font-serif font-bold text-white mb-4">Terima kasih sudah melihat karya kami</h3>
        <p class="text-[var(--color-text-muted)] mb-8 text-lg font-light max-w-2xl mx-auto">Setiap potret punya cerita — mari wujudkan ceritamu bersama Ellen Wedding Studio.</p>
        <a href="{{ route('contact') }}" class="inline-block bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-10 py-4 rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg hover:shadow-[var(--color-gold)]/30 transform hover:scale-105">
            💌 Hubungi Kami
        </a>
      </div>
    </section>

</div>

{{-- required external scripts (kept as your original) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.event.move/2.0.0/jquery.event.move.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twentytwenty/0.9.1/js/jquery.twentytwenty.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
  (function(){
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Reveal on scroll */
    const reveals = document.querySelectorAll('.reveal');
    const ioReveal = new IntersectionObserver((entries)=>{
      entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('show'); ioReveal.unobserve(e.target); }});
    }, { threshold:.12 });
    reveals.forEach(el => ioReveal.observe(el));

    /* TwentyTwenty init after images loaded */
    function initTwenty(){
      $('.twentytwenty-container').each(function () {
        const $el = $(this);
        if (!$el.data('tt-init')) {
          $el.twentytwenty({ default_offset_pct: 0.5, no_overlay: true });
          $el.data('tt-init', true);
        }
      });
    }
    $(window).on('load', initTwenty);

    /* Helper: toast */
    function toast(msg, ms=2000){
      const t = document.getElementById('mini-toast');
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(t.hideTimeout);
      t.hideTimeout = setTimeout(()=> t.classList.remove('show'), ms);
    }

    /* ===== Swiper instances with progress bars & sensible defaults ===== */
    function makeProgressUpdater(swiper, progressEl){
      // uses autoplayTimeLeft event if available
      if (swiper && typeof swiper.on === 'function') {
        swiper.on('autoplayTimeLeft', (s, time, progress) => {
          if (!progressEl) return;
          progressEl.style.width = `${Math.max(0, (progress*100))}%`;
        });
      } else {
        // fallback - simple interval based progress if autoplay configured
        let interval;
        function start(){
          if (!swiper.params.autoplay) return;
          const delay = swiper.params.autoplay?.delay || 4000;
          let startTs = Date.now();
          clearInterval(interval);
          interval = setInterval(()=>{
            const elapsed = Date.now() - startTs;
            const pct = Math.min(100, (elapsed/delay)*100);
            progressEl.style.width = `${pct}%`;
            if (pct >= 100) startTs = Date.now();
          }, 100);
        }
        swiper.on && swiper.on('slideChange', start);
        start();
      }
    }

    // Photo swiper
    const photoSwiper = new Swiper(".photoSwiper", {
      slidesPerView: 3,
      spaceBetween: 22,
      loop: true,
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      effect: 'coverflow',
      coverflowEffect: { rotate:0, stretch:0, depth:110, modifier:1, slideShadows:false },
      autoplay: reduceMotion ? false : { delay: 3200, disableOnInteraction: false },
      pagination: { el: ".photo-swiper-pagination", clickable: true },
      navigation: { nextEl: ".photo-swiper-button-next", prevEl: ".photo-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 768:{slidesPerView:2}, 1200:{slidesPerView:3} },
      on: { slideChangeTransitionEnd(){ initTwenty(); } }
    });
    makeProgressUpdater(photoSwiper, document.querySelector('.photoSwiper .swiper-progress > i'));

    // Local video swiper
    const LOCAL_COUNT = {{ count($local_videos ?? []) }};
    function getLocalSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
    function canLoopLocal(spv){ return LOCAL_COUNT > spv; }

    function syncLocalVideos(swiper){
      document.querySelectorAll('.localVideoSwiper video.local-video').forEach(v => { try{ v.pause(); }catch(e){} });
      const spv = swiper.params.slidesPerView;
      for (let i=0;i<spv;i++){
        const idx = swiper.realIndex + i;
        const slide = swiper.slides[idx];
        if (!slide) continue;
        const vid = slide.querySelector('video.local-video');
        if (vid) { vid.play().catch(()=>{}); }
      }
    }

    const localVideoSwiper = new Swiper(".localVideoSwiper", {
      slidesPerView: getLocalSPV(),
      spaceBetween: 22,
      loop: canLoopLocal(getLocalSPV()),
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      autoplay: reduceMotion ? false : { delay: 4200, disableOnInteraction: false },
      pagination: { el: ".local-video-swiper-pagination", clickable: true },
      navigation: { nextEl: ".local-video-swiper-button-next", prevEl: ".local-video-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 1024:{slidesPerView:2} },
      on: {
        init(swiper){ syncLocalVideos(swiper); },
        slideChangeTransitionStart(swiper){ syncLocalVideos(swiper); },
        resize(swiper){
          const spv = getLocalSPV();
          const shouldLoop = canLoopLocal(spv);
          swiper.params.slidesPerView = spv;
          if (swiper.params.loop !== shouldLoop){
            swiper.loopDestroy(); swiper.params.loop = shouldLoop; if (shouldLoop) swiper.loopCreate();
          }
          swiper.update(); syncLocalVideos(swiper);
        }
      }
    });
    makeProgressUpdater(localVideoSwiper, document.querySelector('.localVideoSwiper .swiper-progress > i'));

    // video swiper
    const VIDEO_COUNT = {{ count($video_projects ?? []) }};
    function getVideoSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
    function canLoopVideo(spv){ return VIDEO_COUNT > spv; }

    const videoSwiper = new Swiper(".videoSwiper", {
      slidesPerView: getVideoSPV(),
      spaceBetween: 22,
      loop: canLoopVideo(getVideoSPV()),
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      autoplay: reduceMotion ? false : { delay: 4800, disableOnInteraction: false },
      pagination: { el: ".video-swiper-pagination", clickable: true },
      navigation: { nextEl: ".video-swiper-button-next", prevEl: ".video-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 1024:{slidesPerView:2} },
      on: {
        slideChangeTransitionStart(){ /* stop iframes to avoid overlapping audio */ stopIframes('.videoSwiper'); }
      }
    });
    makeProgressUpdater(videoSwiper, document.querySelector('.videoSwiper .swiper-progress > i'));

    /* stop iframes (reset src to itself) */
    function stopIframes(rootSel){
      const root = document.querySelector(rootSel);
      if (!root) return;
      root.querySelectorAll('iframe').forEach(frame => {
        const src = frame.getAttribute('src'); frame.setAttribute('src', src);
      });
    }

    /* Mute toggle for local videos (single control per video) */
    document.addEventListener('click', function(e){
      const btn = e.target.closest('.mute-toggle'); if (!btn) return;
      const slide = btn.closest('.swiper-slide'); const video = slide?.querySelector('video.local-video'); if (!video) return;
      video.muted = !video.muted;
      const isMuted = video.muted;
      btn.dataset.state = isMuted ? 'muted' : 'unmuted';
      btn.setAttribute('aria-pressed', (!isMuted).toString());
      btn.setAttribute('aria-label', isMuted ? 'Unmute video' : 'Mute video');
      const icon = btn.querySelector('.icon');
      if (icon) icon.textContent = isMuted ? '🔇' : '🔊';
      toast(isMuted ? 'Video dimute' : 'Audio video aktif', 1400);
    });

    /* Ambient audio toggle (global) */
    const audio = document.getElementById('page-audio');
    const audioBtn = document.getElementById('audio-toggle');
    const AUDIO_KEY = 'ew_studio_ambient';
    // read preference
    let saved = localStorage.getItem(AUDIO_KEY);
    let audioOn = saved === '1';
    // default: off if no audio file exist or user prefers reduced motion
    if (audio && !reduceMotion){
      try {
        // reflect button state
        audioBtn.title = audioOn ? 'Matikan suara' : 'Hidupkan suara';
        audioBtn.setAttribute('aria-pressed', audioOn ? 'true' : 'false');
        audioBtn.textContent = audioOn ? '🔊' : '🔈';
        if (audioOn) {
          audio.volume = 0.22;
          audio.play().catch(()=>{ /* auto-play blocked */ });
        }
      } catch(e){}
    } else {
      audioBtn.style.display = 'none';
    }

    audioBtn.addEventListener('click', function(){
      if (!audio) return;
      audioOn = !audioOn;
      localStorage.setItem(AUDIO_KEY, audioOn ? '1' : '0');
      audioBtn.textContent = audioOn ? '🔊' : '🔈';
      audioBtn.title = audioOn ? 'Matikan suara' : 'Hidupkan suara';
      audioBtn.setAttribute('aria-pressed', audioOn ? 'true' : 'false');
      if (audioOn){
        audio.volume = 0.22; audio.play().catch(()=>{});
        toast('Suara ambient aktif', 1200);
      } else {
        audio.pause();
        toast('Suara ambient dimatikan', 1200);
      }
    });

    /* Parallax subtle for section background elements (based on scroll) */
    const parallaxTargets = document.querySelectorAll('.section-wrap');
    window.addEventListener('scroll', function(){
      const top = window.scrollY;
      parallaxTargets.forEach((el, i) => {
        const speed = 0.025 + (i % 3) * 0.005;
        el.style.transform = `translateY(${top * speed * 0.2}px)`;
      });
    }, { passive: true });

    /* Accessibility: stop autoplay when tab hidden */
    document.addEventListener('visibilitychange', ()=> {
      if (document.hidden) {
        photoSwiper.autoplay?.stop?.();
        localVideoSwiper.autoplay?.stop?.();
        videoSwiper.autoplay?.stop?.();
      } else {
        photoSwiper.autoplay?.start?.();
        localVideoSwiper.autoplay?.start?.();
        videoSwiper.autoplay?.start?.();
      }
    });

    // ensure TwentyTwenty re-init on resize a bit later
    let resizeTO;
    window.addEventListener('resize', ()=>{ clearTimeout(resizeTO); resizeTO = setTimeout(initTwenty, 300); });

    // small UX: stop autoplay when user interacts with keyboard for accessibility ramp-down
    window.addEventListener('keydown', ()=> {
      photoSwiper.autoplay?.stop?.();
      localVideoSwiper.autoplay?.stop?.();
      videoSwiper.autoplay?.stop?.();
    });
  })();
</script>

@endsection

    --brand-600:#2563eb;     /* Blue-600 */
    --ink:#0f172a;           /* Slate-900 */
    --muted:#64748b;         /* Slate-500 */
    --paper:#ffffff;
    --glass: rgba(255,255,255,0.28);
  }

  /* Page background parallax container (applies subtle movement) */
  .page-hero{
    position: relative;
    overflow: hidden;
    background-image: linear-gradient(180deg, rgba(8,20,48,.55), rgba(8,20,48,.55));
  }

  /* ====== Global polish ====== */
  .section-wrap{ position:relative; overflow:hidden; padding-top:0.75rem; padding-bottom:0.75rem; }
  .bg-soft{
    background:
      radial-gradient(1200px 600px at 10% -10%, rgba(29,78,216,.10), transparent 60%),
      radial-gradient(900px 500px at 110% 10%, rgba(29,78,216,.06), transparent 60%),
      linear-gradient(to bottom, #f8fbff 0%, #ffffff 60%);
  }
  .section-title{ letter-spacing:.2px; }
  .section-sub{ color:var(--muted); }

  /* ====== Cards polish ====== */
  .card{
    border-radius:1rem; background:var(--paper);
    box-shadow: 0 10px 30px rgba(2,6,23,.06);
    transition: transform .36s ease, box-shadow .36s ease;
    will-change: transform;
    overflow: hidden;
  }
  .card:hover{ transform: translateY(-6px); box-shadow: 0 22px 48px rgba(2,6,23,.10); }

  /* media */
  .media-wrap{ position:relative; overflow:hidden; }
  .media-wrap img, .media-wrap video, .media-wrap iframe{ transition: transform .8s cubic-bezier(.2,.8,.2,1); }
  .card:hover .media-wrap img, .card:hover .media-wrap video, .card:hover .media-wrap iframe{ transform: scale(1.03); }

  /* Overlay judul di foto */
  .media-overlay{
    position:absolute; left:0; right:0; bottom:0;
    background:linear-gradient(to top, rgba(0,0,0,.55), rgba(0,0,0,0));
    color:#fff; padding:14px; opacity:0; transform: translateY(8px);
    transition: all .35s ease;
  }
  .card:hover .media-overlay{ opacity:1; transform: translateY(0); }

  /* shimmer for photos */
  .media-overlay .shimmer {
    position:absolute; inset:0; pointer-events:none;
    background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.08) 45%, rgba(255,255,255,0) 85%);
    transform: translateX(-40%); opacity:0; transition: all .9s ease;
  }
  .card:hover .media-overlay .shimmer { transform: translateX(120%); opacity:1; }

  /* ====== Swiper theming ====== */
  .swiper { --swiper-theme-color: var(--brand); }
  .swiper-button-next, .swiper-button-prev{
    --swiper-navigation-size: 22px;
    width:44px; height:44px; border-radius:999px;
    background: rgba(255,255,255,.90);
    box-shadow: 0 8px 24px rgba(2,6,23,.12);
    backdrop-filter: blur(6px) saturate(140%);
    border:1px solid rgba(2,6,23,.06);
    color: var(--brand);
    z-index:60;
  }
  .swiper-button-next:hover, .swiper-button-prev:hover{ background:#fff; transform: translateY(-2px); }

  .swiper-pagination-bullet{
    width:10px; height:10px; opacity:1; background:#dbeafe; border:2px solid #bfdbfe;
  }
  .swiper-pagination-bullet:hover{ transform: scale(1.15); }
  .swiper-pagination-bullet-active{
    background: var(--brand); border-color: var(--brand);
    box-shadow: 0 0 0 6px rgba(29,78,216,.08);
  }

  /* autoplay progress bar (thin) */
  .swiper-progress {
    position: absolute; left: 0; right: 0; top: 0; height: 4px; z-index:80;
    background: linear-gradient(90deg, rgba(0,0,0,0.06), rgba(0,0,0,0.02));
    overflow: hidden;
  }
  .swiper-progress > i {
    display:block; height:100%; width:0%;
    background: linear-gradient(90deg, var(--brand-600), var(--brand));
    transition: width 0.1s linear;
    box-shadow: 0 4px 14px rgba(37,99,235,0.18);
  }

  /* Container video responsif */
  .video-container{ position:relative; padding-bottom:56.25%; height:0; overflow:hidden; }
  .video-container > *{ position:absolute; inset:0; width:100%; height:100%; }

  /* mute toggle */
  .mute-toggle{
    position:absolute; left:.75rem; bottom:.75rem; right:auto;
    z-index:40; width:42px; height:42px; border-radius:999px;
    display:grid; place-items:center;
    background:rgba(15,23,42,.55);
    color:#fff; border:1px solid rgba(255,255,255,.18);
    box-shadow: 0 8px 24px rgba(2,6,23,.25);
    backdrop-filter: blur(6px) saturate(140%);
    font-size:18px; line-height:1;
    opacity:0; transform: translateY(6px);
    transition: opacity .25s ease, transform .25s ease, background .25s ease;
  }
  .media-wrap:hover .mute-toggle, .mute-toggle:focus-visible{ opacity:1; transform: translateY(0); }
  @media (hover: none){ .mute-toggle{ opacity:1; transform:none; } }

  /* reveal on scroll */
  .reveal{ opacity:0; transform: translateY(14px); transition: all .6s cubic-bezier(.2,.9,.2,1); }
  .reveal.show{ opacity:1; transform: translateY(0); }

  /* small toast */
  .mini-toast{
    position: fixed; right: 1rem; bottom: 1.25rem; z-index: 120;
    background: rgba(10,20,40,.92); color: #fff; padding: .6rem .9rem; border-radius: .5rem;
    font-weight:600; box-shadow: 0 12px 40px rgba(2,6,23,.45); opacity:0; transform: translateY(8px);
    transition: all .36s cubic-bezier(.2,.9,.2,1);
  }
  .mini-toast.show{ opacity:1; transform: translateY(0); }

  /* small contact CTA footer */
  .closing-cta{ background: linear-gradient(180deg, rgba(37,99,235,.06), rgba(37,99,235,.02)); padding: 3.5rem 0; border-radius: 1rem; }

  /* responsive tweaks */
  @media (max-width: 1024px){
    .swiper .swiper-button-next, .swiper .swiper-button-prev { width:40px; height:40px; }
    .media-overlay { padding: 12px; }
  }

  /* twenty twenty container fix */
  .twentytwenty-container { background: #0b1220; }
  .photoSwiper .swiper-slide{ padding:.375rem; box-sizing:border-box; }
  .photoSwiper .card{ height:100%; }
</style>

{{-- audio element and UI toggle --}}
<audio id="page-audio" loop preload="metadata">
  {{-- optional: replace src with a gentle ambient audio in /public/audio/ --}}
  <source src="{{ asset('audio/ambient-loop.mp3') }}" type="audio/mpeg">
</audio>

<button id="audio-toggle" aria-pressed="false" title="Toggle ambient sound"
        style="position:fixed; left:1rem; bottom:1rem; z-index:120; width:48px; height:48px; border-radius:999px;
               background:rgba(255,255,255,0.95); display:grid; place-items:center; box-shadow:0 8px 28px rgba(2,6,23,.12);">
  🔊
</button>

{{-- Mini toast (status messages) --}}
<div id="mini-toast" class="mini-toast" role="status" aria-live="polite"></div>

{{-- ==================== PHOTO GALLERY ==================== --}}
<section class="section-wrap py-16 reveal">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3 section-title">Photo & Makeover Gallery</h2>
    <p class="text-center section-sub mb-8">Before–after & cuplikan momen terbaik.</p>

    <div class="swiper photoSwiper relative card" aria-roledescription="carousel">
      <div class="swiper-progress"><i></i></div>
      <div class="swiper-wrapper">
        @forelse(($photo_projects ?? []) as $project)
          <div class="swiper-slide" role="group" aria-label="{{ $loop->iteration }} of {{ count($photo_projects) }}">
            <article class="card overflow-hidden">
              <div class="media-wrap">
                @if(!empty($project['before_image']) && !empty($project['after_image']))
                  <div class="twentytwenty-container w-full h-72">
                    <img src="{{ asset($project['before_image']) }}" alt="Before {{ $project['title'] ?? 'Project' }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    <img src="{{ asset($project['after_image']) }}"  alt="After {{ $project['title'] ?? 'Project' }}"  class="w-full h-full object-cover" loading="lazy" decoding="async">
                  </div>
                @else
                  <img src="{{ asset($project['image'] ?? 'images/placeholder.jpg') }}" alt="{{ $project['title'] ?? 'Portfolio Image' }}" class="w-full h-72 object-cover" loading="lazy" decoding="async">
                @endif

                <div class="media-overlay">
                  <h3 class="text-white text-lg font-semibold">{{ $project['title'] ?? 'Untitled Project' }}</h3>
                  <div class="shimmer" aria-hidden></div>
                </div>
              </div>

              @if(!empty($project['description']))
                <div class="p-5">
                  <p class="text-slate-600 text-sm leading-relaxed">{{ $project['description'] }}</p>
                </div>
              @endif
            </article>
          </div>
        @empty
          <div class="text-center text-gray-500 py-8">Belum ada foto portofolio.</div>
        @endforelse
      </div>

      <div class="swiper-button-next photo-swiper-button-next" aria-label="Next photos"></div>
      <div class="swiper-button-prev photo-swiper-button-prev" aria-label="Previous photos"></div>
      <div class="swiper-pagination photo-swiper-pagination"></div>
    </div>
  </div>
</section>

{{-- ==================== LOCAL MP4 VIDEOS ==================== --}}
<section class="section-wrap py-16 reveal">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3 section-title">Behind the Scenes</h2>
    <p class="text-center section-sub mb-8">Cuplikan proses & vibe studio (video lokal).</p>

    <div class="swiper localVideoSwiper relative card" aria-roledescription="carousel">
      <div class="swiper-progress"><i></i></div>
      <div class="swiper-wrapper">
        @forelse(($local_videos ?? []) as $lv)
          <div class="swiper-slide">
            <article class="card overflow-hidden">
              <div class="media-wrap video-container">
                <video
                  class="local-video w-full h-full object-cover"
                  muted autoplay playsinline loop preload="metadata"
                  @if(!empty($lv['poster'])) poster="{{ asset($lv['poster']) }}" @endif
                >
                  <source src="{{ asset($lv['path'] ?? '') }}" type="video/mp4">
                </video>

                <button class="mute-toggle" type="button" aria-label="Toggle mute">
                  <span class="icon">🔇</span>
                </button>
              </div>
              <div class="p-5">
                <h3 class="text-lg font-semibold text-slate-800">{{ $lv['title'] ?? 'Local Clip' }}</h3>
              </div>
            </article>
          </div>
        @empty
          <div class="text-center text-gray-500 py-8">Belum ada video lokal.</div>
        @endforelse
      </div>

      <div class="swiper-button-next local-video-swiper-button-next" aria-label="Next local videos"></div>
      <div class="swiper-button-prev local-video-swiper-button-prev" aria-label="Previous local videos"></div>
      <div class="swiper-pagination local-video-swiper-pagination"></div>
    </div>
  </div>
</section>

{{-- ==================== EXTERNAL VIDEOS ==================== --}}
<section class="section-wrap py-16 reveal">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3 section-title">Video Cinematics</h2>
    <p class="text-center section-sub mb-8">Highlight cinematic dari momen terbaik.</p>

    <div class="swiper videoSwiper relative card" aria-roledescription="carousel">
      <div class="swiper-progress"><i></i></div>
      <div class="swiper-wrapper">
        @forelse(($video_projects ?? []) as $video)
          <div class="swiper-slide">
            <article class="card overflow-hidden">
              <div class="media-wrap video-container">
                <iframe
                  src="{{ $video['video_url'] }}"
                  title="{{ $video['title'] ?? 'Cinematic Video' }}"
                  frameborder="0" loading="lazy"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                ></iframe>
              </div>
              <div class="p-5">
                <h3 class="text-lg font-semibold text-slate-800">{{ $video['title'] ?? 'Untitled Video' }}</h3>
              </div>
            </article>
          </div>
        @empty
          <div class="text-center text-gray-500 py-8">Belum ada video portofolio.</div>
        @endforelse
      </div>

      <div class="swiper-button-next video-swiper-button-next" aria-label="Next videos"></div>
      <div class="swiper-button-prev video-swiper-button-prev" aria-label="Previous videos"></div>
      <div class="swiper-pagination video-swiper-pagination"></div>
    </div>
  </div>
</section>

{{-- Closing CTA --}}
<section class="container mx-auto px-4 py-12 reveal">
  <div class="closing-cta card p-8 text-center">
    <h3 class="text-2xl font-bold text-slate-900 mb-2">Terima kasih sudah melihat karya kami</h3>
    <p class="text-slate-600 mb-6">Setiap potret punya cerita — mari wujudkan ceritamu bersama Ellen Wedding Studio.</p>
    <a href="{{ route('contact') }}" class="btn-primary">💌 Hubungi Kami</a>
  </div>
</section>

{{-- required external scripts (kept as your original) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.event.move/2.0.0/jquery.event.move.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twentytwenty/0.9.1/js/jquery.twentytwenty.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
  (function(){
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Reveal on scroll */
    const reveals = document.querySelectorAll('.reveal');
    const ioReveal = new IntersectionObserver((entries)=>{
      entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('show'); ioReveal.unobserve(e.target); }});
    }, { threshold:.12 });
    reveals.forEach(el => ioReveal.observe(el));

    /* TwentyTwenty init after images loaded */
    function initTwenty(){
      $('.twentytwenty-container').each(function () {
        const $el = $(this);
        if (!$el.data('tt-init')) {
          $el.twentytwenty({ default_offset_pct: 0.5, no_overlay: true });
          $el.data('tt-init', true);
        }
      });
    }
    $(window).on('load', initTwenty);

    /* Helper: toast */
    function toast(msg, ms=2000){
      const t = document.getElementById('mini-toast');
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(t.hideTimeout);
      t.hideTimeout = setTimeout(()=> t.classList.remove('show'), ms);
    }

    /* ===== Swiper instances with progress bars & sensible defaults ===== */
    function makeProgressUpdater(swiper, progressEl){
      // uses autoplayTimeLeft event if available
      if (swiper && typeof swiper.on === 'function') {
        swiper.on('autoplayTimeLeft', (s, time, progress) => {
          if (!progressEl) return;
          progressEl.style.width = `${Math.max(0, (progress*100))}%`;
        });
      } else {
        // fallback - simple interval based progress if autoplay configured
        let interval;
        function start(){
          if (!swiper.params.autoplay) return;
          const delay = swiper.params.autoplay?.delay || 4000;
          let startTs = Date.now();
          clearInterval(interval);
          interval = setInterval(()=>{
            const elapsed = Date.now() - startTs;
            const pct = Math.min(100, (elapsed/delay)*100);
            progressEl.style.width = `${pct}%`;
            if (pct >= 100) startTs = Date.now();
          }, 100);
        }
        swiper.on && swiper.on('slideChange', start);
        start();
      }
    }

    // Photo swiper
    const photoSwiper = new Swiper(".photoSwiper", {
      slidesPerView: 3,
      spaceBetween: 22,
      loop: true,
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      effect: 'coverflow',
      coverflowEffect: { rotate:0, stretch:0, depth:110, modifier:1, slideShadows:false },
      autoplay: reduceMotion ? false : { delay: 3200, disableOnInteraction: false },
      pagination: { el: ".photo-swiper-pagination", clickable: true },
      navigation: { nextEl: ".photo-swiper-button-next", prevEl: ".photo-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 768:{slidesPerView:2}, 1200:{slidesPerView:3} },
      on: { slideChangeTransitionEnd(){ initTwenty(); } }
    });
    makeProgressUpdater(photoSwiper, document.querySelector('.photoSwiper .swiper-progress > i'));

    // Local video swiper
    const LOCAL_COUNT = {{ count($local_videos ?? []) }};
    function getLocalSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
    function canLoopLocal(spv){ return LOCAL_COUNT > spv; }

    function syncLocalVideos(swiper){
      document.querySelectorAll('.localVideoSwiper video.local-video').forEach(v => { try{ v.pause(); }catch(e){} });
      const spv = swiper.params.slidesPerView;
      for (let i=0;i<spv;i++){
        const idx = swiper.realIndex + i;
        const slide = swiper.slides[idx];
        if (!slide) continue;
        const vid = slide.querySelector('video.local-video');
        if (vid) { vid.play().catch(()=>{}); }
      }
    }

    const localVideoSwiper = new Swiper(".localVideoSwiper", {
      slidesPerView: getLocalSPV(),
      spaceBetween: 22,
      loop: canLoopLocal(getLocalSPV()),
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      autoplay: reduceMotion ? false : { delay: 4200, disableOnInteraction: false },
      pagination: { el: ".local-video-swiper-pagination", clickable: true },
      navigation: { nextEl: ".local-video-swiper-button-next", prevEl: ".local-video-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 1024:{slidesPerView:2} },
      on: {
        init(swiper){ syncLocalVideos(swiper); },
        slideChangeTransitionStart(swiper){ syncLocalVideos(swiper); },
        resize(swiper){
          const spv = getLocalSPV();
          const shouldLoop = canLoopLocal(spv);
          swiper.params.slidesPerView = spv;
          if (swiper.params.loop !== shouldLoop){
            swiper.loopDestroy(); swiper.params.loop = shouldLoop; if (shouldLoop) swiper.loopCreate();
          }
          swiper.update(); syncLocalVideos(swiper);
        }
      }
    });
    makeProgressUpdater(localVideoSwiper, document.querySelector('.localVideoSwiper .swiper-progress > i'));

    // video swiper
    const VIDEO_COUNT = {{ count($video_projects ?? []) }};
    function getVideoSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
    function canLoopVideo(spv){ return VIDEO_COUNT > spv; }

    const videoSwiper = new Swiper(".videoSwiper", {
      slidesPerView: getVideoSPV(),
      spaceBetween: 22,
      loop: canLoopVideo(getVideoSPV()),
      grabCursor: true,
      a11y: { enabled: true },
      keyboard: { enabled: true },
      autoplay: reduceMotion ? false : { delay: 4800, disableOnInteraction: false },
      pagination: { el: ".video-swiper-pagination", clickable: true },
      navigation: { nextEl: ".video-swiper-button-next", prevEl: ".video-swiper-button-prev" },
      breakpoints: { 320:{slidesPerView:1}, 1024:{slidesPerView:2} },
      on: {
        slideChangeTransitionStart(){ /* stop iframes to avoid overlapping audio */ stopIframes('.videoSwiper'); }
      }
    });
    makeProgressUpdater(videoSwiper, document.querySelector('.videoSwiper .swiper-progress > i'));

    /* stop iframes (reset src to itself) */
    function stopIframes(rootSel){
      const root = document.querySelector(rootSel);
      if (!root) return;
      root.querySelectorAll('iframe').forEach(frame => {
        const src = frame.getAttribute('src'); frame.setAttribute('src', src);
      });
    }

    /* Mute toggle for local videos (single control per video) */
    document.addEventListener('click', function(e){
      const btn = e.target.closest('.mute-toggle'); if (!btn) return;
      const slide = btn.closest('.swiper-slide'); const video = slide?.querySelector('video.local-video'); if (!video) return;
      video.muted = !video.muted;
      const isMuted = video.muted;
      btn.dataset.state = isMuted ? 'muted' : 'unmuted';
      btn.setAttribute('aria-pressed', (!isMuted).toString());
      btn.setAttribute('aria-label', isMuted ? 'Unmute video' : 'Mute video');
      const icon = btn.querySelector('.icon');
      if (icon) icon.textContent = isMuted ? '🔇' : '🔊';
      toast(isMuted ? 'Video dimute' : 'Audio video aktif', 1400);
    });

    /* Ambient audio toggle (global) */
    const audio = document.getElementById('page-audio');
    const audioBtn = document.getElementById('audio-toggle');
    const AUDIO_KEY = 'ew_studio_ambient';
    // read preference
    let saved = localStorage.getItem(AUDIO_KEY);
    let audioOn = saved === '1';
    // default: off if no audio file exist or user prefers reduced motion
    if (audio && !reduceMotion){
      try {
        // reflect button state
        audioBtn.title = audioOn ? 'Matikan suara' : 'Hidupkan suara';
        audioBtn.setAttribute('aria-pressed', audioOn ? 'true' : 'false');
        audioBtn.textContent = audioOn ? '🔊' : '🔈';
        if (audioOn) {
          audio.volume = 0.22;
          audio.play().catch(()=>{ /* auto-play blocked */ });
        }
      } catch(e){}
    } else {
      audioBtn.style.display = 'none';
    }

    audioBtn.addEventListener('click', function(){
      if (!audio) return;
      audioOn = !audioOn;
      localStorage.setItem(AUDIO_KEY, audioOn ? '1' : '0');
      audioBtn.textContent = audioOn ? '🔊' : '🔈';
      audioBtn.title = audioOn ? 'Matikan suara' : 'Hidupkan suara';
      audioBtn.setAttribute('aria-pressed', audioOn ? 'true' : 'false');
      if (audioOn){
        audio.volume = 0.22; audio.play().catch(()=>{});
        toast('Suara ambient aktif', 1200);
      } else {
        audio.pause();
        toast('Suara ambient dimatikan', 1200);
      }
    });

    /* Parallax subtle for section background elements (based on scroll) */
    const parallaxTargets = document.querySelectorAll('.section-wrap');
    window.addEventListener('scroll', function(){
      const top = window.scrollY;
      parallaxTargets.forEach((el, i) => {
        const speed = 0.025 + (i % 3) * 0.005;
        el.style.transform = `translateY(${top * speed * 0.2}px)`;
      });
    }, { passive: true });

    /* Accessibility: stop autoplay when tab hidden */
    document.addEventListener('visibilitychange', ()=> {
      if (document.hidden) {
        photoSwiper.autoplay?.stop?.();
        localVideoSwiper.autoplay?.stop?.();
        videoSwiper.autoplay?.stop?.();
      } else {
        photoSwiper.autoplay?.start?.();
        localVideoSwiper.autoplay?.start?.();
        videoSwiper.autoplay?.start?.();
      }
    });

    // ensure TwentyTwenty re-init on resize a bit later
    let resizeTO;
    window.addEventListener('resize', ()=>{ clearTimeout(resizeTO); resizeTO = setTimeout(initTwenty, 300); });

    // small UX: stop autoplay when user interacts with keyboard for accessibility ramp-down
    window.addEventListener('keydown', ()=> {
      photoSwiper.autoplay?.stop?.();
      localVideoSwiper.autoplay?.stop?.();
      videoSwiper.autoplay?.stop?.();
    });
  })();
</script>

@endsection
