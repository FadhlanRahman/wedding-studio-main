@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-4 md:p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-6 md:p-8">
        <h2 class="text-xl md:text-2xl font-bold mb-6 text-gray-800 text-center md:text-left">
            ✏️ Edit Kontak
        </h2>

        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- 📱 Card Telepon -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">📞 Telepon</label>
                <input type="text" name="phone"
                       value="{{ old('phone', $contact->phone ?? '') }}"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base"
                       placeholder="Masukkan nomor telepon">
            </div>

            <!-- 📧 Card Email -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">📧 Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $contact->email ?? '') }}"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base"
                       placeholder="Masukkan email">
            </div>

            <!-- 🏠 Card Alamat -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">🏠 Alamat</label>
                <textarea name="address" rows="3"
                          class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base resize-none"
                          placeholder="Masukkan alamat lengkap">{{ old('address', $contact->address ?? '') }}</textarea>
            </div>

            <!-- 📸 Card Instagram -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">📸 Instagram</label>
                <input type="text" name="instagram"
                       value="{{ old('instagram', $contact->instagram ?? '') }}"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base"
                       placeholder="Masukkan username Instagram">
            </div>

            <!-- 💬 Card WhatsApp -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">💬 WhatsApp</label>
                <input type="text" name="whatsapp"
                       value="{{ old('whatsapp', $contact->whatsapp ?? '') }}"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base"
                       placeholder="Masukkan nomor WhatsApp">
            </div>

            <!-- 🗺️ Card Map URL -->
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">🗺️ Map URL</label>
                <input type="text" name="map_url"
                       value="{{ old('map_url', $contact->map_url ?? '') }}"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm md:text-base"
                       placeholder="Masukkan URL Google Maps">
            </div>

            <!-- 🔘 Tombol Simpan -->
            <div class="pt-4 flex justify-center md:justify-end">
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 shadow-md transition w-full md:w-auto">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
