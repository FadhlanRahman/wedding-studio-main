<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // ===============================
    // Menampilkan daftar booking (Admin)
    // ===============================
    public function index()
    {
        // Ambil semua booking, urut berdasarkan tanggal booking paling awal
        $bookings = Booking::orderBy('booking_date', 'asc')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    // ===============================
    // Menampilkan halaman form booking (User)
    // ===============================
    public function create()
    {
        // Ambil semua tanggal yang sudah dibooking untuk validasi kalender
        $bookedDates = Booking::pluck('booking_date')->toArray();

        return view('booking.create', compact('bookedDates'));
    }

    // ===============================
    // Menyimpan data booking baru
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'birth_place'  => 'required|string|max:255',
            'birth_date'   => 'required|date',
            'booking_date' => 'required|date|after_or_equal:today|unique:bookings,booking_date',
            'phone'        => 'required|string|max:20',
            'service'      => 'required|string|max:255',
            'total_price'  => 'nullable|string',
            'payment_method' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking berhasil dikirim!');
    }

    // ===============================
    // Menampilkan halaman edit booking (Admin)
    // ===============================
    public function edit(Booking $booking)
    {
        // Ambil semua tanggal yang sudah dibooking selain booking saat ini
        $bookedDates = Booking::where('id', '!=', $booking->id)->pluck('booking_date')->toArray();

        return view('admin.bookings.edit', compact('booking', 'bookedDates'));
    }

    // ===============================
    // Update data booking (Admin)
    // ===============================
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'birth_place'  => 'required|string|max:255',
            'birth_date'   => 'required|date',
            'booking_date' => 'required|date|after_or_equal:today|unique:bookings,booking_date,' . $booking->id,
            'phone'        => 'required|string|max:20',
            'service'      => 'required|string|max:255',
            'total_price'  => 'nullable|string',
            'payment_method' => 'nullable|string',
            'payment_status' => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.calendar')->with('success', 'Booking berhasil diperbarui!');
    }

    // ===============================
    // Hapus booking (Admin)
    // ===============================
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.calendar')->with('success', 'Booking berhasil dihapus!');
    }
}
