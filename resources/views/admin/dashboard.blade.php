@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Selamat datang di Halaman Admin</h1>
    
    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Akun Terdaftar</h3>
            <p class="text-3xl font-bold text-blue-700">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Booking</h3>
            <p class="text-3xl font-bold text-blue-700">{{ \App\Models\Booking::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Tanggal Hari Ini</h3>
            <p class="text-3xl font-bold text-blue-700">{{ now()->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
