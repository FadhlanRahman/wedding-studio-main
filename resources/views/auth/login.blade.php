@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#2b0f13] relative overflow-hidden">
    <div class="flex w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-[#2b0f13]">

        {{-- Kiri: Login + text --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-12 py-10 text-[#f4e0b9] space-y-6">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset('logo/LogoTransp.png') }}"
                     alt="Ellen Wedding Studio"
                     class="w-28 h-28 object-contain">
            </a>
            {{-- Form Login --}}
            @if ($errors->any())
                <div class="p-3 bg-red-900/40 text-red-100 rounded-lg text-xs">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4 max-w-md">
                @csrf

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <div class="flex items-center justify-between text-xs text-[#f4e0b5]/80">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                               class="mr-2 rounded border-[#704048] bg-[#2b0f13]">
                        Remember me
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-[#f4c14b] hover:bg-[#ffd365] text-[#2b0f13] font-semibold py-2 rounded-lg shadow-lg transition text-sm">
                    Login
                </button>
            </form>

            <p class="text-xs text-[#f4e0b5]/80">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#fdd26b] hover:underline">Register here</a>
            </p>
        </div>

        {{-- Kanan: Foto --}}
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative"
             style="background-image: url('{{ asset('background/background2.jpg') }}');">
        </div>

    </div>
</div>
@endsection
