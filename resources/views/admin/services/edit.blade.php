@extends('layouts.admin')

@section('content')
<div class="bg-white p-4 md:p-6 rounded-xl shadow-md max-w-2xl mx-auto">
    <h1 class="text-xl md:text-2xl font-bold mb-6 text-center md:text-left text-gray-800">
        ✏️ Edit Service
    </h1>
    <form action="{{ route('admin.services.update', $service) }}" method="POST" 
          class="space-y-5 bg-gradient-to-b from-white to-blue-50 p-4 md:p-6 rounded-xl">
    <form action="{{ route('admin.services.update', $service) }}" 
          method="POST" 
          enctype="multipart/form-data" {{-- ✅ tambahkan ini --}}
          class="space-y-5">
        @csrf 
        @method('PUT')

        {{-- Title --}}
        <div class="flex flex-col">
            <label class="block font-semibold mb-1 text-gray-700">Title</label>
            <input type="text" name="title" value="{{ $service->title }}"
                   class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none px-3 py-2 text-sm md:text-base" 
                   required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>{{ $service->description }}</textarea>
        </div>


        {{-- Price --}}
        <div class="flex flex-col">
            <label class="block font-semibold mb-1 text-gray-700">Price</label>
            <input type="number" name="price" value="{{ $service->price }}"
                   class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none px-3 py-2 text-sm md:text-base" 
                   required>
        </div>

        {{-- Icon --}}
        <div class="flex flex-col">
            <label class="block font-semibold mb-1 text-gray-700">Icon (optional)</label>
            <input type="text" name="icon" value="{{ $service->icon }}"
                   class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none px-3 py-2 text-sm md:text-base">
            <p class="text-xs md:text-sm text-gray-500 mt-1">Contoh: 💍 🎉 📸</p>
        </div>

        {{-- Upload PDF --}}
        <div class="form-group mb-3">
            <label for="pdf_file">Deskripsi Paket (PDF)</label>
            <input type="file" name="pdf_file" class="form-control" accept="application/pdf">

            {{-- Jika sudah ada PDF --}}
            @if($service->pdf_path)
                <p class="text-sm mt-2">
                    📄 File saat ini: 
                    <a href="{{ asset('storage/' . $service->pdf_path) }}" target="_blank" class="text-blue-600 underline">
                        Lihat PDF
                    </a>
                </p>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-3 pt-4">
            <button type="submit" 
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md transition text-sm md:text-base w-full sm:w-auto">
                🔄 Update
            </button>
            <a href="{{ route('admin.services.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md transition text-sm md:text-base w-full sm:w-auto text-center">
                ⬅ Back
            </a>
        </div>
    </form>
</div>
@endsection
