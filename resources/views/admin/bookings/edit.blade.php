@extends('layouts.admin')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg">
            @csrf
            @method('PUT')

            <h1 class="text-2xl font-bold mb-6">Edit Booking</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Lengkap -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $booking->full_name) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- No. Telepon -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $booking->birth_place) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date', $booking->birth_date) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Tanggal Booking -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tanggal Booking</label>
                    <input type="text" id="booking_date" name="booking_date" value="{{ old('booking_date', $booking->booking_date) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Paket Layanan -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Paket Layanan</label>
                    <select name="service" id="service_package" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Paket --</option>
                        <option value="prewedding" data-price="3000000" {{ $booking->service=='prewedding' ? 'selected' : '' }}>Paket Prewedding - Rp 3.000.000</option>
                        <option value="wedding" data-price="7000000" {{ $booking->service=='wedding' ? 'selected' : '' }}>Paket Wedding - Rp 7.000.000</option>
                        <option value="premium" data-price="12000000" {{ $booking->service=='premium' ? 'selected' : '' }}>Paket Premium - Rp 12.000.000</option>
                    </select>
                </div>

                <!-- Total Biaya -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Total Biaya</label>
                    <input type="text" name="total_price" id="total_price" value="{{ old('total_price', $booking->total_price) }}" readonly
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="transfer" {{ $booking->payment_method=='transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="cod" {{ $booking->payment_method=='cod' ? 'selected' : '' }}>Cash on Delivery</option>
                        <option value="ewallet" {{ $booking->payment_method=='ewallet' ? 'selected' : '' }}>E-Wallet (OVO, Dana, Gopay)</option>
                    </select>
                </div>

                <!-- Status Pembayaran -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Status Pembayaran</label>
                    <select name="payment_status" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="pending" {{ $booking->payment_status=='pending' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="paid" {{ $booking->payment_status=='paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>
            <div class="mt-6 text-center">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    Update Booking
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    let bookedDates = @json(\App\Models\Booking::pluck('booking_date')->toArray());
    let currentBooking = "{{ $booking->booking_date }}";

    flatpickr("#birth_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        allowInput: true
    });

    flatpickr("#booking_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        minDate: "today",
        disable: bookedDates.filter(d => d !== currentBooking),
        allowInput: true
    });

    // Update harga otomatis
    document.getElementById('service_package').addEventListener('change', function () {
        let price = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('total_price').value = price ? `Rp ${parseInt(price).toLocaleString()}` : '';
    });
</script>
@endsection
