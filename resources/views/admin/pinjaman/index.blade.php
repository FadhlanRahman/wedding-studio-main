@extends('layouts.admin')

@section('content')
<div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-2xl p-6 shadow-2xl">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-serif font-bold text-white">Data Pinjaman Aksesoris</h1>
            <p class="text-[var(--color-text-muted)] mt-1">
                Daftar barang aksesoris yang sedang dipinjam.
            </p>
        </div>

        <a href="{{ route('admin.pinjaman-aksesoris.create') }}"
           class="bg-[var(--color-gold)] text-black px-5 py-3 rounded-xl font-bold">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="mb-5 bg-green-600/20 border border-green-500 text-green-300 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[var(--color-primary-bg)] text-[var(--color-gold)]">
                    <th class="p-4 text-left">Foto</th>
                    <th class="p-4 text-left">Nama Barang</th>
                    <th class="p-4 text-left">Stok</th>
                    <th class="p-4 text-left">Harga</th>
                    <th class="p-4 text-left">Tanggal Barang</th>
                    <th class="p-4 text-left">Tanggal Pengembalian</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pinjaman as $item)
                    <tr class="border-b border-[var(--color-gold)]/20 text-white">
                        <td class="p-4">
                            @if($item->foto_barang)
                                <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                     class="w-20 h-20 object-cover rounded-xl border border-[var(--color-gold)]/40">
                            @else
                                <span class="text-gray-400">Tidak ada foto</span>
                            @endif
                        </td>

                        <td class="p-4 font-semibold">
                            {{ $item->nama_barang }}
                        </td>

                        <td class="p-4">
                            {{ $item->stok }}
                        </td>

                        <td class="p-4">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        <td class="p-4">
                            {{ $item->tanggal_barang }}
                        </td>

                        <td class="p-4">
                            {{ $item->tanggal_pengembalian }}
                        </td>

                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.pinjaman-aksesoris.edit', $item->id) }}"
                                class="px-3 py-2 rounded-lg bg-[var(--color-gold)] text-black font-semibold hover:opacity-90 transition">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.pinjaman-aksesoris.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-400">
                            Belum ada data pinjaman aksesoris.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection