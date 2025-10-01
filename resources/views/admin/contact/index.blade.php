@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6">📞 Kontak Website</h1>

    {{-- ======================= --}}
    {{-- Bagian Kontak --}}
    {{-- ======================= --}}
    @if($contact)
        <div class="space-y-2 mb-6 bg-gray-100 p-4 rounded-lg">
            <p><strong>Telepon:</strong> {{ $contact->phone ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $contact->email ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $contact->address ?? '-' }}</p>

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

            <form action="{{ route('admin.contact.destroy') }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus kontak ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    🗑️ Hapus Kontak
                </button>
            </form>
        </div>

        {{-- Form Edit Kontak --}}
        <h2 class="text-xl font-semibold mb-4">✏️ Ubah Kontak</h2>
        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-4 mb-8">
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



    {{-- ======================= --}}
    {{-- Bagian Testimoni User --}}
    {{-- ======================= --}}
    <h2 class="text-xl font-semibold mt-8 mb-4">💬 Testimoni Pengguna</h2>

    @if(isset($testimonials) && $testimonials->count() > 0)
        <div class="space-y-4">
            @foreach($testimonials as $testimonial)
                <div class="border p-4 rounded-lg bg-gray-50 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $testimonial->name }}</p>
                        <p class="text-gray-700">{{ $testimonial->message }}</p>

                        {{-- Rating Bintang --}}
                        <div>
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>

                        <p class="text-sm text-gray-500">📅 {{ $testimonial->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="flex space-x-2">
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.contact.testimonial.destroy', $testimonial->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">
                                🗑️ Hapus
                            </button>
                        </form>

                        {{-- Tombol Publish / Unpublish --}}
                        @if(!$testimonial->is_published)
                            <form action="{{ route('admin.contact.testimonial.publish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">
                                    ✅ Tampilkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.contact.testimonial.unpublish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-yellow-600 text-white rounded">
                                    🚫 Sembunyikan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada testimoni.</p>
    @endif
    </div>
    @endsection
