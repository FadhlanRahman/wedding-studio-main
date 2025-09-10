<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Wedding Studio</title>
    @vite('resources/css/app.css')
</head>
<body class="flex bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-blue-800 text-white min-h-screen p-5">
        <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
            <ul class="space-y-3">
        <li><a href="{{ route('admin.dashboard') }}" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
        <li><a href="{{ route('admin.accounts') }}" class="block hover:bg-blue-700 p-2 rounded">Akun Terdaftar</a></li>
        <li><a href="{{ route('admin.calendar') }}" class="block hover:bg-blue-700 p-2 rounded">Kalender</a></li>
        <li><a href="#" class="block hover:bg-blue-700 p-2 rounded">services</a></li>
        <li><a href="{{ route('admin.about') }}" class="block hover:bg-blue-700 p-2 rounded">about</a></li>
        <li><a href="#" class="block hover:bg-blue-700 p-2 rounded">contact</a></li>
        <li>
        <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full text-left hover:bg-blue-700 p-2 rounded">
                Logout
            </button>
        </form>
    </li>

    </ul>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>
