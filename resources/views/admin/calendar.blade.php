@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3">
        📋 Daftar Booking
    </h1>

    <!-- Tabel Booking -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Nama Klien</th>
                    <th class="p-3 text-left">Tanggal Booking</th>
                    <th class="p-3 text-left">Layanan</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Metode Bayar</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Bukti Bayar</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-3">
                        {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}
                    </td>
                    <td class="p-3 font-medium text-gray-700">{{ $booking->full_name }}</td>
                    <td class="p-3 text-gray-600">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                    </td>
                    <td class="p-3">{{ $booking->service }}</td>
                    <td class="p-3 font-semibold text-blue-700">
                        @if($booking->total_price)
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        @else
                            <span class="text-gray-400 italic">Belum ditentukan</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $booking->payment_method ?? '-' }}</td>

                    <!-- Kolom Status + Approval -->
                    <td class="p-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $booking->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 
                               ($booking->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>

                        <!-- Tombol Approval -->
                        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <select name="payment_status" onchange="this.form.submit()" 
                                class="w-full border-gray-300 rounded-lg text-sm p-2 focus:ring-2 focus:ring-blue-400">
                                <option disabled selected>-- Approval --</option>
                                <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </form>
                    </td>

                    <!-- Bukti Bayar -->
                    <td class="p-3">
                        @if($booking->payment_proof)
                            <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                     alt="Bukti" 
                                     class="w-24 h-24 object-cover rounded-lg shadow-md transform hover:scale-105 transition">
                            </a>
                        @else
                            <span class="text-red-500 italic">Belum upload</span>
                        @endif
                    </td>

                    <!-- Tombol Edit & Hapus -->
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-6 text-center text-gray-500 italic">Belum ada booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>

    <!-- Kalender -->
    <div class="mt-10 bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">📆 Kalender Booking</h2>
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {!! $bookings->map(function($booking) {
                return [
                    'title' => $booking->full_name . ' - ' . ucfirst($booking->service),
                    'start' => $booking->booking_date,
                    'color' => $booking->payment_status == 'paid' ? '#16a34a' : '#f59e0b',
                ];
            })->toJson() !!}
        });

        calendar.render();
    });
</script>
@endpush
