<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ellen Studio</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[var(--color-primary-bg)] text-[var(--color-text-light)] font-sans flex min-h-screen">

    {{-- Sidebar --}}
    <aside id="sidebar"
           class="fixed md:relative md:translate-x-0 transform -translate-x-full md:w-72 w-72 bg-[var(--color-secondary-bg)] border-r border-[var(--color-gold)]/20 min-h-screen p-6 transition-transform duration-300 ease-in-out z-40 flex flex-col shadow-2xl">
        
        {{-- Logo Area --}}
        <div class="mb-10 text-center">
            <span class="text-[var(--color-gold)] font-serif italic text-lg tracking-widest">Es. Admin</span>
            <h1 class="text-2xl font-serif font-bold text-white mt-1 border-b-2 border-[var(--color-gold)] inline-block pb-2">ELLEN STUDIO</h1>
        </div>

        {{-- Menu --}}
        <nav class="flex-1">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>📊</span> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.accounts.index') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.accounts.*') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>👥</span> Akun Terdaftar
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.calendar') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.calendar') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>📅</span> Kalender
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pinjaman-aksesoris.index') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.pinjaman-aksesoris.*') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>📦</span> Pinjaman Aksesoris
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services.index') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.services.*') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>✨</span> Services
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.about') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.about') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>📝</span> About
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact.index') }}" 
                       class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->routeIs('admin.contact.*') ? 'bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold shadow-lg' : 'text-[var(--color-text-muted)] hover:bg-[var(--color-gold)]/10 hover:text-[var(--color-gold)]' }}">
                        <span>💌</span> Contact
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="mt-auto pt-6 border-t border-[var(--color-gold)]/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/50 text-[var(--color-gold)] rounded-xl hover:bg-[var(--color-gold)] hover:text-[var(--color-primary-bg)] transition duration-300 font-bold uppercase tracking-wider text-sm">
                    <span>🚪</span> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay (Mobile) --}}
    <div id="overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden md:hidden z-30 transition-opacity"></div>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Header (Mobile Only) --}}
        <header class="bg-[var(--color-secondary-bg)] border-b border-[var(--color-gold)]/20 flex items-center justify-between px-6 py-4 md:hidden">
            <button id="menu-btn" class="text-[var(--color-gold)] focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h2 class="text-lg font-serif font-bold text-[var(--color-gold)]">ELLEN STUDIO</h2>
        </header>

        {{-- Content Body --}}
        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    {{-- Script Toggle Sidebar --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menu-btn');
        const overlay = document.getElementById('overlay');

        if(menuBtn){
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
        }

        if(overlay){
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }
    </script>

</body>
</html>
