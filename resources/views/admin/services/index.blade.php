@extends('layouts.admin')

@section('content')
<div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
    <h1 class="text-xl md:text-2xl font-bold mb-4 text-gray-800 text-center md:text-left">
        🧾 Manage Services
    </h1>

    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-3">
        <a href="{{ route('admin.services.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm md:text-base shadow-sm">
            + Add Service
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded w-full md:w-auto text-center md:text-left shadow-sm">
                {{ session('success') }}
            </div>
        @endif
    </div>

    {{-- ✅ Tabel versi desktop --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg text-sm md:text-base">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                <tr>
                    <th class="px-4 py-2 border text-left">Icon</th>
                    <th class="px-4 py-2 border text-left">Title</th>
                    <th class="px-4 py-2 border text-left">Description</th>
                    <th class="px-4 py-2 border text-left whitespace-nowrap">Price</th>
                    <th class="px-4 py-2 border text-center">PDF</th>
                    <th class="px-4 py-2 border text-center w-48">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($services as $service)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 border text-xl text-center">{{ $service->icon }}</td>
                    <td class="px-4 py-2 border font-semibold break-words">{{ $service->title }}</td>
                    <td class="px-4 py-2 border break-words text-gray-700">{{ $service->description }}</td>
                    <td class="px-4 py-2 border text-blue-700 font-semibold whitespace-nowrap">
                        Rp {{ number_format($service->price, 0, ',', '.') }}
                    </td>

                    {{-- Kolom PDF --}}
                    <td class="px-4 py-2 border text-center">
                        @if ($service->pdf_path)
                            <a href="{{ asset('storage/' . $service->pdf_path) }}" 
                               target="_blank"
                               class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs md:text-sm shadow-sm transition">
                                📄 Deskripsi Paket
                            </a>
                        @else
                            <span class="text-gray-400 text-xs italic">No PDF</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-4 py-2 border">
                        <div class="flex flex-col sm:flex-row justify-center gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}" 
                               class="bg-yellow-400 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-500 text-xs md:text-sm text-center shadow-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" 
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin hapus service ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 text-xs md:text-sm w-full sm:w-auto shadow-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ✅ Versi mobile (card view) --}}
    <div class="md:hidden space-y-4">
        @foreach($services as $service)
        <div class="border border-gray-200 rounded-xl p-4 shadow-sm hover:shadow-md transition bg-white">
            <div class="flex items-center gap-3 mb-2">
                <span class="text-2xl">{{ $service->icon }}</span>
                <h2 class="font-bold text-lg text-gray-800">{{ $service->title }}</h2>
            </div>

            <p class="text-gray-600 text-sm mb-1">
                <strong>Description:</strong> {{ $service->description }}
            </p>

            <p class="text-blue-700 font-semibold text-sm mb-3">
                <strong>Price:</strong> Rp {{ number_format($service->price, 0, ',', '.') }}
            </p>

            {{-- Tombol lihat PDF --}}
            @if ($service->pdf_path)
                <a href="{{ asset('storage/' . $service->pdf_path) }}" 
                   target="_blank"
                   class="block bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1.5 rounded-lg mb-2 text-center">
                    📄 Deskripsi Paket
                </a>
            @else
                <span class="block text-gray-400 text-sm italic mb-2 text-center">No PDF</span>
            @endif

            {{-- Aksi Edit & Delete --}}
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('admin.services.edit', $service) }}" 
                   class="bg-yellow-400 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-500 text-center text-sm">
                    ✏️ Edit
                </a>
                <form action="{{ route('admin.services.destroy', $service) }}" 
                      method="POST"
                      onsubmit="return confirm('Yakin hapus service ini?')">
                    @csrf @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 w-full text-sm">
                        🗑️ Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
