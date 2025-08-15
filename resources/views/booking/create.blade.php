@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <form action="{{ route('booking.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nama Lengkap -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="full_name" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- No. Telepon -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" name="phone" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="birth_place" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="text" id="birth_date" name="birth_date" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Tanggal Booking -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tanggal Booking</label>
                    <input type="text" id="booking_date" name="booking_date" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Paket Layanan -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Paket Layanan</label>
                    <select name="service" id="service_package" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Paket --</option>
                        <option value="prewedding" data-price="3000000">Paket Prewedding - Rp 3.000.000</option>
                        <option value="wedding" data-price="7000000">Paket Wedding - Rp 7.000.000</option>
                        <option value="premium" data-price="12000000">Paket Premium - Rp 12.000.000</option>
                    </select>
                </div>

                <!-- Total Biaya -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Total Biaya</label>
                    <input type="text" name="total_price" id="total_price" readonly
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="ewallet">E-Wallet (OVO, Dana, Gopay)</option>
                    </select>
                </div>

                <!-- Status Pembayaran -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Status Pembayaran</label>
                    <select name="payment_status" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="pending">Belum Bayar</option>
                        <option value="paid">Lunas</option>
                    </select>
                </div>

            </div>

            <!-- Tombol Submit -->
            <div class="mt-6 text-center">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    Kirim Booking
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    const bookedDates = @json($bookedDates ?? []);

    // Kalender tanggal lahir
    flatpickr("#birth_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        allowInput: true
    });

    // Kalender tanggal booking dengan penanda warna merah untuk tanggal yang sudah dibooking
    flatpickr("#booking_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        minDate: "today",
        disable: bookedDates, // men-disable tanggal yang sudah dibooking
        allowInput: true,
        onDayCreate: function(dObj, dStr, fp, dayElem){
            const date = dayElem.dateObj.toISOString().split("T")[0];
            if(bookedDates.includes(date)){
                dayElem.style.backgroundColor = "#f87171"; // merah
                dayElem.style.color = "#fff";
            }
        }
    });

    // Update harga otomatis saat pilih paket
    document.getElementById('service_package').addEventListener('change', function () {
        let price = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('total_price').value = price ? `Rp ${parseInt(price).toLocaleString()}` : '';
    });
</script>
@endsection
