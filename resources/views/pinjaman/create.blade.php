@extends('layouts.app')

@section('content')

<div class="bg-[var(--color-primary-bg)] min-h-screen py-20">

```
<div class="container mx-auto px-4">

    <!-- Header -->
    <div class="text-center mb-12">
        <span class="text-[var(--color-gold)] font-serif italic">
            Wedding Accessories Rental
        </span>

        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2">
            Form Penyewaan Aksesoris
        </h1>

        <div class="w-20 h-1 bg-[var(--color-gold)] mx-auto mt-4 rounded-full"></div>
    </div>

    <!-- Card Barang -->
    <div class="max-w-5xl mx-auto bg-[var(--color-secondary-bg)] rounded-3xl overflow-hidden shadow-2xl border border-[var(--color-gold)]/20 mb-10">

        <div class="grid md:grid-cols-2">

            <div>
                @if($barang->foto_barang)
                    <img
                        src="{{ asset('storage/'.$barang->foto_barang) }}"
                        class="w-full h-full object-cover">
                @else
                    <div class="h-full flex items-center justify-center bg-gray-800 text-gray-400">
                        Tidak Ada Foto
                    </div>
                @endif
            </div>

            <div class="p-8">

                <h2 class="text-3xl font-serif font-bold text-white mb-6">
                    {{ $barang->nama_barang }}
                </h2>

                <div class="space-y-4">

                    <div>
                        <span class="text-[var(--color-gold)] font-semibold">
                            Harga Barang
                        </span>

                        <p class="text-white text-lg">
                            Rp {{ number_format($barang->harga,0,',','.') }}
                        </p>
                    </div>

                    <div>
                        <span class="text-[var(--color-gold)] font-semibold">
                            Harga Sewa / Hari
                        </span>

                        <p class="text-white text-lg">
                            Rp {{ number_format($barang->harga_per_hari,0,',','.') }}
                        </p>
                    </div>

                    <div>
                        <span class="text-[var(--color-gold)] font-semibold">
                            Stok Tersedia
                        </span>

                        <p class="text-white text-lg">
                            {{ $barang->stok }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Form Penyewaan -->
    <form action="{{ route('pinjaman.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="max-w-5xl mx-auto bg-[var(--color-secondary-bg)] p-8 md:p-10 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20">

        @csrf

        <input type="hidden"
               name="pinjaman_aksesoris_id"
               value="{{ $barang->id }}">

        <h2 class="text-2xl font-serif font-bold text-white mb-8">
            Data Penyewa
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Nama Lengkap
                </label>

                <input type="text"
                       name="nama"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Nomor HP
                </label>

                <input type="text"
                       name="telepon"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Jumlah Pinjam
                </label>

                <input type="number"
                       id="jumlah_pinjam"
                       name="jumlah_pinjam"
                       min="1"
                       max="{{ $barang->stok }}"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Tanggal Ambil
                </label>

                <input type="date"
                       id="tanggal_ambil"
                       name="tanggal_ambil"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Tanggal Kembali
                </label>

                <input type="date"
                       id="tanggal_kembali"
                       name="tanggal_kembali"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700">
            </div>

            <div class="md:col-span-2">
                <label class="text-[var(--color-gold)] block mb-2">
                    Alamat Lengkap
                </label>

                <textarea
                    name="alamat"
                    rows="4"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white border border-gray-700"></textarea>
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Upload KTP
                </label>

                <input type="file"
                       name="ktp"
                       accept="image/*"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Bukti Pembayaran
                </label>

                <input type="file"
                       name="bukti_pembayaran"
                       accept="image/*"
                       required
                       class="w-full px-4 py-3 rounded-xl bg-[var(--color-primary-bg)] text-white">
            </div>

            <div>
                <label class="text-[var(--color-gold)] block mb-2">
                    Total Biaya
                </label>

                <input type="text"
                       id="total_biaya"
                       readonly
                       class="w-full px-4 py-3 rounded-xl bg-black text-[var(--color-gold)] font-bold">
            </div>

        </div>

        <div class="mt-10 text-right">

            <button type="submit"
                    class="px-8 py-3 bg-[var(--color-gold)] text-black rounded-xl font-bold hover:opacity-90 transition">

                Kirim Penyewaan

            </button>

        </div>

    </form>

</div>
```

</div>

<script>

const hargaPerHari = {{ $barang->harga_per_hari }};

function hitungTotal()
{
    let jumlah =
        parseInt(document.getElementById('jumlah_pinjam').value) || 0;

    let ambil =
        new Date(document.getElementById('tanggal_ambil').value);

    let kembali =
        new Date(document.getElementById('tanggal_kembali').value);

    let hari = 1;

    if(!isNaN(ambil) && !isNaN(kembali))
    {
        hari = Math.ceil(
            (kembali - ambil) /
            (1000 * 60 * 60 * 24)
        );

        if(hari < 1)
        {
            hari = 1;
        }
    }

    let total =
        hargaPerHari *
        jumlah *
        hari;

    document.getElementById('total_biaya').value =
        'Rp ' +
        total.toLocaleString('id-ID');
}

document.getElementById('jumlah_pinjam')
.addEventListener('input', hitungTotal);

document.getElementById('tanggal_ambil')
.addEventListener('change', hitungTotal);

document.getElementById('tanggal_kembali')
.addEventListener('change', hitungTotal);

</script>

<style>
#tanggal_ambil::-webkit-calendar-picker-indicator,
#tanggal_kembali::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}

#tanggal_ambil,
#tanggal_kembali {
    color-scheme: white;
}
</style>

@endsection
