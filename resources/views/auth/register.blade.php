@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#2b0f13]">
    <div class="flex w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-[#2b0f13]">

        {{-- Kiri: Register --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-12 py-10 text-[#f4e0b9] space-y-6">
            <a href="{{ route('home') }}" class="inline-block mb-4">
                <img src="{{ asset('logo/LogoTransp.png') }}"
                     alt="Ellen Wedding Studio"
                     class="w-24 h-24 object-contain">
            </a>

            @if ($errors->any())
                <div class="p-3 bg-red-900/40 text-red-100 rounded-lg text-xs">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4 max-w-md">
                @csrf

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg
                                  bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg
                                  bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg
                                  bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <div>
                    <label class="block text-xs tracking-wide uppercase mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2 text-sm border border-[#704048] rounded-lg
                                  bg-[#2b0f13] text-[#f9f3dc] placeholder-gray-400
                                  focus:outline-none focus:ring-2 focus:ring-[#f4c14b]" />
                </div>

                <button type="submit"
                        class="w-full bg-[#f4c14b] hover:bg-[#ffd365] text-[#2b0f13]
                               font-semibold py-2 rounded-lg shadow-lg transition text-sm">
                    Register
                </button>
            </form>

            <p class="text-xs text-[#f4e0b5]/80">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#fdd26b] hover:underline">Login here</a>
            </p>
        </div>

        {{-- Kanan: Foto --}}
        <div class="hidden lg:flex w-1/2 bg-cover bg-center"
             style="background-image: url('{{ asset('background/background2.jpg') }}');">
        </div>

    </div>
</div>
@endsection
