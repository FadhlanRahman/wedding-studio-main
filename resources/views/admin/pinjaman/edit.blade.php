@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-serif font-bold text-white mb-6">
        Edit Pinjaman Aksesoris
    </h1>

    <div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-2xl shadow-2xl p-8">
        <form method="POST" action="{{ route('admin.pinjaman-aksesoris.update', $pinjaman->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $pinjaman->nama_barang) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white text-black">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[var(--color-gold)] font-semibold mb-2">Stok Barang</label>
                    <input type="number" name="stok" min="0" value="{{ old('stok', $pinjaman->stok) }}"
                           class="w-full px-4 py-3 rounded-xl bg-white text-black">
                </div>

                <div>
                    <label class="block text-[var(--color-gold)] font-semibold mb-2">Harga Barang</label>
                    <input type="number" name="harga" min="0" value="{{ old('harga', $pinjaman->harga) }}"
                           class="w-full px-4 py-3 rounded-xl bg-white text-black">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">Harga Sewa Per Hari</label>
                <input type="number" name="harga_per_hari" min="0" value="{{ old('harga_per_hari', $pinjaman->harga_per_hari) }}"
                       class="w-full px-4 py-3 rounded-xl bg-white text-black">
            </div>

            <div class="mb-8">
                <label class="block text-[var(--color-gold)] font-semibold mb-2">Foto Barang</label>

                @if($pinjaman->foto_barang)
                    <img src="{{ asset('storage/' . $pinjaman->foto_barang) }}"
                         class="w-32 h-32 object-cover rounded-xl border border-[var(--color-gold)]/40 mb-4">
                @endif

                <input type="file" name="foto_barang" accept="image/*"
                       class="w-full bg-white text-black rounded-xl p-3">
            </div>

            <div class="flex items-center justify-between border-t border-[var(--color-gold)]/20 pt-6">
                <a href="{{ route('admin.pinjaman-aksesoris.index') }}"
                   class="px-5 py-3 rounded-xl border border-[var(--color-gold)]/50 text-[var(--color-gold)]">
                    Kembali
                </a>

                <button type="submit"
                        class="px-8 py-3 rounded-xl bg-[var(--color-gold)] text-black font-bold">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection