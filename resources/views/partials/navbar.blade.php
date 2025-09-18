{{-- resources/views/layouts/navbar.blade.php --}}
<header class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-md">
    <div class="max-w-8xl mx-auto px-6">
        <div class="grid grid-cols-3 items-center h-16 w-full">

            {{-- Logo + Nama Studio --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('logo/logo.png') }}" 
                     alt="Ellen Wedding Studio" 
                     class="h-14 w-auto object-contain">
                <span class="text-white font-extrabold text-2xl tracking-wider">
                    Ellen Wedding Studio
                </span>
            </a>

            {{-- Menu Utama (Desktop) --}}
            <div class="hidden md:flex space-x-8 items-center justify-center">
                <a href="{{ route('home') }}" class="text-white hover:text-yellow-200 transition font-medium">Home</a>
<a href="{{ route('about') }}" class="text-white hover:text-yellow-200 transition font-medium">About</a>
<a href="{{ route('services') }}" class="text-white hover:text-yellow-200 transition font-medium">Services</a>
<a href="{{ route('contact') }}" class="text-white hover:text-yellow-200 transition font-medium">Contact</a>

            </div>

            {{-- Login / Register atau Logout --}}
            <div class="hidden md:flex space-x-6 items-center col-span-1 justify-end">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-yellow-200 transition font-medium">Logout</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="text-white hover:text-yellow-200 transition font-medium">Sign Up</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-200 transition font-medium">Log In</a>
                @endauth
            </div>

            {{-- Hamburger (Mobile) --}}
            <div class="md:hidden">
                <button id="menu-btn" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile --}}
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block text-white hover:text-yellow-200 font-medium">Home</a>
<a href="{{ route('about') }}" class="text-white hover:text-yellow-200 transition font-medium">About</a>
<a href="{{ route('services') }}" class="text-white hover:text-yellow-200 transition font-medium">Services</a>
<a href="{{ route('contact') }}" class="text-white hover:text-yellow-200 transition font-medium">Contact</a>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block text-white hover:text-yellow-200 font-medium">Logout</button>
                </form>
            @else
                <a href="{{ route('register') }}" class="block text-white hover:text-yellow-200 font-medium">Sign Up</a>
                <a href="{{ route('login') }}" class="block text-white hover:text-yellow-200 font-medium">Log In</a>
            @endauth
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
