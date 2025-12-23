@extends('layouts.admin')

@section('content')
<div class="min-h-screen max-w-4xl mx-auto p-4 md:p-6">
    <div class="bg-[var(--color-secondary-bg)] rounded-3xl shadow-xl border border-[var(--color-gold)]/20 p-6 md:p-8">
        <h2 class="text-xl md:text-2xl font-serif font-bold mb-8 text-white text-center md:text-left border-b border-[var(--color-gold)]/20 pb-4">
            ✏️ Edit Kontak
        </h2>

        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 📱 Card Telepon -->
                <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                    <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">📞 Telepon</label>
                    <input type="text" name="phone"
                           value="{{ old('phone', $contact->phone ?? '') }}"
                           class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base transition"
                           placeholder="Masukkan nomor telepon">
                </div>

                <!-- 📧 Card Email -->
                <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                    <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">📧 Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $contact->email ?? '') }}"
                           class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base transition"
                           placeholder="Masukkan email">
                </div>

                <!-- 📸 Card Instagram -->
                <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                    <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">📸 Instagram</label>
                    <input type="text" name="instagram"
                           value="{{ old('instagram', $contact->instagram ?? '') }}"
                           class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base transition"
                           placeholder="Masukkan username Instagram">
                </div>

                <!-- 💬 Card WhatsApp -->
                <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                    <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">💬 WhatsApp</label>
                    <input type="text" name="whatsapp"
                           value="{{ old('whatsapp', $contact->whatsapp ?? '') }}"
                           class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base transition"
                           placeholder="Masukkan nomor WhatsApp">
                </div>
            </div>

            <!-- 🏠 Card Alamat -->
            <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">🏠 Alamat</label>
                <textarea name="address" rows="3"
                          class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base resize-none transition"
                          placeholder="Masukkan alamat lengkap">{{ old('address', $contact->address ?? '') }}</textarea>
            </div>

            <!-- 🗺️ Card Map URL -->
            <div class="bg-[var(--color-primary-bg)] border border-[var(--color-gold)]/10 rounded-2xl p-5 shadow-lg hover:shadow-[var(--color-gold)]/5 transition">
                <label class="block font-bold text-[var(--color-gold)] mb-3 uppercase tracking-wide text-sm">🗺️ Map URL</label>
                <input type="text" name="map_url"
                       value="{{ old('map_url', $contact->map_url ?? '') }}"
                       class="w-full bg-[var(--color-secondary-bg)] border border-[var(--color-gold)]/30 rounded-xl px-4 py-3 focus:ring-1 focus:ring-[var(--color-gold)] focus:border-[var(--color-gold)] focus:outline-none text-[var(--color-text-light)] placeholder-[var(--color-text-muted)]/30 text-sm md:text-base transition"
                       placeholder="Masukkan URL Google Maps">
            </div>

            <!-- 🔘 Tombol Simpan -->
            <div class="pt-6 flex justify-center md:justify-end">
                <button type="submit"
                        class="px-8 py-3 bg-[var(--color-gold)] text-[var(--color-primary-bg)] rounded-xl font-bold uppercase tracking-wider hover:bg-[var(--color-gold-light)] shadow-lg transition transform hover:-translate-y-0.5 w-full md:w-auto">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

