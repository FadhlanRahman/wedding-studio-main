@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4 md:p-6 text-[var(--color-text-light)]">
    <h1 class="text-2xl md:text-3xl font-serif font-bold mb-8 text-white flex items-center gap-3">
        <span>👥</span> Akun Terdaftar
    </h1>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-900/50 border border-green-500/30 text-green-200 rounded-xl shadow text-sm md:text-base">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-900/50 border border-red-500/30 text-red-200 rounded-xl shadow text-sm md:text-base">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    {{-- Tampilan Mobile (Card List) --}}
    <div class="block md:hidden space-y-4">
        @forelse($users as $index => $user)
            <div class="bg-[var(--color-secondary-bg)] shadow-lg rounded-xl p-5 border border-[var(--color-gold)]/20">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="font-bold text-white text-base">{{ $user->name }}</h2>
                    <span class="bg-[var(--color-gold)]/10 text-[var(--color-gold)] text-xs px-2 py-1 rounded-full border border-[var(--color-gold)]/20">
                        📅 {{ $user->created_at->format('d M Y') }}
                    </span>
                </div>
                <p class="text-[var(--color-text-muted)] text-sm mb-4">{{ $user->email }}</p>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.accounts.edit', $user->id) }}" 
                       class="flex items-center gap-1 bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-1.5 rounded-lg shadow hover:bg-[var(--color-gold-light)] transition text-xs font-bold">
                        ✏️ Edit
                    </a>

                    @if(auth()->id() !== $user->id)
                        <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="flex items-center gap-1 bg-red-900/50 border border-red-500/30 text-red-200 px-3 py-1.5 rounded-lg shadow hover:bg-red-900/80 transition text-xs">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-[var(--color-text-muted)]">Belum ada akun terdaftar.</p>
        @endforelse
    </div>

    {{-- Tampilan Desktop (Tabel) --}}
    <div class="hidden md:block bg-[var(--color-secondary-bg)] rounded-xl shadow-xl overflow-x-auto border border-[var(--color-gold)]/20">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-[var(--color-primary-bg)] text-[var(--color-gold)] uppercase tracking-wider text-xs">
                    <th class="p-4 text-left font-serif">#</th>
                    <th class="p-4 text-left font-serif">Nama</th>
                    <th class="p-4 text-left font-serif">Email</th>
                    <th class="p-4 text-left font-serif">Tanggal Daftar</th>
                    <th class="p-4 text-left font-serif">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--color-gold)]/10">
                @forelse($users as $index => $user)
                    <tr class="hover:bg-[var(--color-gold)]/5 transition">
                        <td class="p-4 text-[var(--color-text-muted)]">{{ $index + 1 }}</td>
                        <td class="p-4 font-bold text-white">{{ $user->name }}</td>
                        <td class="p-4 text-[var(--color-text-muted)]">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="bg-[var(--color-gold)]/10 text-[var(--color-gold)] text-sm px-3 py-1 rounded-full border border-[var(--color-gold)]/20">
                                📅 {{ $user->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td class="p-4 flex gap-3">
                            <a href="{{ route('admin.accounts.edit', $user->id) }}" 
                               class="flex items-center gap-1 bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-4 py-1.5 rounded-lg shadow hover:bg-[var(--color-gold-light)] transition text-sm font-bold">
                                ✏️ Edit
                            </a>

                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.accounts.destroy', $user->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center gap-1 bg-red-900/50 border border-red-500/30 text-red-200 px-4 py-1.5 rounded-lg shadow hover:bg-red-900/80 transition text-sm">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-[var(--color-text-muted)]">
                            Belum ada akun terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
