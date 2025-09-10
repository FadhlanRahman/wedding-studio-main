{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twentytwenty/0.9.1/css/twentytwenty.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    {{-- Navbar hanya muncul di halaman umum --}}
    @if (!Request::is('login') && !Request::is('register') && !Request::is('admin*'))
        @include('partials.navbar')
    @endif

    {{-- Konten halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Script Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

</body>


</html>
