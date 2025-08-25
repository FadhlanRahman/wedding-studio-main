@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Booking</h1>

    <!-- Tabel Booking -->
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-200">
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
            <tbody>
                @forelse($bookings as $booking)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        {{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}
                    </td>
                    <td class="p-3">{{ $booking->full_name }}</td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                    </td>
                    <td class="p-3">{{ $booking->service }}</td>
                    <td class="p-3">
                        @if($booking->total_price)
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        @else
                            <span class="text-gray-400">Belum ditentukan</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $booking->payment_method ?? '-' }}</td>

                    <!-- Kolom Status + Approval -->
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm
                            {{ $booking->payment_status == 'paid' ? 'bg-green-200 text-green-800' : 
                               ($booking->payment_status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>

                        <!-- Tombol Approval -->
                        <div class="mt-2">
                            <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="payment_status" onchange="this.form.submit()" class="border rounded p-1">
                                    <option disabled selected>-- Approval --</option>
                                    <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                </select>
                            </form>
                        </div>
                    </td>

                    <!-- Bukti Bayar -->
                    <td class="p-3">
                        @if($booking->payment_proof)
                            <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                     alt="Bukti" class="w-24 h-24 object-cover rounded">
                            </a>
                        @else
                            <span class="text-red-500">Belum upload</span>
                        @endif
                    </td>

                    <!-- Tombol Edit & Hapus -->
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-3 text-center text-gray-500">Belum ada booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $bookings->links() }}
    </div>

    <!-- Kalender -->
    <div class="mt-10">
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
                    'color' => $booking->payment_status == 'paid' ? 'green' : 'orange',
                ];
            })->toJson() !!}
        });

        calendar.render();
    });
</script>
@endpush
