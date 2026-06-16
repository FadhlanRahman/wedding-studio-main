@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-white mb-2">
            Tambah Pinjaman Aksesoris
        </h1>
        <p class="text-[var(--color-text-muted)]">
            Form ini digunakan untuk mencatat stok, harga, foto, dan jadwal pengembalian barang aksesoris.
        </p>
    </div>

    <div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-2xl shadow-2xl p-8">
        <form method="POST" action="{{ route('admin.pinjaman-aksesoris.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">
                    Nama Barang
                </label>
                <input type="text"
                       name="nama_barang"
                       placeholder="Contoh: Mahkota Pengantin, Kalung, Anting"
                       class="w-full px-4 py-3 rounded-xl bg-white text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-gold)]">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[var(--color-gold)] font-semibold mb-2">
                        Stok Barang
                    </label>
                    <input type="number"
                           name="stok"
                           min="0"
                           placeholder="Contoh: 10"
                           class="w-full px-4 py-3 rounded-xl bg-white text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-gold)]">
                </div>

                <div>
                    <label class="block text-[var(--color-gold)] font-semibold mb-2">
                        Harga Barang
                    </label>
                    <input type="number"
                           name="harga"
                           min="0"
                           placeholder="Contoh: 150000"
                           class="w-full px-4 py-3 rounded-xl bg-white text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-gold)]">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">
                    Harga Sewa Per Hari
                </label>

                <input type="number"
                    name="harga_per_hari"
                    min="0"
                    placeholder="Contoh: 50000"
                    class="w-full px-4 py-3 rounded-xl bg-white text-black border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-gold)]">
            </div>

            <div class="mb-8">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">
                    Foto Barang
                </label>

                <div class="border-2 border-dashed border-[var(--color-gold)]/50 rounded-2xl p-6 bg-[var(--color-primary-bg)]/60">
                    <input type="file"
                           name="foto_barang"
                           accept="image/*"
                           class="w-full bg-white text-black rounded-xl p-3">

                    <p class="text-sm text-[var(--color-text-muted)] mt-3">
                        Upload foto aksesoris agar admin mudah mengenali barang yang dipinjam.
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-between border-t border-[var(--color-gold)]/20 pt-6">
                <a href="{{ route('admin.pinjaman-aksesoris.index') }}"
                   class="px-5 py-3 rounded-xl border border-[var(--color-gold)]/50 text-[var(--color-gold)] hover:bg-[var(--color-gold)] hover:text-black transition font-semibold">
                    Kembali
                </a>

                <button type="submit"
                        class="px-8 py-3 rounded-xl bg-[var(--color-gold)] text-black font-bold hover:scale-105 transition shadow-lg">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

</div>
@endsection