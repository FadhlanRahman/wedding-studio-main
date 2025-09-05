@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 p-6">
    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-800 drop-shadow-sm">
            Selamat Datang di Halaman Admin
        </h1>
        <p class="text-gray-500 mt-2">Kelola akun, booking, dan data dengan mudah.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        {{-- Akun --}}
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md p-6 text-center transform transition hover:scale-105 hover:shadow-xl">
            <div class="text-blue-600 text-5xl mb-4">👤</div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Akun Terdaftar</h3>
            <p class="text-4xl font-extrabold text-blue-700">{{ \App\Models\User::count() }}</p>
        </div>

        {{-- Booking --}}
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md p-6 text-center transform transition hover:scale-105 hover:shadow-xl">
            <div class="text-blue-600 text-5xl mb-4">📅</div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Booking</h3>
            <p class="text-4xl font-extrabold text-blue-700">{{ \App\Models\Booking::count() }}</p>
        </div>

        {{-- Tanggal --}}
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-md p-6 text-center transform transition hover:scale-105 hover:shadow-xl">
            <div class="text-blue-600 text-5xl mb-4">📆</div>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Tanggal Hari Ini</h3>
            <p class="text-4xl font-extrabold text-blue-700">{{ now()->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
