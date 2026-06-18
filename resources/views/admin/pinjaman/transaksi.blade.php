@extends('layouts.admin')

@section('content')

<div class="bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-2xl p-6 shadow-2xl">

    <div class="mb-6">
        <h1 class="text-3xl font-serif font-bold text-white">
            Data Transaksi Pinjaman
        </h1>

        <p class="text-[var(--color-text-muted)] mt-1">
            Daftar transaksi penyewaan aksesoris dari pelanggan.
        </p>
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

                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Penyewa</th>
                    <th class="p-4 text-left">Barang</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Tanggal Ambil</th>
                    <th class="p-4 text-left">Tanggal Kembali</th>
                    <th class="p-4 text-left">Lama Hari</th>
                    <th class="p-4 text-left">Total Biaya</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Dokumen</th>

                </tr>
            </thead>

            <tbody>

                @forelse($transaksi as $trx)

                    <tr class="border-b border-[var(--color-gold)]/20 text-white">

                        <td class="p-4">
                            #{{ $trx->id }}
                        </td>

                        <td class="p-4">
                            <div>
                                <div class="font-semibold">
                                    {{ $trx->nama }}
                                </div>

                                <div class="text-sm text-gray-400">
                                    {{ $trx->email }}
                                </div>

                                <div class="text-sm text-gray-400">
                                    {{ $trx->telepon }}
                                </div>
                            </div>
                        </td>

                        <td class="p-4">
                            {{ $trx->barang->nama_barang ?? '-' }}
                        </td>

                        <td class="p-4">
                            {{ $trx->jumlah_pinjam }}
                        </td>

                        <td class="p-4">
                            {{ $trx->tanggal_ambil }}
                        </td>

                        <td class="p-4">
                            {{ $trx->tanggal_kembali }}
                        </td>

                        <td class="p-4">
                            {{ $trx->lama_hari }} Hari
                        </td>

                        <td class="p-4 text-[var(--color-gold)] font-bold">
                            Rp {{ number_format($trx->total_biaya,0,',','.') }}
                        </td>

                        <td class="p-4">
                            
                                @csrf
                                @method('PUT')

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="px-3 py-2 rounded-lg bg-gray-800 text-white border border-gray-600">

                                    <option value="pending"
                                        {{ $trx->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="approved"
                                        {{ $trx->status == 'approved' ? 'selected' : '' }}>
                                        Approved
                                    </option>

                                    <option value="rejected"
                                        {{ $trx->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                    <option value="returned"
                                        {{ $trx->status == 'returned' ? 'selected' : '' }}>
                                        Returned
                                    </option>

                                </select>

                            </form>

                        </td>

                        <td class="p-4">

                            <div class="flex flex-col gap-2">

                                @if($trx->ktp)
                                    <a href="{{ asset('storage/'.$trx->ktp) }}"
                                       target="_blank"
                                       class="px-3 py-2 rounded-lg bg-indigo-600 text-white text-center">
                                        Lihat KTP
                                    </a>
                                @endif

                                @if($trx->bukti_pembayaran)
                                    <a href="{{ asset('storage/'.$trx->bukti_pembayaran) }}"
                                       target="_blank"
                                       class="px-3 py-2 rounded-lg bg-green-600 text-white text-center">
                                        Bukti Bayar
                                    </a>
                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="10"
                            class="p-6 text-center text-gray-400">

                            Belum ada transaksi pinjaman.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection