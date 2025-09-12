@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">👥 Kelola Tim</h1>

    {{-- Form Tambah Tim --}}
    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">➕ Tambah Tim Baru</h2>
        <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Nama</label>
                <input type="text" name="name" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                <select name="role" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="">-- Pilih Role --</option>
                    <option value="Founder & MUA">Founder & MUA</option>
                    <option value="Fotografer">Fotografer</option>
                    <option value="Event Organizer">Event Organizer</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Foto</label>
                <input type="file" name="photo" class="w-full border rounded-lg p-2">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-600 active:scale-95 active:shadow-inner transition">
                Simpan
            </button>
        </form>
    </div>

    {{-- List Tim --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 text-gray-700">📋 Daftar Tim</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teams as $team)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">
                        @if($team->photo)
                            <img src="{{ asset('storage/'.$team->photo) }}" class="w-12 h-12 rounded-full shadow">
                        @else
                            <span class="text-gray-500 italic">No Photo</span>
                        @endif
                    </td>
                    <td class="p-3 font-medium text-gray-800">{{ $team->name }}</td>
                    <td class="p-3 text-gray-600">{{ $team->role }}</td>
                    <td class="p-3 space-y-2">
                        {{-- Edit --}}
                        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                            @csrf
                            <input type="text" name="name" value="{{ $team->name }}" class="border rounded-lg p-1 text-sm w-full">

                            <select name="role" class="border rounded-lg p-1 text-sm w-full">
                                <option value="Founder & MUA" {{ $team->role == 'Founder & MUA' ? 'selected' : '' }}>Founder & MUA</option>
                                <option value="Fotografer" {{ $team->role == 'Fotografer' ? 'selected' : '' }}>Fotografer</option>
                                <option value="Event Organizer" {{ $team->role == 'Event Organizer' ? 'selected' : '' }}>Event Organizer</option>
                            </select>

                            <input type="file" name="photo" class="border rounded-lg p-1 text-sm w-full">
                            <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded-lg shadow hover:bg-yellow-600 active:scale-95 active:shadow-inner transition w-full">
                                ✏️ Update
                            </button>
                        </form>

                        {{-- Hapus --}}
                        <form action="{{ route('admin.team.delete', $team->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tim ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg shadow hover:bg-red-600 active:scale-95 active:shadow-inner transition w-full">
                                🗑️ Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500 italic">
                        Belum ada anggota tim yang ditambahkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
