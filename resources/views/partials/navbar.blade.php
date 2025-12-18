{{-- resources/views/layouts/navbar.blade.php --}}
<header class="bg-[var(--color-secondary-bg)] shadow-md border-b border-[var(--color-gold)]/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-20 w-full">

            {{-- Logo + Nama Studio --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('logo/LogoTransp.png') }}" 
                     alt="Ellen Wedding Studio" 
                     class="h-14 w-auto object-contain group-hover:scale-105 transition duration-300">
                <span class="text-[var(--color-gold)] font-serif font-bold text-2xl tracking-wider group-hover:text-[var(--color-text-light)] transition">
                    Ellen <span class="text-[var(--color-text-light)]">Wedding Studio</span>
                </span>
            </a>

            {{-- Menu Utama (Desktop) --}}
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] transition font-medium text-lg tracking-wide">Home</a>
                <a href="{{ route('about') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] transition font-medium text-lg tracking-wide">About</a>
                <a href="{{ route('services') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] transition font-medium text-lg tracking-wide">Services</a>
                <a href="{{ route('contact') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] transition font-medium text-lg tracking-wide">Contact</a>
            </div>

            {{-- Login / Register atau Logout --}}
            <div class="hidden md:flex space-x-4 items-center">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="border border-[var(--color-gold)] px-4 py-1.5 rounded-full text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition duration-300 font-medium tracking-wide text-sm uppercase">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[var(--color-gold)] hover:text-[var(--color-text-light)] transition font-medium uppercase text-sm tracking-widest px-2">Log In</a>
                    <a href="{{ route('register') }}" class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-5 py-2 rounded-full hover:bg-[var(--color-gold-light)] transition font-bold uppercase text-sm tracking-widest shadow-lg shadow-yellow-900/20">Sign Up</a>
                @endauth
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="md:hidden">
                <button id="menu-btn" class="text-[var(--color-gold)] focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-6 space-y-4 bg-[var(--color-secondary-bg)] border-t border-[var(--color-gold)]/10 absolute left-0 right-0 top-20 shadow-xl">
            <a href="{{ route('home') }}" class="block text-[var(--color-text-muted)] hover:text-[var(--color-gold)] font-medium text-lg border-b border-white/5 pb-2">Home</a>
            <a href="{{ route('about') }}" class="block text-[var(--color-text-muted)] hover:text-[var(--color-gold)] font-medium text-lg border-b border-white/5 pb-2">About</a>
            <a href="{{ route('services') }}" class="block text-[var(--color-text-muted)] hover:text-[var(--color-gold)] font-medium text-lg border-b border-white/5 pb-2">Services</a>
            <a href="{{ route('contact') }}" class="block text-[var(--color-text-muted)] hover:text-[var(--color-gold)] font-medium text-lg border-b border-white/5 pb-2">Contact</a>

            <div class="pt-4 flex flex-col space-y-3">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center border border-[var(--color-gold)] px-4 py-2 rounded-full text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition font-medium uppercase text-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-center text-[var(--color-gold)] hover:text-white font-medium uppercase text-sm tracking-widest">Log In</a>
                <a href="{{ route('register') }}" class="block text-center bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-5 py-3 rounded-full hover:bg-[var(--color-gold-light)] transition font-bold uppercase text-sm tracking-widest shadow-lg">Sign Up</a>
            @endauth
            </div>
        </div>
    </div>
</header>

{{-- Toggle Mobile Menu --}}
<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
