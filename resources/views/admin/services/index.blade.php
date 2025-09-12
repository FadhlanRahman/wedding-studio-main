@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Manage Services</h1>
    <a href="{{ route('admin.services.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Service</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mt-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Icon</th>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border w-40">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-xl">{{ $service->icon }}</td>
                    <td class="px-4 py-2 border font-semibold">{{ $service->title }}</td>
                    <td class="px-4 py-2 border">{{ $service->description }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('admin.services.edit', $service) }}" 
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                    onclick="return confirm('Yakin hapus service ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
