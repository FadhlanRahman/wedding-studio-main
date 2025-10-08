@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6">
    <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-6 border-b pb-3 text-center md:text-left">
        📋 Daftar Booking
    </h1>

    <!-- ✅ Tabel versi desktop -->
    <div class="hidden md:block w-full overflow-x-auto">
        <div class="inline-block min-w-full align-middle bg-white shadow-lg rounded-2xl">
            <table class="min-w-[900px] w-full text-sm border-collapse">
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
                            <td class="p-3">{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</td>
                            <td class="p-3">{{ $booking->full_name }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</td>
                            <td class="p-3">{{ $booking->service->title ?? '-' }}</td>
                            <td class="p-3 text-blue-700 font-semibold">Rp {{ number_format($booking->service->price ?? 0, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $booking->payment_method ?? '-' }}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $booking->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 
                                       ($booking->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="payment_status" onchange="this.form.submit()" 
                                        class="w-full border-gray-300 rounded-lg text-xs p-1.5 focus:ring-2 focus:ring-blue-400">
                                        <option disabled selected>-- Approval --</option>
                                        <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-3">
                                @if($booking->payment_proof)
                                    <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                        <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                             class="w-16 h-16 object-cover rounded-lg shadow-md transform hover:scale-105 transition">
                                    </a>
                                @else
                                    <span class="text-red-500 italic text-xs">Belum upload</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                                       class="bg-blue-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-blue-600 transition text-xs text-center">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-3 py-1.5 rounded-lg shadow hover:bg-red-600 transition text-xs w-full sm:w-auto">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="p-6 text-center text-gray-500 italic">Belum ada booking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Card View versi Mobile -->
    <div class="md:hidden space-y-4">
        @forelse($bookings as $booking)
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="font-bold text-gray-800 text-lg">{{ $booking->full_name }}</h2>
                    <span class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                    </span>
                </div>

                <p class="text-sm text-gray-600"><strong>Layanan:</strong> {{ $booking->service->title ?? '-' }}</p>
                <p class="text-sm text-gray-600"><strong>Harga:</strong> Rp {{ number_format($booking->service->price ?? 0, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600"><strong>Metode:</strong> {{ $booking->payment_method ?? '-' }}</p>

                <div class="mt-2">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        {{ $booking->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 
                           ($booking->payment_status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </div>

                <div class="mt-3">
                    @if($booking->payment_proof)
                        <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                            <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                 class="w-full h-40 object-cover rounded-lg shadow-md">
                        </a>
                    @else
                        <p class="text-xs text-red-500 italic">Belum upload bukti bayar</p>
                    @endif
                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                       class="bg-blue-500 text-white px-3 py-2 rounded-lg shadow hover:bg-blue-600 text-center text-sm">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 text-white px-3 py-2 rounded-lg shadow hover:bg-red-600 w-full text-sm">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 italic">Belum ada booking.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {!! $bookings->map(function($booking) {
                    return [
                        'title' => $booking->full_name . ' - ' . ($booking->service->title ?? '-'),
                        'start' => $booking->booking_date,
                        'color' => $booking->payment_status == 'paid' ? '#16a34a' : '#f59e0b',
                    ];
                })->toJson() !!}
            });
            calendar.render();
        }
    });
</script>
@endpush
