@extends('layouts.admin')

@section('content')
<div class="p-4 md:p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center md:text-left">📞 Kontak Website</h1>

    {{-- ======================= --}}
    {{-- Bagian Kontak --}}
    {{-- ======================= --}}
    @if($contact)
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm md:text-base">
                <div>
                    <p><strong>Telepon:</strong> {{ $contact->phone ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $contact->email ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $contact->address ?? '-' }}</p>
                </div>
                <div>
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
            </div>
        </div>

        {{-- Tombol Edit + Delete --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <a href="{{ route('admin.contact.edit') }}" 
               class="flex-1 sm:flex-none text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                ✏️ Edit Kontak
            </a>

            <form action="{{ route('admin.contact.destroy') }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus kontak ini?')" class="flex-1 sm:flex-none">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    🗑️ Hapus Kontak
                </button>
            </form>
        </div>

        {{-- Form Edit Kontak --}}
        <h2 class="text-xl font-semibold mb-4 text-gray-800">✏️ Ubah Kontak</h2>
        <form action="{{ route('admin.contact.update') }}" method="POST" class="space-y-4 mb-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Email</label>
                    <input type="text" name="email" value="{{ old('email', $contact->email) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $contact->address) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact->whatsapp) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Google Maps Link</label>
                    <input type="text" name="map_url" value="{{ old('map_url', $contact->map_url) }}" 
                           class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400"
                           placeholder="https://maps.app.goo.gl/xxxx">
                </div>
            </div>

            <button type="submit" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 w-full sm:w-auto">
                💾 Simpan
            </button>
        </form>
    @else
        <p class="text-red-500">⚠️ Data kontak belum ada.</p>
        <a href="{{ route('admin.contact.edit') }}" 
           class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            ➕ Tambah Kontak
        </a>
    @endif


    {{-- ======================= --}}
    {{-- Bagian Testimoni User --}}
    {{-- ======================= --}}
    <h2 class="text-xl font-semibold mt-8 mb-4 text-gray-800">💬 Testimoni Pengguna</h2>

    @if(isset($testimonials) && $testimonials->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($testimonials as $testimonial)
                <div class="border border-gray-200 p-4 rounded-xl bg-gray-50 shadow-sm hover:shadow-md transition">
                    <div class="mb-2">
                        <p class="font-semibold text-gray-800">{{ $testimonial->name }}</p>
                        <p class="text-gray-700 text-sm mb-2">{{ $testimonial->message }}</p>
                        <div class="mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                            @endfor
                        </div>
                        <p class="text-xs text-gray-500">📅 {{ $testimonial->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-3">
                        {{-- Tombol Hapus --}}
                        <form action="{{ route('admin.contact.testimonial.destroy', $testimonial->id) }}" 
                            method="POST" 
                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-red-700 w-full sm:w-auto">
                                🗑️ Hapus
                            </button>
                        </form>

                        {{-- Tombol Publish / Unpublish --}}
                        @if(!$testimonial->is_published)
                            <form action="{{ route('admin.contact.testimonial.publish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="bg-green-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-700 w-full sm:w-auto">
                                    ✅ Tampilkan
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.contact.testimonial.unpublish', $testimonial->id) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-yellow-700 w-full sm:w-auto">
                                    🚫 Sembunyikan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center">Belum ada testimoni.</p>
    @endif
</div>
@endsection
