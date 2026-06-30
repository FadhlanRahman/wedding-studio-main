@extends('layouts.admin')

@section('content')
<div class="min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.bookings.update', $booking->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-[var(--color-secondary-bg)] p-6 md:p-10 rounded-3xl shadow-2xl border border-[var(--color-gold)]/20">
            @csrf
            @method('PUT')

            <h1 class="text-3xl font-serif font-bold mb-10 text-white border-b border-[var(--color-gold)]/20 pb-4 flex items-center gap-3">
                <span>📝</span> Edit Booking
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Nama Lengkap -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $booking->full_name) }}" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition">
                </div>

                <!-- No. Telepon -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition">
                </div>

                <!-- Tempat Lahir -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ old('birth_place', $booking->birth_place) }}" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition">
                </div>

                <!-- Tanggal Lahir -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Tanggal Lahir</label>
                    <input type="text" id="birth_date" name="birth_date" 
                        value="{{ old('birth_date', $booking->birth_date) }}" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition cursor-pointer">
                </div>

                <!-- Tanggal Booking -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Tanggal Booking</label>
                    <input type="text" id="booking_date" name="booking_date" 
                        value="{{ old('booking_date', $booking->booking_date) }}" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 transition cursor-pointer">
                </div>

                <!-- Paket Layanan -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Paket Layanan</label>
                    <select name="service_id" id="service_package" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] transition appearance-none">
                        <option value="" class="bg-[var(--color-primary-bg)]">-- Pilih Paket --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" data-price="{{ $service->price }}"
                                {{ $booking->service_id == $service->id ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">
                                {{ $service->title }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Total Biaya -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Total Biaya</label>
                    <input type="text" name="total_price" id="total_price" 
                        value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}" readonly
                        class="w-full bg-[var(--color-primary-bg)]/50 border border-[var(--color-gold)]/10 rounded-xl px-4 py-3 text-[var(--color-gold)] font-bold font-serif text-lg cursor-not-allowed">
                </div>

                <!-- Metode Pembayaran -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] transition appearance-none">
                        <option value="transfer" {{ $booking->payment_method=='transfer' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Transfer Bank</option>
                        <option value="cod" {{ $booking->payment_method=='cod' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Cash on Delivery</option>
                        <option value="ewallet" {{ $booking->payment_method=='ewallet' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">E-Wallet (OVO, Dana, Gopay)</option>
                    </select>
                </div>

                <!-- Status Pembayaran -->
                <div class="group">
                    <label class="block font-bold text-[var(--color-gold)] mb-2 uppercase tracking-wide text-sm group-hover:text-[var(--color-gold-light)] transition">Status Pembayaran</label>
                    <select name="payment_status" required
                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] transition appearance-none">
                        <option value="unpaid" {{ $booking->payment_status=='unpaid' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Belum Bayar</option>
                        <option value="pending" {{ $booking->payment_status=='pending' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Menunggu Konfirmasi</option>
                        <option value="paid" {{ $booking->payment_status=='paid' ? 'selected' : '' }} class="bg-[var(--color-primary-bg)]">Lunas</option>
                    </select>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="md:col-span-2 bg-[var(--color-primary-bg)] p-6 rounded-2xl border border-[var(--color-gold)]/10 text-center">
                    <label class="block font-bold text-[var(--color-gold)] mb-4 uppercase tracking-wide text-sm">Bukti Pembayaran</label>

                    @if($booking->payment_proof)
                        <div class="mb-4 inline-block">
                            <p class="text-xs text-[var(--color-text-muted)] mb-2">Bukti pembayaran saat ini:</p>
                            <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="w-48 h-48 object-cover rounded-xl shadow-lg border border-[var(--color-gold)]/20 transform hover:scale-105 transition duration-300">
                            </a>
                        </div>
                    @else
                        <p class="text-xs text-red-400 italic mb-4">Belum ada bukti pembayaran.</p>
                    @endif

                    <!-- Preview gambar baru -->
                    <div id="preview-container" class="mt-4 hidden animate-fadeIn">
                        <p class="text-xs text-[var(--color-text-light)] mb-2">Preview gambar baru:</p>
                        <img id="preview-image" class="w-48 h-48 object-cover rounded-xl shadow-lg border border-[var(--color-gold)]/20 mx-auto">
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <button type="submit" class="px-10 py-4 bg-[var(--color-gold)] text-[var(--color-primary-bg)] rounded-full font-bold uppercase tracking-widest hover:bg-[var(--color-gold-light)] shadow-lg hover:shadow-[var(--color-gold)]/20 transform hover:-translate-y-1 transition duration-300">
                    Update Booking
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

// Update Harga
document.getElementById('service_package').addEventListener('change', function(){

    let price = this.options[this.selectedIndex].dataset.price;

    if(price){
        document.getElementById('total_price').value =
        "Rp " + Number(price).toLocaleString('id-ID');
    }

});

// Preview Gambar
const paymentProof = document.getElementById('payment_proof');

if(paymentProof){

    paymentProof.addEventListener('change',function(e){

        const file = e.target.files[0];

        if(file){

            const reader = new FileReader();

            reader.onload=function(event){

                document.getElementById('preview-image').src=event.target.result;

                document.getElementById('preview-container').classList.remove('hidden');

            }

            reader.readAsDataURL(file);

        }

    });

}

@if(session('success'))
Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:"{{ session('success') }}"
});
@endif

@if(session('error'))
Swal.fire({
    icon:'error',
    title:'Gagal',
    text:"{{ session('error') }}"
});
@endif

@if($errors->any())
Swal.fire({
    icon:'error',
    title:'Terjadi Kesalahan',
    html:`{!! implode('<br>', $errors->all()) !!}`
});
@endif

</script>

@endsection