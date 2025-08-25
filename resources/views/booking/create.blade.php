@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-white p-8 rounded-xl shadow-lg">
            @csrf

            {{-- STEP 1: DATA DIRI --}}
            <div id="step1" class="step">
                <h2 class="text-xl font-bold mb-4">👤 Data Diri</h2>
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
                </div>

                <!-- Next Button -->
                <div class="mt-6 text-center">
                    <button type="button" id="nextBtn"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        Selanjutnya →
                    </button>
                </div>
            </div>

            {{-- STEP 2: BOOKING & PEMBAYARAN --}}
            <div id="step2" class="step hidden">
                <h2 class="text-xl font-bold mb-4">📅 Booking & Pembayaran</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                        <input type="number" name="total_price" id="total_price" readonly
                            class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                    </div>

                    <!-- Opsi Pembayaran -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Opsi Pembayaran</label>
                        <select name="dp_option" id="dp_option" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="full">Bayar Lunas</option>
                            <option value="dp">DP 50%</option>
                        </select>
                    </div>

                    <!-- Jumlah Dibayar -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Wajib Dibayar</label>
                        <input type="text" id="amount_paid" readonly
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

                    <!-- Upload Bukti Pembayaran -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700 mb-1">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Status Pembayaran -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Status Pembayaran</label>
                        <select name="payment_status" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="pending">Belum Bayar</option>
                            <option value="paid">Lunas</option>
                            <option value="dp_paid">DP Terbayar</option>
                        </select>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-6 flex justify-between">
                    <button type="button" id="prevBtn"
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition">
                        ← Kembali
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                        Kirim Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    const bookedDates = @json($bookedDates ?? []);

    // Step Navigation
    document.getElementById("nextBtn").addEventListener("click", function() {
        document.getElementById("step1").classList.add("hidden");
        document.getElementById("step2").classList.remove("hidden");
    });

    document.getElementById("prevBtn").addEventListener("click", function() {
        document.getElementById("step2").classList.add("hidden");
        document.getElementById("step1").classList.remove("hidden");
    });

    // Kalender Tanggal Lahir
    flatpickr("#birth_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        allowInput: true
    });

    // Kalender Tanggal Booking
    flatpickr("#booking_date", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        minDate: "today",
        disable: bookedDates,
        allowInput: true,
        onDayCreate: function(dObj, dStr, fp, dayElem){
            const date = dayElem.dateObj.toISOString().split("T")[0];
            if(bookedDates.includes(date)){
                dayElem.style.backgroundColor = "#f87171";
                dayElem.style.color = "#fff";
            }
        }
    });

    // Update harga otomatis
    document.getElementById('service_package').addEventListener('change', updatePaymentAmount);
    document.getElementById('dp_option').addEventListener('change', updatePaymentAmount);

    function updatePaymentAmount() {
        let packageSelect = document.getElementById('service_package');
        let dpOption = document.getElementById('dp_option').value;
        let price = packageSelect.options[packageSelect.selectedIndex]?.getAttribute('data-price');

        if(price){
            let totalPrice = parseInt(price);
            document.getElementById('total_price').value = totalPrice;

            let amountPaid = dpOption === "dp" ? totalPrice / 2 : totalPrice;
            document.getElementById('amount_paid').value = `Rp ${amountPaid.toLocaleString()}`;
        }
    }
</script>
@endsection
