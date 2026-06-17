@extends('layouts.app')

@section('content')

<div class="bg-[var(--color-primary-bg)] min-h-screen py-20 relative overflow-hidden">

```
<!-- Background Decoration -->
<div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>

<div class="container mx-auto px-4 relative z-10">

    <!-- Header -->
    <div class="text-center mb-16">
        <span class="text-[var(--color-gold)] font-serif italic text-lg">
            Wedding Accessories Rental
        </span>

        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2">
            Pinjam Aksesoris
        </h1>

        <div class="w-20 h-1 bg-[var(--color-gold)] mx-auto mt-5 rounded-full"></div>

        <p class="text-gray-400 mt-6 max-w-2xl mx-auto">
            Pilih aksesoris terbaik untuk melengkapi momen spesial Anda.
        </p>
    </div>

    <!-- List Barang -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($barang as $item)

            <div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-3xl overflow-hidden shadow-xl hover:scale-[1.02] transition duration-300">

                <!-- Foto -->
                <div class="h-72 overflow-hidden">

                    @if($item->foto_barang)

                        <img
                            src="{{ asset('storage/'.$item->foto_barang) }}"
                            alt="{{ $item->nama_barang }}"
                            class="w-full h-full object-cover hover:scale-110 transition duration-500">

                    @else

                        <div class="w-full h-full flex items-center justify-center bg-gray-800 text-gray-400">
                            Tidak Ada Foto
                        </div>

                    @endif

                </div>

                <!-- Isi Card -->
                <div class="p-6">

                    <h3 class="text-2xl font-serif font-bold text-white mb-4">
                        {{ $item->nama_barang }}
                    </h3>

                    <div class="space-y-2">

                        <p class="text-gray-300">
                            <span class="text-[var(--color-gold)] font-semibold">
                                Stok:
                            </span>
                            {{ $item->stok }}
                        </p>

                        <p class="text-gray-300">
                            <span class="text-[var(--color-gold)] font-semibold">
                                Harga Barang:
                            </span>
                            Rp {{ number_format($item->harga,0,',','.') }}
                        </p>

                        <p class="text-gray-300">
                            <span class="text-[var(--color-gold)] font-semibold">
                                Harga Sewa:
                            </span>
                            Rp {{ number_format($item->harga_per_hari,0,',','.') }}/hari
                        </p>

                    </div>

                    <div class="mt-6">

                        @if($item->stok > 0)

                            <a href="{{ route('pinjaman.create', ['barang' => $item->id]) }}"
                               class="block text-center bg-[var(--color-gold)] text-black font-bold py-3 rounded-xl hover:opacity-90 transition">

                                Sewa Sekarang

                            </a>

                        @else

                            <button
                                disabled
                                class="w-full bg-gray-600 text-white py-3 rounded-xl cursor-not-allowed">

                                Stok Habis

                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/20 rounded-3xl p-10 text-center">

                    <h3 class="text-2xl text-white font-bold">
                        Belum Ada Barang
                    </h3>

                    <p class="text-gray-400 mt-3">
                        Saat ini belum ada aksesoris yang tersedia.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>
```

</div>

@endsection
