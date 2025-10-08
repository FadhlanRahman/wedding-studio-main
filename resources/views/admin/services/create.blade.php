@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 flex justify-center p-4 md:p-8">
    <div class="bg-white w-full md:max-w-2xl rounded-2xl shadow-lg p-6 md:p-8">
        <h1 class="text-xl md:text-2xl font-bold mb-6 text-center md:text-left text-gray-800">
            ➕ Add New Service
        </h1>

        {{-- ✅ Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ Form Tambah Service --}}
        <form action="{{ route('admin.services.store') }}" method="POST" 
              class="space-y-5">
            @csrf

            {{-- Title --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">📝 Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 p-2.5 text-sm"
                       placeholder="Masukkan nama layanan..." required>
            </div>

            {{-- Description --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">💬 Description</label>
                <textarea name="description" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 p-2.5 text-sm"
                          placeholder="Tulis deskripsi layanan..." required>{{ old('description') }}</textarea>
            </div>

            {{-- Price --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">💰 Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 p-2.5 text-sm"
                       placeholder="Contoh: 2500000" required>
            </div>

            {{-- Icon --}}
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                <label class="block font-semibold text-gray-700 mb-2">🎨 Icon (optional)</label>
                <input type="text" name="icon" value="{{ old('icon') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 p-2.5 text-sm"
                       placeholder="Contoh: 💍 🎉 📸">
                <p class="text-xs text-gray-500 mt-1">Gunakan emoji untuk ikon layanan.</p>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-3">
                <button type="submit" 
                        class="bg-green-600 text-white w-full sm:w-auto px-5 py-2.5 rounded-lg hover:bg-green-700 transition font-semibold text-sm">
                    💾 Save
                </button>
                <a href="{{ route('admin.services.index') }}" 
                   class="bg-gray-500 text-white w-full sm:w-auto px-5 py-2.5 rounded-lg hover:bg-gray-600 transition font-semibold text-sm text-center">
                    ⬅ Back
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
