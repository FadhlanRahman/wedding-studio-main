<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Halaman form booking untuk user
     */
    public function create()
    {
    $services = Service::all();

    // ambil semua tanggal yang sudah dibooking
    $bookedDates = Booking::pluck('booking_date')->toArray();

    return view('booking.create', compact('services', 'bookedDates'));
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
        'booking_date'   => 'required|date',
        'phone'          => 'required|string|max:15',
        'service_id'     => 'required|exists:services,id',
        'payment_method' => 'required|string',
        'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // cek apakah tanggal sudah dipakai
    if (Booking::where('booking_date', $request->booking_date)->exists()) {

        return redirect()->back()
            ->withInput()
            ->with('error', 'Tanggal tersebut sudah dibooking. Silakan pilih tanggal lain.');
    }

    $service = Service::findOrFail($request->service_id);

    $data = $request->except('payment_proof');

    $data['service_id'] = $service->id;
    $data['total_price'] = $service->price;
    $data['payment_status'] = 'pending';

    if ($request->hasFile('payment_proof')) {

        $filename = time().'_'.$request->file('payment_proof')->getClientOriginalName();

        $request->file('payment_proof')->move(
            public_path('uploads/payments'),
            $filename
        );

        $data['payment_proof'] = $filename;
    }

    Booking::create($data);

    return redirect()->route('booking.create')
        ->with('success', 'Booking berhasil dibuat. Tunggu konfirmasi dari admin.');
    }

    /**
     * List semua booking untuk admin (+ kalender events)
     */
    public function index()
    {
        // Data untuk tabel (pagination)
        $bookings = Booking::latest()->paginate(10);

        // Data untuk kalender (semua booking)
        $allBookings = Booking::with('service')->get();

        $events = $allBookings->map(function ($booking) {
            return [
                'id'    => $booking->id,
                'title' => $booking->full_name . ' - ' . ($booking->service->title ?? '-'),
                'start' => $booking->booking_date,
                'color' => $booking->payment_status === 'paid' ? '#16a34a' : '#f59e0b',
            ];
        })->values()->toArray();

        return view('admin.bookings.calender', compact('bookings', 'events'));
    }

    /**
     * Kalender booking untuk admin (opsional kalau masih dipakai)
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
        $services = Service::all();
        return view('admin.bookings.edit', compact('booking', 'services'));
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
            'service_id'     => 'required|exists:services,id',
            'payment_method' => 'nullable|string',
            'payment_status' => 'in:unpaid,pending,paid',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $service = Service::findOrFail($request->service_id);

        $data = $request->except(['payment_proof']);
        $data['total_price'] = $service->price;

        if ($request->hasFile('payment_proof')) {
            $filename = time().'_'.$request->file('payment_proof')->getClientOriginalName();
            $request->file('payment_proof')->move(public_path('uploads/payments'), $filename);
            $data['payment_proof'] = $filename;
        }

        $booking->update($data);

        return redirect()->route('admin.calendar')
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
     * API JSON untuk FullCalendar
     */
    public function events()
    {
        $bookings = Booking::with('service')->get();

        $events = $bookings->map(function ($booking) {
            return [
                'id'    => $booking->id,
                'title' => $booking->full_name . ' - ' . ucfirst($booking->service->title ?? '-'),
                'start' => $booking->booking_date,
                'color' => $booking->payment_status === 'paid' ? 'green' : 'red'
            ];
        });

        return response()->json($events);
    }
}
