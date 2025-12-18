@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="mb-12 animate-fadeIn">
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-2">
            Welcome Back, <span class="text-[var(--color-gold)]">Admin</span>
        </h1>
        <p class="text-[var(--color-text-muted)] text-lg font-light">
            Pantau performa studio dan kelola pesanan pernikahan hari ini.
        </p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Card 1: Akun --}}
        <div class="relative group bg-[var(--color-secondary-bg)] p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl hover:shadow-[var(--color-gold)]/10 transition duration-500 overflow-hidden">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-[var(--color-gold)]/5 rounded-full blur-2xl group-hover:bg-[var(--color-gold)]/10 transition"></div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[var(--color-primary-bg)] rounded-2xl border border-[var(--color-gold)]/10">
                    <span class="text-3xl">👥</span>
                </div>
                <span class="text-[var(--color-gold)] text-sm font-bold uppercase tracking-wider bg-[var(--color-gold)]/10 px-3 py-1 rounded-full">Users</span>
            </div>
            
            <h3 class="text-5xl font-serif font-bold text-white mb-1">{{ \App\Models\User::count() }}</h3>
            <p class="text-[var(--color-text-muted)] text-sm">Total Akun Terdaftar</p>
        </div>

        {{-- Card 2: Booking --}}
        <div class="relative group bg-[var(--color-secondary-bg)] p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl hover:shadow-[var(--color-gold)]/10 transition duration-500 overflow-hidden">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-[var(--color-gold)]/5 rounded-full blur-2xl group-hover:bg-[var(--color-gold)]/10 transition"></div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[var(--color-primary-bg)] rounded-2xl border border-[var(--color-gold)]/10">
                    <span class="text-3xl">📅</span>
                </div>
                <span class="text-[var(--color-gold)] text-sm font-bold uppercase tracking-wider bg-[var(--color-gold)]/10 px-3 py-1 rounded-full">Orders</span>
            </div>
            
            <h3 class="text-5xl font-serif font-bold text-white mb-1">{{ \App\Models\Booking::count() }}</h3>
            <p class="text-[var(--color-text-muted)] text-sm">Total Reservasi Masuk</p>
        </div>

        {{-- Card 3: Date --}}
        <div class="relative group bg-[var(--color-secondary-bg)] p-8 rounded-3xl border border-[var(--color-gold)]/20 shadow-xl hover:shadow-[var(--color-gold)]/10 transition duration-500 overflow-hidden">
            <div class="absolute -right-6 -top-6 w-32 h-32 bg-[var(--color-gold)]/5 rounded-full blur-2xl group-hover:bg-[var(--color-gold)]/10 transition"></div>
            
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-[var(--color-primary-bg)] rounded-2xl border border-[var(--color-gold)]/10">
                    <span class="text-3xl">📆</span>
                </div>
                <span class="text-[var(--color-gold)] text-sm font-bold uppercase tracking-wider bg-[var(--color-gold)]/10 px-3 py-1 rounded-full">Today</span>
            </div>
            
            <h3 class="text-3xl font-serif font-bold text-white mb-1 mt-3">{{ now()->format('d M Y') }}</h3>
            <p class="text-[var(--color-text-muted)] text-sm">Tanggal Hari Ini</p>
        </div>
    </div>

    {{-- Quick Action / Decorative Space --}}
    <div class="mt-12 p-8 rounded-3xl bg-gradient-to-r from-[var(--color-secondary-bg)] to-[var(--color-primary-bg)] border border-[var(--color-gold)]/20 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-[var(--color-gold)]/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl font-serif font-bold text-white mb-2">Kelola Jadwal Studio</h3>
                <p class="text-[var(--color-text-muted)] max-w-lg">
                    Cek ketersediaan tanggal dan konfirmasi booking yang masuk melalui halaman Kalender.
                </p>
            </div>
            <a href="{{ route('admin.calendar') }}" class="px-8 py-3 bg-[var(--color-gold)] text-[var(--color-primary-bg)] font-bold rounded-full uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg transform hover:scale-105">
                Buka Kalender &rarr;
            </a>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.8s ease-out;
}
</style>
@endsection
