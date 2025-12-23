@extends('layouts.admin')

@section('content')
<div class="min-h-screen p-4 md:p-6">
    <h1 class="text-2xl md:text-3xl font-serif font-bold text-white mb-6 border-b border-[var(--color-gold)]/20 pb-3 text-center md:text-left">
        📋 Daftar Booking
    </h1>

    <!-- ✅ Tabel versi desktop -->
    <div class="hidden md:block w-full overflow-x-auto">
        <div class="inline-block min-w-full align-middle bg-[var(--color-secondary-bg)] shadow-xl rounded-2xl border border-[var(--color-gold)]/20">
            <table class="min-w-[900px] w-full text-sm border-collapse">
                <thead class="bg-[var(--color-primary-bg)] text-[var(--color-gold)] border-b border-[var(--color-gold)]/20">
                    <tr>
                        <th class="p-4 text-left font-serif tracking-wider">#</th>
                        <th class="p-4 text-left font-serif tracking-wider">Nama Klien</th>
                        <th class="p-4 text-left font-serif tracking-wider">Tanggal Booking</th>
                        <th class="p-4 text-left font-serif tracking-wider">Layanan</th>
                        <th class="p-4 text-left font-serif tracking-wider">Harga</th>
                        <th class="p-4 text-left font-serif tracking-wider">Metode Bayar</th>
                        <th class="p-4 text-left font-serif tracking-wider">Status</th>
                        <th class="p-4 text-left font-serif tracking-wider">Bukti Bayar</th>
                        <th class="p-4 text-left font-serif tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[var(--color-gold)]/10 text-[var(--color-text-light)]">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-[var(--color-gold)]/5 transition duration-300">
                            <td class="p-4">{{ ($bookings->currentPage() - 1) * $bookings->perPage() + $loop->iteration }}</td>
                            <td class="p-4 font-bold">{{ $booking->full_name }}</td>
                            <td class="p-4">{{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</td>
                            <td class="p-4 text-[var(--color-gold)]">{{ $booking->service->title ?? '-' }}</td>
                            <td class="p-4 font-serif font-bold text-[var(--color-gold)]">Rp {{ number_format($booking->service->price ?? 0, 0, ',', '.') }}</td>
                            <td class="p-4">{{ $booking->payment_method ?? '-' }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    {{ $booking->payment_status == 'paid' ? 'bg-green-900/50 text-green-400 border border-green-500/30' : 
                                       ($booking->payment_status == 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-500/30' : 'bg-red-900/50 text-red-400 border border-red-500/30') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="payment_status" onchange="this.form.submit()" 
                                        class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 rounded-lg text-xs p-1.5 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)]">
                                        <option disabled selected>-- Approval --</option>
                                        <option value="pending" {{ $booking->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $booking->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                </form>
                            </td>
                            <td class="p-4">
                                @if($booking->payment_proof)
                                    <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                                        <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                             class="w-16 h-16 object-cover rounded-lg shadow-md border border-[var(--color-gold)]/20 transform hover:scale-105 transition">
                                    </a>
                                @else
                                    <span class="text-red-400 italic text-xs">Belum upload</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                                       class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-1.5 rounded-lg shadow hover:bg-[var(--color-gold-light)] transition text-xs text-center font-bold uppercase tracking-wide">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-900/80 border border-red-500/30 text-red-200 px-3 py-1.5 rounded-lg shadow hover:bg-red-800 transition text-xs w-full font-bold uppercase tracking-wide">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="p-8 text-center text-[var(--color-text-muted)] italic">Belum ada booking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Card View versi Mobile -->
    <div class="md:hidden space-y-4">
        @forelse($bookings as $booking)
            <div class="bg-[var(--color-secondary-bg)] rounded-xl shadow-lg border border-[var(--color-gold)]/20 p-5">
                <div class="flex justify-between items-center mb-3 border-b border-[var(--color-gold)]/10 pb-2">
                    <h2 class="font-serif font-bold text-white text-lg">{{ $booking->full_name }}</h2>
                    <span class="text-xs text-[var(--color-text-muted)]">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                    </span>
                </div>

                <div class="space-y-1 text-sm text-[var(--color-text-light)]">
                    <p><strong class="text-[var(--color-gold)]">Layanan:</strong> {{ $booking->service->title ?? '-' }}</p>
                    <p><strong class="text-[var(--color-gold)]">Harga:</strong> Rp {{ number_format($booking->service->price ?? 0, 0, ',', '.') }}</p>
                    <p><strong class="text-[var(--color-gold)]">Metode:</strong> {{ $booking->payment_method ?? '-' }}</p>
                </div>

                <div class="mt-3">
                    <span class="px-2 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                        {{ $booking->payment_status == 'paid' ? 'bg-green-900/50 text-green-400 border border-green-500/30' : 
                           ($booking->payment_status == 'pending' ? 'bg-yellow-900/50 text-yellow-400 border border-yellow-500/30' : 'bg-red-900/50 text-red-400 border border-red-500/30') }}">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </div>

                <div class="mt-4">
                    @if($booking->payment_proof)
                        <a href="{{ asset('uploads/payments/'.$booking->payment_proof) }}" target="_blank">
                            <img src="{{ asset('uploads/payments/'.$booking->payment_proof) }}" 
                                 class="w-full h-40 object-cover rounded-lg shadow-md border border-[var(--color-gold)]/20">
                        </a>
                    @else
                        <p class="text-xs text-red-400 italic">Belum upload bukti bayar</p>
                    @endif
                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                       class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-2 rounded-lg shadow hover:bg-[var(--color-gold-light)] text-center text-sm font-bold uppercase">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-900/80 border border-red-500/30 text-red-200 px-3 py-2 rounded-lg shadow hover:bg-red-800 w-full text-sm font-bold uppercase">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-[var(--color-text-muted)] italic">Belum ada booking.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
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
