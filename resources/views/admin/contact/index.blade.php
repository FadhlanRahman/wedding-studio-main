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
            <p><strong>Instagram:</strong> {{ $contact->instagram ?? '-' }}</p>
            <p><strong>WhatsApp:</strong> {{ $contact->whatsapp ?? '-' }}</p>
            <p><strong>Google Maps:</strong> 
                @if($contact->map_url)
                    <a href="{{ $contact->map_url }}" class="text-blue-600 underline" target="_blank">Lihat Lokasi</a>
                @else
                    <span class="text-gray-500">Belum tersedia</span>
                @endif
            </p>
        </div>

        {{-- Tombol Edit --}}
        <a href="{{ route('admin.contact.edit') }}" 
           class="inline-block mb-6 px-4 py-2 bg-blue-600 text-white rounded-lg">
            ✏️ Edit Kontak
        </a>

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
                <label class="block font-medium">Google Maps</label>
                <textarea name="map_url" class="w-full border rounded p-2">{{ old('map_url', $contact->map_url) }}</textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                💾 Simpan
            </button>
        </form>

    @else
        <p class="text-red-500">⚠️ Data kontak belum ada.</p>
        <a href="{{ route('admin.contact.edit') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">
            ➕ Tambah Kontak
        </a>
    @endif
</div>
@endsection
