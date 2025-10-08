<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Wedding Studio</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex min-h-screen">

    {{-- Sidebar --}}
    <aside id="sidebar"
           class="fixed md:relative md:translate-x-0 transform -translate-x-full md:w-64 w-64 bg-blue-800 text-white min-h-screen p-5 transition-transform duration-300 ease-in-out z-40">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Panel</h1>
        <ul class="space-y-3">
            <li><a href="{{ route('admin.dashboard') }}" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
            <li><a href="{{ route('admin.accounts.index') }}" class="block hover:bg-blue-700 p-2 rounded">Akun Terdaftar</a></li>
            <li><a href="{{ route('admin.calendar') }}" class="block hover:bg-blue-700 p-2 rounded">Kalender</a></li>
            <li><a href="{{ route('admin.services.index') }}" class="block hover:bg-blue-700 p-2 rounded">Services</a></li>
            <li><a href="{{ route('admin.about') }}" class="block hover:bg-blue-700 p-2 rounded">About</a></li>
            <li><a href="{{ route('admin.contact.index') }}" class="block hover:bg-blue-700 p-2 rounded">Contact</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left hover:bg-blue-700 p-2 rounded">Logout</button>
                </form>
            </li>
        </ul>
    </aside>

    {{-- Overlay (untuk menutup sidebar di mobile) --}}
    <div id="overlay"
         class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-30"></div>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        {{-- Header --}}
        <header class="bg-white shadow-md flex items-center justify-between px-6 py-4 md:hidden">
            <button id="menu-btn" class="text-blue-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h2 class="text-lg font-bold text-blue-700">Admin Panel</h2>
        </header>

        {{-- Konten Utama --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    {{-- Script Toggle Sidebar --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menu-btn');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>
</html>
