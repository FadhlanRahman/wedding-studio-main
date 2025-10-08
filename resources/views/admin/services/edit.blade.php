@extends('layouts.admin')

@section('content')
<div class="bg-white p-4 md:p-6 rounded-xl shadow-md max-w-2xl mx-auto">
    <h1 class="text-xl md:text-2xl font-bold mb-6 text-center md:text-left text-gray-800">
        ✏️ Edit Service
    </h1>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" 
          class="space-y-5 bg-gradient-to-b from-white to-blue-50 p-4 md:p-6 rounded-xl">
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
        <div class="flex flex-col">
            <label class="block font-semibold mb-1 text-gray-700">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none px-3 py-2 text-sm md:text-base resize-none" 
                      required>{{ $service->description ?? $service->desc }}</textarea>
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
