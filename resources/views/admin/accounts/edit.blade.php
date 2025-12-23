@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4 md:p-6 max-w-lg text-[var(--color-text-light)]">
    <h1 class="text-xl md:text-2xl font-serif font-bold mb-8 text-white text-center md:text-left border-b border-[var(--color-gold)]/20 pb-4">
        ✏️ Edit Akun
    </h1>

    {{-- Notifikasi Error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-900/50 text-red-200 border border-red-500/30 rounded-xl text-sm md:text-base">
            <ul class="list-disc pl-5 opacity-80">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit --}}
    <form action="{{ route('admin.accounts.update', $user->id) }}" method="POST" 
          class="bg-[var(--color-secondary-bg)] p-6 md:p-8 rounded-2xl shadow-xl border border-[var(--color-gold)]/20 space-y-6">
        @csrf
        @method('PUT')

        {{-- Input Nama --}}
        <div>
            <label for="name" class="block mb-2 font-bold text-[var(--color-gold)] text-sm md:text-base uppercase tracking-wide">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] rounded-xl px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 text-sm md:text-base transition focus:outline-none"
                   placeholder="Masukkan nama pengguna" required>
        </div>

        {{-- Input Email --}}
        <div>
            <label for="email" class="block mb-2 font-bold text-[var(--color-gold)] text-sm md:text-base uppercase tracking-wide">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="w-full bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/30 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] rounded-xl px-4 py-3 text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50 text-sm md:text-base transition focus:outline-none"
                   placeholder="Masukkan alamat email" required>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-8 pt-4 border-t border-[var(--color-gold)]/10">
            <button type="submit" 
                    class="w-full md:w-auto bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-6 py-2.5 rounded-xl shadow-lg hover:bg-[var(--color-gold-light)] transition text-sm md:text-base font-bold uppercase tracking-wider transform hover:-translate-y-0.5">
                💾 Simpan Perubahan
            </button>

            <a href="{{ route('admin.accounts.index') }}" 
               class="w-full md:w-auto text-center border border-[var(--color-gold)]/30 px-6 py-2.5 rounded-xl hover:bg-[var(--color-gold)]/10 text-[var(--color-text-muted)] hover:text-white transition text-sm md:text-base font-bold">
                ↩️ Batal
            </a>
        </div>
    </form>
</div>
@endsection
