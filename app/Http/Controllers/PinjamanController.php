<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PinjamanAksesoris;
use App\Models\TransaksiPinjaman;
use Carbon\Carbon;

class PinjamanController extends Controller
{
    public function index()
    {
        $barang = PinjamanAksesoris::latest()->get();

        return view('pinjaman.index', compact('barang'));
    }

    public function create(Request $request)
    {
        $barang = PinjamanAksesoris::findOrFail($request->barang);

        return view('pinjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_aksesoris_id' => 'required|exists:pinjaman_aksesoris,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_ambil' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_ambil',
            'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $barang = PinjamanAksesoris::findOrFail(
            $request->pinjaman_aksesoris_id
        );

        if ($request->jumlah_pinjam > $barang->stok) {
            return back()->withInput()
                ->with('error', 'Jumlah pinjaman melebihi stok tersedia.');
        }

        $tanggalAmbil = Carbon::parse($request->tanggal_ambil);
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);

        $lamaHari = $tanggalAmbil->diffInDays($tanggalKembali);

        if ($lamaHari < 1) {
            $lamaHari = 1;
        }

        $totalBiaya =
            $barang->harga_per_hari *
            $request->jumlah_pinjam *
            $lamaHari;

        $ktpPath = null;

        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')
                ->store('pinjaman/ktp', 'public');
        }

        $buktiPath = null;

        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')
                ->store('pinjaman/bukti', 'public');
        }

        TransaksiPinjaman::create([
            'pinjaman_aksesoris_id' => $barang->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_ambil' => $request->tanggal_ambil,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_hari' => $lamaHari,
            'total_biaya' => $totalBiaya,
            'ktp' => $ktpPath,
            'bukti_pembayaran' => $buktiPath,
            'status' => 'pending',
        ]);

        $barang->stok = $barang->stok - $request->jumlah_pinjam;
        $barang->save();

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Penyewaan berhasil dikirim dan menunggu persetujuan admin.');
    }
}