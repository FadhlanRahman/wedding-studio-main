@extends('layouts.admin')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <form action="{{ route('admin.bookings.update', $booking->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white p-8 rounded-xl shadow-lg">
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
                    <input type="text" id="birth_date" name="birth_date" 
                        value="{{ old('birth_date', $booking->birth_date) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Tanggal Booking -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Tanggal Booking</label>
                    <input type="text" id="booking_date" name="booking_date" 
                        value="{{ old('booking_date', $booking->booking_date) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer">
                </div>

                <!-- Paket Layanan -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Paket Layanan</label>
                    <select name="service_id" id="service_package" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">-- Pilih Paket --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ $service->price }}"
                                {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->title }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Total Biaya -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Total Biaya</label>
                    <input type="text" name="total_price" id="total_price" 
                        value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}" readonly
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
                        <option value="unpaid" {{ $booking->payment_status=='unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="pending" {{ $booking->payment_status=='pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="paid" {{ $booking->payment_status=='paid' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="md:col-span-2">
                    <label class="block font-medium text-gray-700 mb-1">Bukti Pembayaran</label>

                    @if($booking->payment_proof)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500 mb-1">Bukti pembayaran saat ini:</p>
                            <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="w-48 h-48 object-cover rounded-lg shadow-md border transform hover:scale-105 transition">
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-red-500 italic mb-2">Belum ada bukti pembayaran.</p>
                    @endif

                    <!-- Preview gambar baru -->
                    <div id="preview-container" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-1">Preview gambar baru:</p>
                        <img id="preview-image" class="w-48 h-48 object-cover rounded-lg shadow-md border">
                    </div>
                </div>
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
    // --- Flatpickr setup ---
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

    // --- Update harga otomatis ---
    document.getElementById('service_package').addEventListener('change', function () {
        let price = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('total_price').value = price ? `Rp ${parseInt(price).toLocaleString()}` : '';
    });

    // --- Preview gambar baru ---
    document.getElementById('payment_proof').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
