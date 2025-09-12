@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">➕ Add New Service</h1>

    {{-- tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Title --}}
        <div>
            <label class="block font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
        </div>

        {{-- Description --}}
        <div>
            <label class="block font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>{{ old('description') }}</textarea>
        </div>

        {{-- Price --}}
        <div>
            <label class="block font-medium mb-1">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
        </div>

        {{-- Icon --}}
        <div>
            <label class="block font-medium mb-1">Icon (optional)</label>
            <input type="text" name="icon" value="{{ old('icon') }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <p class="text-sm text-gray-500 mt-1">Contoh: 💍 🎉 📸</p>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" 
                    class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition">
                💾 Save
            </button>
            <a href="{{ route('admin.services.index') }}" 
               class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
                ⬅ Back
            </a>
        </div>
    </form>
</div>
@endsection
