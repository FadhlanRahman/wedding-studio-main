@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twentytwenty/0.9.1/css/twentytwenty.css" />

<style>
  :root{
    --brand:#1d4ed8;         /* Blue-700 */
    --brand-600:#2563eb;     /* Blue-600 */
    --ink:#0f172a;           /* Slate-900 */
    --muted:#64748b;         /* Slate-500 */
    --paper:#ffffff;
  }

  /* ====== Global polish ====== */
  .section-wrap{ position:relative; overflow:hidden; }
  .bg-soft{
    background:
      radial-gradient(1200px 600px at 10% -10%, rgba(29,78,216,.12), transparent 60%),
      radial-gradient(900px 500px at 110% 10%, rgba(29,78,216,.10), transparent 60%),
      linear-gradient(to bottom, #f8fbff 0%, #ffffff 60%);
  }
  .section-title{ letter-spacing:.2px; }
  .section-sub{ color:var(--muted); }

  /* ====== Cards polish ====== */
  .card{
    border-radius:1rem; background:var(--paper);
    box-shadow: 0 8px 32px rgba(2,6,23,.06);
    transition: transform .4s ease, box-shadow .4s ease;
    will-change: transform;
  }
  .card:hover{ transform: translateY(-6px); box-shadow: 0 16px 44px rgba(2,6,23,.10); }
  .media-wrap{ position:relative; overflow:hidden; }
  .media-wrap img, .media-wrap video{ transition: transform .8s cubic-bezier(.2,.8,.2,1); }
  .card:hover .media-wrap img, .card:hover .media-wrap video{ transform: scale(1.03); }

  /* Overlay judul di foto */
  .media-overlay{
    position:absolute; left:0; right:0; bottom:0;
    background:linear-gradient(to top, rgba(0,0,0,.55), rgba(0,0,0,0));
    color:#fff; padding:16px; opacity:0; transform: translateY(8px);
    transition: all .35s ease;
  }
  .card:hover .media-overlay{ opacity:1; transform: translateY(0); }

  /* ====== Swiper theming ====== */
  .swiper { --swiper-theme-color: var(--brand); }
  .swiper-button-next, .swiper-button-prev{
    --swiper-navigation-size: 22px;
    width:44px; height:44px; border-radius:999px;
    background: rgba(255,255,255,.85);
    box-shadow: 0 8px 24px rgba(2,6,23,.12);
    backdrop-filter: blur(6px) saturate(140%);
    border:1px solid rgba(2,6,23,.06);
    color: var(--brand);
    z-index:60; /* dinaikkan supaya selalu di atas tombol lain */
  }
  .swiper-button-next:hover, .swiper-button-prev:hover{ background:#fff; }

  .swiper-pagination-bullet{
    width:10px; height:10px; opacity:1; background:#dbeafe; border:2px solid #bfdbfe;
  }
  .swiper-pagination-bullet:hover{ transform: scale(1.15); }
  .swiper-pagination-bullet-active{
    background: var(--brand); border-color: var(--brand);
    box-shadow: 0 0 0 4px rgba(29,78,216,.12);
  }

  /* Container video responsif */
  .video-container{ position:relative; padding-bottom:56.25%; height:0; overflow:hidden; }
  .video-container > *{ position:absolute; inset:0; width:100%; height:100%; }

  /* ====== Tombol mute/unmute (ikon bulat kecil kiri-bawah) ====== */
  .mute-toggle{
    position:absolute; left:.75rem; bottom:.75rem; right:auto;
    z-index:40; /* di bawah panah swiper */
    width:42px; height:42px; border-radius:999px;
    display:grid; place-items:center;
    background:rgba(15,23,42,.55);
    color:#fff; border:1px solid rgba(255,255,255,.2);
    box-shadow: 0 8px 24px rgba(2,6,23,.25);
    backdrop-filter: blur(6px) saturate(140%);
    font-size:18px; line-height:1;
    opacity:0; transform: translateY(6px);
    transition: opacity .25s ease, transform .25s ease, background .25s ease;
  }
  /* muncul saat hover/focus */
  .media-wrap:hover .mute-toggle, .mute-toggle:focus-visible{ opacity:1; transform: translateY(0); }
  .mute-toggle:hover{ background:rgba(15,23,42,.75); }
  /* di perangkat non-hover (mobile/tablet), selalu tampil */
  @media (hover: none){ .mute-toggle{ opacity:1; transform:none; } }

  /* ====== TwentyTwenty branding ====== */
  .twentytwenty-container{ background:#0b1220; }
  .twentytwenty-horizontal .twentytwenty-handle{
    border:3px solid #fff; box-shadow: 0 8px 24px rgba(0,0,0,.35);
    background:linear-gradient(135deg,#fff, #e2e8f0);
  }
  .twentytwenty-horizontal .twentytwenty-handle:before,
  .twentytwenty-horizontal .twentytwenty-handle:after{
    background: var(--brand); box-shadow: 0 0 0 3px #fff inset;
  }

  /* ====== Reveal on scroll ====== */
  .reveal{ opacity:0; transform: translateY(14px); transition: all .6s ease; }
  .reveal.show{ opacity:1; transform: translateY(0); }

   /* ==== Gutter tipis untuk kartu di Photo Gallery ==== */
  .photoSwiper .swiper-slide{
    padding: .375rem;          /* ~6px: supaya kartu tidak mepet ke tepi slide */
    box-sizing: border-box;    /* padding tidak mengubah lebar total slide */
  }
  .photoSwiper .card{
    height: 100%;              /* card tetap memenuhi tinggi slide */
  }
  
</style>

{{-- ==================== PHOTO GALLERY ==================== --}}
<section class="section-wrap py-16">
  <div class="container mx-auto px-4 reveal">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3">Photo & Makeover Gallery</h2>
    <p class="text-center section-sub mb-10">Before–after & cuplikan momen terbaik.</p>

    <div class="swiper photoSwiper relative pb-12">
      <div class="swiper-wrapper">
        @forelse(($photo_projects ?? []) as $project)
          <div class="swiper-slide">
            <article class="card overflow-hidden group">
              <div class="media-wrap">
                @if(!empty($project['before_image']) && !empty($project['after_image']))
                  <div class="twentytwenty-container w-full h-80">
                    <img src="{{ asset($project['before_image']) }}" alt="Before {{ $project['title'] ?? 'Project' }}" class="w-full h-full object-cover" loading="lazy" decoding="async">
                    <img src="{{ asset($project['after_image']) }}"  alt="After {{ $project['title'] ?? 'Project' }}"  class="w-full h-full object-cover" loading="lazy" decoding="async">
                  </div>
                @else
                  <img src="{{ asset($project['image'] ?? '') }}" alt="{{ $project['title'] ?? 'Portfolio Image' }}" class="w-full h-80 object-cover" loading="lazy" decoding="async">
                @endif

                <div class="media-overlay">
                  <h3 class="text-white text-lg font-semibold">{{ $project['title'] ?? 'Untitled Project' }}</h3>
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
<section class="section-wrap py-16">
  <div class="container mx-auto px-4 reveal">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3">Behind the Scenes</h2>
    <p class="text-center section-sub mb-10">Cuplikan proses & vibe studio (video lokal).</p>

    <div class="swiper localVideoSwiper relative pb-12">
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

                <button class="mute-toggle" type="button" aria-label="Unmute video" aria-pressed="true" data-state="muted" title="Toggle mute">
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
<section class="section-wrap py-16">
  <div class="container mx-auto px-4 reveal">
    <h2 class="text-3xl font-bold text-blue-800 text-center mb-3">Video Cinematics</h2>
    <p class="text-center section-sub mb-10">Highlight cinematic dari momen terbaik.</p>

    <div class="swiper videoSwiper relative pb-12">
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

{{-- Scripts: jQuery -> event.move -> twentytwenty -> Swiper --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.event.move/2.0.0/jquery.event.move.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twentytwenty/0.9.1/js/jquery.twentytwenty.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>



<script>
  // ===== Accessibility: reduce motion =====
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // ===== Reveal on scroll (tanpa lib) =====
  const reveals = document.querySelectorAll('.reveal');
  const ioReveal = new IntersectionObserver((entries)=>{
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('show'); ioReveal.unobserve(e.target); }});
  }, { threshold:.15 });
  reveals.forEach(el => ioReveal.observe(el));

  // ===== TwentyTwenty =====
  function initTwenty() {
    $('.twentytwenty-container').each(function () {
      const $el = $(this);
      if (!$el.data('tt-init')) {
        $el.twentytwenty({ default_offset_pct: 0.5, no_overlay: true });
        $el.data('tt-init', true);
      }
    });
  }
  $(window).on('load', initTwenty);

  // ===== Helpers =====
  function stopIframes(swiperRootSelector){
    const root = document.querySelector(swiperRootSelector);
    if (!root) return;
    root.querySelectorAll('iframe').forEach(frame => {
      const src = frame.getAttribute('src'); frame.setAttribute('src', src);
    });
  }
  function bindVisibilityAutoplay(selector, instance){
    const el = document.querySelector(selector);
    if (!el || !instance?.autoplay) return;
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{ e.isIntersecting ? instance.autoplay.start() : instance.autoplay.stop(); });
    }, { threshold:.1 });
    io.observe(el);
  }

  
  // ===== PHOTO SWIPER (coverflow vibe) =====
  var photoSwiper = new Swiper(".photoSwiper", {
    slidesPerView: 3,
    spaceBetween: 24,
    loop: true,
    grabCursor: true,
    a11y: { enabled: true },
    keyboard: { enabled: true },
    effect: 'coverflow',
    coverflowEffect: { rotate:0, stretch:0, depth:120, modifier:1, slideShadows:false },
    autoplay: reduceMotion ? false : { delay: 3200, disableOnInteraction: false },
    pagination: { el: ".photo-swiper-pagination", clickable: true },
    navigation: { nextEl: ".photo-swiper-button-next", prevEl: ".photo-swiper-button-prev" },
    breakpoints: { 320:{slidesPerView:1}, 768:{slidesPerView:2}, 1024:{slidesPerView:3} },
    on: { slideChangeTransitionEnd(){ initTwenty(); } }
    
  });

  
  // ===== LOCAL VIDEO SWIPER =====
  const LOCAL_COUNT = {{ count($local_videos ?? []) }};
  function getLocalSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
  function canLoopLocal(spv){ return LOCAL_COUNT > spv; }

  function syncLocalVideos(swiper){
    document.querySelectorAll('.localVideoSwiper video.local-video').forEach(v => v.pause());
    const spv = swiper.params.slidesPerView;
    for (let i = 0; i < spv; i++){
      const slide = swiper.slides[swiper.activeIndex + i];
      if (!slide) continue;
      const vid = slide.querySelector('video.local-video');
      if (vid) { vid.play().catch(()=>{}); }
    }
  }

  var localVideoSwiper = new Swiper(".localVideoSwiper", {
    slidesPerView: getLocalSPV(),
    spaceBetween: 28,
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

  // ===== Mute/Unmute toggle (ikon) =====
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
  });

  // ===== EXTERNAL VIDEO SWIPER =====
  const VIDEO_COUNT = {{ count($video_projects ?? []) }};
  function getVideoSPV(){ return window.matchMedia('(min-width:1024px)').matches ? 2 : 1; }
  function canLoopVideo(spv){ return VIDEO_COUNT > spv; }

  var videoSwiper = new Swiper(".videoSwiper", {
    slidesPerView: getVideoSPV(),
    spaceBetween: 28,
    loop: canLoopVideo(getVideoSPV()),
    grabCursor: true,
    a11y: { enabled: true },
    keyboard: { enabled: true },
    autoplay: reduceMotion ? false : { delay: 4800, disableOnInteraction: false },
    pagination: { el: ".video-swiper-pagination", clickable: true },
    navigation: { nextEl: ".video-swiper-button-next", prevEl: ".video-swiper-button-prev" },
    breakpoints: { 320:{slidesPerView:1}, 1024:{slidesPerView:2} },
    on: {
      slideChangeTransitionStart(){ stopIframes('.videoSwiper'); },
      resize(swiper){
        const spv = getVideoSPV();
        const shouldLoop = canLoopVideo(spv);
        swiper.params.slidesPerView = spv;
        if (swiper.params.loop !== shouldLoop){
          swiper.loopDestroy();
          swiper.params.loop = shouldLoop;
          if (shouldLoop) swiper.loopCreate();
        }
        swiper.update();
      }
    }
  });

  // Autoplay pause saat section tak terlihat
  bindVisibilityAutoplay('.photoSwiper', photoSwiper);
  bindVisibilityAutoplay('.localVideoSwiper', localVideoSwiper);
  bindVisibilityAutoplay('.videoSwiper', videoSwiper);
</script>
@endsection
