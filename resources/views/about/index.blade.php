@extends('layouts.app')

@section('content')
<section class="relative bg-cover bg-center min-h-full" style="background-image: url('{{ asset('background/background.jpg') }}')">
    {{-- Overlay hitam transparan --}}
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    {{-- Konten utama --}}
    <div class="relative z-10 flex items-center justify-center py-10 min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl bg-white bg-opacity-95 animate-fadeIn">

            {{-- Grid responsif (1 kolom di mobile, 2 kolom di desktop) --}}
            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- Kolom About --}}
                <div class="p-8 sm:p-10 border-b md:border-b-0 md:border-r border-gray-200 flex flex-col justify-center">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-4">Tentang Kami</h2>
                    <p class="text-gray-700 mb-6 leading-relaxed text-justify">
                        Ellen Wedding Studio adalah penyedia layanan pernikahan profesional yang berkomitmen
                        menghadirkan momen indah dan tak terlupakan. Dengan tim yang berpengalaman, kami siap
                        membantu Anda dari perencanaan hingga pelaksanaan acara.
                    </p>

                    <div class="bg-blue-50 p-5 sm:p-6 rounded-xl">
                        <h3 class="text-lg sm:text-xl font-semibold text-blue-600 mb-3">Pengalaman & Sertifikasi</h3>
                        <ul class="list-disc list-inside text-gray-700 space-y-1 text-sm sm:text-base">
                            <li>10+ tahun pengalaman di industri pernikahan</li>
                            <li>Sertifikasi MUA Profesional</li>
                            <li>Fotografi & Videografi bersertifikat</li>
                            <li>Event Organizer berlisensi</li>
                        </ul>
                    </div>
                </div>

                {{-- Kolom Tim Kami --}}
                <div class="p-8 sm:p-10 flex flex-col justify-center">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-6 text-center">Tim Kami</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                        @forelse($teams as $team)
                            <div class="flex flex-col items-center text-center">
                                {{-- Foto --}}
                                @if($team->photo)
                                    <img src="{{ asset('storage/'.$team->photo) }}" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover shadow-lg mb-3">
                                @else
                                    <img src="{{ asset('team/default.jpg') }}" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full object-cover shadow-lg mb-3">
                                @endif

                                {{-- Nama & Role --}}
                                <h4 class="font-semibold text-gray-800 text-base sm:text-lg">{{ $team->name }}</h4>
                                <p class="text-gray-500 text-sm">{{ $team->role }}</p>
                            </div>
                        @empty
                            <p class="col-span-3 text-center text-gray-500 italic">
                                Belum ada anggota tim yang ditambahkan.
                            </p>
                        @endforelse
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
