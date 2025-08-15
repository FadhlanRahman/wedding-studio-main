@extends('layouts.app')

@section('content')
<section class="relative bg-cover bg-center min-h-full" style="background-image: url('{{ asset('background/background.jpg') }}')">
    {{-- Overlay hitam transparan --}}
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    {{-- Konten utama --}}
    <div class="relative z-10 flex items-center justify-center py-10 min-h-screen">
        <div class="flex w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-white bg-opacity-90 animate-fadeIn">

            {{-- Kolom About --}}
            <div class="w-1/2 p-10 border-r border-gray-200 flex flex-col justify-center">
                <h2 class="text-4xl font-bold text-blue-600 mb-4">Tentang Kami</h2>
                <p class="text-gray-700 mb-6">
                    Ellen Wedding Studio adalah penyedia layanan pernikahan profesional yang berkomitmen
                    menghadirkan momen indah dan tak terlupakan. Dengan tim yang berpengalaman, kami siap
                    membantu Anda dari perencanaan hingga pelaksanaan acara.
                </p>

                <div class="bg-blue-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Pengalaman & Sertifikasi</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1">
                        <li>10+ tahun pengalaman di industri pernikahan</li>
                        <li>Sertifikasi MUA Profesional</li>
                        <li>Fotografi & Videografi bersertifikat</li>
                        <li>Event Organizer berlisensi</li>
                    </ul>
                </div>
            </div>

            {{-- Kolom Tim Kami --}}
            <div class="w-1/2 p-10 flex flex-col justify-center">
                <h2 class="text-4xl font-bold text-blue-600 mb-6 text-center">Tim Kami</h2>

                <div class="grid grid-cols-3 gap-6">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim1.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Ellen</h4>
                        <p class="text-gray-500 text-sm">Founder & MUA</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim2.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Fadhlan</h4>
                        <p class="text-gray-500 text-sm">Fotografer</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim3.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Faishal</h4>
                        <p class="text-gray-500 text-sm">Event Organizer</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim3.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Faishal</h4>
                        <p class="text-gray-500 text-sm">Event Organizer</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim3.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Faishal</h4>
                        <p class="text-gray-500 text-sm">Event Organizer</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('team/tim3.jpg') }}" class="w-28 h-28 rounded-full object-cover shadow-lg mb-2">
                        <h4 class="font-semibold text-gray-800">Faishal</h4>
                        <p class="text-gray-500 text-sm">Event Organizer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Animasi FadeIn --}}
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
