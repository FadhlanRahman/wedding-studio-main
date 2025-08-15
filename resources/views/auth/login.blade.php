@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white flex items-center justify-center relative overflow-hidden">

    {{-- Container --}}
    <div class="flex w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl">

        {{-- Gambar Samping --}}
        <div class="hidden lg:flex w-1/2 bg-cover bg-center" 
            style="background-image: url('{{ asset('background/background2.jpg') }}');">
        </div>

        {{-- Form --}}
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 bg-white animate-fadeIn">
            <div class="w-full max-w-md flex flex-col items-center">

                {{-- Logo Tengah --}}
                <a href="{{ route('home') }}" class="mb-6 transition-transform transform hover:scale-110 rounded-full overflow-hidden">
                    <img src="{{ asset('logo/logo.png') }}" 
                        alt="Ellen Wedding Studio" 
                        class="w-36 h-36 object-contain">
                </a>

                {{-- Error Validation --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg w-full">
                        <ul class="text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4 w-full">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center text-gray-600 text-sm">
                            <input type="checkbox" name="remember" class="mr-2" />
                            Remember me
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg shadow-lg transition">
                        Login
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Animasi --}}
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn 0.6s ease-out;
}
</style>
@endsection
