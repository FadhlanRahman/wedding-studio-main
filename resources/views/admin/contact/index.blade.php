@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6">📞 Kontak Website</h1>

    @if($contact)
        {{-- Detail Kontak --}}
        <div class="space-y-2 mb-6 bg-gray-100 p-4 rounded-lg">
            <p><strong>Telepon:</strong> {{ $contact->phone ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $contact->email ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $contact->address ?? '-' }}</p>

            {{-- Instagram --}}
            <p><strong>Instagram:</strong> 
                @if(!empty($contact->instagram))
                    <a href="https://instagram.com/{{ ltrim($contact->instagram, '@') }}" 
                       class="text-blue-600 underline" target="_blank">
                        {{ '@' . ltrim($contact->instagram, '@') }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- WhatsApp --}}
            <p><strong>WhatsApp:</strong> 
                @if(!empty($contact->whatsapp))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" 
                       class="text-blue-600 underline" target="_blank">
                        {{ $contact->whatsapp }}
                    </a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>

            {{-- Google Maps --}}
            <p><strong>Google Maps:</strong> 
                @if($contact->map_url)
                    <a href="{{ $contact->map_url }}" class="text-blue-600 underline" target="_blank">Lihat Lokasi</a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>
        </div>

        {{-- Tombol Edit + Delete --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.contact.edit') }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                ✏️ Edit Kontak
            </a>

            {{-- FORM DELETE --}}
            <form action="{{ route('admin.contact.destroy') }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus kontak ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    🗑️ Hapus Kontak
                </button>
            </form>
        </div>

        {{-- Form Edit --}}
        <h2 class="text-xl font-semibold mb-4">✏️ Ubah Kontak</h2>
        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium">Email</label>
                <input type="text" name="email" value="{{ old('email', $contact->email) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $contact->address) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium">Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium">WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-medium">Google Maps Link</label>
                <input type="text" name="map_url" value="{{ old('map_url', $contact->map_url) }}" 
                       class="w-full border rounded p-2" placeholder="https://maps.app.goo.gl/xxxx">
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                💾 Simpan
            </button>
        </form>

    @else
        <p class="text-red-500">⚠️ Data kontak belum ada.</p>
        <a href="{{ route('admin.contact.edit') }}" 
           class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">
            ➕ Tambah Kontak
        </a>
    @endif
</div>
@endsection
