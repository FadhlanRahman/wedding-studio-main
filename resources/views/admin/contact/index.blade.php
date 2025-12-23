@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-8 bg-[var(--color-secondary-bg)] rounded-3xl shadow-xl border border-[var(--color-gold)]/20 text-[var(--color-text-light)]">
    <h1 class="text-2xl font-serif font-bold mb-8 text-white text-center md:text-left border-b border-[var(--color-gold)]/20 pb-4">
        📞 Kontak Website
    </h1>

    {{-- ======================= --}}
    {{-- Bagian Kontak --}}
    {{-- ======================= --}}
    @if($contact)
        <div class="bg-[var(--color-primary-bg)] p-6 rounded-2xl shadow-lg mb-8 border border-[var(--color-gold)]/10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm md:text-base leading-relaxed">
                <div class="space-y-3">
                    <p><strong class="text-[var(--color-gold)]">Telepon:</strong> {{ $contact->phone ?? '-' }}</p>
                    <p><strong class="text-[var(--color-gold)]">Email:</strong> {{ $contact->email ?? '-' }}</p>
                    <p><strong class="text-[var(--color-gold)]">Alamat:</strong> {{ $contact->address ?? '-' }}</p>
                </div>
                <div class="space-y-3">
                    <p><strong class="text-[var(--color-gold)]">Instagram:</strong>
                        @if(!empty($contact->instagram))
                            <a href="https://instagram.com/{{ ltrim($contact->instagram, '@') }}" 
                               class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] underline transition" target="_blank">
                                {{ '@' . ltrim($contact->instagram, '@') }}
                            </a>
                        @else
                            <span class="text-[var(--color-text-muted)] opacity-50">Belum tersedia</span>
                        @endif
                    </p>

                    <p><strong class="text-[var(--color-gold)]">WhatsApp:</strong> 
                        @if(!empty($contact->whatsapp))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" 
                               class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] underline transition" target="_blank">
                                {{ $contact->whatsapp }}
                            </a>
                        @else
                            <span class="text-[var(--color-text-muted)] opacity-50">Belum tersedia</span>
                        @endif
                    </p>

                    <p><strong class="text-[var(--color-gold)]">Google Maps:</strong> 
                        @if($contact->map_url)
                            <a href="{{ $contact->map_url }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-gold)] underline transition" target="_blank">Lihat Lokasi</a>
                        @else
                            <span class="text-[var(--color-text-muted)] opacity-50">Belum tersedia</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- Tombol Edit + Delete --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-10">
            <a href="{{ route('admin.contact.edit') }}" 
               class="flex-1 sm:flex-none text-center bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-6 py-3 rounded-xl hover:bg-[var(--color-gold-light)] font-bold uppercase tracking-wider shadow-lg transition transform hover:-translate-y-0.5">
                ✏️ Edit Kontak
            </a>

            <form action="{{ route('admin.contact.destroy') }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus kontak ini?')" class="flex-1 sm:flex-none">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full bg-red-900/80 border border-red-500/30 text-red-200 px-6 py-3 rounded-xl hover:bg-red-800 font-bold uppercase tracking-wider shadow-lg transition transform hover:-translate-y-0.5">
                    🗑️ Hapus Kontak
                </button>
            </form>
        </div>

        {{-- Form Edit Kontak --}}
        <div class="bg-[var(--color-primary-bg)] p-6 rounded-2xl border border-[var(--color-gold)]/10 shadow-lg">
            <h2 class="text-xl font-serif font-bold mb-6 text-white border-b border-[var(--color-gold)]/10 pb-2">✏️ Ubah Kontak</h2>
            <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-6 mb-2">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] mb-2">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50">
                    </div>
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] mb-2">Email</label>
                        <input type="text" name="email" value="{{ old('email', $contact->email) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-medium text-[var(--color-gold)] mb-2">Alamat</label>
                        <input type="text" name="address" value="{{ old('address', $contact->address) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50">
                    </div>
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] mb-2">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50">
                    </div>
                    <div>
                        <label class="block font-medium text-[var(--color-gold)] mb-2">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block font-medium text-[var(--color-gold)] mb-2">Google Maps Link</label>
                        <input type="text" name="map_url" value="{{ old('map_url', $contact->map_url) }}" 
                               class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-lg p-3 focus:ring-1 focus:ring-[var(--color-gold)] text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/50"
                               placeholder="https://maps.app.goo.gl/xxxx">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" 
                            class="bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-8 py-3 rounded-xl hover:bg-[var(--color-gold-light)] font-bold uppercase tracking-wider shadow-lg transition transform hover:scale-105">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="text-center py-10 bg-[var(--color-primary-bg)] rounded-2xl border border-[var(--color-gold)]/10">
            <p class="text-red-400 mb-4 font-bold text-lg">⚠️ Data kontak belum ada.</p>
            <a href="{{ route('admin.contact.edit') }}" 
               class="inline-block bg-[var(--color-gold)] text-[var(--color-primary-bg)] px-6 py-3 rounded-xl hover:bg-[var(--color-gold-light)] font-bold uppercase tracking-wider shadow-lg transition">
                ➕ Tambah Kontak
            </a>
        </div>
    @endif


    {{-- ======================= --}}
    {{-- Bagian Testimoni User --}}
    {{-- ======================= --}}
    <h2 class="text-2xl font-serif font-bold mt-12 mb-6 text-white border-b border-[var(--color-gold)]/20 pb-3">💬 Testimoni Pengguna</h2>

    @if(isset($testimonials) && $testimonials->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
                <div class="border border-[var(--color-gold)]/20 p-6 rounded-2xl bg-[var(--color-primary-bg)] shadow-lg hover:shadow-[var(--color-gold)]/10 transition duration-300">
                    <div class="mb-4">
                        <p class="font-bold text-[var(--color-gold)] text-lg mb-1 font-serif">{{ $testimonial->name }}</p>
                        <p class="text-[var(--color-text-light)] text-sm mb-3 italic">"{{ $testimonial->message }}"</p>
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $testimonial->rating ? 'text-[var(--color-gold)]' : 'text-[var(--color-text-muted)] opacity-30' }}">★</span>
                            @endfor
                        </div>
                        <p class="text-xs text-[var(--color-text-muted)]">📅 {{ $testimonial->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-[var(--color-gold)]/10">
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.contact.testimonial.destroy', $testimonial->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-900/50 border border-red-500/30 text-red-200 px-3 py-1.5 rounded-lg text-xs hover:bg-red-800 transition">
                                🗑️ Hapus
                            </button>
                        </form>

                        {{-- Tombol Publish / Unpublish --}}
                        @if(!$testimonial->is_published)
                            <form action="{{ route('admin.contact.testimonial.publish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-900/50 border border-green-500/30 text-green-200 px-3 py-1.5 rounded-lg text-xs hover:bg-green-800 transition">
                                    ✅ Tampilkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.contact.testimonial.unpublish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="bg-yellow-900/50 border border-yellow-500/30 text-yellow-200 px-3 py-1.5 rounded-lg text-xs hover:bg-yellow-800 transition">
                                    🚫 Sembunyikan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-[var(--color-text-muted)] text-center italic py-8 bg-[var(--color-primary-bg)] rounded-xl border border-[var(--color-gold)]/10">Belum ada testimoni.</p>
    @endif
</div>
@endsection

