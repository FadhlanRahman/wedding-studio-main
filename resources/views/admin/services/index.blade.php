@extends('layouts.admin')

@section('content')
<div class="bg-[var(--color-secondary-bg)] p-4 md:p-6 rounded-3xl shadow-xl border border-[var(--color-gold)]/20 text-[var(--color-text-light)]">
    <h1 class="text-xl md:text-2xl font-serif font-bold mb-6 text-white text-center md:text-left border-b border-[var(--color-gold)]/20 pb-3">
        🧾 Manage Services
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <a href="{{ route('admin.services.create') }}" 
           class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-5 py-2.5 rounded-xl hover:bg-[var(--color-gold-light)] text-sm md:text-base shadow-lg font-bold uppercase tracking-wider transition transform hover:-translate-y-0.5">
            + Add Service
        </a>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-500/30 text-green-200 p-3 rounded-xl w-full md:w-auto text-center md:text-left shadow-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>

    {{-- ✅ Tabel versi desktop --}}
    <div class="hidden md:block overflow-x-auto rounded-xl border border-[var(--color-gold)]/20">
        <table class="min-w-full text-sm md:text-base text-left">
            <thead class="bg-[var(--color-primary-bg)] text-[var(--color-gold)] uppercase tracking-wider font-serif">
                <tr>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20">Icon</th>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20">Title</th>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20">Description</th>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20 whitespace-nowrap">Price</th>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20 text-center">PDF</th>
                    <th class="px-6 py-4 border-b border-[var(--color-gold)]/20 text-center w-48">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--color-gold)]/10">
                @foreach($services as $service)
                <tr class="hover:bg-[var(--color-gold)]/5 transition duration-300">
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10 text-2xl text-center">{{ $service->icon }}</td>
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10 font-bold text-white break-words">{{ $service->title }}</td>
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10 break-words text-[var(--color-text-muted)]">{{ $service->description }}</td>
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10 text-[var(--color-gold)] font-bold whitespace-nowrap font-serif">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </td>

                    {{-- Kolom PDF --}}
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10 text-center">
                        @if ($service->pdf_path)
                            <a href="{{ asset('storage/' . $service->pdf_path) }}" 
                               target="_blank"
                               class="inline-flex items-center gap-2 bg-green-900/50 border border-green-500/30 hover:bg-green-800 text-green-200 px-3 py-1.5 rounded-lg text-xs md:text-sm shadow-sm transition">
                                📄 <span class="hidden lg:inline">Deskripsi Paket</span>
                            </a>
                        @else
                            <span class="text-[var(--color-text-muted)] text-xs italic opacity-50">No PDF</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4 border-b border-[var(--color-gold)]/10">
                        <div class="flex flex-col sm:flex-row justify-center gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}" 
                               class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-3 py-1.5 rounded-lg hover:bg-[var(--color-gold-light)] text-xs md:text-sm text-center shadow-sm font-bold uppercase transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" 
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin hapus service ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-900/80 border border-red-500/30 text-red-200 px-3 py-1.5 rounded-lg hover:bg-red-800 text-xs md:text-sm w-full sm:w-auto shadow-sm font-bold uppercase transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ✅ Versi mobile (card view) --}}
    <div class="md:hidden space-y-4">
        @foreach($services as $service)
        <div class="border border-[var(--color-gold)]/20 rounded-xl p-5 shadow-lg bg-[var(--color-primary-bg)]">
            <div class="flex items-center gap-3 mb-3 border-b border-[var(--color-gold)]/10 pb-2">
                <span class="text-3xl">{{ $service->icon }}</span>
                <h2 class="font-serif font-bold text-lg text-white">{{ $service->title }}</h2>
            </div>

            <p class="text-[var(--color-text-muted)] text-sm mb-2 leading-relaxed">
                <strong>Description:</strong> {{ $service->description }}
            </p>

            <p class="text-[var(--color-gold)] font-bold text-lg mb-4 font-serif">
                Rp {{ number_format($service->price, 0, ',', '.') }}
            </p>

            {{-- Tombol lihat PDF --}}
            @if ($service->pdf_path)
                <a href="{{ asset('storage/' . $service->pdf_path) }}" 
                   target="_blank"
                   class="block bg-green-900/50 border border-green-500/30 hover:bg-green-800 text-green-200 text-sm px-4 py-2 rounded-lg mb-3 text-center transition">
                    📄 Deskripsi Paket
                </a>
            @else
                <span class="block text-[var(--color-text-muted)] text-sm italic mb-3 text-center opacity-50">No PDF</span>
            @endif

            {{-- Aksi Edit & Delete --}}
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('admin.services.edit', $service) }}" 
                   class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-4 py-2 rounded-lg hover:bg-[var(--color-gold-light)] text-center text-sm font-bold uppercase transition">
                    ✏️ Edit
                </a>
                <form action="{{ route('admin.services.destroy', $service) }}" 
                      method="POST"
                      onsubmit="return confirm('Yakin hapus service ini?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-900/80 border border-red-500/30 text-red-200 px-4 py-2 rounded-lg hover:bg-red-800 w-full text-sm font-bold uppercase transition">
                        🗑️ Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

