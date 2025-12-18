@extends('layouts.app')

@section('content')
<div class="bg-[var(--color-primary-bg)] py-20 min-h-screen relative overflow-hidden">
     {{-- Background Decor --}}
     <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 mix-blend-overlay"></div>
     <div class="pointer-events-none absolute -top-40 -left-40 w-96 h-96 bg-[var(--color-gold)]/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 relative z-10">
        <header class="text-center mb-12">
            <span class="text-[var(--color-gold)] font-serif italic text-lg">Your Special Day</span>
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-white mt-2">Reservation Form</h2>
            <div class="w-16 h-1 bg-[var(--color-gold)] mx-auto mt-4 rounded-full"></div>
        </header>

        <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data"
              class="max-w-4xl mx-auto bg-[var(--color-secondary-bg)]/80 backdrop-blur-md p-8 md:p-12 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20">
            @csrf

            {{-- STEP 1: DATA DIRI --}}
            <div id="step1" class="step animate-fadeIn">
                <h2 class="text-2xl font-serif font-bold text-white mb-8 border-b border-[var(--color-gold)]/20 pb-4 flex items-center gap-2">
                    <span class="text-[var(--color-gold)]">01.</span> Data Diri
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="full_name" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                    </div>

                    <!-- No. Telepon -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">No. Telepon</label>
                        <input type="text" name="phone" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Tempat Lahir</label>
                        <input type="text" name="birth_place" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Tanggal Lahir</label>
                        <input type="text" id="birth_date" name="birth_date" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition cursor-pointer">
                    </div>
                </div>

                <!-- Next Button -->
                <div class="mt-10 text-right">
                    <button type="button" id="nextBtn"
                        class="px-8 py-3 bg-[var(--color-gold)] text-[var(--color-primary-bg)] rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg transform hover:scale-105">
                        Selanjutnya &rarr;
                    </button>
                </div>
            </div>

            {{-- STEP 2: BOOKING & PEMBAYARAN --}}
            <div id="step2" class="step hidden animate-fadeIn">
                <h2 class="text-2xl font-serif font-bold text-white mb-8 border-b border-[var(--color-gold)]/20 pb-4 flex items-center gap-2">
                    <span class="text-[var(--color-gold)]">02.</span> Booking & Pembayaran
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Tanggal Booking -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Tanggal Booking</label>
                        <input type="text" id="booking_date" name="booking_date" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition cursor-pointer">
                    </div>

                    <!-- Paket Layanan -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Paket Layanan</label>
                        <select name="service_id" id="service_package" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                            <option value="" class="text-gray-500">-- Pilih Layanan --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}" class="text-black">
                                    {{ $service->title }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Total Biaya -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Total Biaya</label>
                        <input type="number" name="total_price" id="total_price" readonly
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)]/50 border border-[var(--color-text-muted)]/10 rounded-xl text-gray-400 cursor-not-allowed">
                    </div>

                    <!-- Opsi Pembayaran -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Opsi Pembayaran</label>
                        <select name="dp_option" id="dp_option" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                            <option value="full" class="text-black">Bayar Lunas</option>
                            <option value="dp" class="text-black">DP 50%</option>
                        </select>
                    </div>

                    <!-- Jumlah Dibayar -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Wajib Dibayar</label>
                        <input type="text" id="amount_paid" readonly
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)]/50 border border-[var(--color-gold)] text-[var(--color-gold)] font-bold rounded-xl cursor-not-allowed text-lg">
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Metode Pembayaran</label>
                        <select name="payment_method" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                            <option value="" class="text-black">-- Pilih Metode --</option>
                            <option value="transfer" class="text-black">Transfer Bank</option>
                            <option value="cod" class="text-black">Cash on Delivery</option>
                            <option value="ewallet" class="text-black">E-Wallet (OVO, Dana, Gopay)</option>
                        </select>
                    </div>

                    <!-- Upload Bukti Pembayaran -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Upload Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" accept="image/*"
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-gold)] file:text-[var(--color-primary-bg)] hover:file:bg-[var(--color-gold-light)] transition">
                    </div>

                    <!-- Status Pembayaran -->
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] text-sm uppercase tracking-wider mb-2">Status Pembayaran</label>
                        <select name="payment_status" required
                            class="w-full px-4 py-3 bg-[var(--color-primary-bg)] border border-[var(--color-text-muted)]/30 rounded-xl text-white focus:outline-none focus:border-[var(--color-gold)] focus:ring-1 focus:ring-[var(--color-gold)] transition">
                            <option value="pending" class="text-black">Belum Bayar</option>
                            <option value="paid" class="text-black">Lunas</option>
                            <option value="dp_paid" class="text-black">DP Terbayar</option>
                        </select>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-10 flex justify-between">
                    <button type="button" id="prevBtn"
                        class="px-8 py-3 bg-gray-600 text-white rounded-full font-bold uppercase tracking-widest hover:bg-gray-500 transition">
                        &larr; Kembali
                    </button>
                    <button type="submit"
                        class="px-8 py-3 bg-[var(--color-gold)] text-[var(--color-primary-bg)] rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] transition shadow-lg transform hover:scale-105">
                        Kirim Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
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
                        <select name="service_id" id="service_package" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                    {{ $service->title }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                </option>
                            @endforeach
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

<!-- Flatpickr & SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const bookedDates = @json($bookedDates ?? []);

    // === STEP NAVIGATION ===
    document.getElementById("nextBtn").addEventListener("click", function() {
        document.getElementById("step1").classList.add("hidden");
        document.getElementById("step2").classList.remove("hidden");
    });
    document.getElementById("prevBtn").addEventListener("click", function() {
        document.getElementById("step2").classList.add("hidden");
        document.getElementById("step1").classList.remove("hidden");
    });

    // === FLATPICKR ===
    flatpickr("#birth_date", { dateFormat: "Y-m-d", altInput: true, altFormat: "d F Y", allowInput: true });
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

    // === UPDATE HARGA ===
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

    // === SWEETALERT KONFIRMASI SEBELUM SUBMIT ===
    const bookingForm = document.querySelector('form');
    bookingForm.addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Booking',
            text: 'Apakah data yang kamu masukkan sudah benar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, kirim booking!',
            cancelButtonText: 'Periksa lagi',
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280'
        }).then((result) => {
            if (result.isConfirmed) {
                bookingForm.submit();
            }
        });
    });

    // === SWEETALERT BERHASIL ===
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Booking Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#2563eb'
        });
    @endif
</script>
@endsection
