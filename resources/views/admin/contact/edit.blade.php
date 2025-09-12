@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Edit Kontak</h2>

    <form action="{{ route('admin.contact.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $contact->phone ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', $contact->address ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Instagram</label>
            <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label>WhatsApp</label>
            <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-3">
            <label>Map URL</label>
            <input type="text" name="map_url" value="{{ old('map_url', $contact->map_url ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
    </form>
</div>
@endsection
