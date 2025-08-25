<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Halaman form booking untuk user
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Simpan booking baru dari user
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'birth_place'    => 'required|string|max:255',
            'birth_date'     => 'required|date',
            'booking_date'   => 'required|date|unique:bookings,booking_date',
            'phone'          => 'required|string|max:15',
            'service'        => 'required|string|max:255',
            'total_price'    => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['payment_proof']);

        // Upload foto bukti pembayaran
        if ($request->hasFile('payment_proof')) {
            $filename = time().'_'.$request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->move(public_path('uploads/payments'), $filename);
            $data['payment_proof'] = $filename;
        }

        // Default status
        $data['payment_status'] = isset($data['payment_proof']) ? 'pending' : 'unpaid';

        Booking::create($data);

        return redirect()->route('booking.create')
            ->with('success', 'Booking berhasil dibuat! Tunggu verifikasi pembayaran.');
    }

    /**
     * List semua booking untuk admin
     */
    public function index()
    {
        $bookings = Booking::latest()->paginate(10); // gunakan paginate agar rapi
        return view('admin.bookings.calender', compact('bookings'));
    }

    /**
     * Kalender booking untuk admin
     */
    public function calendar()
    {
        $bookings = Booking::all();
        return view('admin.calendar', compact('bookings'));
    }

    /**
     * Form edit booking (admin)
     */
    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', compact('booking'));
    }

    /**
     * Update booking (admin)
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'birth_place'    => 'nullable|string|max:255',
            'birth_date'     => 'nullable|date',
            'booking_date'   => 'required|date|unique:bookings,booking_date,' . $booking->id,
            'phone'          => 'nullable|string|max:20',
            'service'        => 'required|string|max:255',
            'total_price'    => 'nullable|numeric',
            'payment_method' => 'nullable|string',
            'payment_status' => 'in:unpaid,pending,paid',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except(['payment_proof']);

        // Upload ulang bukti pembayaran jika ada
        if ($request->hasFile('payment_proof')) {
            $filename = time().'_'.$request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->move(public_path('uploads/payments'), $filename);
            $data['payment_proof'] = $filename;
        }

        $booking->update($data);

        return redirect()->route('admin.calendar') // supaya balik ke kalender setelah update
            ->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Hapus booking (admin)
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.calendar')
            ->with('success', 'Booking berhasil dihapus.');
    }

    /**
     * API untuk FullCalendar
     */
    public function events()
    {
        $bookings = Booking::all();

        $events = $bookings->map(function ($booking) {
            return [
                'id'    => $booking->id,
                'title' => $booking->full_name . ' - ' . ucfirst($booking->service),
                'start' => $booking->booking_date,
                'color' => $booking->payment_status === 'paid' ? 'green' : 'red'
            ];
        });

        return response()->json($events);
    }
}
